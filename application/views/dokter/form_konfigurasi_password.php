
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content" style="height: 700px">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/Profile');?>"class="text-black">Pengaturan</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href=""class="text-black font-bold-7">Edit Akun</a></li>
                </ol>
            </nav>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php if($this->session->flashdata('msg_fail') != null): ?>
          <div class="alert-warning"><?= $this->session->flashdata('msg_fail') ?></div>
        <?php endif; ?>
          <?php if($this->session->flashdata('msg_success') != null): ?>
          <div class="alert-success"><?= $this->session->flashdata('msg_success') ?></div>
        <?php endif; ?>         
         <form method="post" id="" onsubmit="return ubah();" action="<?php echo base_url('dokter/KonfigurasiAkun/update_password'); ?>">
            <p class="title-form">Akun</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Password Lama</label>
                    <input type="password" name="passwordlama" class="form-control floating">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control floating">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Konfirmasi Password</label>
                    <input type="password" name="confirmasipassword" id="confirmasipassword" class="form-control floating">
                </div>
              </div>
            </div>
            <div class="row mt-5">
              <div class="ml-3">
                <button type="submit" class="btn btn-simpan">Simpan</button>
                <a href="<?php echo base_url('dokter/KonfigurasiAkun'); ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
              </div>
            </div>
          </form>
        </div>
      </div>


<script>
function ubah(){
  var password_baru = document.getElementById('password').value;
  var konfirmasi_password = document.getElementById('confirmasipassword').value;

  if(password_baru.length < 8){
    alert('Password minimal berisi 8 karakter!')
    // event.preventDefault();
    return false;
  }
  else{
    if(password_baru != konfirmasi_password){
      alert('Password Baru dan Konfirmasi Password Baru tidak sama!');
      // event.preventDefault();
      return false;
    }
    else{
      return true;
    }
  }
}
</script>

<?php if($this->session->flashdata('msg_poli')){ echo "<script>alert('".$this->session->flashdata('msg_poli')."')</script>"; } ?>
