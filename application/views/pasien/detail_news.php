<div class="page-wrapper">
            <div class="content">
                <div class="row mb-5">
          <div class="col-sm-5 col-12">
              <h4 class="page-title">Berita </h4>
          </div>
          <div class="col-sm-7 col-12">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('pasien/pasien');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita
                    </li>
                </ol>
            </nav>
          </div>
      </div>
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="blog-view">
                            <article class="blog blog-single-post">
                                <h3 class="blog-title"><?php echo $berita->judul?></h3>
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                        <?php
                                        $tanggal = new DateTime($berita->created_at);
                                        $tanggal = $tanggal->format('M d, Y');
                                        ?>
                                            <li><i class="fa fa-calendar"></i> <span><?php echo $tanggal ?></span></li>
                                            <li><i class="fa fa-user-o"></i> <span>By Admin</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="blog-image-detail text-center">
                                    <a href="#."><img alt="" src="<?php echo $berita->foto ?>" class="img-fluid" ></a>
                                </div>
                                <div class="blog-content text-justify">
                                    <p><?php echo $berita->berita ?></p>
                                </div>
                                 <div class="m-t-20 text-right">
                                <a href="<?php echo base_url('pasien/News');?>" type="button" class="btn btn-primary">Kembali <i class="fa fa-chevron-right"></i></a>
                            </div>
                            </article>
                    </aside>
                </div>
            </div>
            </div>
            </div>
            </div>  