    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-5">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Edit Jadwal Dokter</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Jadwal Dokter</li>
                </ol>
            </nav>
          </div>
      </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="display-block">Kategori</label>
                                            <input type="radio" name="colorRadio" value="rutin" <?php echo $tipe == 'rutin' ? 'checked' : ''; ?>> Rutin
                                            <input type="radio" name="colorRadio" value="khusus" <?php echo $tipe == 'khusus' ? 'checked' : ''; ?>> Khusus
                                    </div>
                                </div>
                            </div>
                            <div class="rutin box">
                            <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/updateJadwalDokter/'.$jadwal[0]->id); ?>">
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Dokter</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_dokter" id="id_dokter">
                                          <?php foreach ($dokter as $user) { 
                                            if ($user->id == $jadwal[0]->id_dokter) {?>
                                               <option value="<?php echo $user->id; ?>" selected><?php echo $user->name; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                          <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hari</label>
                                         <select class="form-control select2" name="hari" id="hari" required>      
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <div class="">
                                            <input type="time" class="form-control" name="waktu1" id="time" onchange="setTime()" value="<?php echo $waktu_1 ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Akhir</label>
                                        <div class="">
                                            <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" value="<?php echo $waktu_2 ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="btn-edit-jadwalDokter">Edit</button>
                            </div>                
                          </form>
                          </div>

                        <div class="khusus box">
                            <form method="post" id="form-add-jadwalDokter" action="<<?php echo base_url('admin/Dokter/updateJadwalDokter/'.$jadwal[0]->id); ?>">
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Dokter</label>
                                        <select class="form-control select2" name="id_dokter" id="id_dokter">
                                          <?php foreach ($dokter as $user) { 
                                            if ($user->id == $jadwal[0]->id_dokter) {?>
                                               <option value="<?php echo $user->id; ?>" selected><?php echo $user->name; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                          <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <div class="">
                                            <input type="date" class="form-control" name="tanggal" id="tanggal" onchange="setDay()" value="<?php echo $jadwal[0]->tanggal; ?>">
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <div class="">
                                            <input type="time" class="form-control" name="waktu1" id="time" onchange="setTime()" value="<?php echo $waktu_1 ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Akhir</label>
                                        <div class="">
                                            <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" value="<?php echo $waktu_2 ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input name="id" id="id" value="<?php echo $jadwal[0]->id;?>" hidden>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="btn-edit-jadwalDokter">Edit</button>
                            </div>                
                          </form>
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

<?php if($this->session->flashdata('msg_jadwal_dokter')){ echo "<script>alert('".$this->session->flashdata('msg_jadwal_dokter')."')</script>"; } ?>

<!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->