  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4 bg-light-blue">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin/Admin') ?>" class="brand-link" style="text-align: center;">
      <img src="<?php echo base_url(); ?>assets/telemedicine/img/logo.png" width="150" height="70">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <div class="user-panel pb-3 pt-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $user->foto ? base_url('assets/images/users/'.$user->foto) : base_url('assets/telemedicine/img/default.png'); ?>" class="img-circle elevation-2" alt="User Image" style="height: 2.5rem; width: 2.5rem;">
        </div>
        <div class="info" style="font-family:verdana,helvetica; font-weight: bold; margin-top: -5px">
          <a href="<?php echo base_url('admin/Profil') ?>" class="d-block" align="center" style="color: #545454; " ><?php echo ucwords($user->name) ?></a>
          <a href="<?php echo base_url('admin/Profil') ?>" class="d-block" align="left" style=" color: #545454;font-size: 11px" >Profile</a>
        </div>
      </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo base_url('admin/admin') ?>" class="nav-link active-menu">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/Profil') ?>" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profil Admin
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?php echo base_url('admin/Admin/manage_admin');?>" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
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
          </li> -->
          <li class="nav-item ">
            <a href="<?php echo base_url('admin/KonfigurasiAkun') ?>" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Konfigurasi Akun
              </p>
            </a>
          </li>
          <!-- <li class="nav-item" style="padding-top: 190px">
            <a href="<?php echo base_url('admin/config') ?>" class="nav-link">
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
