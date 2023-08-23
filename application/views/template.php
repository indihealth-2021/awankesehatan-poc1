<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta content="Fri, 20 Jan 1984 01:11:11 GMT" />
  <meta http-equiv="Pragma" content="no-cache" />
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">
  <title>Telemedicine | <?php echo ucfirst($this->uri->segments[1]) ?> - <?php echo $title ?></title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Sans" />
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
  <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/website/css/font-ooredoo.css">
  <!-- Font Awesome -->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/dashboard/img/iconico/*">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/style.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/select2.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/bootstrap-datetimepicker.min.css'); ?>">
  <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url('assets/dashboard/js/jquery-3.2.1.min.js'); ?>"></script>
  <!--firebase-->
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-database.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-messaging.js"></script>
  <?php
  if (isset($css_addons)) {
    echo $css_addons;
  }
  ?>
  <script src="<?php echo base_url('assets/bower_components/lodash/dist/lodash.min.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script type="text/javascript">
    
    const firebaseConfig = {

      apiKey: "AIzaSyBQVFzlB_hnd8Td48GuQSUbhV60DXENiRw",

      authDomain: "telemedicine-poc2.firebaseapp.com",

      databaseURL: "https://telemedicine-poc2-default-rtdb.asia-southeast1.firebasedatabase.app",

      projectId: "telemedicine-poc2",

      storageBucket: "telemedicine-poc2.appspot.com",

      messagingSenderId: "170641677475",

      appId: "1:170641677475:web:dbfdb8df11cb068ba27316",

      measurementId: "G-LHGYJ33LGE"

    };
    firebase.initializeApp(firebaseConfig);
  </script>
  <style>
    #notif {
      max-height: 500px;
      overflow-y: auto;
    }
  </style>


</head>

<body>
  <div class="main-wrapper">
    <div class="header">
      <!-- <div class="header-left">
        <a href="#" class="logo">
          <img src="<?php echo base_url('assets/dashboard/img/logo.png'); ?>" width="150" height="auto" alt=""><span></span>
        </a>
      </div> -->
      <a id="toggle_btn" href="javascript:void(0);"><i class="ml-5 fa fa-bars"></i></a>
      <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="ml-1 fa fa-bars"></i></a>
      <ul class="nav user-menu">
        <li class="nav-item tgl">
          <?php
          $now = new DateTime();
          $day_eng = $now->format('D');
          if ($day_eng == 'Mon') {
            $day_ind = 'Senin';
          } else if ($day_eng == 'Tue') {
            $day_ind = 'Selasa';
          } else if ($day_eng == 'Wed') {
            $day_ind = 'Rabu';
          } else if ($day_eng == 'Thu') {
            $day_ind = 'Kamis';
          } else if ($day_eng == 'Fri') {
            $day_ind = 'Jum\'at';
          } else if ($day_eng == 'Sat') {
            $day_ind = 'Sabtu';
          } else if ($day_eng == 'Sun') {
            $day_ind = 'Minggu';
          } else {
            $day_ind = 'Unkown';
          }
          ?>
          <span class="font-14"><?php echo $day_ind . ', ' . $now->format('d/m/Y'); ?></span>
        </li>
        <li class="nav-item dropdown d-sm-block">
          <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="far fa-bell"></i> <span class="badge badge-pill bg-danger float-right" id="notif-count"><?php echo count($list_notifikasi) ?></span></a>
          <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
              <?php if (count($list_notifikasi) > 0) { ?>
                <a href="#" onclick="return readAllNotif()" class="dropdown-item dropdown-footer">Tandai Semua Sebagai Sudah Dibaca</a>
              <?php } else {
                echo 'Notifications';
              } ?>
            </div>
            <div class="drop-scroll">
              <ul class="notification-list" id="isi_notif">
                <?php foreach ($list_notifikasi as $notif) { ?>
                  <li class="notification-message" id="notif-<?php echo $notif->id ?>">
                    <a href="<?php echo $notif->direct_link ?>" onclick="return readNotif(<?php echo $notif->id ?>);">
                      <div class="media">
                        <span class="avatar"><i class="fas fa-envelope mr-2 ml-2"></i></span>
                        <div class="media-body">
                          <p class="noti-details"><span class="noti-title"><?php echo $notif->notifikasi ?></span></p>
                          <?php
                          $tanggal = new DateTime($notif->tanggal);
                          $tanggal = $tanggal->format('d-m-Y H:i:s');
                          ?>
                          <p class="noti-time"><span class="notification-time"><?php echo $tanggal ?></span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>

          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
            <span class="user-img">
              <?php
              if ($user->foto) {
                $foto = base_url('assets/images/users/' . $user->foto);
              } else {
                $foto = base_url('assets/telemedicine/img/default.png');
              }
              ?>
              <img class="rounded-circle mx-3" src="<?php echo $foto; ?>" alt="">
              <!-- <span class="status online"></span> -->
            </span>
          </a>
          <!--  <div class="dropdown-menu">
            <?php
            if (strtolower($this->uri->segments[1]) == 'pasien') {
              $profil_url = base_url('pasien/Profile');
              $settings_url = base_url('pasien/KonfigurasiAkun');
            } else if (strtolower($this->uri->segments[1]) == 'dokter') {
              $profil_url = base_url('dokter/Profile');
              $settings_url = base_url('dokter/KonfigurasiAkun');
            } else {
              $profil_url = base_url('admin/Profil');
              $settings_url = base_url('admin/KonfigurasiAkun');
            }
            ?>
            <a class="dropdown-item" href="<?php echo $profil_url ?>">Profil</a>
            <a class="dropdown-item" href="<?php echo $settings_url ?>">Pengaturan</a>
            <a class="dropdown-item" href="<?php echo base_url('logout') ?>">Keluar</a>
          </div> -->
        </li>
        <li class="nav-item font-12 mt-1">
          <span><?php echo ucwords($user->name); ?></span><br>
          <span style="color: #434343;">
            <?php
            if (strtolower($this->uri->segments[1]) == 'pasien') {
              echo 'Pasien';
            } else if (strtolower($this->uri->segments[1]) == 'dokter') {
              echo 'Dokter';
            } else if (strtolower($this->uri->segments[1]) == 'admin') {
              echo 'Admin';
            }
            ?>
          </span>
        </li>
      </ul>
      <!-- <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="<?php echo $profil_url ?>">Profil</a>
          <a class="dropdown-item" href="<?php echo $settings_url ?>">Pengaturan</a>
          <a class="dropdown-item" href="<?php echo base_url('logout') ?>">Keluar</a>
        </div>
      </div> -->
    </div>
    <?php
    if (strtolower($this->uri->segments[1] == 'admin')) {
      $this->load->view('admin/_partial/sidebar');
    } else if (strtolower($this->uri->segments[1] == 'dokter')) {
      $this->load->view('dokter/_partial/sidebar');
    } else if (strtolower($this->uri->segments[1] == 'pasien')) {
      $this->load->view('pasien/_partial/sidebar');
    } else if (strtolower($this->uri->segments[1] == 'farmasi')) {
      $this->load->view('farmasi/_partial/sidebar');
    } else {
      echo "Not Found";
    }
    ?>

    <input type="hidden" id="tele-conference-username" value="<?php echo $user->id ?>" />
    <input type="hidden" id="user-call" />
    <audio controls id="bell-ring" style="display:none;">
      <source src="<?php echo base_url('assets/sounds/bell_ring.ogg') ?>" type="audio/ogg">
      <source src="<?php echo base_url('assets/sounds/bell_ring.mp3') ?>" type="audio/mpeg">
      Your browser does not support the audio element.
    </audio>
    <audio controls id="swinging" style="display:none;">
      <source src="<?php echo base_url('assets/sounds/swinging.ogg') ?>" type="audio/ogg">
      <source src="<?php echo base_url('assets/sounds/swinging.mp3') ?>" type="audio/mpeg">
      Your browser does not support the audio element.
    </audio>

    <?php $this->load->view($view) ?>

    <!-- <footer class="footer">
      <div class="float-right d-none d-sm-block">
        Version 3.0.4
      </div>
      <span style="padding: 10px">Copyright &copy; 2020. Indihealth & Lintasarta. All rights
        reserved.</span>
    </footer>

 -->

      <div class="modal fade" id="jawaban_farmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content mx-auto" style="width: 400px">
            <div class="modal-header">
              <p class="modal-title font-24" id="exampleModalLabel">Panggilan...</p>
            </div>
            <div class="modal-body" align="center">
              <i class="fas fa-phone fa-5x text-tele">....</i>
            </div>
            <div class="modal-footer">
              <div class="mt-5 mx-auto">
                <button type="button" class="btn btn-simpan" data-dismiss="modal" id="jawab_farmasi" data-room-name="" data-id-farmasi="" data-pd=''>Jawab</button>
                <button type="button" class="btn btn-batal" data-dismiss="modal" id="tolak_farmasi" data-id-farmasi="" data-pd=''>Tolak</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php $user_2 = $this->db->query('select master_user.id_user_kategori, detail_pasien.accept_tac from master_user INNER JOIN detail_pasien ON detail_pasien.id_pasien = master_user.id where master_user.id = ?',[$user->id])->row(); ?>



    <?php if ($user_2 && $user_2->id_user_kategori == 0) { ?>
      <div class="modal fade" id="jawaban" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content mx-auto" style="width: 400px">
            <div class="modal-header">
              <p class="modal-title font-24" id="exampleModalLabel">Panggilan...</p>
            </div>
            <div class="modal-body" align="center">
              <i class="fas fa-phone fa-5x text-tele">....</i>
            </div>
            <div class="modal-footer">
              <div class="mt-5 mx-auto">
                <button type="button" class="btn btn-simpan" data-dismiss="modal" id="jawab" data-id-jadwal-konsultasi="" data-room-name="" data-id-dokter="">Jawab</button>
                <button type="button" class="btn btn-batal" data-dismiss="modal" id="tolak" data-id-dokter="">Tolak</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <div class="modal fade" id="ModalNotif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-white" style="background:linear-gradient(to right, #36d1dc, #009efb);">
            <h3 class="modal-title" id="exampleModalLabel">Pemberitahuan</h3>
          </div>
          <div class="modal-body">
            <span class="bell fa fa-bell"></span><br />
            <h4 id="isinotifmodal" align="center"></h4>
          </div>
        </div>
      </div>
    </div>

    <!-- <footer class="main-footer" style="background-color: #2C94D2; color: #000000;">
                          <div class="float-right d-none d-sm-block">
                            Version 3.0.4
                          </div>
                          Copyright &copy; 2020. Indihealth & Lintasarta. All rights
                          reserved.
                        </footer>
                    </div>
 -->

    <!--<div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box" id="pesan">

                        </ul>
                    </div>-->
    <!--<div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>-->
    <!--</div>
            </div>-->
  </div>
  </div>
  <div class="sidebar-overlay" data-reff=""></div>

  <script src="<?php echo base_url('assets/dashboard/js/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/jquery.slimscroll.js'); ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/Chart.bundle.js'); ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/chart.js'); ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/app.js'); ?>"></script>


  <script src="<?php echo base_url('assets/dashboard/js/select2.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/moment.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap-datetimepicker.min.js') ?>"></script>



  <script>
    $('input[type=number]').on('focus', function(e) {
      $(this).on('wheel.disableScroll', function(e) {
        e.preventDefault()
      })
    })
    $('input[type=number]').on('blur', function(e) {
      $(this).off('wheel.disableScroll')
    })

    $('input[name=suhu]').keypress(function(e) {
      suhu_val = $(this).val();
      if (!(e.keyCode >= 48 && e.keyCode <= 57) && (e.keyCode != 46)) {
        alert('Format Salah! Contoh: 35.6');
      }
    });
    $('input[name=suhu]').change(function(e) {
      suhu_val = $(this).val();
      $(this).val(suhu_val.replace(/[^0-9|\.]/g, ''));
    });

    $('input[name=tekanan_darah]').keypress(function(e) {
      tekanan_darah_val = $(this).val();
      if (!(e.keyCode >= 47 && e.keyCode <= 57)) {
        alert('Format Salah! Contoh: 100/70');
      }
    });
    $('input[name=tekanan_darah]').change(function(e) {
      tekanan_darah_val = $(this).val();
      $(this).val(tekanan_darah_val.replace(/[^0-9|/]/g, ''));
    });

    $('input[name=berat_badan]').on("keyup keydown change", function(event) {
      if ($(this).val() < 0) {
        $(this).val(1);
      }
    });

    $('input[name=tinggi_badan]').on("keyup keydown change", function(event) {
      if ($(this).val() < 0) {
        $(this).val(1);
      }
    });
  </script>

  <script>
    baseUrl = '<?php echo base_url(); ?>';

    const pesan = firebase.messaging();
    pesan.getToken().then((currentToken) => {
      if (currentToken) {
        $.ajax({
          method: 'POST',
          url: baseUrl + "Conference/RegId",
          data: {
            reg_id: currentToken
          },
          success: function(data) {
            if (data) {
              console.log("update reg id berhasil");
            } else {
              console.log("update reg id gagal");
            }
          },
          error: function(data) {
            alert('Terjadi kesalahan firebase, refresh kembali browser anda.');
          }


        });
      } else {
        console.log('No Instance ID token available. Request permission to generate one.');
      }
    }).catch((err) => {
      console.log('An error occurred while retrieving token. ', err);
      showToken('Error retrieving Instance ID token. ', err);
      setTokenSentToServer(false);
    });

    pesan.onTokenRefresh(() => {
      pesan.getToken().then((refreshedToken) => {
        $.ajax({
          method: 'POST',
          url: baseUrl + "Conference/RegId",
          data: {
            reg_id: refreshedToken
          },
          success: function(data) {
            if (data) {
              console.log("refresh reg id berhasil");
            } else {
              console.log("refresh reg id gagal");
            }
          },
          error: function(data) {
            alert('Terjadi kesalahan, refresh kembali browser anda.');
          }


        });
      }).catch((err) => {
        console.log('Unable to retrieve refreshed token ', err);
        showToken('Unable to retrieve refreshed token ', err);
      });
    });
    pesan.onMessage(function(payload) {
      var test = payload || {};
      loadData = test.data.body;
      console.log('payload',payload);
       // console.log('name',JSON.parse(JSON.parse(payload.data.body).name);
      //  $("#jawaban").modal('show');
      if (loadData == "ok") {
        $('#memanggil').modal('hide');
      }
      var userid = <?php echo $user->id ?>;
      <?php if (isset($teleconsul_admin_js)) {
        echo $teleconsul_admin_js;
      } ?>

      if (JSON.parse(JSON.parse(payload.data.body).id_user).includes(userid.toString())) {
        if (JSON.parse(JSON.parse(payload.data.body).name == 'unshow')) {
          if (JSON.parse(JSON.parse(payload.data.body).sub_name == 'submit_assesment_pasien')) {
            alert('Assesment telah diupdate, pasien baru mengisi assesment!');
            var path = window.location.pathname;
            var path = path.toLowerCase();
            var appendAssesment = true;
            if (path.includes('dokter/teleconsultasi/proses_teleconsultasi')) {
              $('input[name=berat_badan]').val(JSON.parse(payload.data.body).berat_badan);
              $('input[name=tinggi_badan]').val(JSON.parse(payload.data.body).tinggi_badan);
              $('input[name=suhu]').val(JSON.parse(payload.data.body).suhu);
              $('input[name=tekanan_darah]').val(JSON.parse(payload.data.body).tekanan_darah);
              if (JSON.parse(payload.data.body).user_file) {
                var userFiles = JSON.parse(payload.data.body).user_file;
                if (appendAssesment){
                  document.getElementById('file_asesmen').innerHTML = "";
                  userFiles.forEach(function(file) {
                    var card = document.createElement('div');
                    card.className = 'card';
                    var cardBody = document.createElement('div');
                    cardBody.className = 'card-body';
                    var cardTitle = document.createElement('h5');
                    cardTitle.textContent = file.nama_file;
                    var cardDescription = document.createElement('p');
                    cardDescription.textContent = file.type_file;
                    var cardButton = document.createElement('button');
                    cardButton.className = 'btn btn-primary btn-sm';
                    cardButton.textContent = 'Lihat File';
                    cardButton.onclick = function() {
                      var filePath = baseUrl + 'assets/files/file_pemeriksaan_luar/' + file.path_file;
                      window.open(filePath, '_blank');
                    }
                    cardBody.appendChild(cardTitle);
                    cardBody.appendChild(cardDescription);
                    cardBody.appendChild(cardButton);
                    card.appendChild(cardBody);
                    document.getElementById('file_asesmen').appendChild(card);
                  });
                  appendAssesment = false;
                }
              }
              if (JSON.parse(payload.data.body).merokok == 1) {
                $('#merokok-1').prop('checked', true);
              } else {
                $('#merokok-0').prop('checked', true);
              }

              if (JSON.parse(payload.data.body).alkohol == 1) {
                $('#alkohol-1').prop('checked', true);
              } else {
                $('#alkohol-0').prop('checked', true);
              }

              if (JSON.parse(payload.data.body).kecelakaan == 1) {
                $('#kecelakaan-1').prop('checked', true);
              } else {
                $('#kecelakaan-0').prop('checked', true);
              }

              if (JSON.parse(payload.data.body).dirawat == 1) {
                $('#dirawat-1').prop('checked', true);
              } else {
                $('#dirawat-0').prop('checked', true);
              }

              if (JSON.parse(payload.data.body).operasi == 1) {
                $('#operasi-1').prop('checked', true);
              } else {
                $('#operasi-0').prop('checked', true);
              }

              $('textarea[name=keluhan]').val(JSON.parse(payload.data.body).keluhan);
              startTimer();
            }
          }
        }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_berakhir_pasien')) {
          location.href = "<?php echo base_url('pasien/Pasien') ?>";
        }
        if(JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_farmasi_pasien')){
          $("#jawab_farmasi").data('room-name', JSON.parse(payload.data.body).room_name);
          $('#jawab_farmasi').data('id-farmasi', JSON.parse(payload.data.body).id_farmasi);
          $('#jawab_farmasi').data('pd', JSON.parse(payload.data.body).p_or_d);
          $('#tolak_farmasi').data('pd', JSON.parse(payload.data.body).p_or_d);
          $('#tolak_farmasi').data('id-farmasi', JSON.parse(payload.data.body).id_farmasi);
          $('#jawaban_farmasi').modal({
            backdrop: 'static',
            keyboard: false
          });
          $("#jawaban_farmasi").modal('show');
        }

        if(JSON.parse(JSON.parse(payload.data.body).name == 'accept_panggilan_farmasi_pasien')){
          $('#memanggil').modal('hide');
          $('#konten-panggilan').prop('hidden', false);
        }

        if(JSON.parse(JSON.parse(payload.data.body).name == 'reject_panggilan_farmasi_pasien')){
          $('#memanggil').modal('hide');
          $('#konten-panggilan').prop('hidden', true);

          alert('Panggilan ditolak oleh pasien');
        }

        if(JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_farmasi_dokter')){
          $("#jawab_farmasi").data('room-name', JSON.parse(payload.data.body).room_name);
          $('#jawab_farmasi').data('id-farmasi', JSON.parse(payload.data.body).id_farmasi);
          $('#jawab_farmasi').data('pd', JSON.parse(payload.data.body).p_or_d);
          $('#tolak_farmasi').data('pd', JSON.parse(payload.data.body).p_or_d);
          $('#tolak_farmasi').data('id-farmasi', JSON.parse(payload.data.body).id_farmasi);
          $('#jawaban_farmasi').modal({
            backdrop: 'static',
            keyboard: false
          });
          $("#jawaban_farmasi").modal('show');
        }

        if(JSON.parse(JSON.parse(payload.data.body).name == 'accept_panggilan_farmasi_dokter')){
          $('#memanggil').modal('hide');
          $('#konten-panggilan').prop('hidden', false);
        }

        if(JSON.parse(JSON.parse(payload.data.body).name == 'reject_panggilan_farmasi_dokter')){
          $('#memanggil').modal('hide');
          $('#konten-panggilan').prop('hidden', true);

          alert('Panggilan ditolak oleh dokter');
        }

        if(JSON.parse(JSON.parse(payload.data.body).name == 'akhiri_panggilan_farmasi_pasien')){
          location.href = baseUrl+'pasien/Pasien';
        }

        if(JSON.parse(JSON.parse(payload.data.body).name == 'akhiri_panggilan_farmasi_dokter')){
          location.href = baseUrl+'dokter/Dashboard';
        }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'pendaftaran_konsultasi')) {
          alert('Terdapat jadwal konsultasi baru yang didaftarkan!');
          var audio = document.getElementById('bell-ring');
          audio.play();
        }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'resep_dari_dokter')) {
          alert('Terdapat resep baru dari dokter!');
          var audio = document.getElementById('bell-ring');
          audio.play();
        }
        // if (JSON.parse(JSON.parse(payload.data.body).name == 'resep_diverifikasi_pasien')) {
        //   alert('Terdapat resep yang telah diverifikasi oleh pasien!');
        //   var audio = document.getElementById('bell-ring');
        //   audio.play();
        // }
        // if (JSON.parse(JSON.parse(payload.data.body).name == 'resep_obat_diverifikasi')) {
        //   alert('Resep obat sudah diverifikasi oleh farmasi!');
        //   var audio = document.getElementById('bell-ring');
        //   const id_jadwal_konsultasi = JSON.parse(payload.data.body).id_jadwal_konsultasi;
        //   audio.play();
        // }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'vp') || JSON.parse(JSON.parse(payload.data.body).name == 'universal')) {
          $("#isinotifmodal").text(JSON.parse(payload.data.body).keterangan);
          $("#ModalNotif").modal('show');
          setTimeout(function() {
            $('#ModalNotif').modal('hide');
          }, 3000);
        }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_dokter')) {
          $('#memanggil').modal('hide');
          if($('textarea[name=keluhan]').val()){
            startTimer();
          }
        }

        if (JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_pasien')) {
          $("#jawab").data('id-jadwal-konsultasi', JSON.parse(payload.data.body).id_jadwal_konsultasi);
          $("#jawab").data('id-dokter', JSON.parse(payload.data.body).id_dokter);
          $("#jawab").data('room-name', JSON.parse(payload.data.body).roomName);
          $('#tolak').data('id-dokter', JSON.parse(payload.data.body).id_dokter);
          $('#jawaban').modal({
            backdrop: 'static',
            keyboard: false
          });
          $("#jawaban").modal('show');
        }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'reject_by_dokter')) {
          $('#jawaban').modal('hide');
        }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'reject_konsultasi')) {
          $('#memanggil').modal('hide');
          alert(JSON.parse(payload.data.body).keterangan);
        }
        var data = JSON.parse(payload.data.body);
        var notif = document.getElementById('isi_notif');
        var notif_count = document.getElementById('notif-count');
        // var pesan = document.getElementById('pesan');
        // var message_count = document.getElementById('message-count');
        // var jml_message = message_count.innerHTML;
        var jml_notif = notif_count.innerHTML;
        var template_notif = `
            <li class="notification-message" id="notif-${data.id_notif}">
                <a href="${data.direct_link}" onclick="return readNotif(${data.id_notif});">
                    <div class="media">
                        <span class="avatar"><i class="fas fa-envelope mr-2"></i></span>
                        <div class="media-body">
                            <p class="noti-details"><span class="noti-title">${data.keterangan}</span></p>
                            <p class="noti-time"><span class="notification-time">${data.tanggal}</span></p>
                        </div>
                    </div>
                </a>
            </li>
        `;
        // var template_notif = `
        //       <a href="${data.direct_link}" class="dropdown-item">
        //         <i class="fas fa-envelope mr-2"></i> <span title='${data.keterangan}'>${data.keterangan.substring(0,30)+'...'}</span><br/>
        //         <span class="float-left text-muted text-sm">${data.tanggal}</span>
        //       </a><br/>
        //       <div class="dropdown-divider"></div>
        // `;
        if (JSON.parse(payload.data.body).name != "pesan" && JSON.parse(payload.data.body).name != "unshow") {
          var audio = document.getElementById('bell-ring');
          audio.play();
          notif.innerHTML = template_notif + notif.innerHTML;
          notif_count.innerHTML = parseInt(jml_notif) + 1
        } else {
          // pesan.innerHTML = template_notif+pesan.innerHTML;
          // message_count.innerHTML = parseInt(jml_message)+1;
          console.log(template_notif);
        }
        console.log(JSON.parse(payload.data.body).name != "pesan" || JSON.parse(payload.data.body).name != "unshow");
      }
    });
  </script>
  <script>
    var username = document.getElementById('username');
    var email = document.getElementById('email');

    if (username) {
      username.onkeyup = function() {
        this.value = this.value.toLowerCase();
        this.value = this.value.replace(' ', '');
      }
    }
    if (email) {
      email.onkeyup = function() {
        this.value = this.value.toLowerCase();
        this.value = this.value.replace(' ', '');
      }
    }
  </script>

  <script>
    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
    $("#update_diagnosa").click(function() {
      let data_konsultasi_2 = $('#formKonsultasi_2').serializeArray();
      let list_id_obat = [];
      let list_keterangan_obat = [];
      let list_jumlah_obat = [];

      $('tr').each(function() {
        let temp = $(this).attr("id");
        if(!(temp == undefined)) {
          list_id_obat.push(temp);
        }
      });
      $('td#keterangan').each(function() {
        let temp = $(this).text();
        list_keterangan_obat.push(temp);
      });
      $('td#jumlah_obat').each(function() {
        let temp = $(this).text();
        list_jumlah_obat.push(temp);
      });

      let id_pasien = getParameterByName("id_pasien");
      let id_jadwal_konsultasi = getParameterByName("id_jadwal_konsultasi");
      let invalid = 0;

      data_konsultasi_2.forEach(item => {
        if(item.value == "0" || item.value == "" || item.value=="-- Pilih Apotek --" || item.value=="-- Pilih Diagnosa --") {
          invalid ++;
        }
      });

      if(invalid > 0) {
        alert("Form masih kosong!");
      }else {
        $.ajax({
            method: 'POST',
            url: baseUrl + "dokter/Teleconsultasi/update_diagnosa",
            data: {
              id_pasien: id_pasien,
              id_jadwal_konsultasi: id_jadwal_konsultasi,
              data_konsultasi: data_konsultasi_2,
              list_id_obat: list_id_obat,
              list_keterangan_obat: list_keterangan_obat ,
              list_jumlah_obat: list_jumlah_obat,
              apotek: $('#apotek option:selected').text(),
              diagnosis: $('#diagnosis option:selected').text()

            },success: function (data) {
              alert("Berhasil menyelesaikan telekonsultasi!");
              location.href = baseUrl+"dokter/HistoryMedisPasien/index/all";
            },
            error: function (data) {
              console.log(data);
            }
          });
      }

    });
    function readNotif(id_notif) {
      $.ajax({
        method: 'GET',
        url: baseUrl + "Notifikasi/baca/" + id_notif,
        success: function(data) {
          $("#notif-" + id_notif).remove();
          var notif_count = document.getElementById('notif-count').innerHTML;
          $("#notif-count").text(parseInt(notif_count) - 1);
          return true;
        },
        error: function(data) {
          return false;
        }
      });
    }

    function readAllNotif() {
      $.ajax({
        method: 'GET',
        url: baseUrl + "Notifikasi/bacaSemua",
        success: function(data) {
          $('#isi_notif').empty();
          $('#notif-count').text('0');
          return true;
        },
        error: function(data) {
          return false;
        }
      });
    }
  </script>

  <script type="text/javascript" src="<?php echo base_url('assets/js/teleconference/main.js'); ?>"></script>
  <?php
  if (isset($js_addons)) {
    echo $js_addons;

  }
  ?>

 <!--  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script> -->

</body>

</html>
