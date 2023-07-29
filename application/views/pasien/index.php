<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-12 col-12 ">
        <p class="font-18">Hallo,</p>
        <?php $vip_span = '<br><br><span class="btn btn-warning" style="color: white; font-weight: bolder;">⭐ Layanan VIP</span>'?>
        <p class="font-24">Selamat Datang, <?php echo $user->name ?> <?= $user->vip ? $vip_span : "" ?> </p>
      </div>
    </div>
    <div class="d-mobile-none">
      <div class="row">
        <div class="col-lg-9">
          <div class="card card-dash-pasien">
            <div class="row mx-auto">
              <a href="<?php echo base_url('pasien/Pendaftaran?poli=&hari=all') ?>">
                <div class="dash-box" style="padding: 13px">
                  <div class="d-inline-flex">
                    <!-- <div class="dash-icon mx-auto my-auto">
                      <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
                    </div> -->
                    <div class="my-auto">
                        <img src="<?php echo base_url('assets/dashboard/img/pngicon/dash-registration.png');?>">
                      </div>
                    <div class="mx-3 mt-3">
                      <p class="font-16 my-2 text-black">Pendaftaran</p>
                      <p class="font-14 text-dash">Daftar Disini</p>
                    </div>
                  </div>
                </div>
              </a>

              <a href="<?php echo base_url('pasien/Dokter/jadwal') ?>">
                <div class="dash-box" style="padding: 13px">
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

              <a href="<?php echo base_url('pasien/HistoryMedis') ?>">
                <div class="dash-box" style="padding: 13px">
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
          <div class="card card-jadwal-tele p-3">
            <div class="">
              <div class="p-3">
                <h4 class="d-inline-block font-18">Jadwal Telekonsultasi </h4> <a href="<?php echo base_url('pasien/Telekonsultasi/jadwal') ?>" style="color: #01A9AC;" class="float-right font-14">Lihat Jadwal</a>
              </div>
              <div class=" mb-3">
                <div class="table-responsive">
                  <table class="table mb-0 new-patient-table font-14">
                    <thead class="text-center" style="border-bottom: 3px solid #01A9AC;">
                      <th>No.</th>
                      <th>Nama Dokter</th>
                      <th>Tanggal Konsultasi</th>
                      <th>Hari Konsultasi</th>
                      <th>Jam</th>
                    </thead>
                    <tbody>
                      <?php foreach ($list_jadwal_konsultasi as $idx => $jadwal_konsultasi) { ?>
                        <?php
                        $tanggal = new DateTime($jadwal_konsultasi->tanggal);
                        $hari = $tanggal->format('D');
                        switch ($hari) {
                          case 'Mon':
                            $hari = 'Senin';
                            break;
                          case 'Tue':
                            $hari = 'Selasa';
                            break;
                          case 'Wed':
                            $hari = 'Rabu';
                            break;
                          case 'Thu':
                            $hari = 'Kamis';
                            break;
                          case 'Fri':
                            $hari = "Jum'at";
                            break;
                          case 'Sat':
                            $hari = 'Sabtu';
                            break;
                          case 'Sun':
                            $hari = 'Minggu';
                            break;
                          default:
                            $hari = '';
                            break;
                        }
                        ?>
                        <tr>
                          <td><?php echo $idx + 1 ?></td>
                          <td>
                            <span title="<?php echo $jadwal_konsultasi->nama_dokter?>"><?php echo ucwords(substr($jadwal_konsultasi->nama_dokter, 0, 15)) ?></span><br>
                            <span class="text-abu"><?php echo ucwords($jadwal_konsultasi->poli) ?></span>
                          </td>
                          <td class="text-center"><?php echo $tanggal->format('d-m-Y'); ?></td>
                          <td class="text-center"><?php echo $hari ?></td>
                          <td class="text-center"><?php echo $jadwal_konsultasi->jam . ' WIB' ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3" style="padding: 0px;">
          <div class="card card-shadow">
            <div class="p-2" style="border-bottom: 3px solid #01A9AC;">
              <h4 class="d-inline-block font-14 pt-3">Jadwal Terdaftar </h4> <a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>" class="float-right font-14 text-dash pt-3 pr-2">Lihat Detail</a>
            </div>
            <?php foreach ($list_jadwal_terdaftar as $idx => $jadwal_terdaftar) { ?>
              <?php
              $jadwal_terdaftar->tanggal = $jadwal_terdaftar->tanggal ? $jadwal_terdaftar->tanggal : 'Jadwal Rutin';
              if ($jadwal_terdaftar->id_status_pembayaran == 2) {
                $button = "Sedang Diproses";
              } else if ($jadwal_terdaftar->id_status_pembayaran == 1) {
                $button = "Lunas";
              } else {
                $button =   "Belum Bayar";
              }
              ?>
              <div class="d-inline-flex pt-3">
                <div class="col-md-4">
                  <span class="font-12" title="<?php echo $jadwal_terdaftar->nama_dokter ?>"><?php echo ucwords(substr($jadwal_terdaftar->nama_dokter, 0, 10)) ?></span><br>
                  <span class="font-10 text-abu"><?php echo $jadwal_terdaftar->poli ?></span>
                </div>
                <div class="col-md-4">
                  <span class="font-12"><?php echo $jadwal_terdaftar->hari ?></span><br>
                  <span class="font-10"><?php echo $jadwal_terdaftar->tanggal ?></span>
                </div>
                <div class="col-md-3 pt-1">
                  <a href="<?php echo base_url('pasien/Pembayaran/?regid='.$jadwal_terdaftar->id) ?>"><button class="btn-terdaftar"><?php echo $button ?></button></a>
                </div>
              </div>
            <?php } ?>
          </div>
          <a href="<?php echo base_url('pasien/Assesment/menu_assesment') ?>"><button style="cursor: pointer" class="btn-block btn-assesment">Lihat Assesment Saya</button></a>
        </div>
      </div>
    </div>

    <div class="d-mobile-show">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-dash-pasien">
            <div class="row">
              <div class="col-md-12">
                <a href="<?php echo base_url('pasien/Pendaftaran?poli=&hari=all') ?>">
                  <div class="dash-box" style="padding: 13px">
                    <div class="d-inline-flex">
                      <div class="dash-icon mx-auto my-auto">
                        <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
                      </div>
                      <div class="mx-3 mt-3">
                        <p class="font-16 my-2 text-black">Pendaftaran</p>
                        <p class="font-14 text-dash">Daftar Disini</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-md-12">
                <a href="<?php echo base_url('pasien/Dokter/jadwal') ?>">
                  <div class="dash-box" style="padding: 13px">
                    <div class="d-inline-flex">
                      <div class="dash-icon mx-auto my-auto">
                        <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
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
                <a href="<?php echo base_url('pasien/HistoryMedis') ?>">
                  <div class="dash-box" style="padding: 13px">
                    <div class="d-inline-flex">
                      <div class="dash-icon mx-auto my-auto">
                        <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
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
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-shadow">
            <div class="p-3" style="border-bottom: 3px solid #01A9AC;">
              <h4 class="d-inline-block font-14">Jadwal Terdaftar </h4> <a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>" class="float-right font-14 text-dash">Lihat Detail</a>
            </div>
            <?php foreach ($list_jadwal_terdaftar as $idx => $jadwal_terdaftar) { ?>
              <?php
              $jadwal_terdaftar->tanggal = $jadwal_terdaftar->tanggal ? $jadwal_terdaftar->tanggal : 'Jadwal Rutin';
              if ($jadwal_terdaftar->id_status_pembayaran == 2) {
                $button = "Sedang Diproses";
              } else if ($jadwal_terdaftar->id_status_pembayaran == 1) {
                $button = "Lunas";
              } else {
                $button =   "Belum Bayar";
              }
              ?>
              <div class="d-inline-flex font-14 pt-3">
                <div class="col-md-4">
                  <span><?php echo ucwords($jadwal_terdaftar->nama_dokter) ?></span><br>
                  <span class="text-abu"><?php echo $jadwal_terdaftar->poli ?></span>
                </div>
                <div class="col-md-4">
                  <span><?php echo $jadwal_terdaftar->hari ?></span><br>
                  <span><?php echo $jadwal_terdaftar->tanggal ?></span>
                </div>
                <div class="col-md-4">
                  <button class="btn-terdaftar"><?php echo $button ?></button>
                </div>
              </div>
            <?php } ?>
          </div>
          <div class="mb-5">
            <a href="<?php echo base_url('pasien/Assesment/menu_assesment') ?>"><button style="cursor: pointer" class="btn-assesment">Lihat Assesment Saya</button></a>  
          </div>
        </div>
      </div>
        
      <div class="row">
        <div class="col-md-12">
          <div class="card card-jadwal-tele p-3">
            <div class="">
              <div class="p-3">
                <h4 class="d-inline-block font-18">Jadwal Telekonsultasi </h4> <a href="<?php echo base_url('pasien/Telekonsultasi/jadwal') ?>" style="color: #01A9AC;" class="float-right font-14">Lihat Jadwal</a>
              </div>
              <div class=" mb-3">
                <div class="table-responsive">
                  <table class="table mb-0 new-patient-table font-14">
                    <thead class="text-center" style="border-bottom: 3px solid #01A9AC;">
                      <th>No.</th>
                      <th>Nama Dokter</th>
                      <th>Tanggal Konsultasi</th>
                      <th>Hari Konsultasi</th>
                      <th>Jam</th>
                    </thead>
                    <tbody>
                      <?php foreach ($list_jadwal_konsultasi as $idx => $jadwal_konsultasi) { ?>
                        <?php
                        $tanggal = new DateTime($jadwal_konsultasi->tanggal);
                        $hari = $tanggal->format('D');
                        switch ($hari) {
                          case 'Mon':
                            $hari = 'Senin';
                            break;
                          case 'Tue':
                            $hari = 'Selasa';
                            break;
                          case 'Wed':
                            $hari = 'Rabu';
                            break;
                          case 'Thu':
                            $hari = 'Kamis';
                            break;
                          case 'Fri':
                            $hari = "Jum'at";
                            break;
                          case 'Sat':
                            $hari = 'Sabtu';
                            break;
                          case 'Sun':
                            $hari = 'Minggu';
                            break;
                          default:
                            $hari = '';
                            break;
                        }
                        ?>
                        <tr>
                          <td><?php echo $idx + 1 ?></td>
                          <td>
                            <span><?php echo ucwords($jadwal_konsultasi->nama_dokter) ?></span><br>
                            <span class="text-abu"><?php echo ucwords($jadwal_konsultasi->poli) ?></span>
                          </td>
                          <td class="text-center"><?php echo $tanggal->format('d-m-Y'); ?></td>
                          <td class="text-center"><?php echo $hari ?></td>
                          <td class="text-center"><?php echo $jadwal_konsultasi->jam . ' WIB' ?></td>
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
    
  </div>
</div>

<style>
  .col-md-4 {
    padding-right: 0px!important;
    padding-left: 15px!important;
  }
  .col-md-3 {
    padding: 0px;
  }
</style>