
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/admin/manage_admin') ?>" class="text-black">User Management</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Admin</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">  
          <?= form_open_multipart('admin/Admin/updateAdmin/'.$data->id, 'id="form-edit-admin" onsubmit="return ubah();"'); ?>

            <p class="title-form">Akun</p>
            <div class="row">
              <div class="col-md-4">
                <?php $old = $this->session->flashdata('old_form'); $error = $this->session->flashdata('error'); ?>
                <div class="form-group form-focus">
                    <label class="focus-label">Username</label>
                    <input type="text" class="form-control floating" id="username" name="username" value="<?php echo $data->username;?>" required placeholder="Masukan Username">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Email</label>
                    <input type="email" class="form-control floating" id="email" name="email" value="<?php echo $data->email;?>" required placeholder="Masukan Email">
                </div>
              </div>
            </div>

            <p class="title-form">Tipe Admin</p>
            <div class="row">
              <div class="col-sm-12 font-14">
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value='2' name="id_user_level" id="id_user_level" <?php echo $data->id_user_level == '2' ? 'checked' : ''; ?>  required>Admin Farmasi
                    </label>
                  </div>
                  <div class="form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="id_user_level" class="form-check-input" value="1" <?php echo $data->id_user_level == '1' ? 'checked' : ''; ?> required>Super Admin
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <p class="title-form">Informasi Pribadi</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nama Lengkap</label>
                    <input type="text" class="form-control floating" name="name" id="name" value="<?php echo $data->name;?>" required placeholder="Masukan Nama Lengkap Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tempat Lahir</label>
                    <input type="text" class="form-control floating" name="lahir_tempat" id="lahir_tempat" required value="<?php echo $data->lahir_tempat;?>" required placeholder="Masukan Tempat Lahir Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal Lahir</label>
                    <input type="date" class="form-control floating" name="lahir_tanggal" id="lahir_tanggal" required value="<?php echo $data->lahir_tanggal;?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-sm-12 font-14">
                    <label class="gen-label text-label-form">Jenis Kelamin :</label>
                    <div class="form-group gender-select">
                      <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" id="jenis_kelamin" <?php echo strtolower($data->jenis_kelamin) == 'laki-laki' ? 'checked' : ''; ?> required>
                                  Laki-laki
                        </label>
                      </div>
                      <div class="form-check-inline pl-5">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" id="jenis_kelamin" <?php echo strtolower($data->jenis_kelamin) == 'perempuan' ? 'checked' : ''; ?> required>
                                  Perempuan
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Provinsi</label>
                      <select class="form-control floating" name="alamat_provinsi" id="provinsi">
                        <?php if($data->id_provinsi){ ?>
                            <option value="<?php echo $data->id_provinsi ?>"><?php echo $data->nama_provinsi ?></option>
                        <?php } else { ?>
                            <option>PILIH PROVINSI</option>
                        <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kabupaten/Kota</label>
                      <select class="form-control floating" name="alamat_kota" id="kotkab">
                        <?php if($data->id_kota){ ?>
                            <option value="<?php echo $data->id_kota ?>"><?php echo $data->nama_kota ?></option>
                        <?php } else { ?>
                            <option>PILIH KABUPATEN/KOTA</option>
                        <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kecamatan</label>
                      <select class="form-control floating" name="alamat_kecamatan" id="kecamatan">
                        <?php if($data->id_kecamatan){ ?>
                            <option value="<?php echo $data->id_kecamatan ?>"><?php echo $data->nama_kecamatan ?></option>
                        <?php } else { ?>
                            <option>PILIH KECAMATAN</option>
                        <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kelurahan</label>
                      <select class="form-control floating" name="alamat_kelurahan" id="kelurahan">
                        <?php if($data->id_kelurahan){ ?>
                            <option value="<?php echo $data->id_kelurahan ?>"><?php echo $data->nama_kelurahan ?></option>
                        <?php } else { ?>
                            <option>PILIH KELURAHAN</option>
                        <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kode Pos</label>
                    <input type="text" class="form-control floating" name="kode_pos" id="kode_pos" value="<?php echo $data->kode_pos;?>" placeholder="Masukan Kode Pos">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Alamat Jalan</label>
                    <input type="text" class="form-control floating" name="alamat_jalan" id="alamat_jalan" value="<?php echo $data->alamat_jalan;?>" required placeholder="Masukan Alamat Jalan">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nomor Telepon</label>
                    <input type="number" class="form-control floating" name="telp" id="telp" value="<?php echo $data->telp;?>" required placeholder="Masukan Nomor Telepon">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="profile-upload">
                    <div class="upload-img">
                      <img alt="" src="<?php echo base_url('assets/images/users/'.$data->foto) ?>">
                    </div>
                    <div class="upload-input">
                      <input type="file" class="form-control" name="foto" id="foto" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                    </div>
                  </div>
                </div>
              </div>  
            </div>

            <div class="row">
              <div class="col-sm-12 font-14">
                <label class="gen-label text-label-form">Status :</label>
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=1 required <?php echo $data->aktif ? 'checked' : ''; ?> required>Aktif
                    </label>
                  </div>
                  <div class="form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=0 required <?php echo $data->aktif == 0 ? 'checked' : ''; ?> required>Non Aktif
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="mx-auto">
                <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="5" hidden>
                <button class="btn btn-simpan" id="btn-edit-admin">Simpan</button>
                <a href="<?php echo base_url('admin/admin/manage_admin') ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
              </div>
            </div>
          <?= form_close(); ?>
        </div>
      </div> 
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

              
<?php echo $this->session->flashdata('msg_edit_admin') ? "<script>alert('".$this->session->flashdata('msg_edit_admin')."')</script>" : ''; ?>