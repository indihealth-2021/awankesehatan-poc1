
    
    <!-- Main content -->
    <section class="content">
        <div class="row" style="justify-content: center">
          <div class="col-lg-10 ">
            <div class="row">
              <div class="col-lg-12" >
                <div class="card">
                  <div class="col-lg-12">
                    <div class="form-group row">
                      <label for="" class="col-lg-2 col-form-label">Nama :</label>
                      <div class="col-lg-10">
                        <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo $data->nama_pasien ?>" name="">
                        <hr>
                      </div>
                      <label for="" class="col-lg-2 col-form-label">Umur : </label>
                      <div class="col-lg-10">
                        <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo $data->age == '2020' ? '-' : $data->age.' Tahun' ?>" name="">
                      </div>
                    </div>  
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" style="background: #007bff;color: #fff">
                    <h3 class="card-title" >Assesment</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12">
                        <form method="POST" action="<?php echo base_url('dokter/SelfAssesment/update') ?>">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group row">
                                <label for="" class="col-lg-6 col-form-label">Berat Badan</label>
                                  <div class="col-lg-4">
                                    <input type="text"  class="form-control" id="" value="<?php echo $data->berat_badan ?>" name="berat_badan">
                                  </div>
                                <label for="" class="col-lg-2 form-label mt-2">Kg</label>
                              </div>
                              <div class="form-group row">
                                <label for="" class="col-lg-6 col-form-label">Tekanan Darah</label>
                                  <div class="col-lg-4">
                                      <input type="text" class="form-control" id="" name="tekanan_darah" value="<?php echo $data->tekanan_darah; ?>">
                                  </div>
                                <label for="" class="col-lg-2 form-label mt-2">mmHg</label>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group row">
                                  <label for="" class="col-lg-6 col-form-label ">Tinggi Badan</label>
                                <div class="col-lg-4">
                                    <input type="text"  class="form-control" id="" value="<?php echo $data->tinggi_badan; ?>" name="tinggi_badan">
                                </div>
                                <label for="" class="col-lg-2 form-label mt-2">Cm</label>
                             </div>
                                <div class="form-group row">
                                  <label for="" class="col-lg-6 col-form-label">Suhu Tubuh</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="" name="suhu" value="<?php echo $data->suhu; ?>">
                                </div>
                                <label for="" class="col-lg-2 form-label mt-2">'C</label>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                              <hr>
                                <label for="" class="col-lg-4 col-form-label">Merokok</label>
                                <label class="radio-inline">
                                    <input  type="radio" name="merokok" id="optionsRadiosInline1" value=1 <?php if($data->merokok == 1)echo "checked";?> >Ya 
                                </label>
                                <label class="radio-inline">
                                    <input  type="radio" name="merokok" id="optionsRadiosInline2" value=0 <?php if($data->merokok == 0)echo "checked";?> >Tidak
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-lg-4 col-form-label">Minum Alkohol</label>
                                <label class="radio-inline">
                                    <input  type="radio" name="alkohol" id="optionsRadiosInline1" value=1 <?php if($data->alkohol == 1)echo "checked"; ?> >Ya 
                                </label>
                                <label class="radio-inline">
                                    <input  type="radio" name="alkohol" id="optionsRadiosInline2" value=0 <?php if($data->alkohol == 0)echo "checked";  ?> >Tidak
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                            <div class="form-group">
                              <label for="" class="col-lg-4 col-form-label">Kecelakaan</label>
                              <label class="radio-inline">
                                  <input  type="radio" name="kecelakaan" id="optionsRadiosInline1" value=1 <?php if($data->kecelakaan == 1 ) echo "checked";  ?> >Pernah 
                              </label>
                              <label class="radio-inline">
                                  <input   type="radio" name="kecelakaan" id="optionsRadiosInline2" value=0 <?php if($data->kecelakaan == 0 ) echo "checked";  ?> >Tidak Pernah
                              </label>
                              </div>
                              <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-lg-4 col-form-label">Di Rawat</label>
                                <label class="radio-inline">
                                    <input  type="radio" name="dirawat" id="optionsRadiosInline1" value=1 <?php if($data->dirawat == 1 )echo "checked";   ?> >Pernah 
                                </label>
                                <label class="radio-inline">
                                    <input   type="radio" name="dirawat" id="optionsRadiosInline2" value=0 <?php if($data->dirawat == 0 )echo "checked";    ?> >Tidak Pernah
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-lg-4 col-form-label">Operasi</label>
                                <label class="radio-inline">
                                    <input  type="radio" name="operasi" id="optionsRadiosInline1" value=1 <?php if($data->operasi == 1)echo "checked";    ?> >Pernah 
                                </label>
                                <label class="radio-inline">
                                    <input   type="radio" name="operasi" id="optionsRadiosInline2" value=0 <?php if($data->operasi == 0)echo "checked";    ?> >Tidak Pernah
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label>Keluhan : </label>
                                <textarea class="form-control" rows="5" placeholde="" name="keluhan"><?php echo $data->keluhan ?></textarea>
                              </div>  
                            </div> 
                            <div class="col-lg-12">
                            <input type="hidden" name="id" value=<?php  echo $data->id ?> >
                            <button class="btn btn-primary btn-block" id="submitAssesment">Ubah</button>  
                            </div>
                            <!-- <div class="col-lg-6">
                            <a href="<?php //echo base_url('dokter/SelfAssesment/verification')?>"><button class="btn btn-primary btn-block"></a>Kembali</button>
                            </div>  -->
                          </div>
                          <!--row-->
                          </form>
                        </div>
                        <!--col-lg-12-->
                      </div>
                      <!--row-->
                    </div>
                    <!-- /.col-lg-12 -->
                  </div>
                  <!-- /.card-body -->
                </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
          <!-- /.card -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
