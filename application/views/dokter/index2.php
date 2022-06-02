
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- <div class="col-lg-12">
            <h4>Telekonsultasi</h4>
            <hr>
          </div> -->
          <!-- ./col -->
          <!-- <div class="col-lg-3"> -->
            <!-- small box -->
            <!-- <a href="<?php echo base_url('dokter/Profile');?>">
            <div class="small-box card-menu bg-dark-blue-menu">
              <div class="inner" style="padding-top: 40px; padding-bottom: 30px">
                <h5 class="text-white">Profil Dokter</h5>
              </div>
              <div class="icon">
                <i class="fas fa-user-md"></i>
              </div>
            </div></a>
          </div> -->
          <!-- ./col -->
          <div class="col-lg-3">
            <!-- small box -->
            <a href="<?php echo base_url('dokter/Jadwal');?>">
            <div class="small-box card-menu bg-dark-blue-menu">
              <div class="inner" style="padding-top: 40px; padding-bottom: 30px">
                <h5 class="text-white">Jadwal Dokter</h5>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3">
            <!-- small box -->
            <a href="<?php echo base_url('dokter/SelfAssesment/verification');?>">
            <div class="small-box card-menu bg-dark-blue-menu">
              <div class="inner" style="padding-top: 40px; padding-bottom: 30px">
                <h5 class="text-white">Asessment Pasien</h5>
              </div>
              <div class="icon">
                <i class="fa fa-check-square"></i>
              </div>
            </div>
            </a>
          </div>
          <div class="col-lg-3">
            <!-- small box -->
            <a href="<?php echo base_url('dokter/Teleconsultasi') ?>">
            <div class="small-box card-menu bg-dark-blue-menu pd-card-menu">
              <div class="inner">
                <h5 class="text-white">Jadwal Telekonsultasi</h5>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
        <!-- Small boxes (Stat box) -->
<!--          <div class="col-lg-3 ">
            <!-- small box -->
<!--            <a href="<?php echo base_url('dokter/Dashboard/cek_jadwal_suster');?>">
            <div class="small-box card-menu bg-dark-blue-menu">
              <div class="inner" style="padding-top: 40px; padding-bottom: 30px">
                <h5 class="text-white">Jadwal Suster</h5>
              </div>
              <div class="icon">
                <i class="fas fa-list-ol"></i>
              </div>
            </div>
            </a>
          </div>-->
          <div class="col-lg-3">
            <!-- small box -->
            <a href="<?php echo base_url('dokter/HistoryMedisPasien/index/all');?>">
            <div class="small-box card-menu bg-dark-blue-menu">
              <div class="inner" style="padding-top: 40px; padding-bottom: 30px">
                <h5 class="text-white">Rekam Medis</h5>
              </div>
              <div class="icon">
                <i class="fa fa-stethoscope"></i>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3"> -->
            <!-- small box -->
            <!-- <a href="<?php echo base_url('dokter/Notifikasi') ?>">
            <div class="small-box card-menu bg-dark-blue-menu pd-card-menu">
              <div class="inner">
                <h5 class="text-white">Notifikasi</h5>
              </div>
              <div class="icon">
                <i class="fas fa-bell"></i>
              </div>
            </div>
            </a>
          </div> -->
          <!-- ./col -->
          <div class="col-lg-3">
            <!-- small box -->
            <a href="<?php echo base_url('dokter/News');?>">
            <div class="small-box card-menu bg-dark-blue-menu">
              <div class="inner" style="padding-top: 40px; padding-bottom: 30px">
                <h5 class="text-white">Berita</h5>
              </div>
              <div class="icon">
                <i class="fa fa-newspaper"></i>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3"> -->
            <!-- small box -->
            <!-- <a href="<?php echo base_url('dokter/Antrian');?>">
            <div class="small-box card-menu bg-dark-blue-menu">
              <div class="inner" style="padding-top: 40px; padding-bottom: 30px">
                <h5 class="text-white">Antrian Pasien</h5>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
            </a>
          </div> -->
          <!-- ./col -->

          <div class="col-lg-3">
            <!-- small box -->
            <a href="<?php echo base_url('dokter/HistoryLogActivity');?>">
            <div class="small-box card-menu bg-dark-blue-menu">
              <div class="inner" style="padding-top: 28px; padding-bottom: 18px">
                <h5 class="text-white">History Log & <br>Activity</h5>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
            </div>
            </a>
          </div>
          <!-- <div class="col-lg-3"> -->
            <!-- small box -->
            <!-- <a href="<?php echo base_url('dokter/KonfigurasiAkun') ?>">
            <div class="small-box card-menu bg-dark-blue-menu pd-card-menu">
              <div class="inner">
                <h5 class="text-white">Konfigurasi Akun</h5>
              </div>
              <div class="icon">
                <i class="fa fa-cog"></i>
              </div>
            </div>
            </a>
          </div> -->
          <!-- ./col -->
        </div>
        <div class="row mt-4" style="padding: 5px">
              <div class="col-lg-6">
                Berita
              </div>
              <div class="col-lg-6 text-right" style="text-decoration: underline;">
                <a href="<?php echo base_url('dokter/News/viewAll') ?>">Tampil Semua</a>
              </div>
            </div>
        <!-- <div class="row"> -->
          <?php foreach($news as $id=>$berita){ ?>
           <?php if($id <=0){ ?>  
          <div class="row row-news mb-2" style="height:160px">
            <div class="col-lg-2 col-md-2 col-sm-12" style="padding: 0px; height:110%">
              <img class="img-news" style="object-fit: cover;" src="<?php echo $berita->foto ?>">
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-text-news">
              <h4 class="title-news"><?php echo $berita->judul; ?></h4>
              <p><?php echo substr($berita->berita,3,300); ?></p>
              <div class="text-right">
              <a href="<?php echo base_url('dokter/News/viewDetail/'.$berita->id) ?>"> Lihat Berita ></a>
            </div></div>
            <div class="col-lg-12 text-right">
            </div>
          </div>
          <?php }} ?>
        <!-- </div> -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>    <!-- /.content -->
