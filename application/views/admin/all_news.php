    <style type="text/css">
  .img-news{
    width: 180px;
    height: 175px;
  }
</style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- <div class="row"> -->
          <?php foreach($news as $id=>$berita){ ?>
          <div class="row row-news mb-4" style="height:160px">
            <div class="col-lg-2 col-md-2 col-sm-12" style="padding: 0px; height:110%">
              <img class="img-news" style="object-fit: cover;" src="<?php echo base_url('assets/images/news/'.$berita->foto); ?>">
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-text-news">
              <h4 class="title-news"><?php echo $berita->judul; ?></h4>
              <p><?php echo substr($berita->berita,3,300); ?></p>
                <div class="text-right">
                <a href="<?php echo base_url('admin/News/viewDetail/'.$berita->id) ?>"> Lihat Berita ></a>
                </div>
            </div>
            <div class="col-12 text-right">
            </div>
          </div>
          <?php } ?>
        <!-- </div> -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>    <!-- /.content -->
