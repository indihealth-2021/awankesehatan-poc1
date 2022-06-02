<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h3 class="page-title"><i class="fa fa-user fa-xl"></i> Dashboard Admin</h3>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
          </div>
      </div>            
            <!-- <h4>Manage Data</h4>
                <hr> -->
                <div class="row">
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
            <a href="<?php echo base_url('admin/admin/manage_admin') ?>">
              <div class="inner" style="padding: 13px">
                <h3><?php echo count($list_admin) ?></h3>
                <p>Admin</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              </a>
              <a href="<?php echo base_url('admin/admin/manage_admin') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
            <a href="<?php echo base_url('admin/dokter') ?>">
              <div class="inner" style="padding: 13px">
                <h3><?php echo count($list_all_dokter); ?></h3>
                <p>Dokter</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-md"></i>
              </div>
              </a>
              <a href="<?php echo base_url('admin/dokter') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
            <a href="<?php echo base_url('admin/pasien') ?>">
              <div class="inner" style="padding: 13px">
                <h3><?php echo count($list_pasien); ?></h3>
                <p>Pasien</p>
              </div>
              <div class="icon">
                <i class="fa fa-wheelchair"></i>
              </div>
              </a>
              <a href="<?php echo base_url('admin/pasien') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
            <a href="<?php echo base_url('admin/Config/poli') ?>">
              <div class="inner" style="padding: 13px">
                <h3><?php echo count($list_poli); ?></h3>
                <p>Poli</p>
              </div>
              <div class="icon">
                <i class="fa fa-plus-square"></i>
              </div>
              </a>
              <a href="<?php echo base_url('admin/Config/poli') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
                <!-- <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="<?php echo base_url('admin/admin/manage_admin') ?>">
                                <span class="dash-widget-bg5"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Admin <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="<?php echo base_url('admin/dokter') ?>">
                                <span class="dash-widget-bg5"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                                  <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Dokter <i class="fa fa-check" aria-hidden="true"></i></span>
                                  </div>
                            </div></a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="<?php echo base_url('admin/pasien') ?>">
                                <span class="dash-widget-bg5"><i class="fa fa-wheelchair"></i></span>
                                <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Pasien <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div></a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="<?php echo base_url('admin/Config/poli') ?>">
                                <span class="dash-widget-bg5"><i class="fa fa-plus-square"></i></span>
                                <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Poli <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div></a>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="">
                                <span class="dash-widget-bg5"><i class="fa fa-newspaper-o"></i></span>
                                <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Berita <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div></a>
                        </div>
                        -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="blog-view">
                                <div class="widget author-widget clearfix">
                                    <div class="row">
                                        <h3 class="col-md-6">Berita Rumah Sakit</h3>
                                        <h4 class="text-right col-md-6"><a href="<?php echo base_url('admin/News') ?>">Semua Berita</a></h4>
                                    </div>
                                    <?php foreach($news as $id=>$berita){ ?>
                                        <?php if($id <= 0){ ?>
                                    <div class="about-author">
                                        <div class="about-author-img">
                                            <div class="author-img-wrap">
                                                <img class="img-fluid rounded-square" alt="" src="<?php echo base_url('assets/images/news/'.$berita->foto) ?>">
                                            </div>
                                        </div>
                                        <div class="author-details">
                                            <span class="blog-author-name"><?php echo $berita->judul; ?></span>
                                            <p><?php echo substr($berita->berita,3,300); ?>...</p>
                                            <a href="<?php echo base_url('admin/News/viewDetail/'.$berita->id) ?>" class="read-more"><i class="fa fa-long-arrow-right"></i> Baca selengkapnya</a>
                                        </div>
                                    </div>
                                    <?php }} ?>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                    <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">Pasien Baru </h4> <a href="<?php echo base_url('admin/pasien') ?>" class="btn btn-primary float-right">Lihat Semua</a>
                            </div>
                            <div class="card-block mb-3">
                                <div class="table-responsive">
                                    <table class="table mb-0 new-patient-table">
                                        <tbody>
                                        <?php foreach($show_list_pasien as $pasien){ ?>
                                            <tr>
                                                <td>
                                                <?php $foto = $pasien->foto ? base_url('assets/images/users/'.$pasien->foto) : base_url('assets/dashboard/img/user.jpg'); ?>
                                                    <img width="30" height="30" class="rounded-circle" src="<?php echo $foto;?>" alt=""> 
                                                    <h2><?php echo ucwords($pasien->name) ?></h2>
                                                </td>
                                                <td><?php echo $pasien->email ?></td>
                                                <td><?php echo $pasien->telp ?></td>
                                                <td><a href="<?php echo base_url('admin/Pasien/tampilEditPasien/'.$pasien->id);?>"><button class="btn btn-primary btn-primary-one float-right">Edit</button></a></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="card member-panel"  style="box-shadow: 0px 0px 2px #009efb">
                            <div class="card-header bg-info">
                                <h4 class="card-title mb-0 text-white">Dokter</h4>
                            </div>
                            <div class="card-body">
                                <ul class="contact-list">
                                <?php foreach($list_dokter as $dokter){ ?>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                            <?php $foto = $dokter->foto ? base_url('assets/images/users/'.$dokter->foto) : base_url('assets/dashboard/img/user.jpg'); ?>
                                                <a href="#" title="<?php echo $dokter->name ?>"><img src="<?php echo $foto; ?>" alt="" class="w-40 rounded-circle" height="40"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis"><?php echo ucwords($dokter->name) ?></span>
                                                <span class="contact-date"><?php echo strtoupper($dokter->poli) ?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                            <div class="card-footer text-center bg-info">
                                <a href="<?php echo base_url('admin/Dokter') ?>" class="text-muted text-white">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>