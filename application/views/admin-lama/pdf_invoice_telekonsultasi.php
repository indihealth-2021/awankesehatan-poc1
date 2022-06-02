<!-- Invoice Item -->
<div class="invoice-item">
    <div class="row">
        <div class="col-md-3 pt-5">
            <p class="text-left invoice-details-two">
                <strong>Dokter</strong><br>
                <?php
                $dokter = $dokter != 'Semua' ? $dokter->name : $dokter;
                ?>
                <?php echo $dokter ?><br>
                <strong>Poli</strong><br>
                <?php
                $poli = $poli != 'Semua' ? $poli->poli : $poli;
                ?>
                <?php echo $poli ?><br>
                <strong>Tanggal Konsultasi</strong><br>
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
                <table class="table-invoice-dt table-bordered font-5">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Mulai Konsultasi</th>
                            <th>Durasi</th>
                            <th>No RM</th>
                            <th>No Reg</th>
                            <th>Pasien</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Diagnosa</th>
                            <th>Obat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_pembayaran_konsultasi as $idx => $pembayaran_konsultasi) { ?>
                                <tr>
                                    <td><?php echo $idx + 1 ?></td>
                                    <td><?php echo (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('d-m-Y'); ?></td>
                                    <td><?php echo (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('H:i'); ?></td>
                                    <?php 
                                      if($pembayaran_konsultasi->selesai_konsultasi != null){
                                        $awal_konsultasi = (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('H:i');
                                        $awal_konsultasi = new DateTime($awal_konsultasi);

                                        $akhir_konsultasi = (new DateTime($pembayaran_konsultasi->selesai_konsultasi))->format('H:i');
                                        $akhir_konsultasi = new DateTime($akhir_konsultasi);

                                        $diff = $awal_konsultasi->diff($akhir_konsultasi);

                                        if($diff->h < 1){
                                            $durasi = $diff->i. ' Menit';
                                        }else{
                                            $jam_menit = $diff->h * 60;
                                            $durasi = ($diff->i + $jam_menit). ' Menit';
                                        }
                                      }else{
                                        $durasi = 'NOT SET';
                                      }
                                    ?>
                                    <td><?php echo $durasi ?></td>
                                    <td><?php echo $pembayaran_konsultasi->no_medrec ?></td>
                                    <td><?php echo $pembayaran_konsultasi->id_registrasi ?></td>
                                    <td><?php echo $pembayaran_konsultasi->nama_pasien ?></td>
                                    <td><?php echo $pembayaran_konsultasi->poli ?></td>
                                    <td><?php echo $pembayaran_konsultasi->nama_dokter ?></td>
                                    <td><?php echo '( '.$pembayaran_konsultasi->kode_diagnosa.' ) '.$pembayaran_konsultasi->nama_diagnosa ?></td>
                                    <td><?php echo $pembayaran_konsultasi->nama_obat ?></td>
                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Invoice Item -->
</div>