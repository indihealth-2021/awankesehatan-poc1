
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header col-lg-12 " style="background-color: #1F60A8; color: #fff">
                <div class="card-title">User Login</div>
              </div>
              <form method="post" id="form-add-admin" onsubmit="return ubah();" action="<?php echo base_url('admin/Admin/addAdmin') ?>">
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 ">
                      <label for="exampleInputEmail1">Email address</label>
                    </div>
                    <div class="col-lg-4 ">
                      <input required type="email" class="form-control" id="email" name="email">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3">
                      <label for="exampleInputEmail1">Username</label>
                    </div>
                    <div class="col-lg-4">
                      <input required type="text" class="form-control" id="username" name="username">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3">
                      <label for="exampleInputEmail1">Password</label>
                    </div>
                    <div class="col-lg-4">
                      <input required type="password" class="form-control" id="password" name="password">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3">
                      <label>Status Akun</label>
                    </div>
                    <div class="col-lg-4">
                      <select required class="form-control select2" style="width: 100%;" name="aktif" id="aktif">
                        <option value="0" selected="selected">Nonaktif</option>
                        <option value="1">Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="card">
                <div class="card-header col-lg-12 " style="background-color: #1F60A8; color: #fff">
                <div class="card-title">Biodata</div>
              </div>
                <div class="card-body">
                <!-- Date range -->
                <!--<div class="form-group">
                  <div class="row">
                    <div class="col-lg-3">
                      <label for="exampleInputEmail1">Surat Tanda Registrasi (STR)</label>
                    </div>
                    <div class="col-lg-4">
                      <input required type="text" class="form-control" name="str" id="str">
                    </div>
                  </div>
                </div>-->
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="exampleInputPassword1">Nama</label>
                      </div>
                      <div class="col-lg-4">
                        <input required type="text" class="form-control" name="name" id="name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3">
                        <label for="exampleInputEmail1">Tempat/Tanggal Lahir</label> 
                      </div>
                      <div class="col-lg-9">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group" style="padding-right: 43px">
                              <input required type="text" class="form-control" name="lahir_tempat" id="lahir_tempat">
                            </div>
                          </div>
                          <div class="col-lg-1">
                          <label style="padding-top: 5px">/</label>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <input required type="date" class="form-control" name="lahir_tanggal" id="lahir_tanggal">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 ">
                        <label>Jenis Kelamin</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <select required class="form-control select2" style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin">
                          <option value="Laki-laki" selected="selected">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 ">
                      <label for="exampleInputEmail1">Jalan</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input required type="text" class="form-control" name="alamat_jalan" id="alamat_jalan">
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="exampleInputEmail1">Kelurahan/Desa</label>
                      </div>
                      <div class="col-lg-4">
                        <input required type="text" class="form-control" name="alamat_kelurahan" id="alamat_kelurahan">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="exampleInputEmail1">Kecamatan</label>
                      </div>
                      <div class="col-lg-4">
                        <input required type="text" class="form-control" name="alamat_kecamatan" id="alamat_kecamatan">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="exampleInputEmail1">Kabupaten/Kota</label>
                      </div>
                      <div class="col-lg-4">
                        <input required type="text" class="form-control" name="alamat_kota" id="alamat_kota">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="exampleInputEmail1">Provinsi</label>
                      </div>
                      <div class="col-lg-4">
                        <input required type="text" class="form-control" name="alamat_provinsi" id="alamat_provinsi">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label for="exampleInputEmail1">No. Telp/HP</label>
                      </div>
                      <div class="col-lg-4">
                        <input required type="text" class="form-control" name="telp" id="telp">
                      </div>
                    </div>
                  </div>
                  <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="5" hidden>
              </div>
              
               <div class="col-lg-12">
              <div class="row mb-5 mt-5 justify-content-center">
                <div class="col-lg-4 mb-3">
                  <button type="submit"  class="btn btn-primary w-100" style="background-color: #1F60A8"  id="btn-add-admin">TAMBAH</button>
                </div>
                </form>
                <div class="col-lg-4">
                  <a href="<?php echo base_url('admin/Admin/manage_admin');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
                </div>
              </div>  
              </div>
              </div>
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<script>
function ubah(){
  var password = document.getElementById('password').value;
  if(password.length < 8){
    alert('Password minimal berisi 8 karakter!');
    return false;
  }
  else{
    return true;
  }
}
</script>