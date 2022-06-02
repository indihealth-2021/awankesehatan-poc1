<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Profil') ?>" class="text-black">Pengaturan</a></li>
                    <li class="breadcrumb-item font-bold-7" aria-current="page"><a href="<?php echo base_url('admin/LogActivity') ?>" class="text-black">Log Activity</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Log Activity</h3>
          </div>
      </div>  
      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3 mb-3">
          <div class="box">
            <div class="container-1">
                <span class="icon"><i class="fa fa-search font-16"></i></span>
                <input type="search" id="search" placeholder="Cari Username Disini" />
            </div>
          </div> 
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-border table-hover custom-table mb-0" id="table_log">
                  <thead class="text-tr">
                    <tr >
                      <th>No</th>
                      <th>IP</th>
                      <th>User Agent</th>
                      <th>Username</th>
                      <th>Role</th>
                      <th>Activity</th>
                      <th>Activity At</th>
                    </tr>
                  </thead>
                  <tbody class="font-14">
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
  </div>
</div>
