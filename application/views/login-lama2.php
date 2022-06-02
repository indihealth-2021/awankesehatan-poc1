<!DOCTYPE html>
<html>
    <head>
        <title>Telemedicine | Masuk</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/tampilan.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.css') ?>">
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/popupstyle.css'); ?>"> -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-light    ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url('Home');?>"><img src="<?php echo base_url('assets/telemedicine/img/logo.png')?>" width="150" height="100"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="<?php echo base_url('Home');?>" class="nav-link"><b>BERANDA</b></a></li>
            <li class="nav-item"><a href="<?php echo base_url('News');?>" class="nav-link"><b>BERITA</b></a></li>
            <li class="nav-item"><a href="<?php echo base_url('register');?>" class="nav-link"><b>DAFTAR</b></a></li>
            <li class="nav-item active cta"><a href="<?php echo base_url('Login');?>" class="nav-link"><span><b>MASUK</b></span></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="ftco-tampilan" style="background: linear-gradient(to right, #D7E1EC, #fff);">
    <!-- <section class="ftco-tampilan" style="background-image: url(assets/telemedicine/img/blue.jpg); background-repeat: repeat-y;  background-size: 2000px;"> -->
        <div class="container" style="padding-top: 20px">
        <div class="col-lg-12">
            <div class="row justify-content-md-center mt-12">
                <div class="col-lg-6">
                    <div class="card-body col-lg-12 text-center" style="height: 480px;">
                        <div class="card-body">
                            <div class="card-body">
                            <div class="card-body">
                                <h2>RUMAH SAKIT</h2>
                            </div>
                            Rumah sakit adalah institusi pelayanan kesehatan yang menyelenggarakan pelayanan kesehatan perorangan secara paripurna yang menyediakan pelayanan rawat inap, rawat jalan dan gawat darurat
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="col-lg-10 mx-auto">
                    <div class="card-body text-center mb-5 pt-5" style="height: 480px">
                      <!-- <img src="<?php // echo base_url('assets/website/images/user.svg')?>" width="25%" class="mb-3"> -->
                      <div class="col-12 mx-auto">
                        <h2 class="py-2" style="color: #010333;border-bottom: 2px solid #007bff;">SELAMAT DATANG</h2>
                      </div>
                        
                      <div class="card-body">
                        <form action="<?php echo base_url('Login/login')?>" method="POST">
                        <?php if($this->session->flashdata('msg_login')){ 
                          $isSukses = $this->session->flashdata('msg_login_sukses') ? 'alert-success':'alert-danger';
                          echo '<div class="'.$isSukses.' border pb-1">'.$this->session->flashdata('msg_login').'</div>'; 
                        } ?>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="email" placeholder="Username">
                          </div>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            </div>
                            <input type="password" class="form-control" id="inlineFormInputGroup" name="password" placeholder="Password">
                          </div>
                          <div class="mb-3 text-right">
                          <a href="<?php echo base_url('ForgotPassword');?>">Lupa Password ?</a>    
                          </div>
                          <div class="form-group ">
                          <a href="<?php echo base_url('Login');?>" style="text-decoration: none;"><button type="submit" class="btn btn-primary align-center col-lg-12" style="height: 40px">MASUK</button></a>
                          </div>
                          <div class="mb-3">
                            <h7>atau</h7>    
                          </div>
                          <div class="form-group">
                          <a href="<?php echo base_url('register');?>" style="text-decoration: none">
                          <button type="button" class="btn btn-primary align-center col-lg-12" style="height: 40px">DAFTAR</button></a>
                          </div>
                        </form>
                      </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>     
    </div>  
    </section>
    
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
                <h7>� Copyright &copy;2020. Indihealth & Lintasarta. All Rights Reserved. </h7>
                </div>      
              </div>
          
          <!-- Copyright -->
          </div>
          </div>
          </div>
          <!-- Footer Elements -->
        </footer>

	<?php if($this->session->flashdata('msg_regis')){ echo "<script>alert('".$this->session->flashdata('msg_regis')."')</script>"; } ?>
  <?php if($this->session->flashdata('msg_forgot_pass')){ echo "<script>alert('".$this->session->flashdata('msg_forgot_pass')."')</script>"; } ?>
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