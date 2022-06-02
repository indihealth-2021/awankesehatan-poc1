        <div class="page-wrapper">
          <div class="content">
              <div class="row mb-5">
                  <div class="col-sm-5 col-5">
                      <h4 class="page-title">Edit Dokter</h4>
                  </div>
                  <div class="col-sm-7 col-7">
                    <nav aria-label="">
                        <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Dokter</li>
                        </ol>
                    </nav>
                  </div>
              </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" id="form-edit-dokter" onsubmit="return ubah();" action="<?php echo base_url('admin/Dokter/updateDokter/'.$data->id) ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Surat Tanda Registrasi (STR)</label>
                                        <input type="text" required class="form-control" name="str" id="str" value="<?php echo $data->str;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Poli</label><span class="text-danger"> *</span>
                                        <select class="form-control select2" required style="width: 100%;" name="poli">
                                            <?php foreach($list_poli as $poli){ ?>
                                              <option value="<?php echo $poli->id ?>" <?php if($detail_dokter){if($poli->id == $detail_dokter->id_poli){ echo 'selected'; }} ?>><?php echo $poli->poli ?> <?php echo $poli->aktif ? '':'( NONAKTIF )' ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                    $pengalaman = $detail_dokter ? $detail_dokter->pengalaman_kerja : '';
                                    $pengalaman = strpos($pengalaman, 's/d') !== false ? explode('s/d', $pengalaman):'';
                                    $pengalaman_dari = $pengalaman != '' ? rtrim($pengalaman[0]):'';
                                    $pengalaman_sampai = $pengalaman != '' ? ltrim($pengalaman[1]):'';
                                ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pengalaman dari</label><span class="text-danger"> *</span>
                                        <input type="date" class="form-control" name="pengalaman" value="<?php echo $pengalaman_dari ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pengalaman sampai</label><span class="text-danger"> *</span>
                                        <input type="date" class="form-control" name="pengalaman_sampai" value="<?php echo $pengalaman_sampai ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" id="username" name="username" value="<?php echo $data->username;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" required class="form-control" id="email" name="email" value="<?php echo $data->email;?>">
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input required type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password" required>
                                    </div>
                                </div> -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" name="name" id="name" value="<?php echo $data->name;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Jenis Kelamin: </label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="jenis_kelamin" class="form-check-input" value="laki-laki" <?php if(isset($old)){ echo strtolower($old['jenis_kelamin']) == 'laki-laki' ? 'checked' : '' ; }else{ echo strtolower($data->jenis_kelamin) == 'laki-laki' ? 'checked' : ''; }?> required>
                                                <i class="fa fa-male fa-fw"></i> Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="jenis_kelamin" class="form-check-input" value="perempuan" <?php if(isset($old)){ echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : '' ; }else{ echo strtolower($data->jenis_kelamin) == 'perempuan' ? 'checked' : ''; }?> required>
                                                <i class="fa fa-female fa-fw"></i> Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" required class="form-control" name="lahir_tempat" id="lahir_tempat" value="<?php echo $data->lahir_tempat;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <div>
                                            <input type="date" required class="form-control" name="lahir_tanggal" id="lahir_tanggal" value="<?php echo $data->lahir_tanggal;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <!--<input type="text" class="form-control" name="alamat_provinsi" value="<?php //echo ucwords($data->alamat_provinsi) ?>"> -->
                                                <select class="form-control" name="alamat_provinsi" id="provinsi">
                                                    <?php if($data->id_provinsi){ ?>
                                                        <option value="<?php echo $data->id_provinsi ?>"><?php echo $data->nama_provinsi ?></option>
                                                    <?php } else { ?>
                                                        <option>PILIH PROVINSI</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                            <label>Kabupaten/Kota</label>
                                            <!--<input type="text" class="form-control" name="alamat_kota" value="<?php //echo ucwords($data->alamat_kota) ?>"> -->
                                            <select class="form-control" name="alamat_kota" id="kotkab">
                                                <?php if($data->id_kota){ ?>
                                                    <option value="<?php echo $data->id_kota ?>"><?php echo $data->nama_kota ?></option>
                                                <?php } else { ?>
                                                    <option>PILIH KABUPATEN/KOTA</option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                            <label>Kecamatan</label>
                                            <!--<input type="text" class="form-control" name="alamat_kecamatan" value="<?php //echo ucwords($data->alamat_kecamatan) ?>"> -->
                                            <select class="form-control" name="alamat_kecamatan" id="kecamatan">
                                                <?php if($data->id_kecamatan){ ?>
                                                    <option value="<?php echo $data->id_kecamatan ?>"><?php echo $data->nama_kecamatan ?></option>
                                                <?php } else { ?>
                                                    <option>PILIH KECAMATAN</option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <!--<input type="text" class="form-control" name="alamat_kelurahan" value="<?php //echo ucwords($data->alamat_kelurahan) ?>"> -->
                                                <select class="form-control" name="alamat_kelurahan" id="kelurahan">
                                                    <?php if($data->id_kelurahan){ ?>
                                                        <option value="<?php echo $data->id_kelurahan ?>"><?php echo $data->nama_kelurahan ?></option>
                                                    <?php } else { ?>
                                                        <option>PILIH KELURAHAN</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label>Kode Pos</label>
                                                <input type="number" class="form-control"  class="form-control" name="kode_pos" id="kode_pos" value="<?php echo $data->kode_pos;?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No Telepon </label>
                                                <input type="number" required class="form-control" name="telp" id="telp" value="<?php echo $data->telp;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Jalan</label>
                                                <input type="text" class="form-control" required name="alamat_jalan" id="alamat_jalan" value="<?php echo $data->alamat_jalan;?>">
                                            </div>
                                        </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <div class="profile-upload">
                                            <div class="upload-img">
                                                <img alt="" src="<?php echo base_url('assets/images/users/'.$data->foto);?>">
                                            </div>
                                            <div class="upload-input">
                                                <input type="file" class="form-control" name="foto" id="foto" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="display-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="aktif" id="status" value=1 <?php if($data->aktif == 1)echo "checked";?> required>
                                    <label class="form-check-label">
                                    Aktif
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="aktif" id="admin_inactive" value=0 <?php if($data->aktif == 0)echo "checked";?> required>
                                    <label class="form-check-label">
                                    Tidak Aktif
                                    </label>
                                </div>
                                <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="2" hidden>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="btn-edit-dokter">EDIT</button>
                            </div>
                        </form>
                    </div>
                </div>
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

<?php echo $this->session->flashdata('msg_edit_dokter') ? "<script>alert('".$this->session->flashdata('msg_edit_dokter')."')</script>" : ''; ?>