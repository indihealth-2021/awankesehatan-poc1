<?php
                                $biaya_konsultasi = $registrasi->biaya_konsultasi_bukti ? $registrasi->biaya_konsultasi_bukti : $registrasi->biaya_konsultasi_poli;
                                 $biaya_adm = $registrasi->biaya_adm_bukti ? $registrasi->biaya_adm_bukti : ($registrasi->biaya_adm_poli ? $registrasi->biaya_adm_poli : $web->harga_adm);
                                 $total_harga = $biaya_konsultasi + $biaya_adm;
                              ?>
   <!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>"class="text-black">Jadwal Terdaftar</a></li>
                    <li class="breadcrumb-item font-bold-7" aria-current="page"><a href="<?php echo base_url('pasien/Pembayaran/?regid='.$registrasi->registrasi_id) ?>"class="text-black">Pembayaran</a></li>
                    <li class="breadcrumb-item font-bold-7" aria-current="page"><a href="" class="text-black">Summary</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Summary Pembayaran</h3>
          </div>
      </div>  
      <div class="row">
        <div class="col-md-6">
          <div class="d-mobile-none font-18 py-3" style="border-bottom: 1px solid #000000;">
            <div class="row">
              <div class="col-md-6">
                <span class="text-abu">Total Biaya Pembayaran</span>
              </div>
              <div class="col-md-6 text-right">
                <span class="font-bold-5"><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></span>
              </div>
            </div>
          </div>
          <div class="d-mobile-show font-14 py-3" style="border-bottom: 1px solid #000000;">
            <div class="row">
              <div class="col-md-6 col-6">
                <span class="text-abu">Total Biaya Pembayaran</span>
              </div>
              <div class="col-md-6 col-6 text-right">
                <span class="font-bold-5"><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-10 col-10 d-mobile-none_">
          <div id="mandiri">
            <div class="py-4 font-18">
              <img src="<?php echo base_url($payment->logo); ?>" width="60" class="mr-4">Bank <?php echo $payment->payment ?> (Dicek Otomatis)
            </div>
            <div class="font-18">
              <p class="mb-4">No. Rekening:</p>
              <div class="d-inline-flex">
                <input type="text" readonly class="form-control-plaintext font-24 font-rek" value="<?php echo $registrasi->va_number ?>" id="salin">
                <span onclick="myFunction()" class="font-rek font-18 pt-3 pointer">Salin</span>
              </div>
              <!-- <span class="font-24 font-rek" id="salin">8806 081 3161 0746 4 </span><span onclick="myFunction()" class="ml-5 font-rek font-18">Salin</span> -->

              <p class="pt-4 mb-4">Pembayaran akan otomatis dibatalkan pada: <b><?php echo (new DateTime($registrasi->expired_date))->format('d-m-Y H:i'); ?></b></p>
              <p>Bayar pesanan ke Virtual Account di atas sebelum membuat pesanan kembali dengan Virtual Account agar nomor tetap sama.</p>

              <p>Hanya menerima dari Bank <?php echo $payment->payment ?></p>
            </div>

            <div class="accordion mt-5" id="accordionGroup">
              <div class="">
                <a class="btn-collaps" type="button" data-toggle="collapse" data-target="#tf-atm" aria-expanded="true" aria-controls="tf-atm">
                  <div id="headingOne">
                      Petunjuk Transfer ATM <i class="fas fa-chevron-up text-right" style="margin-left: 205px;"></i>
                  </div>
                </a>
             
                <div id="tf-atm" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionGroup">
                  <div class="font-18 my-4">
                    <span>1 Pilih Transfer > Virtual Account Billing.</span><br>
                    <span>2 Masukkan nomor Virtual Account 8806 081316107464.</span><br>
                    <span>3 Pilih Rekening Debet dan piliih Lanjut.</span><br>
                    <span>4 Tagihan yang harus dibayar akan muncul pada layar konfirmasi</span><br>
                    <span>5 Periksa informasi yang tertera di layar. Pastikan Merchant adalah (Nama Produk), Total tagihan</span><br>
                    <span>&nbsp&nbsp sudah benar dan username kamu.</span><br>
                    <span>6 Masukkan Kode Otentikasi Token Anda lalu klik Proses</span>
                  </div>
                </div>

                <a class="btn-collaps" type="button" data-toggle="collapse" data-target="#tf-ibanking" aria-expanded="false" aria-controls="tf-ibanking">
                  <div class="text-left" id="headingTwo">
                      Petunjuk Transfer iBanking <i class="fas fa-chevron-up text-right" style="margin-left: 165px;"></i>
                  </div>
                </a>
                <div id="tf-ibanking" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionGroup">
                  <div class="font-18 my-4">
                    <span>1 Pilih Transfer > Virtual Account Billing.</span><br>
                    <span>2 Masukkan nomor Virtual Account 8806 081316107464.</span><br>
                    <span>3 Pilih Rekening Debet dan piliih Lanjut.</span><br>
                    <span>4 Tagihan yang harus dibayar akan muncul pada layar konfirmasi</span><br>
                    <span>5 Periksa informasi yang tertera di layar. Pastikan Merchant adalah (Nama Produk), Total tagihan</span><br>
                    <span>&nbsp&nbsp sudah benar dan username kamu.</span><br>
                    <span>6 Masukkan Kode Otentikasi Token Anda lalu klik Proses</span>
                  </div>
                </div>

                <a class="btn-collaps" type="button" data-toggle="collapse" data-target="#tf-mbanking" aria-expanded="false" aria-controls="tf-mbanking">
                  <div class="text-left" id="headingTwo">
                      Petunjuk Transfer mBanking <i class="fas fa-chevron-up text-right" style="margin-left: 152px;"></i>
                  </div>
                </a>
                <div id="tf-mbanking" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionGroup">
                  <div class="font-18 my-4">
                    <span>1 Transfer > Virtual Account Billing.</span><br>
                    <span>2 Pilih Rekening Debet > Masukkan nomor Virtual Account 8806 081316107464</span><br>
                    <span>&nbsp&nbsp pada menu Input Baru.</span><br>
                    <span>3 Tagihan yang harus dibayar akan muncul pada layar konfirmasi</span><br>
                    <span>4 Periksa informasi yang tertera di layar. Pastikan Merchant adalah Shopee,</span><br>
                    <span>&nbsp&nbsp Total tagihan sudah benar dan username kamu hilal123_nabil. Jika benar, masukkan</span><br>
                    <span>&nbsp&nbsp password transaksi dan pilih Lanjut.</span>
                  </div>
                </div>

                <a class="btn-collaps" type="button" data-toggle="collapse" data-target="#tf-sms" aria-expanded="false" aria-controls="tf-sms">
                  <div class="text-left" id="headingTwo">
                      Petunjuk Transfer SMS Banking <i class="fas fa-chevron-up text-right" style="margin-left: 125px;"></i>
                  </div>
                </a>
                <div id="tf-sms" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionGroup">
                  <div class="font-18 my-4">
                    <span>1 Kirim SMS "TRANSFER 8806 081316107464 Rp199.000" ke 3346.</span><br>
                <span>2 Balas SMS yang masuk dengan benar.</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       <!--  <div class="col-md-10 col-12 d-mobile-show">
          <div id="mandiri">
            <div class="py-4 font-16">
              <img src="<?php echo base_url('assets/dashboard/img/pngicon/'.$payment->logo); ?>" width="60" class="mr-4">Bank <?php echo $payment->payment ?> (Dicek Otomatis)
            </div>
            <div class="font-16">
              <p class="mb-4">No. Rekening:</p>
              <div class="d-inline-flex">
                <input type="text" readonly class="form-control-plaintext font-24 font-rek" value="8806 081 3161 0746 4" id="salin">
                <span onclick="myFunction()" class="font-rek font-18 pt-3 pointer">Salin</span>
              </div>

              <p class="pt-4 mb-4">Dicek dalam 10 menit setelah pembayaran berhasil</p>
              <p>Bayar pesanan ke Virtual Account di atas sebelum membuat pesanan kembali dengan Virtual Account agar nomor tetap sama.</p>
              <p>Hanya menerima dari Bank <?php echo $payment->payment ?></p>
            </div>

            <div class="accordion mt-5" id="accordionGroup">
              <div class="">
                <a class="btn-collaps" type="button" data-toggle="collapse" data-target="#tf-atm" aria-expanded="true" aria-controls="tf-atm">
                  <div id="headingOne">
                      Petunjuk Transfer ATM <i class="fas fa-chevron-up text-right" style="margin-left: 110px;"></i>
                  </div>
                </a>
             
                <div id="tf-atm" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionGroup">
                  <div class="font-16 my-4">
                    <span>1 Pilih Transfer > Virtual Account Billing.</span><br>
                    <span>2 Masukkan nomor Virtual Account 8806 081316107464.</span><br>
                    <span>3 Pilih Rekening Debet dan piliih Lanjut.</span><br>
                    <span>4 Tagihan yang harus dibayar akan muncul pada layar konfirmasi</span><br>
                    <span>5 Periksa informasi yang tertera di layar. Pastikan Merchant adalah (Nama Produk), Total tagihan</span><br>
                    <span>&nbsp&nbsp sudah benar dan username kamu.</span><br>
                    <span>6 Masukkan Kode Otentikasi Token Anda lalu klik Proses</span>
                  </div>
                </div>

                <a class="btn-collaps" type="button" data-toggle="collapse" data-target="#tf-ibanking" aria-expanded="false" aria-controls="tf-ibanking">
                  <div class="text-left" id="headingTwo">
                      Petunjuk Transfer iBanking <i class="fas fa-chevron-up text-right" style="margin-left: 75px;"></i>
                  </div>
                </a>
                <div id="tf-ibanking" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionGroup">
                  <div class="font-16 my-4">
                    <span>1 Pilih Transfer > Virtual Account Billing.</span><br>
                    <span>2 Masukkan nomor Virtual Account 8806 081316107464.</span><br>
                    <span>3 Pilih Rekening Debet dan piliih Lanjut.</span><br>
                    <span>4 Tagihan yang harus dibayar akan muncul pada layar konfirmasi</span><br>
                    <span>5 Periksa informasi yang tertera di layar. Pastikan Merchant adalah (Nama Produk), Total tagihan</span><br>
                    <span>&nbsp&nbsp sudah benar dan username kamu.</span><br>
                    <span>6 Masukkan Kode Otentikasi Token Anda lalu klik Proses</span>
                  </div>
                </div>

                <a class="btn-collaps" type="button" data-toggle="collapse" data-target="#tf-mbanking" aria-expanded="false" aria-controls="tf-mbanking">
                  <div class="text-left" id="headingTwo">
                      Petunjuk Transfer mBanking <i class="fas fa-chevron-up text-right" style="margin-left: 65px;"></i>
                  </div>
                </a>
                <div id="tf-mbanking" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionGroup">
                  <div class="font-16 my-4">
                    <span>1 Transfer > Virtual Account Billing.</span><br>
                    <span>2 Pilih Rekening Debet > Masukkan nomor Virtual Account 8806 081316107464</span><br>
                    <span>&nbsp&nbsp pada menu Input Baru.</span><br>
                    <span>3 Tagihan yang harus dibayar akan muncul pada layar konfirmasi</span><br>
                    <span>4 Periksa informasi yang tertera di layar. Pastikan Merchant adalah Shopee,</span><br>
                    <span>&nbsp&nbsp Total tagihan sudah benar dan username kamu hilal123_nabil. Jika benar, masukkan</span><br>
                    <span>&nbsp&nbsp password transaksi dan pilih Lanjut.</span>
                  </div>
                </div>

                <a class="btn-collaps" type="button" data-toggle="collapse" data-target="#tf-sms" aria-expanded="false" aria-controls="tf-sms">
                  <div class="text-left" id="headingTwo">
                      Petunjuk Transfer SMS Banking <i class="fas fa-chevron-up text-right" style="margin-left: 43px;"></i>
                  </div>
                </a>
                <div id="tf-sms" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionGroup">
                  <div class="font-16 my-4">
                    <span>1 Kirim SMS "TRANSFER 8806 081316107464 Rp199.000" ke 3346.</span><br>
                <span>2 Balas SMS yang masuk dengan benar.</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        
      </div>
      <div class=" col-md-8 text-right pt-5">
          <a href="#" class="ml-3  btn btn-oke-sm text" type="submit" >Belum Bayar</a>
        </div>
    </div>
  </div>

  <script type="text/javascript">
    function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("salin");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    swal("Sukses!", "No. Rekening berhasil disalin.", "success");
  }
  </script>

<?php if ($this->session->flashdata('msg_pmbyrn')) { ?>
  <script>
    alert("<?php echo $this->session->flashdata('msg_pmbyrn'); ?>")
  </script>
<?php } ?>