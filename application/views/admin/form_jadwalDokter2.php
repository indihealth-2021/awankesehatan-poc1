
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <!-- /.card -->
            <div class="card">
            <div class="card-header col-lg-12 " style="background-color: #1F60A8; color: #fff">
              <div class="card-title">Tambah Jadwal Dokter</div>
            </div>
            <!-- <div class="text-center p-2">
              <label><input type="radio" name="colorRadio" value="rutin" checked> Rutin</label>
              <label><input type="radio" name="colorRadio" value="khusus"> Khusus</label>
            </div> -->
            <!--<div class="rutin box">
              <h1>a</h1>
            </div>
            <div class="khusus box">
              <h1>b</h1>
            </div>-->
            
            <div class="card-body mt-3">
            <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Jadwal</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label><input type="radio" name="colorRadio" value="rutin" checked> Rutin</label>
                      <label><input type="radio" name="colorRadio" value="khusus"> Khusus</label>
                    </div>
                  </div>
                </div>
              <div class="rutin box">
              <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/addJadwalDokter'); ?>">
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label>Dokter</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <select class="form-control select2" style="width: 100%;" name="id_dokter" id="id_dokter" required>
                        <?php foreach ($dokter as $user) { ?>
                        <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Hari</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                     <!-- <input type="text" class="form-control" name="hari" id="hari" readonly> -->
                     <select class="form-control select2" style="width: 100%;" name="hari" id="hari" required>
      
                        <option value="Senin" selected="selected">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jum'at">Jum'at</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!--<div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Tanggal</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" onchange="setDay()" required>
                    </div>
                  </div>
                </div>-->
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-2 col-sm-6">
                      <label for="exampleInputEmail1">Waktu</label>
                    </div>
                    <div class="col-lg-4">
	                    <div class="row">
		                    <div class="col-lg-5">
		                      <input type="time" class="form-control" name="waktu1" id="waktu" onchange="setTime()" required>
		                    </div>
		                    <div  class="col-lg-2" align="center" style="padding-top: 5px">
		                    	<label >s/d</label>
		                    </div>
		                    <div class="col-lg-5">
		                      <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" required>
		                    </div>	
	                    </div>
	                    </div>	
                    </div>
                </div>
              <!-- /.card-body -->
              <div class="col-lg-12">
              <div class="row mb-5 mt-4 justify-content-center">
                <div class="col-lg-4 mb-3">
                  <button class="btn btn-primary w-100" style="background-color: #1F60A8" id="btn-add-jadwalDokter">TAMBAH</button>
                </div>
                <div class="col-lg-4">
                  <a href="<?php echo base_url('admin/Dokter/jadwal_dokter');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
                </div>
              </div>	
              </div>
              </form>
            </div>
            </div>
            <div class="card-body" style="margin-top:-40px ">
              <div class="khusus box">
              <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/addJadwalDokter'); ?>">
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label>Dokter</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <select class="form-control select2" style="width: 100%;" name="id_dokter" id="id_dokter" required>
                        <?php foreach ($dokter as $user) { ?>
                        <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <!--<div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Hari</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">-->
                     <!-- <input type="text" class="form-control" name="hari" id="hari" readonly> -->
                     <!--<select class="form-control select2" style="width: 100%;" name="hari" id="hari" required>
      
                        <option value="Senin" selected="selected">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jum'at">Jum'at</option>
                      </select>
                    </div>
                  </div>
                </div>-->
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label for="exampleInputEmail1">Tanggal</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" onchange="setDay()" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-2 col-sm-6">
                      <label for="exampleInputEmail1">Waktu</label>
                    </div>
                    <div class="col-lg-4">
	                    <div class="row">
		                    <div class="col-lg-5">
		                      <input type="time" class="form-control" name="waktu1" id="waktu" onchange="setTime()" required>
		                    </div>
		                    <div  class="col-lg-2" align="center" style="padding-top: 5px">
		                    	<label >s/d</label>
		                    </div>
		                    <div class="col-lg-5">
		                      <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" required>
		                    </div>	
	                    </div>
	                    </div>	
                    </div>
                </div>
                <div class="col-lg-12">
              <div class="row mb-5 justify-content-center">
                <div class="col-lg-4 mb-3">
                  <button class="btn btn-primary w-100" style="background-color: #1F60A8" id="btn-add-jadwalDokter">TAMBAH</button>
                </div>
                <div class="col-lg-4">
                  <a href="<?php echo base_url('admin/Dokter/jadwal_dokter');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
                </div>
              </div>  
              </div>
              </div>
              
              <!-- /.card-body -->
              <!-- <div class="col-lg-12">
              <div class="row mb-5 justify-content-center">
                <div class="col-lg-4 mb-3">
                  <button class="btn btn-primary w-100" style="background-color: #1F60A8" id="btn-add-jadwalDokter">TAMBAH</button>
                </div>
                <div class="col-lg-4">
                  <a href="<?php echo base_url('admin/Dokter/jadwal_dokter');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
                </div>
              </div>	
              </div> -->
              </form>
            </div>
              
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

<?php if($this->session->flashdata('msg_jadwal_dokter')){ echo "<script>alert('".$this->session->flashdata('msg_jadwal_dokter')."')</script>"; } ?>

<!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->