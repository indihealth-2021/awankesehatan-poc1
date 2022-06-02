
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/RumahSakit/users') ?>" class="text-black">User Management</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/RumahSakit/form_edit_user_rs') ?>" class="text-black font-bold-7">Edit User</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">         
          <form method="post" id="form-add-user" onsubmit="return ubah();" action="<?php echo base_url('admin/RumahSakit/edit_user/'.$user_rs->id) ?>" autocomplete="off">
            <p class="title-form">Informasi Pribadi</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nama Rumah Sakit</label>
                    <input type="text" class="form-control floating" name="name" id="name" <?php echo 'value="'.$user_rs->name.'"'; ?> required>
                </div>
              </div> 
            </div>
            <p class="title-form">Akun</p>
            <div class="row">
              <div class="col-md-4">
                <?php $old = $this->session->flashdata('old_form'); $error = $this->session->flashdata('error'); ?>
                <div class="form-group form-focus">
                    <label class="focus-label">Username</label>
                    <input type="text" class="form-control floating" name="username" id="username" <?php echo 'value="'.$user_rs->username.'"' ?> required>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Email</label>
                    <input type="email" class="form-control floating" name="email" id="email" <?php echo 'value="'.$user_rs->email.'"' ?> required>
                </div>
              </div>
            </div>

            <p class="title-form">Tipe User</p>
            <div class="row">
              <div class="col-sm-12 font-14">
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value='1' name="id_user_level" id="id_user_level" <?php echo $user_rs->id_user_level == '1' ? 'checked':'';  ?> required> Diampu
                    </label>
                  </div>
                  <div class="form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value='2' name="id_user_level" id="id_user_level" <?php echo $user_rs->id_user_level == '2' ? 'checked':''; ?> required> Pengampu
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <!-- <p class="title-form">Informasi Pribadi</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nama Lengkap</label>
                    <input type="text" class="form-control floating" name="name" id="name" <?php echo isset($old) ? 'value="'.$old['name'].'"' : ''; ?> required placeholder="Masukan Nama Lengkap Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tempat Lahir</label>
                    <input type="text" class="form-control floating" name="lahir_tempat" id="lahir_tempat" <?php echo isset($old) ? 'value="'.$old['lahir_tempat'].'"' : ''; ?> required placeholder="Masukan Tempat Lahir Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal Lahir</label>
                    <input type="date" class="form-control floating" name="lahir_tanggal" id="lahir_tanggal" <?php echo isset($old) ? 'value="'.$old['lahir_tanggal'].'"' : ''; ?> required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-sm-12 font-14">
                    <label class="gen-label text-label-form">Jenis Kelamin :</label>
                    <div class="form-group gender-select">
                      <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" class="form-check-input" value="Perempuan" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : ''; } ?> required>
                                  Laki-laki
                        </label>
                      </div>
                      <div class="form-check-inline pl-5">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" class="form-check-input" value="Perempuan" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : ''; } ?> required>
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
                        <option>Pilih Provinsi</option>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kabupaten/Kota</label>
                      <select class="form-control floating" name="alamat_kota" id="kotkab">
                        <option>Pilih Kab/Kota</option>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kecamatan</label>
                      <select class="form-control floating" name="alamat_kecamatan" id="kecamatan">
                        <option>Pilih Kecamatan</option>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kelurahan</label>
                      <select class="form-control floating" name="alamat_kelurahan" id="kelurahan">
                        <option>Pilih Kelurahan</option>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kode Pos</label>
                    <input type="text" class="form-control floating" name="kode_pos" <?php echo isset($old) ? 'value="'.$old['kode_pos'].'"' : ''; ?> required placeholder="Masukan Kode Pos">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Alamat Jalan</label>
                    <input type="text" class="form-control floating" name="alamat_jalan" id="alamat_jalan" <?php echo isset($old) ? 'value="'.$old['alamat_jalan'].'"' : ''; ?> required placeholder="Masukan Alamat Jalan">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nomor Telepon</label>
                    <input type="number" class="form-control floating" name="telp" id="telp" <?php echo isset($old) ? 'value="'.$old['telp'].'"' : ''; ?> required placeholder="Masukan Nomor Telepon">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
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
            </div> -->
            <div class="row">
              <div class="col-sm-12 font-14">
                <p class="title-form">Status</p>
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=1 <?php echo $user_rs->aktif == 1 ? 'checked':''; ?> required> Aktif
                    </label>
                  </div>
                  <div class="form-check-inline pl-4">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input"  name="aktif" id="status" value=0 <?php echo $user_rs->aktif == 0 ? 'checked':''; ?> required> Non Aktif
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="mx-3">
                <button class="btn btn-simpan" id="btn-add-user">Simpan</button>
                <a href="<?php echo base_url('admin/RumahSakit/users') ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
              </div>
            </div>
          </form>
        </div>
      </div> 


<?php echo $this->session->flashdata('msg_edit_user') ? "<script>alert('".$this->session->flashdata('msg_edit_user')."')</script>" : ''; ?>