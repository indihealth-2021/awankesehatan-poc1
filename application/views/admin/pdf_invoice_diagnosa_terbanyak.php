<!-- Invoice Item -->
<div class="invoice-item">
  <div class="row">
    <div class="col-md-3 pt-5">
      <p class="text-left invoice-details-two">
        <strong>Dokter</strong>
        <?php
        $dokter = $dokter != 'Semua' ? $dokter->name : $dokter;
        ?>
        <?php echo $dokter ?><br>
        <strong>Poli</strong>
        <?php
        $poli = $poli != 'Semua' ? $poli->poli : $poli;
        ?>
        <?php echo $poli ?><br>
        <strong>Tanggal Konsultasi</strong>
        <?php echo $tanggal_konsultasi ? $tanggal_konsultasi : 'Semua Konsultasi'; ?>
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
        <table class="table-invoice-dt table-bordered">
          <thead>
            <tr class="text-center">
              <th width="5%">No</th>
              <th width="15%">Kode Diagnosa</th>
              <th>Deskripsi</th>
              <th width="7%">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php $total_diagnosa = 0; ?>
            <?php foreach ($list_diagnosa as $idx => $diagnosa) { ?>
              <tr>
                <td class="text-center"><?php echo $idx + 1 ?></td>
                <td><?php echo $diagnosa->id ?></td>
                <td><?php echo $diagnosa->nama ?></td>
                <td class="text-center"><?php echo $diagnosa->jumlah_diagnosa ?></td>
                <?php $total_diagnosa += $diagnosa->jumlah_diagnosa ?>
              </tr>
            <?php } ?>
            <tr>
              <th align="right" colspan="3">Total</th>
              <th class="text-center"><?php echo $total_diagnosa ?></th>
            </tr>
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