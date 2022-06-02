<!-- Invoice Item -->
<div class="invoice-item">
  <div class="row">
    <div class="col-md-3 pt-3">
      <p class="text-left invoice-details-two">
        <strong>Metode Pembayaran</strong><br>
        Owlexa<br>
        <strong>Tanggal Transaksi</strong><br>
        <?php echo $tanggal ? $tanggal : 'Semua Transaksi' ?>
      </p>
    </div>
  </div>
</div>
<!-- /Invoice Item -->

<!-- Invoice Item -->
<div class="invoice-item">
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table-invoice table-bordered font-5">
          <thead class="font-8">
            <tr class="text-center">
              <th width="2%">No</th>
              <th width="4%">Claim Number</th>
              <th width="6%">Telemedicine Trans Number</th>
              <th width="5%">Transaction Time</th>
              <th width="4%">Card Number</th>
              <th width="4%">Member Name</th>
              <th width="4%">Diagnosis Code</th>
              <th width="4%">Diagnosis Name</th>
              <th>Date of Admission</th>
              <th>Date of Discharge</th>
              <th>Type of Service</th>
              <th>Provider Name</th>
              <th width="5%">Claim Type</th>
              <th>Shipping Address</th>
              <th width="6%">Benefit Description</th>
              <th>Charge Benefit Item</th>
              <th>Approved Benefit Item</th>
              <th>Excess Benefit Item</th>
              <th>Pre Paid Excess Item</th>
              <th>Paid To Provider Item</th>
              <th>Claim Remarks</th>
              <th width="3%">Status</th>
              <th width="4%">Order Status</th>
            </tr>
          </thead>
          <tbody class="font-7">
            <?php foreach ($list_pembayaran as $idx => $pembayaran) { ?>
              <?php
              $pembayaran->tanggal_pembayaran = new DateTime($pembayaran->tanggal_pembayaran);
              $charged_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
              $admission_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
              $pembayaran->tanggal_pembayaran = $pembayaran->tanggal_pembayaran->format('d/m/Y H:i:s');
              ?>
              <tr>
                <td class="text-center"><?php echo $idx + 1 ?></td>
                <td><?php echo $pembayaran->claim_number ?></td>
                <td><?php echo $pembayaran->id_registrasi ?></td>
                <td><?php echo $pembayaran->tanggal_pembayaran ?></td>
                <td><?php echo $pembayaran->card_number ?></td>
                <td><?php echo $pembayaran->nama_pasien ?></td>
                <td class="text-center"><?php echo $pembayaran->diagnosis_code ?></td>
                <td><?php echo $pembayaran->diagnosis_name ?></td>
                <td><?php echo $admission_date ?></td>
                <td><?php echo $charged_date ?></td>
                <td>OUTPATIENT</td>
                <td>RS. TESTING OWLEXA</td>
                <td>CASHLESS</td>
                <td><?php echo $pembayaran->alamat_pengiriman ?></td>
                <?php
                $list_nama_obat = explode('|', $pembayaran->nama_obat);
                $list_tipe_obat = explode(',', $pembayaran->tipe_obat);
                $list_jumlah_obat = explode(',', $pembayaran->jumlah_obat);
                $jml_obat = count($list_nama_obat);
                ?>
                <td>
                  Obat-Obatan<br />
                </td>
                <?php
                $list_harga_obat = explode(',', $pembayaran->harga_obat);
                $list_harga_obat_per_n_unit = explode(',', $pembayaran->harga_obat_per_n_unit);
                $list_jumlah_obat = explode(',', $pembayaran->jumlah_obat);
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
                <td>
                  <?php echo 'Rp. ' . number_format($total_harga, 2, '.', ','); ?><br />
                </td>
                <td>
                  <?php echo 'Rp. ' . number_format($total_harga, 2, '.', ','); ?><br />
                </td>
                <td>0</td>
                <td>0</td>
                <td>
                  <?php echo 'Rp. ' . number_format($total_harga, 2, '.', ','); ?><br />
                </td>
                <td>
                  <!-- EXCESS DIJAMINKAN DAHULU -->
                </td>
                <td class="text-center">PAID</td>
                <td class="text-center"><?php echo $pembayaran->order_status == 1 ? 'DELIVERED' : 'PENDING'; ?></td>
              </tr>
              <?php for ($i = 0; $i < $jml_data; $i++) { ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><?php echo '' . $list_nama_obat[$i] . ' ( ' . $list_jumlah_obat[$i] . ' ' . $list_tipe_obat[$i] . ' )'; ?></td>
                  <td><?php echo 'Rp. ' . number_format($list_total_harga[$i], 2, '.', ','); ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              <?php } ?>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Biaya Pengiriman</td>
                <td><?php echo 'Rp. ' . number_format($pembayaran->biaya_pengiriman, 2, '.', ','); ?></td>
                <td><?php echo 'Rp. ' . number_format($pembayaran->biaya_pengiriman, 2, '.', ','); ?></td>
                <td>0</td>
                <td>0</td>
                <td><?php echo 'Rp. ' . number_format($pembayaran->biaya_pengiriman, 2, '.', ','); ?></td>
                <td></td>
                <td class="text-center">PAID</td>
                <td class="text-center"><?php echo $pembayaran->order_status == 1 ? 'DELIVERED' : 'PENDING'; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /Invoice Item -->
</div>
<style>
  body{
    background-color: #fff!important;
  }
  table { border-collapse: collapse; }
  table td, table th { border: 1px solid #4c4c4c;
  }
  .text-center {
  	text-align: center;
  }
</style>