  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DATA DOKTER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Jadwal Dokter</li>
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
            <div class="card-header">
              <h3 class="card-title">Jadwal Dokter</h3>
            </div>
            <!-- /.card-header -->
            <div>
            </div>
            <div class="card-body">
              <div class="">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>                                            
                                            <th style="text-align:center">Poli</th>
                                            <th style="text-align:center">Hari</th>
                                            <th style="text-align:center">Tanggal</th>
                                            <th style="text-align:center">Waktu</th>
                                            <!-- <th style="text-align:center">-</th>
                                            <th style="text-align:center">-</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        for($i = 0; $i<count($jadwal);$i++) {
                                      ?>
                                          <tr class="odd gradeX">                                            
                                              <td style="text-align:center;vertical-align:middle"><?php echo $jadwal[$i]->poli ?></td>
                                              <td style="text-align:center;vertical-align:middle"><?php echo $jadwal[$i]->hari ?></td>
                                              <td style="text-align:center;vertical-align:middle"><?php echo $jadwal[$i]->tanggal ?></td>
                                              <td style="text-align:center;vertical-align:middle"><?php echo $jadwal[$i]->waktu ?></td>
                                              <!-- <td style="text-align:center;vertical-align:middle;background-color: #007bff" width="10%">
                                           
                                              <a href="#" style="text-decoration:none;color: #fff" onclick="return confirm('Tambah Data ?')">
                                              TAMBAH <i class="fa fa-edit fa-fw"></i>
                                                  </a>
                                              </td>
                                              <td style="text-align:center;vertical-align:middle;background-color: #d9534f" width="10%">
                                              <a href="#" style="text-decoration:none;color: #fff" onclick="return confirm('Hapus Data ?')">
                                                      DELETE <i class="fa fa-remove fa-fw"></i>
                                                  </a>
                                              </td> -->
                                          </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
  