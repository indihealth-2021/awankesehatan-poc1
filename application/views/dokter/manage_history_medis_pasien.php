<!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/HistoryMedisPasien/index/all');?>"class="text-black font-bold-7">Rekam Medis<a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Rekam Medis</h3>
          </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <div class="bg-tab p-3">
              <div class="row p-2 mb-3">
                    <div class="col-md-9">
                      <span>Pemeriksa : <?php echo $user->name ?></span><br>
                      <span>Poli : <?php echo $dokter->poli ?> </span>
                    </div>
                    <div class="col-md-3 p-2">
                        <div class="box">
                            <div class="container-1 ">
                                <span class="icon"><i class="fa fa-search font-16"></i></span>
                                <input type="search" id="search" placeholder="Cari Pasien Disini" />
                            </div>
                        </div>
                    </div>
                </div>
              <div class="table-responsive">
                <table class="table table-border table-hover custom-table mb-0" id="table_medrec">
                    <thead class="text-tr">
                        <tr class="text-center">
                            <th class="text-left">No</th>
                            <th>Nama Pasien</th>
                            <th>No Rekam Medis</th>
                            <th>Tanggal Konsultasi</th>
                            <th>Diagnosa</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="font-14">
                        <?php foreach($list_rekam_medis as $idx => $rekam_medis){?>
                          <tr class="text-center">
                              <?php
                              $rekam_medis->no_medrec = str_split($rekam_medis->no_medrec, "2");
                              $rekam_medis->no_medrec = implode('.',$rekam_medis->no_medrec);
                              ?>
                              <td><?php echo $idx+1 ?></td>
                              <td class="text-left" width="18%"><img width='28' height='28' src="<?php echo $rekam_medis->foto_pasien ? base_url('assets/images/users/'.$rekam_medis->foto_pasien):base_url('assets/dashboard/img/user.jpg')?>" class='rounded-circle m-r-5' alt=''>
                                <div class='ml-5' style='margin-top:-20px;'><?php echo $rekam_medis->nama_pasien ?></div></td>
                              <td class="text-center"><?php echo $rekam_medis->no_medrec ?></td>
                              <td>
                                <?php $tanggal_konsul = $rekam_medis->tanggal_konsultasi ? (new DateTime($rekam_medis->tanggal_konsultasi))->format('d-m-Y H:i:s'):'-'; 
                                                    echo $tanggal_konsul;
                                ?>  
                              </td>
                              <td class="text-left" width="20%"><?php echo '('.$rekam_medis->diagnosis_code.') '.$rekam_medis->diagnosis ?></td>
                              <td class="text-center"><a href="<?php echo base_url('dokter/HistoryMedisPasien/detail?id_jadwal_konsultasi='.$rekam_medis->id_jadwal_konsultasi.'&id_pasien='.$rekam_medis->id_pasien) ?>" class="text-detail font-14">Lihat Detail</a></td>
                          </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
          </div>
        </div>
         
      </div>
    </div>
  </div>