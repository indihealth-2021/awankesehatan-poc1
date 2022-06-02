<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Telemedicine | Dasboard Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Custom style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/dist/css/custom-dashboard.css">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/adminLTE/ckeditor/css/style.css">
    <?php
    echo isset($css_addons) ? $css_addons : '';
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

  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4 bg-light-blue">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="text-align: center;">
      <img src="<?php echo base_url(); ?>assets/telemedicine/img/logo.png" width="150" height="70">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url(); ?>assets/adminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Profile Admin</a>
        </div>
      </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if ($menu == 0) { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active-menu">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard Admin
              </p>
            </a>
          </li>
        <?php } else{ ?>
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo base_url('admin/admin') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard Admin
              </p>
            </a>
          </li>
        <?php } ?>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/Admin/manage_admin');?>" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('admin/dokter') ?>" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Dokter
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('admin/pasien') ?>" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Pasien
              </p>
            </a>
          </li>
          <!-- <li class="nav-item" style="padding-top: 190px">
            <a href="<?php //echo base_url('admin/config') ?>" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Konfigurasi</p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- Sidebar Menu -->
      <!-- <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item bg-dark-blue mb-1" style="padding: 10px">
              <p class="text-white my-auto">
                <span style="font-size: 24px">Dashboard <span class="text-14">&nbspAdmin</span> </span> 
              </p>
          </li>
          <li class="nav nav-treeview">
              <li class="nav-item bg-dark-blue-menu">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-circle nav-icon text-white"></i>
                  <p class="text-white">Profile</p>
                </a>
              </li>
              <li class="nav-item bg-dark-blue-menu">
                <a href="./index.html" class="nav-link">
                  <i class="fas fa-user-alt nav-icon text-white"></i>
                  <p class="text-white">Admin</p>
                </a>
              </li>
              <li class="nav-item bg-dark-blue-menu">
                <a href="./index.html" class="nav-link">
                  <i class="fas fa-user-md nav-icon text-white"></i>
                  <p class="text-white">Dokter</p>
                </a>
              </li>
              <li class="nav-item bg-dark-blue-menu">
                <a href="./index.html" class="nav-link">
                  <i class="fas fa-user-circle nav-icon text-white"></i>
                  <p class="text-white">Pasien</p>
                </a>
              </li>
              <li class="nav-item" style="padding-top: 220px">
                <a href="https://adminlte.io/docs/3.0" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>Konfigurasi</p>
                </a>
              </li>
            </li>
        </ul>
      </nav> -->
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>  
<!-- Content Wrapper. Contains page content -->

    <?php
    $this->load->view($view);
    ?>

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
<script>
    var base_url = "<?= base_url('') ?>";
</script>
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/adminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminLTE/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>assets/adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/adminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/adminLTE/dist/js/demo.js"></script>
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dokter.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pasien.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminLTE/ckeditor/ckeditor.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('.select2').select2()

    $("#table_news").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    // $("#table_admin").DataTable({
    //   "responsive": true,
    //   "autoWidth": false,
    // });
    $("#table_selfAssesment").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    CKEDITOR.replace('ckedtor');
  });
</script>
    <script>
    $('#file_upload').change(function() {
      var file = $('#file_upload')[0].files[0].name;
      $('#filename').text(file);
    });    
    </script>

    <?php
    echo isset($js_addons) ? $js_addons : '';
    ?>
</body>
</html>
