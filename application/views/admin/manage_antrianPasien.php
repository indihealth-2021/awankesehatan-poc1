
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/pasien/antrian_pasien') ?>" class="text-black font-bold-7">Antrian Pasien</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Antrian Pasien</h3>
          </div>
      </div>  
      
            
        <div class="row">
          <div class="col-md-12">
            <div class="bg-tab p-3">
              <div class="tab-pane show pt-3" id="admin">
                <div class="col-md-12">
                  <div class="box">
                      <div class="container-1">
                          <span class="icon"><i class="fa fa-search font-16 text-tele"></i></span>
                          <input type="search" id="search" style="background: #ffffff !important" placeholder="Cari Pasien Disini" />
                      </div>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-border table-hover custom-table mb-0" id="table_antrian">
                      <thead class="text-tr">
                        <tr class="text-center">
                          <th class="text-left">No</th>
                          <th>Pasien</th>
                          <th>Dokter</th>
                          <th>Waktu Praktek</th>
                          <th>Antrian</th>
                          <th>Waktu Konsultasi</th>
                          <th>Status</th>
                        </tr>
                        </tr>
                      </thead>
                      <tbody class="font-14">
                        <?php $no = 0; 
                              foreach ($antrian as $data) {
                                $no++?>
                                <?php $data->status = !$data->status ? 'Antri' : 'Sedang Konsultasi'; ?>
                                <tr class="odd gradeX text-center">
                                  <td class="text-left"><?php echo $no; ?></td>
                                  <td class="text-left"><?php echo $data->name_pasien; ?></td>
                                  <td class="text-left"><?php echo $data->name_dokter; ?></td>
                                  <?php $waktu_praktek = $data->tanggal_jadwal ? (new DateTime($data->tanggal_jadwal))->format('d-m-Y'):$data->hari_jadwal; ?>
                                  <td><?php echo $waktu_praktek; ?></td>
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
    
  
