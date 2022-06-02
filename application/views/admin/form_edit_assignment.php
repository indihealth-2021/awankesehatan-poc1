  <!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">User Management</li>
                    <li class="breadcrumb-item" aria-current="page"><b>Assigment Pasien</b></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <p class="page-title font-16">Assigment Pasien</p>
          </div>
      </div>

      <div class="row">
      	<div class="col-md-6">
      		<p class="font-16 font-bold-4">Data Pasien</p>
      			<div>
      			<div class="profile-edit-asses">
                    <div class="profile-img-asses">
                        <div class="profile-img">
                            <img class="avatar" src="<?php echo $pasien->foto;?>" alt="">
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-5 col-12 ml-4">
                                <div class="profile-info-asses mt-2">
                                    <span class="font-16 font-bold-4"><?php echo $pasien->name?></span><span class="ml-2 status-aktif font-11"><?php echo $pasien->aktif?></span><br>
	                                    <div class="pt-2">
	                                    	<span class="font-14"><?php echo $pasien->username?></span><br>
		                                    <span class="font-14"><?php echo $pasien->email?></span><br>
		                                    <span class="font-14"><?php echo $pasien->telp?></span>
	                                    </div>
                                    </div>
                                </div>
                            </div>
      					</div>
      				</div>
      			</div>

      		<p class="font-16 font-bold-4">Data Assesment Pasien</p>
      		<div class="row">
      			<div class="col-md-6">
	      			<div class="mb-3">
					  <label class="form-label font-13">Berat Badan (kg)</label>
					  <input type="number" class="form-control font-13" name="" value="<?php echo count($assesment) < 1 ? '': $assesment->berat_badan?>">
					</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="mb-3">
					  <label class="form-label font-13">Tinggi Badan (cm)</label>
					  <input type="number" class="form-control font-13" name="" value="<?php echo count($assesment) < 1 ? '':  $assesment->tinggi_badan?>">
					</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="mb-3">
					  <label class="form-label font-13">Tekanan Darah (mmHg)</label>
					  <input type="text" class="form-control font-13" name="" value="<?php echo count($assesment) < 1 ? '':  $assesment->tekanan_darah?>">
					</div>
	      		</div>
	      		<div class="col-md-6">
	      			<div class="mb-3">
					  <label class="form-label font-13">Suhu (celcius)</label>
					  <input type="text" class="form-control font-13" name="" value="<?php echo count($assesment) < 1 ? '':  $assesment->suhu?>">
					</div>
	      		</div>
	      		<div class="col-md-12">
	      			<div class="mb-3">
					  <label class="form-label font-13">Keluhan</label>
					  <textarea class="form-control" rows="2" name=""><?php echo count($assesment) < 1 ? '':  $assesment->keluhan?></textarea>
					</div>
	      		</div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<p class="font-16">Data Dokter</p>
      		<div>
      			<?php
                        foreach ($list_dokter as $dokter) {?>
      			<div class="profile-edit-asses">
                    <div class="profile-img-asses">
                        <div class="profile-img">
                            <img class="avatar" src="<?php echo $dokter->foto;?>" alt="">
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-5 col-12 ml-4">
                                <div class="profile-info-asses mt-2">
                                    <span class="font-16 font-bold-4"><?php echo $dokter->name?></span><span class="ml-2 status-aktif font-11">Aktif</span><br>
	                                    <div class="pt-2">
	                                    	<span class="font-14"><?php echo $dokter->poli?></span><br>
		                                    <span class="font-14"><?php echo $dokter->email?></span><br>
		                                    <span class="font-14"><?php echo $dokter->telp?></span>
	                                    </div>
                                    </div>
                                </div>
                            </div>
      					</div>
      				</div>
      			<?php }?>
      			</div>
      		</div>
      		<div class="row mt-5">
              <div class="col-md-12 ml-3">
                <button class="btn btn-simpan" id="btn-edit-pasien">Simpan</button>
                <a href="<?php echo base_url('admin/Pasien') ?>" class="btn btn-batal">Batal</a>
                <button class="btn btn-simpan ml-5" >Download</button>
              </div>
            </div>
      	</div>
      </div>
    </div>
</div>  