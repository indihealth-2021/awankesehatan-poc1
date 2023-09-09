<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Telemedicine | Beranda</title>
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

<body class="font-ubuntu">

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
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
          <li class="nav-item beranda active border-mb-3"><a href="<?php echo base_url('Home#beranda'); ?>" class="nav-link">Beranda</a></li>
          <li class="nav-item layanan"><a href="#layanan" class="nav-link">Layanan</a></li>
          <li class="nav-item mitra-dokter"><a href="#mitra-dokter-2" class="nav-link">Mitra Dokter</a></li>
          <li class="nav-item news"><a href="#news" class="nav-link">Berita</a></li>
          <li class="nav-item footer"><a href="#footer" class="nav-link">Kontak</a></li>
          <li class="nav-item cta"><a href="<?php echo base_url('Login'); ?>" class="nav-link">Login</a></li>
          <li class="nav-item cta cta-regis"><a href="<?php echo base_url('register'); ?>" class="nav-link">Register</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <section class="home-slider owl-carousel" id="beranda">
    <div class="slider-item" style="background-image: url('assets/website/images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center" data-scrollax-parent="true">
          <div class="col-md-6 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
            <!-- <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Telemedicine</h1>
              <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Secara umum penggunaan teknologi
              informasi dan komunikasi yang digabungkan dengan kecanggihan medis untuk memberikan layanan kesehatan, 
            mulai dari konsultasi, diagnosis, hingga tindakan medis, tanpa terbatas ruang atau dilaksanakan dari jarak jauh, masuk dalam
          kategori telemedicine.</p> -->
            <!-- <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="#" class="btn btn-primary px-4 py-3">Make an Appointment</a></p> -->
          </div>
        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url('assets/website/images/bg_2.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center" data-scrollax-parent="true">
          <div class="col-md-6 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
            <!-- <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Telekonsultasi</h1>
              <p class="mb-4">Secara umum penggunaan teknologi
              informasi dan komunikasi yang digabungkan dengan kecanggihan medis untuk memberikan layanan kesehatan, 
            mulai dari konsultasi, diagnosis, hingga tindakan medis, tanpa terbatas ruang atau dilaksanakan dari jarak jauh, masuk dalam
          kategori telemedicine.</p> -->
            <!-- <p><a href="#" class="btn btn-primary px-4 py-3">Make an Appointment</a></p> -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <section class="ftco-intro">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-3 color-1 p-4" align="center">
            <img src="<?php echo base_url('assets/telemedicine/img/dokter.png') ?>" width="40%">
    				<h3 class="mb-4">Tenaga Medis</h3>
    				<p>Setiap orang mengabdikan diri dalam bidang kesehatan serta memiliki pengetahuan dan
              atau keterampilan melalui pendidikan dibidang kesehatan yang untuk jenis tertentu memerlukan kewenangan 
              untuk melakukan kesehatan
            </p>
    			</div>
    			<div class="col-md-3 color-2 p-4" align="center">
          <img src="<?php echo base_url('assets/telemedicine/img/jam.png') ?>" width="40%">
    				<h3 class="mb-4">Pelayanan 24 Jam</h3>
    				<p class="openinghours d-flex">
    					<span>Monday - Friday</span>
    					<span>8:00 - 19:00</span>
    				</p>
    				<p class="openinghours d-flex">
    					<span>Saturday</span>
    					<span>10:00 - 17:00</span>
    				</p>
    				<p class="openinghours d-flex">
    					<span>Sunday</span>
    					<span>10:00 - 16:00</span>
    				</p>
    			</div>
    			<div class="col-md-3 color-1 p-4" align="center">
            <img src="<?php echo base_url('assets/telemedicine/img/lab.png') ?>" width="40%">
            <h3 class="mb-4">Laboratorium</h3>
            <p>PELAYANAN LABORATORIUM LENGKAP 24 JAM</p>
            <span>Kimia Klinik</span><br>
            <span>Hematologi</span><br>
            <span>Immunologi</span><br>
            <span>Serologi</span><br>
            <span>Rapid Tes</span><br>
            <span>SWAB - PCR</span><br>
          </div>
          <div class="col-md-3 color-2 p-4" align="center">
          <img  src="<?php echo base_url('assets/telemedicine/img/mobil.png') ?>" width="40%">
            <h3 class="mb-4">Unit UGD</h3>
            <p>KONDISI DARURAT</p>
            <p>021-230-2347</p>
            <p>112 - Darurat Kota DKI</p>
          </div>
    	</div>
    </section> -->

  <section class="ftco-section ftco-services py-5 mt-5" id="layanan">
    <div class="col-md-10 mx-auto">
      <div class="row justify-content-center mb-5 pb-5">
        <div class="col-md-11 text-center heading-section ftco-animate">
          <h2 class="mb-2">Layanan kami</h2>
          <p>Telemedicine kami adalah telemedicine yang sesuai dengan regulasi Kementrian Kesehatan, yaitu pelaksanaan di bawah Fasilitas Pelayanan Kesehatan (FasYanKes)</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="icon d-flex justify-content-center align-items-center">
              <span class=""><img src="<?php echo base_url('assets/website/img/consultation.svg'); ?> " width="50%"></span>
            </div>
            <div class="media-body p-2 mt-3">
              <h3 class="heading">Integrated EMR-SIMRS</h3>
              <p>Sistem Telekonsultasi yang terintegrasi SIMRS, sehingga diagnosa dapat langsung mengisi pada catatan medis pasien (Mini EMR)</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="icon d-flex justify-content-center align-items-center">
              <span class=""><img src="<?php echo base_url('assets/website/img/video-conference.svg'); ?> " width="50%"></span>
            </div>
            <div class="media-body p-2 mt-3">
              <h3 class="heading">Video Conference</h3>
              <p>Fasilitas telekonsultasi dengan video call yang tertanam dalam satu (1) aplikasi, tanpa harus menggunakan platform lain di luar aplikasi</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="icon d-flex justify-content-center align-items-center">
              <span class=""><img src="<?php echo base_url('assets/website/img/chat.svg'); ?> " width="50%"></span>
            </div>
            <div class="media-body p-2 mt-3">
              <h3 class="heading">Chat</h3>
              <p>Kirimkan hasil pemeriksaan penunjang, atau foto yang terkait pengobatan tanpa harus keluar dari sistem</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="icon d-flex justify-content-center align-items-center">
              <span class=""><img src="<?php echo base_url('assets/website/img/drug.svg'); ?> " width="50%"></span>
            </div>
            <div class="media-body p-2 mt-3">
              <h3 class="heading">Resep Obat</h3>
              <p>Memudahkan dokter memberikan resep yang terintegrasi dengan SIMRS, tanpa harus khawatir dengan status stok obat</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-services py-5 mt-5" id="mitra-dokter">
    <div class="col-md-11 mx-auto">
      <div class="row justify-content-center mb-5">
        <div class="col-md-12 text-center heading-section ftco-animate">
          <h2 class="mb-3" id="mitra-dokter-2">Mitra Dokter</h2>
          <p>Temui Spesialis Pengalaman Kami</p>
        </div>
      </div>
      <div class="mx-1">
        <div class="row">
          <?php foreach ($list_dokter as $dokter) { ?>
            <?php if (strtolower($dokter->jenis_kelamin) == 'laki-laki') {
              $foto = base_url('assets/telemedicine/img/doc.png');
            } else {
              $foto = base_url('assets/telemedicine/img/picture-akun1.png');
            }

            $foto = $dokter->foto_dokter ? base_url('assets/images/users/' . $dokter->foto_dokter) : $foto;


            $pengalaman = $dokter->pengalaman_kerja ? $dokter->pengalaman_kerja : '';
            $pengalaman_dari = new DateTime($pengalaman);
            $pengalaman_sampai = new DateTime();
            $hitungPengalaman = $pengalaman_dari->diff($pengalaman_sampai);
            $lama_pengalaman = $hitungPengalaman->y;
            // $pengalaman[0] = $pengalaman;
            // $pengalaman[1] = (new DateTime())->format('Y-m-d');
            // $pengalaman_dari = $pengalaman != '' ? (new DateTime($pengalaman[0])):'';
            // $pengalaman_sampai = $pengalaman != '' ? (new DateTime($pengalaman[1])):'';
            // $hitungPengalaman = $pengalaman != '' ? $pengalaman_dari->diff($pengalaman_sampai):'';
            // $lama_pengalaman = $pengalaman != '' ? $hitungPengalaman->y:($dokter->pengalaman_kerja ? $dokter->pengalaman_kerja:'');
            ?>
            <div class="card col-md-3 p-4 mb-5 ftco-animate">
              <img src="<?php echo $foto; ?>" class="mx-auto img-dokter mb-3">
              <div class="text-center font-ubuntu">
                <span class="font-20 font-bold-black"><?php echo $dokter->nama_dokter ?></span><br>
                <span class="font-14 text-black"><?php echo 'Dokter ' . $dokter->poli ?></span><br>
                <span class="font-14 text-black"><?php echo $lama_pengalaman . ' Tahun Pengalaman' ?></span>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
  </section>

  <section class="ftco-section ftco-news py-5 mt-5" id="news">
    <div class="col-md-11 mx-auto">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <h2 class="mb-3">Berita</h2>
          <p>Temukan berbagai informasi kesehatan terkini dari sumber terpercaya</p>
        </div>
      </div>
      <!-- <div class="row d-flex no-gutters">
      		<div class="col-md-12 d-flex">
      			<div class="about-wrap">
      				<?php foreach ($news as $berita) { ?>
              <div class="list-services d-flex ftco-animate">
      					<div class="icon d-flex justify-content-center align-items-center">
                <div class="col-md-4">
                  <span class="icon-check2"></span>
                </div>
      					</div>
      					<div class="text col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                          <img src="<?php echo base_url('assets/images/news/' . $berita->foto); ?> " width="250" height="150" style="border-radius: 10px; border-color: white">
                        </div>
                        <div class="col-md-8">
                          <h3><a href="<?php echo base_url('news/detail_news/' . $berita->id) ?>" class="text-white"><?php echo $berita->judul; ?></a></h3>
                          <p class="text-white"><?php echo substr($berita->berita, 3, 200); ?></p>  
                          <p><a href="<?php echo base_url('news/detail_news/' . $berita->id) ?>" class="btn btn-primary btn-outline-primary text-white"> Lihat Selengkapnya...</a></p>
                        </div>
                    </div>
                </div>
      				</div>
      				<?php } ?>
      			</div>
      		</div>
      	</div> -->
      <div class="row">
        <?php foreach ($news as $berita) { ?>
          <div class="col-lg-3 col-md-3 mb-3 ftco-animate">
            <div class="card card-shadow-4 h-100">
              <img src="<?php echo base_url('assets/images/news/' . $berita->foto); ?>" class="card-img-top img-news" alt="...">
              <div class="card-body">
                <p class="font-14 font-bold-black"><?php echo $berita->judul; ?></p>
                <p class="font-12"><?php echo substr($berita->berita, 3, 100) . "..."; ?></p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <section class="ftco-section py-5 mt-5" id="footer" style="margin-bottom: 143px;">

  </section>
  <footer class="footer pt-4 footer-baru">
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
  <!-- <footer class="footer font-small pt-4" style="color: #59A799; background-color: #fff">
          <div class="container footer">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-4">
              <ul class="list-unstyled list-inline text-center py-2">
                <li class="list-inline-item mb-3">
                  <h7>Powered by :</h7>
                  <img src="<?php echo base_url('assets/telemedicine/img/logo.png') ?>" width="40%">
                </li>
                <li class="list-inline-item mb-2" >
                <h7  class="text-left">Support by :</h7>
                <img src="<?php echo base_url('assets/telemedicine/img/picture_logo.png') ?>" width="50%">
                </li>
                <li class="list-inline-item mb-2" >
                <a href="#"><img src="<?php echo base_url('assets/telemedicine/img/playstore.png') ?>" width="40%"></a>
                </li>
              </ul>
              </div>
            <div class="col-lg-4">
              <ul class="list-unstyled list-inline text-center py-3">
                <li class="list-inline-item">
                    <h3 class="mb-2"></h3>
                    <h3 class="mb-2"></h3>
                </li>
            </ul>
            </div>
            <div class="col-lg-4">
	            <ul class="list-unstyled list-inline text-left py-2">  
	              <li class="list-inline-item" ><h4 style="color: #fff;"><b>Tentang Rumah Sakit</b></h4>
	              </li>
	              <li class="list-inline-item mb-1">
	                Rumah sakit adalah institusi pelayanan kesehatan yang menyelenggarakan pelayanan kesehatan perorangan secara paripurna yang menyediakan pelayanan rawat inap, rawat jalan dan gawat darurat.
	              </li>
	              <li class="list-inline-item" ><h4 style="color: #fff;"><b>Kontak Kami</b></h4></li>
	              <br><li class="list-inline-item "><i class="fa fa-map-marker"> Central Jakarta</i></li>
	              <br><li class="list-inline-item ">Menara Thamrin 12th Floor</li>
	              <br><li class="list-inline-item ">Jl. M.H Thamrin Kav.3 Jakarta 10250</li>
	              <br><li class="list-inline-item ">T: +6221 230 2345 (Hunting)</li>
	              <br><li class="list-inline-item ">F: +6221 230 3567</li>
	              <br><li class="list-inline-item "><i class="fas fa-headphones fa-md"> 14052</i></li>
	              <br><li class="list-inline-item "><i class="fa fa-phone fa-md"> (021) 230 2347</i></li>
	              <br><li class="list-inline-item "><i class="far fa-envelope fa-md"> info@lintasarta.co.id</i></li>
	            </ul>  
            </div>
              <div class="col-lg-12">
                <div class="footer-copyright text-center py-5">
                <h7>� Copyright &copy;<script>document.write(new Date().getFullYear());</script>. Indihealth & Lintasarta. All Rights Reserved. made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" style="color: #fff">Colorlib</a>
                </div>      
              </div>
          </div>
          </div>
          </div>
    </footer> -->



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
    $(document).on('scroll', function() {
      if ($(this).scrollTop() >= $('#layanan').position().top && $(this).scrollTop() <= $('#mitra-dokter').position().top) {
        $('.beranda').removeClass('border-b-3');
        $('.beranda').removeClass('active');
        $('.mitra-dokter').removeClass('border-b-3');
        $('.mitra-dokter').removeClass('active');
        $('.news').removeClass('border-b-3');
        $('.news').removeClass('active');
        $('.footer').removeClass('border-b-3');
        $('.footer').removeClass('active');
        $('.layanan').addClass('border-b-3');
        $('.layanan').addClass('active');
      } else if ($(this).scrollTop() >= $('#mitra-dokter').position().top && $(this).scrollTop() <= $('#news').position().top) {
        $('.beranda').removeClass('border-b-3');
        $('.beranda').removeClass('active');
        $('.layanan').removeClass('border-b-3');
        $('.layanan').removeClass('active');
        $('.news').removeClass('border-b-3');
        $('.news').removeClass('active');
        $('.footer').removeClass('border-b-3');
        $('.footer').removeClass('active');
        $('.mitra-dokter').addClass('border-b-3');
        $('.mitra-dokter').addClass('active');
      } else if ($(this).scrollTop() >= $('#news').position().top && $(this).scrollTop() <= $('#footer').position().top) {
        $('.beranda').removeClass('border-b-3');
        $('.beranda').removeClass('active');
        $('.mitra-dokter').removeClass('border-b-3');
        $('.mitra-dokter').removeClass('active');
        $('.layanan').removeClass('border-b-3');
        $('.layanan').removeClass('active');
        $('.footer').removeClass('border-b-3');
        $('.footer').removeClass('active');
        $('.news').addClass('border-b-3');
        $('.news').addClass('active');
      } else if ($(this).scrollTop() >= $('#footer').position().top) {
        $('.beranda').removeClass('border-b-3');
        $('.beranda').removeClass('active');
        $('.mitra-dokter').removeClass('border-b-3');
        $('.mitra-dokter').removeClass('active');
        $('.news').removeClass('border-b-3');
        $('.news').removeClass('active');
        $('.layanan').removeClass('border-b-3');
        $('.layanan').removeClass('active');
        $('.footer').addClass('border-b-3');
        $('.footer').addClass('active');
      } else {
        $('.layanan').removeClass('border-b-3');
        $('.layanan').removeClass('active');
        $('.mitra-dokter').removeClass('border-b-3');
        $('.mitra-dokter').removeClass('active');
        $('.news').removeClass('border-b-3');
        $('.news').removeClass('active');
        $('.footer').removeClass('border-b-3');
        $('.footer').removeClass('active');
        $('.beranda').addClass('border-b-3');
        $('.beranda').addClass('active');
      }
    })
  </script>

</body>

</html>