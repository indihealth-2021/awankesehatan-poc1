
    <!-- Main content -->
<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Profil') ?>" class="text-black font-bold-7">Pengaturan</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Pengaturan</h3>
          </div>
      </div>


      <div class="card-box-profile profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <img class="avatar" src="<?php echo $user->foto ? base_url('assets/images/users/'.$user->foto) : base_url('assets/telemedicine/img/default.png'); ?>" alt="">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5 col-12 mt-4">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0 text-profil"><b><?php echo $user->name;?></b></h3>
                                                <small class="text-subprofil">admin</small>
                                                <div class="mt-4">
                                                  <a href="<?php echo base_url('admin/Profil/edit') ?>"><button type="button" class="btn btn-edit-profile"  id="btn-add-admin">Edit Profile</button></a>
                                                  <a href="<?php echo base_url('admin/KonfigurasiAkun'); ?>"><button type="button" class="btn btn-edit-profile"  id="btn-add-admin">Edit Akun</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-12 mt-3">
                                            <ul class="personal-info text-info-left">
                                                <li>
                                                    <span><?php echo $user->email;?></span>
                                                </li>
                                                <li>
                                                    <span><?php echo $user->telp;?></span>
                                                </li>
                                                <li>
                                                    <span><?php echo $user->jenis_kelamin;?></span>
                                                </li>
                                                <li>
                                                    <span><?php echo 'Jalan '.ucwords(strtolower($user->alamat_jalan)).', Kel '.ucwords(strtolower($user->nama_kelurahan)).', Kec '.ucwords(strtolower($user->nama_kecamatan)).', Kab/Kota '.ucwords(strtolower($user->nama_kota)).', Kode Pos '.$user->kode_pos.', Provinsi '.ucwords(strtolower($user->nama_provinsi)) ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>

            <!-- <p class="title-form mt-4">Akun</p>
            <div class="row">
              <div class="col-md-4">
                <?php $old = $this->session->flashdata('old_form'); $error = $this->session->flashdata('error'); ?>
                <div class="form-group form-focus">
                    <label class="focus-label">Username</label>
                    <input type="text" class="form-control floating" value="<?php echo $user->username;?>" name="username" id="username" <?php //echo $error != 'username' && $error != 'usernameAndEmail' ? 'value="'.$old['username'].'"' : '' ?> readonly disabled required placeholder="Masukan Username">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Email</label>
                    <input type="email" class="form-control floating" name="email" id="email" value="<?php echo $user->email;?>" <?php //echo $error != 'email' && $error != 'usernameAndEmail' ? 'value="'.$old['email'].'"' : '' ?> readonly disabled required placeholder="Masukan Email">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Password</label>
                    <input type="password" class="form-control floating" readonly disabled value="<?php echo $user->password;?>" name="password" id="password" required placeholder="Masukan Password">
                </div>
              </div> 
            </div> -->

            <div class="row">
              <div class="col-md-4">
                
              </div>
            </div>
            <?php if($user->id_user_level == 1){ ?>
            <p class="title-form mt-5">Lihat Log Activity</p>
            <div class="row">
              <div class="col-md-4">
                <a href="<?php echo base_url('admin/LogActivity') ?>"><button type="button" class="btn btn-edit-akun"  id="btn-add-admin">Lihat Disini</button></a>
              </div>
            </div>
            <?php } ?>
  </div>
</div>  