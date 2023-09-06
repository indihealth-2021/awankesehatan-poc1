<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/HistoryMedis') ?>" class="text-black">Rekam Medis</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Detail Rekam Medis</a></li>
        </nav>
      </div>
      <div class="col-sm-12 col-12">
        <h3 class="page-title">Detail Rekam Medis</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <p class="text-center font-24 mb-5 pt-4"><u><b>REKAM MEDIS</b></u></p>
        <div class="row font-14 font-bold-7">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-3 col-4">No Registrasi</label>
              <div class="col-md-9 col-8">
                <p>: <?php echo $rekam_medis->id_registrasi ?></p>
              </div>
              <label class="col-md-3 col-4">Dokter</label>
              <div class="col-md-9 col-8">
                <p>: <?php echo $rekam_medis->nama_dokter ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-4 col-4">Tanggal Konsultasi</label>
              <div class="col-md-8 col-8">
                <p>: <?php $tanggal_konsul = $rekam_medis->tanggal_konsultasi ? (new DateTime($rekam_medis->tanggal_konsultasi))->format('d-m-Y H:i:s') : '-';
                      echo $tanggal_konsul; ?></p>
              </div>
              <label class="col-md-4 col-4">Poli</label>
              <div class="col-md-8 col-8">
                <p>: <?php echo ucwords($rekam_medis->poli) ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <p class="font-24 font-bold-7">Data Pasien</p>
          </div>
          <div class="col-md-6 font-14 font-bold-4">
            <div class="form-group row">
              <label class="col-md-4 col-4">No Rekam Medis</label>
              <div class="col-md-8 col-8">
                <p>: <?php echo $rekam_medis->no_medrec ?></p>
              </div>
              <label class="col-md-4 col-4">Nama</label>
              <div class="col-md-8 col-8">
                <p>: <?php echo ucwords($rekam_medis->nama_pasien) ?></p>
              </div>
              <?php
              $tanggal_lahir = new DateTime($rekam_medis->tanggal_lahir_pasien);
              $tanggal_lahir = $tanggal_lahir->format('d-m-Y');
              ?>
              <label class="col-md-4 col-4">Tempat / Tanggal Lahir</label>
              <div class="col-md-8 col-8">
                <p>: <?php echo ucwords($rekam_medis->tempat_lahir_pasien) ?>, <?php echo $tanggal_lahir ?></p>
              </div>
              <label class="col-md-4 col-4">Jenis Kelamin</label>
              <div class="col-md-8 col-8">
                <p>: <?php echo $rekam_medis->jk_pasien ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <p class="font-24 fond-bold-7">Data Penunjang</p>
          </div>
          <div class="col-md-12 font-14 font-bold-4">
            <div class="form-group row">
              <?php if ($data_penunjang) { ?>
                <label class="col-md-2 col-4">Planning</label>
                <div class="col-md-10 col-10">
                  <p>: <?php echo $data_penunjang->planning ?></p>
                </div>
                <label class="col-md-2 col-4">Pemeriksaan Penunjang Laboratorium</label>
                <div class="col-md-10 col-10">
                  <p>: <?php if ($data_penunjang->pemeriksaan_penunjang_laboratorium) {
                          foreach (json_decode($data_penunjang->pemeriksaan_penunjang_laboratorium) as $ppl) {
                            echo $ppl . ", ";
                          }
                        } ?></p>
                </div>
                <label class="col-md-2 col-4">Pemeriksaan Penunjang Radiologi</label>
                <div class="col-md-10 col-10">
                  <p>: <?php if ($data_penunjang->pemeriksaan_penunjang_radiologi) {
                          foreach (json_decode($data_penunjang->pemeriksaan_penunjang_radiologi) as $ppr) {
                            echo $ppr . ", ";
                          }
                        } ?></p>
                </div>
                <label class="col-md-2 col-4">Kesimpulan</label>
                <div class="col-md-10 col-10">
                  <p>: <?= $data_penunjang->kesimpulan ?></p>
                </div>
              <?php } else { ?>
                <p style="text-align: center;" class="ml-4">Data penunjang tidak ditemukan</p>
              <?php } ?>
              <?php if ($rekam_medis->order_status != null) { ?>
                <label class="col-md-2 col-4">Order Status</label>
                <div class="col-md-8 col-8">
                  <p>: <?php echo $rekam_medis->order_status == 2 ? 'On Progress' : ($rekam_medis->order_status == 3 ? 'REJECTED' : ($rekam_medis->order_status == 1 ? 'DELIVERED' : 'PENDING')); ?></p>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php $plafon = 1000000; ?>
      <span id="total" class="m-4">Total Harga: Rp.<?php echo $total; ?>, Plafon setelah pembayaran: Rp.<?php echo $plafon - (int)$total; ?></span>
      <div class="col-md-12 mb-3">
        <p class="font-24 font-bold-7">Pemeriksaan</p>
      </div>
      <div class="col-md-12 font-14 font-bold-4">
        <div class="form-group row">
          <label class="col-md-2 col-4">Keluhan</label>
          <div class="col-md-10 col-10">
            <p>: <?php echo $rekam_medis->keluhan ?></p>
          </div>
          <label class="col-md-2 col-4">Diagnosa</label>
          <div class="col-md-10 col-10">
            <p>: <?php echo '(' . $rekam_medis->diagnosis_code . ') ' . $rekam_medis->diagnosis ?></p>
          </div>
          <label class="col-md-2 col-4">Kronis</label>
          <div class="col-md-10 col-10">
            <?php if ($rekam_medis->kronis == 1) { ?>
              <p>: Kronis</p>
            <?php } else if ($rekam_medis->kronis == 2) { ?>
              <p>: Akut</p>
            <?php } else { ?>
              <p>: Tidak</p>
            <?php } ?>
          </div>
          <?php
          $tanggal_lahir = new DateTime($rekam_medis->tanggal_lahir_pasien);
          $tanggal_lahir = $tanggal_lahir->format('d-m-Y');
          ?>
          <?php
          if (!$rekam_medis->resep_verif) {
            $status = '<font style="background-color:red;color:white;">BELUM DIVERIFIKASI</font>';
          } else if (!$rekam_medis->resep_rilis) {
            $status = '<font style="background-color:yellow;color:black;">SUDAH DIVERIFIKASI & BELUM DIRILIS</font>';
          } else {
            $status = '<font style="background-color:green;color:white;">SUDAH DIVERIFIKASI & SUDAH DIRILIS</font>';
          }
          ?>

          <label class="col-md-2 col-4">Apotek</label>
          <div class="col-md-10 col-10">
            <?= $rekam_medis->nama_apotek ?>
          </div>

          <label class="col-md-2 col-4">Alamat Apotek</label>
          <div class="col-md-10 col-10">
            <?= $rekam_medis->alamat_apotek ?>, <?= $rekam_medis->kelurahan_apotek ?>, <?= $rekam_medis->kecamatan_apotek ?>, <?= $rekam_medis->kota_apotek ?>, <?= $rekam_medis->provinsi_apotek ?>.
          </div>

          <label class="col-md-2 col-4">Resep Obat</label>
          <div class="col-md-10 col-10">
            <?php echo $rekam_medis->list_obat ? '<ol>' . $rekam_medis->list_obat . '</ol>( ' . $status . ' )' : '<p>: -</p>'; ?>
          </div>
          <?php if ($rekam_medis->order_status != null) { ?>
            <label class="col-md-2 col-4">Order Status</label>
            <div class="col-md-8 col-8">
              <p>: <?php echo $rekam_medis->order_status == 2 ? 'On Progress' : ($rekam_medis->order_status == 3 ? 'REJECTED' : ($rekam_medis->order_status == 1 ? 'DELIVERED' : 'PENDING')); ?></p>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>