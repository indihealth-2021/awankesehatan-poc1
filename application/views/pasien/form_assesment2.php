    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #1F60A8; color: #fff">
                <h3 class="card-title">Self Assesment</h3>
            </div>  
            <!-- /.card-header -->
            <div>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url('pasien/Assesment/update') ?>" method="POST"> 
              <div class="row">       
                    <div class="col-sm-3">  
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 120px">Berat Badan</div>
                            </div>
                            <input type="number" name="berat_badan" <?php if($assesment){ echo 'value='.$assesment->berat_badan; } ?> class="form-control col-4" id="inlineFormInputGroup" placeholder="- -" required>
                            <label class="" for="inlineFormInputGroup" style="color: #1F60A8; margin-left: 5px"> Kg</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 120px">Tinggi Badan</div>
                            </div>
                            <input type="number" name="tinggi_badan" <?php if($assesment){ echo 'value='.$assesment->tinggi_badan; } ?> class="form-control col-4" id="inlineFormInputGroup" placeholder="- - -" required>
                            <label class="" for="inlineFormInputGroup" style="color: #1F60A8;margin-left: 5px"> Cm</label>
                        </div>  
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 120px">Suhu</div>
                            </div>
                            <input type="text" name="suhu" <?php if($assesment && !isset($assesment_old)){ echo 'value="'.$assesment->suhu.'"'; } ?> class="form-control col-4" placeholder="- -,-" required>
                            <label class="" for="inlineFormInputGroup" style="color: #1F60A8;margin-left: 5px"> 'C</label>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 120px">Tekanan Darah</div>
                            </div>
                            <input type="text" name="tekanan_darah" <?php if($assesment && !isset($assesment_old)){ echo 'value="'.$assesment->tekanan_darah.'"'; } ?> class="form-control col-4" id="inlineFormInputGroup" placeholder="- - -/- - -" required>
                            <label class="" for="inlineFormInputGroup" style="color: #1F60A8;margin-left: 5px"> mmHg</label>
                        </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                <hr>
                <label for="" class="col-4 col-form-label">Merokok</label>
                <label class="radio-inline" style="padding-right: 65px">
                    <input  type="radio" name="merokok" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->merokok == 1){echo "checked";}}?> required> Ya 
                </label>
                <label class="radio-inline">
                    <input  type="radio" name="merokok" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->merokok == 0){echo "checked";}}?> required> Tidak
                </label>
                </div>
                <hr>
                </div>
                   <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-4 col-form-label">Minum Alkohol</label>
                                <label class="radio-inline" style="padding-right: 65px">
                                    <input  type="radio" name="alkohol" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->alkohol == 1){echo "checked";}} ?> required> Ya 
                                </label>
                                <label class="radio-inline">
                                    <input  type="radio" name="alkohol" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->alkohol == 0){echo "checked";}}  ?> required> Tidak
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                            <div class="form-group">
                              <label for="" class="col-4 col-form-label">Kecelakaan</label>
                              <label class="radio-inline" style="padding-right: 30px">
                                  <input  type="radio" name="kecelakaan" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->kecelakaan == 1 ){ echo "checked";  }}?> required> Pernah 
                              </label>
                              <label class="radio-inline">
                                  <input   type="radio" name="kecelakaan" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->kecelakaan == 0 ){ echo "checked"; }} ?> required> Tidak Pernah
                              </label>
                              </div>
                              <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-4 col-form-label">Di Rawat</label>
                                <label class="radio-inline" style="padding-right: 30px">
                                    <input  type="radio" name="dirawat" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->dirawat == 1 ){echo "checked";  }} ?> required> Pernah 
                                </label>
                                <label class="radio-inline">
                                    <input   type="radio" name="dirawat" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->dirawat == 0 ){echo "checked"; }}    ?> required> Tidak Pernah
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-4 col-form-label">Operasi</label>
                                <label class="radio-inline" style="padding-right: 30px">
                                    <input  type="radio" name="operasi" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->operasi == 1){echo "checked"; }}?> required> Pernah 
                                </label>
                                <label class="radio-inline">
                                    <input   type="radio" name="operasi" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->operasi == 0){echo "checked";    }}?> required> Tidak Pernah
                                </label>
                                </div>
                                <hr>
                            </div> 
                            <div class="col-lg-12">
                            <div class="col-lg-12">
                              <div class="form-group row">
                                <label for="" class=" col-form-label" style="margin-right: 20px; ">Keluhan : </label>
                                <textarea class="col-10 form-control" id="exampleFormControlTextarea1" rows="4" placeholder="keluhan pasien" name="keluhan" required style="margin-top: 17px"><?php if($assesment && !isset($assesment_old)){ echo $assesment->keluhan; } ?></textarea>
                              </div>  
                            </div>   
                            </div>
                            <?php 
                            if(isset($id_jadwal_konsultasi)){
                                echo "<input type='hidden' name='id_jadwal_konsultasi' value=".$id_jadwal_konsultasi.">";
                            }
                            ?>
                        
                </div>
              </div>
                  <div class="col-lg-12">
                    <div class="row justify-content-center">
                      <div class="col-lg-3">
                      <div class="form-group">
                        <center>
                        <button type="submit" class="form-control text-white" style="text-align:center; align-content:right;background: #1F60A8;" width="10%">SIMPAN
                        </a>  
                        </button> 
                        </center>
                      </div>
                    </div>
                    </form>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <center>
                        <a href="<?php echo base_url('pasien/Pasien') ?>" style="text-decoration:none;color: #fff">
                        <button type="reset" class="form-control" style="text-align:center; align-content:right; background: #1F60A8;">KEMBALI
                        </a>  
                        </button> 
                        </center>
                      </div>
                    </div>
                    </div>
                                  
                  </div>  
                    </div>
                    
                  <!-- /.col-lg-6 (nested) -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>