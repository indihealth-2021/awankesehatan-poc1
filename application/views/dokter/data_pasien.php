
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" >Data Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div>
            </div>
            <div class="card-body">
              <form action""="" method="post" >                     
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label>Tanggal : </label>
                      <input  readonly class="form-control" placeholder="08/06/2020" name="tanggal" value="">
                    </div>
                      </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Jadwal : </label>
                        <input readonly  class="form-control" placeholder="08.00 - 12.00" name="jadwal" value="">
                      </div>
                    </div>  
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Nama Dokter : </label>
                        <input  class="form-control" placeholder="Siapa Ya" name="nm_dokter" value="">
                      </div>
                    </div>           
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label>No RM : </label>
                          <input readonly  class="form-control" placeholder="00.12.34.56" name="norm" value="">
                      </div>  
                    </div>  
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>No. Register : </label>
                        <input readonly class="form-control" placeholder="No Register" name="Telpon" value="">
                    </div>
                    </div>  
                  </div>
                  <div class="form-group">
                    <label>Nama Pasien : </label>
                    <input readonly class="form-control" placeholder="Hanissa Dwi Safitri" name="Nama" value="">
                  </div>
                    <div class="form-group">
                        <label>Tgl Lahir / Usia : </label>
                        <input readonly class="form-control" type="" placeholder="01/01/2000 (20 Tahun)" value="">
                    </div>
                    <div class="form-group">
                        <label>Alamat : </label>
                        <textarea readonly class="form-control" rows="3" name="Alamat"></textarea>
                    </div>    
                    <div class="form-group">
                        <label>No. Telfon : </label>
                        <input readonly class="form-control" placeholder="NO Telpon" name="Telpon" value="">
                    </div>
                    
                    <div class="form-group">
                        <label>Keluhan : </label>
                        <textarea class="form-control" rows="3" placeholde="" name="keluhan"></textarea>
                    </div>
                    <div class="row">
                      <div class="col-lg-3">
                      <div class="form-group">
                        <center>
                        <a href="<?php echo base_url('dokter/Teleconsultasi/proses_teleconsultasi');?>" style="text-decoration:none;color: #fff">
                        <button type="button" class="form-control" style="text-align:center; align-content:right;background-color: #007bff" width="10%">PANGGIL
                        <i class="fas fa-phone"></i>
                        </a>  
                        </button> 
                        </center>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <center>
                        <a href="<?php echo base_url('dokter/Dashboard');?>" style="text-decoration:none;color: #fff">
                        <button type="button" class="form-control" style="text-align:center; align-content:right;background-color: #007bff" width="10%">KEMBALI
                        </a>  
                        </button> 
                        </center>
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

  
