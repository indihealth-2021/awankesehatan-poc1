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
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/ResepDokter') ?>"class="text-black">Resep Dokter</a></li>
                    <li class="breadcrumb-item font-bold-7" aria-current="page"><a href="<?php echo base_url('pasien/ResepDokter/pembayaran/'.$id_jadwal_konsultasi) ?>"class="text-black">Pembayaran</a></li>
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
                <span class="font-bold-5"><?php echo 'Rp. ' . number_format($total_harga+$resep->biaya_pengiriman, 2, ',', '.'); ?></span>
              </div>
            </div>
          </div>
          <div class="d-mobile-show font-14 py-3" style="border-bottom: 1px solid #000000;">
            <div class="row">
              <div class="col-md-6 col-6">
                <span class="text-abu">Total Biaya Pembayaran</span>
              </div>
              <div class="col-md-6 col-6 text-right">
                <span class="font-bold-5"><?php echo 'Rp. ' . number_format($total_harga+$resep->biaya_pengiriman, 2, ',', '.'); ?></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-9 col-12 d-mobile-none_">
          <div id="mandiri">
            <div class="py-4 font-18">
              <img src="<?php echo base_url($manual_payment->logo); ?>" width="60" class="mr-4">Bank <?php echo $manual_payment->payment ?> (Dicek Manual)
            </div>
            <p class="mb-5">1 Gunakan ATM, iBanking, Mbanking atau SMS Banking untuk setor tunai ke Rekening berikut ini</p>
            <div class="font-18">
              <div class="ml-3 card py-2 px-4">
                <div class="font-18 mb-3">
                  <img src="<?php echo base_url($manual_payment->logo); ?>" width="60" class="mr-4">Bank <?php echo $manual_payment->payment ?>
                </div>
                <p class="mb-4">No. Rekening:</p>
                <div width="180">
                  <div class="d-inline-flex">
                    <input type="text" readonly class="form-control-plaintext font-24 font-rek" value="8806 081 3161 0746 4" id="salin">
                    <span onclick="myFunction()" class="font-rek font-18 pt-3 pointer">Salin</span>
                  </div>
                </div>
                

                <p class="pt-4 mb-4">Atas Nama : PT Sejahtera WAW</p>
              </div>
              <p class="mt-5">2 Silahkan upload bukti bayar</p>
              <p>3 Demi Keamanan dan Kenyamanan, jangan meyebarkan bukti pembayaran kepada siapapun</p>
              
              <div class="mt-5">
                <form id="form_transfer" method="POST" action="<?php echo base_url('pasien/ResepDokter/bayar/'.$id_jadwal_konsultasi) ?>" enctype="multipart/form-data" >
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-4 col-4 mt-2 text-abu">
                      Upload Bukti Pembayaran
                    </label>
                    <div class="col-md-6 col-6">
                      <div class="row" id="form_pembayaran">
                        <p class="text-abu mt-2">:&nbsp </p>
                            <input type="hidden" name="bank_id" value="<?php echo $manual_payment->payment_id ?>">
                            <div class="custom-file col-10">
                                <input type="file" name="bukti_pembayaran" class="custom-file-input"  id="file_upload" size="10024" accept=".gif,.jpg,.jpeg,.jfif,.png" required>
                                <label class="custom-file-label" for="customFile" id="filename">
                                </label>
                            </div>
                            <span class="text-abu font-12 ml-2">File berupa JPG, PNG atau PDF dengan ukuran maksimal 10mb</span>
                        </div>
                      </div>
                  </div>
                  
                  <div class="text-right">
                    <button class="ml-3 btn btn-oke-sm text" type="submit" >Oke</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-md-9 col-12 d-mobile-show">
          <div id="mandiri">
            <div class="py-4 font-14">
              <img src="<?php echo base_url('assets/dashboard/img/pngicon/'.$manual_payment->logo); ?>" width="50" class="mr-4">Bank <?php echo $manual_payment->payment ?> (Dicek Manual)
            </div>
            <p class="mb-5">1 Gunakan ATM, iBanking, Mbanking atau SMS Banking untuk setor tunai ke Rekening berikut ini</p>
            <div class="font-14">
              <div class="ml-3 card py-2 px-4">
                <div class="font-14 mb-3">
                  <img src="<?php echo base_url('assets/dashboard/img/pngicon/'.$manual_payment->logo); ?>" width="50" class="mr-4">Bank <?php echo $manual_payment->payment ?>
                </div>
                <p class="mb-4">No. Rekening:</p>
                <div width="180">
                  <div class="d-inline-flex">
                    <input type="text" readonly class="form-control-plaintext font-18 font-rek" value="8806 081 3161 0746 4" id="salin">
                    <span onclick="myFunction()" class="font-rek font-14 pt-3 pointer">Salin</span>
                  </div>
                </div>
                

                <p class="pt-4 mb-4">Atas Nama : PT Sejahtera WAW</p>
              </div>
              <p class="mt-5">2 Silahkan upload bukti bayar</p>
              <p>3 Demi Keamanan dan Kenyamanan, jangan meyebarkan bukti pembayaran kepada siapapun</p>
              
              <div class="mt-5">
                <form id="" method="POST" action="<?php echo base_url('pasien/ResepDokter/bayar/'.$id_jadwal_konsultasi) ?>" enctype="multipart/form-data" >
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-4 col-12 mt-2 text-abu">
                      Upload Bukti Pembayaran :
                    </label>
                    <div class="col-md-12 ml-3">
                      <div class="row" id="form_pembayaran">
                             <input type="hidden" name="bank_id" value="<?php echo $data_bank['id_bank'] ?>">
                            <div class="custom-file col-11">
                                <input type="file" name="bukti_pembayaran" class="custom-file-input"  id="file_upload" size="10024" accept=".gif,.jpg,.jpeg,.jfif,.png" required>
                                <label class="custom-file-label" for="customFile" id="filename">
                                </label>
                            </div>
                            <span class="text-abu font-12 ml-2">File berupa JPG, PNG atau PDF dengan ukuran maksimal 10mb</span>
                        </div>
                      </div>
                  </div>
                  
                  <div class="text-right">
                    <button class="ml-3 mt-3 btn btn-oke-sm text" type="submit" >Oke</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
  
  <script>
    var alamat_anda = "<?php echo $user->nama_provinsi && $user->nama_kota && $user->nama_kelurahan && $user->nama_kecamatan && $user->alamat_jalan && $user->kode_pos ? 'Jalan '.ucwords(strtolower($user->alamat_jalan)).', Kel '.ucwords(strtolower($user->nama_kelurahan)).', Kec '.ucwords(strtolower($user->nama_kecamatan)).', Kab/Kota '.ucwords(strtolower($user->nama_kota)).', Kode Pos '.$user->kode_pos.', Provinsi '.ucwords(strtolower($user->nama_provinsi)) : 'Jalan '.ucwords(strtolower($user->alamat_jalan)).', Kel '.ucwords(strtolower($user->nama_kelurahan)).', Kec '.ucwords(strtolower($user->nama_kecamatan)).', Kab/Kota '.ucwords(strtolower($user->nama_kota)).', Kode Pos '.$user->kode_pos.', Provinsi '.ucwords(strtolower($user->nama_provinsi)).' (Alamat Tidak Lengkap)'; ?>";
    var alamat_lain = "";
    function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("salin");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    // alert("Salin: " + copyText.value);
    swal("Sukses!", "No. Rekening berhasil disalin.", "success");
  }
  </script>

<?php echo $this->session->flashdata('msg_pmbyrn_2') ? $this->session->flashdata('msg_pmbyrn_2') : ''; ?>
<?php if ($this->session->flashdata('msg_pmbyrn')) { ?>
    <script>
        alert("<?php echo $this->session->flashdata('msg_pmbyrn'); ?>")
    </script>
<?php } ?>