                    <div class="page-wrapper">
                      <div class="content">
                          <div class="row mb-5">
                              <div class="col-sm-5 col-5">
                                  <h4 class="page-title">Tambah Admin </h4>
                              </div>
                              <div class="col-sm-7 col-7">
                                <nav aria-label="">
                                    <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
                                    </ol>
                                </nav>
                              </div>
                          </div>
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form method="post" id="form-add-admin" onsubmit="return ubah();" action="<?php echo base_url('admin/Admin/addAdmin') ?>" enctype="multipart/form-data" autocomplete="off">
                                        <div class="row">
                                            <div class="col-sm-6">
											<?php $old = $this->session->flashdata('old_form'); $error = $this->session->flashdata('error'); ?>
                                                <div class="form-group">
                                                    <label>Username <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="username" id="username" <?php //echo $error != 'username' && $error != 'usernameAndEmail' ? 'value="'.$old['username'].'"' : '' ?> required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="email" name="email" id="email" <?php //echo $error != 'email' && $error != 'usernameAndEmail' ? 'value="'.$old['email'].'"' : '' ?> required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" name="password" id="password" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input class="form-control" type="password" name="confirmasipassword" id="confirmasipassword" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group gender-select">
                                                    <label class="gen-label">Tipe Admin:</label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value='1' name="id_user_level" id="id_user_level" <?php if($old){ echo $old['id_user_level'] == '1' ? 'checked' : ''; } ?> required>
                                                            <i class="fa fa-user fa-fw"></i> Super Admin
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value='2' name="id_user_level" id="id_user_level" <?php if($old){ echo $old['id_user_level'] == '2' ? 'checked' : ''; } ?> required>
                                                            <i class="fa fa-user fa-fw"></i> Admin Farmasi
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Nama <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="name" id="name" <?php echo isset($old) ? 'value="'.$old['name'].'"' : ''; ?> required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group gender-select">
                                                    <label class="gen-label">Jenis Kelamin:</label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value='Laki-laki' name="jenis_kelamin" id="jenis_kelamin" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'laki-laki' ? 'checked' : ''; } ?> required>
                                                            <i class="fa fa-male fa-fw"></i> Laki-laki
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value='Perempuan' name="jenis_kelamin" id="jenis_kelamin" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : ''; } ?> required>
                                                            <i class="fa fa-female fa-fw"></i> Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input class="form-control" type="text" name="lahir_tempat" id="lahir_tempat" <?php echo isset($old) ? 'value="'.$old['lahir_tempat'].'"' : ''; ?> required>
                                                </div>
                                            </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <div class="">
                                                            <input type="date" class="form-control" name="lahir_tanggal" id="lahir_tanggal" <?php echo isset($old) ? 'value="'.$old['lahir_tanggal'].'"' : ''; ?> required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                  <div class="row">
                                                  <div class="col-sm-6">
                                                        <label>Provinsi</label>
                                                        <div class="form-group">
                                                            <select class="form-control" name="alamat_provinsi" id="provinsi">
                                                                    <option>PILIH PROVINSI</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                                      <div class="form-group">
                                                        <label>Kabupaten/Kota</label>
                                                        <select class="form-control" name="alamat_kota" id="kotkab">
                                                                <option>PILIH KABUPATEN/KOTA</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                                      <div class="form-group">
                                                            <label>Kecamatan</label>
                                                            <!--<input type="text" class="form-control" name="alamat_kecamatan" value="<?php //echo ucwords($user->alamat_kecamatan) ?>"> -->
                                                            <select class="form-control" name="alamat_kecamatan" id="kecamatan">
                                                                    <option>PILIH KECAMATAN</option>
                                                            </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                                        <div class="form-group">
                                                            <label>Kelurahan</label>
                                                            <!--<input type="text" class="form-control" name="alamat_kelurahan" value="<?php //echo ucwords($user->alamat_kelurahan) ?>"> -->
                                                            <select class="form-control" name="alamat_kelurahan" id="kelurahan">
                                                                    <option>PILIH KELURAHAN</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                                      <div class="form-group">
                                                        <label>Kode Pos</label>
                                                        <input type="number" class="form-control" name="kode_pos" <?php echo isset($old) ? 'value="'.$old['kode_pos'].'"' : ''; ?> required>
                                                      </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>No Telepon </label>
                                                            <input class="form-control" type="number" name="telp" id="telp" <?php echo isset($old) ? 'value="'.$old['telp'].'"' : ''; ?> required>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                      <div class="form-group">
                                                        <label>Jalan</label>
                                                        <input type="text" class="form-control" name="alamat_jalan" id="alamat_jalan" <?php echo isset($old) ? 'value="'.$old['alamat_jalan'].'"' : ''; ?> required>
                                                      </div>
                                                    </div>
                                                <div class="col-sm-6">
                                                  <div class="form-group">
                                                    <label>Foto</label>
                                                    <div class="profile-upload">
                                                      <div class="upload-img">
                                                        <img alt="" src="/assets/dashboard/img/user.jpg">
                                                      </div>
                                                      <div class="upload-input">
                                                        <input type="file" class="form-control" name="foto" id="foto" size="10024" accept=".gif,.jpg,.jpeg,.jfif,.png" required>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="display-block">Status</label>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="aktif" id="status" value=1 <?php if($old){ echo $old['aktif'] == 1 ? 'checked' : ''; } ?> required>
                                                      <label class="form-check-label" for="">
                                                      Aktif
                                                      </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="aktif" id="status" value=0 <?php if($old){ echo $old['aktif'] == 0 ? 'checked' : ''; } ?> required>
                                                      <label class="form-check-label" for="">
                                                      Tidak Aktif
                                                      </label>
                                                    </div>
                                                <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="5" hidden>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button class="btn btn-primary submit-btn" id="btn-add-admin">Simpan</button>
                                            </div>
                                        </form>
                                        <div class="m-t-20 text-right">
                                            <a href="<?php echo base_url('admin/admin/manage_admin') ?>" type="button" class="btn btn-primary">Kembali <i class="fa fa-chevron-right"></i></a>
                                        </div>
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
      alert('Password dan Konfirmasi Password tidak sama!');
      // event.preventDefault();
      return false;
    }
    else{
      return true;
    }
  }
}
</script>

<?php echo $this->session->flashdata('msg_add_admin') ? "<script>alert('".$this->session->flashdata('msg_add_admin')."')</script>" : ''; ?>