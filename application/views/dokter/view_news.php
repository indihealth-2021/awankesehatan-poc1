<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Berita</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                </ol>
            </nav>
          </div>
      </div>            
                <div class="row">
                    <?php
                          foreach($news as $data){ 
                            echo '
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="blog grid-blog h-100">
                                    <div class="blog-image">
                                        <a href="#"><img class="img-fluid" src="'.base_url('assets/images/news/').$data->foto.'" alt=""></a>
                                    </div>
                                    <div class="blog-content">
                                        <h3 class="blog-title"><a href="#">'.$data->judul.'</a></h3>
                                        <p>'.strip_tags(substr($data->berita,0,1), '').'</p>
                                        <a href="'.base_url('dokter/News/lihat/'.$data->id).'" class="read-more"><i class="fa fa-long-arrow-right"></i> Baca Selengkapnya...</a>
                                    </div>
                                </div>
                            </div>
                                ';
                              }
                            ?>
                </div>
            </div>
            </div>