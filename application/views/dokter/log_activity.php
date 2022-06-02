<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-12">
              <h4 class="page-title">Log Activity</h4>
          </div>
          <div class="col-sm-7 col-12">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Log Activity</li>
                </ol>
            </nav>
          </div>
      </div>                        
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table datatable mb-0">
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
                        echo "<td>".$log_activity->activity_at."</td>";
                        echo "</tr>";
                    }
                ?>
              </table>
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
