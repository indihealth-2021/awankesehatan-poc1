<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
              <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/FarmasiVerifikasiObat');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/FarmasiCall');?>"class="text-black font-bold-7">Panggil</a></li>
              </ol>
          </nav>
        </div>
        <div class="col-sm-12 col-12">
            <h3 class="page-title"><?= $title ?></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="input-group">
            <select class="custom-select" id="pasien-select" name="pasien">
              <option selected disabled>Pilih pasien...</option>
              <?php foreach($list_pasien as $pasien){ ?>
                <?php 
                    $pasien->no_medrec = str_split($pasien->no_medrec, "2");    
                    $pasien->no_medrec = implode('.',$pasien->no_medrec);	
                ?>
                <option value="<?= $pasien->id ?>"><?= $pasien->name ?> ( <?= $pasien->no_medrec ? $pasien->no_medrec : '-' ?> )</option>
              <?php } ?>
            </select>
            <div class="input-group-append">
              <button class="btn bg-tele text-light" type="button" id="panggil-pasien" >Panggil</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id="konten-panggilan">
        <div class="col-md-12">
          <div class="card card-5 p-1 px-4 pt-3 pb-5">
            <ul class="nav nav-tabs-konsul nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="#bottom-tab2" data-toggle="tab">Video</a></li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab1" data-toggle="tab">Chat</a></li>
            </ul>
            
            <div class="tab-content">
                  <div class="tab-pane show" id="bottom-tab1">
                      <div class="">
                          <div class="col-lg-12 message-view chat-view" style="width: 10% !important">
                              <div class="chat-window">
                                  <div class="card-box">
                                      <div class="chat-contents chat-content-wrap">
                                          <div class="chat-wrap-inner">
                                              <div class="chat-box">
                                                  <div class="chats" id="messages">

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="chat-footer">
                                    <?= form_open_multipart('', 'id="form-message"'); ?> 
                                          <div class="message-bar">
                                              <div class="message-inner">
                                                    <label class="images-upload px-3 mt-2">
                                                        <img src="<?php echo base_url('assets/dashboard/img/file.png'); ?>" alt="">
                                                        <input id="attachment_label" type="file" name="attachment" accept=".jpg,.jfif,.jpeg,.png,.txt,.docx,.doc,.pdf" style="display: none;">
                                                    </label>
                                                  <div class="message-area">
                                                      <div class="input-group">
                                                          <textarea class="form-control" name="message" placeholder="Type message..."></textarea>
                                                      </div>
                                                  </div>
                                              </div>
                                              <input type="hidden" name="attachment" value=''>
                                              <button class="btn btn-send-mess" id="send">
                                                <img src="<?php echo base_url('assets/dashboard/img/send.png'); ?>" width="10" height="auto" alt="">
                                              </button>
                                          </div>
                                  </div>
                                  <?= form_close(); ?>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane active" id="bottom-tab2">
                    <div class="row my-2 px-3">
                      

                          </div>
                      <div class="">
                          <div id="meet" width="800" height="700" style="background: #000;"></div>
                          <!-- <video autoplay id="video-other" style="background-color: #000;" width="100%" height="100%"></video>                  
                                    <video autoplay id="video-ku" style="background-color: #000; position: absolute; bottom: 75px; right: 8px; width: 40%; height: 40%;"></video> -->
                      </div>
                  </div>
              </div>
              <!-- <button type="button" data-toggle="modal" data-target="#exampleModal" class="mb-2 btn btn-konsul" id="panggil" data-id-pasien="" data-id-jadwal-konsultasi=""><img src="<?php echo base_url('assets/dashboard/img/phone-call.png'); ?>" alt=""> Hubungi Pasien</button> -->
              <div class="row mt-2">
                <div class="col-md-12">
                  <button type="button" class="btn btn-outline-danger btn-block" id="btn-stop-farmasi" data-id-user="" data-pd='p'><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button>
                </div>
              </div>
          </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="memanggil" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content" style="width: 400px">
            <div class="modal-header">
                <p class="modal-title font-24" id="exampleModalLabel">Memanggil...</p>
            </div>
            <div class="modal-body" align="center">
                <i class="fa fa-phone fa-5x text-tele">....</i>
                <div class="mt-5">
                    <button type="button" class="btn btn-batal-farmasi" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal-->
<script>
    chat_locate = 'farmasi';
    user_kategori = 'farmasi';
    id_pasien = '';
    id_dokter = <?php echo $user->id ?>;
    foto_pasien = '';
    foto_dokter = '';
    chat_id = '';
</script>
<script type="text/javascript">
    var room_name = '';
    function start_consultation(){
      name = '<?php echo $user->name; ?>';
      document.getElementById("user-call").value = '<?php echo $pasien->id ?>';
      var userName = name;
      const domain = 'telekonsultasi2.telemedical.id';
      const options = {
          roomName: room_name,
          width: '100%',
          height: '400px',
          parentNode: document.querySelector('#meet'),
          configOverwrite: {
                toolbarButtons: [
                    'microphone',
                ],
                disableDeepLinking: true,
                startVideoMuted: true,
                startWithVideoMuted: true
            },
            userInfo: {
                displayName: userName
            },
      };

      navigator.mediaDevices.getUserMedia({
            audio: true,
            video: true
        }).then(function(stream) {
            const api = new JitsiMeetExternalAPI(domain, options).then(() => {
                document.querySelector("#jitsiConferenceFrame0").contentWindow.location.reload();
            });
            api.executeCommand('displayName', userName);
            api.addEventListener('participantRoleChanged', function(event) {
                if (event.role === 'moderator') {
                    api.executeCommand('toggleLobby', true);
                }
            });
            api.on('passwordRequired', function() {
                api.executeCommand('password', '123456');
            });
        });
      function recordJitsi(e) {
          api.executeCommand('stopRecording', 'stream');
          var isRecording = e.getAttribute('data-is-recording');
          if (isRecording == "1") {
              api.executeCommand('stopRecording', 'stream');
              e.innerHTML = '<i class="fas fa-record-vinyl"></i> Mulai Rekam';
              e.setAttribute('data-is-recording', "0");
              e.style = 'background-color: green';
          } else {
              api.executeCommand('startRecording', 'stream');
              e.innerHTML = '<i class="fas fa-stop"></i> Stop Rekam';
              e.setAttribute('data-is-recording', "1");
              e.style = 'background-color:red;';
          }
      }
    }
</script>