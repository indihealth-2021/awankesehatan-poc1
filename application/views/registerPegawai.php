<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Telemedicine Register</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/tampilan.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.min.css')?>">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <nav class="navbar navbar-inverse bg-light navbar-fixed-top">
        <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="<?php echo base_url('Home');?>">
                    <img src="<?php echo base_url('assets/telemedicine/img/picture_logo.png')?>">
                  </a>  
                </div>
                <ul class="nav navbar-default navbar-right" >
                    <li class="nav-link">BAHASA</li>
                    <li>
                       <div class="form" >
                            <select class="form-control">
                                <option>Indonesia</option>
                                <option>English</option>
                            </select>
                        </div>
                    </li>
                </ul>
                
        </div>   
    </nav>

    <img class="wave" src="<?php echo base_url('assets/telemedicine/img/slider.svg')?>">
    <div class="container">
        <div class="img">
            <img src="<?php echo base_url('assets/telemedicine/img/note.svg')?>">
        </div>
        <div class="login-content">
            <form action="index.php">
                <img src="<?php echo base_url('assets/telemedicine/img/male.png')?>">
                <h2 class="title">Registration Pegawai</h2>
                <div class="input-div" style="margin: 10px; margin-right: 0px; margin-left: 0px">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <input type="text" class="input" name="email" placeholder="Nama">
                   </div>
                </div>
                <div class="input-div" style="margin: 10px; margin-right: 0px; margin-left: 0px">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <input type="text" class="input" name="email" placeholder="Username">
                   </div>
                </div>
                <div class="input-div"  style="margin: 10px; margin-right: 0px; margin-left: 0px">
                   <div class="i"> 
                        <i class="fas fa-envelope"></i>
                   </div>
                   <div class="div">
                        <input type="password" class="input" name="password" placeholder="Email">
                   </div>
                </div> 
                <div class="input-div pass"  style="margin: 10px; margin-right: 0px; margin-left: 0px">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                        <input type="password" class="input" name="password" placeholder="Password">
                   </div>
                </div> 
                <div class="input-div pass"  style="margin: 10px; margin-right: 0px; margin-left: 0px">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                        <input type="password" class="input" name="password" placeholder="Confirm Password">
                   </div>
                </div> 
                <input type="submit" class="btn" value="Daftar">
                <a href="<?php echo base_url('login');?>"><h6>Already have an account? Login</h6></a>

            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/telemedicine/js/maiin.js')?>">></script>
</body>
</html>