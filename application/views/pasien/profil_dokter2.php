<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row">
          <div class="col-sm-4 col-6">
              <h4 class="page-title">Jadwal Telekonsultasi</h4>
          </div>
      </div>
    <div class="col-12">
        <div class=" card-body">
        <div class="row mt-2">
          <div class="col-lg-8 col-md-5 col-sm-12 offset-lg-8 offset-md-7 offset-sm-0">
            <div class="container row card col-6" style="border-radius: 2rem">
            <div class="form-row align-items-center mt-2">
              <div class="col-12">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text" style="border-radius: 2rem; border-style: none;"><i class="fa fa-search"></i></div>
                  </div>
                    <select class="custom-select" style="border-radius: 2rem; border-style: none " name="id_poli" id="id_poli">
                        <option value="all">Semua kategori Poli atau Spesialis</option>
                          <?php foreach($list_poli as $poli){ ?>
                        <option value=<?php echo $poli->id ?> <?php if($this->uri->segment(4) == $poli->id){ echo 'selected'; } ?>><?php echo $poli->poli ?></option>
                          <?php } ?>
                    </select>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
    <!--search kategori-->
                    <div class="col-lg-12">
                    <div class="row">
                    <?php foreach($list_dokter as $dokter){ ?>
                        <div class="col-lg-4 col-md-3 col-sm-12 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title col-lg-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="<?php echo $dokter->foto ? base_url('assets/images/users/'.$dokter->foto) : base_url('assets/telemedicine/img/default.png');?>" style="width: 66px; height: 66px; border-radius: 50%; position: relative;border-color: #f8f9fa!important">
                                            </div>
                                            <div class="col-8">
                                                <h6><?php echo ucwords($dokter->name) ?></h6>
                                                <span style="font-size: 15px">Dokter <?php echo $dokter->poli ? $dokter->poli : '-'; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                <i class="fa fa-medkit" aria-hidden="true" style="color: grey; padding-right: 20px; font-size: 15px"> <?php echo $dokter->pengalaman_kerja ? $dokter->pengalaman_kerja : '-' ?> Tahun</i>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#profildokter" data-nama='<?php echo $dokter->name ?>' data-foto='<?php echo $dokter->foto ? base_url('assets/images/users/'.$dokter->foto) : base_url('assets/telemedicine/img/default.png'); ?>' data-poli='Dokter <?php echo $dokter->poli ? $dokter->poli : '-'; ?>' data-pengalaman-kerja='<?php echo $dokter->pengalaman_kerja ? $dokter->pengalaman_kerja : '-' ?> Tahun Pengalaman' data-no-str='<?php echo $dokter->str ?>' style="border-radius: 18px; font-size: 14px; float: right">Lihat Profil</a>
                              </div>
                            </div>
                        </div>
			<?php } ?>
                    </div>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center">
                        <?php echo $pagination ?>
                      </ul>
                    </nav>
                </div>
            </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="profildokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="text-align:center ;">
    <div class="modal-header">
    <div class="col-lg-5">
    </div>
        <div class="modal-title" id="exampleModalLabel">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>    
    </div>
      <div class="modal-body">
        <div class="modal-title" id="exampleModalLabel">
            <div class="col-lg-12 ">
            <img class='foto' style="width: 120px; height: 120px; border-radius: 50%;">
            </div>
            <div class="col-lg-12">
                <h3 class="nama-dokter"></h3>
                <span style="font-size: 18px; color: grey" class="poli"></span>
            </div>
            <div class="col-lg-12">
                <i class="fa fa-medkit fa-lg pengalaman-kerja" aria-hidden="true" style="color: grey;"></i>
            </div>
        </div>
      </div>
      <div class="modal-body">
          <div class="card-body" style="">
            <!-- <div class="col-lg-12">
            <i class="fa fa-graduation-cap fa-lg mb-2" style="color: grey" arial-hidden="true"> Lulusan Dari</i>
            <p style="color: grey" class="lulusan-dari">Institut Teknologi Bandung</p>  
            </div>
            <div class="col-lg-12">
            <i class="fa fa-hospital fa-lg mb-2" style="color: grey" arial-hidden="true"> Tempat Praktek</i>
            <p style="color: grey" class="tempat-praktek">Rumah Sakit Santoso</p>  
            </div> -->
            <div class="col-lg-12">
            <i class="fa fa-id-card fa-lg mb-2" style="color: grey" arial-hidden="true"> Nomor STR</i>
            <p style="color: grey" class="no-str"></p>  
            </div>    
          </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
