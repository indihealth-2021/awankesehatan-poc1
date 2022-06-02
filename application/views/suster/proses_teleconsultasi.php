  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proses Teleconsultasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Proses Teleconsultasi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" >Data Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="post" >                     
                <div class="col-lg-12">
                  <div class="row">
                  <div class="col-lg-6">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Tanggal : </label>
                        <input  readonly class="form-control" placeholder="08/06/2020" name="tanggal" value="">
                      </div>
                    </div>  
                    <div class="col-lg-12">
                      <pre>
                      Berat Badan     : 60 Kg
                      Tinggi Badan    : 175 Cm
                      Tekanan Darah   : 110 / 100
                      Suhu Badan      : 36,5 Celcius
                      Merokok         : Tidak
                      Minum Alkohol   : Tidak
                      Kecelekaan      : Tidak Pernah
                      Operasi         : Tidak Pernah
                      Pernah Dirawat  : Tidak Pernah
                    </pre>  
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Keluhan : </label>
                        <textarea class="form-control" rows="3" placeholde="" name="keluhan"></textarea>
                      </div>  
                    </div>
                      <div class="col-lg-12">
                      <div class="form-group">
                        <label>Resep : </label>
                        <input class="form-control" placeholder="Masukan Resep" name="resep" value="">
                      </div>  
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Tindak Lanjut : </label>
                        <textarea class="form-control" rows="3" placeholde="" name="tindaklanjut"></textarea>
                      </div>  
                    </div>                  
                  </div>  
                  <!-- /.col-lg-6 (nested) -->
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label>No RM : </label>
                          <input readonly  class="form-control" placeholder="00.12.34.56" name="norm" value="">
                      </div>  
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Nama Pasien : </label>
                        <input readonly class="form-control" placeholder="Hanissa Dwi Safitri" name="Nama" value="">
                      </div>  
                    </div>
                    <!-- <div class="col-lg-6 card">
                      <div class="conference-area">
                        <div class="videocall">
                            <div class="video-container">
                                <video id="video-other" autoplay></video>
                                <video id="video-me" autoplay></video>
                            </div>
                        </div>
                        <div class="conference-tools">
                            <ul>
                                <li id="recStart"><img src="<?php echo base_url('assets/telemedicine/img/icon-record.png'); ?>"></li>
                                <li id="recStop"><img src="<?php echo base_url('assets/telemedicine/img/icon-stop.png'); ?>"></li>
                                <li id="download"><img src="<?php echo base_url('assets/telemedicine/img/download.png'); ?>"></li>
                                <li id="mic"><img src="<?php echo base_url('assets/telemedicine/img/mic.png'); ?>"></li>
                                <li id="unmic"><img src="<?php echo base_url('assets/telemedicine/img/mute.png'); ?>"></li>             
                                <li id="uncam"><img src="<?php echo base_url('assets/telemedicine/img/icon-camera.png'); ?>"></li>
                                <li id="cam"><img src="<?php echo base_url('assets/telemedicine/img/icon-camera.png'); ?>"></li>
                                <li class="durasi-conference">Durasi: <span id="durasi-waktu-conference">00:00</span></li>
                                <li id="btn-stop"><img src="<?php echo base_url('assets/telemedicine/img/icon-endcall.png'); ?>"></li>
                                <li id="btn-chat"><img src="<?php echo base_url('assets/telemedicine/img/icon-chat.png'); ?>"></li>
                                <li id="full"><img src="<?php echo base_url('assets/telemedicine/img/icon-fullscreen.png'); ?>"></li>
                                <li id="back"><img src="<?php echo base_url('assets/telemedicine/img/exit.png'); ?>"></li>
                            </ul>
                        </div>
                    </div> -->
                   </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <center>
                        <a href="<?php echo base_url('dokter/Teleconsultasi/teleconsultasi_pasien');?>" style="text-decoration:none;color: #fff">
                        <button type="button" class="form-control" style="text-align:center; align-content:right;background-color: red" width="10%">TUTUP
                        
                        </a>  
                        </button> 
                        </center>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                  <!-- /.col-lg-6 (nested) -->
              </form>
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
  </div>
  <!-- /.content-wrapper -->
  