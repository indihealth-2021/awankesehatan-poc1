<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Berita</h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                          foreach($list_berita as $id=>$berita){ 
                            echo '
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="blog grid-blog h-100">
                                    <div class="blog-image">
                                        <a href="#"><img class="img-fluid" src="'.$berita->foto.'" alt=""></a>
                                    </div>
                                    <div class="blog-content">
                                        <h3 class="blog-title"><a href="#">'.$berita->judul.'</a></h3>
                                        <p>'.strip_tags(substr($berita->berita,0,1), '').'</p>
                                        <a href="'.base_url('pasien/News/detail/?id_berita='.$berita->id).'" class="read-more"><i class="fa fa-long-arrow-right"></i> Baca Selengkapnya...</a>
                                    </div>
                                </div>
                            </div>
                                ';
                              }
                            ?>
                </div>
            </div>
            </div>