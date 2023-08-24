<?php
$biaya_konsultasi = $registrasi->biaya_konsultasi_bukti ? $registrasi->biaya_konsultasi_bukti : $registrasi->biaya_konsultasi_poli;
$biaya_adm = $registrasi->biaya_adm_bukti ? $registrasi->biaya_adm_bukti : ($registrasi->biaya_adm_poli ? $registrasi->biaya_adm_poli : $web->harga_adm);
$total_harga = $biaya_konsultasi + $biaya_adm;
?>
<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>" class="text-black">Jadwal Terdaftar</a></li>
            <li class="breadcrumb-item font-bold-7" aria-current="page"><a href="" class="text-black">Pembayaran</a></li>
          </ol>
        </nav>
      </div>
      <div class="col-sm-12">
        <h3 class="page-title">Pembayaran</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="bg-tele">
          <div class="d-mobile-none">
            <div class="row font-18 text-white pl-5">
              <label for="staticEmail" class="col-sm-2 col-form-label">Nama Pasien :</label>
              <div class="col-sm-10" style="margin-left: -45px;">
                <input type="text" readonly class="form-control-plaintext font-18 text-white" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>">
              </div>
            </div>
          </div>

          <div class="d-mobile-show">
            <div class="row font-14 text-white pl-2">
              <label for="staticEmail" class="col-sm-2 col-4 col-form-label">Nama Pasien </label>
              <div class="col-sm-10 col-8">
                <input type="text" readonly class="form-control-plaintext font-14 text-white" name="fullName" placeholder="Masukkan Nama Lengkap" value=": <?php echo $user->name ?>">
              </div>
            </div>
          </div>

          <div style="background: #FFFFFF;border: 1px solid #59A799; height: auto;">
            <div class="profile-bayar p-4">
              <div class="profile-img-bayar">
                <div class="profile-img">
                  <img class="avatar" src="<?php echo $registrasi->foto_dokter ? base_url('assets/images/users/' . $registrasi->foto_dokter) : base_url('assets/telemedicine/img/default.png'); ?>" alt="">
                </div>
              </div>
              <div class="profile-basic d-mobile-none">
                <div class="row">
                  <div class="col-md-4">
                    <div class="">
                      <p class="font-18">Dokter</p>
                      <p class="font-24" style="line-height: 30px !important;"><?php echo $registrasi->nama_dokter; ?></p>
                      <p class="font-18">Poli : <?php echo $registrasi->poli; ?></p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="">
                      <p class="font-18 text-abu">Tanggal Konsultasi</p>
                      <span class="font-18"><?php echo $tanggal_konsultasi; ?></span>
                      <p class="font-18"><?php echo $waktu_konsultasi ? $waktu_konsultasi . ' - ' . $waktu_konsultasi_berakhir . ' WIB' : ''; ?></p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="">
                      <p class="font-18 text-abu">No Registrasi</p>
                      <p class="font-18"><?php echo $registrasi->registrasi_id ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="profile-basic d-mobile-show">
                <div class="row">
                  <div class="col-md-4">
                    <div class="">
                      <p class="font-16">Dokter</p>
                      <p class="font-22"><?php echo $registrasi->nama_dokter; ?></p>
                      <p class="font-16">Poli : <?php echo $registrasi->poli; ?></p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="">
                      <p class="font-16 text-abu">Tanggal Konsultasi</p>
                      <span class="font-16"><?php echo $tanggal_konsultasi; ?></span>
                      <p class="font-16"><?php echo $waktu_konsultasi ? $waktu_konsultasi . ' - ' . $waktu_konsultasi_berakhir . ' WIB' : ''; ?></p>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="">
                      <p class="font-16 text-abu">No Registrasi</p>
                      <p class="font-16"><?php echo $registrasi->registrasi_id ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-5">
        <div class="bg-tele" style="background: #FFFFFF;border: 1px solid #59A799;">
          <div class="d-mobile-none_">
            <div class="text-center" style=" border-bottom: 0.5px solid #59A799; border-top: 1px solid #59A799">
              <div class="row p-2 pt-3">
                <div class="col-md-8 text-right text-abu">Biaya Konsultasi</div>
                <div class="col-md-3 text-right"><?php echo 'Rp. ' . number_format($biaya_konsultasi, 2, ',', '.'); ?></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 0.5px solid #59A799;">
              <div class="row p-2 pt-3">
                <div class="col-md-8 text-right text-abu">Biaya Administrasi</div>
                <div class="col-md-3 text-right"><?php echo 'Rp. ' . number_format($biaya_adm, 2, ',', '.'); ?></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 2px solid #59A799;">
              <div class="row p-2 pt-3">
                <div class="col-md-8 text-right text-abu">Total Biaya</div>
                <div class="col-md-3 text-right font-22"><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></div>
              </div>
            </div>
          </div>
          <div class="pt-5">
            <div class="col-md-12 mx-auto">
              <div class="form-group row">
                <div for="metode-pembayaran" class="col-md-3 mt-2 <?php echo !$bukti_pembayaran && $registrasi->id_status_pembayaran == 0 ? 'text-abu' : 'text-dark'; ?>">Metode Pembayaran: </div>
                <div class="col-md-6">
                  <?php if ($registrasi->id_status_pembayaran == 0 && !$bukti_pembayaran) { ?>
                    <select class="form-control form-select-bayar" name="metode_pembayaran" id="metode-pembayaran">
                      <option value="0" selected>Pilih Metode</option>
                      <!-- <option value="1">Transfer Bank (Virtual Account)</option> -->
                      <option value="2">Upload Manual</option>
                      <!-- <option value="3">Dompet Digital</option> -->
                      <option value="4">Owlexa</option>
                      <!-- <option value="5">Credit Card / Debit Card</option> -->
                    </select>
                  <?php } else { ?>
                    <p class="mt-2"><?php echo $bukti_pembayaran->metode_pembayaran == 1 ? 'Transfer' : ($bukti_pembayaran->metode_pembayaran == 2 ? 'Owlexa' : ($bukti_pembayaran->metode_pembayaran == 3 ? 'Virtual Account' : ($bukti_pembayaran->metode_pembayaran == 4 ? 'Dompet Digital' : 'Credit Card / Debit Card'))); ?></p>
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="row pl-5">
              <?php if ($registrasi->id_status_pembayaran != 0 || ($registrasi->id_status_pembayaran == 0 && $bukti_pembayaran)) { ?>
                <div class="col-md-11">
                  <div class="form-group row">
                    <label class="col-md-3 col-4 mt-2 text-dark">Status </label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp&nbsp</p>
                        <p class="mt-2"><?php echo $registrasi->id_status_pembayaran == 1 ? 'Lunas' : ($registrasi->id_status_pembayaran == 0 ? 'Belum Bayar' : 'Sedang Diproses'); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if ($bukti_pembayaran) { ?>
                  <?php if ($bukti_pembayaran->metode_pembayaran == 1) { ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                        <label class="col-md-3 col-4 mt-2 text-dark"></label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu mt-2">:&nbsp&nbsp</p>
                            <p class="mt-2"><img src="<?php echo base_url($bukti_pembayaran->manual_payment_logo); ?>" class="img-permata" width="100px" title="<?php echo $bukti_pembayaran->manual_payment_name ?>" alt="<?php echo $bukti_pembayaran->manual_payment_name ?>"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } else if ($bukti_pembayaran->metode_pembayaran == 4) { ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                        <label class="col-md-3 col-4 mt-2 text-dark">Platform: </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu mt-2">:&nbsp&nbsp</p>
                            <p class="mt-2"><img src="<?php echo base_url($bukti_pembayaran->payment_logo); ?>" class="img-platform" width="100px" title="<?php echo $bukti_pembayaran->payment_name ?>" alt="<?php echo $bukti_pembayaran->payment_name ?>"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } else if ($bukti_pembayaran->metode_pembayaran == 3) { ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                        <label class="col-md-3 col-4 mt-2 text-dark"> </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu mt-2">:&nbsp&nbsp</p>
                            <p class="mt-2"><img src="<?php echo base_url($bukti_pembayaran->payment_logo); ?>" class="img-permata" width="100px" title="<?php echo $bukti_pembayaran->payment_name ?>" alt="<?php echo $bukti_pembayaran->payment_name ?>"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if ($bukti_pembayaran->id_payment == 4 || $bukti_pembayaran->id_payment == 5 || $bukti_pembayaran->id_payment == 6) { ?>
                    <?php if ($bukti_pembayaran->status == 0) { ?>
                      <div class="col-md-11">
                        <div class="form-group row">
                          <label class="col-md-3 col-4 mt-2 text-dark">Link Pembayaran: </label>
                          <div class="col-md-7 col-8">
                            <div class="row">
                              <p class="text-abu mt-2">:&nbsp&nbsp</p>
                              <p class="mt-2"><a target="_blank" href="<?php echo $bukti_pembayaran->va_number ?>" class="btn btn-sm bg-tele text-white">LINK PEMBAYARAN</a></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  <?php } ?>
                  <?php if ($bukti_pembayaran->metode_pembayaran == 1 || $bukti_pembayaran->metode_pembayaran == 2 || $bukti_pembayaran->metode_pembayaran == 3) { ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                        <label class="col-md-3 col-4 mt-2 text-dark">Bukti Pembayaran / Claim Number / VA Number</label>
                        <div class="col-md-7 col-4">
                          <div class="row">
                            <p class="text-abu mt-2">:&nbsp&nbsp</p>
                            <p class="mt-2"><?php echo $bukti_pembayaran->metode_pembayaran == 1 ? '<img src="' . base_url('assets/images/bukti_pembayaran/' . $bukti_pembayaran->photo) . '" width="100px">' : ($bukti_pembayaran->metode_pembayaran == 2 ? $bukti_pembayaran->claim_number : $bukti_pembayaran->va_number); ?></p>
                          </div>

                        </div>
                      </div>
                    </div>
                  <?php } ?>
                <?php } ?>
            </div>
          <?php } ?>
          </div>

          <?php
          if (!$bukti_pembayaran && $registrasi->id_status_pembayaran == 0) {
          ?>
            <form id="form-va" method="POST" action="<?php echo base_url('pasien/Pembayaran/bayar_va') ?>">
              <div class="">
                <div class="col-md-11" id="transfer_va">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 mt-2 text-abu"></label>
                    <div class="col-md-7">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp</p>
                        <div class="pl-3 mt-2">
                          <?php foreach ($list_bank_va as $bank_va) { ?>
                            <?php if ($bank_va->payment == "OWLEXA HEALTHCARE") { ?>
                              <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="bank_id" id="bank_<?php echo $bank_va->payment_id ?>" value="<?php echo $bank_va->payment_id ?>">
                                <label class="form-check-label font-bank" for="bank_<?php echo $bank_va->payment_id ?>" style="margin-top: -20px">
                                  <img src="<?php echo base_url($bank_va->logo); ?>" class="img-permata"> <?php echo $bank_va->payment ?>
                                </label>
                              </div>
                            <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="alamat_provinsi">
                <input type="hidden" name="alamat_kota">
                <input type="hidden" name="alamat_kecamatan">
                <input type="hidden" name="alamat_kelurahan">
                <input type="hidden" name="kode_pos">
                <input type="hidden" name="alamat_detail">
                <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id ?>">
            </form>
            <div class="col-md-12 mx-auto" id="transfer_manual">
              <form action="" method="POST" id="form-transfer-manual">
                <div class="form-group row">
                  <div class="col-md-3">
                    <p class="text-abu">Pengambilan Obat</p>
                  </div>
                  <div class="col-md-6">
                    <select name="dikirim" required id="dikirim" class="form-control form-select-bayar">
                      <option value="">-Pilih-</option>
                      <option value="2">Diambil sendiri</option>
                      <option value="1">Dikirim</option>
                    </select>
                  </div>

                </div>
                <div class="row">
                  <label for="metode-pembayaran" class="col-md-3 mt-2 text-abu"></label>
                  <div class="col-md-7">
                    <div class="row">
                      <p class="text-abu mt-2">&nbsp</p>
                      <div class="pl-3 mt-2">
                        <?php foreach ($list_manual_payment as $manual_payment) { ?>
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="bank_id_2" id="bank_<?php echo $manual_payment->payment_id ?>_2" value="<?php echo $manual_payment->payment_id ?>">
                            <label class="form-check-label font-bank" for="bank_<?php echo $manual_payment->payment_id ?>_2" style="margin-top: -20px">
                              <img src="<?php echo base_url($manual_payment->logo); ?>" class="img-permata"> <?php echo $manual_payment->payment ?>
                            </label>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <input type="hidden" name="alamat_provinsi">
            <input type="hidden" name="alamat_kota">
            <input type="hidden" name="alamat_kecamatan">
            <input type="hidden" name="alamat_kelurahan">
            <input type="hidden" name="kode_pos">
            <input type="hidden" name="alamat_detail">
            </form>
        </div>
        <div class="col-md-11" id="dompet_digital">
          <form id="form-dompet-digital" method="POST" action="<?php echo base_url('pasien/Pembayaran/bayar_va') ?>">
            <div class="form-group row">
              <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">Pilih Platform</label>
              <div class="col-md-7 col-6">
                <div class="row">
                  <p class="text-abu mt-2">:&nbsp</p>
                  <div class="pl-3">
                    <?php foreach ($list_e_wallet as $e_wallet) { ?>
                      <div class="form-check mt-2 mb-4">
                        <input class="form-check-input" type="radio" name="platform" value="<?php echo $e_wallet->payment_id ?>" id="platform-<?php echo $e_wallet->payment_id ?>">
                        <label class="form-check-label font-bank" style="margin-top: -20px" for="platform-<?php echo $e_wallet->payment_id ?>">
                          <img src="<?php echo base_url($e_wallet->logo); ?>" class="img-platform" width="100px">
                        </label>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row no-hp">
              <label for="no-hp" class="col-md-3 col-4 mt-2 text-abu">
                No. HP
              </label>
              <div class="col-md-7 pr-3 ml-0 col-8">
                <div class="row">
                  <span class="text-abu mt-2">:&nbsp </span>
                  <input type="number" id="no-hp" class="form-control col-10" name="no_hp" value="<?php echo $user->telp ?>" required>
                </div>
              </div>
            </div>
            <input type="hidden" name="alamat_provinsi">
            <input type="hidden" name="alamat_kota">
            <input type="hidden" name="alamat_kecamatan">
            <input type="hidden" name="alamat_kelurahan">
            <input type="hidden" name="kode_pos">
            <input type="hidden" name="alamat_detail">
            <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id ?>">
          </form>
        </div>
        <div class="col-md-11">
          <form id="form-owlexa" method="POST" action="<?php echo base_url('pasien/Pembayaran/bayar_owlexa'); ?>">
            <div class="">
              <div class="row">
                <div class="metode-owlexa col-md-11">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nama Lengkap </label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <p class="text-abu mt-2 pl-3">:&nbsp </p>
                        <input type="text" class="form-control col-11" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="metode-owlexa col-md-11">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nomor Kartu </label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <p class="text-abu mt-2 pl-3">:&nbsp </p>
                        <input type="number" class="form-control col-11" name="cardNumber" placeholder="Masukkan Nomor Kartu">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="metode-owlexa col-md-11">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Tanggal Lahir </label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <p class="text-abu mt-2 pl-3">:&nbsp </p>
                        <input type="date" class="form-control col-11" name="birthDate" placeholder="Masukkan Tanggal Lahir" value="<?php echo $user->lahir_tanggal; ?>" readonly disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="metode-owlexa col-md-11">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">OTP </label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <p class="text-abu mt-2 pl-3">:&nbsp </p>
                        <input type="number" class="form-control col-11" name="otp" placeholder="Masukkan OTP" aria-describedby="send_otp">
                        <p class="col-md-6 ml-3"><a href="#" id="btnSendOtp" class="form-text font-14"> <i class="fa fa-sign-in"> Send OTP</i> </a></p>
                      </div>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="alamat_provinsi">
                <input type="hidden" name="alamat_kota">
                <input type="hidden" name="alamat_kecamatan">
                <input type="hidden" name="alamat_kelurahan">
                <input type="hidden" name="kode_pos">
                <input type="hidden" name="alamat_detail">
                <input type="hidden" name="id_dokter" value="<?php echo $registrasi->id_dokter; ?>">
                <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id; ?>">
                <input type="hidden" name="chargeValue" value="<?php echo $total_harga; ?>">
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-11" id="cc_debit" style="display: none;">
          <form action="<?php echo base_url('pasien/Pembayaran/bayar_va') ?>" id="form-cc-debit" method="POST">
            <input type="hidden" name="alamat_provinsi">
            <input type="hidden" name="alamat_kota">
            <input type="hidden" name="alamat_kecamatan">
            <input type="hidden" name="alamat_kelurahan">
            <input type="hidden" name="kode_pos">
            <input type="hidden" name="alamat_detail">
            <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id ?>">
          </form>
        </div>
        <div class="col-md-12 mx-auto" id="alamat-pengiriman-obat">
          <div class="form-group row">
            <label for="alamat" class="col-md-3 text-abu" id="label-select-alamat">
              Alamat Pengiriman Obat:
            </label>
            <div class="col-md-6">
              <div class="" id="select-alamat">
                <div class="col-md-12">
                  <div class="form-group form-focus">
                    <label class="focus-label">Provinsi</label>
                    <select class="form-control floating form-select-bayar" name="alamat_provinsi" id="provinsi">
                      <?php if ($user->id_provinsi) { ?>
                        <option value="<?php echo $user->id_provinsi ?>"><?php echo $user->nama_provinsi ?></option>
                      <?php } else { ?>
                        <option>PILIH PROVINSI</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-focus">
                    <label class="focus-label">Kabupaten/Kota</label>
                    <select class="form-control floating form-select-bayar" name="alamat_kota" id="kotkab">
                      <?php if ($user->id_kota) { ?>
                        <option value="<?php echo $user->id_kota ?>"><?php echo $user->nama_kota ?></option>
                      <?php } else { ?>
                        <option>Pilih Kab/Kota</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-focus">
                    <label class="focus-label">Kecamatan</label>
                    <select class="form-control floating form-select-bayar" name="alamat_kecamatan" id="kecamatan">
                      <?php if ($user->id_kecamatan) { ?>
                        <option value="<?php echo $user->id_kecamatan ?>"><?php echo $user->nama_kecamatan ?></option>
                      <?php } else { ?>
                        <option>Pilih Kecamatan</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-focus">
                    <label class="focus-label">Kelurahan</label>
                    <select class="form-control floating form-select-bayar" name="alamat_kelurahan" id="kelurahan">
                      <?php if ($user->id_kelurahan) { ?>
                        <option value="<?php echo $user->id_kelurahan ?>"><?php echo $user->nama_kelurahan ?></option>
                      <?php } else { ?>
                        <option>Pilih Kelurahan</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-focus">
                    <label class="focus-label">Kode Pos</label>
                    <input type="text" class="form-control floating form-select-bayar" name="kode_pos" value="<?php echo ucwords($user->kode_pos) ?>" placeholder="Masukan Kode Pos">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-focus">
                    <label class="focus-label">Detail Alamat</label>
                    <input type="text" class="form-control floating form-select-bayar" name="alamat_detail" value="<?php echo ucwords($user->alamat_jalan) ?>" placeholder="Masukkan Detail Alamat">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 my-5">
          <div class="text-right">
            <a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>" class="btn btn-batal-sm">Kembali</a>
            <!-- <button class="ml-3 btn btn-simpan-sm" type="button" <?php echo $registrasi->id_status_pembayaran == 0 ? 'id="btnKirim"' : '' ?>><?php echo $registrasi->id_status_pembayaran == 0 ? 'Bayar' : ($registrasi->id_status_pembayaran == 1 ? 'Lunas' : 'Diproses') ?></button> -->
            <?php if ($registrasi->id_status_pembayaran == 0) { ?>
              <a href="#" class="btn btn-simpan-sm" id="btnBayar" type="button">Bayar</a>
            <?php } ?>
          </div>
        </div>
        <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id ?>">
        </form>
      </div>

    </div>
  <?php } ?>



  </div>
</div>
</div>

</div>
</div>
</div>
</div>

<div class="modal fade" id="tac_modal_owlexa" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 800px;">
    <div class="modal-content" style="height: auto; width: auto;">
      <div class="modal-header">
        <p class="modal-title font-20" id="exampleModalScrollableTitle">SYARAT DAN KETENTUAN PEMBAYARAN OWLEXA</p>
      </div>
      <div class="modal-body">
        <div class="font-16 text-justify" style="overflow-y: scroll; max-height: 300px; padding: 5px;" id="tac_body_owlexa">

        </div>
        <hr>
        <input type="checkbox" value="" id="tac_checkbox_owlexa" disabled> <label for="tac_checkbox_owlexa"><b class="ml-3">Saya menyetujui syarat dan ketentuan</b></label>
      </div>
      <div class="modal-footer">
        <div style="float: right!important;">
          <button type="button" class="btn btn-simpan-sm" id="simpan_tac_owlexa" disabled>Simpan</button>
          <button type="button" class="btn btn-batal-sm mr-5" id="batal_tac_owlexa" data-dismiss="#tac_modal_owlexa">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
  var alamat_anda = "<?php echo $user->nama_provinsi && $user->nama_kota && $user->nama_kelurahan && $user->nama_kecamatan && $user->alamat_jalan && $user->kode_pos ? 'Jalan ' . ucwords(strtolower($user->alamat_jalan)) . ', Kel ' . ucwords(strtolower($user->nama_kelurahan)) . ', Kec ' . ucwords(strtolower($user->nama_kecamatan)) . ', Kab/Kota ' . ucwords(strtolower($user->nama_kota)) . ', Kode Pos ' . $user->kode_pos . ', Provinsi ' . ucwords(strtolower($user->nama_provinsi)) : 'Jalan ' . ucwords(strtolower($user->alamat_jalan)) . ', Kel ' . ucwords(strtolower($user->nama_kelurahan)) . ', Kec ' . ucwords(strtolower($user->nama_kecamatan)) . ', Kab/Kota ' . ucwords(strtolower($user->nama_kota)) . ', Kode Pos ' . $user->kode_pos . ', Provinsi ' . ucwords(strtolower($user->nama_provinsi)) . ' (Alamat Tidak Lengkap)'; ?>";
  var alamat_lain = "";
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
<style>
  .img-permata {
    width: 70px;
    margin-left: 1.5rem;
    margin-right: 1.5rem;
  }

  @media (max-width: 769px) {
    .pl-5 {
      padding-left: .5rem !important;
    }

    .img-permata {
      width: 60px;
      margin-left: .5rem;
      margin-right: .5rem;
    }
  }
</style>