
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
              <form method="post" id="form-edit-dokter" onsubmit="return ubah();" action="<?php echo base_url('admin/Dokter/updateDokter/'.$result->data[0]->id) ?>">
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Email address</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="email" required class="form-control" id="email" name="email" value="<?php echo $result->data[0]->email;?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Username</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="text" required class="form-control" id="username" name="username" value="<?php echo $result->data[0]->username;?>">
                    </div>
                  </div>
                </div>
                <!--<div class="form-group">
                  <div class="row">
                    <div class="col-lg-3">
                      <label for="exampleInputEmail1">Password</label>
                    </div>
                    <div class="col-lg-4">
                      <input required type="password" class="form-control" id="password" name="password" value="">
                    </div>
                  </div>
                </div>-->
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label>Status Akun</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <select class="form-control select2" required style="width: 100%;" name="aktif" id="aktif">
                        <?php if($result->data[0]->aktif == 0){?>
                          <option value="0" selected>Nonaktif</option>
                          <option value="1">Aktif</option>
                        <?php } else { ?>
                          <option value="0">Nonaktif</option>
                          <option value="1" selected>Aktif</option>
                        <?php } ?>
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
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Surat Tanda Registrasi (STR)</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="text" required class="form-control" name="str" id="str" value="<?php echo $result->data[0]->str;?>">
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="exampleInputPassword1">Nama</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" required class="form-control" name="name" id="name" value="<?php echo $result->data[0]->name;?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="exampleInputEmail1">Tempat/Tanggal Lahir</label> 
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group" style="padding-right: 43px">
                              <input type="text" required class="form-control" name="lahir_tempat" id="lahir_tempat" value="<?php echo $result->data[0]->lahir_tempat;?>">
                            </div>
                          </div>
                          <div class="col-lg-1">
                          <label style="padding-top: 5px">/</label>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <input type="date" required class="form-control" name="lahir_tanggal" id="lahir_tanggal" value="<?php echo $result->data[0]->lahir_tanggal;?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Jenis Kelamin</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <select class="form-control select2" required style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin">
                        <?php if($result->data[0]->jenis_kelamin == "Laki-laki"){?>
                          <option value="Laki-laki" selected="selected">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        <?php } else { ?>
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan" selected="selected">Perempuan</option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Jalan</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="text" class="form-control" required name="alamat_jalan" id="alamat_jalan" value="<?php echo $result->data[0]->alamat_jalan;?>">
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="exampleInputEmail1">Kelurahan/Desa</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" required name="alamat_kelurahan" id="alamat_kelurahan" value="<?php echo $result->data[0]->alamat_kelurahan;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="exampleInputEmail1">Kecamatan</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" required name="alamat_kecamatan" id="alamat_kecamatan" value="<?php echo $result->data[0]->alamat_kecamatan;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="exampleInputEmail1">Kabupaten/Kota</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" required name="alamat_kota" id="alamat_kota" value="<?php echo $result->data[0]->alamat_kota;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="exampleInputEmail1">Provinsi</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" required name="alamat_provinsi" id="alamat_provinsi" value="<?php echo $result->data[0]->alamat_provinsi;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="exampleInputEmail1">No. Telp/HP</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" required name="telp" id="telp" value="<?php echo $result->data[0]->telp;?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label>Poli</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <select class="form-control select2" style="width: 100%;" name="poli" required>
                        <?php foreach($list_poli as $poli){ ?>
                          <option value="<?php echo $poli->id ?>" <?php if($detail_dokter){if($poli->id == $detail_dokter->id_poli){ echo 'selected'; }} ?>><?php echo $poli->poli ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <label for="exampleInputEmail1">Pengalaman</label>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" name="pengalaman" placeholder="Tahun" value="<?php if($detail_dokter){echo $detail_dokter->pengalaman_kerja; } ?>" required>
                      </div>
                    </div>
                  </div>
                  <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="2" hidden>
              </div>
                <input name="id" id="id" value="<?php echo $result->data[0]->id;?>" hidden>

              <!-- /.card-body -->
              <div class="col-lg-12">
              <div class="row mb-5 mt-5 justify-content-center">
                <div class="col-lg-4 mb-3">
                  <button  class="btn btn-primary w-100" style="background-color: #1F60A8"  id="btn-edit-dokter">UBAH</button>
                </div>
                </form> 
                <div class="col-lg-4">
                  <a href="<?php echo base_url('admin/Dokter');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
                </div>
              </div>  
              </div>
              </div>
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