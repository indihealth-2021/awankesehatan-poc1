<!DOCTYPE html>
<html lang="en">

<head>
  <title>Telemedicine | Faq</title>
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
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light font-ubuntu" id="ftco-navbar" style="border-bottom:1px; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.25);">
    <div class="container">
      <a class="navbar-brand" href="<?php echo base_url('Home'); ?>"><?php
                                                                      $imageFormats = ['png', 'jpeg', 'jpg', 'jfif', 'gif'];
                                                                      foreach ($imageFormats as $format) {
                                                                        $imagePath = './assets/images/logo/logo.' . $format;
                                                                        if (file_exists($imagePath)) {
                                                                          echo '<img class="img-brand" src="' . base_url($imagePath) . '" alt="">';
                                                                          break;
                                                                        }
                                                                      }
                                                                      ?></a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
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
  <section class="ftco-section ftco-services py-5 pb-5">
    <div class="col-md-10 mx-auto font-ubuntu pb-5">
      <div class="row">
        <h2 class="text-faq col-md-10">Frequently Asked Questions (FAQ)</h2>
        <div class="col-md-6">
          <p class="font-22 d-mobile-none">Hallo, ada yang dapat kami bantu ? </p>
          <p class="font-18 d-mobile-show">Hallo, ada yang dapat kami bantu ? </p>
          <span class="text-sub-faq">Berikut adalah daftar pertanyaan yang bisa membantu anda dalam Menelusuri WEB ini.<br>Temukan semua jawaban dari pertanyaan seputar Healtcare ini jangan ragu untuk menghubungi kami kapan pun jika ada pertanyaan yang mungkin anda miliki !</span>
        </div>
        <div class="col-md-6 text-center">
          <img src="<?php echo base_url('assets/telemedicine/img/faq-image.png') ?>" class="img-faq-header">
        </div>
      </div>
    </div>

    <div class="mx-auto pt-5 pb-5 bg-light font-ubuntu">
      <div class="col-md-10 mx-auto">
        <div class="row mx-auto">
          <div class="col-md-4 text-center bg-white-info pt-4">
            <a href="<?php echo base_url('Faq/akun'); ?>">
              <div>
                <img src="<?php echo base_url('assets/telemedicine/img/info-akun.png') ?>" class="img-info-2 mb-3">
                <p>Info Akun</p>
              </div>
            </a>
          </div>
          <div class="col-md-4 text-center bg-white-info pt-5">
            <a href="<?php echo base_url('Faq/payment'); ?>">
              <div>
                <img src="<?php echo base_url('assets/telemedicine/img/info-payment.png') ?>" class="img-info-3 mb-4">
                <p class="mt-2">Info Payment</p>
              </div>
            </a>
          </div>
          <div class="col-md-4 text-center bg-white-info py-4">
            <a href="<?php echo base_url('Faq/konsultasi'); ?>">
              <div>
                <img src="<?php echo base_url('assets/telemedicine/img/info-konsultasi.png') ?>" class="img-info-4 mb-4">
                <p>Info Konsultasi</p>
              </div>
            </a>
          </div>
          <div class="col-md-4 text-center bg-white-info py-4 ml-auto">
            <a href="<?php echo base_url('Faq/beliobat'); ?>">
              <div>
                <img src="<?php echo base_url('assets/telemedicine/img/info-beli-obat.png') ?>" class="img-info-5 mb-5">
                <p>Info Beli Obat</p>
              </div>
            </a>
          </div>
          <div class="col-md-4 text-center bg-white-info py-4 mr-auto">
            <a href="<?php echo base_url('Faq/delivery'); ?>">
              <div>
                <img src="<?php echo base_url('assets/telemedicine/img/info-delivery.png') ?>" class="img-info-6 mb-4">
                <p class="mt-3">Info Delivery</p>
              </div>
            </a>
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

</body>

</html>
<style>
  a,
  a:hover,
  a:visited {
    color: #000000;
  }
</style>