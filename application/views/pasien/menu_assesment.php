 <!-- Main content -->
    <div class="page-wrapper">
      <div class="content" style="height: 1000px">
          <div class="row mb-3">
              <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Assesment/menu_assesment') ?>"class="text-black font-bold-7">Assesment</a></li>
                    </ol>
                </nav>
              </div>
              <div class="col-sm-12 col-12">
                  <h3 class="page-title">Assesment</h3>
              </div>
          </div> 

          <div class="row mx-auto">
            <?php foreach($list_jadwal_konsultasi as $jadwal_konsultasi){ ?>
            <?php $foto = $jadwal_konsultasi->foto_dokter ? base_url('assets/images/users/'.$jadwal_konsultasi->foto_dokter):base_url('assets/dashboard/img/user.jpg') ?>
            <a href="<?php echo base_url('pasien/Assesment/?id_jadwal_konsultasi='.$jadwal_konsultasi->id) ?>">
                <div class="card-profile ml-3 my-2">
                  <div class="d-inline-flex">
                    <div class="doctor-img px-3 my-4">
                        <div class="avatar"><img width='28' height='28' src="<?php echo $foto?>" class='rounded-circle m-r-5' alt=''></div>
                    </div>
                    <div class="p-2 ml-4 font-black" style="width: 160px; margin-top: 35px">
                      <span class="font-16"><?php echo ucwords($jadwal_konsultasi->nama_dokter);?></span>
                      <div class="font-12">
                        <span>STR : <?php echo $jadwal_konsultasi->str_dokter ?></span><br>
                        <p><?php echo $jadwal_konsultasi->poli;?></span><br>
                        <span><?php echo (new DateTime($jadwal_konsultasi->tanggal))->format('d-m-Y');?> <?php echo $jadwal_konsultasi->jam ?></span>
                      </div>
                    </div>
                    <div class="my-auto">
                      <img src="<?php echo base_url('assets/dashboard/img/edit.png');?>">
                    </div>
                  </div>
                </div>
            </a>
            <?php } ?>
          </div>

       <!--  <div class="row mt-5">
            <div class="col-md-12">
                <div class="blog-view">
                    <div class="widget author-widget clearfix row">
                    <?php foreach($list_jadwal_konsultasi as $jadwal_konsultasi){ ?>
                        <div class="col-lg-6 col-12"> -->
                            <!-- small box -->
                            <!-- <div class="small-box bg-primary">
                                <a href="<?php echo base_url('pasien/Assesment/?id_jadwal_konsultasi='.$jadwal_konsultasi->id) ?>">
                                    <div class="inner" style="padding: 25px; color: white;">
                                        <h4><?php echo ucwords($jadwal_konsultasi->nama_dokter);?></h4>
                                        <h4><?php echo $jadwal_konsultasi->poli;?></h4>
                                        <p>[<?php echo (new DateTime($jadwal_konsultasi->tanggal))->format('d-m-Y');?> <?php echo $jadwal_konsultasi->jam ?>]</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>