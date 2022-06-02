
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #007bff;">
              <h3 class="card-title" >Data Telekonsultasi Pasien</h3>
            </div> 
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped"  >
                                    <thead style="background: #007bff; color: #fff">
                                        <tr>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Nama Pasien</th>
                                            <th style="text-align:center">Antrian</th>
                                            <th style="text-align:center">Status</th>
                                            <th style="text-align:center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <!--  <?php
                                     // $no=1;
                                     //  for( $i = 0; $i<count($antrian); $i++) { ?> -->
                                        <tr class="odd gradeX">                                            
                                            <td style="text-align:center;vertical-align:middle"><?php //echo $no++; ?></td>
                                            <td style="text-align:center;vertical-align:middle"><?php //echo $antrian[$i]->nama ?></td>
                                            <td style="text-align:center;vertical-align:middle"><?php //echo $antrian[$i]->antrian ?></td>
                                            <td style="text-align:center;vertical-align:middle"><?php //echo $antrian[$i]->status ?></td>
                                            <td class="center" style="text-align: center;">
                                            <button class="btn btn-info btn-block" >
                                                <a style="color: #fff;" href="<?php echo base_url('dokter/Teleconsultasi/proses_teleconsultasi/')//echo base_url(''.$data->id) ?>">Panggil</a>
                                            </button>
                                            </td>
                                        </tr>    
                                        <?php// } ?>                       
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
