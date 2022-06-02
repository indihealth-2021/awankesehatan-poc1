
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Antrian Pasien</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Antrian Pasien</li>
                </ol>
            </nav>
          </div>
      </div>
            
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_antrian">
                <thead>
                <tr>
                  <th>No</th>
		              <th>Dokter</th>
                  <th>Waktu Praktek</th>
                  <th>Pasien</th>
                  <th>Antrian</th>
				  <th>Waktu Konsultasi</th>
		              <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 0; 
                  foreach ($antrian as $data) {
                    $no++?>
		                <?php $data->status = !$data->status ? 'Antri' : 'Sedang Konsultasi'; ?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->name_dokter; ?></td>
                      <?php $waktu_praktek = $data->tanggal_jadwal ? (new DateTime($data->tanggal_jadwal))->format('d-m-Y'):$data->hari_jadwal; ?>
                      <td><?php echo $waktu_praktek; ?></td>
		                  <td><?php echo $data->name_pasien; ?></td>
                      <td><?php echo $data->antrian; ?></td>
					  <?php $hari_konsultasi = new DateTime($data->tanggal); $hari_konsultasi = $hari_konsultasi->format('D');
						switch($hari_konsultasi){
							case 'Mon':
								$hari_konsultasi = 'Senin';
								break;
							case 'Tue':
								$hari_konsultasi = 'Selasa';
								break;
							case 'Wed':
								$hari_konsultasi = 'Rabu';
								break;
							case 'Thu':
								$hari_konsultasi = 'Kamis';
								break;
							case 'Fri':
								$hari_konsultasi = "Jum'at";
								break;
							case 'Sat':
								$hari_konsultasi = 'Sabtu';
								break;
							case 'Sun':
								$hari_konsultasi = 'Minggu';
								break;
							default:
								$hari_konsultasi = '';
								break;
						}
					  ?>
					  <?php $waktu = new DateTime($data->tanggal.' '.$data->jam); $waktu = $waktu->format('d M Y H:i:s') ?>
					  <td><?php echo $hari_konsultasi.', '.$waktu; ?></td>
		                  <td><?php echo $data->status; ?></td>
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Dokter</th>
                  <th>Waktu Praktek</th>
                  <th>Pasien</th>
                  <th>Antrian</th>
				  <th>Waktu Konsultasi</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
              <div class="col-lg-12">
              <a href="<?php echo base_url('admin/Admin') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="float: right; margin-top: 20px; width: 140px">Kembali</a>
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
  
