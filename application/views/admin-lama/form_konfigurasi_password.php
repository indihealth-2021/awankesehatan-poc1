<!-- Main content -->
    <div class="page-wrapper">
      <div class="content">
          <div class="row mb-3">
              <div class="col-sm-5 col-5">
                  <h4 class="page-title">Password</h4>
              </div>
              <div class="col-sm-7 col-7">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Password</li>
                    </ol>
                </nav>
              </div>
          </div>                        
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <div class="row">
                <form method="post" id="" onsubmit="return ubah();" action="<?php echo base_url('admin/KonfigurasiAkun/update_password'); ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label>Password Lama</label>
                              <input type="password" name="passwordlama" class="form-control" value="" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label>Password Baru</label>
                              <input type="password" name="password" id="password" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label>Confirm Password</label>
                              <input type="password" name="confirmasipassword" id="confirmasipassword" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" type="submit">Ubah</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
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

