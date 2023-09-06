<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/PengirimanObat/status_resep') ?>" class="text-black font-bold-7">Pengiriman Obat</a></li>
          </ol>
        </nav>
      </div>
      <div class="col-sm-12 col-12">
        <h3 class="page-title">Pengiriman Obat</h3>
      </div>
      <div class="col-sm-12 col-12">
        <h7 class="page-subtitle">Pengiriman</h7>
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
                      <!-- <th>Tanggal Konsultasi</th>
                          <th>Poli</th> -->
                      <th>Pasien</th>
                      <th>Dokter</th>
                      <!-- <th>Alamat Pasien</th> -->
                      <th>Resep</th>
                      <th>Total Harga</th>
                      <!-- <th>Biaya Pengiriman</th> -->
                      <th>Alamat Pengiriman</th>
                      <th>Aksi</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="font-14">
                    <?php foreach ($list_resep as $idx => $resep) { ?>
                      <tr class="text-top">
                        <td><?php echo $idx += 1; ?></td>
                        <!--<td><?php $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi))->format('d-m-Y H:i:s') : '-';
                                echo $tanggal_konsul;
                                ?></td>
                             <td><?php echo $resep->nama_poli; ?></td> -->
                        <td><?php echo $resep->nama_pasien; ?></td>
                        <td width="18%">
                          <span><b><?php echo $resep->nama_dokter; ?></b></span><br>
                          <span class="font-12"><?php echo $resep->nama_poli; ?></span>
                        </td>
                        <td><?php echo $resep->detail_obat ?></td>
                        <?php
                        $list_harga_obat = explode(',', $resep->harga_obat);
                        $list_harga_obat_per_n_unit = explode(',', $resep->harga_obat_per_n_unit);
                        $list_jumlah_obat = explode(',', $resep->jumlah_obat);
                        $jml_data = count($list_harga_obat);
                        $list_total_harga = [];
                        $total_harga = 0;
                        $biaya_pengiriman = $resep->biaya_pengiriman ? $resep->biaya_pengiriman : 0;
                        if ($resep->harga_kustom) {
                          $total_harga = $resep->harga_kustom;
                        } else {
                          for ($i = 0; $i < $jml_data; $i++) {
                            if (intval($list_jumlah_obat[$i]) > 0 && intval($list_harga_obat_per_n_unit[$i]) > 0 && intval($list_harga_obat) > 0) {
                              $list_total_harga[$i] = (intval($list_jumlah_obat[$i]) / intval($list_harga_obat_per_n_unit[$i])) * intval($list_harga_obat[$i]);
                            }
                          }

                          foreach ($list_total_harga as $tot_harga) {
                            $total_harga += $tot_harga;
                          }
                        }
                        ?>
                        <td width="12%"><?php echo 'Rp. ' . number_format($total_harga + $biaya_pengiriman, 2, ',', '.'); ?></td>
                        <td><?php echo $resep->alamat ?></td>
                        <td class="text-center">
                          <button class="btn btn-kirim" data-link="<?php echo base_url('admin/PengirimanObat/kirim_obat/' . $resep->id_bukti) ?>" data-alamat="<?php echo $resep->alamat ?>" data-biaya-obat="<?php echo "Rp. " . number_format($total_harga, 2, ',', '.'); ?>" data-biaya-pengiriman="<?php echo "Rp. " . number_format($biaya_pengiriman, 2, ',', '.'); ?>" data-total-harga="<?php echo "Rp. " . number_format($total_harga + $biaya_pengiriman, 2, ',', '.'); ?>" data-toggle="modal" data-target="#modalPengiriman-<?php echo $resep->id_bukti ?>">Via Manual</button>
                          <button class="btn btn-kirim mt-2" data-bukti-pembayaran-obat-id="<?php echo $resep->id_bukti; ?>" data-lat="<?php echo @$resep->lat ?>" data-lng="<?php echo @$resep->lng ?>" data-alamat="<?php echo $resep->alamat ?>" data-biaya-obat="<?php echo "Rp. " . number_format($total_harga, 2, ',', '.'); ?>" data-biaya-pengiriman="<?php echo "Rp. " . number_format($biaya_pengiriman, 2, ',', '.'); ?>" data-total-harga="<?php echo "Rp. " . number_format($total_harga + $biaya_pengiriman, 2, ',', '.'); ?>" data-toggle="modal" data-target="#modalPengirimanJNE-<?php echo $resep->id_bukti ?>">Via JNE</button>
                        </td>
                        <td>
                          <a class="font-icon" href="#modalHapus" data-toggle="modal" data-href="#" data-nama="#" onclick="$('#modalHapus #form')">
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z" fill="black" fill-opacity="0.35" />
                                <path d="M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z" fill="black" fill-opacity="0.35" />
                              </svg></i>
                          </a>
                        </td>
                      </tr>
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
  <!-- /.col -->
</div>

<?php foreach ($list_resep as $idx => $resep) { ?>
  <?php
  $list_harga_obat = explode(',', $resep->harga_obat);
  $list_harga_obat_per_n_unit = explode(',', $resep->harga_obat_per_n_unit);
  $list_jumlah_obat = explode(',', $resep->jumlah_obat);
  $jml_data = count($list_harga_obat);
  $list_total_harga = [];
  $total_harga = 0;
  $biaya_pengiriman = $resep->biaya_pengiriman ? $resep->biaya_pengiriman : 0;
  if ($resep->harga_kustom) {
    $total_harga = $resep->harga_kustom;
  } else {
    for ($i = 0; $i < $jml_data; $i++) {
      if (intval($list_jumlah_obat[$i]) > 0 && intval($list_harga_obat_per_n_unit[$i]) > 0 && intval($list_harga_obat) > 0) {
        $list_total_harga[$i] = (intval($list_jumlah_obat[$i]) / intval($list_harga_obat_per_n_unit[$i])) * intval($list_harga_obat[$i]);
      }
    }

    foreach ($list_total_harga as $tot_harga) {
      $total_harga += $tot_harga;
    }
  }
  ?>
  <div class="modal fade" id="modalPengiriman-<?php echo $resep->id_bukti ?>" tabindex="-1" role="dialog" aria-labelledby="modalPengirimanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="height: auto;">
        <div class="modal-header">
          <p class="modal-title font-14" id="modalPengirimanLabel"><b>Pengiriman Obat Manual</b></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body font-12">
          <div class="row">
            <div class="col-md-4 font-weight-bold">Alamat : </div>
            <div class="col-md-8">
              <p class="alamat"><?php echo $resep->alamat ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 font-weight-bold">Biaya : </div>
            <div class="col-md-8">
              <p>
                Biaya Obat: <span class="biaya-obat"><?php echo "Rp. " . number_format($total_harga, 2, ',', '.'); ?></span><br />
                Biaya Pengiriman: <span class="biaya-pengiriman"><?php echo "Rp. " . number_format($biaya_pengiriman, 2, ',', '.'); ?></span><br />
                Total Biaya: <span class="total-harga"><?php echo "Rp. " . number_format($total_harga + $biaya_pengiriman, 2, ',', '.'); ?></span>
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="px-3">
            <button type="button" class="btn btn-batal-2" data-dismiss="modal">Batal</button>
            <a href="<?php echo base_url('admin/PengirimanObat/kirim_obat/' . $resep->id_bukti) ?>" id="link-delete"><button type="button" class="btn btn-simpan-2 buttonSave" id="kirimObatManual">Kirim</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalPengirimanJNE-<?php echo $resep->id_bukti ?>" tabindex="-1" role="dialog" aria-labelledby="modalPengirimanJNELabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="height: auto;">
        <div class="modal-header">
          <p class="modal-title font-14" id="modalPengirimanJNELabel"><b>Pengiriman Obat JNE</b></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body font-12">
          <div class="row">
            <div class="col-md-4 font-weight-bold">Alamat : </div>
            <div class="col-md-8">
              <p class="alamat"><?php echo $resep->alamat ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 font-weight-bold">Biaya : </div>
            <div class="col-md-8">
              <p>
                Biaya Obat: <span class="biaya-obat"><?php echo "Rp. " . number_format($total_harga, 2, ',', '.'); ?></span><br />
                Biaya Pengiriman: <span class="biaya-pengiriman"><?php echo "Rp. " . number_format($biaya_pengiriman, 2, ',', '.'); ?></span><br />
                Total Biaya: <span class="total-harga"><?php echo "Rp. " . number_format($total_harga + $biaya_pengiriman, 2, ',', '.'); ?></span>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 font-weight-bold">Driver Terdekat : </div>
            <div class="col-md-8">
              <p class="driver-terdekat">0</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-block bg-tele text-light get-driver-terdekat" data-lat="" data-lng="">Get Driver Terdekat</button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="px-3">
            <button type="button" class="btn btn-batal-2" data-dismiss="modal">Batal</button>
            <a href="<?php echo base_url('admin/PengirimanObat/kirim_obat_jne/' . $resep->id_jadwal_konsultasi) ?>" id="link-delete"><button type="button" class="btn btn-simpan-2 buttonSave" id="kirimObatManual" disabled>Kirim</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-modal-header p-3">Hapus Data Pengiriman</h5>
      </div>
      <form method="post" action="">
        <div class="modal-body font-modal-body">
          <p class="p-3">Anda yakin ingin menghapus data pengiriman ?</p>
        </div>
        <div class="modal-footer">
          <div class="mx-auto">
            <a href="" class="btn btn-ya" id="buttonHapus">Ya</a>
            <button type="button" class="btn btn-tidak ml-5" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php if ($this->session->flashdata('msg_kirim_obat')) {
  echo "<script>alert('" . $this->session->flashdata('msg_kirim_obat') . "')</script>";
} ?>