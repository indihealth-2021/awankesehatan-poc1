
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #007bff;">
              <h3 class="card-title">Data Antrian Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="col-sm-6">
                  <a href="<?php echo base_url('dokter/Dashboard') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="margin-left: 0; margin-bottom: 20px; width: 140px">Kembali</a>
                </div>    
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Antrian</th>
                  <th>ID Pasien</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; 
                  foreach ($antrian as $data) {
                    $no++?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->antrian ?></td>
                      <td><?php echo $data->status ?></td>
                      <!-- 
                      <td class="center" style="text-align: center;">
                        <div class="btn-group btn-group-sm">
                          <a href="<?php echo site_url('dokter/News/lihat/'.$data->id) ?>" class="btn btn-success" onclick="return confirm('Lihat Data?')"><i class="fas fa-eye "></i></a>
                      </td> -->
                    </tr>
                    <?php }?>
                </tbody>
                </tfoot>
              </table>
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
