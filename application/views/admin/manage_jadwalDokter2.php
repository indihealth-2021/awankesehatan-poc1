
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #1F60A8; color: #fff">
              <h3 class="card-title">Data Jadwal Dokter</h3>
            </div>
            <!-- /.card-header -->
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-2">
                  <a href="<?php echo base_url('admin/Dokter/form_jadwalDokter') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="margin-left: 20px; margin-top: 20px; width: 155px"><i class="fa fa-plus"> Tambah Jadwal</i></a>
                </div>    
              </div>
            </div>
            
            <div class="card-body">
		<div class="table-responsive">
              <table id="table_jadwal_dokter" class="table table-bordered table-striped">
                <thead class="bg-dark-blue-menu">
                  <tr class="text-center">
                    <th class="text-white">No</th>
                    <th class="text-white">Dokter</th>
                    <th class="text-white">Poli</th>
  		              <th class="text-white">Hari</th>
                    <th class="text-white">Tanggal</th>
                    <th class="text-white">Waktu</th>
                    <th class="text-white">Aksi</th>
                  </tr>
                </thead>
                                    <tbody>
                                      <?php
                                        for($i = 0; $i<count($jadwal);$i++) {
                                      ?>
                                          <tr class="odd gradeX">   
					      <td style="text-align:center;vertical-align:middle"><?php echo $i+1; ?></td>                                         <td style="text-align:center;vertical-align:middle"><?php echo ucwords($jadwal[$i]->name) ?></td>
                                              <td style="text-align:center;vertical-align:middle"><?php echo $jadwal[$i]->poli ?></td>
                                              <td style="text-align:center;vertical-align:middle"><?php echo $jadwal[$i]->hari ?></td>
                                              <?php 
                                                if($jadwal[$i]->tanggal){
                                                  $tanggal = new DateTime($jadwal[$i]->tanggal);
                                                  $tanggal = $tanggal->format('d-m-Y');
                                                }
                                                else{
                                                  $tanggal = 'Jadwal Rutin';
                                                }
                                              ?>
                                              <td style="text-align:center;vertical-align:middle"><?php echo $tanggal; ?></td>
                                              <td style="text-align:center;vertical-align:middle"><?php echo $jadwal[$i]->waktu ?></td>
                                              <td class="center" style="text-align: center;">
                                                <div class="btn-group btn-group-sm">
                                                  <a href="<?php echo base_url('admin/Dokter/tampilEdit_jadwalDokter/'.$jadwal[$i]->id) ?>" class="btn btn-success"><i class="fas fa-edit "></i></a>
                                                  <a href="<?php echo base_url('admin/Dokter/hapus_jadwalDokter/'.$jadwal[$i]->id) ?>" class="btn btn-danger" onclick="return confirm('yakin hapus Jadwal?')"><i class="fas fa-trash"></i></a>
                                                </div>
                                              </td>
                                          </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="bg-dark-blue-menu">
                                      <tr class="text-center">
                                        <th class="text-white">No</th>
                                        <th class="text-white">Dokter</th>
                                        <th class="text-white">Poli</th>
                                        <th class="text-white">Hari</th>
                                        <th class="text-white">Tanggal</th>
                                        <th class="text-white">Waktu</th>
                                        <th class="text-white">Aksi</th>
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
  
<?php if($this->session->flashdata('msg_jadwal_dokter')){ echo "<script>alert('".$this->session->flashdata('msg_jadwal_dokter')."')</script>"; } ?>