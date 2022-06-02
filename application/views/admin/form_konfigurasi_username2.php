
    <!-- Main content -->
<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-12">
              <h4 class="page-title">Username</h4>
          </div>
          <div class="col-sm-7 col-12">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Username</li>
                </ol>
            </nav>
          </div>
      </div>                        
        <div class="row">
          <div class="col-lg-12">
            <!-- /.card -->

            <div class="card">
            <div class="card-header" style="background-color: #1F60A8; color: #fff">
              <div class="card-title">Username</div>
            </div>
            <div class="card-body">
              <form method="post" action="<?php echo base_url('admin/KonfigurasiAkun/update_username'); ?>">
              <div class="col-lg-12">
              <div class="row justify-content-center" >
                <div class="col-lg-10">
                  <div class="form-group row justify-content-center">
                  <label for="staticEmail" class="col-lg-3 col-form-label">Username</label>
                  <div class="col-lg-6">
                  <input type="text" name="username" class="form-control" id="username" value="<?php echo $user->username?>">
                  </div>
                </div>
                </div>
                <div class="col-lg-10">
                  <div class="form-group row justify-content-center">
                  <label for="staticEmail" class="col-lg-3 col-form-label">Password</label>
                  <div class="col-lg-6">
                    <input type="password" name="password" class="form-control" value="<?php //echo $user->password?>">
                  </div>
                </div>
                </div>
                <div class="col-lg-6 row mt-3">
                  <div class="col-lg-6 mb-2">
                    <button class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff" id="">Ubah</button>  
                  </div>
                  </form>
                  <div class="col-lg-6 mb-5">
                    <a href="<?php echo base_url('admin/KonfigurasiAkun');?>"><button type="button" class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff" id="form-close">KEMBALI</button>  
                </a>  
                  </div>
                </div>
                  
              </div>
              </div>
              </div>
              <!-- /.card-body -->
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php if($this->session->flashdata('msg_poli')){ echo "<script>alert('".$this->session->flashdata('msg_poli')."')</script>"; } ?>
