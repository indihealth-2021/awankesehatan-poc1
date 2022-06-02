var roleCall = false;
var tempatVideo;
var durasiConferenceMenit = 00;
var durasiConferenceDetik = 00;
var durasiConferenceTimer;
var hitungDurasiTimer;
var openChatPanelConference = false;
var inConferenceSignal = false;
var statusPemeriksaanBaru;
var pilihDokter;

function changeTabPemeriksaan() {
  if (teleName == 'tele_radiologi') {
    window.location.hash = '#konsultasi';
  } else {
    $('.tab-pemeriksaan-tele').removeClass('active');
    $('#tab-pemeriksaan-konsultasi').addClass('active');
    $('#konsultasi').addClass('active');
  }
}

function countConferenceTimer() {
  if (durasiConferenceDetik == 60) {
    durasiConferenceDetik = 00;
    durasiConferenceMenit += 1;
  } else {
    durasiConferenceDetik += 1;
  }

  if (durasiConferenceMenit > 9) {
    durasiConferenceTimer = durasiConferenceMenit;
  } else {
    durasiConferenceTimer = '0' + durasiConferenceMenit;
  }

  if (durasiConferenceDetik > 9) {
    durasiConferenceTimer += ':' + durasiConferenceDetik;
  } else {
    durasiConferenceTimer += ':0' + durasiConferenceDetik;
  }

  $('#durasi-waktu-conference').text(durasiConferenceTimer);
}

function endCallResult() {
  inConferenceSignal = false;
  
  io.emit('leave', {room: room, user: currentUser});
  clearInterval(hitungDurasiTimer);
 // alert('Panggilan Berakhir \n Durasi ' + $('#durasi-waktu-conference').text());

  //if (roleCall === false) {
  //  window.location.href = baseUrl;
  //} else {
    if (tempatVideo !== undefined) {
      setopVideoConference();
    }
  //}
}

function setopVideoConference() {
  var alat = tempatVideo.getTracks();

  for (var i = 0; i < alat.length; i++) {
    alat[i].stop();
  }
document.getElementById('video-other').removeAttribute('src');
document.getElementById('video-ku').removeAttribute('src');
  //videoOther.removeAttr('src');
  //videoMe.removeAttr('src');

  rtcPeerConn.close(); 
  rtcPeerConn.onicecandidate = null; 
  rtcPeerConn.ontrack = null; 
  rtcPeerConn = null;
}