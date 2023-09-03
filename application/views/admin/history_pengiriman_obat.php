  <!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-8 col-12 ">
          <nav aria-label="">
            <ol class="breadcrumb" style="background-color: transparent;">
              <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin'); ?>" class="text-black">Dashboard</a></li>
              <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/PengirimanObat') ?>" class="text-black">Pengiriman</a></li>
              <li class="breadcrumb-item" aria-current="page"><a href="admin/PengirimanObat/history_pengiriman_obat" class="text-black font-bold-7">Riwayat Pengiriman Obat</a></li>
            </ol>
          </nav>
        </div>
        <div class="ml-5 pl-4 col-md-3">
          <div class="box">
            <div class="container-1">
              <span class="icon" id="searchButton"><i class="fa fa-search font-16"></i></span>
              <form method="GET" id="searchForm" action="<?php echo base_url('admin/PengirimanObat/history_pengiriman_obat') ?>">
                <input type="search" name="nama_pasien" id="search" value="<?php echo isset($_GET['nama_pasien']) ? $_GET['nama_pasien'] : ''; ?>" placeholder="Cari Pasien Disini" />
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="" data-toggle="tab">Poli</a></li>
            </ul> -->
          <div class="">
            <div class="tab-pane show pt-0">
              <div class="col-md-12">
                <div class="table-responsive pt-0">
                  <table class="table table-border table-hover custom-table mb-0" id="table_history_pengiriman_obat">
                    <thead class="text-tr">

                    </thead>
                    <tbody class="font-14">
                      <?php foreach ($list_resep as $idx => $resep) { ?>
                        <tr class="font-12" style="border-top: 3px solid #21AAC4;">
                          <td colspan="5">
                            <span>Tanggal Konsultasi</span><br>
                            <?php $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi))->format('d-m-Y H:i:s') : '-';
                            echo $tanggal_konsul;
                            ?>
                          </td>
                          <td colspan="3" class="text-right">
                            <span class="mr-2">Tanggal Pengiriman</span><br>
                            <span class="tgl-kirim"><?php echo $resep->tanggal_pengiriman ? (new DateTime($resep->tanggal_pengiriman))->format('d-m-Y H:i:s') : '-';
                                                    ?></span>
                          </td>
                        </tr>

                        <tr class="text-top">
                          <!-- <td><?php echo $idx += 1; ?></td> -->
                          <td class="text-top">
                            <span class="font-tr-table">Pasien</span><br>
                            <?php echo $resep->nama_pasien; ?>
                          </td>
                          <td class="text-top">
                            <span class="font-tr-table">Dokter</span><br>
                            <span><?php echo $resep->nama_dokter; ?></span><br>
                            <span class="font-12"><?php echo $resep->nama_poli; ?></span>
                          </td>
                          <td class="text-top" width="15%">
                            <span class="font-tr-table">Resep</span><br>
                            <?php echo $resep->detail_obat ?>
                          </td>
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
                          <td class="text-top" width="10%">
                            <span class="font-tr-table">Harga Obat</span><br>
                            <?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?>
                          </td>
                          <?php $biaya_pengiriman = $resep->biaya_pengiriman ? $resep->biaya_pengiriman : 0; ?>
                          <td class="text-top" width="18%">
                            <span class="font-tr-table">Biaya Pengiriman</span><br>
                            <?php echo 'Rp. ' . number_format($resep->biaya_pengiriman, 2, ',', '.'); ?>
                          </td>
                          <td width="15%" class="text-top">
                            <span class="font-tr-table">Alamat</span><br>
                            <?php echo $resep->alamat ?>
                          </td>
                          <td width="10%">
                            <span class="font-tr-table">Total Biaya</span><br>
                            <?= 'Rp. ' . number_format($total_harga + $resep->biaya_pengiriman, 2, ',', '.'); ?>
                          </td>
                          <td class="text-center">
                            <span class="font-tr-table">Status</span><br>
                            <span class="status-terkirim"><?php echo $resep->order_status ? 'DELIVERED' : 'PENDING'; ?></span>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="row pt-3">
                  <div class="col-sm-12">
                    <div>
                      <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                          <?php echo $pagination ?>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>