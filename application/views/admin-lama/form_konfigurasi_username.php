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
            <div class="col-lg-12 offset-lg-4">
              <div class="row">
                <form method="post" action="<?php echo base_url('admin/KonfigurasiAkun/update_username'); ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" id="username" value="<?php echo $user->username?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Password</label>
                               <input type="password" name="password" class="form-control" value="<?php //echo $user->password?>">
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" type="submit">Ubah</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
                        
                           
<?php if($this->session->flashdata('msg_poli')){ echo "<script>alert('".$this->session->flashdata('msg_poli')."')</script>"; } ?>
