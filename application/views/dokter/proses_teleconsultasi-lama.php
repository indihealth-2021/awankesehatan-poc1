<style>
    .images-upload>input {
        display: none;
    }

    .images-upload>img {
        cursor: pointer;
    }
</style>
<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-5 col-12">
                <h4 class="page-title">Proses Telekonsultasi</h4>
            </div>
            <div class="col-sm-7 col-12">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Proses Telekonsultasi</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="blog-view">
                    <div class="card-box">
                        <h4>Pasien</h4><br>
                        <div class="form-group row">
                            <label for="" class="col-3 col-form-label" style="padding-left: 35px"><b>Nama :</b></label>
                            <div class="col-9">
                                <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo ucwords($pasien->name) ?>" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-3 col-form-label" style="padding-left: 35px"><b>Usia :</b></label>
                            <div class="col-9">
                                <input type="text" readonly class="form-control-plaintext" id="" value="<?php echo $pasien->age == '2020' ? '-' : $pasien->age . ' Tahun' ?>" name="">
                            </div>
                        </div>
                    </div>
                    <form id="formKonsultasi">
                        <div class="card-box" id="keluhan">
                            <h4>Assesment Pasien</h4><br>
                            <div class="col-sm-12 row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label" style="top: -20px">Berat Badan</label>
                                        <input type="text" class="form-control floating" value="<?php if ($assesment) {
                                                                                                    echo $assesment->berat_badan;
                                                                                                } ?>" name="berat_badan" placeholder="- -">
                                        <label for="" class="col-3 form-label text-primary" style="margin-left: -10px;">Kg</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label" style="top: -20px">Tekanan Darah</label>
                                        <input type="text" class="form-control floating" name="tekanan_darah" value="<?php if ($assesment && !$old_assesment) {
                                                                                                                            echo $assesment->tekanan_darah;
                                                                                                                        } ?>" placeholder="- - - / - - -">
                                        <label for="" class="col-3 form-label text-primary" style="margin-left: -10px;">mmHg</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label" style="top: -20px">Tinggi Badan</label>
                                        <input type="text" class="form-control floating" value="<?php if ($assesment) {
                                                                                                    echo $assesment->tinggi_badan;
                                                                                                } ?>" name="tinggi_badan" placeholder="- - -">
                                        <label for="" class="col-3 form-label text-primary" style="margin-left: -10px;">Cm</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-focus">
                                        <label class="focus-label" style="top: -20px">Suhu Tubuh</label>
                                        <input type="text" class="form-control floating" name="suhu" value="<?php if ($assesment && !$old_assesment) {
                                                                                                                echo $assesment->suhu;
                                                                                                            } ?>" placeholder="- -, -">
                                        <label for="" class="col-3 form-label text-primary" style="margin-left: -10px;">Celcius</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group">
                                        <label for="" class="col-sm-5 col-12 col-form-label">Merokok</label>
                                        <label class="radio-inline" style="padding-right: 20px">
                                            <input required type="radio" name="merokok" id="merokok-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->merokok) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Ya
                                        </label>
                                        <label class="radio-inline">
                                            <input required type="radio" name="merokok" id="merokok-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->merokok) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Tidak
                                        </label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-5 col-12 col-form-label">Minum Alkohol</label>
                                        <label class="radio-inline" style="padding-right: 20px">
                                            <input required type="radio" name="alkohol" id="alkohol-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->alkohol) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Ya
                                        </label>
                                        <label class="radio-inline">
                                            <input required type="radio" name="alkohol" id="alkohol-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->alkohol) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Tidak
                                        </label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-5 col-12 col-form-label">Kecelakaan</label>
                                        <label class="radio-inline" style="padding-right: 10px">
                                            <input required type="radio" name="kecelakaan" id="kecelakaan-1" value=1 <?php if ($assesment) {
                                                                                                                            if ($assesment->kecelakaan) {
                                                                                                                                echo "checked";
                                                                                                                            }
                                                                                                                        } ?>> Pernah
                                        </label>
                                        <label class="radio-inline">
                                            <input required type="radio" name="kecelakaan" id="kecelakaan-0" value=0 <?php if ($assesment) {
                                                                                                                            if (!$assesment->kecelakaan) {
                                                                                                                                echo "checked";
                                                                                                                            }
                                                                                                                        } ?>> Tidak Pernah
                                        </label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-5 col-12 col-form-label">Dirawat</label>
                                        <label class="radio-inline" style="padding-right: 10px">
                                            <input required type="radio" name="dirawat" id="dirawat-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->dirawat) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Pernah
                                        </label>
                                        <label class="radio-inline">
                                            <input required type="radio" name="dirawat" id="dirawat-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->dirawat) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Tidak Pernah
                                        </label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-5 col-12 col-form-label">Operasi</label>
                                        <label class="radio-inline" style="padding-right: 10px">
                                            <input required type="radio" name="operasi" id="operasi-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->operasi) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Pernah
                                        </label>
                                        <label class="radio-inline">
                                            <input required type="radio" name="operasi" id="operasi-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->operasi) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Tidak Pernah
                                        </label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12 mb-5" style="padding-bottom: 50px">
                                    <div class="form-group mb-5 row" style="margin-left: 2px;">
                                        <label class="col-form-label col-md-12">Keluhan</label>
                                        <div class="col-md-12 mb-5">
                                            <textarea class="form-control" rows="5" placeholder="keluhan pasien" name="keluhan"><?php if ($assesment && !$old_assesment) {
                                                                                                                                    echo $assesment->keluhan;
                                                                                                                                } ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </form>
            <aside class="col-md-7">
                <div class="card-box">
                    <h4 class="mb-4">Proses Telekonsultasi</h4>
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-3" id="panggil" data-id-pasien="<?php echo $pasien->id ?>" data-id-jadwal-konsultasi="<?php echo $id_jadwal_konsultasi ?>">Panggil</button>
                    <!-- <button type="button" id="recordJitsi" class="btn btn-primary mb-3" style="background-color:green;" onclick="recordJitsi(this);" data-is-recording=0><i class="fas fa-record-vinyl"></i> Mulai Rekam</button>  -->
                    <button type="button" class="btn btn-primary mb-3" id="btn-stop" data-id-jadwal-konsultasi='<?php echo $id_jadwal_konsultasi ?>' data-id-pasien="<?php echo $pasien->id ?>">Selesai</button>
                    <!-- Modal -->
                    <div class="modal fade" id="memanggil" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width: 300px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Memanggil...</h5>
                                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> -->
                                </div>
                                <div class="modal-body" align="center">
                                    <i class="fa fa-phone fa-5x" style="color: #007Bff;">....</i>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--modal-->
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#bottom-tab2" data-toggle="tab"><i class="fa fa-video-camera"></i> Video Conference</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab1" data-toggle="tab"><i class="fa fa-comments"></i> Chat</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show" id="bottom-tab1">
                            <div class="col-md-12">
                                <div class="col-lg-9 message-view chat-view">
                                    <div class="chat-window" style="padding-top: -20px">
                                        <div class="fixed-header">
                                            <div class="navbar row">
                                                <div class="user-details mr-auto">
                                                    <div class="float-left user-img m-r-10">
                                                        <?php
                                                        if ($pasien->foto) {
                                                            $foto = base_url('assets/images/users/' . $pasien->foto);
                                                        } else {
                                                            $foto = base_url('assets/telemedicine/img/default.png');
                                                        }
                                                        ?>
                                                        <a href="#" title="<?php echo $pasien->name ?>"><img src="<?php echo $foto; ?>" alt="" class="w-40 rounded-circle">
                                                            <!--<span class="status online"></span>-->
                                                        </a>
                                                    </div>
                                                    <div class="user-info float-left">
                                                        <a href="#"><span class="font-bold"><?php echo $pasien->name ?></span>
                                                            <!--<i class="typing-text">Typing...</i>-->
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                        <label class="images-upload">
                                                            <img src="<?php echo base_url('assets/dashboard/img/attachment.png'); ?>" alt="">
                                                            <input id="attachment_label" type="file" name="attachment" accept=".jpg,.jfif,.jpeg,.png,.txt,.docx,.doc,.pdf">
                                                        </label>
                                                        <div class="message-area">
                                                            <div class="input-group">
                                                                <textarea class="form-control" name="message" placeholder="Type message..."></textarea>
                                                                <span class="input-group-append">
                                                                    <button class="btn btn-primary" id="send"><i class="fa fa-send"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
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
                            <div class="col-md-12 mb-5 mt-2">
                                <div id="meet" width="800" height="800" style="background: #000;"></div>
                                <!-- <video autoplay id="video-other" style="background-color: #000;" width="100%" height="100%"></video>                  
                                          <video autoplay id="video-ku" style="background-color: #000; position: absolute; bottom: 75px; right: 8px; width: 40%; height: 40%;"></video> -->
                            </div>
                        </div>
                    </div>
                </div>
                <form id="formKonsultasi_2">
                    <div class="card-box">
                        <div class="col-md-12" id="diagnosis">
                            <h4 class="mb-3">Diagnosa</h4>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <select id='diagnosis' name='diagnosis' style="width: 100%">
                                        <option value='0'>-- Pilih Diagnosa --</option>
                                    </select>
                                    <!-- <textarea class="form-control" rows="5" placeholder="diagnosa dokter" name="diagnosis"><?php //if($diagnosis){ echo $diagnosis->diagnosis; } 
                                                                                                                                ?></textarea> -->
                                    <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <h4 class="mb-3 col-md-9">Resep</h4>
                                <!-- <div class="col-md-3">
                                    <button type="button" class="btn btn-light btn-sm" id="remove"><i class="fa fa-minus" style="color: #009EFB">HAPUS</i></button>    
                                </div> -->
                                <div class="col-md-3" style="float: right;">
                                    <button type="button" data-toggle="modal" data-target="#ModalResep" class="btn btn-light btn-sm" id="add"><i class="fa fa-plus" style="color: #009EFB;">TAMBAH</i></button>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <div class="table-responsive">
                                        <table class="table table-border table-hover custom-table mb-0">
                                            <thead>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>Jumlah</td>
                                                    <td>Aturan Pakai</td>
                                                    <td>Aksi</td>
                                                </tr>
                                            </thead>
                                            <tbody id="listResep">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="resepDokter">
                                </div>
                            </div>
                            <!-- <div class="col-sm-12">
                                    <hr>
                                  <div class="form-group resep-dokter" id="resepDokter">
                                       <div class="row">
                                           <div class="col-sm-5 col-12 mb-1">
                                          <?php foreach ($list_obat as $obat) { ?>
                                              <div id="obat-<?php echo $obat->id ?>" style="display: none"><?php echo $obat->unit ?></div>
                                            <?php } ?>
                                              <select name="id_obat[]" id="obat" class="form-control 
                                              form-control-sm" onchange="obat_onchange();">
                                              <option value="Tidak Ada">Pilih Obat</option>
                                                    <?php foreach ($list_obat as $obat) { ?>
                                              <option value="<?php echo $obat->id ?>"><?php echo $obat->name ?></option>
                                                    <?php } ?>
                                              </select>
                                           </div>
                                           <div class="col-sm-3 col-12 mb-1">
                                                <input type="number" min=1 max=100 name="jumlah_obat[]" class="form-control form-control-sm" id="unit" placeholder="Jml">
                                           </div>
                                           <div class="col-sm-4 col-12 mb-1">
                                                <input type="text" name="keterangan[]" class="form-control form-control-sm" placeholder="Aturan Minum">
                                           </div>
                                         </div>
                                    </div>
                                </div> -->
                            <input type="hidden" name="id_pasien" value=<?php echo $pasien->id ?>>
                            <input type="hidden" name="id_jadwal_konsultasi" value=<?php echo $id_jadwal_konsultasi ?>>
                        </div>
                    </div>
                </form>
        </div>
        </aside>
    </div>
</div>
</div>
</div>



<div class="modal fade" id="ModalResep" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background:linear-gradient(to right, #36d1dc, #009efb)">
                <h4 class="modal-title" id="exampleModalLabel">Resep Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formResepDokter">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <!-- <label for="recipient-name" class="col-form-label">Nama Obat :</label> -->
                                    <?php foreach ($list_obat as $obat) { ?>
                                        <div id="obat-<?php echo $obat->id ?>" style="display: none"><?php echo $obat->unit ?></div>
                                    <?php } ?>
                                    <select name="id_obat" id="obat" class="form-control 
			                                              form-control-sm" onchange="obat_onchange();" required>
                                        <option disabled selected value="">Pilih Obat</option>
                                        <?php foreach ($list_obat as $obat) { ?>
                                            <option value="<?php echo $obat->id ?>"><?php echo $obat->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <!-- <label for="message-text" class="col-form-label">Jumlah :</label> -->
                                    <input type="number" min=1 max=100 name="jumlah_obat" class="form-control form-control-sm" id="unit" placeholder="Jml" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <!-- <label for="message-text" class="col-form-label">Aturan Minum :</label> -->
                                    <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required>
                                </div>
                            </div>
                            <input type="hidden" name="satuan_obat" id="satuan_obat" value="">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="buttonTambahResep" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <!-- <button type="button" class="btn btn-primary">Tambah</button> -->
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="pasienError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 300px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pasien Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Pasien <b><?php echo ucwords($pasien->name) ?></b> tidak dapat menerima panggilan saat ini, karena belum mengizinkan notifikasi di devicenya. <br />
                No HP Pasien: <b><?php echo $pasien->telp ?></b><br />
                Email Pasien: <b><?php echo $pasien->email ?></b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    var uniqid = makeid(12);
    reg_id = '<?php echo $pasien->reg_id; ?>';
    name = '<?php echo $user->name; ?>';
    var room_name = 'telemedicine_lintas_' + <?php echo $id_jadwal_konsultasi ?> + '_' + <?php echo $user->id ?> + '_' + uniqid;
    document.getElementById("user-call").value = '<?php echo $pasien->id ?>';
    var userName = name;
    const domain = 'telekonsultasi.indihealth.com';
    const options = {
        roomName: room_name,
        width: 550,
        height: 500,

        parentNode: document.querySelector('#meet')

    };
    const api = new JitsiMeetExternalAPI(domain, options);
    api.executeCommand('displayName', userName);
    api.executeCommand('toggleTileView');
    api.executeCommand('startRecording', {
        mode: 'file' //recording mode, either `file` or `stream`.
    });
    api.addEventListener('participantRoleChanged', function(event) {
        if (event.role === 'moderator') {
            api.executeCommand('toggleLobby', true);
        }
    });
    api.on('passwordRequired', function() {
        api.executeCommand('password', '123456');
    });

    function recordJitsi(e) {
        api.executeCommand('stopRecording', 'stream');
        var isRecording = e.getAttribute('data-is-recording');
        if (isRecording == "1") {
            api.executeCommand('stopRecording', 'stream');
            e.innerHTML = '<i class="fas fa-record-vinyl"></i> Mulai Rekam';
            e.setAttribute('data-is-recording', "0");
            e.style = 'background-color: green';
        } else {
            api.executeCommand('startRecording', 'stream');
            e.innerHTML = '<i class="fas fa-stop"></i> Stop Rekam';
            e.setAttribute('data-is-recording', "1");
            e.style = 'background-color:red;';
        }
    }
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/conference.js'); ?>"></script>
<?php $foto_pasien = $pasien->foto ? base_url('assets/images/users/' . $pasien->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<?php $foto_dokter = $user->foto ? base_url('assets/images/users/' . $user->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<script>
    chat_locate = 'dokter';
    user_kategori = 'dokter';
    id_pasien = <?php echo $pasien->id ?>;
    id_dokter = <?php echo $user->id ?>;
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
        var satuan_obat_hidden = document.getElementById('satuan_obat');

        var satuan_show = document.getElementById('unit');

        satuan_show.placeholder = "Jml (" + satuan.innerHTML + ")";
        satuan_obat_hidden.value = satuan.innerHTML;
    }
</script>
<div class="sidebar-overlay" data-reff=""></div>