<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">
  <title>Telemedicine | <?php echo ucfirst($this->uri->segments[1]) ?> - <?php echo $title ?></title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Font Awesome -->
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

  <?php
  if (isset($css_addons)) {
    echo $css_addons;
  }
  ?>
  <script src="<?php echo base_url('assets/bower_components/lodash/dist/lodash.min.js') ?>"></script>

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
      <div class="header-left">
        <a href="#" class="logo">
          <img src="<?php echo base_url('assets/dashboard/img/logo.png'); ?>" width="150" height="auto" alt=""><span></span>
        </a>
      </div>
      <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
      <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
      <ul class="nav user-menu float-right">
        <li class="nav-item dropdown d-none d-sm-block">
          <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right" id="notif-count"><?php echo count($list_notifikasi) ?></span></a>
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
            <!--<div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>-->
          </div>
        </li>
        <?php //if(strtolower($this->uri->segments[1]) != 'admin'){ 
        ?>
        <!--<li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li>-->
        <?php //} 
        ?>
        <li class="nav-item dropdown has-arrow">
          <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
            <span class="user-img">
              <?php
              if ($user->foto) {
                $foto = base_url('assets/images/users/' . $user->foto);
              } else {
                $foto = base_url('assets/telemedicine/img/default.png');
              }
              ?>
              <img class="rounded-circle" src="<?php echo $foto; ?>" width="24" alt="">
              <span class="status online"></span>
            </span>
            <span><?php echo ucwords($user->name); ?></span>
          </a>
          <div class="dropdown-menu">
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
            <!--<a class="dropdown-item" href="edit-profile.html">Edit Profile</a>-->
            <a class="dropdown-item" href="<?php echo $settings_url ?>">Pengaturan</a>
            <a class="dropdown-item" href="<?php echo base_url('logout') ?>">Keluar</a>
          </div>
        </li>
      </ul>
      <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="<?php echo $profil_url ?>">Profil</a>
          <!--<a class="dropdown-item" href="edit-profile.html">Edit Profile</a>-->
          <a class="dropdown-item" href="<?php echo $settings_url ?>">Pengaturan</a>
          <a class="dropdown-item" href="<?php echo base_url('logout') ?>">Keluar</a>
        </div>
      </div>
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

    <footer class="footer">
      <div class="float-right d-none d-sm-block">
        Version 3.0.4
      </div>
      <span style="padding: 10px">Copyright &copy; 2020. Indihealth & Lintasarta. All rights
        reserved.</span>
    </footer>


    <?php $user_2 = $this->db->query('select master_user.id_user_kategori, detail_pasien.accept_tac from master_user INNER JOIN detail_pasien ON detail_pasien.id_pasien = master_user.id where master_user.id = ' . $user->id)->row(); ?>
    <?php if ($user_2 && $user_2->id_user_kategori == 0) { ?>
      <div class="modal fade" id="jawaban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 300px">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Panggilan...</h5>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button> -->
            </div>
            <div class="modal-body" align="center">
              <i class="fa fa-phone fa-5x" style="color: #007Bff;">....</i>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal" id="jawab" data-id-jadwal-konsultasi="" data-room-name="" data-id-dokter="">Jawab</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" id="tolak" data-id-dokter="">Tolak</button>
            </div>
          </div>
        </div>
      </div>
      <?php if ($user_2->accept_tac == 0) { ?>
        <div class="modal fade" id="tac_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 800px;">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">SYARAT DAN KETENTUAN PENGGUNAAN</h5>
              </div>
              <div class="modal-body">
                <div style="overflow-y: scroll; max-height: 200px; padding: 5px;" id="tac_body">
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:center;vertical-align:baseline;'><strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>SYARAT DAN KETENTUAN PENGGUNAAN</span></strong></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:center;vertical-align:baseline;'><strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>SI TUNTAS</span></strong></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:center;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><em><span style='font-size:15px;font-family:"Calibri",sans-serif;'>MOHON UNTUK MEMBACA SELURUH SYARAT DAN KETENTUAN PENGGUNAAN SERTA KEBIJAKAN PRIVASI YANG TERLAMPIR DENGAN CERMAT DAN SAKSAMA SEBELUM MENGGUNAKAN SETIAP FITUR DAN/ATAU LAYANAN YANG TERSEDIA DALAM PLATFORM SI TUNTAS.</span></em></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Syarat dan Ketentuan Penggunaan (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Ketentuan Penggunaan</span></strong>&rdquo;) ini merupakan suatu perjanjian sah terkait tata cara dan persyaratan penggunaan fitur dan/atau layanan (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Layanan</span></strong>&rdquo;) Platform SI TUNTAS &nbsp;(&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Platform</span></strong>&rdquo;) antara Pengguna (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Anda</span></strong>&rdquo;) dengan pengelola Platform, yaitu Rumah Sakit &hellip;&hellip;&hellip;. yang didukung oleh PT. Aplikanusa Lintasarta (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Kami</span></strong>&rdquo;). Dengan mengunduh dan/atau memasang dan/atau menggunakan Platform dan/atau menikmati Layanan Kami, Anda setuju bahwa Anda telah membaca, memahami, mengetahui, menerima, dan menyetujui seluruh informasi, syarat-syarat, dan ketentuan-ketentuan penggunaan Platform yang terdapat dalam Ketentuan Penggunaan ini.&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Apabila Anda tidak setuju terhadap salah satu, sebagian, atau seluruh isi yang tertuang dalam Ketentuan Penggunaan dan Kebijakan Privasi ini, silakan untuk menghapus Platform dalam perangkat elektronik Anda dan/atau tidak mengakses Platform dan/atau tidak menggunakan Layanan Kami. Mohon untuk dapat diperhatikan pula bahwa Ketentuan Penggunaan dan Kebijakan Privasi dapat diperbarui dari waktu ke waktu.</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: decimal;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>KETENTUAN UMUM</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Platform adalah aplikasi (versi Android), aplikasi web (aplikasi yang dapat diakses menggunakan web), website yang dikelola oleh Kami sebagaimana diperbarui dari waktu ke waktu.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Koneksi internet diperlukan untuk dapat menggunakan Layanan dan biaya terkait penggunaan koneksi internet tersebut ditanggung sepenuhnya oleh Anda.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Platform berfungsi sebagai sarana untuk menghubungkan Anda dengan pihak Rumah Sakit yang menyediakan layanan atau menjual barang kepada Anda seperti (tetapi tidak terbatas pada) dokter, psikolog, apotek, laboratorium, dan/atau jasa pengantaran (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Penyedia Layanan</span></strong>&rdquo;).</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Jenis layanan yang dapat digunakan melalui Platform adalah:</span></li>
                  </ol>
                  <ul style="list-style-type: disc;margin-left:44px;">
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Pendaftaran online untuk telekonsultasi dengan dokter RS;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Pembayaran menggunakan asuransi Owlexa maupun pembayaran elektronik untuk non-asuransi</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Video call dan Chat dengan Dokter;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Pemberian resep dan pengiriman obat;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Layanan lain yang dapat kami tambahkan dari waktu ke waktu;</span></li>
                  </ul>
                  <ol start="5" style="list-style-type: lower-alpha;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Kami dapat menggunakan jasa pihak ketiga terkait penyediaan layanan pembayaran. Apabila terjadi kegagalan pada sistem pembayaran, Kami akan berupaya semaksimal mungkin dalam membantu menyelesaikan masalah yang mungkin timbul. Penyedia jasa perbankan/pembayaran yang dipilih oleh Anda dapat mengenakan biaya tambahan kepada Anda atas layanan yang diberikan.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Setiap fitur atau fasilitas dalam Platform dapat diperbarui atau diubah sesuai dengan kebutuhan dan perkembangan Platform.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Informasi mengenai data pribadi dan riwayat kesehatan anda tersimpan di dalam database milik RS, dan Kami akan menyimpan serta menampilkannya dalam akun Anda. Kerahasiaan data Anda terjamin dan akan digunakan oleh Rumah Sakit untuk keperluan interaksi dengan dokter dan/atau keperluan pemesanan obat serta layanan lainnya yang dilakukan di dalam Platform yang telah Anda setujui sesuai dengan ketentuan perundang-undangan yang berlaku dan Kebijakan Privasi.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Dengan menggunakan Platform, Anda memahami dan menyetujui bahwa percakapan melalui fitur <em><span style='font-family:"Calibri",sans-serif;'>video call</span></em>, <em><span style='font-family:"Calibri",sans-serif;'>voice call</span></em> maupun <em><span style='font-family:"Calibri",sans-serif;'>chat</span></em> akan tersimpan secara otomatis dan diarsipkan untuk keperluan legal dan peningkatan kualitas layanan. Kerahasiaan percakapan Anda terjamin dan informasi tidak akan disebarluaskan.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Anda memahami dan menyetujui bahwa komunikasi Anda dengan fasilitas pelayanan kesehatan yang terhubung tersimpan secara otomatis dan diarsipkan untuk keperluan legal dan peningkatan kualitas layanan. Kerahasiaan percakapan Anda terjamin dan informasi tidak akan disebarluaskan.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Kami dapat menghentikan atau membatasi proses registrasi atau penggunaan Platform oleh Anda jika ditemukan pelanggaran dari Ketentuan Penggunaan ini atau peraturan perundang-undangan yang berlaku.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: undefined;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>KETENTUAN PENGGUNAAN PLATFORM</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda menyatakan dan menjamin bahwa Anda adalah individu yang memiliki hak untuk mengadakan perjanjian yang mengikat berdasarkan hukum Negara Republik Indonesia dan bahwa Anda telah berusia minimal 21 (dua puluh satu) tahun atau sudah menikah dan tidak berada di bawah perwalian atau pengampuan. Jika Anda berusia di bawah 21 (dua puluh satu) tahun dan belum menikah, Anda menyatakan dan menjamin bahwa Anda telah memperoleh izin dari orang tua atau wali hukum Anda, kecuali Anda menyatakan sebaliknya.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Dengan memberikan persetujuan, orang tua atau wali hukum Anda setuju untuk bertanggung jawab atas:&nbsp;</span></li>
                  </ol>
                  <ol style="list-style-type: lower-roman;margin-left:48.5px;">
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>semua tindakan Anda terkait akses ke dan penggunaan Platform dan/atau Layanan;&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>biaya apa pun terkait penggunaan Anda atas Layanan apa pun; dan&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>kepatuhan Anda terhadap Syarat dan Ketentuan ini.&nbsp;</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:40.5pt;font-size:16px;font-family:"Times New Roman",serif;margin-top:0cm;margin-bottom:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Kami dapat menutup atau membatalkan akun Anda apabila hal tersebut tidak benar. Anda selanjutnya menyatakan dan menjamin bahwa Anda memiliki hak, wewenang dan kapasitas untuk menggunakan Layanan dan akan senantiasa mematuhi Ketentuan Penggunaan. Jika Anda mendaftarkan atas nama suatu badan usaha, Anda juga menyatakan bahwa Anda berwenang untuk bertindak untuk dan atas nama badan hukum tersebut dan untuk mengadakan dan mengikatkan badan hukum/entitas tersebut pada Ketentuan Penggunaan Platform.&nbsp;</span></p>
                  <ol start="3" style="list-style-type: lower-alpha;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda dapat menggunakan Platform dengan terlebih dahulu melakukan pendaftaran yang disertai pemberian informasi data pribadi Anda yang dapat dipertanggung jawabkan secara hukum sebagaimana diminta dalam Platform (&ldquo;Data Pribadi&rdquo;). Informasi terkait Data Pribadi yang diberikan hanya akan digunakan oleh Rumah Sakit untuk pemberian layanan-layanan dalam Platform dan untuk tujuan lain yang telah Anda setujui sesuai dengan ketentuan perundang-undangan yang berlaku. Kebijakan Privasi yang terlampir (sebagaimana diperbarui dari waktu ke waktu) menjadi bagian yang tidak terpisahkan dari Ketentuan Penggunaan ini.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Setelah mendaftarkan diri pada Platform, Anda akan mendapatkan suatu link melalui email yang anda isikan dan menjadikan akun anda aktif. Kami harap Anda tidak menyerahkan, mengalihkan maupun memberikan wewenang kepada orang lain untuk menggunakan identitas atau menggunakan akun Anda. Anda wajib menjaga kerahasiaan kata sandi akun Anda dan setiap identifikasi yang kami berikan kepada Anda atas akun atau Data Pribadi Anda. Apabila terjadi pengungkapan atas kata sandi Anda yang terjadi bukan atas kesalahan Kami, dengan cara apapun yang mengakibatkan penggunaan yang tidak sah dan tanpa kewenangan atas akun atau Anda, transaksi maupun pesanan atas Layanan yang dilakukan melalui Platform masih akan dianggap sebagai transaksi yang sah kecuali apabila Anda telah memberitahu Kami tentang hal tersebut sebelum Penyedia Layanan memberikan Layanan yang diminta.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda memiliki tanggung jawab atas setiap penggunaan akun Anda dalam Platform. Apabila Anda tidak memiliki kontrol atas akun Anda oleh sebab apapun, maka Anda diharuskan untuk melaporkannya kepada Kami. Apabila terjadi penyalahgunaan akun Anda oleh orang lain sebelum pelaporan terjadi, maka penggunaan akun pada periode tersebut akan menjadi tanggung jawab Anda.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Anda tidak diperkenankan untuk membahayakan, menyalahgunakan, mengubah atau memodifikasi Platform dengan cara apapun. Kami dapat menutup atau membatalkan akun Anda dan melarang Anda untuk menggunakan Platform lebih lanjut jika Anda tidak mematuhi Ketentuan Penggunaan ini.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Dengan menggunakan Platform, maka Anda memahami, setuju, dan tunduk sesuai yang dipersyaratkan pada Kebijakan Privasi Kami sebagaimana berlaku dari waktu ke waktu.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda akan menggunakan Platform hanya untuk tujuan mendapatkan Layanan, dan tidak akan &nbsp;menyalahgunakan atau menggunakan Platform untuk aktivitas yang bertentangan dengan hukum, termasuk namun tidak terbatas kepada tindak pidana pencucian uang, pencurian, penggelapan, terorisme maupun penipuan. Anda juga sepakat bahwa Anda tidak akan melakukan pemesanan palsu melalui Platform dan tidak akan melakukan perbuatan melawan hukum melalui Platform.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Dengan memberikan informasi kepada Kami, Anda menyatakan bahwa Anda setuju bahwa informasi yang Anda berikan akan digunakan oleh Rumah Sakit.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Anda mengetahui dan setuju bahwa setiap informasi dalam bentuk apapun, termasuk namun tidak terbatas pada video, audio, gambar atau tulisan yang ada dalam Platform memiliki hak atas kekayaan intelektual (termasuk namun tidak terbatas kepada hak atas merek dan hak cipta) masing-masing. Anda tidak diperbolehkan untuk menggunakan, mengubah, memfasilitasi, menyebarluaskan dan/atau memutilasi hak atas kekayaan intelektual tersebut tanpa izin dari pemilik hak atas kekayaan intelektual tersebut sebagaimana diatur dalam peraturan perundang-undangan yang berlaku.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Pada saat mengakses dan menggunakan Platform termasuk setiap fitur dan layanannya, Anda tidak diperkenankan untuk:</span>
                      <ol style="list-style-type: lower-roman;">
                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>mengalihkan akun Anda di Platform kepada pihak lain tanpa persetujuan terlebih dahulu dari Kami.</span></li>
                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>menyebarkan virus, spam atau teknologi sejenis lainnya yang dapat merusak dan/atau merugikan Platform dan pengguna Platform lainnya.</span></li>
                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>memasukkan atau memindahkan fitur pada Platform tanpa persetujuan dari Kami.</span></li>
                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>menempatkan informasi atau aplikasi lain yang melanggar hak kekayaan intelektual pihak lain di dalam Platform.</span></li>
                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>mengambil atau mengumpulkan data pribadi dari pengguna Platform lain, termasuk tetapi tidak terbatas pada alamat surel, tanpa persetujuan dari pengguna tersebut.</span></li>
                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>menggunakan Platform untuk hal-hal yang dilarang berdasarkan hukum dan undang-undang yang berlaku.</span></li>
                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>menggunakan Platform untuk mendistribusikan iklan atau materi lainnya.</span></li>
                      </ol>
                    </li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Anda mengetahui dan menyetujui bahwa tarif Layanan yang tercantum pada Platform dapat mengalami perubahan.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: undefined;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>LAYANAN</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Fitur ini memfasilitasi para dokter, psikolog, dan/atau psikolog klinis yang terdaftar pada Rumah Sakit dan memiliki SIP, untuk berinteraksi dengan Anda melalui <em><span style='font-family:"Calibri",sans-serif;'>video call</span></em>, <em><span style='font-family:"Calibri",sans-serif;'>voice call</span></em> maupun <em><span style='font-family:"Calibri",sans-serif;'>chat</span></em> yang dapat diakses melalui Aplikasi dan Website.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda tidak dapat membatalkan <em><span style='font-family:"Calibri",sans-serif;'>booking</span></em> Chat dengan dokter, psikolog, atau psikolog klinis Kami. JIka ingin membatalkan, anda dapat menolak panggilan dari dokter kami. Konsekuensi dari proses ini adalah tidak adanya pengembalian dana sesuai dengan prosedur yang berlaku.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Dokter, psikolog, atau psikolog klinis Kami dapat membatalkan <em><span style='font-family:"Calibri",sans-serif;'>booking&nbsp;</span></em>Chat maksimal 30 (tiga puluh) menit sebelum jadwal untuk berkonsultasi dimulai. Kami akan menawarkan untuk perubahan jadwal seperti pengunduran waktu telekonsultasi, atau mengganti nya dengan dokter lain sesuai dengan prosedur yang berlaku.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Jika Anda tidak hadir pada jadwal <em><span style='font-family:"Calibri",sans-serif;'>booking</span></em> yang telah Anda pilih maka Anda menyetujui bahwa dana yang telah Anda bayarkan tidak dapat dikembalikan.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Kami akan mengirimkan pemberitahuan terkait janji Chat dengan Dokter melalui <em><span style='font-family:"Calibri",sans-serif;'>push notification</span></em> pada perangkat elektronik Anda. Untuk dapat menerima <em><span style='font-family:"Calibri",sans-serif;'>push notification</span></em> yang Kami kirimkan maka Anda harus mengaktifkan <em><span style='font-family:"Calibri",sans-serif;'>push notification</span></em> tersebut.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Anda mengetahui dan menyetujui bahwa fitur ini tidak menggantikan pemeriksaan dan pengobatan dengan dokter pada umumnya atau tatap muka secara langsung.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Kami tidak menyarankan Anda menggunakan Platform untuk kondisi medis darurat.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda memahami bahwa Anda perlu memberikan informasi dan menjelaskan gejala atau keluhan fisik yang Anda alami secara lengkap, jelas dan akurat ketika melakukan percakapan dengan dokter rekanan Kami melalui fitur Chat dengan Dokter.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: undefined;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>TRANSAKSI</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Untuk dapat bertransaksi di Platform, Anda dapat menggunakan berbagai metode pembayaran yang tersedia pada Platform.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Apabila Anda mencurigai adanya aktivitas yang tidak wajar dan/atau terjadi perselisihan/sengketa sehubungan dengan akun Anda, Anda dapat segera menghubungi Kami agar Kami dapat segera mengambil tindakan yang diperlukan.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Kami dapat melakukan penangguhan segala transaksi yang berasal dari akun Anda serta dapat melakukan tindakan penangguhan transaksi apabila kami mengidentifikasi adanya masalah pada akun Anda atau suatu transaksi tertentu.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda memahami dan menyetujui bahwa batas waktu pengajuan keluhan mengenai transaksi adalah maksimal 7 (tujuh) hari kalender setelah transaksi selesai.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: undefined;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>KETENTUAN TRANSAKSI</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol start="1" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:26px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>Fitur Video Call dan Chat dengan Dokter</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol style="list-style-type: lower-roman;margin-left:35px;">
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Anda akan dikenakan tarif dengan jumlah tertentu yang sudah di tentukan oleh pihak Rumah Sakit.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Saat menghubungi dokter melalui <em><span style=";">chat</span></em>, Anda dapat mengirimkan gambar kepada dokter yang berkaitan dengan kondisi medis Anda dengan format png, jpg, dan bitmap.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Setelah sesi Chat dengan Dokter selesai, dokter dapat memberikan <em><span style='font-family:"Calibri",sans-serif;'>Diagnosa&nbsp;</span></em>dan <em><span style='font-family:"Calibri",sans-serif;'>Electronic Prescription</span></em>.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Dokter dapat melakukan <em><span style='font-family:"Calibri",sans-serif;'>Follow Up&nbsp;</span></em>kepada Anda untuk mengecek kondisi kesehatan Anda setelah dilakukannya sesi Chat dengan Dokter.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Transaksi tidak dapat dibatalkan setelah sesi Chat dengan Dokter berakhir atau selesai dilakukan.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Kami dapat memblokir atau membatalkan akun Anda apabila terdapat penyalahgunaan fitur Chat dengan Dokter pada akun Anda.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Biaya yang dikenakan tersebut belum termasuk penggunaan pembayaran dengan metode : e-banking, m-banking..</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Ketepatan serta keakuratan Dokter dalam memberikan <em><span style='font-family:"Calibri",sans-serif;'>Electronic Prescription&nbsp;</span></em>akan bergantung pada informasi yang diberikan oleh Anda. Setiap isi dan/atau pernyataan-pernyataan dalam percakapan yang dilakukan oleh Anda dengan Dokter menggunakan fitur <em><span style=";">video call, chat, Diagnosa</span></em>, <em><span style='font-family:"Calibri",sans-serif;'>Electronic Prescription</span></em>, pada Platform, hal tersebut ialah percakapan dan interaksi pribadi antara Anda dengan Dokter rekanan sebagai pemberi jasa layanan kesehatan.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: undefined;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>HAK ATAS KEKAYAAN INTELEKTUAL</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Kami adalah pemilik atas nama, ikon, dan logo SI TUNTAS serta fitur Chat dengan Dokter, yang mana merupakan hak cipta dan merek dagang yang dilindungi undang-undang Republik Indonesia. Anda tidak dapat menggunakan, memodifikasi, atau memasang nama, ikon, logo, atau merek tersebut tanpa persetujuan tertulis dari Kami.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Seluruh hak atas kekayaan intelektual yang terdapat dalam Platform berdasarkan hukum negara Republik Indonesia, termasuk dalam hal ini adalah kepemilikan hak kekayaan intelektual atas seluruh <em><span style='font-family:"Calibri",sans-serif;'>source code</span></em> Platform dan hak kekayaan intelektual terkait Platform. Untuk itu, Anda dilarang untuk melakukan pelanggaran atas hak kekayaan intelektual yang terdapat pada Platform ini, termasuk melakukan modifikasi, karya turunan, mengadaptasi, menduplikasi, menyalin, menjual, membuat ulang, meretas, menjual, dan/atau mengeksploitasi Platform termasuk penggunaan Platform atas akses yang tidak sah, meluncurkan program otomatis atau script, atau segala program apapun yang mungkin menghambat operasi dan/atau kinerja Platform, atau dengan cara apapun memperbanyak atau menghindari struktur navigasi atau presentasi dari Platform atau isinya.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda hanya diperbolehkan untuk menggunakan Platform semata-mata untuk kebutuhan pribadi dan tidak dapat dialihkan.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Kami dapat mengambil tindakan hukum terhadap setiap pelanggaran yang dilakukan oleh Anda terkait dengan hak kekayaan intelektual terkait Platform.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: undefined;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>FUNGSI PLATFORM</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:18.0pt;font-size:16px;font-family:"Times New Roman",serif;margin-top:0cm;margin-bottom:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Kami senantiasa melakukan upaya untuk menjaga Platform ini berfungsi dan berjalan lancar. Perlu diketahui bahwa Platform dan/atau fitur Layanan Kami dapat sewaktu-waktu tidak tersedia yang disebabkan oleh berbagai alasan, termasuk namun tidak terbatas pada keperluan pemeliharaan atau masalah teknis, dan situasi ini berada di luar kuasa kami.&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol style="margin-bottom:0cm;list-style-type: undefined;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>PENUTUP</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Ketentuan Penggunaan ini diatur dan ditafsirkan serta dilaksanakan berdasarkan hukum yang berlaku di Negara Republik Indonesia dan Anda dengan tegas menyetujui bahwa bahwa ketentuan Pasal 1266 Kitab Undang-Undang Hukum Perdata dan ketentuan lainnya yang mewajibkan adanya pengesahan atau persetujuan pengadilan untuk dapat mengakhiri Ketentuan Penggunaan tidak berlaku terhadap Ketentuan Penggunaan ini.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Segala sengketa yang berkaitan dengan Ketentuan Penggunaan ini, diselesaikan secara musyawarah untuk mufakat atau melalui Badan Arbitrase Nasional Indonesia (BANI), sesuai dengan prosedur yang berlaku di BANI. Apabila kedua belah pihak tidak sepakat untuk menyelesaikannya sengketa di BANI, maka sengketa akan diselesaikan melalui Pengadilan Negeri Jakarta Selatan</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:center;vertical-align:baseline;'><strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>KEBIJAKAN PRIVASI</span></strong></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:center;vertical-align:baseline;'><strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>SI TUNTAS</span></strong></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Kebijakan privasi ini (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Kebijakan Privasi</span></strong>&rdquo;) akan menjelaskan bagaimana Rumah sakit yang di dukung oleh PT. Aplikanusa Lintasarta serta perusahaan afiliasinya (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Kami</span></strong>&rdquo;), memperoleh, mengumpulkan, menggunakan, menampilkan, mengumumkan, mengungkapkan, memproses, membukakan akses, menyimpan, mengirim, memberi, mengalihkan, mengolah, mengelola, memusnahkan dan melindungi informasi dan data pribadi (secara bersama-sama, &ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Pemanfaatan</span></strong>&rdquo;) yang anda sebagai pengguna (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Anda</span></strong>&rdquo;) Platform (sebagaimana didefinisikan di bawah) berikan sebagaimana diminta maupun pada saat menggunakan Platform (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Data Pribadi</span></strong>&rdquo;). Perlu dicatat bahwa Data Pribadi di sini tidak termasuk Data Pribadi yang telah tersedia di domain publik.&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Kebijakan Privasi ini merupakan bagian dari Syarat dan Ketentuan Penggunaan (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Ketentuan Penggunaan</span></strong>&rdquo;) Kami. Penggunaan Platform dan setiap fitur dan/atau layanan yang tersedia dalam Platform (&ldquo;<strong><span style='font-family:"Calibri",sans-serif;'>Layanan</span></strong>&rdquo;) merupakan bentuk persetujuan anda terhadap Ketentuan Penggunaan dan Kebijakan Privasi tersebut. Oleh karena itu, Anda perlu untuk membaca Kebijakan Privasi ini dengan saksama untuk memastikan bahwa Anda memahaminya sepenuhnya sebelum mendaftar, mengakses dan/atau menggunakan Platform dan Layanan Kami.&nbsp;</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol start="1" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>Lingkup Kebijakan Privasi</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol style="list-style-type: decimal;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Kebijakan Privasi ini mengatur Pemanfaatan Data Pribadi.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Dengan menggunakan Platform, maka Anda dianggap telah membaca Kebijakan Privasi ini dan menyetujui mekanisme Pemanfaatan Data Pribadi Anda sebagaimana diatur dalam Kebijakan Privasi ini.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Apabila Kami meminta Anda untuk memberikan informasi ketika menggunakan Platform, maka informasi tersebut itu hanya akan digunakan untuk keperluan pemberian Layanan sesuai dengan Kebijakan Privasi ini.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Kami berhak untuk sewaktu-waktu mengubah, menghapus dan untuk menerapkan ketentuan baru Kebijakan Privasi ini. Anda diharapkan untuk memeriksa halaman Kebijakan Privasi ini secara berkala untuk mengetahui perubahan tersebut. Dengan menggunakan Platform setelah terjadinya perubahan tersebut, Anda dianggap telah mengetahui dan menyetujui perubahan-perubahan ketentuan pada Kebijakan Privasi ini.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol start="2" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>Registrasi</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol style="list-style-type: decimal;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda diharuskan melakukan pendaftaran dalam Platform untuk dapat menggunakan fitur &ndash; fitur pada Platform.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Untuk melakukan pendaftaran dalam Platform, Anda harus memberikan informasi yang Kami perlukan sebagaimana tercantum pada Poin C (Data Pribadi) di bawah ini.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol start="3" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>Data Pribadi</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol style="list-style-type: decimal;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda mengetahui dan menyetujui bahwa Kami mengumpulkan informasi pribadi yang diberikan Anda saat Anda membuat akun dan profil maupun pada saat menggunakan fitur-fitur yang terdapat dalam Platform.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Informasi mengenai identitas diri yang wajib diisi oleh Anda saat membuat akun di Platform antara lain adalah:</span></li>
                  </ol>
                  <ol style="list-style-type: lower-roman;margin-left:48.5px;">
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Nama lengkap sesuai kartu identitas yang berlaku (KTP atau Paspor);&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Tempat dan Tanggal Lahir;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Jenis Kelamin;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Nomor telepon genggam;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Alamat / domisili; dan</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Alamat Email</span></li>
                  </ol>
                  <ol style="list-style-type: undefined;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda dapat mengaktifkan atau menonaktifkan layanan pengenalan lokasi saat Anda menggunakan Platform.&nbsp;</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Apabila diperlukan, Kami dapat melakukan verifikasi langsung kepada Anda tentang data diri yang telah Anda sampaikan melalui Platform.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Informasi yang Anda berikan adalah akurat dan benar.</span></li>
                  </ol>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol start="4" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>Data <em><span style='font-family:"Calibri",sans-serif;'>Chat</span></em>, <em><span style='font-family:"Calibri",sans-serif;'>Video Call</span></em> dan <em><span style='font-family:"Calibri",sans-serif;'>Voice Call&nbsp;</span></em>Pada Fitur Chat dengan Dokter&nbsp;</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:18.0pt;font-size:16px;font-family:"Times New Roman",serif;margin-top:0cm;margin-bottom:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Untuk kenyamanan Anda dalam berinteraksi dengan Dokter, tersedia layanan <em><span style='font-family:"Calibri",sans-serif;'>chat</span></em> (yang mana Anda juga dapat mengirimkan gambar kepada dokter yang berkaitan dengan kondisi medis),<em><span style='font-family:"Calibri",sans-serif;'>&nbsp;video call</span></em> dalam Platform. Anda mengetahui dan menyetujui bahwa untuk keperluan <em><span style='font-family:"Calibri",sans-serif;'>review</span></em>, layanan <em><span style='font-family:"Calibri",sans-serif;'>video call</span></em> dan <em><span style='font-family:"Calibri",sans-serif;'>voice call</span></em> akan secara otomatis direkam dan <em><span style='font-family:"Calibri",sans-serif;'>chat history</span></em> juga akan disimpan.</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol start="5" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>Koneksi Anda Ke Platform Lain</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:18.0pt;font-size:16px;font-family:"Times New Roman",serif;margin-top:0cm;margin-bottom:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Platform dapat memuat tautan menuju platform milik pihak ketiga (&ldquo;Platform Pihak Ketiga&rdquo;) dan konten pihak ketiga (&ldquo;Konten Pihak Ketiga&rdquo;). Untuk keamanan Anda, Anda perlu mempelajari dan membaca dengan hati-hati kebijakan penanganan informasi pribadi yang berlaku di Platform Pihak Ketiga dan/atau Konten Pihak Ketiga.</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol start="6" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>Hukum Yang Berlaku</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:18.0pt;font-size:16px;font-family:"Times New Roman",serif;margin-top:0cm;margin-bottom:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Kebijakan Privasi ini diatur berdasarkan hukum Negara Republik Indonesia dan Anda diwajibkan tunduk kepada semua peraturan yang berlaku di Republik Indonesia.</span></p>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                    <ol start="7" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:8px;">
                      <li style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Calibri",sans-serif;'>Upaya Pengamanan</span></li>
                    </ol>
                  </div>
                  <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                  <ol style="list-style-type: decimal;margin-left:26px;">
                    <li><span style='font-family:"Calibri",sans-serif;'>Kami akan berupaya memastikan bahwa informasi yang Anda berikan kepada Kami aman dan tidak dapat digunakan oleh pihak-pihak yang tidak bertanggung jawab. Untuk keamanan data Anda, Kami sangat menyarankan agar Anda selalu memperbarui Platform dan perangkat lunak anda serta tidak mengungkapkan kata sandi anda kepada pihak manapun.</span></li>
                    <li><span style='font-family:"Calibri",sans-serif;'>Anda dengan ini setuju bahwa Kami dapat menyimpan Data Pribadi pada server yang terletak di pusat data yang ditunjuk oleh Kami. Pemanfaatan Data Pribadi sehubungan dengan penggunaan Platform akan terus diatur oleh Kebijakan Privasi ini sesuai dengan peraturan perundangan-undangan yang berlaku di Republik Indonesia.&nbsp;</span></li>
                  </ol>
                </div>
                <hr>
                <input type="checkbox" value="" id="tac_checkbox" disabled> <label for="tac_checkbox"><b>Saya menyetujui syarat dan ketentuan penggunaan</b></label>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="simpan_tac" disabled>Simpan</button>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
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
  <script src="<?php echo base_url('assets/dashboard/js/jquery-3.2.1.min.js'); ?>"></script>
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

  <!--firebase-->
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-database.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-messaging.js"></script>

  <script>
    baseUrl = '<?php echo base_url(); ?>';

    var firebaseConfig = {
      apiKey: "AIzaSyD936QRnRMkq02IgQ1kMg5ZYB1hEcuTwUM",
      authDomain: "telehealth-6a164.firebaseapp.com",
      databaseURL: "https://telehealth-6a164.firebaseio.com",
      projectId: "telehealth-6a164",
      storageBucket: "telehealth-6a164.appspot.com",
      messagingSenderId: "513400070049",
      appId: "1:513400070049:web:7da9b8978395a153a875e0"
    };
    firebase.initializeApp(firebaseConfig);
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
      console.log(payload);
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
            if (path.includes('dokter/teleconsultasi/proses_teleconsultasi')) {
              $('input[name=berat_badan]').val(JSON.parse(payload.data.body).berat_badan);
              $('input[name=tinggi_badan]').val(JSON.parse(payload.data.body).tinggi_badan);
              $('input[name=suhu]').val(JSON.parse(payload.data.body).suhu);
              $('input[name=tekanan_darah]').val(JSON.parse(payload.data.body).tekanan_darah);
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
            }
          }
        }

        if (JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_berakhir_pasien')) {
          location.href = "<?php echo base_url('pasien/Pasien') ?>";
        }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'vp')) {
          $("#isinotifmodal").text(JSON.parse(payload.data.body).keterangan);
          $("#ModalNotif").modal('show');
          setTimeout(function() {
            $('#ModalNotif').modal('hide');
          }, 3000);
        }
        if (JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_dokter')) {
          $('#memanggil').modal('hide');
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

  <?php if ($user_2 && $user_2->id_user_kategori == 0) { ?>
    <script>
    $(document).ready(function() {
      $('#tac_modal').modal('show');
      $('#tac_body').scroll(function(e){
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            $('#tac_checkbox').prop('disabled', false);
        }
      });
      $('#tac_checkbox').change(function(e){
        if(this.checked){
          $('#simpan_tac').prop('disabled', false);
          $('#simpan_tac').removeClass('btn-secondary').addClass('btn-primary');
        }
        else{
          $('#simpan_tac').prop('disabled', true);
          $('#simpan_tac').removeClass('btn-primary').addClass('btn-secondary');
        }
      });

      $('#simpan_tac').click(function(e){
        $.ajax({
          method: 'GET',
          url: baseUrl + "pasien/Pasien/accept_tac",
          success: function(data) {
            $('#tac_modal').modal('hide');
            alert('Terima kasih, anda telah menyetujui syarat dan ketentuan penggunaan!');
          },
          error: function(data) {
            return false;
          }
        });
      });
    });
    </script>
  <?php } ?>

  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

</body>

</html>