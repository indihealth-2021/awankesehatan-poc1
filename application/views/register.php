<!DOCTYPE html>
<html lang="en">

<head>
  <title>Telemedicine | Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/open-iconic-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/animate.css') ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/owl.carousel.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/owl.theme.default.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/magnific-popup.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/aos.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/ionicons.min.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/bootstrap-datepicker.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/jquery.timepicker.css'); ?>">

  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
      <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=id-ID"></script>
  <!-- Font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Sans" />
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
  <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/website/css/font-ooredoo.css">

  <!-- CSS only -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/flaticon.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/icomoon.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/style.css'); ?>">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light font-ubuntu" id="ftco-navbar" style="border-bottom:1px; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.25);">
    <div class="container">
      <a class="navbar-brand" href="<?php echo base_url('Home'); ?>"><img src="<?php echo base_url('assets/telemedicine/img/logo.png') ?>" class="img-brand"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="<?php echo base_url('Home'); ?>" class="nav-link">Beranda</a></li>
          <li class="nav-item"><a href="<?php echo base_url('Home'); ?>#layanan" class="nav-link">Layanan</a></li>
          <li class="nav-item"><a href="<?php echo base_url('Home'); ?>#mitra-dokter2" class="nav-link">Mitra Dokter</a></li>
          <li class="nav-item"><a href="<?php echo base_url('Home'); ?>#news" class="nav-link">Berita</a></li>
          <li class="nav-item"><a href="#footer" class="nav-link">Kontak</a></li>
          <li class="nav-item cta"><a href="<?php echo base_url('Login'); ?>" class="nav-link">Login</a></li>
          <li class="nav-item cta cta-regis"><a href="<?php echo base_url('register'); ?>" class="nav-link">Register</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->
  <div style="padding-top: 120px" class="d-mobile-none">
  </div>
  <section class="ftco-section ftco-services py-5">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-5">
        <div class="col-lg-7 font-bold-black font-ubuntu pt-5">
          <div class="mx-auto">
            <p class="font-24 font-bold-black">Telekonsultasi</p>
            <p class="font-14">Layanan Kesehatan Mulai Dari Konsultasi, Diagnosis Hingga Tindakan Medis, Tanpa Terbatas Ruang Atau Dilaksanakan Dari Jarak Jauh.</p>
          </div>
          <img src="<?php echo base_url('assets/website/images/illustration_1.png'); ?>" class="img-login mb-5">
        </div>
        <div class="col-lg-5">
          <div>
            <p class="font-16 font-bold-black font-notosans">Selamat Datang</p>
            <p class="font-24 font-bold-black font-ooredoo">Buat Akun Kamu Disini</p>
            <div class="font-notosans">
              <?php $old = $this->session->flashdata('data_regis'); ?>

              <form action="<?php echo base_url('Register/register') ?>" method="POST" onsubmit="return ubah();">
                <?php if ($this->session->flashdata('msg')) {
                  echo '<div class="alert-danger border pb-1">' . $this->session->flashdata('msg') . '</div>';
                } ?>
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <div class="input-icon">
                  <input type="text" class="form-control" <?php echo $old ? ' value="' . $old['name'] . '" ' : ' '; ?>id="name" name="name" size="35" maxlength="35" placeholder="Masukan Nama">
                  <!-- <i class="fa fa-user"></i> -->
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="19" viewBox="0 0 16 19" fill="none">
                      <path d="M10.5984 11.6264C10.4824 11.588 9.7495 11.2535 10.2075 9.84376H10.2009C11.3947 8.5987 12.307 6.59524 12.307 4.6228C12.307 1.58992 10.3154 0 8.00073 0C5.6846 0 3.70392 1.58918 3.70392 4.6228C3.70392 6.60337 4.61112 8.61495 5.81222 9.85705C6.2804 11.1006 5.44321 11.5622 5.26819 11.6272C2.84412 12.5148 0 14.1328 0 15.7301V16.329C0 18.5052 4.167 19 8.02334 19C11.8855 19 16 18.5052 16 16.329V15.7301C16 14.0848 13.142 12.4793 10.5984 11.6264Z" fill="#999999" />
                    </svg></i>
                </div>
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <div class="input-icon">
                  <input required type="text" class="form-control" id="username" <?php if (!empty($old)) {
                                                                                    echo "value='" . $old['username'] . "'";
                                                                                  } ?> name="username" placeholder="Masukan Username">
                  <!-- <i class="fa fa-user"></i> -->
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="19" viewBox="0 0 16 19" fill="none">
                      <path d="M10.5984 11.6264C10.4824 11.588 9.7495 11.2535 10.2075 9.84376H10.2009C11.3947 8.5987 12.307 6.59524 12.307 4.6228C12.307 1.58992 10.3154 0 8.00073 0C5.6846 0 3.70392 1.58918 3.70392 4.6228C3.70392 6.60337 4.61112 8.61495 5.81222 9.85705C6.2804 11.1006 5.44321 11.5622 5.26819 11.6272C2.84412 12.5148 0 14.1328 0 15.7301V16.329C0 18.5052 4.167 19 8.02334 19C11.8855 19 16 18.5052 16 16.329V15.7301C16 14.0848 13.142 12.4793 10.5984 11.6264Z" fill="#999999" />
                    </svg></i>
                </div>

                <label for="exampleFormControlInput1" class="form-label">Card Number</label>
                <div class="input-icon">
                  <input required type="number" class="form-control" id="card_number" <?php if (!empty($old)) {
                                                                                    echo "value='" . $old['card_number'] . "'";
                                                                                  } ?> name="card_number" placeholder="Masukan Card Number" min="0">
                  <!-- <i class="fa fa-user"></i> -->
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="19" viewBox="0 0 16 19" fill="none">
                      <path d="M10.5984 11.6264C10.4824 11.588 9.7495 11.2535 10.2075 9.84376H10.2009C11.3947 8.5987 12.307 6.59524 12.307 4.6228C12.307 1.58992 10.3154 0 8.00073 0C5.6846 0 3.70392 1.58918 3.70392 4.6228C3.70392 6.60337 4.61112 8.61495 5.81222 9.85705C6.2804 11.1006 5.44321 11.5622 5.26819 11.6272C2.84412 12.5148 0 14.1328 0 15.7301V16.329C0 18.5052 4.167 19 8.02334 19C11.8855 19 16 18.5052 16 16.329V15.7301C16 14.0848 13.142 12.4793 10.5984 11.6264Z" fill="#999999" />
                    </svg></i>
                </div>

                <label for="exampleFormControlInput1" class="form-label">Nomor Telepon</label>
                <div class="input-icon">
                  <input required type="number" class="form-control" <?php echo $old ? ' value="' . $old['telp'] . '" ' : ' '; ?>id="telp" name="telp" placeholder="Masukan Nomor Telepon">
                  <!-- <i class="fas fa-phone-alt"></i> -->
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M1.76714 0.511147C1.93118 0.336436 2.12815 0.200905 2.34501 0.113537C2.56187 0.0261686 2.79366 -0.0110424 3.02502 0.00436978C3.25638 0.019782 3.48203 0.0874655 3.68701 0.202935C3.89199 0.318404 4.07163 0.479023 4.21402 0.674147L5.89683 2.98015C6.20527 3.40315 6.31402 3.95415 6.19214 4.47415L5.67933 6.66415C5.65281 6.77758 5.65425 6.89639 5.68349 7.00906C5.71273 7.12172 5.76878 7.22441 5.8462 7.30715L8.14964 9.76415C8.2273 9.8469 8.32373 9.90679 8.42953 9.93798C8.53534 9.96918 8.64691 9.97061 8.75339 9.94215L10.8056 9.39515C11.0462 9.33099 11.2973 9.326 11.5399 9.38057C11.7826 9.43514 12.0104 9.54784 12.2062 9.71015L14.3681 11.5041C15.1453 12.1491 15.2165 13.3741 14.5209 14.1151L13.5515 15.1491C12.8578 15.8891 11.8209 16.2141 10.8543 15.8511C8.38044 14.9227 6.13427 13.412 4.28245 11.4311C2.42554 9.45616 1.00927 7.06061 0.138703 4.42215C-0.200672 3.39215 0.104016 2.28515 0.797766 1.54515L1.76714 0.511147Z" fill="#999999" />
                    </svg></i>
                </div>
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <div class="input-icon">
                  <input required type="email" class="form-control" <?php if ($old) {
                                                                      echo "value='" . $old['email'] . "'";
                                                                    } ?> id="email" name="email" placeholder="Masukan Email">
                  <!-- <i class="fas fa-envelope"></i> -->
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="21" height="17" viewBox="0 0 21 17" fill="none">
                      <path d="M17.2084 0.833496H3.79175C3.02925 0.833496 2.29798 1.1364 1.75882 1.67556C1.21965 2.21473 0.916748 2.946 0.916748 3.7085V13.2918C0.916748 14.0543 1.21965 14.7856 1.75882 15.3248C2.29798 15.8639 3.02925 16.1668 3.79175 16.1668H17.2084C17.9709 16.1668 18.7022 15.8639 19.2413 15.3248C19.7805 14.7856 20.0834 14.0543 20.0834 13.2918V3.7085C20.0834 2.946 19.7805 2.21473 19.2413 1.67556C18.7022 1.1364 17.9709 0.833496 17.2084 0.833496ZM17.2084 2.75016L10.9792 7.03391C10.8336 7.11802 10.6683 7.1623 10.5001 7.1623C10.3319 7.1623 10.1666 7.11802 10.0209 7.03391L3.79175 2.75016H17.2084Z" fill="#999999" />
                    </svg></i>
                </div>
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <span class="badge badge-warning">Kata sandi min 8 karakter dan harus kombinasi huruf<br> kapital, kecil, dan karakter khusus.</span>
                <div class="input-icon">
                  <input required type="password" class="form-control" min="8" id="password" name="password" placeholder="Masukan Password">
                  <!-- <i class="fa fa-lock"></i> -->
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                      <path d="M14.1667 6.66667H16.0556C16.306 6.66667 16.5463 6.76701 16.7234 6.94561C16.9005 7.12422 17 7.36646 17 7.61905V19.0476C17 19.3002 16.9005 19.5424 16.7234 19.7211C16.5463 19.8997 16.306 20 16.0556 20H0.944444C0.693962 20 0.453739 19.8997 0.276621 19.7211C0.0995036 19.5424 0 19.3002 0 19.0476V7.61905C0 7.36646 0.0995036 7.12422 0.276621 6.94561C0.453739 6.76701 0.693962 6.66667 0.944444 6.66667H2.83333V5.71429C2.83333 4.19876 3.43036 2.74531 4.49306 1.67368C5.55577 0.602039 6.99711 0 8.5 0C10.0029 0 11.4442 0.602039 12.5069 1.67368C13.5696 2.74531 14.1667 4.19876 14.1667 5.71429V6.66667ZM12.2778 6.66667V5.71429C12.2778 4.70394 11.8798 3.73497 11.1713 3.02055C10.4628 2.30612 9.50193 1.90476 8.5 1.90476C7.49807 1.90476 6.53718 2.30612 5.82871 3.02055C5.12024 3.73497 4.72222 4.70394 4.72222 5.71429V6.66667H12.2778ZM7.55556 12.381V14.2857H9.44444V12.381H7.55556ZM3.77778 12.381V14.2857H5.66667V12.381H3.77778ZM11.3333 12.381V14.2857H13.2222V12.381H11.3333Z" fill="#999999" />
                    </svg></i>
                </div>
                <label for="exampleFormControlInput1" class="form-label">Konfirmasi Password</label>
                <div class="input-icon">
                  <input required type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Konfirmasi Password">
                  <!-- <i class="fa fa-lock"></i> -->
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                      <path d="M14.1667 6.66667H16.0556C16.306 6.66667 16.5463 6.76701 16.7234 6.94561C16.9005 7.12422 17 7.36646 17 7.61905V19.0476C17 19.3002 16.9005 19.5424 16.7234 19.7211C16.5463 19.8997 16.306 20 16.0556 20H0.944444C0.693962 20 0.453739 19.8997 0.276621 19.7211C0.0995036 19.5424 0 19.3002 0 19.0476V7.61905C0 7.36646 0.0995036 7.12422 0.276621 6.94561C0.453739 6.76701 0.693962 6.66667 0.944444 6.66667H2.83333V5.71429C2.83333 4.19876 3.43036 2.74531 4.49306 1.67368C5.55577 0.602039 6.99711 0 8.5 0C10.0029 0 11.4442 0.602039 12.5069 1.67368C13.5696 2.74531 14.1667 4.19876 14.1667 5.71429V6.66667ZM12.2778 6.66667V5.71429C12.2778 4.70394 11.8798 3.73497 11.1713 3.02055C10.4628 2.30612 9.50193 1.90476 8.5 1.90476C7.49807 1.90476 6.53718 2.30612 5.82871 3.02055C5.12024 3.73497 4.72222 4.70394 4.72222 5.71429V6.66667H12.2778ZM7.55556 12.381V14.2857H9.44444V12.381H7.55556ZM3.77778 12.381V14.2857H5.66667V12.381H3.77778ZM11.3333 12.381V14.2857H13.2222V12.381H11.3333Z" fill="#999999" />
                    </svg></i>
                </div>
                <label for="exampleFormControlInput1" class="form-label">Tempat Tanggal Lahir</label>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Tempat</label>
                    <input required="" class="form-control" name="lahir_tempat" <?php echo $old ? ' value="' . $old['lahir_tempat'] . '" ' : ' '; ?>placeholder="Tempat Lahir">
                  </div>
                  <div class="col-lg-6">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                    <input required="" type="date" class="form-control" min="1500-01-01" max="<?php echo (new DateTime('now'))->format('Y-m-d'); ?>" name="lahir_tanggal" id="tanggal" <?php echo $old ? ' value="' . $old['lahir_tanggal'] . '" ' : ' '; ?>onchange="setDay()">
                  </div>
                </div>

                <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                  <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline1" value="Laki-laki" <?php if ($old) {
                                                                                                                  echo strtolower($old['jenis_kelamin']) == 'laki-laki' ? 'checked' : '';
                                                                                                                } ?>>
                  <label class="form-check-label ml-3" for="optionsRadiosInline1"> Laki-laki</label>
                </div>
                <div class="form-check form-check-inline ml-5">
                  <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline2" value="Perempuan" <?php if ($old) {
                                                                                                                  echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : '';
                                                                                                                } ?>>
                  <label class="form-check-label ml-3" for="optionsRadiosInline2"> Perempuan</label>
                </div>
                <hr>
                <div align='center'>
                <div class="g-recaptcha form-field" data-sitekey='<?= $this->config->item('recaptcha_site_key') ?>'></div>
                </div>
                <div class="mb-3 mt-4">
                  <input type="hidden" name="id_user_kategori" value="0">
                  <button type="submit" class="btn btn-login btn-block">Daftar</button>
                </div>
                <div class="mb-3 font-14 text-center">
                  Sudah Punya Akun ? <a href="<?php echo base_url('Login'); ?>" class="font-14 font-tele font-bold">Login disini !</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>

  <footer class="footer pt-4 footer-baru" id="footer">
    <div class="col-md-11 mx-auto">
      <div class="col-lg-12 py-5">
        <div class="row">
          <div class="col-lg-4">
            <p class="font-12 text-powered">Powered By</p>
            <div class="row">
              <img src="<?php echo base_url('assets/telemedicine/img/ooredoo.png') ?>" class="img-logo-footer">
              <!-- <img src="<?php echo base_url('assets/telemedicine/img/logo.png') ?>" class="ml-4 img-logo-footer"> -->
            </div>
          </div>
          <div class="col-lg-3">
            <p class="font-bold font-tele">Site Map</p>
            <div class="font-18">
              <span><a href="<?php echo base_url('Faq'); ?>" class="font-black">FAQ</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#beranda" class="font-black">Beranda</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#layanan" class="font-black">Layanan Kami</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#mitra-dokter-2" class="font-black">Mitra Dokter</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#news" class="font-black">Berita</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#footer" class="font-black">Kontak</a></span>
            </div>
          </div>
          <div class="col-lg-5">
            <p class="font-bold font-tele">Hubungi Kami</p>
            <div class="font-black font-18 text-justify">
                <span>Jl. Medan Merdeka Barat N0. 21, RT.2/RW.3</span><br>
                <span>Gambir, Kecamatan Gambir, Kota Jakarta Pusat</span><br>
                <span>Daerah Khusus Ibukota Jakarta 10110</span><br>
                <span></span><br>
                <span>Telp : +622130003000</span><br>
            </div>
          </div>
          <!-- <div class="col-lg-3 font-18 text-right">
            <p class="font-bold font-tele">Temukan Kami</p>
            <a href="#"><img src="<?php echo base_url('assets/telemedicine/img/playstore.png') ?>" class="img-playstore"></a>
          </div> -->
        </div>
      </div>
    </div>
    <div class="col-md-12 text-center p-1" style="background: #59A799;">
      <span class="font-12 text-white font-droid">Version 1.0 Copyright © 2020. Lintasarta & Indosat. All rights reserved.</span>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#59A799" />
    </svg></div>

  <script src="<?php echo base_url('assets/website/js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery-migrate-3.0.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.easing.1.3.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.waypoints.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.stellar.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/owl.carousel.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.magnific-popup.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/aos.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.animateNumber.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/bootstrap-datepicker.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.timepicker.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/scrollax.min.js'); ?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?php echo base_url('assets/website/js/google-map.js'); ?>"></script>
  <script src="<?php echo base_url('assets/website/js/main.js'); ?>"></script>
  <script>
    function ubah() {
      var password_baru = document.getElementById('password').value;
      var konfirmasi_password = document.getElementById('confirm_pass').value;

      if (password_baru.length < 8) {
        alert('Password minimal berisi 8 karakter!')
        // event.preventDefault();
        return false;
      } else {
        if (password_baru != konfirmasi_password) {
          alert('Password dan Konfirmasi Password Baru tidak sama!');
          // event.preventDefault();
          return false;
        } else {
          return true;
        }
      }
    }
  </script>

  <?php if ($this->session->flashdata('msg_regis')) {
    echo "<script>alert('" . $this->session->flashdata('msg_regis') . "')</script>";
  } ?>

  <script>
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var password = document.getElementById('password');

    username.onkeyup = function() {
      this.value = this.value.toLowerCase();
      this.value = this.value.replace(' ', '');
    }

    email.onkeyup = function() {
      this.value = this.value.toLowerCase();
      this.value = this.value.replace(' ', '');
    }
    window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
  </script>

</body>

</html>
