
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Profil') ?>" class="text-black">Pengaturan</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Profil/edit') ?>" class="text-black font-bold-7">Edit Profile</a></li>
                </ol>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">         
          <form action="<?php echo base_url('admin/Profil/update');?>" method="post" enctype="multipart/form-data">

            <p class="title-form">Informasi Pribadi</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nama Lengkap</label>
                    <input type="text" class="form-control floating" name="name" value="<?php echo $user->name;?>" required placeholder="Masukan Nama Lengkap Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tempat Lahir</label>
                    <input type="text" class="form-control floating" name="lahir_tempat" value="<?php echo $user->lahir_tempat;?>" required placeholder="Masukan Tempat Lahir Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal Lahir</label>
                    <input type="date" class="form-control floating" name="lahir_tanggal" id="tanggal" onchange="setDay()" value="<?php echo $user->lahir_tanggal;?>" required>
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
                            <option value="<?php echo $user->id_provinsi ?>"><?php echo $user->nama_provinsi ?></option>
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
                            <option value="<?php echo $user->id_kota ?>"><?php echo $user->nama_kota ?></option>
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
                            <option value="<?php echo $user->id_kecamatan ?>"><?php echo $user->nama_kecamatan ?></option>
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
                          <option value="<?php echo $user->id_kelurahan ?>"><?php echo $user->nama_kelurahan ?></option>
                        <?php } else { ?>
                          <option>Pilih Kelurahan</option>
                        <?php } ?>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kode Pos</label>
                    <input type="text" class="form-control floating" name="kode_pos" value="<?php echo ucwords($user->kode_pos) ?>" placeholder="Masukan Kode Pos">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Alamat Jalan</label>
                    <input type="text" class="form-control floating" name="alamat_jalan" value="<?php echo ucwords($user->alamat_jalan) ?>" placeholder="Masukan Alamat Jalan">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nomor Telepon</label>
                    <input type="number" class="form-control floating" name="telp" value="<?php echo ucwords($user->telp) ?>" placeholder="Masukan Nomor Telepon">
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
                    <input type="email" class="form-control floating" name="email" value="<?php echo $user->email ?>" placeholder="Masukan Email">
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="mx-auto">
                <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="5" hidden>
                <button class="btn btn-simpan" id="btn-add-admin">Simpan</button>

                <a href="<?php echo base_url('admin/Profil') ?>"><button type="button" class="btn btn-batal ml-4">Batal</button></a>
              </div>
            </div>
          </form>
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