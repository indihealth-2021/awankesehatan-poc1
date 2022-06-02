<!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
              <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/Jadwal');?>"class="text-black font-bold-7">Jadwal Dokter<a></li>
              </ol>
          </nav>
        </div>
        <div class="col-sm-12 col-12">
            <h3 class="page-title">Jadwal Dokter</h3>
        </div>
      </div>

      <div class="row">
        <?php
          for($i = 0; $i<count($jadwal);$i++) {
        ?>
        <?php 
          $waktu_awal = str_replace('0', '', explode(':',rtrim(explode('-',$jadwal[$i]->waktu)[0]))[0]);
          switch(true){
            case $waktu_awal >= 4 && $waktu_awal < 10:
              $waktu = 'Pagi';
              break;
            case $waktu_awal >= 10 && $waktu_awal < 14;
              $waktu = 'Siang';
              break;
            case $waktu_awal >= 14 && $waktu_awal < 18:
              $waktu = 'Sore';
              break;
            case $waktu_awal >= 18 && $waktu_awal < 4:
              $waktu = 'Malam';
              break;
            default:
              $waktu = '';
              break;
          }
        ?>
        <div class="col-md-4">
          <div class="card card-jadwal-dokter p-4">
            <div class="row px-3">
              <div class="px-2 col-md-4 col-4 border-<?php echo strtolower($waktu); ?>">
                <p class="mt-4 font-16 font-bold-4"><?php echo $waktu ?></p>
              </div>
              <div class="col-md-8 col-8 text-right">
                <?php 
                  if($jadwal[$i]->tanggal){
                    $tanggal = new DateTime($jadwal[$i]->tanggal);
                    $tanggal = $tanggal->format('d-m-Y');
                  }
                  else{
                    $tanggal = 'Jadwal Rutin';
                  }
                ?>
                <span class="jd-<?php echo strtolower($waktu); ?>"><?php echo $tanggal; ?></span><br><br>
                <span class="font-16 pt-1"><?php echo $jadwal[$i]->hari ?></span><br>
                <span class="font-14 font-bold-7"><?php echo $jadwal[$i]->waktu ?> WIB</span>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>