
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/Profile');?>"class="text-black">Pengaturan</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href=""class="text-black font-bold-7">Edit Profile</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">         
          <form action="<?php echo base_url('dokter/Profile/update');?>" method="post" enctype="multipart/form-data">

            <p class="title-form">Informasi Kedokteran</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Surat Tanda Registrasi (STR)</label>
                    <input type="text" class="form-control floating" name="str" value="<?php noxss($user->str);?>" readonly disabled="disabled" placeholder="STR">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Poli</label>
                    <input type="text" class="form-control floating" readonly disabled value="<?php echo $detail_dokter->poli ?>" placeholder="Masukan Poli Disini">
                      <!-- <select class="form-control floating"  name="poli" readonly disabled="disabled">
                          <?php //foreach($list_poli as $poli){ ?>
                            <option value="<?php //echo $poli->id ?>" <?php //if($detail_dokter){echo $poli->id == $detail_dokter->id_poli ?<?php //echo $poli->poli ?></option>
                          <?php //} ?>
                      </select> -->
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Pengalaman Dari</label>
                    <input type="date" class="form-control floating" name="pengalaman" readonly disabled="disabled" value="<?php if($detail_dokter){noxss($detail_dokter->pengalaman_kerja); } ?>">
              </div> 
            </div>
          </div>

            <p class="title-form">Informasi Pribadi</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nama Lengkap</label>
                    <input required type="text" class="form-control floating" name="name" maxlength="35" size="35" value="<?php noxss(ucwords($user->name));?>">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tempat Lahir</label>
                    <input type="text" class="form-control floating" name="lahir_tempat" value="<?php noxss($user->lahir_tempat);?>" required placeholder="Masukan Tempat Lahir Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal Lahir</label>
                    <input type="date" class="form-control floating" name="lahir_tanggal" id="tanggal" onchange="setDay()" value="<?php noxss($user->lahir_tanggal);?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-sm-12 font-14">
                    <label class="gen-label text-label-form">Jenis Kelamin :</label>
                    <div class="form-group gender-select">
                      <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" id="optionsRadiosInline1" value="laki-laki" <?php if($user->jenis_kelamin == "Laki-laki")echo "checked";?> required>
                                  Laki-laki
                        </label>
                      </div>
                      <div class="form-check-inline pl-5">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" id="optionsRadiosInline2" value="perempuan" <?php if($user->jenis_kelamin == "Perempuan")echo "checked";?> required>
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
                          <?php if($user->id_provinsi){ ?>
                              <option value="<?php noxss($user->id_provinsi) ?>"><?php noxss($user->nama_provinsi) ?></option>
                          <?php } else { ?>
                              <option>Pilih Provinsi</option>
                          <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kabupaten/Kota</label>
                      <select class="form-control floating" name="alamat_kota" id="kotkab">
                        <?php if($user->id_kota){ ?>
                            <option value="<?php noxss($user->id_kota) ?>"><?php noxss($user->nama_kota) ?></option>
                        <?php } else { ?>
                            <option>Pilih Kab/Kota</option>
                        <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kecamatan</label>
                      <select class="form-control floating" name="alamat_kecamatan" id="kecamatan">
                        <?php if($user->id_kecamatan){ ?>
                            <option value="<?php noxss($user->id_kecamatan) ?>"><?php noxss($user->nama_kecamatan) ?></option>
                        <?php } else { ?>
                            <option>Pilih Kecamatan</option>
                        <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kelurahan</label>
                      <select class="form-control floating" name="alamat_kelurahan" id="kelurahan">
                        <?php if($user->id_kelurahan){ ?>
                          <option value="<?php noxss($user->id_kelurahan) ?>"><?php noxss($user->nama_kelurahan) ?></option>
                        <?php } else { ?>
                          <option>Pilih Kelurahan</option>
                        <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kode Pos</label>
                    <input type="text" class="form-control floating"  name="kode_pos" value="<?php noxss(ucwords($user->kode_pos)) ?>" placeholder="Masukan Kode Pos">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Alamat Jalan</label>
                    <input type="text" class="form-control floating" name="alamat_jalan" value="<?php noxss(ucwords($user->alamat_jalan)) ?>"  placeholder="Masukan Alamat Jalan">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nomor Telepon</label>
                    <input type="number" class="form-control floating" name="telp" value="<?php noxss(ucwords($user->telp)) ?>" placeholder="Masukan Nomor Telepon">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="profile-upload">
                    <div class="upload-img">
                      <img alt="" src="<?php echo $user->foto ? base_url('assets/images/users/'.$user->foto) : base_url('assets/telemedicine/img/default.png'); ?>">
                    </div>
                    <div class="upload-input">
                      <input type="file" class="form-control" name="foto" id="foto" size="10024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                    </div>
                  </div>
                </div>
              </div>  
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Email</label>
                    <input type="email" class="form-control floating" name="email" value="<?php noxss($user->email) ?>" placeholder="Masukan Email">
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="mx-auto">
                <button class="btn btn-simpan">Simpan</button>

                <a href="<?php echo base_url('dokter/profile') ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
              </div>
            </div>
          </form>
        </div>
      </div> 

<script>
function gantiFoto(){
  var fullPath = document.getElementById('foto').value;
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    } 
  
  document.getElementById('filename').innerHTML = filename;
}
</script>   
        
                <?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>