
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #1F60A8; color: #fff">
              <h3 class="card-title" >Profil Admin</h3>
            </div>
            <!-- /.card-header -->
            <div>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url('admin/Profil/update');?>" method="post" enctype="multipart/form-data">                     
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <div class="card-body">
                          <img src="<?php echo $user->foto ? base_url('assets/images/users/'.$user->foto) : base_url('assets/telemedicine/img/default.png'); ?>" width="160px" height="174px" class="img-rounded">
                        </div>
                        <input  type="file" name="foto" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                      </div>
                    </div><!--   
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label>Surat Tanda Registrasi (STR) : </label>
                      <input required="" class="form-control" name="str" value="<?php echo $user->str;?>">
                     </div>
                      <div class="form-group">
                        <label>Poli</label>
                        <select class="form-control" name="poli">
                          <option selected value="">Choose...</option>
                          <option>...</option>
                        </select>
                      </div>
                      <div class="form-group">
                      <label>Pengalaman : </label>
                      <input required="" class="form-control" name="pengalaman" value="">
                     </div>
                    </div> -->
                  </div>                                  
                  <div class="form-group">
                    <label>Nama Admin : </label>
                    <input required="" class="form-control" name="name" value="<?php echo $user->name;?>">
                  </div>
                  <div class="form-group row">
                      <div class="col-lg-6">
                        <label>Tempat Lahir: </label>
                        <input required="" class="form-control" name="lahir_tempat" value="<?php echo $user->lahir_tempat;?>">
                      </div>
                      <div class="col-lg-6">
                        <label>Tanggal Lahir : </label>
                        <input required="" type="date" class="form-control" name="lahir_tanggal" id="tanggal" onchange="setDay()" value="<?php echo $user->lahir_tanggal;?>">
                      </div>
                    </div>
                  <div class="form-group">
                      <label>Jenis Kelamin : </label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline1" value="laki-laki" <?php if($user->jenis_kelamin == "Laki-laki")echo "checked";?> ><i class="fa fa-male fa-fw"></i>Laki-laki
                      </label>
                      <label class="radio-inline">
                          <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline2" value="perempuan" <?php if($user->jenis_kelamin == "Perempuan")echo "checked";?> >Perempuan<i class="fa fa-female fa-fw"></i>
                      </label>
                  </div>
                    <div class="form-group">
                        <label>E-Mail : </label>
                        <input class="form-control" type="email" value="<?php echo $user->email;?>" name="email">
                    </div>
                    <div class="form-group">
                        <label>No. Telfon : </label>
                        <input class="form-control"  name="telp" value="<?php echo $user->telp;?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat : </label>
                        <div class="row">
                          <div class="col">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="width: 85px;">Jalan</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="alamat_jalan" value="<?php echo ucwords($user->alamat_jalan) ?>">
                          </div>
                          </div>
                        </div>
                        <div class="row pt-2">
                          <div class="col">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="width: 85px;">Kota</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="alamat_kota" value="<?php echo ucwords($user->alamat_kota) ?>"> 
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="width: 85px;">Kel</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="alamat_kelurahan" value="<?php echo ucwords($user->alamat_kelurahan) ?>">
                          </div>
                          </div>
                        </div>
                         <div class="row pt-2">
                          <div class="col">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="width: 85px;">Kec</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="alamat_kecamatan" value="<?php echo ucwords($user->alamat_kecamatan) ?>">
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="width: 85px;">Kode Pos</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="kode_pos" value="<?php echo ucwords($user->kode_pos) ?>">
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="width: 85px;">Provinsi</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="alamat_provinsi" value="<?php echo ucwords($user->alamat_provinsi) ?>">
                          </div>
                          </div>
                        </div>
                    </div>    
                    <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6">
                      <div class="form-group">
                        <center>
                        <button type="submit" class="form-control btn bg-dark-blue-menu btn-md pull-right text-white" width="10%">UBAH
                        </button> 
                        </center>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <center>
                        <a href="<?php echo base_url('admin/Admin');?>" style="text-decoration:none;color: #fff">
                        <button type="button" class="form-control btn bg-dark-blue-menu btn-md pull-right text-white" width="10%">KEMBALI
                        </a>  
                        </button> 
                        </center>
                      </div>
                    </div>
                    </div>             
                  </div>  
                    </div>
                    
                  <!-- /.col-lg-6 (nested) -->
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  <?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>