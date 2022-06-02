
    <!-- Main content -->
    <section class="content">
      <form action="" method="post" > 
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="col-lg-12">
                    <div class="form-group row mt-3">
                      <label for="" class="col-lg-4 col-form-label" style="padding-left: 35px">Nama :</label>
                      <div class="col-lg-8">
                        <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo $pasien->name ?>" name="">
                        <hr>
                      </div>
                      <label for="" class="col-lg-4 col-form-label" style="padding-left: 35px">Umur : </label>
                      <div class="col-lg-8">
                        <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo $pasien->age == '2020' ? '-' : $pasien->age.' Tahun' ?>" name="">
                      </div>
                    </div>  
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" style="background: #1F60A8;color: #fff">
                    <h3 class="card-title" >Assesment <?php if(!$assesment){ ?>( <font color="yellow">Kamu belum mengisi assesment *optional</font> )<?php } ?></h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="row">
                            <div class="col-lg-7">
                            <div class="form-group row">
                            <hr>
                                <label for="" class="col col-form-label" style="padding-left: 16px">Berat Badan</label>
                                  <div class="col-4">
                                    <input type="number"  class="form-control" id="" value="<?php if($assesment){ echo $assesment->berat_badan; } ?>" name="berat_badan" readonly placeholder="- -" >
                                  </div>
                                <label for="" class="col-2 form-label" style="font-size: 13px; color: #1F60A8; margin-right: 15px">Kg</label>
                              </div>
                              <div class="form-group row">
                                <label for="" class="col col-form-label" style="padding-left: 15px">Tekanan Darah</label>
                                  <div class="col-4">
                                      <input type="text" class="form-control" id="" name="tekanan_darah" value="<?php if($assesment){ echo $assesment->tekanan_darah; } ?>" readonly placeholder="- - -/- - -">
                                  </div>
                                <label for="" class="col-3 form-label" style="margin-left: -10px;font-size: 13px; color: #1F60A8">mmHg</label>
                              </div>
                            </div>
                            <div class="col-lg-5">
                              <div class="form-group row">
                                  <label for="" class="col-4 col-form-label">Tinggi</label>
                                <div class="col-6">
                                    <input type="number"  class="form-control" id="" value="<?php if($assesment){ echo $assesment->tinggi_badan; } ?>" name="tinggi_badan" readonly placeholder="- - -">
                                </div>
                                <label for="" class="col-2 form-label" style="margin-left: -10px;font-size: 13px;color: #1F60A8">Cm</label>
                             </div>
                                <div class="form-group row">
                                  <label for="" class="col-4 col-form-label">Suhu</label>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="" name="suhu" value="<?php if($assesment){ echo $assesment->suhu; } ?>" readonly placeholder="- -,-">
                                </div>
                                <label for="" class="col-2 form-label" style="margin-left: -10px;font-size: 13px;color: #1F60A8">'C</label>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-lg-6 col-form-label">Merokok</label>
                                <label class="radio-inline" style="padding-right: 65px">
                                    <input required type="radio" name="merokok" id="optionsRadiosInline1" value=1 <?php if($assesment){ if($assesment->merokok){ echo "checked"; } } ?> readonly> Ya 
                                </label>
                                <label class="radio-inline" >
                                    <input required type="radio" name="merokok" id="optionsRadiosInline2" value=0 <?php if($assesment){ if(!$assesment->merokok){ echo "checked"; } } ?> readonly> Tidak
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-lg-6 col-form-label">Minum Alkohol</label>
                                <label class="radio-inline" style="padding-right: 65px">
                                    <input required type="radio" name="alkohol" id="optionsRadiosInline1" value=1 <?php if($assesment){ if($assesment->alkohol){ echo "checked"; } } ?> readonly> Ya 
                                </label>
                                <label class="radio-inline">
                                    <input required type="radio" name="alkohol" id="optionsRadiosInline2" value=0 <?php if($assesment){ if(!$assesment->alkohol){ echo "checked"; } } ?> readonly> Tidak
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                            <div class="form-group">
                              <label for="" class="col-lg-6 col-form-label">Kecelakaan</label>
                              <label class="radio-inline" style="padding-right: 30px">
                                  <input required type="radio" name="kecelakaan" id="optionsRadiosInline1" value=1 <?php if($assesment){ if($assesment->kecelakaan){ echo "checked"; } } ?> readonly> Pernah 
                              </label>
                              <label class="radio-inline">
                                  <input required  type="radio" name="kecelakaan" id="optionsRadiosInline2" value=0 <?php if($assesment){ if(!$assesment->kecelakaan){ echo "checked"; } } ?> readonly> Tidak Pernah
                              </label>
                              </div>
                              <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="" class="col-lg-6 col-form-label">Di Rawat</label>
                                <label class="radio-inline" style="padding-right: 30px">
                                    <input required type="radio" name="dirawat" id="optionsRadiosInline1" value=1 <?php if($assesment){ if($assesment->dirawat){ echo "checked"; } } ?> readonly> Pernah 
                                </label>
                                <label class="radio-inline">
                                    <input required  type="radio" name="dirawat" id="optionsRadiosInline2" value=0 <?php if($assesment){ if(!$assesment->dirawat){ echo "checked"; } } ?> readonly> Tidak Pernah
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group" >
                                <label for="" class="col-lg-6 col-form-label">Operasi</label>
                                <label class="radio-inline " style="padding-right: 30px">
                                    <input required type="radio" name="operasi" id="optionsRadiosInline1" value=1 <?php if($assesment){ if($assesment->operasi){ echo "checked"; } } ?> readonly> Pernah 
                                </label>
                                <label class="radio-inline">
                                    <input required  type="radio" name="operasi" id="optionsRadiosInline2" value=0 <?php if($assesment){ if(!$assesment->operasi){ echo "checked"; } } ?> readonly> Tidak Pernah
                                </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label>Keluhan : </label>
                                <textarea class="form-control" rows="4" placeholder="keluhan pasien" name="keluhan" readonly><?php if($assesment){ echo $assesment->keluhan; } ?></textarea>
                              </div>  
                            </div>   
                            </div>
                            
                          </div>
                          <!--row-->
                        </div>
                        <!--col-lg-12-->
                      </div>
                      <!--row-->
                    </div>
                    <!-- /.col-lg-12 -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card assesment -->
                <!--collg-6 kiri-->
            </div>
            <!-- /.card-body -->
            <div class="col-lg-6">
                <div class="col-lg-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-lg-6">
                <div class="form-group">               
                                  
                 
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <div id="ketemu" width="470" height="500" style="background: #000;"></div>    
                   <!--  <video autoplay id="video-other" style="background-color: #000;" width="100%" height="100%"></video>                  
                  <video autoplay id="video-ku" style="background-color: #000; position: absolute; bottom: 75px; right: 8px; width: 40%; height: 40%;"></video>    -->              
                </div>
                   <!-- <div class="card">
                    <ul style="list-style-type: none; ">
                   <div class="row" style="padding-top: 12px; " align="center">
                        <div class="col-lg-1">
                            <li id="recStart" style="display: inline; cursor: pointer;"><i id="idIcon1" class="fa fa-circle" style="color: red;"></i></li>
                        </div>
                        <div class="col-lg-1">
                            <li id="recStop" style="display: inline; cursor: pointer;"><i id="idIcon2" class="fa fa-stop" style="color: grey"></i></li>
                        </div>
                         <div class="col-lg-1" id="download_container">
                            <li id="download" style="display: inline; cursor: pointer;"><i  class="fa fa-download" style="color: grey"></i></li>             
                        </div>
                        <div class="col-lg-1">
                            <li id="cam" style="display: inline; cursor: pointer;"><i id="idIcon3" class="fa fa-video" style="color: grey"></i></li>
                        </div>
                        <div class="col-lg-1">
                            <li id="mic" style="display: inline; cursor: pointer;"><i id="idIcon4" class="fa fa-microphone" style="color: grey"></i></li>
                        </div>
                       
                        <div class="col-lg-5">
                            <li style="display: inline">Waktu: <span id="durasi-waktu-conference">00:00:00</span></li>
                        </div>                      
                    </div>
                    </ul>
                  </div> -->
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
                
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
          <!-- /.card -->
      <!-- /.row -->
       </form>
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
<script type="text/javascript">        
   name = '<?php echo $user->name;?>';    
   var room_name = '<?php echo $this->uri->segment(6) ?>';
   var userName = name;
   const domain = 'telekonsultasi.indihealth-rtc.xyz';
   const options = {
    roomName: room_name,
    width: 470,
    height: 500,  
    parent: undefined,
    parentNode: document.querySelector('#ketemu'),
    configOverwrite:{
    disableDeepLinking :true
    }
};
const api = new JitsiMeetExternalAPI(domain, options);
 api.executeCommand('displayName', userName);
 api.addEventListener('participantRoleChanged', function (event) {
    if(event.role === 'moderator') {
        api.executeCommand('toggleLobby', true);
    }
});
 api.on('passwordRequired', function ()
{
    api.executeCommand('password', '123456');
});
  </script>
<script type="text/javascript" src="<?php echo base_url('assets/js/conference.js');?>"></script> 
  