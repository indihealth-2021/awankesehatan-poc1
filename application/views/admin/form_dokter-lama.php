<div class="page-wrapper">
  <div class="content">
      <div class="row mb-5">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Tambah Dokter </h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Dokter</li>
                </ol>
            </nav>
          </div>
      </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" id="form-add-dokter" onsubmit="return ubah();" action="<?php echo base_url('admin/Dokter/addDokter') ?>" enctype="multipart/form-data">
                            <div class="row">
							<?php $old = $this->session->flashdata('old_form'); $error = $this->session->flashdata('error'); ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Surat Tanda Registrasi (STR)</label>
                                        <input type="text" required class="form-control" name="str" id="str" <?php echo $error != 'str' && $error != 'usernameEmailAndStr' && $error != 'usernameAndStr' && $error != 'strAndEmail' ? 'value="'.$old['str'].'"' : '' ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Poli</label><span class="text-danger"> *</span>
                                        <select class="form-control select2" required style="width: 100%;" name="poli">
                                            <option value="0">Pilih Poli</option>
                                            <?php foreach($list_poli as $poli){ ?>
                                              <option value="<?php echo $poli->id ?>" <?php if($old){ echo $old['poli'] == $poli->id ? 'selected' : ''; } ?>><?php echo $poli->poli ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pengalaman dari</label><span class="text-danger"> *</span>
                                        <input type="date" class="form-control" required name="pengalaman" placeholder="Dari" <?php echo isset($old) ? 'value="'.$old['pengalaman'].'"' : ''; ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pengalaman sampai</label><span class="text-danger"> *</span>
                                        <input type="date" class="form-control" name="pengalaman_sampai" placeholder="Sampai" <?php echo isset($old) ? 'value="'.$old['pengalaman_sampai'].'"' : ''; ?> required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" id="username" name="username" <?php echo $error != 'username' && $error != 'usernameEmailAndStr' && $error != 'usernameAndEmail' && $error != 'usernameAndStr' ? 'value="'.$old['username'].'"' : '' ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" required class="form-control" id="email" name="email" <?php echo $error != 'email' && $error != 'usernameEmailAndStr' && $error != 'usernameAndEmail' && $error != 'strAndEmail' ? 'value="'.$old['email'].'"' : '' ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input required type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password" name="confirmasipassword" id="confirmasipassword" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" name="name" id="name" <?php echo isset($old) ? 'value="'.$old['name'].'"' : ''; ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Jenis Kelamin:</label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="jenis_kelamin" class="form-check-input" value="Laki-laki" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'laki-laki' ? 'checked' : ''; } ?> required>
                                                <i class="fa fa-male fa-fw"></i> Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="jenis_kelamin" class="form-check-input" value="Perempuan" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : ''; } ?> required>
                                                <i class="fa fa-female fa-fw"></i> Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" required class="form-control" name="lahir_tempat" id="lahir_tempat" <?php echo isset($old) ? 'value="'.$old['lahir_tempat'].'"' : ''; ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <div>
                                            <input type="date" class="form-control" required name="lahir_tanggal" id="lahir_tanggal" <?php echo isset($old) ? 'value="'.$old['lahir_tanggal'].'"' : ''; ?>>
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
                                                <input type="number" class="form-control" required class="form-control" name="kode_pos" id="kode_pos" <?php echo isset($old) ? 'value="'.$old['kode_pos'].'"' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>No Telepon </label>
                                        <input type="number" required class="form-control" name="telp" id="telp" <?php echo isset($old) ? 'value="'.$old['telp'].'"' : ''; ?>>
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Jalan </label>
                                        <input type="text" required class="form-control" name="alamat_jalan" id="alamat_jalan" <?php echo isset($old) ? 'value="'.$old['alamat_jalan'].'"' : ''; ?>>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <div class="profile-upload">
                                            <div class="upload-img">
                                                <img alt="" src="<?php echo base_url('assets/dashboard/img/user.jpg');?>">
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
                                <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="2" hidden>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="btn-add-dokter">Simpan</button>
                            </div>
                        </form>
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

<?php echo $this->session->flashdata('msg_add_dokter') ? "<script>alert('".$this->session->flashdata('msg_add_dokter')."')</script>" : ''; ?>