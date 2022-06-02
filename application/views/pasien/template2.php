<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Telemedicine | Pasien - <?php echo $title ?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
<!-- JQVMap -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/jqvmap/jqvmap.min.css') ?>">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/dist/css/adminlte.min.css') ?>">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/daterangepicker/daterangepicker.css') ?>">
<!-- summernote -->
<link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/plugins/summernote/summernote-bs4.css') ?>">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/dist/css/custom-dashboard.css">

    <?php   
        if(isset($css_addons)){
            echo $css_addons;
        }
    ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('Home');?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages 
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('logout') ?>" role="button">
          <i class="fas fa-sign-out-alt"></i> Log Out
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

    <?php 
	if(strtolower($this->uri->segments[1] == 'admin')){
		$this->load->view('admin/_partial/sidebar');
	}
	else if(strtolower($this->uri->segments[1] == 'dokter')){
		$this->load->view('dokter/_partial/sidebar');
	}
	else if(strtolower($this->uri->segments[1] == 'pasien')){
		$this->load->view('pasien/_partial/sidebar');
	}
	else{
		echo "Not Found";
	}
    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php echo ucfirst($this->uri->segments[1]) ?></a></li>
              <li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segments[2]) ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php $this->load->view($view) ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="width: 300px">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Panggilan...</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" align="center">
                          <i class="fa fa-phone fa-5x" style="color: #007Bff;">....</i>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-info" data-dismiss="modal" onclick="Jawab()">Jawab</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        </div>
                      </div>
                    </div>
                  </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="background-color: #2C94D2; color: #000000">
    <div class="float-right d-none d-sm-block">
      Version 3.0.4
    </div>
    Copyright &copy; 2020. Indihealth & Lintasarta. All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/adminLTE/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Sparkline -->
<!-- <script src="<?php echo base_url('assets/adminLTE/plugins/sparklines/sparkline.js') ?>"></script> -->
<!-- JQVMap -->
<script src="<?php echo base_url('assets/adminLTE/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/adminLTE/plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminLTE/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/adminLTE/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminLTE/dist/js/adminlte.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url('assets/adminLTE/dist/js/pages/dashboard.js') ?>"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/adminLTE/dist/js/demo.js') ?>"></script>
<?php   
    if(isset($js_addons)){
        echo $js_addons;
    }
?>
<?php
// socket config
$host = $this->config->item('socket')['host'];
$port = $this->config->item('socket')['port'];
?>
<script type="text/javascript" src="<?php echo $host . ':' . $port ?>/socket.io/socket.io.js"></script>
<script>
    var socket = {
        host: '<?php echo $host?>',
        port: '<?php echo $port?>'
    };
</script>
 <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js"></script>
   <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-messaging.js"></script>

  <script>    
    baseUrl = '<?php echo base_url();?>';
    var loadData;
    var firebaseConfig = {
        apiKey: "AIzaSyD936QRnRMkq02IgQ1kMg5ZYB1hEcuTwUM",
        authDomain: "telehealth-6a164.firebaseapp.com",
        databaseURL: "https://telehealth-6a164.firebaseio.com",
        projectId: "telehealth-6a164",
        storageBucket: "telehealth-6a164.appspot.com",
        messagingSenderId: "513400070049",
        appId: "1:513400070049:web:7da9b8978395a153a875e0"
    };
        firebase.initializeApp(firebaseConfig);
        const pesan = firebase.messaging();
          pesan.getToken().then((currentToken) => {
        if (currentToken) {         
          $.ajax({
            method : 'POST',
            url    : baseUrl+"pasien/Pasien/RegId",
            data   : {reg_id:currentToken},
            success : function(data){              
              if(data){
                console.log("update reg id berhasil");
              }else{
                console.log("update reg id gagal");
              }
            },
            error : function(data){
               alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
            }
            

          });
        } else {          
          console.log('No Instance ID token available. Request permission to generate one.');          
        }
      }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        showToken('Error retrieving Instance ID token. ', err);
        setTokenSentToServer(false);
      });

        pesan.onTokenRefresh(() => {
        pesan.getToken().then((refreshedToken) => {
          $.ajax({
            method : 'POST',
            url    : baseUrl+"pasien/Pasien/RegId",
            data   : {reg_id:refreshedToken},
            success : function(data){
             if(data){
                console.log("refresh reg id berhasil");
              }else{
                console.log("refresh reg id gagal");
              }
            },
            error : function(data){
               alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
            }
            

          });
        }).catch((err) => {
          console.log('Unable to retrieve refreshed token ', err);
          showToken('Unable to retrieve refreshed token ', err);
        });
      });       
        pesan.onMessage(function(payload) {
            var test = payload || {};                    
            $('#exampleModal').modal('show');      
            loadData = test.data.body; 
                                  
        });
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/answer.js');?>"></script>
</body>

</html>
