<?php
$list_harga_obat = explode(',', $resep->harga_obat);
$list_harga_obat_per_n_unit = explode(',', $resep->harga_obat_per_n_unit);
$list_jumlah_obat = explode(',', $resep->jumlah_obat);
$jml_data = count($list_harga_obat);
$list_total_harga = [];
$total_harga = 0;
for ($i = 0; $i < $jml_data; $i++) {
  $list_total_harga[$i] = ($list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i]) * $list_harga_obat[$i];
}

foreach ($list_total_harga as $tot_harga) {
  $total_harga += $tot_harga;
}
?>
<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/ResepDokter') ?>" class="text-black">Resep Obat</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Pembayaran Obat</a></li>
          </ol>
        </nav>
      </div>
      <div class="col-sm-12 col-12">
        <h3 class="page-title">Pembayaran Obat</h3>
      </div>
    </div>
    <?php
    //if ($registrasi->id_status_pembayaran == 0) {
    ?>
    <div class="row">
      <div class="col-md-12">
        <!-- <div class="" style="background: #01A9AC;">
          <div class="row font-18 text-white pl-5">
            <label for="staticEmail" class="col-sm-2 col-6 col-form-label">Nama Pasien :</label>
            <div class="col-sm-10 col-6" style="margin-left: -45px;">
              <input type="text" readonly class="form-control-plaintext font-18 text-white" name="fullName" value="<?php echo $user->name ?>">
            </div>
          </div>
        </div> -->
        <div style="background: #FFF;border: 1px solid #DEDEDE; height: auto;" class="shadow-sm mb-3 rounded">
          <div class="profile-bayar p-4">
            <div class="profile-img-bayar">
              <div class="profile-img mx-auto">
                <img class="avatar" src="<?php echo $resep->foto_dokter ? base_url('assets/images/users/' . $resep->foto_dokter) : base_url('assets/telemedicine/img/default.png'); ?>" alt="">
              </div>
            </div>
            <div class="profile-basic">
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="">
                    <p class="font-15">Dokter</p>
                    <p class="font-24" style="line-height: 30px !important;"><?php echo ucwords($resep->nama_dokter) ?></p>
                    <p class="font-15">Poli : <?php echo ucwords($resep->poli_dokter) ?></p>
                    <p class="font-15 pt-3 text-abu">Resep Obat: </p>
                    <p class="font-15 pl-3">
                      <?php echo $resep->detail_obat ?>
                    </p>
                  </div>
                </div>
                <div class="col-md-3 col-12">
                  <div class="">
                    <p class="font-15 text-abu">Tanggal Konsultasi</p>
                    <?php
                    $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi)) : '-';
                    ?>
                    <span class="font-15"><?php echo $tanggal_konsul != '-' ? $tanggal_konsul->format('D, d/m/Y') : '-' ?></span>
                    <p class="font-15"><?php echo $tanggal_konsul != '-' ? $tanggal_konsul->format('H:i') . ' WIB' : '-'; ?></p>
                  </div>
                </div>
                <div class="col-md-5 col-12">
                  <div class="">
                    <p class="font-15 text-abu">No Registrasi</p>
                    <p class="font-15"><?php echo $resep->id_registrasi ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="background: #FFF;border: 1px solid #DEDEDE" class="shadow-sm rounded">

          <div class="d-mobile-none_">
            <?php if($resep->dikirim)  { ?>
              <div class="row p-4">
              <div class="col-md-8">
              <h4 style="color: #01A9AC;" class="font-bold font-20"><span class="fa fa-map-marker pr-2" style="color: #01A9AC"></span>Alamat Tujuan Pengiriman</h4>
              <p class="font-15 ml-3 border p-3">
                <?php echo ucwords($user->name) ?> ( <?php echo $user->telp ? $user->telp:'-' ?> )<br/>
                <?php echo $resep->alamat_pengiriman ?>
                <br/><br/>
              </p>
              <!-- <p class="font-18 ml-3 font-bold text-right" style="color: #01A9AC; margin-top: -10px;">Ubah</p> -->
              </div>
            </div>
            <?php }else { ?>
              <div class="row p-4">
              <div class="col-md-8">
              <h4 style="color: #01A9AC;" class="font-bold font-20"><span class="fa fa-shopping-bag pr-2" style="color: #01A9AC"></span>Silahkan ambil obat di apotek setelah pembayaran</h4>
              <!-- <p class="font-18 ml-3 font-bold text-right" style="color: #01A9AC; margin-top: -10px;">Ubah</p> -->
              </div>
            </div>
            <?php } ?>
            <div class="text-center" style=" border-top: 3px solid #01A9AC;border-bottom: 0.5px solid #01A9AC;">
              <div class="row p-2 py-3">
                <div class="col-md-8 text-right">Biaya Pengiriman</div>
                <div class="col-md-3 text-right"><?php echo 'Rp. ' . number_format($resep->biaya_pengiriman, 2, ',', '.'); ?></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 0.5px solid #01A9AC;">
              <div class="row p-2 py-3">
                <div class="col-md-8 text-right">Biaya Obat</div>
                <div class="col-md-3 text-right"><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></div>
              </div>
            </div>
            <div class="text-center">
              <div class="row p-2 py-3">
                <div class="col-md-8 text-right">Total Harga</div>
                <div class="col-md-3 text-right font-24 font-bold"><?php echo 'Rp. ' . number_format($total_harga += $resep->biaya_pengiriman, 2, ',', '.'); ?></div>
              </div>
            </div>
          </div>
        </div>
        <div style="background: #FFF;border: 1px solid #DEDEDE" class="mt-3 shadow-sm rounded">

          <div class="d-mobile-none_ pt-4 pl-3">
            <div class="col-md-12 ml-3">
              <div class="row">

                <div class="col-md-11">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-5 mt-2 text-abu"><?php echo $bukti_pembayaran_obat ? 'Metode Pembayaran' : 'Pilih Metode Pembayaran' ?> </label>
                    <div class="col-md-7 col-7">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp </p>
                        <?php if (!$bukti_pembayaran_obat || $bukti_pembayaran_obat->status == 2) { ?>
                          <select class="form-control form-select-bayar  col-10" name="metode_pembayaran" id="metode-pembayaran">
                            <option value="0" selected>Pilih Metode</option>
                            <option value="1">Transfer Bank (Virtual Account)</option>
                            <option value="2">Transfer Bank (Upload Manual)</option>
                            <option value="3">Dompet Digital</option>
                            <option value="4">Owlexa</option>
                            <option value="5">Credit Card / Debit Card</option>
                          </select>
                        <?php } else { ?>
                          <p class="mt-2"><?php echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? 'Transfer' : ($bukti_pembayaran_obat->metode_pembayaran == 2 ? 'Owlexa' : ($bukti_pembayaran_obat->metode_pembayaran == 3 ? "Virtual Account" : ($bukti_pembayaran_obat->metode_pembayaran == 4 ? "Dompet Digital" : "Credit Card / Debit Card"))); ?></p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                if ($bukti_pembayaran_obat && $bukti_pembayaran_obat->status != 2) {
                ?>
                  <div class="col-md-11">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Status</label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu">:&nbsp</p> <?php echo $bukti_pembayaran_obat->metode_pembayaran == 1 || $bukti_pembayaran_obat->metode_pembayaran == 2 || $bukti_pembayaran_obat->metode_pembayaran == 3 ? ($bukti_pembayaran_obat->status == 0 ? 'Sedang Diproses' : 'Lunas') : ($bukti_pembayaran_obat->status == 0 ? 'Belum Bayar' : 'Lunas') ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php if($bukti_pembayaran_obat->metode_pembayaran == 1){ ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                      <label class="col-md-3 col-4 mt-2 text-dark">BANK </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                          <p class="text-abu mt-2">:&nbsp&nbsp</p>
                          <p class="mt-2"><img src="<?php echo base_url($bukti_pembayaran_obat->manual_payment_logo); ?>" class="img-permata" width="100px" title="<?php echo $bukti_pembayaran_obat->manual_payment_name ?>" alt="<?php echo $bukti_pembayaran_obat->manual_payment_name ?>"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php }else if($bukti_pembayaran_obat->metode_pembayaran == 4){ ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                      <label class="col-md-3 col-4 mt-2 text-dark">Platform: </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                          <p class="text-abu mt-2">:&nbsp&nbsp</p>
                          <p class="mt-2"><img src="<?php echo base_url($bukti_pembayaran_obat->payment_logo); ?>" class="img-platform" width="100px" title="<?php echo $bukti_pembayaran_obat->payment_name ?>" alt="<?php echo $bukti_pembayaran_obat->payment_name ?>"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php }else if($bukti_pembayaran_obat->metode_pembayaran == 3){ ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                      <label class="col-md-3 col-4 mt-2 text-dark">BANK: </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                          <p class="text-abu mt-2">:&nbsp&nbsp</p>
                          <p class="mt-2"><img src="<?php echo base_url($bukti_pembayaran_obat->payment_logo); ?>" class="img-permata" width="100px" title="<?php echo $bukti_pembayaran_obat->payment_name ?>" alt="<?php echo $bukti_pembayaran_obat->payment_name ?>"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if($bukti_pembayaran_obat->status == 0 && ($bukti_pembayaran_obat->id_payment == 4 || $bukti_pembayaran_obat->id_payment == 5 || $bukti_pembayaran_obat->id_payment == 6)){ ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                        <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Link Pembayaran</label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu">:&nbsp</p> <a target="_blank" href="<?php echo $bukti_pembayaran_obat->va_number ?>" class="btn btn-sm bg-tele text-white">LINK PEMBAYARAN</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if($bukti_pembayaran_obat->metode_pembayaran == 1 || $bukti_pembayaran_obat->metode_pembayaran == 2 || $bukti_pembayaran_obat->metode_pembayaran == 3){ ?>
                    <div class="col-md-11">
                      <div class="form-group row">
                        <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Bukti Pembayaran / Claim Number / VA Num </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu">:&nbsp</p> <?php echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? '<img src="' . base_url('assets/images/bukti_pembayaran_obat/' . $bukti_pembayaran_obat->foto) . '" width="300px">' : ($bukti_pembayaran_obat->metode_pembayaran == 2 ? $bukti_pembayaran_obat->claim_number : $bukti_pembayaran_obat->va_number); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
          </div>

          <!-- <div class="d-none">
            <div class="pl-2 pt-5">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Resep </label>
                    <div class="col-md-8 col-9">
                      <div class="row">
                        <span class="text-abu">:</Span><span class="" style="margin-top: -35px">&nbsp <?php echo $resep->detail_obat ?></span>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Alamat Pengiriman </label>
                    <div class="col-md-8 col-9">
                      <div class="row">
                        <p class="text-abu">:&nbsp</p> <?php echo $resep->alamat_pengiriman; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Pilih Metode Pembayaran </label>
                    <div class="col-md-9 col-9">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp </p>
                        <?php if (!$bukti_pembayaran_obat && $bukti_pembayaran_obat->status == 2) { ?>
                          <select class="form-control form-select-bayar  col-10" name="metode_pembayaran" id="metode-pembayaran">
                            <option value="0" selected>Pilih Metode</option>
                            <option value="1">Transfer Bank (Virtual Account)</option>
                            <option value="2">Transfer Bank (Upload Manual)</option>
                            <option value="3">Dompet Digital</option>
                            <option value="4">Owlexa</option>
                          </select>
                        <?php } else { ?>
                          <p class="mt-2"><?php echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? 'Transfer' : ($bukti_pembayaran_obat->metode_pembayaran == 3 ? 'Virtual Account' : 'Owlexa'); ?></p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->


          <?php
          if (!$bukti_pembayaran_obat || $bukti_pembayaran_obat->status == 2) {
          ?>
            <form id="form-va" method="POST" action="<?php echo base_url('pasien/ResepDokter/bayar_va/' . $id_jadwal_konsultasi) ?>">
              <div class="row pl-5">
                <div class="col-md-11" id="transfer_va">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">Pilih Bank</label>
                    <div class="col-md-7 col-6">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp</p>
                        <div class="pl-3 mt-2">
                        <?php foreach($list_bank_va as $bank_va){ ?>
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="bank_id" id="bank_<?php echo $bank_va->payment_id ?>" value="<?php echo $bank_va->payment_id ?>">
                            <label class="form-check-label font-bank" for="bank_<?php echo $bank_va->payment_id ?>" style="margin-top: -20px">
                              <img src="<?php echo base_url($bank_va->logo); ?>" class="img-permata"><?php echo $bank_va->payment ?>
                            </label>
                          </div>
                        <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
            </form>
            <div class="col-md-11" id="transfer_manual">
              <div class="form-group row">
                <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">Pilih Bank</label>
                <div class="col-md-7 col-6">
                  <div class="row">
                    <p class="text-abu mt-2">:&nbsp</p>
                    <div class="pl-3 mt-2">
                    <?php foreach($list_manual_payment as $manual_payment){ ?>
                      <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="bank_id_2" id="bank_<?php echo $manual_payment->payment_id ?>_2" value="<?php echo $manual_payment->payment_id ?>">
                        <label class="form-check-label font-bank" for="bank_<?php echo $manual_payment->payment_id ?>_2" style="margin-top: -20px">
                          <img src="<?php echo base_url($manual_payment->logo); ?>" class="img-permata">Bank <?php echo $manual_payment->payment ?>
                        </label>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-11" id="dompet_digital">
              <form id="form-dompet-digital" method="GET" action="<?php echo base_url('pasien/ResepDokter/bayar_va/'.$id_jadwal_konsultasi.'//') ?>">
              <div class="form-group row">
                <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">Pilih Platform</label>
                <div class="col-md-7 col-6">
                  <div class="row">
                    <p class="text-abu mt-2">:&nbsp</p>
                    <div class="pl-3">
                    <?php foreach($list_e_wallet as $e_wallet){ ?>
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
                    <input type="number" id="no-hp" class="form-control col-10" name="no_hp" required>
                  </div>
                </div>
              </div>
              </form>
            </div>

            <form id="form-owlexa" method="POST" action="<?php echo base_url('pasien/ResepDokter/bayar_owlexa/' . $id_jadwal_konsultasi); ?>">
              <div class="col-md-12">
                <div class="row">

                  <div class="col-sm-11 pl-3 metode-owlexa">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nama Lengkap </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu mt-2">:&nbsp </p>
                          <input type="text" class="form-control col-10" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>" disabled readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-11 pl-3 metode-owlexa">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nomor Kartu </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu mt-2">:&nbsp </p>
                          <input type="number" class="form-control col-10" name="cardNumber" placeholder="Masukkan Nomor Kartu" value="<?php //echo $old['cardNumber'] ? $cardNumber:'';
                                                                                                                                        ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-11 pl-3 metode-owlexa">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Tanggal Lahir </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu mt-2">:&nbsp </p>
                          <input type="date" class="form-control col-10" name="birthDate" placeholder="Masukkan Tanggal Lahir" value="<?php echo $user->lahir_tanggal; ?>" readonly disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-11 pl-3 metode-owlexa">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">OTP </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu mt-2">:&nbsp </p>
                          <input type="number" class="form-control col-10" name="otp" placeholder="Masukkan OTP" aria-describedby="send_otp" required>
                          <a href="#" id="btnSendOtp" class="form-text font-14">
                            <span class="ml-2 fa fa-sign-in"> Send OTP</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="chargeValue" value="<?php echo $total_harga; ?>;">

                </div>
              </div>
            </form>

            <div class="col-md-11" id="cc_debit">
              <!-- <div class="form-group row">
                <label for="card_num" class="col-md-3 col-4 text-abu">Kartu</label>
                <div class="col-md-7 col-8">
                  <div class="row">
                    <p class="text-abu mt-2">:&nbsp </p>
                    <input type="number" class="form-control col-4" name="card_num" placeholder="No. Kartu" id="card_num">
                    <span class="col-1"></span>
                    <input type="number" min=1 max=12 class="form-control col-1" name="mm" placeholder="MM">
                    <input type="number" class="form-control col-1" name="yy" placeholder="YY">
                    <span class="col-1"></span>
                    <input type="number" class="form-control col-2" name="cvc" placeholder="CVC">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="card_owner" class="col-md-3 col-4 text-abu">Pemilik Kartu</label>
                <div class="col-md-7 col-8">
                  <div class="row">
                    <p class="text-abu mt-2">:&nbsp </p>
                    <input type="text" class="form-control col-10" name="card_owner" placeholder="Nama Pemilik Kartu" id="card_owner">
                  </div>
                </div>
              </div> -->
            </div>

          <?php } ?>

        </div>
        <div class="mt-3 float-right">
          <a href="<?php echo base_url('pasien/ResepDokter') ?>" class="btn btn-batal-sm">Kembali</a>
          <!-- <button class="ml-3 btn btn-simpan-sm" type="button" <?php echo !$bukti_pembayaran_obat ? 'id="btnKirim"' : ($bukti_pembayaran_obat->status == 0 ? 'id="btnKirim"' : '') ?>><?php echo !$bukti_pembayaran_obat ? 'Bayar' : ($bukti_pembayaran_obat->status == 0 ? 'Diproses' : 'Lunas') ?></button> -->
          <?php if (!$bukti_pembayaran_obat || $bukti_pembayaran_obat->status == 2) { ?>
            <a href="#" class="ml-3 btn btn-simpan-sm" id="btnBayar" type="button">Bayar</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>




  <?php if ($this->session->flashdata('msg_pmbyrn_obat')) { ?>
    <script>
      alert("<?php echo $this->session->flashdata('msg_pmbyrn_obat'); ?>")
    </script>
  <?php } ?>


  <style>
    div span li {
      margin-left: 10px;
    }

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


  <style>
    div span li {
      margin-left: 10px;
    }

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
