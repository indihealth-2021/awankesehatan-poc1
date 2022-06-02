  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Teleconsultasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Teleconsultasi Pasien</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #007bff;">
              <h3 class="card-title" >Data Teleconsultasi Pasien</h3>
            </div> 
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>                                            
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">No RM</th>
                                            <th style="text-align:center">Nama</th>
                                            <th style="text-align:center">Tanggal</th>
                                            <th style="text-align:center">Jadwal</th>
                                            <th style="text-align:center">Status</th>
                                            <th style="text-align:center">-</th>
                                            <th style="text-align:center">-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        for($i = 0; $i<count($jadwal_konsultasi);$i++) {
                                      ?>
                                        <tr class="odd gradeX">                                            
                                            <td style="text-align:center;vertical-align:middle"><?php echo var_dump($jadwal_konsultasi);?></td>
                                            <td style="text-align:center;vertical-align:middle">00.12.34.56</td>
                                            <td style="text-align:center;vertical-align:middle"><?php echo $jadwal_konsultasi[$i]->waktu?></td>
                                            <td style="text-align:center;vertical-align:middle">08/06/2020</td>
                                            <td style="text-align:center;vertical-align:middle">08.00 - 12.00</td>
                                            <td style="text-align:center;vertical-align:middle">Proses Dilayani</td>
                                            <td style="text-align:center;vertical-align:middle;background-color: #007bff" width="10%">
                                            <a href="#" style="text-decoration:none;color: #fff" onclick="return confirm('Edit Data ?')">
                                            Panggil <i class="fas fa-phone"></i>
                                                </a>
                                            </td>
                                            <td style="text-align:center;vertical-align:middle;background-color: #28a745" width="10%">
                                            <a href="<?php echo base_url('dokter/Teleconsultasi/data_pasien');?>" style="text-decoration:none;color: #fff" onclick="return confirm('Lihat Data ?')">
                                            Lihat <i class="fa fa-edit fa-fw"></i>
                                                </a>
                                            </td>
                                        </tr>    
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                            <!-- /.table-responsive -->  

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
  </div>
  <!-- /.content-wrapper -->