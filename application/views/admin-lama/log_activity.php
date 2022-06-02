<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Log Activity </h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Log Activity</li>
                </ol>
            </nav>
          </div>
      </div>
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_log">
                <thead>
                <tr>
                  <th>No</th>
                  <th>IP</th>
                  <th>User Agent</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Activity</th>
            <th>Activity At</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($log_activities as $idx => $log_activity){
                        echo "<tr>";
                        echo "<td>".($idx+1)."</td>";
                        echo "<td>".$log_activity->ip."</td>";
                        echo "<td>".$log_activity->user_agent."</td>";
                        if($log_activity->id_user == $this->session->userdata('id_user')){
                            $username = "<b>".$log_activity->username."</b>";
                        }
                        else{
                            $username = $log_activity->username;
                        }
                        echo "<td>".$username."</td>";
                        if($log_activity->kategori_user == 0){
                            $role = 'Pasien';
                        }
                        else if($log_activity->kategori_user == 2){
                            $role = 'Dokter';
                        }
                        else if($log_activity->kategori_user == 5){
                            $role = 'Admin';
                        }
                        else{
                            $role = 'Unknown';
                        }
                        echo "<td>".$role."</td>";
                        echo "<td>".$log_activity->activity."</td>";
                        $tanggal = new DateTime($log_activity->activity_at);
                        $tanggal = $tanggal->format('d-m-Y H:i:s');
                        echo "<td>".$tanggal."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>IP</th>
                  <th>User Agent</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Activity</th>
            <th>Activity At</th>
                </tr>
                </tfoot>
              </table>
            </div>
              <div class="col-lg-12">
              <a href="<?php echo base_url('admin/HistoryLogActivity') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="float: right; margin-top: 20px; width: 140px">Kembali</a>
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
