<style type="text/css">
    @media print {

        html,
        body {
            display: none;
        }
    }
</style>
 <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/HistoryMedis') ?>"class="text-black  font-bold-7">Rekam Medis</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Rekam Medis</h3>
          </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <div class="bg-tab p-3">
              <div class="row mb-5">
                    <div class="col-md-3 mx-3">
                        <div class="box">
                            <div class="container-1 ">
                                <span class="icon"><i class="fa fa-search font-16"></i></span>
                                <input type="search" id="search" placeholder="Cari Dokter Disini" />
                            </div>
                        </div>
                    </div>
                </div>
              <div class="table-responsive">
                <table class="table table-border table-hover custom-table mb-0" id="table_medrec">
                    <thead class="text-tr">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Konsultasi</th>
                            <th>Poli</th>
                            <th>Diagnosa</th>
                            <th>Pemeriksa</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="font-14">
                        <?php foreach ($list_rekam_medis as $idx => $rekam_medis) { ?>
                            <tr>
                                <td><?php echo $idx + 1 ?></td>
                                <td>
                                    <?php $tanggal_konsul = $rekam_medis->tanggal_konsultasi ? (new DateTime($rekam_medis->tanggal_konsultasi))->format('d-m-Y H:i:s') : '-';
                                    echo $tanggal_konsul;
                                    ?></td>
                                <td><?php echo $rekam_medis->poli ?></td>
                                <td><?php echo '(' . $rekam_medis->diagnosis_code . ') ' . $rekam_medis->diagnosis ?></td>
                                <td><?php echo $rekam_medis->nama_dokter ?></td>
                                <td class="text-center"><a href="<?php echo base_url('pasien/HistoryMedis/detail/' . $rekam_medis->id_jadwal_konsultasi) ?>" class="text-detail font-14">Lihat Detail</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
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
<!-- /.row -->
</section>
<!-- /.content -->