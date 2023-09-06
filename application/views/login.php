<!DOCTYPE html>
<html lang="en">

<head>
  <title>Telemedicine | Login</title>
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
  <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=id-ID"></script>
  <style>
    #g-recaptcha-response {
      display: block !important;
      position: absolute;
      margin: -78px 0 0 0 !important;
      width: 302px !important;
      height: 76px !important;
      z-index: -999999;
      opacity: 0;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light font-ubuntu" id="ftco-navbar" style="border-bottom:1px; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.25);">
    <div class="container">
      <a class="navbar-brand" href="<?php echo base_url('Home'); ?>">
        <?php
        $imageFormats = ['png', 'jpeg', 'jpg', 'jfif', 'gif'];
        foreach ($imageFormats as $format) {
          $imagePath = './assets/images/logo/logo.' . $format;
          if (file_exists($imagePath)) {
            echo '<img class="img-brand" src="' . base_url($imagePath) . '" alt="">';
            break;
          }
        }
        ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="<?php echo base_url('Home#beranda'); ?>" class="nav-link">Beranda</a></li>
          <li class="nav-item"><a href="<?php echo base_url('Home'); ?>#layanan" class="nav-link">Layanan</a></li>
          <li class="nav-item"><a href="<?php echo base_url('Home'); ?>#mitra-dokter-2" class="nav-link">Mitra Dokter</a></li>
          <li class="nav-item"><a href="<?php echo base_url('Home'); ?>#news" class="nav-link">Berita</a></li>
          <li class="nav-item"><a href="#footer" class="nav-link">Kontak</a></li>
          <li class="nav-item  active cta"><a href="<?php echo base_url('Login'); ?>" class="nav-link">Login</a></li>
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
        <div class="col-lg-7 font-bold-black font-ubuntu">
          <div class="mx-auto">
            <p class="font-24 font-bold-black">Telekonsultasi</p>
            <p class="font-14">Layanan Kesehatan Mulai Dari Konsultasi, Diagnosis Hingga Tindakan Medis, Tanpa Terbatas Ruang Atau Dilaksanakan Dari Jarak Jauh.</p>
          </div>
          <img src="<?php echo base_url('assets/website/images/illustration_1.png'); ?>" class="img-login mb-5">
        </div>
        <div class="col-lg-5">
          <div>
            <p class="font-16 font-bold-black font-notosans">Selamat Datang</p>
            <p class="font-24 font-bold-black font-ooredoo-reg">Login Dengan Akun Kamu</p>
            <div class="font-notosans">
              <form action="<?php echo base_url('Login/login') ?>" method="POST">
                <?php if ($this->session->flashdata('msg_login')) {
                  $isSukses = $this->session->flashdata('msg_login_sukses') ? 'alert-success' : 'alert-danger';
                  echo '<div class="' . $isSukses . ' border pb-1">' . $this->session->flashdata('msg_login') . '</div>';
                } ?>
                <label class="form-label">Username / Card Number</label>
                <div class="input-icon">
                  <input required type="text" autocomplete="off" class="form-control" name="email" placeholder="Masukan Username / Card Number">
                  <!-- <i class="fa fa-user"></i> -->
                  <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="19" viewBox="0 0 16 19" fill="none">
                      <path d="M10.5984 11.6264C10.4824 11.588 9.7495 11.2535 10.2075 9.84376H10.2009C11.3947 8.5987 12.307 6.59524 12.307 4.6228C12.307 1.58992 10.3154 0 8.00073 0C5.6846 0 3.70392 1.58918 3.70392 4.6228C3.70392 6.60337 4.61112 8.61495 5.81222 9.85705C6.2804 11.1006 5.44321 11.5622 5.26819 11.6272C2.84412 12.5148 0 14.1328 0 15.7301V16.329C0 18.5052 4.167 19 8.02334 19C11.8855 19 16 18.5052 16 16.329V15.7301C16 14.0848 13.142 12.4793 10.5984 11.6264Z" fill="#999999" />
                    </svg></i>
                </div>
                <label class="form-label">Password</label>
                <div class="input-icon">
                  <input required type="password" autocomplete="off" class="form-control" id="pass" name="password" placeholder="Masukan Password">
                  <!-- <i class="fa fa-lock"></i> -->

                  <i id="mybutton" onclick="change()"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off">
                      <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                      <line x1="1" y1="1" x2="23" y2="23" />
                    </svg></i>
                </div>
                <hr>
                <div align='center'>
                  <div class="g-recaptcha form-field" data-sitekey='<?= $this->config->item('recaptcha_site_key') ?>'></div>
                </div>
                <div class="form-check">
                  <input class="form-check-input mt-3" type="checkbox" name="remember_me" value="true" id="flexCheckDefault">
                  <label class="form-check-label mt-2 font-14 font-bold-black" for="flexCheckDefault">
                    Ingat Saya
                  </label>
                </div>
                <div class="mb-3">
                  <a href="<?php echo base_url('ForgotPassword'); ?>" class="font-14 font-tele font-bold">Lupa Password ?</a>
                </div>
                <div class="mb-3">
                  <!-- <a href="<?php echo base_url('Login'); ?>" type="submit" class="btn btn-login btn-block">Masuk</a> -->
                  <button type="submit" class="btn btn-login btn-block">Masuk</button>
                </div>
                <div class="mb-3 font-14 text-center">
                  Belum Punya Akun ? <a href="<?php echo base_url('register'); ?>" class="font-14 font-tele font-bold">Registrasi disini !</a>
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
              <!--<img src="<?php echo base_url('assets/telemedicine/img/ooredoo.png') ?>" class="img-logo-footer">-->
              <img src="<?php echo base_url('assets/telemedicine/img/owlexa.png') ?>" style="width:150px; height: auto">
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


  <?php if ($this->session->flashdata('msg_regis')) {
    echo "<script>alert('" . $this->session->flashdata('msg_regis') . "')</script>";
  } ?>
  <?php if ($this->session->flashdata('msg_forgot_pass')) {
    echo "<script>alert('" . $this->session->flashdata('msg_forgot_pass') . "')</script>";
  } ?>

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
  <!-- <script type="text/javascript">
    function ubah_warna(warna)
    {
    var latar = document.getElementById(warna).style.backgroundColor;

    if(latar!="white")
    document.getElementById(warna).style.backgroundColor = "white";
    else
    document.getElementById(warna).style.backgroundColor = warna;
    }
  </script> -->
  <script type="text/javascript">
    function change() {
      var x = document.getElementById('pass').type;

      if (x == 'password') {
        document.getElementById('pass').type = 'text';
        document.getElementById('mybutton').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M16.8099 8.76514C15.1249 5.65014 12.1699 3.76514 8.89986 3.76514C5.62986 3.76514 2.66986 5.65014 0.999863 8.76514L0.859863 9.00014L0.989863 9.24014C2.67486 12.3551 5.62986 14.2401 8.89986 14.2401C12.1699 14.2401 15.1299 12.3801 16.8099 9.24014L16.9399 9.00014L16.8099 8.76514ZM8.89986 13.2151C6.08486 13.2151 3.49986 11.6451 1.99986 9.00014C3.49986 6.35514 6.08486 4.78514 8.89986 4.78514C11.7149 4.78514 14.2699 6.36014 15.7949 9.00014C14.2699 11.6451 11.7099 13.2151 8.89986 13.2151Z" fill="#999999"/><path d="M9.04523 12.445C10.9396 12.445 12.4752 10.9093 12.4752 9.01496C12.4752 7.12062 10.9396 5.58496 9.04523 5.58496C7.1509 5.58496 5.61523 7.12062 5.61523 9.01496C5.61523 10.9093 7.1509 12.445 9.04523 12.445Z" fill="#999999"/></svg>';
      } else {
        document.getElementById('pass').type = 'password';
        document.getElementById('mybutton').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';
      }
    }
    window.onload = function() {
      var $recaptcha = document.querySelector('#g-recaptcha-response');

      if ($recaptcha) {
        $recaptcha.setAttribute("required", "required");
      }
    };
  </script>
</body>

</html>