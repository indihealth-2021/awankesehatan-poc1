<!DOCTYPE html>
<html lang="en">

<head>
  <title>Telemedicine | Faq</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/website/css/bootstrap.min.css') ?>">
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

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

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
  <section class="ftco-section ftco-services py-5 pb-5">
    <div class="col-md-10 mx-auto font-ubuntu pb-5">
      <div class="row">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
            <ol class="breadcrumb" style="background-color: transparent;">
              <li class="breadcrumb-item active"><a href="<?php echo base_url('Faq'); ?>" class="text-black">FAQ</a></li>
              <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('Faq/beliobat') ?>" class="text-black font-bold-7">Info Beli Obat</a></li>
            </ol>
          </nav>
        </div>
        <h2 class="text-faq col-md-10">Frequently Asked Questions (FAQ)</h2>

        <div class="col-md-12">
          <p class="font-24">Info Beli Obat</p>
        </div>
      </div>
    </div>

    <div class="mx-auto pt-5 pb-5 bg-grey font-ubuntu">
      <div class="col-md-10 mx-auto">
        <div class="row mx-auto">
          <div class="accordion" id="info">
            <div class="info1">
              <div class="" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-faq btn-block text-left" type="button" data-toggle="collapse" data-target="#info1" aria-expanded="true" aria-controls="info1"><i class="fas fa-caret-down"></i>
                    Bagaimana cara melakukan pembelian obat?
                  </button>
                </h2>
              </div>

              <div id="info1" class="collapse show" aria-labelledby="headingOne" data-parent="#info">
                <div class="pl-3 mb-3 font-18 text-justify">
                  <span class="ml-3">Pembelian obat dilakukan setelah melakukan telekonsultasi, dokter akan memberikan resep untuk pasien. untuk tahap pembelian </span><span class="ml-3">resep yang diberikan dokter adalah sebagai berikut :</span>
                  <ul>
                    <li>Pertama, Masuk ke Menu Resep Obat → disana ada tabel dengan isi resep obat yang telah diberikan. Pilih resep yang akan dibeli dengan klik button Bayar.</li>
                    <li>Kedua, Setelah klik Button Bayar maka pasien akan diarahkan ke page pembayaran untuk melakukan pembayaran. Disini pasien bisa melakukan pembayaran dengan menggunakan Transfer dan Owlexa.</li>
                    <li>Jika pasien ingin menggunakan metode Transfer dalam pembayarannya, maka pasien akan diminta untuk mengirim biaya ke Rekening yang tercantum di web dan mengunggah bukti Transfer.</li>
                    <li>Jika pasien ingin menggunakan metode Owlexa maka pasien akan diminta untuk memasukan kode kartu dan akan menerima kode OTP. Kode tersebut akan diinput di kolom yang diminta di web.</li>
                    <li>Terakhir, pasien bisa klik Button bayar. Pembayaran obat pun berhasil dan bisa di cek di menu riwayat pembayaran bagian obat.</li>
                  </ul>
                </div>
              </div>
            </div>
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
              <span>Gedung Arcadia, Thamrin Menara Tower,</span><br>
              <span>Jl. M.H. Thamrin No.Kav. 3, RT.2/RW.1,</span><br>
              <span>Kb. Sirih, Kec. Menteng, Kota Jakarta Pusat, </span><br>
              <span>Daerah Khusus Ibukota Jakarta 10250</span><br>
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
      <span class="font-12 text-white font-droid">Version 1.0 Copyright © 2023. Lintasarta & Indosat. All rights reserved.</span>
    </div>
  </footer>


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#59A799" />
    </svg></div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
  .fa,
  .fas {
    font-weight: 900;
    margin-left: 0;
  }
</style>