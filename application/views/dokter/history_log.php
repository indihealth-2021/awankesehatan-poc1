<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-12">
              <h4 class="page-title">Riwayat Log Dokter</h4>
          </div>
          <div class="col-sm-7 col-12">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Log Dokter</li>
                </ol>
            </nav>
          </div>
      </div>                        
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_log">
      
                                    <thead>
                                        <tr>                                            
                                            <th>No</th>
                                            <th>Nama Dokter</th>
                                            <th>Nama Pasien</th>
                                            <th>Aktivitas</th>
					                       <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    					<?php foreach($list_history as $idx => $history){ ?>
                    					<tr>
                    						<td><?php echo $idx+1 ?></td>
                    						<td><?php echo $history->nama_dokter ?></td>
                    						<td><?php echo $history->nama_pasien ?></td>
                    						<td><?php echo $history->activity ?></td>
                                <?php
                                $tanggal = new DateTime($history->activity_at);
                                $tanggal = $tanggal->format('d-m-Y H:i:s');
                                ?>
                    						<td><?php echo $tanggal ?></td>
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
  
