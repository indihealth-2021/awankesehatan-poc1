
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>" class="text-black">Jadwal Dokter</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Jadwal Dokter</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12"> 
          <p class="title-form">Edit Jadwal Dokter</p>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="gen-label text-label-form">Kategori :</label>
                    <input type="radio" name="colorRadio" value="rutin" <?php echo $tipe == 'rutin' ? 'checked' : ''; ?>> Rutin
                    <input type="radio" name="colorRadio" value="khusus" <?php echo $tipe == 'khusus' ? 'checked' : ''; ?> class="ml-5 pl-5"> Khusus
                </div>
            </div>
          </div>

          
          <div class="rutin box">        
            <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/updateJadwalDokter/'.$jadwal[0]->id); ?>">
             <div class="row">
               <div class="col-md-4">
                  <div class="form-group form-focus">
                      <label class="focus-label">Nama Dokter</label>
                        <select class="form-control floating" name="id_dokter" id="id_dokter" required>
                          <option>Pilih Dokter</option>
                          <?php foreach ($dokter as $user) { 
                            if ($user->id == $jadwal[0]->id_dokter) {?>
                            <option value="<?php echo $user->id; ?>" selected><?php echo $user->name; ?></option>
                          <?php }else{ ?>
                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                          <?php }}?>
                        </select>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group form-focus">
                      <label class="focus-label">Hari</label>
                        <select class="form-control floating"  name="hari" id="hari" required>
                          <option value="Senin" <?php echo $jadwal[0]->hari == 'Senin' ? 'selected' : ''; ?>>Senin</option>
                          <option value="Selasa" <?php echo $jadwal[0]->hari == 'Selasa' ? 'selected' : ''; ?>>Selasa</option>
                          <option value="Rabu" <?php echo $jadwal[0]->hari == 'Rabu' ? 'selected' : ''; ?>>Rabu</option>
                          <option value="Kamis" <?php echo $jadwal[0]->hari == 'Kamis' ? 'selected' : ''; ?>>Kamis</option>
                          <option value="Jum'at" <?php echo $jadwal[0]->hari == "Jum'at" ? 'selected' : ''; ?>>Jum'at</option>
                        </select>
                  </div>
                </div> 
             </div>
          
            <div class="row">
              <?php
                $jadwal[0]->waktu = explode('-', $jadwal[0]->waktu);
                $waktu_1 = str_replace('.', ':', str_replace(' ','', $jadwal[0]->waktu[0]));
                $waktu_2 = str_replace('.', ':', str_replace(' ','', $jadwal[0]->waktu[1]));
              ?>
              <div class="col-md-4">
                  <div class="form-group">
                    <label class="text-label-form">Waktu Mulai</label>
                    <div class="col-md-14">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock font-18 icon-form-pend"></i></span>
                        </div>
                        <input type="time" class="form-control" name="waktu1" id="time" onchange="setTime()" value="<?php echo $waktu_1 ?>">
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
                        <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" value="<?php echo $waktu_2 ?>">
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12 font-14">
                <label class="gen-label text-label-form">Status :</label>
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=1 required <?php echo $jadwal[0]->jadwal_aktif ? 'checked' : ''; ?> required>Aktif
                    </label>
                  </div>
                  <div class="form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=0 required <?php echo $jadwal[0]->jadwal_aktif == 0 ? 'checked' : ''; ?> required>Non Aktif
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="ml-3">
                <button class="btn btn-simpan" id="btn-edit-jadwalDokter">Simpan</button>
                <a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>"><button type="button" class="btn btn-batal ml-4">Batal</button></a>
              </div>
            </div>
          </form>
          </div>

          <div class="khusus box">      
            <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/updateJadwalDokter/'.$jadwal[0]->id); ?>">
             <div class="row">
               <div class="col-md-4">
                  <div class="form-group form-focus">
                      <label class="focus-label">Nama Dokter</label>
                        <select class="form-control floating" name="id_dokter" id="id_dokter" required>
                          <?php foreach ($dokter as $user) { 
                            if ($user->id == $jadwal[0]->id_dokter) {?>
                                <option value="<?php echo $user->id; ?>" selected><?php echo $user->name; ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                          <?php }}?>
                        </select>
                  </div>
                </div> 
                <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal</label>
                    <input type="date" class="form-control floating" name="tanggal" id="tanggal" onchange="setDay()" value="<?php echo $jadwal[0]->tanggal; ?>">
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
                        <input type="time" class="form-control" name="waktu1" id="time" onchange="setTime()" value="<?php echo $waktu_1 ?>">
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
                        <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" value="<?php echo $waktu_2 ?>">
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12 font-14">
                <label class="gen-label text-label-form">Status :</label>
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=1 <?php echo $jadwal[0]->jadwal_aktif ? 'checked' : ''; ?> required>Aktif
                    </label>
                  </div>
                  <div class="form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=0 <?php echo $jadwal[0]->jadwal_aktif == 0 ? 'checked' : ''; ?> required>Non Aktif
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="ml-3">
                <input name="id" id="id" value="<?php echo $jadwal[0]->id;?>" hidden>
                <button class="btn btn-simpan" id="btn-edit-jadwalDokter">Simpan</button>
                <a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>"><button type="button" class="btn btn-batal ml-4">Batal</button></a>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div> 
<?php if($this->session->flashdata('msg_jadwal_dokter')){ echo "<script>alert('".$this->session->flashdata('msg_jadwal_dokter')."')</script>"; } ?>




          