<style type="text/css">
    @media print{
        html, body{
            display: none;
        }
    }
</style>
<!-- Main content -->
    <section class="content">
        <div class="row" style="justify-content: center">
          <div class="col-lg-10 ">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header" style="background: #1F60A8;color: #fff">
                      <h3 class="card-title">Rekam Medis</h3>
                  </div>
                  <div class="card-body">
                    <div class="col-lg-12">
                      <div class="row">
                         <div class="col-lg-6">
                          <div class="form-group card-body row">
                          <label for="" class="col-6 col-form-label" style="padding-left: 14px">Nomor Rekam Medis :</label>
                            <div class="col-6">
                              <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo $rekam_medis->no_medrec ?>" name="">
                            </div>
                          </div>
                        </div> 
                        <div class="col-lg-6">
                          <div class="form-group card-body row">
                          <label for="" class="col-6 col-form-label">Tanggal Konsultasi :</label>
                            <div class="col-6">
                              <input type="text" readonly class="form-control-plaintext" id="" value="<?php $tanggal_konsul = new DateTime($rekam_medis->created_at); echo $tanggal_konsul->format('d-m-Y H-i-s') ?>" name="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                    </div>
                    <div class="col-lg-12" style="padding-left: 27px">
                      <div class="row">
                        <div class="col-lg-12">
                        <div class="form-group row" style="padding-left: 6px">
                          <label for="" class="col-4 col-form-label">Nama </label> <span class="col-1" style="padding-top: 5px">:</span>
                          <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo ucwords($rekam_medis->nama_pasien) ?>" name="">
                          </div>
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group row">
                          <label for="" class="col-4 col-form-label">Poli </label> <span class="col-1" style="padding-top: 5px">:</span>
                          <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo ucwords($rekam_medis->poli) ?>" name="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <?php 
                          $tanggal_lahir = new DateTime($rekam_medis->tanggal_lahir_pasien);
                          $tanggal_lahir = $tanggal_lahir->format('d-m-Y');
                          ?>
                          <label for="" class="col-4 col-form-label">Tempat, Tanggal Lahir </label> <span class="col-1" style="padding-top: 5px">:</span>
                          <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo ucwords($rekam_medis->tempat_lahir_pasien) ?>,<?php echo $tanggal_lahir ?>" name="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-4 col-form-label">Jenis Kelamin </label> <span class="col-1" style="padding-top: 5px">:</span>
                          <div class="col-7">
                            <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo $rekam_medis->jk_pasien ?>" name="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-4 col-form-label">Keluhan </label> <span class="col-1" style="padding-top: 5px">:</span>
                          <div class="col-7">
                            <p><?php echo $rekam_medis->keluhan ?></p>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-4 col-form-label">Diagnosa </label> <span class="col-1" style="padding-top: 5px">:</span>
                          <div class="col-7">
                            <p><?php echo $rekam_medis->diagnosis ?></p>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-4 col-form-label">Resep Dokter </label> <span class="col-1" style="padding-top: 5px">:</span>
                          <div class="col-7">
                            <ol><?php echo $rekam_medis->list_obat ?></ol>
                          </div>
                        </div>
                        <div class="col-lg-12">
                        <a href="<?php echo base_url('dokter/HistoryMedisPasien/index/all') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="float: right; margin-top: 20px; width: 140px">Kembali</a>
                          
                        </div>
                        <div class="col-lg-6">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>