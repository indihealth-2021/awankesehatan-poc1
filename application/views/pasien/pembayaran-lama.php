<?php $bukti_pembayaran = $this->db->query('SELECT * FROM bukti_pembayaran WHERE id_pasien = ' . $this->session->userdata('id_user') . ' AND id_registrasi = "' . $registrasi->registrasi_id . '"')->row(); ?>
<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-5 col-5">
                <h4 class="page-title">Pembayaran</h4>
            </div>
            <div class="col-sm-7 col-7">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 card-box">
                <div class="row text-black">
                    <div class="col-sm-12 col-12">
                        <h4 align="center" class="mb-5"><u>Pembayaran Telekonsultasi</u></h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-4">No Registrasi</label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7">
                                <p><?php echo $registrasi->registrasi_id ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-4">Nama Dokter</label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7">
                                <p><?php echo $registrasi->nama_dokter; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-4">Poli</label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7">
                                <p><?php echo $registrasi->poli; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $biaya_konsultasi = $registrasi->biaya_konsultasi_bukti ? $registrasi->biaya_konsultasi_bukti : $registrasi->biaya_konsultasi_poli;
                    ?>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-4">Biaya Konsultasi</label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7">
                                <p><?php echo 'Rp. ' . number_format($biaya_konsultasi, 2, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $biaya_adm = $registrasi->biaya_adm_bukti ? $registrasi->biaya_adm_bukti : ($registrasi->biaya_adm_poli ? $registrasi->biaya_adm_poli : $web->harga_adm);
                    ?>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-4">Biaya Administrasi</label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7">
                                <p><?php echo 'Rp. ' . number_format($biaya_adm, 2, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-4">Total Bayar</label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7">
                                <p><?php $total_harga = $biaya_konsultasi + $biaya_adm;
                                    echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-4">Status</label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7">
                                <p class="text-red"><?php if ($registrasi->id_status_pembayaran == 0) {
                                                        echo "<font color='red'>" . $registrasi->keterangan . "</font>";
                                                    } else if ($registrasi->id_status_pembayaran == 2) {
                                                        echo "<font color='blue'>Sedang Diproses</font>";
                                                    } else {
                                                        $keterangan = $bukti_pembayaran->metode_pembayaran == 1 ? $registrasi->keterangan : 'PAID';
                                                        echo "<font color='green'>" . $keterangan . "</font>";
                                                    } ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label for="metode-pembayaran" class="col-md-4 col-4">Metode Pembayaran</label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7">
                                <div class="row" style="padding-left: 12px">
                                    <?php if ($registrasi->id_status_pembayaran == 0) { ?>
                                        <select class="form-control col-10" name="metode_pembayaran" id="metode-pembayaran">
                                            <option value="1" selected>Transfer</option>
                                            <option value="2">Owlexa</option>
                                        </select>
                                    <?php } else { ?>
                                        <?php echo $bukti_pembayaran->metode_pembayaran == 1 ? 'Transfer' : 'Owlexa'; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($registrasi->id_status_pembayaran == 0) { ?>
                        <div class="col-sm-12">
                            <hr align="center">
                        </div>
                    <?php } ?>
                    <div class="col-sm-12 <?php echo !$bukti_pembayaran ? 'metode-transfer' : ''; ?> pt-3">
                        <div class="form-group row">
                            <label class="col-md-4 col-4"><?php if ($bukti_pembayaran) {
                                                                echo $bukti_pembayaran->metode_pembayaran == 1 ? 'Bukti Pembayaran' : 'Claim Number';
                                                            } else {
                                                                echo 'Bukti Pembayaran';
                                                            } ?></label>
                            <label class="col-sm-1 col-1">:</label>
                            <div class="col-md-7 col-7" style="padding-left: 25px">
                                <?php
                                if ($registrasi->id_status_pembayaran == 0) {

                                    echo '
                                                    ' . form_open_multipart("pasien/Pembayaran/bayar") . '
                                                    <div class="row" id="form_pembayaran" style="padding-left: 4px">
                                                        <input type="hidden" name="id_dokter" value="' . $registrasi->id_dokter . '">
                                                        <input type="hidden" name="regid" value="' . $registrasi->registrasi_id . '">
                                                        <div class="custom-file col-10">
                                                            <input type="file" name="bukti_pembayaran" class="custom-file-input" id="file_upload" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                                                            <label class="custom-file-label" for="customFile" id="filename"></label>
                                                        </div>
                                                    </div>
                                                    </div>
                                                        <div class="m-t-20 col-sm-4 offset-lg-4">
                                                            <button class="btn btn-success submit-btn btn-block"><i class=""></i> KIRIM</button>
                                                        </div>
                                                    </form>';
                                } else {
                                    if ($bukti_pembayaran->metode_pembayaran == 1) {
                                        echo '
                                                    <img src="' . base_url("assets/images/bukti_pembayaran/" . $bukti_pembayaran->photo) . '" style="max-width: 200px;" />
                                                    </div>
                                                ';
                                    } else {
                                        echo $bukti_pembayaran->claim_number;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        if ($registrasi->id_status_pembayaran == 0) {
                        ?>
                            <div class="col-sm-12 metode-owlexa pt-3">
                                <form id="form_owlexa" method="POST" action="<?php echo base_url('pasien/Pembayaran/bayar_owlexa'); ?>">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Nama Lengkap</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7" style="padding-left: 25px">
                                            <div class="row" style="padding-left: 4px">
                                                <input type="text" class="form-control col-10" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-sm-12 metode-owlexa">
                                <div class="form-group row">
                                    <label class="col-md-4 col-4">Nomor Kartu</label>
                                    <label class="col-sm-1 col-1">:</label>
                                    <div class="col-md-7 col-7" style="padding-left: 25px">
                                        <div class="row" style="padding-left: 4px">
                                            <input type="number" class="form-control col-10" name="cardNumber" placeholder="Masukkan Nomor Kartu">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 metode-owlexa">
                                <div class="form-group row">
                                    <label class="col-md-4 col-4">Tanggal Lahir</label>
                                    <label class="col-sm-1 col-1">:</label>
                                    <div class="col-md-7 col-7" style="padding-left: 25px">
                                        <div class="row" style="padding-left: 4px">
                                            <input type="date" class="form-control col-10" name="birthDate" placeholder="Masukkan Tanggal Lahir" value="<?php echo $user->lahir_tanggal; ?>" readonly disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 metode-owlexa">
                                <div class="form-group row">
                                    <label class="col-md-4 col-4">OTP</label>
                                    <label class="col-sm-1 col-1">:</label>
                                    <div class="col-md-7 col-7" style="padding-left: 25px">
                                        <div class="row" style="padding-left: 4px">
                                            <input type="number" class="form-control col-10" name="otp" placeholder="Masukkan OTP" aria-describedby="send_otp">
                                            <span class="col-2"></span>
                                            <a href="#" id="btnSendOtp" class="form-text" style="font-size: 14px;">
                                                <span class="fa fa-sign-in"> Send OTP</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 col-sm-4 offset-lg-4">
                                    <input type="hidden" name="id_dokter" value="<?php echo $registrasi->id_dokter; ?>">
                                    <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id; ?>">
                                    <input type="hidden" name="chargeValue" value="<?php echo $total_harga; ?>">
                                    <button class="btn btn-success submit-btn btn-block" id="btnKirim"><i class=""></i> KIRIM</button>
                                </div>
                            </div>
                            </form>
                        <?php } ?>
                        <div class="m-t-20 text-right col-sm-12">
                            <a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>" type="button" class="btn btn-primary">Kembali <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="jawaban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 300px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Panggilan...</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button> -->
                </div>
                <div class="modal-body" align="center">
                    <i class="fa fa-phone fa-5x" style="color: #007Bff;">....</i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="jawab" data-id-jadwal-konsultasi="" data-room-name="" data-id-dokter="">Jawab</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="tolak" data-id-dokter="">Tolak</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tac_modal_owlexa" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">SYARAT DAN KETENTUAN PEMBAYARAN OWLEXA</h5>
                </div>
                <div class="modal-body">
                    <div style="overflow-y: scroll; max-height: 200px; padding: 5px;" id="tac_body_owlexa">

                    </div>
                    <hr>
                    <input type="checkbox" value="" id="tac_checkbox_owlexa" disabled> <label for="tac_checkbox_owlexa"><b>Saya menyetujui syarat dan ketentuan</b></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="simpan_tac_owlexa" disabled>Simpan</button>
                    <button type="button" class="btn btn-danger" id="batal_tac_owlexa" data-dismiss="#tac_modal_owlexa">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var id_dokter = <?php echo $registrasi->id_dokter; ?>;
        var id_registrasi = "<?php echo $registrasi->registrasi_id; ?>";
        var chargeValue = <?php $total_harga = $registrasi->biaya_konsultasi_poli + $web->harga_adm;
                            echo $total_harga; ?>;
    </script>
    <?php echo $this->session->flashdata('msg_pmbyrn_2') ? $this->session->flashdata('msg_pmbyrn_2') : ''; ?>
    <?php if ($this->session->flashdata('msg_pmbyrn')) { ?>
        <script>
            alert("<?php echo $this->session->flashdata('msg_pmbyrn'); ?>")
        </script>
    <?php } ?>