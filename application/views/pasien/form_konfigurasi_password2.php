
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <!-- /.card -->

            <div class="card">
            <div class="card-header" style="background-color: #1F60A8; color: #fff">
              <div class="card-title">Password</div>
            </div>
            <div class="card-body">
              <form method="post" onsubmit="return ubah();" id="formKonfigurasiPassword" action="<?php echo base_url('pasien/KonfigurasiAkun/update_password'); ?>">
              <div class="col-lg-12">
              <div class="row justify-content-center" >
                <div class="col-lg-10">
                  <div class="form-group row justify-content-center">
                    <label for="staticEmail" class="col-lg-3 col-form-label">Password Lama</label>
                    <div class="col-lg-6">
                      <input type="password" name="passwordlama" class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="col-lg-10">
                  <div class="form-group row justify-content-center">
                    <label for="staticEmail" class="col-lg-3 col-form-label">Password Baru</label>
                    <div class="col-lg-6">
                      <input type="password" name="password" id="password" class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="col-lg-10">
                  <div class="form-group row justify-content-center">
                    <label for="staticEmail" class="col-lg-3 col-form-label">Confirm Password Baru</label>
                    <div class="col-lg-6">
                      <input type="password" name="confirmasipassword" id="confirmasipassword" class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 row mt-3">
                  <div class="col-lg-6 mb-2">
                    <button class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff" id="">Ubah</button>  
                  </div>
                  </form>
                  <div class="col-lg-6 mb-5">
                    <a href="<?php echo base_url('pasien/KonfigurasiAkun');?>"><button type="button" class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff" id="form-close">KEMBALI</button>  
                </a>  
                  </div>
                </div>
              </div>
              </div>
              </div>
              <!-- /.card-body -->
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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
