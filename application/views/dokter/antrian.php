
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #1F60A8; color: #fff">
              <h3 class="card-title">Antrian Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                
                                <table id="example1" class="table table-bordered table-striped display">
                                    <thead class="bg-dark-blue-menu" style="color: #fff">
                                        <tr>                                            
                                            <th class="text-white" style="text-align:center">No</th>
                                            <th class="text-white" style="text-align:center">Nama Pasien</th>
                                            <th class="text-white" style="text-align:center">Antrian</th>
                                            <th class="text-white" style="text-align:center">Status</th>
                                            <!-- <th style="text-align:center">-</th>
                                            <th style="text-align:center">-</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php                                         
                                        if(count($list_antrian) > 0){
                                            foreach($list_antrian as $idx => $antrian){
                                                if($antrian->status == 1){
                                                    $aksi = 'Sedang Konsultasi';
                                                }
                                                else{
                                                    $aksi = 'Sedang Antri';
                                                }

                                                echo "<tr class='odd gradeX'>";
                                                echo "<td>".($idx+1)."</td>";
                                                echo "<td>".ucwords($antrian->nama_pasien)."</td>";
                                                echo "<td>".$antrian->antrian."</td>";
                                                echo "<td>".$aksi."</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
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
                                    </tbody>
                                    <tfoot class="bg-dark-blue-menu" style="color: #fff">
                                        <tr>                                            
                                            <th class="text-white" style="text-align:center">No</th>
                                            <th class="text-white" style="text-align:center">Nama Pasien</th>
                                            <th class="text-white" style="text-align:center">Antrian</th>
                                            <th class="text-white" style="text-align:center">Status</th>
                                            <!-- <th style="text-align:center">-</th>
                                            <th style="text-align:center">-</th> -->
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="col-lg-12">
                                  <a href="<?php echo base_url('dokter/Dashboard') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="float: right; margin-top: 20px; width: 140px">Kembali</a>
                                </div> 
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

  <?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>
