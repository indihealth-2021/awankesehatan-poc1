  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DATA SUSTER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Profil Suster</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" >Profil Suster</h3>
            </div>
            <!-- /.card-header -->
            <div>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url('suster/Profile/update');?>" method="post" enctype="multipart/form-data">                     
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <div class="card-body">
                          <img src="<?php echo base_url('assets/telemedicine/img/').$data->foto;?>" width="130px" height="140px" class="img-rounded">
                        </div>
                        <input  type="file" name="foto" size="2000">
                      </div>
                    </div>  
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label>Surat Tanda Registrasi (STR) : </label>
                      <input readonly required="" class="form-control" name="str" value="<?php echo $data->str;?>">
                      <br>
                      <label>ID Suster : </label>
                      <input readonly required="" class="form-control" name="id" value="<?php echo $data->id;?>">
                     </div>
                    </div>
                  </div>                                  
                  <div class="form-group">
                    <label>Nama Suster : </label>
                    <input required="" class="form-control" name="name" value="<?php echo $data->name;?>">
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin : </label>
                    <input required="" class="form-control" name="jenis_kelamin" value="<?php echo $data->jenis_kelamin;?>">
                  </div>
                  <div class="form-group">
                      <label>Jenis Kelamin : </label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline1" value="laki-laki" <?php if($data->jenis_kelamin == "Laki-laki")echo "checked";?> ><i class="fa fa-male fa-fw"></i>Laki-laki
                      </label>
                      <label class="radio-inline">
                          <input required type="radio" name="jenis_kelamin" id="optionsRadiosInline2" value="perempuan" <?php if($data->jenis_kelamin == "Perempuan")echo "checked";?> >Perempuan<i class="fa fa-female fa-fw"></i>
                      </label>
                  </div>
                    <div class="form-group">
                        <label>E-Mail : </label>
                        <input class="form-control" type="email" value="<?php echo $data->email;?>" name="email">
                    </div>
                    <div class="form-group">
                        <label>No. Telfon : </label>
                        <input class="form-control"  name="telp" value="<?php echo $data->telp;?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat : </label>
                        <textarea class="form-control" rows="3" name="alamat_kota" value=""><?php echo $data->alamat_kota;?></textarea>
                    </div>    
                    <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6">
                      <div class="form-group">
                        <center>
                        <a href="<?php echo base_url('suster/Profile/update');?>" style="text-decoration:none;color: #fff">
                        <button type="submit" class="form-control" style="text-align:center; align-content:right;background-color: #007bff" width="10%">UBAH
                        </a>  
                        </button> 
                        </center>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <center>
                        <a href="<?php echo base_url('suster/Dashboard');?>" style="text-decoration:none;color: #fff">
                        <button type="reset" class="form-control" style="text-align:center; align-content:right;background-color: #007bff" width="10%">KEMBALI
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
  </div>
  <!-- /.content-wrapper -->
  