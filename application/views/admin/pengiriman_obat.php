<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/PengirimanObat') ?>" class="text-black font-bold-7">Biaya Pengiriman</a></li>
          </ol>
        </nav>
      </div>
      <div class="col-sm-12 col-12">
        <h3 class="page-title">Pengiriman Obat</h3>
      </div>
      <div class="col-sm-12 col-12">
        <h7 class="page-subtitle">Biaya Pengiriman</h7>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-12 text-right m-b-20">
        <a href="<?php echo base_url('admin/PengirimanObat/history_pengiriman_obat') ?>" class="text-tele font-14 float-right">Lihat Riwayat Pengiriman</a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="" data-toggle="tab">Poli</a></li>
            </ul> -->
        <div class="bg-tab p-3">
          <div class="tab-pane show pt-3">
            <div class="col-md-12">
              <div class="box">
                <div class="container-1">
                  <span class="icon"><i class="fa fa-search font-16 text-tele"></i></span>
                  <input type="search" id="search" style="background: #ffffff !important;" placeholder="Cari Pasien Disini" />
                </div>
              </div>
              <div class="table-responsive pt-3">
                <table class="table table-border table-hover custom-table mb-0" id="table_obat">
                  <thead class="text-tr">
                    <tr class="text-center">
                      <th class="text-left">No</th>
                      <!-- <th>Tanggal Konsultasi</th> -->
                      <th>Pasien</th>
                      <th>Dokter</th>
                      <!-- <th>Alamat Pasien</th> -->
                      <th>Resep</th>
                      <th>Harga Obat</th>
                      <th>Biaya Pengiriman</th>
                      <!-- <th>Biaya Pengiriman</th> -->
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="font-14">
                    <?php foreach ($list_resep as $idx => $resep) { ?>
                      <tr>
                        <td><?php echo $idx += 1; ?></td>
                        <!-- <td><?php $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi))->format('d-m-Y H:i:s') : '-';
                                  echo $tanggal_konsul;
                                  ?></td> -->
                        <td><?php echo $resep->nama_pasien; ?></td>
                        <td width="18%">
                          <span><b><?php echo $resep->nama_dokter; ?></b></span><br>
                          <span class="font-12"><?php echo $resep->nama_poli; ?></span>
                        </td>
                        <!-- <td><?php //echo 'Jalan '.ucwords(strtolower($resep->alamat_jalan)).', Kel '.ucwords(strtolower($resep->nama_kelurahan)).', Kec '.ucwords(strtolower($resep->nama_kecamatan)).', Kab/Kota '.ucwords(strtolower($resep->nama_kota)).', Kode Pos '.$resep->kode_pos.', Provinsi '.ucwords(strtolower($resep->nama_provinsi))
                                  ?></td> -->
                        <td><?php echo $resep->detail_obat ?></td>
                        <?php
                        $list_harga_obat = explode(',', $resep->harga_obat);
                        $list_harga_obat_per_n_unit = explode(',', $resep->harga_obat_per_n_unit);
                        $list_jumlah_obat = explode(',', $resep->jumlah_obat);
                        $jml_data = count($list_harga_obat);
                        $list_total_harga = [];
                        $total_harga = 0;
                        if ($resep->harga_kustom) {
                          $total_harga = $resep->harga_kustom;
                        } else {
                          for ($i = 0; $i < $jml_data; $i++) {
                            $list_total_harga[$i] = ($list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i]) * $list_harga_obat[$i];
                          }

                          foreach ($list_total_harga as $tot_harga) {
                            $total_harga += $tot_harga;
                          }
                        }
                        ?>
                        <td><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></td>
                        <?php $biaya_pengiriman = $resep->biaya_pengiriman ? $resep->biaya_pengiriman : 0; ?>
                        <td id="biaya-pengiriman-<?php echo $resep->id_jadwal_konsultasi; ?>"><?php echo 'Rp. ' . number_format($resep->biaya_pengiriman, 2, ',', '.'); ?></td>
                        <!-- <td>Rp. 15.000</td> -->

                        <?php $alamat_inputan = $resep->alamat_pengiriman; ?>
                        <td width="25%" class="text-center">
                          <!-- <input type="number" name="harga_ongkir" class="form-control" id="id-jadwal-konsultasi-<?php echo $resep->id_jadwal_konsultasi; ?>" placeholder="Biaya Pengiriman"> -->
                          <?php if ($resep->metode_pengambilan_obat == 1) { ?>
                          <button class="btn btn-submit-biaya btnEdit" data-id-jadwal-konsultasi="<?php echo $resep->id_jadwal_konsultasi; ?>" data-alamat="<?php echo $resep->alamat_pengiriman; ?>" data-biaya-pengiriman="<?php echo $biaya_pengiriman; ?>" data-biaya-pengiriman-rp="<?php echo 'Rp. ' . number_format($resep->biaya_pengiriman, 2, ',', '.'); ?>" data-is-alamat-lengkap="<?php echo $resep->nama_provinsi && $resep->nama_kota && $resep->nama_kelurahan && $resep->nama_kecamatan && $resep->alamat_jalan && $resep->kode_pos ? '' : ' <sup>(<font color=\'red\'>*Alamat Tidak Lengkap*</font>)</sup>'; ?>" data-is-alamat-kustom="" data-nama-pasien="<?php echo $resep->nama_pasien ?>" data-telp-pasien="<?php echo $resep->telp_pasien; ?>" data-email-pasien="<?php echo $resep->email_pasien ?>" data-tipe="edit" data-toggle="modal" data-target="#modalEditBiayaPengiriman<?php echo $resep->id_jadwal_konsultasi; ?>">Submit Biaya Pengiriman</button>
                          <?php } ?>
                          <button class="btn btn-kirim-biaya btnSubmit" data-id-jadwal-konsultasi="<?php echo $resep->id_jadwal_konsultasi; ?>" data-alamat="<?php echo $resep->alamat_pengiriman ?>" data-biaya-pengiriman="<?php echo $biaya_pengiriman; ?>" data-biaya-pengiriman-rp="<?php echo 'Rp. ' . number_format($resep->biaya_pengiriman, 2, ',', '.'); ?>" data-is-alamat-lengkap="<?php echo $resep->alamat_pengiriman ?: ' <sup>(<font color=\'red\'>*Alamat Tidak Lengkap*</font>)</sup>'; ?>" data-tipe="submit" data-harga-obat="<?php echo $total_harga; ?>" data-harga-obat-rp="<?php echo str_replace(',00', '', 'Rp. ' . number_format($total_harga, 2, ',', '.')); ?>" data-total-harga="<?php echo $total_harga + $biaya_pengiriman ?>" data-total-harga-rp="<?php echo str_replace(',00', '', 'Rp. ' . number_format($total_harga + $biaya_pengiriman, 2, ',', '.')); ?>" data-nama-pasien="<?php echo $resep->nama_pasien ?>" data-telp-pasien="<?php echo $resep->telp_pasien; ?>" data-email-pasien="<?php echo $resep->email_pasien ?>" data-toggle="modal" data-alamat-inputan="<?php echo $alamat_inputan; ?>" data-target="#modalBiayaPengiriman<?php echo $resep->id_jadwal_konsultasi; ?>">Kirim
                          </button>
                        </td>
                      </tr>

                      <div class="modal fade" id="modalEditBiayaPengiriman<?php echo $resep->id_jadwal_konsultasi; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBiayaPengirimanLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content" style="height: auto;">
                            <div class="modal-header">
                              <p class="modal-title font-14" id="modalBiayaPengirimanLabel"><b>Biaya Pengiriman</b></p>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <?= form_open('admin/PengirimanObat/submit_biaya_pengiriman/' . $resep->id_jadwal_konsultasi); ?>

                            <div class="modal-body font-12">
                              <div class="form-group">
                                <label for="nama-pasien">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama-pasien" aria-describedby="namaPasienHelp" placeholder="Nama Pasien" disabled="disabled" readonly value="<?php echo $resep->nama_pasien; ?>">
                              </div>
                              <div class="form-group">
                                <label for="telp">No HP </label>
                                <input type="text" class="form-control" id="telp" aria-describedby="telpHelp" placeholder="No HP" disabled="disabled" readonly value="<?php echo $resep->telp_pasien; ?>">
                              </div>
                              <div class="form-group">
                                <label for="email">Email </label>
                                <input type="text" class="form-control" id="email-pasien" placeholder="Email Pasien" disabled="disabled" readonly value="<?php echo $resep->email_pasien; ?>">
                              </div>
                              <div class="form-group">
                                <label for="card-number">Nomor Kartu (Card Number) </label>
                                <input type="text" class="form-control" id="card-number" placeholder="Card Number" disabled="disabled" readonly value="<?php echo $resep->card_number; ?>">
                              </div>
                              <hr>
                              <div class="form-group">
                                <label for="alamat">Alamat Inputan Pasien <span class="edit-form" id="isAlamatLengkap"></span></label>
                                <!-- <input type="text" class="form-control alamat-input" id="alamat<?php echo $resep->id_jadwal_konsultasi; ?>" name="alamat" placeholder="<?php echo $alamat_inputan; ?>" value="<?php echo $alamat_inputan; ?>"> -->
                                <input type="text" class="form-control" id="alamat-inputan" value="<?php echo $alamat_inputan; ?>" name="alamat" placeholder="<?php echo $alamat_inputan; ?>" readonly>
                                </input>
                                <script>
                                  $("#alamat-inputan").val("<?php echo $alamat_inputan; ?>");
                                </script>
                                <?php $alamat_inputan = $resep->alamat_pengiriman; ?>
                                <!-- <textarea class="form-control" id="alamat <?php echo $resep->id; ?>" name="alamat" placeholder="<?php echo $alamat_inputan ?>"><?php echo $alamat_inputan; ?>
                                  </textarea> -->
                                <script>
                                  $("#alamat-<?php echo $resep->id; ?>").text("<?php echo $alamat_inputan; ?>");
                                </script>
                                <!-- <span class="edit-form form-text text-muted">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="alamat_kustom" id="inlineRadio1" value="0">
                                    <label class="form-check-label" for="inlineRadio1">Alamat Inputan Pasien</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="alamat_kustom" id="inlineRadio2" value="1">
                                    <label class="form-check-label" for="inlineRadio2">Alamat Lain</label>
                                  </div>
                                </span> -->
                              </div>
                              <div class="form-group submit-form">
                                <label for="harga-obat">Harga Obat ( Rp. )</label>
                                <input type="number" name="harga_obat" class="form-control" id="harga-obat" aria-describedby="biayaPengirimanHelp" disabled="disabled" placeholder="Harga Obat" value="<?php echo $total_harga; ?>">
                                <!-- <small id="hargaObatHelp" class="form-text text-muted">Rp. 0,0</small> -->
                              </div>
                              <div class="form-group">
                                <label for="biaya-pengiriman" class="font-14">Masukan Biaya Pengiriman ( Rp. <?php echo $resep->biaya_pengiriman; ?>) </label>
                                <input type="number" name="biaya_pengiriman" class="form-control" id="biaya-pengiriman" aria-describedby="biayaPengirimanHelp" placeholder="Biaya Pengiriman" required value="<?php echo $resep->biaya_pengiriman ?>">
                                <button id="getOngkir" class="btn btn-primary mt-3" type="button">Get Ongkir</button>
                                <!-- <small id="biayaPengirimanHelp" class="form-text text-muted">Rp. 0,0</small> -->
                              </div>
                              <!-- <div class="form-group submit-form">
                                  <label for="total-harga">Total Harga</label>
                                  <input type="number" name="total_harga" class="form-control" id="total-harga" aria-describedby="biayaPengirimanHelp" placeholder="Total Harga" disabled="disabled" readonly>
                                  <small id="totalHargaHelp" class="form-text text-muted">Rp. 0,0</small>
                                </div> -->
                              <input type="hidden" name="id_jadwal_konsultasi" id="id_jadwal_konsultasi">
                              <input type="hidden" name="id_registrasi">
                            </div>
                            <div class="modal-footer">
                              <div class="px-3">
                                <button type="button" class="btn btn-batal-2" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-simpan-2 buttonSave" id="saveBiayaPengiriman">Simpan</button>
                              </div>
                            </div>
                          </div>
                          <?= form_close(); ?>
                        </div>
                      </div>

                      <div class="modal fade" id="modalBiayaPengiriman<?php echo $resep->id_jadwal_konsultasi; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBiayaPengirimanLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content" style="height: auto;">
                            <div class="modal-header">
                              <p class="modal-title font-14" id="modalBiayaPengirimanLabel"><b>Biaya Pengiriman</b></p>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <?= form_open('admin/PengirimanObat/rilis_obat/' . $resep->id_jadwal_konsultasi); ?>

                            <div class="modal-body font-12">
                              <div class="form-group">
                                <label for="nama-pasien">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama-pasien" aria-describedby="namaPasienHelp" placeholder="Nama Pasien" disabled="disabled" readonly value="<?php echo $resep->nama_pasien; ?>">
                              </div>
                              <div class="form-group">
                                <label for="telp">No HP </label>
                                <input type="text" class="form-control" id="telp" aria-describedby="telpHelp" placeholder="No HP" disabled="disabled" readonly value="<?php echo $resep->telp_pasien; ?>">
                              </div>
                              <div class="form-group">
                                <label for="email">Email </label>
                                <input type="text" class="form-control" id="email-pasien" placeholder="Email Pasien" disabled="disabled" readonly value="<?php echo $resep->email_pasien; ?>">
                              </div>
                              <div class="form-group">
                                <label for="card-number">Nomor Kartu (Card Number) </label>
                                <input type="text" class="form-control" id="card-number" placeholder="Card Number" disabled="disabled" readonly value="<?php echo $resep->card_number; ?>">
                              </div>
                              <hr>
                              <div class="form-group">
                                <label for="alamat">Alamat Inputan Pasien <span class="edit-form" id="isAlamatLengkap"></span></label>
                                <!-- <input type="text" class="form-control alamat-input" id="alamat<?php echo $resep->id_jadwal_konsultasi; ?>" name="alamat" placeholder="<?php echo $alamat_inputan; ?>" value="<?php echo $alamat_inputan; ?>"> -->
                                <input type="text" class="form-control" id="alamat-inputan" value="<?php echo $alamat_inputan; ?>" name="alamat" placeholder="<?php echo $alamat_inputan; ?>" readonly disabled="disabled">
                                </input>
                                <script>
                                  $("#alamat-inputan").val("<?php echo $alamat_inputan; ?>");
                                </script>
                                <?php
                                // $alamat_inputan = $resep->alamat_jalan.", ".$resep->nama_kelurahan.", ".$resep->nama_kecamatan.", ".$resep->nama_kota.", ".$resep->nama_provinsi." ".$resep->kode_pos;

                                $alamat_inputan = $resep->alamat_pengiriman;
                                ?>
                                <!-- <textarea class="form-control" id="alamat <?php echo $resep->id; ?>" name="alamat" placeholder="<?php echo $alamat_inputan ?>"><?php echo $alamat_inputan; ?>
                                  </textarea> -->
                                <script>
                                  $("#alamat-<?php echo $resep->id; ?>").text("<?php echo $alamat_inputan; ?>");
                                </script>
                                <!-- <span class="edit-form form-text text-muted">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="alamat_kustom" id="inlineRadio1" value="0">
                                    <label class="form-check-label" for="inlineRadio1">Alamat Inputan Pasien</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="alamat_kustom" id="inlineRadio2" value="1">
                                    <label class="form-check-label" for="inlineRadio2">Alamat Lain</label>
                                  </div>
                                </span> -->
                              </div>

                              <div class="form-group submit-form">
                                <span class="m-3" style="font-weight: bolder;">
                                  <h4>List Obat</h4>
                                  <?= $resep->detail_obat ?>
                                </span>
                              </div>
                              <div class="form-group submit-form">
                                <label for="harga-obat">Harga Obat ( Rp. )</label>
                                <input type="number" name="harga_obat" class="form-control" id="harga-obat" aria-describedby="biayaPengirimanHelp" disabled="disabled" placeholder="Harga Obat" value="<?php echo $total_harga; ?>">
                                <!-- <small id="hargaObatHelp" class="form-text text-muted">Rp. 0,0</small> -->
                              </div>
                              <div class="form-group">
                                <label for="biaya-pengiriman" class="font-14">Masukan Biaya Pengiriman ( Rp. ) </label>
                                <input type="number" readonly disabled="disabled" name="biaya_pengiriman" class="form-control" id="biaya-pengiriman" aria-describedby="biayaPengirimanHelp" placeholder="Biaya Pengiriman" value="<?= ($biaya_pengiriman == 0 || $biaya_pengiriman == null) ? 0 : $biaya_pengiriman ?>">

                                <!-- <button id="getOngkir" class="btn btn-primary mt-3" type="button">Get Ongkir</button> -->
                                <!-- <small id="biayaPengirimanHelp" class="form-text text-muted">Rp. 0,0</small>  -->
                              </div>
                              <!-- <div class="form-group submit-form">
                                  <label for="total-harga">Total Harga</label>
                                  <input type="number" name="total_harga" class="form-control" id="total-harga" aria-describedby="biayaPengirimanHelp" placeholder="Total Harga" disabled="disabled" readonly>
                                  <small id="totalHargaHelp" class="form-text text-muted">Rp. 0,0</small>
                                </div> -->
                              <input type="hidden" name="id_jadwal_konsultasi" id="id_jadwal_konsultasi">
                              <input type="hidden" name="id_registrasi">
                            </div>
                            <div class="modal-footer">
                              <div class="px-3">
                                <button type="button" class="btn btn-batal-2" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-simpan-2 buttonSave" id="saveBiayaPengiriman">Rilis Obat</button>
                              </div>
                            </div>
                          </div>
                          <?= form_close(); ?>
                        </div>
                      </div>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

</div>
</div>



<script type="text/javascript">
  var harga_obat = document.getElementById("harga-obat");
  var harga_obat_help = document.getElementById("hargaObatHelp");

  var rupiah = document.getElementById('biaya-pengiriman');
  var show_to = document.getElementById('biayaPengirimanHelp');

  harga_obat.addEventListener("change", function(e) {
    harga_obat_help.innerHTML = formatRupiah(this.value, "Rp. ");
  });

  // harga_obat.addEventListener("keyup", (e) => {
  //   harga_obat_help.innerHTML = formatRupiah(this.value, "Rp. ");
  // });

  rupiah.addEventListener('change', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    show_to.innerHTML = formatRupiah(this.value, 'Rp. ');
  });

  // rupiah.addEventListener('keyup', function(e) {
  //   // tambahkan 'Rp.' pada saat form di ketik
  //   // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  //   show_to.innerHTML = formatRupiah(this.value, 'Rp. ');
  // });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
</script>

<?php if ($this->session->flashdata('msg_biaya_pengiriman')) {
  echo "<script>alert('" . $this->session->flashdata('msg_biaya_pengiriman') . "')</script>";
} ?>