<style type="text/css">
  .img-news{
    width: 250px;
    height: 250px;
  }
</style>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #1F60A8; color: #fff">
              <h3 class="card-title">Berita</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form action="#" method="post" enctype="multipart/form-data">                     
                <div class="col-lg-12" align="center">
                  <div class="card-header">
                    <div class="card-body" style="font-size: 30px">
                      <p ><?php echo $news->judul ?></p>
                    </div>
                  </div>
                  <div class="card-body">
                    <img class="img-news" src="<?php echo $news->foto ?>">
                  </div>
                  <div class="card-body col-lg-10" align="left">
                    <p>
                      <?php echo $news->berita ?>
                    </p>
                  </div>
                  <div class="col-lg-3">
                      <div class="form-group">
                        <center>
                        <a href="<?php echo base_url('dokter/Dashboard');?>" style="text-decoration:none;color: #fff">
                        <button type="reset" class="form-control" style="text-align:center; align-content:right;background-color: #1F60A8" width="10%">KEMBALI
                        </a>  
                        </button> 
                        </center>
                      </div>
                </div>

                  
                    <!-- <div class="col-lg-12">
                    <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <center>
                        <a href="<?php //echo base_url('News');?>" style="text-decoration:none;color: #fff">
                        <button type="reset" class="form-control" style="text-align:center; align-content:right;background-color: #007bff" width="10%">KEMBALI
                        </a>  
                        </button> 
                        </center>
                      </div>
                    </div>
                    </div>
                                  
                  </div>  
                    </div> -->
                    
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
