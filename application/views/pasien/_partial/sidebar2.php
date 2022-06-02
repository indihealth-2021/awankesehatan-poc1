  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4 bg-light-blue">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('pasien/Pasien') ?>" class="brand-link" style="text-align: center;">
      <img src="<?php echo base_url(); ?>assets/telemedicine/img/logo.png" width="150" height="70">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel pb-3 pt-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $user->foto ? base_url('assets/images/users/'.$user->foto) : base_url('assets/telemedicine/img/default.png'); ?>" class="img-circle elevation-2" alt="User Image" style="height: 2.5rem; width: 2.5rem;">
        </div>
        <div class="info" style="font-family:verdana,helvetica; font-weight: bold; margin-top: -5px">
          <a href="<?php echo base_url('pasien/Profile') ?>" class="d-block" align="center" style="color: #545454; " ><?php echo ucwords($user->name) ?></a>
          <a href="<?php echo base_url('pasien/Profile') ?>" class="d-block" align="left" style=" color: #545454;font-size: 11px" >Profile</a>
        </div>
      </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo base_url('pasien/Pasien') ?>" class="nav-link active-menu">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard Pasien
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="<?php echo base_url('pasien/Profile') ?>" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profil Pasien
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="<?php echo base_url('pasien/KonfigurasiAkun') ?>" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Konfigurasi Akun
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>  
