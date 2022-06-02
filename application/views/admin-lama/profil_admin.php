 <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Profil Admin</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil Admin</li>
                </ol>
            </nav>
          </div>
      </div>            
                <div class="row">
                    <div class="col-sm-7 col-6">
                    </div>
                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <a href="<?php echo base_url('admin/Profil/edit');?>" class="btn btn-primary btn-rounded"><i class="fa fa-edit"></i> Edit Profil</a>
                    </div>
                </div>
                <div class="card-box profile-header">
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
                                        <div class="col-md-4 col-12">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $user->name;?></h3>
                                                <small class="text-muted">admin</small>
                                                <div class="staff-id"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">No Telepon</span>
                                                    <span class="text" style="color: #009efb">: <?php echo $user->telp;?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email</span>
                                                    <span class="text" style="color: #009efb">: <?php echo $user->email;?></span>
                                                </li>
                                                <li>
                                                <?php
                                                    $tanggal = new DateTime($user->lahir_tanggal);
                                                    $tanggal = $tanggal->format('d-m-Y');
                                                ?>
                                                    <span class="title">Tempat / Tanggal Lahir</span>
                                                    <span class="text">: <?php echo $user->lahir_tempat;?> / <?php echo $tanggal;?></span>
                                                </li>
                                                <li>
                                                    <br>
                                                </li>
                                                <li>
                                                    <span class="title">Jenis Kelamin</span>
                                                    <span class="text">: <?php echo $user->jenis_kelamin;?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Alamat</span>
                                                    <span class="text">: <?php echo 'Jalan '.ucwords(strtolower($user->alamat_jalan)).', Kel '.ucwords(strtolower($user->nama_kelurahan)).', Kec '.ucwords(strtolower($user->nama_kecamatan)).', Kab/Kota '.ucwords(strtolower($user->nama_kota)).', Kode Pos '.$user->kode_pos.', Provinsi '.ucwords(strtolower($user->nama_provinsi)) ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            </div>


 <?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>