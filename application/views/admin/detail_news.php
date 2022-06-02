<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Berita</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-view">
                            <article class="blog blog-single-post">
                                <h3 class="blog-title"><?php echo $news->judul?></h3>
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                        <?php
                                        $tanggal = new DateTime($news->created_at);
                                        $tanggal = $tanggal->format('M d, Y');
                                        ?>
                                            <li><i class="fa fa-calendar"></i> <span><?php echo $tanggal?></span></li>
                                            <li><i class="fa fa-user-o"></i> <span>By Admin</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="blog-image-detail text-center">
                                    <a href="#."><img alt="" src="<?php echo $news->foto ?>" class="img-fluid" ></a>
                                </div>
                                <div class="blog-content" style="text-align: justify !important">
                                    <p><?php echo $news->berita ?></p>
                                </div>
                                 <div class="m-t-20 text-right">
                                <a href="<?php echo base_url('admin/News');?>" type="button" class="btn btn-primary">Kembali <i class="fa fa-chevron-right"></i></a>
                            </div>
                            </article>
                    </aside>
                </div>
            </div>
            </div>
            </div>
            </div>