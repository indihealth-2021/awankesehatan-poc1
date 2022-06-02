
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/teleconsultasi') ?>" class="text-black">Jadwal Telekonsultasi</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Jadwal Telekonsultasi</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12"> 
          <p class="title-form">Edit Jadwal Telekonsultasi</p>
          
   
            <form method="post" id="" action="<?php echo base_url('admin/Teleconsultasi/updateJadwal/'.$jadwal_konsultasi->id) ?>">
             <div class="row">
               <div class="col-md-4">
                  <div class="form-group form-focus">
                      <label class="focus-label">Nama Dokter</label>
                        <select class="form-control floating" name="id_dokter" id="">
                          <?php foreach($list_dokter_satu_poli as $dokter){ ?>
                          <option value="<?php echo $dokter->id ?>" <?php echo $jadwal_konsultasi->id_dokter == $dokter->id ? 'selected':''; ?>><?php echo $dokter->name.' ( '.$dokter->str.' )' ?></option>
                          <?php } ?>
                        </select>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group form-focus">
                      <label class="focus-label">Pasien</label>
                        <select class="form-control floating"  name="id_pasien" id="" readonly>
                          <option value="<?php echo $jadwal_konsultasi->id_pasien ?>"><?php echo $jadwal_konsultasi->nama_pasien ?></option>
                        </select>
                  </div>
                </div> 
              </div>
          
            <div class="row">
              <div class="col-md-4 mt-3">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal</label>
                    <input type="date" class="form-control floating" name="tanggal" id="tanggal" onchange="setDay()" value="<?php echo $jadwal_konsultasi->tanggal ?>">
                </div>
              </div>  
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="text-label-form">Waktu</label>
                    <div class="col-md-14">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock font-18 icon-form-pend"></i></span>
                        </div>
                        <input type="time" class="form-control" name="jam" id="waktu" onchange="setTime()" value="<?php echo $jadwal_konsultasi->jam ?>">
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="row mt-5">
              <div class="ml-3">
                <button class="btn btn-simpan" id="btn-edit-jadwalDokter">Simpan</button>
                <a href="<?php echo base_url('admin/teleconsultasi') ?>"><button type="button" class="btn btn-batal ml-4">Batal</button></a>
              </div>
            </div>
          </form>
          </div>

        </div>
      </div> 
<?php if($this->session->flashdata('msg_jadwal_dokter')){ echo "<script>alert('".$this->session->flashdata('msg_jadwal_dokter')."')</script>"; } ?>




          