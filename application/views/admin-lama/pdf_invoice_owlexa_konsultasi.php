<!-- Invoice Item -->
<div class="invoice-item">
  <div class="row">
    <div class="col-md-3 pt-5">
      <p class="text-left invoice-details-two">
        <strong>Metode Pembayaran</strong><br>
        Owlexa<br>
        <strong>Tanggal Transaksi</strong><br>
        <?php echo $tanggal ? $tanggal : 'Semua Transaksi'; ?>
      </p>
    </div>
  </div>
</div>
<!-- /Invoice Item -->

<!-- Invoice Item -->
<div class="invoice-item">
  <div class="row">
    <div class="col-md-12 font-12">
      <div class="table-responsive">
        <table class="table-invoice table-bordered font-5">
          <thead>
            <tr class="text-center">
              <th width="2%">No</th>
              <th width="5%">Claim Number</th>
              <th width="6%">Telemedicine Trans Number</th>
              <th>Transaction Time</th>
              <th width="5%">Card Number</th>
              <th width="5%">Member Name</th>
              <th width="3%">Diagnosis Code</th>
              <th width="6%">Diagnosis Name</th>
              <th>Admission Date</th>
              <th>Charge Time</th>
              <th>Type of Service</th>
              <th>Provider Name</th>
              <th width="7%">Doctor Name</th>
              <th>Doctor Speciality</th>
              <th>Claim Type</th>
              <th>Benefit Description</th>
              <th>Charge Benefit Item</th>
              <th>Approved Benefit Item</th>
              <th>Excess Benefit Item</th>
              <th>Pre Paid Excess Item</th>
              <th>Paid To Provider Item</th>
              <th>Claim Remarks</th>
              <th width="3%">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list_pembayaran as $idx => $pembayaran) { ?>
              <?php
              $pembayaran->tanggal_pembayaran = new DateTime($pembayaran->tanggal_pembayaran);
              $charged_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
              $admission_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
              $pembayaran->tanggal_pembayaran = $pembayaran->tanggal_pembayaran->format('d/m/Y H:i:s');

              $biaya_adm = $pembayaran->biaya_adm ? $pembayaran->biaya_adm : 0;

              $biaya_konsultasi = $pembayaran->biaya_konsultasi ? $pembayaran->biaya_konsultasi : 0;
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
                <td>Azra Testing</td>
                <td><?php echo $pembayaran->nama_dokter ?></td>
                <td><?php echo $pembayaran->nama_poli ?></td>
                <td>CASHLESS</td>
                <td>Biaya Konsultasi</td>
                <td><?php echo "Rp. " . number_format($biaya_konsultasi, 2, ".", ","); ?></td>
                <td><?php echo "Rp. " . number_format($biaya_konsultasi, 2, ".", ","); ?></td>
                <td>0</td>
                <td>0</td>
                <td><?php echo "Rp. " . number_format($biaya_konsultasi, 2, ".", ","); ?></td>
                <td>
                  <!-- EXCESS DIBAYAR DI TEMPAT -->
                </td>
                <td class="text-center">PAID</td>
              </tr>
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
                <td></td>
                <td>Biaya Administrasi</td>
                <td><?php echo "Rp. " . number_format($biaya_adm, 2, ".", ","); ?></td>
                <td><?php echo "Rp. " . number_format($biaya_adm, 2, ".", ","); ?></td>
                <td>0</td>
                <td>0</td>
                <td><?php echo "Rp. " . number_format($biaya_adm, 2, ".", ","); ?></td>
                <td></td>
                <td class="text-center">PAID</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /Invoice Item -->
</div>