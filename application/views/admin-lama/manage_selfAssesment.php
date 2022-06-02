
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Assesment Pasien</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Assesment Pasien</li>
                </ol>
            </nav>
          </div>
      </div>
            
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_assesment">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Berat Badan</th>
                    <th>Tinggi Badan</th>
                    <th>Tekanan Darah</th>
                    <th>Suhu</th>
                    <th>Keluhan</th>
                    <!-- <th class="text-white text-center">Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
			<?php $no = 0; 
                  foreach ($data as $assesment) {
                    $no++?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $assesment->nama_pasien; ?></td>
                      <td><?php echo $assesment->nama_dokter.' ( '.$assesment->poli.' )'; ?></td>
		                  <td><?php echo $assesment->berat_badan; ?></td>
                      <td><?php echo $assesment->tinggi_badan; ?></td>
		                  <td><?php echo $assesment->tekanan_darah; ?></td>
		                  <td><?php echo $assesment->suhu; ?></td>
		                  <td><?php echo $assesment->keluhan; ?></td>
                      <!-- <td class="center" style="text-align: center;">
                        <div class="btn-group btn-group-sm">
                          <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          <a href="#" class="btn btn-success"><i class="fas fa-edit "></i></a>
                          <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </div>
                      </td> -->
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Berat Badan</th>
                    <th>Tinggi Badan</th>
                    <th>Tekanan Darah</th>
					<th>Suhu</th>
                    <th>Keluhan</th>
                    <!-- <th class="text-white text-center">Aksi</th> -->
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
  
