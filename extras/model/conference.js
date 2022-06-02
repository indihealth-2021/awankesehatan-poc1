/**
 * Created by Lenovo on 7/25/2017.
 */
var mysql = require('mysql');
var moment = require('moment');

var pool  = mysql.createPool({
    connectionLimit : 10,
    host: 'localhost',
    user: 'root',
    password: 'Lintas2345',
    database: 'konsultasi_dokter'
});


function getPool(cb) {
    pool.getConnection(function(err, connection){
        if (err) {
            throw 'Cannot connect to database';
        }
        cb(connection);
    })
}

module.exports = {

    save: function (room, members, cb) {
        var insert = "INSERT INTO data_conference (members, room, start_time) VALUES (?,?,?)";
        getPool(function(connection){
            connection.query({
                sql: insert,
                timeout: 40000
            }, [JSON.stringify(members), room, moment().format('Y-m-d hh:mm:ss').toString()], function (err, result, fields) {
                //console.log("Affected Row : " + result.affectedRows + ' row ');
                cb(err, result, fields);
                connection.release();
            });
        });
    },
    chats: function (room, chats, cb) {
        var update = "INSERT INTO data_conference_chat (room, chats) VALUES (?,?)";
        getPool(function(connection){
            connection.query({
                sql: update,
                timeout: 40000
            }, [room, JSON.stringify(chats)], function (err, result, fields) {
                cb(err, result, fields);
                connection.release();
            });
        });
    }
};
