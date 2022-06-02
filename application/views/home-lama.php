<!DOCTYPE html>
<html>
    <head>
        <title>Telemedicine | Home - Sign in</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/fontawesome-free/css/all.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/home.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/popupstyle.css'); ?>">
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
        
    </head>
    <body>
            <nav class=" nav navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
                <div class="navbar-header">
                  <a class=" nav navbar-brand" href="<?php echo base_url('Home');?>"> 
                  <img src="<?php echo base_url('assets/telemedicine/img/logo.png')?>" width="140" height="70">
                </a>  
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav navbar-default navbar-right" id="navbarTogglerDemo02">
                  <!-- <ul class="nav navbar-default navbar-right" style="padding-left: 100px">
                    <li class="nav-link">
                      <a href="<?php //echo base_url('Home');?>" style="text-decoration: none"><button type="button" class="btn btn-default navbar-btn"><i class="glyphicon glyphicon-user "></i>Home</button></a>
                    </li>
                    <li class="nav-link">
                      <a href="<?php //echo base_url('News');?>" style="text-decoration: none"><button type="button" class="btn btn-default navbar-btn"><i class="glyphicon glyphicon-user "></i>News</button></a>
                    </li>
                </ul> -->
              <form action="<?php echo base_url('login');?>" method="GET" >
              <ul class="nav navbar-default navbar-right" style="padding-left: 161px;">
                    <li class="nav-link " >
                      <a class="menu-landing" href="<?php echo base_url('Home');?>">
                      <?php if ($menu_landing == 1) {?>
                      <button type="button" class="btn btn-default navbar-btn active">Beranda</button></a>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-default navbar-btn">Beranda</button></a>
                      <?php } ?>
                    </li>
                    <li class="nav-link ">
                      <a class="menu-landing" href="<?php echo base_url('News');?>">
                      <?php if ($menu_landing == 2) {?>
                      <button type="button" class="btn btn-default navbar-btn active">Berita</button>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-default navbar-btn">Berita</button>
                      <?php } ?>
                      </a>
                    </li>
                    <li class="nav-link">
                    <a class="menu-landing"  href="<?php echo base_url('register');?>">
                    <?php if ($menu_landing == 3) {?>
                    <button type="button" class="btn btn-default navbar-btn active">Daftar</button>
                    <?php }else{ ?>
                    <button type="button" class="btn btn-default navbar-btn">Daftar</button>
                    <?php } ?></a>
                    </li>
                    <li class="nav-link">
                    <a class="menu-landing" href="<?php echo base_url('Login');?>">
                    <?php if ($menu_landing == 4) {?>
                    <button type="button" class="btn btn-default navbar-btn active">Masuk</button>
                    <?php }else{ ?>
                    <button type="button" class="btn btn-default navbar-btn">Masuk</button>
                    <?php } ?></a>
                    </li>
                    <li class="nav-link">
                    <select style="text-decoration: none; cursor: pointer;" class="form-control">
                      <option>Indonesia</option>
                        <option>English</option>
                    </select>
                    </li>
                     
               </ul>                 
               </form>
              </div>
            </div>
          </nav>

    <!--slide-->
    <div class="container-fluid slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active ">
              <img src="<?php echo base_url('assets/telemedicine/img/medicine.svg')?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="<?php echo base_url('assets/telemedicine/img/care.svg')?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="<?php echo base_url('assets/telemedicine/img/doctor.svg')?>" class="d-block w-100" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>

    <!--end-slide-->
    <!--content-->
    <div class="container">
            <div class="row my-1 mx-1 kotak-layanan">
              <div class="col-lg-3 col-md-3 col-sm-12" style="padding: 5px">
                <div class="card text-white  bg-info mb-3 h-100 ">
                    <img class="img-card" src="<?php echo base_url('assets/telemedicine/img/jam.png')?>">
                    <div class="card-body">
                    <h5 class="card-title">Pelayanan 24 Jam</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12" style="padding: 5px">
                <div class="card text-white bg-primary mb-3 h-100">
                <img class="img-card" src="<?php echo base_url('assets/telemedicine/img/lab.png')?>">
                    <div class="card-body">
                    <h5 class="card-title">Laboraturium</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12" style="padding: 5px">
                <div class="card text-white bg-info mb-3 h-100">
                <img class="img-card" src="<?php echo base_url('assets/telemedicine/img/dokter.png')?>">
                    <div class="card-body">
                    <h5 class="card-title">Tenaga Medis</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12" style="padding: 5px">
                <div class="card text-white bg-primary mb-3 h-100">
                <img class="img-card" src="<?php echo base_url('assets/telemedicine/img/mobil.png')?>">
                    <div class="card-body">
                    <h5 class="card-title">Unit UGD</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
              </div>
            </div>
    </div>
    <div class="container">
        <div class="welcome">
            <div class="card mb-3 my-3 ">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="<?php echo base_url('assets/telemedicine/img/video.png')?>" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title" style="color: #008B8B">Video Conference</h5>
                    <p class="card-text ">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-lg-12">
        <div class="row">
        <!-- <div class="col-lg-3">
          <div class="card" style="width: 18rem;">
              <div class="card-header">
                <h3>UPDATE</h3>
              </div>
              <ul class="list-group list-group-flush beritabaru">
                <li class="list-group-item">CORONA VIRUS</li>
                <li class="list-group-item">Pencegahan Covid-19</li>
                <li class="list-group-item">Laporan Kasus Covid-19</li>
              </ul>
              </div>
        </div> -->
          <div class="card mb-3 col-lg-12" style="text-align: left; background-color: #ddd;">
          <div class="card-header container" style="color: #008B8B; margin-bottom:25px; text-align: center; ">
            <h3 class="card-title">BERITA KESEHATAN</h3>
          </div>
             <ul id="myUL">
                <?php foreach($news as $berita){ ?>
                <li style="list-style: none">
                  <div class="row row-news m-2 mb-4" style="padding: 10px;">
                        <div class="col-lg-3 col-md-3 col-sm-12 my-auto" style="padding: 0px; width: 100%; height: 180px; ">
                          <img class="img-news" src="<?php echo base_url('assets/images/news/'.$berita->foto);?>" style="width: 80%; object-fit: cover; height: 140px;">
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 mt-2 col-text-news">
                          <a href="<?php echo base_url('news/detail_news/'.$berita->id) ?>"><h4 style="font-weight: bold; padding-top:5px"><?php echo $berita->judul; ?></h4></a>
                          <!-- <a href="#" style=""><p class="title-news" style="font-size: 24px">Title Berita alam waktu yang singkat. Hal ini dikarenakan, jika lebih lama mencuci tangan maka akan lebih banyak area ya</p></a> -->
                          <p><?php echo substr($berita->berita,3,150); ?></p>
                          <!-- <textarea class="text-area-news" rows="6" style="width: 100%; overflow:hidden; resize: none; background-color: transparent; border:none;" readonly><?php echo strip_tags(substr($berita->berita, 0, 300)).'...'; ?></textarea> -->
                          <div class="text-right mt-2">
                           <a href="<?php echo base_url('news/detail_news/'.$berita->id);?>"> Lihat Berita ></a> 
                        </div></div>
                        <div class="col-12 text-right">
                        </div>
                      </div>
                    
                  </li>
                    <?php } ?>
                    </ul>
              <hr>
            </div>
        </div>
        </div>
        </div>
      <div class="mb-3" id="section-dokter" >
      	<div class="title-dokter" >
            <h3>DOKTER SPESIALIS</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
           
        <div class="">
            <div class="row my-0 mx-0">
            <?php foreach($list_dokter as $dokter){ ?>
              <?php if($dokter->jenis_kelamin == 'Laki-laki'){
                        $foto = base_url('assets/telemedicine/img/doc.png');
                    } 
                    else{
                        $foto = base_url('assets/telemedicine/img/picture-akun1.png');
                    }
              ?>
              <div class="col-lg-3 col-md-3 col-sm-12" style="padding: 15px;">
                <div class="card h-100" id="kotak">
                  <img src="<?php echo $dokter->foto_dokter ? base_url('assets/images/users/'.$dokter->foto_dokter) : $foto ?>" width="80%" height="60%" alt="..." style="padding: 20px;">
                  <div class="card-body">
                    <div class="card-title" style="font-size: 15px"><b><?php echo $dokter->nama_dokter ?></b></div>
                    <p class="card-text" style="color: #007bff; font-size: 12px"><?php echo 'Dokter '.$dokter->poli ?></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <!--end-content-->
    <!--footer-->
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
              <li class="list-inline-item "><h5>Tentang Rumah Sakit</h5>
              </li>
              <li class="list-inline-item mb-1">
                Rumah sakit adalah institusi pelayanan kesehatan yang menyelenggarakan pelayanan kesehatan perorangan secara paripurna yang menyediakan pelayanan rawat inap, rawat jalan dan gawat darurat.
              </li>
              <li class="list-inline-item "><h5>Kontak Kami</h5></li>
              <li class="list-inline-item "><i class="fa fa-map-marker"> Stasiun Gambir, Lt 1 Pintu Utara</i></li>
              <li class="list-inline-item "><i class="fa fa-phone fa"> (021) 3890 2233</i><br></li>
              <li class="list-inline-item "><i class="fa-envelope-o"> Info@rumahsakit.id</i></li>
            </ul>  
            </div>
            <!-- Call to action -->
              <!-- Copyright -->
              <div class="col-lg-12">
                <div class="footer-copyright text-center py-5">
                <h7>� Copyright : 2020. Indihealth & Lintasarta. All Rights Reserved. </h7>
                </div>      
              </div>
          
          <!-- Copyright -->
          </div>
          </div>
          </div>
          <!-- Footer Elements -->
        </footer>
    <!--end footer-->
        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/jscript" src="<?php echo base_url('assets/js/jquery.slim.js'); ?>"></script>
        <script type="text/jscript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        
        <script type="text/javascript">
       $(document).ready(function() {    
          $('.carousel').carousel();
        });
        </script>
    </body>
</html>