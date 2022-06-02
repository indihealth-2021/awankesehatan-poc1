<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Telemedicine | <?php echo ucfirst($this->uri->segments[1]) ?> - <?php echo $title ?></title>
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

<script src='https://meet.jit.si/external_api.js'></script>
    <?php   
        if(isset($css_addons)){
            echo $css_addons;
        }
    ?>
    <script src="<?php echo base_url('assets/bower_components/lodash/dist/lodash.min.js')?>"></script>
     <script type="text/javascript">
          var id = 0;
          var reg_d;
          var loadData;
          var siteUrl = "<?php echo base_url(); ?>";
          var baseUrl = "<?php echo base_url(); ?>";
          var socket = {
            host: '<?php echo $this->config->item('socket')['host']; ?>',
            port: '<?php echo $this->config->item('socket')['port']; ?>'
          };
      </script>
      <script type="text/javascript" src="<?php echo $this->config->item('socket')['host'] . ':' . $this->config->item('socket')['port']; ?>/socket.io/socket.io.js"></script>

      <style>
        #notif {
          max-height: 500px;
          overflow-y: auto;
        }
      </style>

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
<!--      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('Home');?>" class="nav-link">Home</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <?php if($this->uri->segments[1] != 'admin'){ ?>
    <!-- Notifications Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-envelope"></i>
          <span class="badge badge-warning navbar-badge" id="message-count">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="pesan">
              <!--<a href="" class="dropdown-item">
                <i class="fa fa-envelope-o mr-2"></i> <span title=''></span><br/>
                <span class="float-left text-muted text-sm"></span>
              </a><br/>
              <div class="dropdown-divider"></div>-->
<!--          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
        </div>
      </li>
      <?php } ?>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="notif-count"><?php echo count($list_notifikasi) ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notif">
        <?php if(count($list_notifikasi) > 0){ ?>
        <a href="#" onclick="return readAllNotif()" class="dropdown-item dropdown-footer">Tandai Semua Sebagai Sudah Dibaca</a>
        <div class="dropdown-divider"></div>
        <?php } ?>
        <div id="isi_notif">
        <?php foreach($list_notifikasi as $notif){ ?>
          		<a href="<?php echo $notif->direct_link ?>" onclick="return readNotif(<?php echo $notif->id ?>);" class="dropdown-item">
            		<i class="fas fa-envelope mr-2"></i> <span title='<?php echo $notif->notifikasi ?>'><?php echo substr($notif->notifikasi, 0, 30) ?></span><br/>
            		<span class="float-left text-muted text-sm"><?php echo $notif->tanggal ?></span>
          		</a><br/>
          		<div class="dropdown-divider"></div>
<!--          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
        <?php } ?>
        </div>
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

    <input type="hidden" id="tele-conference-username" value="<?php echo $user->id ?>"/>
    <input type="hidden" id="user-call"/>
<audio controls id="bell-ring" style="display:none;">
  <source src="<?php echo base_url('assets/sounds/bell_ring.ogg') ?>" type="audio/ogg">
  <source src="<?php echo base_url('assets/sounds/bell_ring.mp3') ?>" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
    <?php $this->load->view($view) ?>
        <div class="modal fade" id="jawaban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <button type="button" class="btn btn-info" data-dismiss="modal" id="jawab" data-id-jadwal-konsultasi="" data-room-name="" data-id-dokter="">Jawab</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="tolak" data-id-dokter="">Tutup</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="dialogConfirmationDelete" title="PERHATIAN" style="background: white; width: auto; min-height: 30px; max-height: none; height: auto;"></div>
  </div>
  <!-- /.content-wrapper -->
  <!-- <div class="col-lg-12"> -->
    <footer class="main-footer" style="background-color: #2C94D2; color: #000000;">
      <div class="float-right d-none d-sm-block">
        Version 3.0.4
      </div>
      Copyright &copy; 2020. Indihealth & Lintasarta. All rights
      reserved.
    </footer>  
 <!--  </div> -->
  

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


 <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js"></script>
 <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-database.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-auth.js"></script>
   <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-messaging.js"></script>

  <script>    
    baseUrl = '<?php echo base_url();?>';
    
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
            url    : baseUrl+"Conference/RegId",
            data   : {reg_id:currentToken},
            success : function(data){              
              if(data){
                console.log("update reg id berhasil");
              }else{
                console.log("update reg id gagal");
              }
            },
            error : function(data){
               alert('Terjadi kesalahan firebase, refresh kembali browser anda.');
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
            url    : baseUrl+"Conference/RegId",
            data   : {reg_id:refreshedToken},
            success : function(data){
             if(data){
                console.log("refresh reg id berhasil");
              }else{
                console.log("refresh reg id gagal");
              }
            },
            error : function(data){
               alert('Terjadi kesalahan firebase, refresh kembali browser anda.');
            }
            

          });
        }).catch((err) => {
          console.log('Unable to retrieve refreshed token ', err);
          showToken('Unable to retrieve refreshed token ', err);
        });
      });       
        pesan.onMessage(function(payload) {
            var test = payload || {};   
             loadData = test.data.body;  
              console.log("test"+loadData);
           //  $("#jawaban").modal('show');
           if(loadData=="ok"){
                $('#memanggil').modal('hide');
            }    
	    var userid = <?php echo $user->id ?>;
      <?php if(isset($teleconsul_admin_js)){
              echo $teleconsul_admin_js;
      } ?>
	    if(JSON.parse(JSON.parse(payload.data.body).id_user).includes(userid.toString())){
        if(JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_berakhir_pasien')){
            location.href = "<?php echo base_url('pasien/Pasien') ?>";
        }
        if(JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_dokter')){
          $('#memanggil').modal('hide');
        }
        if(JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_pasien')){
                $("#jawab").data('id-jadwal-konsultasi', JSON.parse(payload.data.body).id_jadwal_konsultasi);
                $("#jawab").data('id-dokter', JSON.parse(payload.data.body).id_dokter);
                $("#jawab").data('room-name', JSON.parse(payload.data.body).roomName);
                $('#tolak').data('id-dokter', JSON.parse(payload.data.body).id_dokter);
                $("#jawaban").modal('show');                  
        }
        if(JSON.parse(JSON.parse(payload.data.body).name == 'reject_konsultasi')){
            $('#memanggil').modal('hide');
            alert(JSON.parse(payload.data.body).keterangan);
        }
		var data = JSON.parse(payload.data.body);
		var notif = document.getElementById('isi_notif');
    var notif_count = document.getElementById('notif-count');
    var pesan = document.getElementById('pesan');
    var message_count = document.getElementById('message-count');      
    var jml_message = message_count.innerHTML;
    var jml_notif = notif_count.innerHTML;
	    	var template_notif = `
          		<a href="${data.direct_link}" class="dropdown-item">
            		<i class="fas fa-envelope mr-2"></i> <span title='${data.keterangan}'>${data.keterangan.substring(0,30)+'...'}</span><br/>
            		<span class="float-left text-muted text-sm">${data.tanggal}</span>
          		</a><br/>
          		<div class="dropdown-divider"></div>
	    	`;
        if(JSON.parse(JSON.parse(payload.data.body).name != 'pesan')){
          var audio = document.getElementById('bell-ring');
          audio.play();
          notif.innerHTML = template_notif+notif.innerHTML;
          notif_count.innerHTML = parseInt(jml_notif)+1
        }
        else{
          pesan.innerHTML = template_notif+pesan.innerHTML;
          message_count.innerHTML = parseInt(jml_message)+1;
        }
		console.log(JSON.parse(payload.data.body));
            }        
        });
</script>
<script>
var username = document.getElementById('username');
var email = document.getElementById('email');

if(username){
  username.onkeyup = function(){
      this.value = this.value.toLowerCase();
      this.value = this.value.replace(' ','');
  }
}
if(email){
  email.onkeyup = function(){
      this.value = this.value.toLowerCase();
      this.value = this.value.replace(' ','');
  }
}
</script>

<script>
function readNotif(id_notif){
  $.ajax({
    method : 'GET',
    url    : baseUrl+"Notifikasi/baca/"+id_notif,
    success : function(data){
      return true;
    },
    error : function(data){
      return false;
    }
  });
}

function readAllNotif(){
  $.ajax({
    method : 'GET',
    url    : baseUrl+"Notifikasi/bacaSemua",
    success : function(data){
      return true;
    },
    error : function(data){
      return false;
    }
  });
}
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/teleconference/main.js');?>"></script>
<?php   
    if(isset($js_addons)){
        echo $js_addons;
    }
?>
<!-- <script src="<?php //echo base_url('assets/js/teleconference/MediaStreamRecorder.js') ?>"></script>   
      <script src="<?php //echo base_url('assets/js/teleconference/RecordRTC.js') ?>"></script>   
<script type="text/javascript" src="<?php //echo base_url('assets/js/teleconference/conference.js');?>"></script>-->
</body>
</html>
