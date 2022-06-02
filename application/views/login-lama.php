<!DOCTYPE html>
<html>
    <head>
        <title>Telemedicine | Home - Sign in</title>
        
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
              <ul class="nav navbar-default navbar-right" style="padding-left: 800px;">
                    <li class="nav-link " >
                      <a class="menu-landing" href="<?php echo base_url('Home');?>">
                      <?php if ($menu_landing == 1) {?>
                      <button type="button" class="btn btn-default navbar-btn active"><i class="fa fa-home"></i>Beranda</button></a>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-default navbar-btn" style="font-weight: bold">Beranda</button></a>
                      <?php } ?>
                    </li>
                    <!-- <li class="nav-link ">
                      <a class="menu-landing" href="<?php echo base_url('News');?>">
                      <?php if ($menu_landing == 2) {?>
                      <button type="button" class="btn btn-default navbar-btn active">News</button>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-default navbar-btn">News</button>
                      <?php } ?>
                      </a>
                    </li>
                    <li class="nav-link">
                    <a class="menu-landing"  href="<?php echo base_url('register');?>">
                    <?php if ($menu_landing == 3) {?>
                    <button type="button" class="btn btn-default navbar-btn active">Register</button>
                    <?php }else{ ?>
                    <button type="button" class="btn btn-default navbar-btn">Register</button>
                    <?php } ?></a>
                    </li>
                    <li class="nav-link">
                    <a class="menu-landing" href="<?php echo base_url('Login');?>">
                    <?php if ($menu_landing == 4) {?>
                    <button type="button" class="btn btn-default navbar-btn active">Login</button>
                    <?php }else{ ?>
                    <button type="button" class="btn btn-default navbar-btn">Login</button>
                    <?php } ?></a>
                    </li> -->
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
    <div class="container">
        <div class="col-lg-12">
            <div class="row justify-content-md-center mt-12">
                <div class="col-lg-6" style="padding-left: 0px; padding-bottom: 50px">
                    <div class="card-body col-lg-12 text-center mb-5" style="height: 480px;">
                        <div class="card-body">
                            <div class="card-body">
                            <div class="card-body">
                                <h3>RUMAH SAKIT</h3>
                            </div>
                            Rumah sakit adalah institusi pelayanan kesehatan yang menyelenggarakan pelayanan kesehatan perorangan secara paripurna yang menyediakan pelayanan rawat inap, rawat jalan dan gawat darurat
                            </div>
                        </div>
                       <!--  <div class="card-body mt-2">
                            <img src="<?php //echo base_url('assets/telemedicine/img/picture_logo.png');?>" style="width: 200px; height: auto">
                            <br>
                            <img src="<?php //echo base_url('assets/telemedicine/img/logo.png');?>" style="width: 180px; height: auto;">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12">
                    <div class="card-body col-lg-10 text-center mb-5" style="height: 480px">
                      <img src="<?php echo base_url('assets/telemedicine/img/male.png')?>" width="35%">
                        <h2>SELAMAT DATANG</h2>
                      <div class="card-body">
                        <form action="<?php echo base_url('Login/login')?>" method="POST">
                        <?php if($this->session->flashdata('msg_login')){ echo '<div class="alert-danger border pb-1">'.$this->session->flashdata('msg_login').'</div>'; } ?>
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