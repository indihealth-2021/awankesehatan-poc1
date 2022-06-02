    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-5">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Tambah Jadwal Dokter</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal Dokter</li>
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
                                            <input type="radio" name="colorRadio" value="rutin" checked> Rutin
                                            <input type="radio" name="colorRadio" value="khusus"> Khusus
                                    </div>
                                </div>
                            </div>
                            <div class="rutin box">
                            <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/addJadwalDokter'); ?>">
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Dokter</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_dokter" id="id_dokter" required>
                                          <?php foreach ($dokter as $user) { ?>
                                          <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                          <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hari</label>
                                         <select class="form-control select2" name="hari" id="hari" required>      
                                          <option value="Senin" selected="selected">Senin</option>
                                          <option value="Selasa">Selasa</option>
                                          <option value="Rabu">Rabu</option>
                                          <option value="Kamis">Kamis</option>
                                          <option value="Jum'at">Jum'at</option>
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <div class="">
                                            <input type="time" class="form-control" name="waktu1" id="waktu" onchange="setTime()" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Akhir</label>
                                        <div class="">
                                            <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="btn-add-jadwalDokter">Tambah</button>
                            </div>                
                          </form>
                          </div>

                        <div class="khusus box">
                            <form method="post" id="form-add-jadwalDokter" action="<?php echo base_url('admin/Dokter/addJadwalDokter'); ?>">
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Dokter</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_dokter" id="id_dokter" required>
                                          <?php foreach ($dokter as $user) { ?>
                                          <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                          <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <div class="">
                                            <input type="date" class="form-control" name="tanggal" id="tanggal" onchange="setDay()" required>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <div class="">
                                            <input type="time" class="form-control" name="waktu1" id="waktu" onchange="setTime()" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Akhir</label>
                                        <div class="">
                                            <input type="time" class="form-control" name="waktu2"  id="waktu" onchange="setTime()" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="btn-add-jadwalDokter">Tambah</button>
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