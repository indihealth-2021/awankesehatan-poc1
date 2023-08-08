
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/pasien') ?>" class="text-black">User Management</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Pasien</a></li>
                </ol>
            </nav>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form method="post" id="form-edit-pasien" onsubmit="return ubah();" action="<?php echo base_url('admin/Pasien/updatePasien/'.$data->id) ?>" enctype="multipart/form-data">
            <p class="title-form">Akun</p>

            <div class="row">
              <div class="col-md-4">
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
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Card Number</label>
                    <input type="number" class="form-control floating" id="card_number" name="card_number" required placeholder="Masukan Card Number" value="<?php echo $data->card_number; ?>">
                </div>
              </div>
            </div>

            <p class="title-form">Rekam Medis</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Rekam Medis</label>
                    <input type="text" class="form-control floating" id="no_medrec" name="no_medrec" value="<?php echo $detail_pasien ? $detail_pasien->no_medrec : '';?>" readonly disabled>
                </div>
              </div>
              <!-- <div class="col-md-4">
                    <p class="text-ass-title">Assigment Pasien</p>
                    <a href="<?php echo base_url('admin/Pasien/assesment/'.$data->id);?>"><span class="link-ass">Assigment Pasien</span></a>
              </div> -->
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
                    <input type="text" class="form-control floating" name="lahir_tempat" id="lahir_tempat" value="<?php echo $data->lahir_tempat;?>" required placeholder="Masukan Tempat Lahir Disini">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal Lahir</label>
                    <input type="date" class="form-control floating" name="lahir_tanggal" id="lahir_tanggal" value="<?php echo $data->lahir_tanggal;?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-sm-12 font-14">
                    <label class="gen-label text-label-form">Jenis Kelamin :</label>
                    <div class="form-group gender-select">
                      <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" class="form-check-input" value="laki-laki" <?php if($data->jenis_kelamin == "Laki-laki")echo "checked";?> required>
                                  Laki-laki
                        </label>
                      </div>
                      <div class="form-check-inline pl-5">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" class="form-check-input" value="perempuan" <?php if($data->jenis_kelamin == "Perempuan")echo "checked";?>  required>
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
                    <input type="text" class="form-control floating" name="alamat_jalan" id="alamat_jalan" value="<?php echo $data->alamat_jalan;?>"  placeholder="Masukan Alamat Jalan">
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
                      <img alt="" src="<?php echo $data->foto ? base_url('assets/images/users/'.$data->foto):base_url('assets/dashboard/img/user.jpg');?>">
                    </div>
                    <div class="upload-input">
                      <input type="file" class="form-control" name="foto" id="foto" size="10024" accept=".gif,.jpg,.jpeg,.jfif,.png" >
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
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=1 <?php if($data->aktif == 1)echo "checked";?> required>Aktif
                    </label>
                  </div>
                  <div class="form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="admin_inactive" value=0 <?php if($data->aktif == 0)echo "checked";?> required>Non Aktif
                    </label>
                  </div>
                </div>
              </div>
            </div>

            👑
            <div class="row btn btn-warning m-3">
              <div class="form-check container ">
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="vip" <?= $data->vip ? "checked" : "" ?>>
                <label class="form-check-label" for="flexCheckDefault" style="color: black;">
                  VIP?
                </label>
              </div>
            </div>

            <div class="row mt-5">
              <div class="mx-auto">
                <input name="id" id="id" value="<?php echo $data->id;?>" hidden>
                <button class="btn btn-simpan" id="btn-edit-pasien">Simpan</button>
                <a href="<?php echo base_url('admin/Pasien') ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
              </div>
            </div>
          </form>
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

<?php echo $this->session->flashdata('msg_edit_pasien') ? "<script>alert('".$this->session->flashdata('msg_edit_pasien')."')</script>" : ''; ?>
