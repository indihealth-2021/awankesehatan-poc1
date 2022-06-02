<!DOCTYPE html>
<html>
    <head>
        <title>Telemedicine | Daftar</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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
            <li class="nav-item active"><a href="<?php echo base_url('register');?>" class="nav-link"><b>DAFTAR</b></a></li>
            <li class="nav-item cta"><a href="<?php echo base_url('Login');?>" class="nav-link"><span><b>MASUK</b></span></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="ftco-tampilan" style="background: linear-gradient(to right, #D7E1EC, #fff);">
    <div class="container" style="padding-top: 20px">
        <div class="col-lg-12">
            <div class="row justify-content-md-center">
                <div class="col-lg-6 mt-5 mb-5">
                    <div class="col-lg-11 text-center">
                      <h3 class="mb-4">RUMAH SAKIT</h3>
                      Rumah sakit adalah institusi pelayanan kesehatan yang menyelenggarakan pelayanan kesehatan perorangan secara paripurna yang menyediakan pelayanan rawat inap, rawat jalan dan gawat darurat        
                    </div>
                </div>
                <div class="col-lg-6 row mx-auto">
                    <div class="col-lg-12 mt-1">
                    <div class="row text-center">
                    <div class="col-lg-11">
                      <img src="<?php echo base_url('assets/website/images/user.svg')?>" width="100" class="mb-3">
                      <h2>SELAMAT DATANG</h2>
                    </div>
                      <?php $old = $this->session->flashdata('data_regis'); ?>
                      
                        <form action="<?php echo base_url('Register/register')?>" method="POST" onsubmit="return ubah();">
                        <?php if($this->session->flashdata('msg')){ echo '<div class="alert-danger border pb-1">'.$this->session->flashdata('msg').'</div>'; } ?>
                        <div class="col-lg-10 text-center offset-lg-1">
                          <div class="row">
                            <div class="col-lg-11">
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text" style="width: 40px;"><i class="fa fa-user" aria-hidden="true"></i></div>
                                </div>
                                <input required type="text" class="form-control"<?php echo $old ? ' value="'.$old['name'].'" ' : ' '; ?>id="name" name="name" placeholder="Nama">
                              </div>
                            </div>
                            <div class="col-lg-11">
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text" style="width: 40px;"><i class="fa fa-user" aria-hidden="true"></i></div>
                                </div>
                                <input required type="text" class="form-control" id="username" <?php if($this->session->flashdata('error_on_regis') != 'username' && $this->session->flashdata('error_on_regis') != 'usernameAndEmail'){  echo "value='".$old['username']."'"; } ?> name="username" placeholder="Username">
                              </div>
                            </div>
                            <div class="col-lg-11">
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text" style="width: 40px;"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                </div>
                                <input required type="number" class="form-control"<?php echo $old ? ' value="'.$old['telp'].'" ' : ' '; ?>id="telp" name="telp" placeholder="Nomor Telepon" >
                              </div>    
                            </div>
                            <div class="col-lg-11">
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text" style="width: 40px;"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                </div>
                                <input required type="email" class="form-control" <?php if($this->session->flashdata('error_on_regis') != 'email' && $this->session->flashdata('error_on_regis') != 'usernameAndEmail'){ echo "value='".$old['email']."'"; } ?> id="email" name="email" placeholder="Email" >
                              </div>    
                            </div>
                            <div class="col-lg-11">
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text" style="width: 40px"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                                </div>
                                <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
                              </div>    
                            </div>
                            <div class="col-lg-11">
                              <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text" style="width: 40px;"><i class="fa fa-lock" aria-hidden="true"></i></div>
                                </div>
                                <input required type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Confirm Password">
                              </div>    
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group row" align="left">
                                <div class="col-lg-5">
                                  <label>Tempat Lahir : </label>
                                  <input required="" class="form-control" name="lahir_tempat"<?php echo $old ? ' value="'.$old['lahir_tempat'].'" ' : ' '; ?>placeholder="Tempat Lahir">
                                </div>
                                <div class="col-lg-6">
                                  <label>Tanggal Lahir : </label>
                                  <input required="" type="date" class="form-control" min="1500-01-01" max="<?php echo (new DateTime('now'))->format('Y-m-d'); ?>" name="lahir_tanggal" id="tanggal"<?php echo $old ? ' value="'.$old['lahir_tanggal'].'" ' : ' '; ?>onchange="setDay()">
                                </div>
                              </div>        
                            </div>
                            <div class="col-lg-12 text-left">
                              <div class="form-group">
                                  <label>Jenis Kelamin : </label><br>
                                  <label class="radio-inline" style="padding-left: 0px">
                                      <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline1" value="Laki-laki" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'laki-laki' ? 'checked' : ''; } ?>><i class="fa fa-male fa-fw"></i> Laki-laki
                                  </label>
                                  <label class="radio-inline" style="padding-left: 80px">
                                      <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline2" value="Perempuan" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : ''; } ?>><i class="fa fa-female fa-fw"></i> Perempuan
                                  </label>
                              </div>
                            </div>
                          </div>
                        </div>
                         <!--  <div class="row">
                              <div class="div col-sm-2">
                                  Role: 
                              </div>
                              <div class="div col">
                                  <select class="form-control" name="id_user_kategori" required>
                                      <option value="5">Admin</option>
                                      <option value="0">Pasien</otpion>
                                      <option value="2">Dokter</option>
                                  </select>
                              </div>
                          </div> -->
                          <div class="col-lg-9 offset-lg-1">
                            <div class="form-group mt-2" style="margin-bottom: 0px; padding-bottom: 5px">
                              <input type="hidden" name="id_user_kategori" value="0">
                              <button type="submit" class="btn btn-primary btn-block align-center" style="height: 40px">DAFTAR</button>
                            </div>
                            <div class="text-right">
                              <a href="<?php echo base_url('Login');?>">Sudah memiliki akun? Masuk</a>    
                            </div>
                          </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>     
    </div>
    <!--footer-->
        <footer class="footer font-small pt-4" style="color: #fff; background-color: #2C94D2; margin-top: 250px">
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

    <!--end footer-->

<script>
function ubah(){
	var password_baru = document.getElementById('password').value;
	var konfirmasi_password = document.getElementById('confirm_pass').value;

  if(password_baru.length < 8){
    alert('Password minimal berisi 8 karakter!')
    // event.preventDefault();
    return false;
  }
  else{
    if(password_baru != konfirmasi_password){
      alert('Password dan Konfirmasi Password Baru tidak sama!');
      // event.preventDefault();
      return false;
    }
    else{
      return true;
    }
  }
}
</script>

	<?php if($this->session->flashdata('msg_regis')){ echo "<script>alert('".$this->session->flashdata('msg_regis')."')</script>"; } ?>

<script>
var username = document.getElementById('username');
var email = document.getElementById('email');
var password = document.getElementById('password');

username.onkeyup = function(){
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(' ','');
}

email.onkeyup = function(){
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(' ','');
}
</script>

<!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/jscript" src="<?php echo base_url('assets/telemidicine/js/jquery.min.js'); ?>"></script>
        <script type="text/jscript" src="<?php echo base_url('assets/telemidicine/js/bootstrap.min.js'); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!--<script type="text/javascript">
          $('.carousel').carousel()
        </script>-->
    </body>
</html>
