<!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
              <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page">Jadwal Telekonsultasi</li>
                  <li class="breadcrumb-item" aria-current="page"><b>Proses Telekonsultasi</b></li>
              </ol>
          </nav>
        </div>
        <div class="col-sm-12 col-12">
            <h3 class="page-title">Proses Telekonsultasi</h3>
        </div>
      </div>

      <div class="row">
        <div class="col-md-7">
          <div class="card card-5 p-1 px-4 pt-3 pb-5">
            <ul class="nav nav-tabs-konsul nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="#bottom-tab2" data-toggle="tab">Video</a></li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab1" data-toggle="tab">Chat</a></li>
            </ul>

            <div class="tab-content">
                        <div class="tab-pane show" id="bottom-tab1">
                            <div class="">
                                <div class="col-lg-9 message-view chat-view">
                                    <div class="chat-window">
                                        <div class="card-box">
                                            <div class="chat-contents chat-content-wrap">
                                                <div class="chat-wrap-inner">
                                                    <div class="chat-box">
                                                        <div class="chats" id="messages">
                                                            <!--<div class="chat chat-right">
                                                                        <div class="chat-body">
                                                                            <div class="chat-bubble">
                                                                                <div class="chat-content">
                                                                                    <p>Hello. What can I do for you?</p>
                                                                                    <span class="chat-time">8:30 am</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat-line">
                                                                        <span class="chat-date">October 8th, 2015</span>
                                                                    </div>
                                                                    <div class="chat chat-right">
                                                                        <div class="chat-body">
                                                                            <div class="chat-bubble">
                                                                                <div class="chat-content">
                                                                                    <p>Where?</p>
                                                                                    <span class="chat-time">8:35 am</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="chat-bubble">
                                                                                <div class="chat-content">
                                                                                    <p>OK, my name is Limingqiang. I like singing, playing basketballand so on.</p>
                                                                                    <span class="chat-time">8:42 am</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat chat-left">
                                                                        <div class="chat-avatar">
                                                                            <a href="#" class="avatar">
                                                                                <img alt="<?php //echo $pasien->name
                                                                                            ?>" src="<?php //echo base_url('assets/dashboard/img/patient-thumb-02.jpg');
                                                                                                                                ?>" class="img-fluid rounded-circle">
                                                                            </a>
                                                                        </div>
                                                                        <div class="chat-body">
                                                                            <div class="chat-bubble">
                                                                                <div class="chat-content img-content">
                                                                                    <div class="chat-img-group clearfix">
                                                                                        <p>Uploaded 3 Images</p>
                                                                                        <a class="chat-img-attach" href="#">
                                                                                            <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                                            <div class="chat-placeholder">
                                                                                                <div class="chat-img-name">placeholder.jpg</div>
                                                                                                <div class="chat-file-desc">842 KB</div>
                                                                                            </div>
                                                                                        </a>
                                                                                        <a class="chat-img-attach" href="#">
                                                                                            <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                                            <div class="chat-placeholder">
                                                                                                <div class="chat-img-name">842 KB</div>
                                                                                            </div>
                                                                                        </a>
                                                                                        <a class="chat-img-attach" href="#">
                                                                                            <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                                            <div class="chat-placeholder">
                                                                                                <div class="chat-img-name">placeholder.jpg</div>
                                                                                                <div class="chat-file-desc">842 KB</div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                    <span class="chat-time">9:00 am</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>-->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-footer">
                                            <form id="form-message" enctype="multipart/form-data">
                                                <div class="message-bar">
                                                    <div class="message-inner">
                                                        <label class="images-upload px-3 mt-2">
                                                            <img src="<?php echo base_url('assets/dashboard/img/file.png'); ?>" alt="">
                                                            <input id="attachment_label" type="file" name="attachment" accept=".jpg,.jfif,.jpeg,.png,.txt,.docx,.doc,.pdf">
                                                        </label>
                                                        <div class="message-area">
                                                            <div class="input-group">
                                                                <textarea class="form-control" name="message" placeholder="Type message..."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-send-mess mt-2" id="send">
                                                      <img src="<?php echo base_url('assets/dashboard/img/send.png'); ?>" width="20" height="auto" alt="">
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-9" id="attachment_name">

                                                    </div>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="bottom-tab2">
                          <div class="row my-2 px-3">
                            <!-- <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-konsul" id="panggil" data-id-pasien="<?php echo $pasien->id ?>" data-id-jadwal-konsultasi="<?php echo $id_jadwal_konsultasi ?>"><img src="<?php echo base_url('assets/dashboard/img/phone-call.png'); ?>" alt=""> Hubungi Pasien</button>
                            <button type="button" class="btn btn-konsul mx-3" id="btn-stop" data-id-jadwal-konsultasi='<?php echo $id_jadwal_konsultasi ?>' data-id-pasien="<?php echo $pasien->id ?>"><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button> -->

                                  <!-- Modal -->
                                  <div class="modal fade" id="memanggil" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" style="width: 400px">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <p class="modal-title font-24" id="exampleModalLabel">Memanggil...</p>
                                              </div>
                                              <div class="modal-body" align="center">
                                                  <i class="fa fa-phone fa-5x text-tele">....</i>
                                                  <div class="mt-5">
                                                    <button type="button" class="btn btn-batal" data-dismiss="modal">Tutup</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!--modal-->
                                </div>
                            <div class="">
                                <div id="ketemu" width="800" height="700" style="background: #000;"></div>
                                <!-- <video autoplay id="video-other" style="background-color: #000;" width="100%" height="100%"></video>
                                          <video autoplay id="video-ku" style="background-color: #000; position: absolute; bottom: 75px; right: 8px; width: 40%; height: 40%;"></video> -->
                            </div>
                        </div>
                    </div>
                  </div>
          </div>





        <!-- batas col-md-7 -->
        <div class="col-md-5">
          <div class="card card-5 p-2 px-4">
              <p style="border-bottom: 1px solid #DEDEDE;" class="py-2 font-12">Data Dokter</p>
            <div class="row">
               <?php
                if ($dokter->foto) {
                    $foto = base_url('assets/images/users/' . $dokter->foto);
                } else {
                    $foto = base_url('assets/telemedicine/img/default.png');
                }
                ?>
              <div class="col-md-2"><img src="<?php echo $foto; ?>" width="41" height="41" class="border-radius-50"></div>
              <div class="col-md-9">
                <span class="font-14"><?php echo $dokter->name ?></span><br>
                <span class="font-11"><?php //echo $dokter->poli ?></span>
              </div>
            </div>
          </div>
          <div class="card card-5 p-2 px-4">
              <p style="border-bottom: 1px solid #DEDEDE;" class="py-2 font-12">Assesment Pasien</p>
            <div class="row mb-5"  id="formAssesment">
              <div class="col-md-6">
                <div class="mb-3">
                  <div class="form-group form-focus-asses readonly">
                      <label class="focus-label">Berat Badan</label>
                      <input type="number" class="form-control floating" value="<?php if ($assesment) { echo $assesment->berat_badan; } ?>" name="berat_badan" readonly placeholder="Isi Berat Badan Disini">
                      <label class="focus-label-right">Kg</label>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <div class="form-group form-focus-asses readonly">
                      <label class="focus-label">Tinggi Badan</label>
                      <input type="number" class="form-control floating" value="<?php if ($assesment) {echo $assesment->tinggi_badan;} ?>" name="tinggi_badan" readonly placeholder="Isi Tinggi Badan Disini" required>
                      <label class="focus-label-right">Cm</label>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <div class="form-group form-focus-asses readonly">
                      <label class="focus-label">Tekanan Darah</label>
                      <input type="text" class="form-control floating" name="tekanan_darah" value="<?php if ($assesment && !$old_assesment) { echo $assesment->tekanan_darah; } ?>"  readonly placeholder="Isi Tekanan Darah Disini">
                      <label class="focus-label-right">mmHg</label>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <div class="form-group form-focus-asses readonly">
                      <label class="focus-label">Suhu</label>
                      <input type="text" class="form-control floating" name="suhu" value="<?php if ($assesment && !$old_assesment) { echo $assesment->suhu; } ?>" readonly placeholder="Isi Suhu Disini">
                      <label class="focus-label-right">Celcius</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <div class="form-group font-12">
                      <label for="" class="text-abu col-form-label">Merokok</label><br>
                      <label class="radio-inline">
                          <input  required type="radio" name="merokok" class="merokok-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->merokok) {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "disabled";
                                                                                                                    }
                                                                                                                } ?> readonly> Ya
                      </label><br>
                      <label class="radio-inline">
                          <input  required type="radio" name="merokok" class="merokok-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->merokok) {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "disabled";
                                                                                                                    }
                                                                                                                } ?> readonly> Tidak
                      </label>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                    <div class="form-group font-12">
                        <label for="" class="text-abu col-form-label">Di Rawat</label><br>
                         <label class="radio-inline">
                            <input  required type="radio" name="dirawat" class="dirawat-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->dirawat) {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "disabled";
                                                                                                                    }
                                                                                                                } ?> readonly > Pernah
                        </label><br>
                        <label class="radio-inline">
                            <input  required type="radio" name="dirawat" class="dirawat-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->dirawat) {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "disabled";
                                                                                                                    }
                                                                                                                } ?>  readonly> Tidak Pernah
                        </label>
                    </div>
                </div>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <div class="mb-3">
                    <div class="form-group font-12">
                        <label for="" class="text-abu col-form-label">Minum Alkohol</label><br>
                        <label class="radio-inline">
                            <input  required type="radio" name="alkohol" class="alkohol-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->alkohol) {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "disabled";
                                                                                                                    }
                                                                                                                } ?> readonly> Ya
                        </label><br>
                        <label class="radio-inline">
                            <input  required type="radio" name="alkohol" class="alkohol-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->alkohol) {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "disabled";
                                                                                                                    }
                                                                                                                } ?> readonly> Tidak
                        </label>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                    <div class="form-group font-12">
                        <label for="" class="text-abu col-form-label">Kecelakaan</label><br>
                        <label class="radio-inline">
                            <input  required type="radio" name="kecelakaan" class="kecelakaan-1" value=1 <?php if ($assesment) {
                                                                                                                        if ($assesment->kecelakaan) {
                                                                                                                            echo "checked";
                                                                                                                        } else {
                                                                                                                            echo "disabled";
                                                                                                                        }
                                                                                                                    } ?> readonly> Pernah
                        </label><br>
                        <label class="radio-inline">
                            <input  required type="radio" name="kecelakaan" class="kecelakaan-0" value=0 <?php if ($assesment) {
                                                                                                                        if (!$assesment->kecelakaan) {
                                                                                                                            echo "checked";
                                                                                                                        } else {
                                                                                                                            echo "disabled";
                                                                                                                        }
                                                                                                                    } ?> readonly> Tidak Pernah
                        </label>
                    </div>
                </div>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <div class="mb-3">
                    <div class="form-group font-12">
                        <label for="" class="text-abu col-form-label">Operasi</label><br>
                        <label class="radio-inline">
                            <input  required type="radio" name="operasi" class="operasi-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->operasi) {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "disabled";
                                                                                                                    }
                                                                                                                } ?> readonly> Pernah
                        </label><br>
                        <label class="radio-inline">
                            <input  required type="radio" name="operasi" class="operasi-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->operasi) {
                                                                                                                        echo "checked";
                                                                                                                    } else {
                                                                                                                        echo "disabled";
                                                                                                                    }
                                                                                                                } ?> readonly> Tidak Pernah
                        </label>
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="mb-5">
                    <div class="form-group form-focus-asses">
                        <label class="focus-label">Keluhan</label>
                        <textarea  required rows="4" class="font-12 form-control floating" name="keluhan" readonly><?php if ($assesment && !$old_assesment) { echo $assesment->keluhan; } ?></textarea>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <button type="button" class="btn-selesai-tele">Selesai</button> -->
        </div>
      </div>
    </div>
  </div>


</div>
</div>


<!--modal notif-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNotif">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pemberitahuan</h5>
            </div>
            <div class="modal-body">
                <p>Silahkan Isi Assesment</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-simoan">OK</button>
            </div>
        </div>
    </div>
</div>
<!--modal assesment-->
<div class="modal fade" id="ModalAssesment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: auto">
            <div class="modal-header">
                <p class="modal-title font-24 ml-4" id="exampleModalLabel">Assesment Pasien</p>
              </div>
            <div class="modal-body">
                <form id="formModalAssesment">
                    <div class="col-sm-12 row mx-auto">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <div class="form-group form-focus-asses">
                              <label class="focus-label">Berat Badan</label>
                              <input type="number" class="form-control floating" value="<?php if ($assesment) { echo $assesment->berat_badan; } ?>" name="berat_badan" placeholder="Isi Berat Badan Disini">
                              <label class="focus-label-right">Kg</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <div class="form-group form-focus-asses">
                              <label class="focus-label">Tinggi Badan</label>
                              <input type="number" class="form-control floating" value="<?php if ($assesment) {echo $assesment->tinggi_badan;} ?>" name="tinggi_badan" placeholder="Isi Tinggi Badan Disini" required>
                              <label class="focus-label-right">Cm</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <div class="form-group form-focus-asses">
                              <label class="focus-label">Tekanan Darah</label>
                              <input type="text" class="form-control floating" name="tekanan_darah" value="<?php if ($assesment && !$old_assesment) { echo $assesment->tekanan_darah; } ?>" placeholder="Isi Tekanan Darah Disini">
                              <label class="focus-label-right">mmHg</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <div class="form-group form-focus-asses">
                              <label class="focus-label">Suhu</label>
                              <input type="text" class="form-control floating" name="suhu" value="<?php if ($assesment && !$old_assesment) { echo $assesment->suhu; } ?>"placeholder="Isi Suhu Disini">
                              <label class="focus-label-right">Celcius</label>
                          </div>
                        </div>
                      </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <div class="form-group font-12">
                                <label for="" class="text-abu col-form-label">Merokok</label><br>
                                <label class="radio-inline">
                                    <input required type="radio" name="merokok" class="merokok-1" value=1 <?php if ($assesment) { if ($assesment->merokok) { echo "checked";}} ?>> Ya
                                </label><br>
                                <label class="radio-inline">
                                    <input required type="radio" name="merokok" class="merokok-0" value=0 <?php if ($assesment) {if (!$assesment->merokok) {echo "checked";}} ?>> Tidak
                                </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                              <div class="form-group font-12">
                                  <label for="" class="text-abu col-form-label">Di Rawat</label><br>
                                   <label class="radio-inline">
                                      <input required type="radio" name="dirawat" class="dirawat-1" value=1 <?php if ($assesment) { if ($assesment->dirawat) {  echo "checked"; } } ?>> Pernah
                                  </label><br>
                                  <label class="radio-inline">
                                      <input required type="radio" name="dirawat" class="dirawat-0" value=0 <?php if ($assesment) { if (!$assesment->dirawat) {  echo "checked"; } } ?>> Tidak Pernah
                                  </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                              <div class="form-group font-12">
                                  <label for="" class="text-abu col-form-label">Minum Alkohol</label><br>
                                  <label class="radio-inline">
                                      <input required type="radio" name="alkohol" class="alkohol-1" value=1 <?php if ($assesment) { if ($assesment->alkohol) { echo "checked"; } } ?>> Ya
                                  </label><br>
                                  <label class="radio-inline">
                                      <input required type="radio" name="alkohol" class="alkohol-0" value=0 <?php if ($assesment) { if (!$assesment->alkohol) { echo "checked"; } } ?>> Tidak
                                  </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                              <div class="form-group font-12">
                                  <label for="" class="text-abu col-form-label">Kecelakaan</label><br>
                                  <label class="radio-inline">
                                      <input required type="radio" name="kecelakaan" class="kecelakaan-1" value=1 <?php if ($assesment) { if ($assesment->kecelakaan) { echo "checked"; } } ?>> Pernah
                                  </label><br>
                                  <label class="radio-inline">
                                      <input required type="radio" name="kecelakaan" class="kecelakaan-0" value=0 <?php if ($assesment) { if (!$assesment->kecelakaan) {  echo "checked"; } } ?>> Tidak Pernah
                                  </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                              <div class="form-group font-12">
                                  <label for="" class="text-abu col-form-label">Operasi</label><br>
                                  <label class="radio-inline">
                                      <input required type="radio" name="operasi" class="operasi-1" value=1 <?php if ($assesment) { if ($assesment->operasi) { echo "checked"; } } ?>> Pernah
                                  </label><br>
                                  <label class="radio-inline">
                                      <input required type="radio" name="operasi" class="operasi-0" value=0 <?php if ($assesment) { if (!$assesment->operasi) { echo "checked"; } } ?>> Tidak Pernah
                                  </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-5 pb-5">
                              <div class="form-group form-focus-asses">
                                  <label class="focus-label">Keluhan</label>
                                  <textarea required rows="4" class="font-12 form-control floating" name="keluhan"><?php if ($assesment && !$old_assesment) { echo $assesment->keluhan; } ?></textarea>
                              </div>
                          </div>
                        </div>
                        <input type="hidden" name="id_dokter" value="<?php echo $dokter->id ?>">
                        <input type="hidden" name="id_jadwal_konsultasi" value="<?php echo $id_jadwal_konsultasi ?>">
                    </div>

                    <div class="modal-footer">
                      <div class="mx-auto">
                        <button id="buttonSubmitAssesment" class="btn btn-simpan btn-block">Simpan</button>
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>-->
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    name = '<?php echo $user->name; ?>';
        var room_name = '<?php echo $roomName ?>';
        var userName = name;
        const domain = 'telekonsultasi2.telemedical.id';
        const options = {
            roomName: room_name,
            width: 535,
            height: 400,
            parent: undefined,
            parentNode: document.querySelector('#ketemu'),
            configOverwrite: {
                disableDeepLinking: true,
            },
        };
    navigator.mediaDevices.getUserMedia({
        audio: true,
        video: true
    }).then(function(stream) {
        const api = new JitsiMeetExternalAPI(domain, options).then(() => {
            document.querySelector("#jitsiConferenceFrame0").contentWindow.location.reload();
        });
        api.executeCommand('displayName', userName);
        api.addEventListener('participantRoleChanged', function(event) {
            if (event.role === 'moderator') {
                api.executeCommand('toggleLobby', true);
            }
        });
        api.on('passwordRequired', function() {
            api.executeCommand('password', '123456');
        });
    }
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/conference.js'); ?>"></script>
<?php $foto_pasien = $user->foto ? base_url('assets/images/users/' . $user->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<?php $foto_dokter = $dokter->foto ? base_url('assets/images/users/' . $dokter->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<script>
    chat_locate = 'pasien';
    user_kategori = 'pasien';
    id_pasien = <?php echo $user->id ?>;
    id_dokter = <?php echo $dokter->id ?>;
    foto_pasien = '<?php echo $foto_pasien ?>';
    foto_dokter = '<?php echo $foto_dokter ?>';
</script>
<script>
    function resizeInput() {
        $(this).attr('size', $(this).val().length);
    }
    $('input[type="text"]')
        .keyup(resizeInput)
        .each(resizeInput);

    $('input[type="number"]')
        .keyup(resizeInput)
        .each(resizeInput);
</script>

<script>
    function obat_onchange() {
        var obat = document.getElementById('obat');
        var satuan = document.getElementById('obat-' + obat.value);

        var satuan_show = document.getElementById('unit');

        satuan_show.placeholder = "Jml (" + satuan.innerHTML + ")";
    }
</script>


<div class="sidebar-overlay" data-reff=""></div>
<style>
    .images-upload>input {
        display: none;
    }

    .images-upload>img {
        cursor: pointer;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
</style>
