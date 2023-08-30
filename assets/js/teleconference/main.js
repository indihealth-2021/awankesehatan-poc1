//var ROOM = 'chat';
var SIGNAL_ROOM = 'signal-room';
var conference_room = '';
var halaman_tele_aktif = '';
var teleAktifUrl = 'proses_teleconsultasi';
// elements
var username = $("#tele-conference-username");
var btnCall = $('#panggil');
//var btnReject = $("#btn-reject");
var userCall = $('#user-call');
var labelOnline = $('#label-online');
var labelOffline = $("#label-offline");
var btnAnswer = $('#jawab');
var btnClose = $('.btn-batal');

var btnStop = $('#btn-stop');

var btnReject = $('#tolak');


var btnAnswerFarmasi = $('#jawab_farmasi');
var btnRejectFarmasi = $('#tolak_farmasi');
var btnEndCallFarmasi = $('#btn-stop-farmasi');

function checkform(form) {
  // get all the inputs within the submitted form
  var inputs = form.getElementsByTagName('input');
  for (var i = 0; i < inputs.length; i++) {
    // only validate the inputs that have the required attribute
    if (inputs[i]) {
      if(inputs[i].name != 'tekanan_darah')
      {
          // console.log(inputs[i].name)
          if (inputs[i].value == "") {
            // found an empty field that is required
            return false;
          }
      }
    
    }
  }

  var textareas = form.getElementsByTagName('textarea');
  for (var i = 0; i < textareas.length; i++) {
    // only validate the inputs that have the required attribute
    if (textareas[i]) {
      if (textareas[i].html == "") {
        // found an empty field that is required
        return false;
      }
    }
  }
  return true;
}

// console.log(socket);
//, { secure: true, reconnect: true, rejectUnauthorized : false }
//var io = io.connect(socket.host + ":" + socket.port);
// var room = window.location.pathname.match(/([^\/]*)\/*$/)[1];
// //io.set('transports', ['xhr-polling']);
// var onlineUsersChat, onlineUsersVideo;

// var currentUser;

// var _member = {
//     caller: {},
//     receiver: {}
// };

// $.ajax({
//     url: siteUrl + '/api/user/view/' + username.val(),
//     method: 'get'
// }).then(function (result) {    
//     currentUser = result;
//     io.emit('ready', {init_room: 'INDIHEALTH', user: result, room: room});
//     io.emit('members::checking', {room: room, init_room: 'INDIHEALTH', user: currentUser});
//     io.emit('online::users::chat', {room: 'INDIHEALTH'});
//     io.emit('online::users::video', {room: 'INDIHEALTH'});
// }, logError);


//btnReject.click(function (e) {
//   alert('tes');
// io.emit('reject', {init_room: 'INDIHEALTH', user: currentUser});
// $('#alert-calling').removeClass('hide');
// e.preventDefault();
//});


// on

// userCall.change(function (e) {
//     var _id = $(this).val();

//     // online checking

//     onlineChecking(_id, function (isOnline) {
//         if (isOnline) {
//             labelOffline.hide();
//             labelOnline.show();
//         } else {
//             labelOffline.show();
//             labelOnline.hide();
//         }
//     })
// });
//function callResult(){
// 	$.ajax({
//       url: baseUrl + 'api/user/peer_to_peer/' + username.val() + '/' + userCall.val(),
//       method: 'get'
//   }).then(function (result) {  		
//       var conference_room = window.location.pathname.match(/([^\/]*)\/*$/)[1];

//       io.emit('calling', {room: 'INDIHEALTH', conference_room: conference_room, tele_class: teleAktifUrl, users: [result.caller, result.receiver]});

//      // $("#alert-waiting").modal('show');
//     //  $('#receiver').html('<strong>' + result.receiver.nama + '</strong>');
//   }, logError);
// }

btnAnswerFarmasi.click(function(e){
  var p_o_d = $(this).data('pd') == 'p' ? 'pasien':'dokter';
  var id_farmasi = $(this).data('id-farmasi');
  var room_name = $(this).data('room-name');
  $.ajax({
    url: baseUrl+p_o_d+'/FarmasiCall/jawab',
    method: 'POST',
    data: 'id_farmasi='+id_farmasi,
    success: function(data){
      post(baseUrl+p_o_d+'/FarmasiCall', {room_name:room_name, id_farmasi:id_farmasi});
    },
    error: function(err){
      console.log('GAGAL: Laporkan hal ini pada admin!');
    }
  });
})

btnRejectFarmasi.click(function(e){
  const p_o_d = $(this).data('pd') == 'p' ? 'pasien':'dokter';
  const id_farmasi = $(this).data('id-farmasi');

  $.ajax({
    url: baseUrl+p_o_d+'/FarmasiCall/tolak',
    method: 'POST',
    data: 'id_farmasi='+id_farmasi,
    success: function(data){
      $('#jawaban_farmasi').modal('hide');
    },
    error: function(err){
      console.log('GAGAL: Laporkan hal ini pada admin!');
    }
  })
});

btnEndCallFarmasi.click(function(e){
  const id_user = $(this).data('id-user');
  const p_or_d = $(this).data('pd');

  $.ajax({
    url: baseUrl+'admin/FarmasiCall/akhiri',
    method: 'POST',
    data: 'id_user='+id_user+'&p_or_d='+p_or_d,
    success: function(data){
      var iframes = document.getElementsByTagName('iframe');
      for (var i = 0; i < iframes.length; i++) {
          iframes[i].parentNode.removeChild(iframes[i]);
      }
      $('#konten-panggilan').prop('hidden', true);
    },
    error: function(err){
      console.log('GAGAL: Laporkan hal ini pada admin!');
    }
  })
});

btnCall.click(function (e) {
  $('#memanggil').modal('show');
  // callResult();
  var pasien_id = $(this).data('id-pasien');
  var jadwal_konsultasi_id = $(this).data('id-jadwal-konsultasi')
  $.ajax({
    method: 'POST',
    url: baseUrl + "Conference/call",
    data: { reg: reg_id, id_pasien: pasien_id, id_jadwal_konsultasi: jadwal_konsultasi_id, roomName: room_name },
    success: function (data) {
      console.log(JSON.parse(data).results[0].error);
      if (JSON.parse(data).results[0].error == 'NotRegistered') {
        $('#memanggil').modal('hide');
        $('#pasienError').modal('show');
      }
    },
    error: function (data) {
      alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
    }
  });
});

btnReject.click(function (e) {
  var id_dokter = $(this).data('id-dokter');

  $.ajax({
    method: 'POST',
    url: baseUrl + "Conference/reject",
    data: { id_dokter: id_dokter },
    success: function (data) {
      console.log(data);
    },
    error: function (data) {
      alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
    }
  });
});

btnStop.click(function (e) {
  var pasien_id = $(this).data('id-pasien');
  var jadwal_konsultasi_id = $(this).data('id-jadwal-konsultasi');

  var assesment_pasien = checkform(document.getElementById('formKonsultasi'));
  // var keluhan = $('textarea[name="keluhan"]').val();
  // var keluhan_warning = `
  //                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
  //                                 <strong>Keluhan tidak boleh kosong!</strong> isi keluhan.
  //                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  //                                   <span aria-hidden="true">&times;</span>
  //                                 </button>
  //                               </div>
  //   `;

  // if (keluhan == '') {
  //   $('#keluhan').append(keluhan_warning);
  // }

  var diagnosis = $('select[name="diagnosis"]').val();
  // var diagnosis_warning = `
  //                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
  //                                 <strong>Diagnosis tidak boleh kosong!</strong> isi diagnosis.
  //                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  //                                   <span aria-hidden="true">&times;</span>
  //                                 </button>
  //                               </div>
  //   `;
  // if (diagnosis == '') {
  //   $('#diagnosis').append(diagnosis_warning);
  // }

  // var resep_dokter = $('#listResep')[0].value;
  // var resep_dokter_warning = `
  //                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
  //                                 <strong>Resep Dokter tidak boleh kosong!</strong> isi resep.
  //                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  //                                   <span aria-hidden="true">&times;</span>
  //                                 </button>
  //                               </div>    
  //   `;

  // if (resep_dokter == '') {
  //   $('#resepDokter').append(resep_dokter_warning);
  // }

  if (diagnosis == 0 || assesment_pasien == false) {// || resep_dokter == '') {
    alert('Form Harus diisi semua termasuk assesment yang kosong! Jika pasien tidak ada, kontak admin untuk membatalkan konsultasi!');
    return;
  }

  var data_konsultasi = $('#formKonsultasi').serialize();
  var data_konsultasi_2 = $('#formKonsultasi_2').serialize();

  if (assesment_pasien != false && diagnosis != 0) {//&& resep_dokter != '') {
    var chat_id = `/chats/${id_dokter}_${id_pasien}`;
    $.ajax({
      method: 'POST',
      url: baseUrl + "Conference/end_call",
      data: { reg: reg_id, id_pasien: pasien_id, id_jadwal_konsultasi: jadwal_konsultasi_id, chat_id: chat_id, data_konsultasi: data_konsultasi, data_konsultasi_2: data_konsultasi_2 },
      success: function (data) {
        console.log(data);
      },
      error: function (data) {
        // alert(data);
        console.log(data);
      }
    });
  }
});
// 2.
// answer here ...
function post(path, params, method = 'post') {

  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}

btnAnswer.click(function (e) {
  var temp = JSON.parse(loadData);
  var id_jadwal_konsultasi = $(this).data('id-jadwal-konsultasi');
  var id_dokter = $(this).data('id-dokter');
  var roomName = $(this).data('room-name');

  var ok = false;
  $.ajax({
    method: 'POST',
    url: baseUrl + "Conference/jawab",
    data: { id_dokter: id_dokter, id_jadwal_konsultasi: id_jadwal_konsultasi, roomName: roomName },
    success: function (data) {
      if (data) {
        console.log(data);
        post(baseUrl + 'pasien/Telekonsultasi/konsultasi/' + id_dokter + '/' + id_jadwal_konsultasi, { roomName: roomName });
        //   window.location.href = siteUrl + 'pasien/Telekonsultasi/konsultasi/'+id_dokter+'/'+id_jadwal_konsultasi;
        //location.href = baseUrl+"pasien/Telekonsultasi/konsultasi";
      } else {
        console.log("tidak bisa menjawab");
      }
    },
    error: function (data) {
      alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
    }


  });
  // e.preventDefault();
  //    io.emit('answered', {room: conference_room});
  //    io.emit('add::member', {
  //        user: _member,
  //        room: conference_room,
  //        init_room: 'INDIHEALTH'
  //    });

  // alert('/telemedicine/conference/room/' + room);

  //window.open(siteUrl + 'conference/room/' + room, '_blank', 'location=yes,height='+$(window).height()+',width='+$(window).width()+',scrollbars=yes,status=yes');

  // window.location.href = '/indihealth/conference/room/' + room;
});

btnClose.click(function(e){
  $.ajax({
    method: 'POST',
    url: baseUrl+'Conference/cancel_call',
    data: {id_pasien: id_pasien},
    success: function(data){
      console.log('dibatalkan');
    },
    error: function(data){
      console.log('ERROR');
    }
  })
});

// 1.
// on make call

//io.on('make::call', function (data) {

    // console.log({
    //     receiver: data.receiver.id,
    //     caller: data.caller.id
    // });

//     _member = {
//         receiver: data.receiver,
//         caller: data.caller
//     };


//     if (data.receiver.id == username.val()) {
//         conference_room = data.conference_room;
//         halaman_tele_aktif = data.tele_class;

//        // $('#alert-calling').modal('show');
//       //  $('#caller').html('<strong>' + data.caller.username + '</strong>');
//     }
// });


// io.on('online::chat', function (data) {
//     onlineUsersChat = data.users;
//     // console.log("online users chat", data);
// });

// io.on('online::video', function (data) {
//     onlineUsersVideo = data.users;
//     // init user list

// });


// 3.
// broadcast message 'Ready to Chat Peer-to-Peer'
// io.on('announce', function (data) {
//     // console.log(data);
// });


// io.on('added::member', function (data) {

//     if (data.data.room == room) {

//         io.emit('join conference', {
//             room: data.data.room,
//             message: 'join room ' + data.data.room,
//             user: {
//                 pengampu: data.data.user.receiver,
//                 diampu: data.data.user.caller
//             }
//         });
//     }


// });

// io.on('signal::ready', function (data) {
//     // console.log("masuk signal ready", data);

//     var _findMember = _.find(data.members, {id: username.val()});   
//     if (_findMember) {
//         // console.log(_findMember);

//         io.emit('signal', {
//             type: 'user::here',
//             message: 'Are you ready for a call?',
//             room: data.data.room,
//             members: data.members
//         });
//     }
// });

//io.on('has::answer', function (data) {
    // console.log("has answer", data);

//        window.open(siteUrl + 'conference/room/' + data.room, '_blank', 'location=yes,height='+$(window).height()+',width='+$(window).width()+',scrollbars=yes,status=yes');

//    $('#alert-waiting').modal('hide');
//        _io.emit('active', {data: data});
//        window.location.href = siteUrl + 'tele_konsultasi/conference/' + data.room;
//});

// io.on('rejected', function (data) {
//     $('#alert-rejected').modal('show');
//     $("#rejector").html('<strong>' + data.user.username + '</strong>');
// });


// function logError(e) {
//     // console.log(e);
// }

// function onlineChecking(id, cb) {

//     var _isOnline = _.find(onlineUsersVideo, {id: id});
//     cb(_isOnline);

// }

// function shortUrl() {
//     return ("000000" + (Math.random() * Math.pow(36, 6) << 0).toString(36)).slice(-6)
//     // return window.location.pathname.match(/([^\/]*)\/*$/)[1];
// }

