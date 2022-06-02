
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <!-- /.card -->
            <div class="card">
            <div class="card-header col-lg-12 " style="background-color: #1F60A8; color: #fff">
              <div class="card-title">Tambah Jadwal Telekonsultasi</div>
            </div>
              <form method="post" id="">
              <div class="card-body mt-3">
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label>Dokter</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <select class="form-control select2" style="width: 100%;" name="" id="">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label>Pasien</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <select class="form-control select2" style="width: 100%;" name="" id="">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Tanggal</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" onchange="setDay()">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-2 col-sm-6">
                      <label for="exampleInputEmail1">Waktu</label>
                    </div>
                    <div class="col-lg-4">
		                  <input type="time" class="form-control" name="waktu" id="waktu" onchange="setTime()">
	                 </div>	
                  </div>
                </div>
              </div>
              
              <!-- /.card-body -->
              <div class="col-lg-12">
              <div class="row mb-5 mt-4 justify-content-center">
                <div class="col-lg-4">
                  <button  class="btn btn-primary w-100" style="background-color: #1F60A8" id="">TAMBAH</button>
                </div>
                </form> 
                <div class="col-lg-4">
                  <a href="<?php echo base_url('admin/Admin');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
                </div>
              </div>	
              </div>
              
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
