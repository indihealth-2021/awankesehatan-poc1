<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard'); ?>" class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/Teleconsultasi'); ?>" class="text-black">Jadwal Telekonsultasi</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Proses Telekonsultasi</a></li>
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
                                <button type="button" data-toggle="modal" data-target="#exampleModal" class="mb-2 btn btn-konsul" id="panggil" data-id-pasien="<?php echo $pasien->id ?>" data-id-jadwal-konsultasi="<?php echo $id_jadwal_konsultasi ?>"><img src="<?php echo base_url('assets/dashboard/img/phone-call.png'); ?>" alt=""> Hubungi Pasien</button>
                                <button type="button" class="btn btn-konsul mx-3 d-mobile-none_" id="btn-stop" data-id-jadwal-konsultasi='<?php echo $id_jadwal_konsultasi ?>' data-id-pasien="<?php echo $pasien->id ?>"><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button>
                                <!-- <button type="button" class="btn btn-konsul mx-auto d-mobile-show" id="btn-stop" data-id-jadwal-konsultasi='<?php echo $id_jadwal_konsultasi ?>' data-id-pasien="<?php echo $pasien->id ?>"><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button> -->
                                <div id="countdown-timer"></div>
                                <div style="display: none;" id="timer"><?= empty($detail_dokter->durasi) ? 60 : $detail_dokter->durasi ?></div>

                                <!-- Modal -->
                                <div class="modal fade" id="memanggil" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="width: 400px">
                                            <div class="modal-header">
                                                <p class="modal-title font-24" id="exampleModalLabel">Memanggil...</p>
                                            </div>
                                            <div class="modal-body" align="center">
                                                <i class="fa fa-phone fa-5x text-tele">....</i>
                                                <div class="mt-5">
                                                    <button type="button" class="btn btn-batal" data-dismiss="modal" onclick="resetContainer()">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--modal-->

                            </div>
                            <div class="">
                                <div id="meet" width="100%" height="700" style="background: #000;"></div>
                                <!-- <video autoplay id="video-other" style="background-color: #000;" width="100%" height="100%"></video>
                                          <video autoplay id="video-ku" style="background-color: #000; position: absolute; bottom: 75px; right: 8px; width: 40%; height: 40%;"></video> -->
                            </div>
                        </div>
                    </div>
                </div>



                <!--card diagnosa-->
                <div class="card card-5 p-2 px-4">
                    <form id="formKonsultasi_2">

                        <p class="py-2 font-12">Diagnosa</p>
                        <div class="col-md-12" id="diagnosis">
                            <div class="form-group row">
                                <select id='diagnosis' name='diagnosis' style="width: 100%">
                                    <option value='0'>-- Pilih Diagnosa --</option>
                                </select>
                                <!-- <textarea class="form-control" rows="5" placeholder="diagnosa dokter" name="diagnosis"><?php //if($diagnosis){ echo $diagnosis->diagnosis; }
                                                                                                                            ?></textarea> -->
                                <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12" id="tipepenyakit">
                            <div class="form-group row">
                                <div class="form-check form-check-inline">
                                    <input name="kronis" class="form-check-input" type="radio" id="tipe-penyakit-2" value="1">
                                    <label class="form-check-label" for="tipe-penyakit-1">Kronis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="kronis" class="form-check-input" type="radio" id="tipe-penyakit-2" value="2">
                                    <label class="form-check-label" for="tipe-penyakit-2">Akut</label>
                                </div>
                            </div>
                        </div>
                        <p class="py-2 font-12">Planning</p>
                        <div class="col-md-12" id="diagnosis">
                            <div class="form-group row">
                                <textarea name="planning" class="form-control" id="planning"></textarea>
                            </div>
                        </div>
                        <p class="py-2 font-12">Pemeriksaan Penunjang</p>
                        <div class="col-md-12" id="diagnosis">
                            <div class="form-group row">
                                <div class="form-check form-check-inline">
                                    <input name="laboratorium" class="form-check-input" type="checkbox" id="tipe-pemeriksaan-1" value="1">
                                    <label class="form-check-label" for="tipe-pemeriksaan-1">Laboratorium</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="radiologi" class="form-check-input" type="checkbox" id="tipe-pemeriksaan-2" value="1">
                                    <label class="form-check-label" for="tipe-pemeriksaan-2">Radiologi</label>
                                </div>
                                <!-- <textarea name="pemeriksaan" class="form-control mt-2" id="pemeriksaan"></textarea> -->
                                <div class="col-md-12 mt-3" id="diagnosis-detail-laboratorium">
                                    <h4 class="mb-3">Pemeriksaan Penunjang - Laboratorium</h4>

                                    <?php $lab = explode(",", "Darah Lengkap,Urine Rutin,Kolesterol Total,Trigliserida,HDL Kolesterol,LDL Kolesterol,Ureum (BUN),Kreatinin,Asam Urat,Glukosa Puasa,Glukosa 2 Jam PP,HBA 1c,Natrium,Kalium,Klorida"); ?>

                                    <?php for ($i = 0; $i < count($lab); $i++) { ?>
                                        <div class="form-check form-check-inline">
                                            <input name="tipe-pemeriksaan-1-<?= $i ?>" class="form-check-input" type="checkbox" id="tipe-pemeriksaan-1-<?= $i ?>" value="<?= $lab[$i] ?>">
                                            <label class="form-check-label" for="tipe-pemeriksaan-1-<?= $i ?>"><?= $lab[$i] ?></label>
                                        </div>
                                    <?php } ?>

                                    <input type="hidden" name="count-lab" value="<?= count($lab); ?>">

                                </div>

                                <div class="col-md-12 mt-3" id="diagnosis-detail-radiologi">
                                    <h4 class="mb-3 opacity-75">Pemeriksaan Penunjang - Radiologi</h4>

                                    <?php $rad = explode(",", "Thorax,Waters"); ?>

                                    <?php for ($i = 0; $i < count($rad); $i++) { ?>
                                        <div class="form-check form-check-inline">
                                            <input name="tipe-pemeriksaan-2-<?= $i ?>" class="form-check-input" type="checkbox" id="tipe-pemeriksaan-2-<?= $i ?>" value="<?= $rad[$i] ?>">
                                            <label class="form-check-label" for="tipe-pemeriksaan-2-<?= $i ?>"><?= $rad[$i] ?></label>
                                        </div>
                                    <?php } ?>

                                    <input type="hidden" name="count-rad" value="<?= count($rad); ?>">

                                </div>
                            </div>
                        </div>

                        <p class="py-2 font-12">Kesimpulan</p>
                        <div class="col-md-12" id="diagnosis">
                            <div class="form-group row">
                                <textarea name="kesimpulan" class="form-control" id="kesimpulan"></textarea>
                            </div>
                        </div>
                        <p class="py-2 font-12">Apotek</p>
                        <div class="col-md-12" id="apotek">
                            <div class="form-group row">
                                <select id='apotek select' name='apotek' style="width: 100%">
                                    <option value='0'>-- Pilih Apotek --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-12">Resep</p>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-resep float-right" type="button" data-toggle="modal" data-target="#ModalResep" id="add">+ Tambah Obat </button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-resep float-right" type="button" data-toggle="modal" data-target="#ModalRacikan" id="add">+ Tambah Racikan </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive p-3">
                                <table class="table table-border table-hover custom-table mb-0" id="table-obat">
                                    <thead class="font-12">
                                        <tr class="text-abu">
                                            <td>Nama Obat</td>
                                            <td>Jumlah</td>
                                            <td>Keterangan</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody id="listResep">
                                    </tbody>
                                </table>
                            </div>
                            <div id="resepDokter"></div>
                        </div>
                        <input type="hidden" name="id_pasien" value=<?php echo $pasien->id ?>>
                        <input type="hidden" name="id_jadwal_konsultasi" value=<?php echo $id_jadwal_konsultasi ?>>
                        <!-- <button type="button" id="update_diagnosa" class="btn btn-primary mt-4"><i class="fas fa-hourglass-end mr-4"></i> Selesaikan telekonsultasi</button> -->
                    </form>
                </div>
            </div>


            <!-- batas col-md-7 -->
            <div class="col-md-5">
                <div class="card card-5 p-2 px-4">
                    <p style="border-bottom: 1px solid #DEDEDE;" class="py-2 font-12">Data Pasien</p>



                    <!-- Modal -->
                    <div class="modal" id="modalHistory" aria-labelledby="modalHistoryLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="height: auto;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHistoryLabel">Riwayat Pasien</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <table class="table font-12">
                                            <thead>
                                                <tr>
                                                    <th scope="row">Tanggal Kunjungan</th>
                                                    <th>Tempat</th>
                                                    <th>Diagnosa</th>
                                                    <th>Obat</th>
                                                    <th>Biaya</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($history_diagnosa) { ?>
                                                <?php foreach ($history_diagnosa as $diagnosa) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $diagnosa->admissionDate ?></th>
                                                    <td><?php echo $diagnosa->providerName ?></td>
                                                    <td><?php echo $diagnosa->diagnosis ?></td>
                                                    <td><button class="btn btn-info" data-toggle="modal" data-target="#resep-obat-list">Detail</button></td>
                                                    <!-- <td><?php echo $diagnosa->claimStatus ?></td> -->
                                                    <td><?php echo 'Rp. '. $diagnosa->chargeValue ?></td>
                                                </tr>
                                                <?php } ?>
                                                <?php } else { ?>
                                                <tr>    
                                                    <td colspan="5" align="center">Tidak ada riwayat pasien</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer mr-3">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if ($pasien->foto) {
                            $foto = base_url('assets/images/users/' . $pasien->foto);
                        } else {
                            $foto = base_url('assets/telemedicine/img/default.png');
                        }
                        ?>
                        <div class="col-md-2"><img src="<?php echo $foto; ?>" width="41" height="41" class="border-radius-50"></div>
                        <div class="col-md-9">
                            <span class="font-14"><?php echo ucwords($pasien->name) ?></span><br>
                            <span class="font-11"><?php echo $pasien->age == '2020' ? '-' : $pasien->age . ' Tahun' ?></span> <br>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary mt-3 mb-3" data-toggle="modal" data-target="#modalHistory">
                                <i class="font-16 fa fa-clock mr-3"></i> Riwayat Pasien
                            </button>
                        </div>
                    </div>
                </div>
                <form id="formKonsultasi">
                    <div class="card card-5 p-2 px-4">
                        <p style="border-bottom: 1px solid #DEDEDE;" class="py-2 font-12">Assesment Pasien</p>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-group form-focus-asses">
                                        <label class="focus-label">Berat Badan</label>
                                        <input type="number" class="form-control floating" value="<?php if ($assesment) {
                                                                                                        echo $assesment->berat_badan;
                                                                                                    } ?>" name="berat_badan" placeholder="Isi Berat Badan Disini" required>
                                        <label class="focus-label-right">Kg</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-group form-focus-asses">
                                        <label class="focus-label">Tinggi Badan</label>
                                        <input type="number" class="form-control floating" value="<?php if ($assesment) {
                                                                                                        echo $assesment->tinggi_badan;
                                                                                                    } ?>" name="tinggi_badan" placeholder="Isi Tinggi Badan Disini" required>
                                        <label class="focus-label-right">Cm</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-group form-focus-asses">
                                        <label class="focus-label">Tekanan Darah</label>
                                        <input type="text" class="form-control floating" name="tekanan_darah" value="<?php if ($assesment && !$old_assesment) {
                                                                                                                            echo $assesment->tekanan_darah;
                                                                                                                        } ?>" placeholder="Isi Tekanan Darah Disini">
                                        <label class="focus-label-right">mmHg</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-group form-focus-asses">
                                        <label class="focus-label">Suhu</label>
                                        <input type="text" class="form-control floating" name="suhu" value="<?php if ($assesment && !$old_assesment) {
                                                                                                                echo $assesment->suhu;
                                                                                                            } ?>" placeholder="Isi Suhu Disini">
                                        <label class="focus-label-right">Celcius</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-group font-12">
                                        <label for="" class="text-abu col-form-label">Merokok</label><br>
                                        <label class="radio-inline">
                                            <input required type="radio" name="merokok" id="merokok-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->merokok) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Ya
                                        </label><br>
                                        <label class="radio-inline">
                                            <input required type="radio" name="merokok" id="merokok-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->merokok) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-group font-12">
                                        <label for="" class="text-abu col-form-label">Di Rawat</label><br>
                                        <label class="radio-inline">
                                            <input required type="radio" name="dirawat" id="dirawat-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->dirawat) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Pernah
                                        </label><br>
                                        <label class="radio-inline">
                                            <input required type="radio" name="dirawat" id="dirawat-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->dirawat) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Tidak Pernah
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
                                            <input required type="radio" name="alkohol" id="alkohol-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->alkohol) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Ya
                                        </label><br>
                                        <label class="radio-inline">
                                            <input required type="radio" name="alkohol" id="alkohol-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->alkohol) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-group font-12">
                                        <label for="" class="text-abu col-form-label">Kecelakaan</label><br>
                                        <label class="radio-inline">
                                            <input required type="radio" name="kecelakaan" id="kecelakaan-1" value=1 <?php if ($assesment) {
                                                                                                                            if ($assesment->kecelakaan) {
                                                                                                                                echo "checked";
                                                                                                                            }
                                                                                                                        } ?>> Pernah
                                        </label><br>
                                        <label class="radio-inline">
                                            <input required type="radio" name="kecelakaan" id="kecelakaan-0" value=0 <?php if ($assesment) {
                                                                                                                            if (!$assesment->kecelakaan) {
                                                                                                                                echo "checked";
                                                                                                                            }
                                                                                                                        } ?>> Tidak Pernah
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
                                            <input required type="radio" name="operasi" id="operasi-1" value=1 <?php if ($assesment) {
                                                                                                                    if ($assesment->operasi) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Pernah
                                        </label><br>
                                        <label class="radio-inline">
                                            <input required type="radio" name="operasi" id="operasi-0" value=0 <?php if ($assesment) {
                                                                                                                    if (!$assesment->operasi) {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>> Tidak Pernah
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5 pb-5">
                                    <div class="form-group form-focus-asses">
                                        <label class="focus-label">Keluhan</label>
                                        <textarea required rows="4" class="font-12 form-control floating" name="keluhan"><?php if ($assesment && !$old_assesment) {
                                                                                                                                echo $assesment->keluhan;
                                                                                                                            } ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="file_asesmen">
                                    <?php if (!empty($file_asesmen)) { ?>
                                        <p class="py-2 font-12">File Asesmen Pasien</p>
                                        <?php foreach ($file_asesmen as $file) { ?>
                                            <div class="card" onclick="window.open('<?php echo base_url('assets/files/file_pemeriksaan_luar/' . $file->path_file) ?>', '_blank')">
                                                <div class="card-body">
                                                    <h5><?php echo $file->nama_file ?></h5>
                                                    <p><?php echo $file->type_file ?></p>
                                                    <a href="<?php echo base_url('assets/files/file_pemeriksaan_luar/' . $file->path_file) ?>" class="btn btn-primary btn-sm" target="_blank">Lihat File</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- <button type="button" class="btn-selesai-tele">Selesai</button> -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ModalRacikan" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: auto;">
            <div class="modal-header">
                <p class="modal-title font-14 font-bold-7" id="exampleModalLabel">Tambah Racikan</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRacikanDokter">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="font-12 col-form-label">Nama Racikan</label>
                                <input type="text" name="nama_racikan" class="form-control form-control-sm" id="nama-racikan" placeholder="Racikan A" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="recipient-name" class="font-12 col-form-label">Pilih Obat </label>
                                <div class="input-group">
                                    <select name="id_obat_racikan" id="obat-racikan" class="form-control form-control-sm" onchange="">
                                        <option disabled selected value="">Pilih Obat</option>
                                        <?php foreach ($list_obat as $obat) { ?>
                                            <option value="<?php echo $obat->id ?>"><?php echo $obat->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="px-2 btn btn-primary btn-sm" id="addObatButton">+</button>
                                        <button type="button" class="px-2 btn btn-danger btn-sm" id="resetRacikanButton">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>List Obat</h4>
                            <div class="col-md-12 row" id="selectedObatsContainer"></div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="form-group">
                                <label for="message-text" class="font-12 col-form-label">Jumlah Obat</label>
                                <input type="number" min=1 max=100 name="jumlah_obat" class="form-control form-control-sm" id="unit-racikan" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="font-12 col-form-label">Aturan Pakai</label>
                                <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required>
                            </div>
                        </div>
                        <input type="hidden" name="satuan_obat" id="satuan_obat" value="">
                    </div>
            </div>
            <div class="modal-footer">
                <div class="float-left">
                    <input type="hidden" name="selectedObats" id="selectedObats">
                    <button id="buttonTambahResep" class="btn btn-simpan-sm">Simpan</button>
                    <button type="button" class="btn btn-batal-sm mr-3" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalResep" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: auto;">
            <div class="modal-header">
                <p class="modal-title font-14 font-bold-7" id="exampleModalLabel">Tambah Resep</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formResepDokter">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="recipient-name" class="font-12 col-form-label">Pilih Obat </label>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="font-12 col-form-label">Jumlah Obat</label>
                                <input type="number" min=1 max=100 name="jumlah_obat" class="form-control form-control-sm" id="unit" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message-text" class="font-12 col-form-label">Aturan Pakai</label>
                                <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required>
                            </div>
                        </div>
                        <input type="hidden" name="satuan_obat" id="satuan_obat" value="">
                    </div>
            </div>
            <div class="modal-footer">
                <div class="float-left">
                    <button id="buttonTambahResep" class="btn btn-simpan-sm">Simpan</button>
                    <button type="button" class="btn btn-batal-sm mr-3" data-dismiss="modal">Batal</button>
                </div>
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
                <div class="float-left">
                    <button type="button" class="btn btn-batal-sm mr-3" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="resep-obat-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resep Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table table-stripped table-bordered">
        <thead>
            <th>Nama obat</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" align="center">Belum ada data</td>
            </tr> 
            
        </tbody>
       </table>
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
    document.querySelector("#user-call").value = '<?php echo $pasien->id ?>';
    var userName = name;
    const domain = 'telekonsultasi2.telemedical.id';
    const options = {
        roomName: room_name,
        width: '100%',
        height: 400,
        parentNode: document.querySelector('#meet'),
        configOverwrite: {
            toolbarButtons: [
                'microphone',
                'camera'
            ],
            disableDeepLinking: true,
        },
        userInfo: {
            displayName: userName
        },
    };

    navigator.mediaDevices.getUserMedia({
        audio: true,
        video: true
    }).then(function(stream) {
        // startTimer();
        const api = new JitsiMeetExternalAPI(domain, options).then(() => {
            document.querySelector("#jitsiConferenceFrame0").contentWindow.location.reload();
        });
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

    let timePassed = 0;
    const TIME_LIMIT = parseInt(document.querySelector("#timer").textContent);
    let timeLeft = TIME_LIMIT;
    let timerInterval = null;

    function startTimer() {
        timerInterval = setInterval(() => {
            timePassed += 1;
            timeLeft = TIME_LIMIT - timePassed;
            displayTimeLeft();

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
            }
        }, 1000);
    }

    function displayTimeLeft() {
        const timerElement = document.querySelector("#countdown-timer");
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        const formattedTime = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        timerElement.textContent = formattedTime;

        if (timeLeft <= 0) {
            timerElement.innerHTML = "<span class='text-danger'>Waktu habis!</span>";
            alert("Kami ingin mengingatkan bahwa waktu konsultasi telah habis sesuai jadwal. Namun, jika Anda merasa perlu untuk melanjutkan konsultasi dengan pasien yang sedang Anda layani saat ini, silakan lanjutkan sesuai kebijakan Anda.");
        }
    }
</script>
<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/conference.js'); ?>"></script> -->
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
    var selectedObats = [];

    document.getElementById("resetRacikanButton").addEventListener("click", () => {
        document.getElementById("selectedObatsContainer").innerHTML = "";
    });

    document.getElementById("addObatButton").addEventListener("click", function() {
        var selectedObatId = document.querySelector("#obat-racikan").value;
        var selectedObatName = document.querySelector("#obat-racikan option[value='" + selectedObatId + "']").text;

        if (selectedObatId && selectedObatName) {
            var selectedObat = {
                id: selectedObatId,
                name: selectedObatName,
            };
            selectedObats.push(selectedObat);
            $("#selectedObats").val(selectedObats.map((element) => {
                return element.id;
            }));

            var selectedObatsContainer = document.getElementById("selectedObatsContainer");
            var selectedObatDiv = document.createElement("div");
            var jumlahObat = document.createElement("input");
            var removeObat = document.createElement("button");

            jumlahObat.id = "jumlah-" + selectedObatId;
            removeObat.id = "remove-" + selectedObatId;
            selectedObatDiv.id = selectedObatId;
            selectedObatDiv.className = "";

            jumlahObat.type = "number";
            jumlahObat.name = "jumlahObat-" + selectedObatId;
            jumlahObat.className = "form-control";
            jumlahObat.placeholder = "Jumlah";

            removeObat.className = "btn btn-danger m-2 p-2";

            removeObat.textContent = "Hapus";
            selectedObatDiv.textContent = selectedObatName;

            selectedObatsContainer.appendChild(selectedObatDiv);
            selectedObatDiv.appendChild(removeObat);
            selectedObatDiv.appendChild(jumlahObat);

            document.getElementById("obat-racikan").value = "";

            $("#remove-" + selectedObatId).click(() => {
                $("#" + selectedObatId).remove();
                $("#remove-" + selectedObatId).remove();

                selectedObats.forEach((element, index) => {
                    if (element.id === selectedObatId) {
                        selectedObats.splice(index, 1);
                        $("#selectedObats").val(selectedObats.map((element) => {
                            return element.id;
                        }));
                    }
                });
            });
        }
    });
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