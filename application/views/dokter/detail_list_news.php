<style type="text/css">
  .img-news{
    width: 175px;
    height: 175px;
  }
</style>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- <div class="card">
            <div class="card-header" style="background: #1F60A8;">
              <h3 class="card-title">Data Berita</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
            <form action="#" method="post" enctype="multipart/form-data">                     
               <?php foreach($news as $id=>$berita){ ?>
          <div class="row row-news mb-4" style="height:160px">
            <div class="col-2" style="padding: 0px; height:110%">
              <img class="img-news" style="object-fit: cover;" src="<?php echo base_url('assets/images/news/'.$berita->foto); ?>">
            </div>
            <div class="col-10 col-text-news">
              <h4 class="title-news"><?php echo $berita->judul; ?></h4>
             <p><?php echo substr($berita->berita,3,300); ?></p>
              <div class="text-right">
              <a href="<?php echo base_url('dokter/News/viewDetail/'.$berita->id) ?>"> Lihat Berita ></a>
            </div></div>
            <div class="col-12 text-right">
            </div>
          </div>
          <?php } ?>
                  <!-- <div class="col-lg-3">
                      <div class="form-group">
                        <center>
                        <a href="<?php// echo base_url('dokter/News');?>" style="text-decoration:none;color: #fff">
                        <button type="reset" class="form-control" style="text-align:center; align-content:right;background-color: #007bff" width="10%">KEMBALI
                        </a>  
                        </button> 
                        </center>
                      </div>
                </div> -->

                  
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
