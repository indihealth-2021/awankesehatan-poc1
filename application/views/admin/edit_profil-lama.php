<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Edit Profil</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                </ol>
            </nav>
          </div>
      </div>            
                <form action="<?php echo base_url('admin/Profil/update');?>" method="post" enctype="multipart/form-data">                     
                    <div class="card-box">
                        <h3 class="card-title">Biodata</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <img class="inline-block" src="<?php echo $user->foto ? base_url('assets/images/users/'.$user->foto) : base_url('assets/telemedicine/img/default.png'); ?>" alt="user">
                                    <div class="fileupload btn">
                                        <span class="btn-text" id="filename">edit</span>
                                        <input class="upload" type="file" id="foto" name="foto" onchange="gantiFoto();" size="10024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input required="" class="form-control" name="name" value="<?php echo $user->name;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Kelamin : </label><br>
                                              <label class="radio-inline" style="padding-right: 40px">
                                                  <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline1" value="laki-laki" <?php if($user->jenis_kelamin == "Laki-laki")echo "checked";?> ><i class="fa fa-male fa-fw"></i> Laki-laki
                                              </label>
                                              <label class="radio-inline">
                                                  <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline2" value="perempuan" <?php if($user->jenis_kelamin == "Perempuan")echo "checked";?>><i class="fa fa-female fa-fw"></i> Perempuan
                                              </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir: </label>
                                                <input required="" class="form-control" name="lahir_tempat" value="<?php echo $user->lahir_tempat;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir : </label>
                                                <input required="" type="date" class="form-control" name="lahir_tanggal" id="tanggal" onchange="setDay()" value="<?php echo $user->lahir_tanggal;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Informasi Kontak</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <!--<input type="text" class="form-control" name="alamat_provinsi" value="<?php //echo ucwords($user->alamat_provinsi) ?>"> -->
                                    <select class="form-control" name="alamat_provinsi" id="provinsi">
                                        <?php if($user->id_provinsi){ ?>
                                            <option value="<?php echo $user->id_provinsi ?>"><?php echo $user->nama_provinsi ?></option>
                                        <?php } else { ?>
                                            <option>PILIH PROVINSI</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kabupaten/Kota</label>
                                    <!--<input type="text" class="form-control" name="alamat_kota" value="<?php //echo ucwords($user->alamat_kota) ?>"> -->
                                    <select class="form-control" name="alamat_kota" id="kotkab">
                                        <?php if($user->id_kota){ ?>
                                            <option value="<?php echo $user->id_kota ?>"><?php echo $user->nama_kota ?></option>
                                        <?php } else { ?>
                                            <option>PILIH KABUPATEN/KOTA</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <!--<input type="text" class="form-control" name="alamat_kecamatan" value="<?php //echo ucwords($user->alamat_kecamatan) ?>"> -->
                                    <select class="form-control" name="alamat_kecamatan" id="kecamatan">
                                        <?php if($user->id_kecamatan){ ?>
                                            <option value="<?php echo $user->id_kecamatan ?>"><?php echo $user->nama_kecamatan ?></option>
                                        <?php } else { ?>
                                            <option>PILIH KECAMATAN</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <!--<input type="text" class="form-control" name="alamat_kelurahan" value="<?php //echo ucwords($user->alamat_kelurahan) ?>"> -->
                                    <select class="form-control" name="alamat_kelurahan" id="kelurahan">
                                        <?php if($user->id_kelurahan){ ?>
                                            <option value="<?php echo $user->id_kelurahan ?>"><?php echo $user->nama_kelurahan ?></option>
                                        <?php } else { ?>
                                            <option>PILIH KELURAHAN</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input type="text" class="form-control" name="kode_pos" value="<?php echo ucwords($user->kode_pos) ?>"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" name="telp" value="<?php echo ucwords($user->telp) ?>"> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jalan</label>
                                    <input type="text" class="form-control" name="alamat_jalan" value="<?php echo ucwords($user->alamat_jalan) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="text-center m-t-20">
                            <button type="submit" class="btn btn-primary submit-btn" type="button">Edit</button>
                        </div>
                    </form>
                </div>
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