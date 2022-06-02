  <!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
              <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/SelfAssesment/verification');?>"class="text-black font-bold-7">Assesment<a></li>
              </ol>
          </nav>
        </div>
        <div class="col-sm-12 col-12">
            <h3 class="page-title">Assesment Pasien</h3>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="bg-tab p-3">
                <div class="row p-4">
                  <div class="col-md-9"></div>
                  <div class="col-md-3">
                      <div class="box">
                          <div class="container-1 ">
                              <span class="icon"><i class="fa fa-search font-16"></i></span>
                              <input type="search" id="search" placeholder="Cari Pasien Disini" />
                          </div>
                      </div>
                  </div>
                </div>
                <div class="table-responsive font-14">
                  <table class="table table-border table-hover custom-table mb-0" id="table_assesment">
                      <thead class="text-tr">
                      <tr class="text-center">
                        <th class="text-left">No</th>
                        <th>Nama Pasien</th>
                        <th>Berat Badan (kg)</th>
                        <th>Tinggi Badan (cm)</th>
                        <th>Tekanan Darah (mmHg)</th>
                        <th>Suhu Tubuh (c)</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody class="text-center">
                        <?php
                            foreach($list_assesment as $idx=>$assesment) {
                          ?>
                          <tr>    
                              <td class="text-left"><?php echo $idx+1 ?></td>
                              <td class="text-left"><img width='28' height='28' src="<?php echo $assesment->foto_pasien ? base_url('assets/images/users/'.$assesment->foto_pasien):base_url('assets/dashboard/img/user.jpg')?>" class='rounded-circle m-r-5' alt=''><div class='ml-5' style='margin-top:-20px;'><?php echo $assesment->nama_pasien ?></div></td>
                              <td><?php echo $assesment->berat_badan ?></td>
                              <td><?php echo $assesment->tinggi_badan ?></td>
                              <td><?php echo $assesment->tekanan_darah ?></td>
                              <td><?php echo $assesment->suhu ?></td>
                              <td><a href="<?php echo base_url('dokter/SelfAssesment/detail/'.$assesment->id);?>" class="text-detail font-14">Lihat Detail</a></td>
                          </tr>
                          <?php } ?> 
                      </tbody>
                  </table>
                </div>
            </div>     
          </div>
        </div> 

    </div>
  </div>    