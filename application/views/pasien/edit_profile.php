 <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Edit Profil</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('Dokter/Dashboard');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                </ol>
            </nav>
          </div>
      </div>            
                <?php echo form_open_multipart("pasien/Profile/update") ?>                
                    <div class="card-box">
                        <h3 class="card-title">Biodata</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <img class="inline-block" src="<?php echo $user->foto ? base_url('assets/images/users/'.$user->foto) : base_url('assets/telemedicine/img/default.png'); ?>" alt="user">
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input type="file" name="foto" size="5000000" accept="image/*">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Registrasi : </label>
                                                <input readonly disabled="disabled" required="" class="form-control" name="no_medrek" value="<?php echo $no_medrek->no_medrec ?>">
                                            </div>
                                         </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Rekam Medis : </label>
                                                <input readonly disabled="disabled" required="" class="form-control" name="no_medrek" value="<?php echo $no_medrek->no_medrec ?>">
                                            </div>
                                         </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input required="" class="form-control" name="name" value="<?php echo ucwords($user->name);?>">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jalan</label>
                                    <input type="text" class="form-control" name="alamat_jalan" value="<?php echo ucwords($user->alamat_jalan) ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" class="form-control" name="alamat_kota" value="<?php echo ucwords($user->alamat_kota) ?>"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control" name="alamat_kelurahan" value="<?php echo ucwords($user->alamat_kelurahan) ?>"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="alamat_kecamatan" value="<?php echo ucwords($user->alamat_kecamatan) ?>"> 
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
                                    <label>Provinsi</label>
                                    <input type="text" class="form-control" name="alamat_provinsi" value="<?php echo ucwords($user->alamat_provinsi) ?>"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control" name="telp" value="<?php echo ucwords($user->telp) ?>"> 
                                </div>
                            </div>
                        </div>
                        <div class="text-center m-t-20">
                            <button class="btn btn-primary submit-btn" type="button">Edit</button>
                        </div>
                    </form>
                </div>

                <?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>