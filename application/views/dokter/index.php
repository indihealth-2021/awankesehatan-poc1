  <!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <p class="font-18">Hallo,</p>
            <p class="font-24">Selamat Datang, <?php echo $user->name ?></p>
          </div>
      </div> 

      <div class="d-mobile-none">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-dash-dokter">
              <div class="row mx-auto">
                <a href="<?php echo base_url('dokter/Teleconsultasi') ?>">
                  <div class="dash-box-dokter" style="padding: 13px">
                    <div class="d-inline-flex">
                      <!-- <div class="dash-icon mx-auto my-auto">
                        <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
                      </div> -->
                      <div class="my-auto">
                        <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-registration.png');?>">
                      </div>
                      <div class="mx-3 mt-3">
                        <p class="font-16 my-2 text-black">Jadwal Konsultasi</p>
                        <p class="font-14 text-dash">Lihat Jadwal</p>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="<?php echo base_url('dokter/Jadwal');?>">
                  <div class="dash-box-dokter" style="padding: 13px">
                    <div class="d-inline-flex">
                      <!-- <div class="dash-icon mx-auto my-auto">
                        <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
                      </div> -->
                      <div class="my-auto">
                        <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-dokter.png');?>">
                      </div>
                      <div class="mx-3 mt-3">
                        <p class="font-16 my-2 text-black">Jadwal Dokter</p>
                        <p class="font-14 text-dash">Lihat Jadwal</p>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="<?php echo base_url('dokter/SelfAssesment/verification');?>">
                  <div class="dash-box-dokter" style="padding: 13px">
                    <div class="d-inline-flex">
                      <!-- <div class="dash-icon mx-auto my-auto">
                        <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
                      </div> -->
                      <div class="my-auto">
                        <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-cardbon.png');?>">
                      </div>
                      <div class="mx-3 mt-3">
                        <p class="font-16 my-2 text-black">Assesment Pasien</p>
                        <p class="font-14 text-dash">Lihat Disini</p>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="<?php echo base_url('dokter/HistoryMedisPasien/index/all');?>">
                  <div class="dash-box-dokter" style="padding: 13px">
                    <div class="d-inline-flex">
                      <!-- <div class="dash-icon mx-auto my-auto">
                        <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
                      </div> -->
                      <div class="my-auto">
                        <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-medrec.png');?>">
                      </div>
                      <div class="mx-3 mt-3">
                        <p class="font-16 my-2 text-black">Rekam Medis</p>
                        <p class="font-14 text-dash">Lihat Rekam Medis</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card card-jadwal-tele-dokter p-1">
              <div class="">
                  <div class="p-3">
                      <h4 class="d-inline-block font-18">Jadwal Telekonsultasi </h4> <a href="<?php echo base_url('dokter/Teleconsultasi') ?>" style="color: #01a9ac;" class="float-right font-14">Lihat Jadwal</a>
                  </div>
                  <div class=" mb-3">
                      <div class="table-responsive">
                          <table class="table mb-0 new-patient-table font-14">
                            <thead class="text-center" style="border-bottom: 3px solid #01a9ac;">
                              <th>No.</th>
                              <th>Pasien</th>
                              <th>Tanggal Konsultasi</th>
                              <th>Hari Konsultasi</th>
                              <th>Jam</th>
                            </thead>
                            <tbody>
                            <?php foreach($list_jadwal_konsultasi as $idx=>$jadwal_konsultasi){ ?>
                              <tr class="font-14">
                                <td><?php echo $idx+1 ?></td>
                                <td><?php echo ucwords($jadwal_konsultasi->nama_pasien) ?></td>
                                <td class="text-center"><?php echo (new DateTime($jadwal_konsultasi->tanggal))->format('d-m-Y') ?></td>
                                <?php 
                                          $day_eng = (new DateTime($jadwal_konsultasi->tanggal))->format('D');
                                          if($day_eng == 'Mon'){
                                            $day_ind = 'Senin';
                                          }else if($day_eng == 'Tue'){
                                            $day_ind = 'Selasa';
                                          }else if($day_eng == 'Wed'){
                                            $day_ind = 'Rabu';
                                          }else if($day_eng == 'Thu'){
                                            $day_ind = 'Kamis';
                                          }else if($day_eng == 'Fri'){
                                            $day_ind = 'Jum\'at';
                                          }else if($day_eng == 'Sat'){
                                            $day_ind = 'Sabtu';
                                          }else if($day_eng == 'Sun'){
                                            $day_ind = 'Minggu';
                                          }else{
                                            $day_ind = 'Unkown';
                                          }
                                ?>
                                <td class="text-center"><?php echo $day_ind ?></td>
                                <td class="text-center"><?php echo $jadwal_konsultasi->jam.' - '.(new DateTime($jadwal_konsultasi->jam))->modify('+30 Minutes')->format('H:i').' WIB' ?></td>
                              </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="card card-jadwal-tele-dokter p-1">
              <div class="">
                  <div class="px-3 pt-3 mb-3">
                      <h4 class="d-inline-block font-18">Rekam Medis </h4> <a href="<?php echo base_url('dokter/HistoryMedisPasien/index/all');?>" style="color: #01a9ac;" class="float-right font-14">Lihat Detail</a>
                  </div>
                  <div class="mb-3">
                      <div class="table-responsive">
                          <table class="table mb-0 new-patient-table font-14">
                            <thead class="text-center" style="border-bottom: 3px solid #01a9ac;">
                              <th>No.</th>
                              <th>Pasien</th>
                              <th>Poli</th>
                              <th>Diagnosa</th>
                            </thead>
                            <tbody>
                            <?php foreach($list_rekam_medis as $idx=>$rekam_medis){ ?>
                              <tr>
                                <td><?php echo $idx+1 ?></td>
                                <td><?php echo ucwords($rekam_medis->nama_pasien) ?></td>
                                <td class="text-center"><?php echo $rekam_medis->poli ?></td>
                                <td class="text-center"><span title="<?php echo '('.$rekam_medis->diagnosis_code.') '.$rekam_medis->diagnosis ?>"><?php echo substr('('.$rekam_medis->diagnosis_code.') '.$rekam_medis->diagnosis, 0, 15).'...';?></span></td>
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
      </div>

      <div class="d-mobile-show">
        <div class="card card-dash-dokter">
          <div class="row">
            <div class="col-md-12">
              <a href="<?php echo base_url('dokter/Teleconsultasi') ?>">
                <div class="dash-box-dokter" style="padding: 13px">
                  <div class="d-inline-flex">
                    <div class="mx-auto">
                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-registration.png');?>">
                    </div>
                    <div class="mx-3 mt-3">
                      <p class="font-16 my-2 text-black">Jadwal Konsultasi</p>
                      <p class="font-14 text-dash">Lihat Jadwal</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
                
            <div class="col-md-12">
              <a href="<?php echo base_url('dokter/Jadwal');?>">
                <div class="dash-box-dokter" style="padding: 13px">
                  <div class="d-inline-flex">
                    <div class="mx-auto">
                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-dokter.png');?>">
                    </div>
                    <div class="mx-3 mt-3">
                      <p class="font-16 my-2 text-black">Jadwal Dokter</p>
                      <p class="font-14 text-dash">Lihat Jadwal</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
                
            <div class="col-md-12">
              <a href="<?php echo base_url('dokter/SelfAssesment/verification');?>">
                <div class="dash-box-dokter" style="padding: 13px">
                  <div class="d-inline-flex">
                    <div class="mx-auto">
                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-cardbon.png');?>">
                    </div>
                    <div class="mx-3 mt-3">
                      <p class="font-16 my-2 text-black">Assesment Pasien</p>
                      <p class="font-14 text-dash">Lihat Disini</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
                
            <div class="col-md-12">
              <a href="<?php echo base_url('dokter/HistoryMedisPasien/index/all');?>">
                <div class="dash-box-dokter" style="padding: 13px">
                  <div class="d-inline-flex">
                    <div class="my-auto">
                        <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-medrec.png');?>">
                      </div>
                    <div class="mx-3 mt-3">
                      <p class="font-16 my-2 text-black">Rekam Medis</p>
                      <p class="font-14 text-dash">Lihat Rekam Medis</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="mx-auto">
          <div class="card card-jadwal-tele-dokter">
              <div class="">
                  <div class="p-3">
                      <h4 class="d-inline-block font-18">Jadwal Telekonsultasi </h4> <a href="<?php echo base_url('dokter/Teleconsultasi') ?>" style="color: #01a9ac;" class="float-right font-14">Lihat Jadwal</a>
                  </div>
                  <div class=" mb-3">
                      <div class="table-responsive">
                          <table class="table mb-0 new-patient-table font-14">
                            <thead class="text-center" style="border-bottom: 3px solid #01a9ac;">
                              <th>No.</th>
                              <th>Pasien</th>
                              <th>Tanggal Konsultasi</th>
                              <th>Hari Konsultasi</th>
                              <th>Jam</th>
                            </thead>
                            <tbody>
                            <?php foreach($list_jadwal_konsultasi as $idx=>$jadwal_konsultasi){ ?>
                              <tr class="font-13">
                                <td><?php echo $idx+1 ?></td>
                                <td><?php echo ucwords($jadwal_konsultasi->nama_pasien) ?></td>
                                <td class="text-center"><?php echo (new DateTime($jadwal_konsultasi->tanggal))->format('d-m-Y') ?></td>
                                <?php 
                                          $day_eng = (new DateTime($jadwal_konsultasi->tanggal))->format('D');
                                          if($day_eng == 'Mon'){
                                            $day_ind = 'Senin';
                                          }else if($day_eng == 'Tue'){
                                            $day_ind = 'Selasa';
                                          }else if($day_eng == 'Wed'){
                                            $day_ind = 'Rabu';
                                          }else if($day_eng == 'Thu'){
                                            $day_ind = 'Kamis';
                                          }else if($day_eng == 'Fri'){
                                            $day_ind = 'Jum\'at';
                                          }else if($day_eng == 'Sat'){
                                            $day_ind = 'Sabtu';
                                          }else if($day_eng == 'Sun'){
                                            $day_ind = 'Minggu';
                                          }else{
                                            $day_ind = 'Unkown';
                                          }
                                ?>
                                <td class="text-center"><?php echo $day_ind ?></td>
                                <td class="text-center"><?php echo $jadwal_konsultasi->jam.' - '.(new DateTime($jadwal_konsultasi->jam))->modify('+30 Minutes')->format('H:i').' WIB' ?></td>
                              </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                      </div>
                  </div>
              </div>
            </div>
        </div>
            <div class="card card-jadwal-tele-dokter">
              
                  <div class="pt-3 px-2 mb-3">
                      <h4 class="d-inline-block font-18">Rekam Medis </h4> <a href="<?php echo base_url('dokter/HistoryMedisPasien/index/all');?>" style="color: #01a9ac;" class="float-right font-14">Lihat Detail</a>
                  </div>
                  <div class="mb-3">
                      <div class="table-responsive">
                          <table class="table mb-0 new-patient-table font-14">
                            <thead class="text-center" style="border-bottom: 3px solid #01a9ac;">
                              <th>No.</th>
                              <th>Pasien</th>
                              <th>Poli</th>
                              <th>Diagnosa</th>
                            </thead>
                            <tbody>
                            <?php foreach($list_rekam_medis as $idx=>$rekam_medis){ ?>
                              <tr class=" font-13">
                                <td><?php echo $idx+1 ?></td>
                                <td><?php echo ucwords($rekam_medis->nama_pasien) ?></td>
                                <td class="text-center"><?php echo $rekam_medis->poli ?></td>
                                <td class="text-center"><?php echo substr('('.$rekam_medis->diagnosis_code.') '.$rekam_medis->diagnosis, 0, 15);?></td>
                                <td class="text-center"><?php //echo '('.$rekam_medis->diagnosis_code.') '.$rekam_medis->diagnosis ?></td>
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