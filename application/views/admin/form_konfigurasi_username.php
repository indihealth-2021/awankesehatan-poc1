
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Profil') ?>" class="text-black">Pengaturan</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Akun</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">         
          <form method="post" action="<?php echo base_url('admin/KonfigurasiAkun/update_username'); ?>">
            <p class="title-form">Akun</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Username</label>
                    <input type="text" class="form-control floating" name="username" id="username" value="<?php echo $user->username?>">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Password</label>
                    <input type="password" class="form-control floating" name="password" value="<?php //echo $user->password?>">
                </div>
              </div> 
            </div>
            <div class="row mt-5">
              <div class="ml-3">
                <button type="submit" class="btn btn-simpan">Simpan</button>
                <a href="<?php echo base_url('admin/KonfigurasiAkun'); ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
              </div>
            </div>
          </form>
        </div>
      </div>

<?php if($this->session->flashdata('msg_poli')){ echo "<script>alert('".$this->session->flashdata('msg_poli')."')</script>"; } ?>