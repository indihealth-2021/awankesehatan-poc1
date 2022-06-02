var username = $("#tele-conference-username");
//var btnSendMessage = $('#btn-send-message');
//var inputMessage = $('#input-message');

//var videoSource = $("#video-source");
 mozRTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
 mozRTCSessionDescription = window.RTCSessionDescription || window.mozRTCSessionDescription;
 mozRTCIceCandidate = window.RTCIceCandidate || window.mozRTCIceCandidate;
//let mozRTCPeerConnection;
// setup ice server
let confrences;
let rekam;
let mediaRecorder;
let audioRecorder;
let recordedBlobs;
let audioBlobs;
let mediaSource;
let audioSource;
let outputStream;
var index = 1;
var worker;
var workerPath = 'https://telemedicinelintas.indihealth.com/assets/js/teleconference/ffmpeg-all-codecs.js';
var isFirefox = !!navigator.mozGetUserMedia;
var videoFile = 'video.webm';//!!navigator.mozGetUserMedia ? 'video.gif' : 'video.webm';
 //var io = io.connect(socket.host + ':' + socket.port);
function berhenti(jadwal_konsultasi_id){
		$.ajax({
	        method : 'POST',
	        url    : baseUrl+"Conference/end_call",
	        data   : {id: username.val(), id_jadwal_konsultasi: jadwal_konsultasi_id},
	        success : function(data){
	        	//console.log(data);
	         location.href = data;          
	        },
	        error : function(data){
	             alert(data);
	        }        
	    	});
}	
 $(document).ready(function () {

 	$("#download_container").hide();

     $("#btn-stop").click(function(){
        // confirm(baseUrl + 'Converennce/end_call', {id: username}, endCallResult, 'Apakah anda yakin?'); 
	var id_jadwal_konsultasi = $(this).data('id-jadwal-konsultasi');
        endCallResult();               
        berhenti(id_jadwal_konsultasi);
     });
    		
     $("#mic").click(function(){
       if(document.getElementById("idIcon4").className=="fa fa-microphone"){
        document.getElementById("idIcon4").className="fa fa-microphone-slash";  
        confrences.getAudioTracks()[0].enabled = false; 
      }else{
        document.getElementById("idIcon4").className="fa fa-microphone";  
        confrences.getAudioTracks()[0].enabled = true; 
      } 
 		      		    
     });			
     $("#cam").click(function(){
      if(document.getElementById("idIcon3").className=="fa fa-video"){
        document.getElementById("idIcon3").className="fa fa-video-slash";  
        confrences.getVideoTracks()[0].enabled = false;
      }else{
        document.getElementById("idIcon3").className="fa fa-video";
        confrences.getVideoTracks()[0].enabled = true;  
      }  
       
     });	
    
     $("#recStart").click(function(){        
        document.getElementById("idIcon1").style.color="#008000";  
        document.getElementById("idIcon2").style.color="#000000";  
        StartRecording();                       
     });	
     $("#recStop").click(function(){            
          document.getElementById("idIcon2").style.color="grey";              
     	    document.getElementById("idIcon1").style.color="red";  
          StopRecording();
         $("#download_container").show();
     });
     $("#download").click(function(){
     	download(); 
     	$("#download_container").hide();
     });
  
 });


var configuration = {
    'iceServers': [
   // { urls: 'stun:stun1.l.google.com:19302' },
   // { urls: 'stun:stun2.l.google.com:19302' }
  //{ urls: 'stun:stun2.l.google.com:19302' }
    {'urls': 'stun:stun.l.google.com:19302'}
    ]
   
};

var rtcPeerConn;
var myIP;

io.on('joined', function(){

});



// io.on('message', function (data) {
//     displayMessage(data);
// });


io.on('announce', function (data) {
 
});

io.on('leaved', function(){
    inConferenceSignal = false;

    io.emit('leaving', {room: room, user: currentUser});
    clearInterval(hitungDurasiTimer);
   // alert('Panggilan Berakhir<br>Durasi ' + $('#durasi-waktu-conference').text());
    setTimeout(function(){
        if (roleCall === false) {
            window.location.href = baseUrl;
        } else {
            if (tempatVideo !== undefined) {
              setopVideoConference();
            }
        }
    }, 2000);
 
});

io.on('signaling::message', function (data) {	
    if (!rtcPeerConn) {
        rtcPeerConn = (mozRTCPeerConnection) ? new mozRTCPeerConnection(configuration) : new webkitRTCPeerConnection(configuration);
        startSignaling();

    }
    if (data.type !== 'user::here') {
        var message = JSON.parse(data.message);
       
        if (message.sdp) {	   
            rtcPeerConn.setRemoteDescription((mozRTCSessionDescription) ? new mozRTCSessionDescription(message.sdp) : new RTCSessionDescription(message.sdp), function () {
                if (rtcPeerConn.remoteDescription.type == 'offer') { 		   	
                    rtcPeerConn.createAnswer().then(sendLocalDesc).catch(logError);
                }
            }, logError)
        } else {

            rtcPeerConn.addIceCandidate((mozRTCIceCandidate) ? new mozRTCIceCandidate(message.candidate) : new RTCIceCandidate(message.candidate));
        }
    }
});

function cekIp(){
	window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;//compatibility for Firefox and chrome
	var pc = new RTCPeerConnection({iceServers:[]}), noop = function(){};      
	pc.createDataChannel('');
	pc.createOffer(pc.setLocalDescription.bind(pc), noop);
	pc.onicecandidate = function(ice){
	 if (ice && ice.candidate && ice.candidate.candidate){
	  	var ip_regex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/
		var temp =ip_regex.exec(ice.candidate.candidate);
		if (temp  !== null && temp .length > 1) {
        	myIP = temp[1];
		}		 	    
	  pc.onicecandidate = noop;
	 }
	}; 	
}
function startSignaling() {
    rtcPeerConn.onicecandidate = function (evt) {
    cekIp();	
	    	
     if(evt.candidate){     
    	var test = evt.candidate.candidate;
    	var hasil;
    	if(myIP!==null || myIP!==""){
    	 hasil = test.indexOf("raddr "+ myIP);
    	}
    	
        if (evt.candidate) {                	
            io.emit('signal', {
                type: 'ice::candidate',
                message: JSON.stringify({candidate: evt.candidate}),
                room: room
            });          
        }
      }  
    };

    rtcPeerConn.onnegotiationneeded = function () {
       rtcPeerConn.createOffer().then(sendLocalDesc).catch(logError);
    };

    rtcPeerConn.onaddstream = function (evt) {
         console.log('going to add other stream ...');

        var videoLain = document.getElementById('video-other');
        videoLain.srcObject = evt.stream;
        rekam = evt.stream;
    };
        localStream();
}

// set local stream
/**
 * @description : Open 'my' video
 */
function localStream() {
    // get local stream
   // changeTabPemeriksaan();

   // $('#durasi-waktu-conference').text('00:00');
    
    inConferenceSignal = true;
    durasiConferenceMenit = 00;
    durasiConferenceDetik = 00;
    hitungDurasiTimer = setInterval(function() {
        countConferenceTimer();
    }, 1000);
	
    navigator.mediaDevices.getUserMedia({
        audio: true,video: true 
    }).then(stream => {                
        var videoKu = document.getElementById('video-ku');  
        videoKu.srcObject = stream;
        //stream.getTracks().forEach(track => rtcPeerConn.addTrack(track, stream));
        rtcPeerConn.addStream(stream);         
        tempatVideo = stream;
		confrences = stream;
		
	
    },logError);    
   

}

function sendLocalDesc(desc) {
	
    rtcPeerConn.setLocalDescription(desc, function () {
	desc.sdp = forceChosenAudioCodec(desc.sdp);
        io.emit('signal', {
            type: 'SDP',
            message: JSON.stringify({sdp: rtcPeerConn.localDescription}),
            room: room
        });
    }, logError)
}

function logError(error) {
    //console.log(error);
    // console.log(error.name + " : " + error.message);
}

// function displayMessage(data) {
//     var dtConf = new Date();

//     var dtConfMinutes = dtConf.getMinutes() > 9 ? dtConf.getMinutes() : '0' + dtConf.getMinutes();
//     var dtConfHours = dtConf.getHours() > 9 ? dtConf.getHours() : '0' + dtConf.getHours();

//     var timeConfs = dtConfHours + ":" + dtConfMinutes;

//     // console.log("display message", data);

//     if (data.author.id == username.val()) {
//         html = "<div class='from-me'><strong>" + data.author.username + "</strong><br /><p>" + data.message + "</p><span>"+timeConfs+"</span></div>";
//     } else {
//         if (openChatPanelConference === false) {
//             $(".panel-chat").removeClass('hide');
//             $(".panel-chat").removeClass('animated slideOutRight');
//             $(".panel-chat").addClass("animated slideInRight");

//             openChatPanelConference = true;
//         }

//         html = "<div class='from-other'><strong>" + data.author.username + "</strong><br /><p>" + data.message + "</p><span>"+timeConfs+"</span></div>";
//     }

//     $('.btn-chat').addClass('animated infinite shake');
//     $('.chat-body').append(html);
// }


// function sendMessage() {

//     var message = inputMessage.val();

//     if (message !== '') {
//         io.emit('send', {
//             author: currentUser,
//             message: message,
//             room: room
//         });
        
//         resetInputMessage();
//     }
// }

// function btnSendMessageClick(e) {
//     e.preventDefault();
//     sendMessage();
// }

// function inputMessageKeyup(e) {
//     e.which == 13 ? sendMessage() : false;
// }

// function resetInputMessage() {
//     inputMessage.val(null);
// }


function getCameras(sourceInfos) {
    for (var i = 0; i !== sourceInfos.length; ++i) {
        var sourceInfo = sourceInfos[i];
        var option = document.createElement('option');
        option.value = sourceInfo.id;
        if (sourceInfo.kind === 'video') {
            option.text = sourceInfo.label || 'camera' + (videoSource.length + 1);
            videoSource.append(option);
        }
    }
}

// function closeChat(){
//     $(".panel-chat").addClass('animated slideOutRight');

//     openChatPanelConference = false;
// }

/**
 *
 * Generates a random ID.
 *
 * @return a random ID
 */
function generateID() {
    var s4 = function () {
        return Math.floor(Math.random() * 0x10000).toString(16);
    };
    return s4() + s4() + "-" + s4() + "-" + s4() + "-" + s4() + "-" + s4() + s4() + s4();
}

function forceChosenAudioCodec(sdp) {
  return maybePreferCodec(sdp, 'audio', 'send', 'opus');
}

// Copied from AppRTC's sdputils.js:

// Sets |codec| as the default |type| codec if it's present.
// The format of |codec| is 'NAME/RATE', e.g. 'opus/48000'.
function maybePreferCodec(sdp, type, dir, codec) {
  const str = `${type} ${dir} codec`;
  if (codec === '') {
    console.log(`No preference on ${str}.`);
    return sdp;
  }

  console.log(`Prefer ${str}: ${codec}`);

  const sdpLines = sdp.split('\r\n');

  // Search for m line.
  const mLineIndex = findLine(sdpLines, 'm=', type);
  if (mLineIndex === null) {
    return sdp;
  }

  // If the codec is available, set it as the default in m line.
  const codecIndex = findLine(sdpLines, 'a=rtpmap', codec);
  console.log('codecIndex', codecIndex);
  if (codecIndex) {
    const payload = getCodecPayloadType(sdpLines[codecIndex]);
    if (payload) {
      sdpLines[mLineIndex] = setDefaultCodec(sdpLines[mLineIndex], payload);
    }
  }

  sdp = sdpLines.join('\r\n');
  return sdp;
}

// Find the line in sdpLines that starts with |prefix|, and, if specified,
// contains |substr| (case-insensitive search).
function findLine(sdpLines, prefix, substr) {
  return findLineInRange(sdpLines, 0, -1, prefix, substr);
}

// Find the line in sdpLines[startLine...endLine - 1] that starts with |prefix|
// and, if specified, contains |substr| (case-insensitive search).
function findLineInRange(sdpLines, startLine, endLine, prefix, substr) {
  const realEndLine = endLine !== -1 ? endLine : sdpLines.length;
  for (let i = startLine; i < realEndLine; ++i) {
    if (sdpLines[i].indexOf(prefix) === 0) {
      if (!substr ||
        sdpLines[i].toLowerCase().indexOf(substr.toLowerCase()) !== -1) {
        return i;
      }
    }
  }
  return null;
}

// Gets the codec payload type from an a=rtpmap:X line.
function getCodecPayloadType(sdpLine) {
  const pattern = new RegExp('a=rtpmap:(\\d+) \\w+\\/\\d+');
  const result = sdpLine.match(pattern);
  return (result && result.length === 2) ? result[1] : null;
}

// Returns a new m= line with the specified codec as the first one.
function setDefaultCodec(mLine, payload) {
  const elements = mLine.split(' ');

  // Just copy the first three parameters; codec order starts on fourth.
  const newLine = elements.slice(0, 3);

  // Put target payload first and copy in the rest.
  newLine.push(payload);
  for (let i = 3; i < elements.length; i++) {
    if (elements[i] !== payload) {
      newLine.push(elements[i]);
    }
  }
  return newLine.join(' ');
}
function StartRecording(){
    //recordedBlobs = [];
    //audioBlobs =[];
	 
	 // audioSource = new MediaStreamRecorder(rekam);
	 // audioSource.stream = rekam;
	 // audioSource.recorderType = StereoAudioRecorder;
	 // audioSource.mimeType = 'audio/wav';
	 	audioRecorder = RecordRTC(rekam,
	 		{type : 'audio',
	 		mimeType : 'audio/wav',
	 		recorderType : StereoAudioRecorder,
	 		audioBitsPerSecond: 128000});
	 	audioRecorder.startRecording();
	 	
		mediaRecorder = RecordRTC(rekam,
			{type : 'video',
		    mimeType: 'video/webm',
			recorderType: MediaStreamRecorder,
			videoBitsPerSecond: 128000});		
		mediaRecorder.startRecording();
	
}
function StopRecording(){

  audioRecorder.stopRecording(function(){
  	audioBlobs = audioRecorder.getBlob();
  });
  mediaRecorder.stopRecording(function(){
  	recordedBlobs = mediaRecorder.getBlob();
  });
}
function handleStop(event) {
  console.log('Recorder stopped: ', event);
}
function download(){
  convertStreams(mediaRecorder.blob,audioRecorder.blob);
   
}
function bytesToSize(bytes) {
                var k = 1000;
                var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes === 0) return '0 Bytes';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(k)), 10);
                return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
            }

            // below function via: http://goo.gl/6QNDcI
            function getTimeLength(milliseconds) {
                var data = new Date(milliseconds);
                return data.getUTCHours() + " hours, " + data.getUTCMinutes() + " minutes and " + data.getUTCSeconds() + " second(s)";
            }
            function processInWebWorker() {
                    var blob = URL.createObjectURL(new Blob(['importScripts("' + workerPath + '");var now = Date.now;function print(text) {postMessage({"type" : "stdout","data" : text});};onmessage = function(event) {var message = event.data;if (message.type === "command") {var Module = {print: print,printErr: print,files: message.files || [],arguments: message.arguments || [],TOTAL_MEMORY: message.TOTAL_MEMORY || false};postMessage({"type" : "start","data" : Module.arguments.join(" ")});postMessage({"type" : "stdout","data" : "Received command: " +Module.arguments.join(" ") +((Module.TOTAL_MEMORY) ? ".  Processing with " + Module.TOTAL_MEMORY + " bits." : "")});var time = now();var result = ffmpeg_run(Module);var totalTime = now() - time;postMessage({"type" : "stdout","data" : "Finished processing (took " + totalTime + "ms)"});postMessage({"type" : "done","data" : result,"time" : totalTime});}};postMessage({"type" : "ready"});'], {
                        type: 'application/javascript'
                    }));

                    var worker = new Worker(blob);
                    URL.revokeObjectURL(blob);
                    return worker;
                }
                function convertStreams(videoBlob, audioBlob) {
                    var vab;
                    var aab;
                    var buffersReady;
                    var workerReady;
                    var posted = false;

                    var fileReader1 = new FileReader();
                    fileReader1.onload = function() {
                        vab = this.result;

                        if (aab) buffersReady = true;

                        if (buffersReady && workerReady && !posted) postMessage();
                    };
                    var fileReader2 = new FileReader();
                    fileReader2.onload = function() {
                        aab = this.result;

                        if (vab) buffersReady = true;

                        if (buffersReady && workerReady && !posted) postMessage();
                    };

                    fileReader1.readAsArrayBuffer(videoBlob);
                    fileReader2.readAsArrayBuffer(audioBlob);

                    if (!worker) {
                        worker = processInWebWorker();
                    }

                    worker.onmessage = function(event) {
                        var message = event.data;
                        if (message.type == "ready") {
                        	console.log('ready');
                           // log('<a href="'+ workerPath +'" download="ffmpeg-asm.js">ffmpeg-asm.js</a> file has been loaded.');
                            workerReady = true;
                            if (buffersReady)
                                postMessage();
                        } else if (message.type == "stdout") {
                            console.log(message.data);
                        } else if (message.type == "start") {
                        	console.log('start');
                            //log('<a href="'+ workerPath +'" download="ffmpeg-asm.js">ffmpeg-asm.js</a> file received ffmpeg command.');
                        } else if (message.type == "done") {
                            console.log("pesan "+ JSON.stringify(message));

                            var result = message.data[0];
                            console.log("hasil "+JSON.stringify(result));

                            var blob = new Blob([result.data], {
                                type: 'video/mkv'
                            });

                            console.log("Blob "+ JSON.stringify(blob));

                           postBlob(blob);
                        }
                    };
                    var postMessage = function() {
                        posted = true;

                        if(isFirefox) {
                            worker.postMessage({
                                type: 'command',
                                arguments: [
                                    '-i', videoFile,
                                    '-c:v', 'mpeg4',
                                    '-c:a', 'vorbis',
                                    '-b:v', '6400k',
                                    '-b:a', '4800k',
                                    '-strict', 'experimental', 'output.mp4'
                                ],
                                files: [
                                    {
                                        data: new Uint8Array(vab),
                                        name: videoFile
                                    }
                                ]
                            });
                            return;
                        }

                        worker.postMessage({
                            type: 'command',
                            arguments: [
                                '-i', videoFile,
                                '-i', 'audio.wav',
                                '-c', 'copy','output.mkv'
                            ],
                            files: [
                                {
                                    data: new Uint8Array(vab),
                                    name: videoFile
                                },
                                {
                                    data: new Uint8Array(aab),
                                    name: "audio.wav"
                                }
                            ]
                        });
                    };
                }
  function postBlob(blob){
  	var url = window.URL.createObjectURL(blob);
  	var today = new Date();
var date = today.getFullYear()+'_'+(today.getMonth()+1)+'_'+today.getDate();
var time = today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
var tgl = date+time;
  var a = document.createElement('a');
  a.style.display = 'none';
  a.href = url;
  a.download = tgl+'.mkv';
  document.body.appendChild(a);
  a.click();
  setTimeout(function() {
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
  }, 1000);
  }              

// eventsdfgsdfg
//btnSendMessage.click(btnSendMessageClick);
//inputMessage.keyup(inputMessageKeyup);
