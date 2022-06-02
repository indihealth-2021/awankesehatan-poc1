<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Telemedicine | Beranda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/open-iconic-bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/animate.css')?>">
    
    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/owl.carousel.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/owl.theme.default.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/magnific-popup.css');?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/aos.css');?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/ionicons.min.css');?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/bootstrap-datepicker.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/jquery.timepicker.css');?>">

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <!-- CSS only -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/flaticon.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/icomoon.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/website/css/style.css');?>">
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url('Home');?>"><img src="<?php echo base_url('assets/telemedicine/img/logo.png')?>" width="150" height="100"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="<?php echo base_url('Home');?>" class="nav-link">BERANDA</a></li>
            <li class="nav-item active"><a href="<?php echo base_url('News');?>" class="nav-link">BERITA</a></li>
            <li class="nav-item"><a href="<?php echo base_url('register');?>" class="nav-link">DAFTAR</a></li>
            <li class="nav-item cta"><a href="<?php echo base_url('Login');?>" class="nav-link"><span>MASUK</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->

    <section class="home-slider owl-carousel">
      <div class="slider-item bread-item" style="background-image: url('/assets/website/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container" data-scrollax-parent="true">
          <div class="row slider-text align-items-end">
            <div class="col-md-7 col-sm-12 ftco-animate mb-5">
              <p class="breadcrumbs" data-scrollax=" properties: { translateY: '70%', opacity: 1.6}"><span class="mr-2"><a href=""></a></span> <span></span></p>
              <h1 class="mb-3" data-scrollax=" properties: { translateY: '70%', opacity: .9}"></h1>
            </div>
          </div>
        </div>
      </div>

<div class="slider-item bread-item" style="background-image: url('/assets/website/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container" data-scrollax-parent="true">
          <div class="row slider-text align-items-end">
            <div class="col-md-7 col-sm-12 ftco-animate mb-5">
              <p class="breadcrumbs" data-scrollax=" properties: { translateY: '70%', opacity: 1.6}"><span class="mr-2"><a href=""></a></span> <span></span></p>
              <h1 class="mb-3" data-scrollax=" properties: { translateY: '70%', opacity: .9}"></h1>
            </div>
          </div>
        </div>
      </div>    </section>
    
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            <h2 class="mb-3"><?php echo $news->judul; ?></h2>
              <img src="<?php echo base_url('assets/images/news/'.$news->foto);?>" alt="" class="img-fluid">
            </p>
            <p><?php echo $news->berita; ?></p>
            
            
          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form method="post" action="<?php echo base_url('News/search_result');?>" class="search-form">
                <div class="form-group">
                  <div class="icon"><span class="icon-search"></span></div>
                  <input type="text" class="form-control" placeholder="Pencarian Berita" id="myInput" name="news">
                </div>
              </form>
            </div>
            <!--<div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Kategori</h3>
                <li><a href="#">Covid-19 <span>(12)</span></a></li>
                <li><a href="#">Pola Hidup Sehat <span>(22)</span></a></li>
                <li><a href="#">Olahraga Di Rumah Aja <span>(37)</span></a></li>
                <li><a href="#">Kesehatan Tubuh <span>(42)</span></a></li>
                <li><a href="#">Makanan Sehat <span>(14)</span></a></li>
              </div>
            </div>-->

            <div class="sidebar-box ftco-animate">
              <h3>Berita Lainnya</h3>
              <?php foreach($other_news as $berita){ ?>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(<?php echo base_url('assets/images/news/'.$berita->foto) ?>);"></a>
                <div class="text">
                  <h3 class="heading"><a href="<?php echo base_url('news/detail_news/'.$berita->id); ?>"><?php echo ucwords($berita->judul) ?></a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> <?php $tanggal = new DateTime($berita->created_at); $tanggal = $tanggal->format('M, d Y'); echo $tanggal; ?></a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <!--<div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(assets/website/images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Berita Lama</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(assets/website/images/image_3.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Berita Lama</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>-->
            </div>
            <!-- <div class="sidebar-box ftco-animate">
              <h3>Berita Lainnya</h3>
              <?php foreach($news as $berita){ ?>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url('<?php echo base_url('assets/images/news/'.$berita->foto);?>');"></a>
                <div class="text">
                  <h3 class="heading"><a href="<?php echo base_url('news/detail_news/'.$berita->id) ?>"><?php echo $berita->judul?></a></h3>
                  <div class="meta">
                  <?php 
                    $tanggal = new DateTime($berita->created_at);
                    $tanggal = $tanggal->format('M. d, Y');
                  ?>
                    <div><span class="icon-calendar"></span> <?php echo $tanggal?></div>
                    <div><span class="icon-person"></span> Admin</div>
                  </div>
                </div>
              </div>
              <?php }?>
            </div> -->


            <!--<div class="sidebar-box ftco-animate">
              <h3>Paragraph</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            </div>-->
          </div>
        </div>
      </div>
    </section>

  <footer class="footer font-small pt-4" style="color: #fff; background-color: #2C94D2">
          <!-- Footer Elements -->
          <div class="container footer">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-4">
              <ul class="list-unstyled list-inline text-center py-2">
                <li class="list-inline-item mb-3">
                  <h7>Powered by :</h7>
                  <img src="<?php echo base_url('assets/telemedicine/img/logo.png')?>" width="40%">
                </li>
                <li class="list-inline-item mb-2" >
                <h7  class="text-left">Support by :</h7>
                <img src="<?php echo base_url('assets/telemedicine/img/picture_logo.png')?>" width="50%">
                </li>
                <li class="list-inline-item mb-2" >
                <a href="#"><img src="<?php echo base_url('assets/telemedicine/img/playstore.png')?>" width="40%"></a>
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
            <!-- Call to action -->
              <!-- Copyright -->
              <div class="col-lg-12">
                <div class="footer-copyright text-center py-5">
                <h7>� Copyright &copy;<script>document.write(new Date().getFullYear());</script>. Indihealth & Lintasarta. All Rights Reserved. </h7><br>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" style="color: #fff">Colorlib</a>
                </div>      
              </div>
          
          <!-- Copyright -->
          </div>
          </div>
          </div>
          <!-- Footer Elements -->
        </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#007bff"/></svg></div>


  <script src="<?php echo base_url('assets/website/js/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery-migrate-3.0.1.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/popper.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.easing.1.3.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.waypoints.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.stellar.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/owl.carousel.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.magnific-popup.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/aos.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.animateNumber.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/bootstrap-datepicker.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/jquery.timepicker.min.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/scrollax.min.js');?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?php echo base_url('assets/website/js/google-map.js');?>"></script>
  <script src="<?php echo base_url('assets/website/js/main.js');?>"></script>
  
    
  </body>
</html>