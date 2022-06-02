
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>" class="text-black">Jadwal Dokter</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Dokter/form_jadwalDokter') ?>" class="text-black font-bold-7">Tambah Jadwal Dokter</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12"> 
          <p class="title-form">Tambah Jadwal Dokter</p>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="gen-label text-label-form">Kategori :</label>
                    <input type="radio" name="colorRadio" value="rutin" checked> Rutin
                    <input type="radio" name="colorRadio" value="khusus" class="ml-5 pl-5"> Khusus
                </div>
            </div>
          </div>

          
          <div class="rutin box">        
            <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/addJadwalDokter'); ?>">
             <div class="row">
               <div class="col-md-4">
                  <div class="form-group form-focus">
                      <label class="focus-label">Nama Dokter</label>
                        <select class="form-control floating" name="id_dokter" id="id_dokter" required>
                          <option>Pilih Dokter</option>
                          <?php foreach ($dokter as $user) { ?>
                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                          <?php }?>
                        </select>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group form-focus">
                      <label class="focus-label">Hari</label>
                        <select class="form-control floating"  name="hari" id="hari" required>
                          <option>Pilih Hari</option>
                          <option value="Senin">Senin</option>
                          <option value="Selasa">Selasa</option>
                          <option value="Rabu">Rabu</option>
                          <option value="Kamis">Kamis</option>
                          <option value="Jum'at">Jum'at</option>
                        </select>
                  </div>
                </div> 
             </div>
          
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <label class="text-label-form">Waktu Mulai</label>
                    <div class="col-md-14">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock font-18 icon-form-pend"></i></span>
                        </div>
                        <input type="time" class="form-control" name="waktu1" id="waktu" onchange="setTime()" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="text-label-form">Waktu Selesai</label>
                    <div class="col-md-14">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock font-18 icon-form-pend"></i></span>
                        </div>
                        <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" required>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="row mt-5">
              <div class="ml-3">
                <button class="btn btn-simpan" id="btn-add-jadwalDokter">Simpan</button>
                <a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>"><button type="button" class="btn btn-batal ml-4">Batal</button></a>
              </div>
            </div>
          </form>
          </div>

          <div class="khusus box">      
            <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/addJadwalDokter'); ?>">
             <div class="row">
               <div class="col-md-4">
                  <div class="form-group form-focus">
                      <label class="focus-label">Nama Dokter</label>
                        <select class="form-control floating" name="id_dokter" id="id_dokter" required>
                          <option>Pilih Dokter</option>
                          <?php foreach ($dokter as $user) { ?>
                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                          <?php }?>
                        </select>
                  </div>
                </div> 
                <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal</label>
                    <input type="date" class="form-control floating" name="tanggal" id="tanggal" onchange="setDay()" required>
                </div>
              </div>  
             </div>
          
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <label class="text-label-form">Waktu Mulai</label>
                    <div class="col-md-14">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock font-18 icon-form-pend"></i></span>
                        </div>
                        <input type="time" class="form-control" name="waktu1" id="waktu" onchange="setTime()" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="text-label-form">Waktu Selesai</label>
                    <div class="col-md-14">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock font-18 icon-form-pend"></i></span>
                        </div>
                        <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" required>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="row mt-5">
              <div class="ml-3">
                <button class="btn btn-simpan" id="btn-add-jadwalDokter">Simpan</button>
                <a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>"><button type="button" class="btn btn-batal ml-4">Batal</button></a>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div> 




      <?php if($this->session->flashdata('msg_jadwal_dokter')){ echo "<script>alert('".$this->session->flashdata('msg_jadwal_dokter')."')</script>"; } ?>
