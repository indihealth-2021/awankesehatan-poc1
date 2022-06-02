/**
 * Created by agungrizkyana on 6/3/17.
 */
var fs = require('fs');
var express = require('express.io');
var app = express();
var _ = require('lodash');
var moment = require('moment');
var conference = require('./model/conference');

// online users
var onlineUsers = [];


// only two members in a room
var members = [];
var roomMembers = [];
//app.http().io();

var https = require('https');
var privateKey  = fs.readFileSync('/etc/ssl/indihealth/private.key');
var certificate = fs.readFileSync('/etc/ssl/indihealth/certificate.crt');
//, requestCert:false, rejectUnauthorized: false
var credentials = {key: privateKey, cert: certificate };
 
// app.use(express.session({secret: 'telemedicine-2017'}));

app.https(credentials).io()


app.listen('7000', function () {
    console.log("Server Socket Running on : 7000");
});		

app.io.route('ready', function (req) {

    if (req.data.user) {
         console.log("Socket Ready!");  
        req.io.join(req.data.init_room);
        req.io.join(req.data.user);

        if (!isAddedToOnline(req.data.user)) {
            onlineUsers.push(req.data.user);
        }

        app.io.room(req.data).broadcast('announce', {
            message: req.data.user
        });
    } else {
        console.log("sekarang ada di conference");
    }


});

app.io.route('active', function (req) {
    app.io.room(req.data).broadcast('activated');
});

app.io.route('calling', function (req) {

    // cek member dahulu sebelum calling
    // apabila member sudah lebih dari 2 dalam satu room, jangan lakukan make call    
    var joined = _.find(roomMembers, {room: req.data.conference_room});

    console.log("joined");
    console.log(joined);

    app.io.room(req.data).broadcast('make::call', {
        caller: req.data.users[0],
        receiver: req.data.users[1],
        room: req.data.room,
        conference_room: req.data.conference_room,
        tele_class: req.data.tele_class
    });
});

app.io.route('answered', function (req) {

    app.io.room(req.data).broadcast('has::answer', req.data);
});

app.io.route('reject', function (req) {
    console.log("rejected");
    app.io.room(req.data).broadcast('rejected', req.data);
});

app.io.route('join', function (req) {
    req.io.join(req.data.room);
    req.io.join(req.data.id);

    console.log("JOIN", req.data);

    // save session
    req.session = req.data;

    app.io.room(req.data).broadcast('announce', {
        message: 'Ready to Chat Peer-To-Peer'
    });

    app.io.room(req.data).broadcast('joined', {
        message: 'Joined!'
    });
});

app.io.route('join conference', function (req) {
    console.log("join conference");

    req.io.leave('INDIHEALTH');

    req.io.join(req.data.room);

    members.push(req.data.user.pengampu);
    members.push(req.data.user.diampu);

    roomMembers.push({
        room: req.data.room,
        members: members
    });

    req.session = {
        room: req.data.room,
        members: members
    };

    conference.save(req.data.room, members, function (err, result, fields) {
        if (err) {
            return false;
        }
        req.io.room(req.data.room).broadcast('joined', {message: 'ok!'});
    });

});

app.io.route('online::users::chat', function (req) {
    app.io.room(req.data.room).broadcast('online::chat', {
        users: onlineUsers
    })
});

app.io.route('online::users::video', function (req) {
    app.io.room(req.data.room).broadcast('online::video', {
        users: onlineUsers
    })
});

app.io.route('send', function (req) {

    conference.chats(req.data.room, JSON.stringify({
        message: req.data.message,
        author: req.data.author,
        time: moment().format()
    }), function (err, result, fields) {
        if (err) return false;
        app.io.room(req.data.room).broadcast('message', {
            message: req.data.message,
            author: req.data.author
        });
    });


});

app.io.route('signal', function (req) {

   console.log("server signal");
   console.log(req.data.message);

    req.io.room(req.data.room).broadcast('signaling::message', {
        type: req.data.type,
        message: req.data.message
    });
});

app.io.route('leave', function (req) {

    _.remove(members, function (o) {
        return o.id === req.data.user.id;
    });

    req.io.leave(req.data.room);
    req.io.room(req.data.room).broadcast('leaved', {message: 'bye!'});
    	

});

app.io.route('leaving', function (req) {

    _.remove(members, function(o){
        return o.id === req.data.user.id;
    });

});


app.io.route('add::member', function (req) {
    
    req.io.room(req.data.init_room).broadcast('added::member', {data: req.data});
});


app.io.route('members::checking', function (req) {    
    var _member = _.find(members, {id: req.data.user.id});    
    if (_member) {
        req.io.leave(req.data.init_room);
        req.io.join(req.data.room);
        req.io.emit('signal::ready', {data: req.data, members: members})
    }

});


// is added to online
function isAddedToOnline(user) {
    var find = _.find(onlineUsers, {id: user.id});
    if (find) return true;
    return false;
}

// is exceed join room , max 2 user
function isExceedToJoinRoom() {
    if (onlineUsers.length == 2) return true;
    return false;
}