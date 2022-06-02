
    <!-- Main content -->
    <div class="page-wrapper">
      <div class="content">
        <div class="row mb-3">
            <div class="col-sm-5 col-12">
                <h4 class="page-title">Jadwal Telekonsultasi</h4>
            </div>
            <div class="col-sm-7 col-12">
              <nav aria-label="">
                  <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                      <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Jadwal Telekonsultasi</li>
                  </ol>
              </nav>
            </div>
        </div>
          <div class="row">
            <div class="col-lg-9 offset-lg-3">
                      <form method="post" id="" action="<?php echo base_url('admin/Teleconsultasi/updateJadwal/'.$jadwal_konsultasi->id) ?>">
                      <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Dokter</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_dokter" id="">
                                          <!-- <option value="<?php //echo $jadwal_konsultasi->id_dokter  ?>"><?php //echo $jadwal_konsultasi->nama_dokter ?></option> -->
										  <?php foreach($list_dokter_satu_poli as $dokter){ ?>
											<option value="<?php echo $dokter->id ?>" <?php echo $jadwal_konsultasi->id_dokter == $dokter->id ? 'selected':''; ?>><?php echo $dokter->name.' ( '.$dokter->str.' )' ?></option>
										  <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Pasien</label>
                                        <select class="form-control select2" style="width: 100%;" name="id_pasien" id="" readonly>
                                          <option value="<?php echo $jadwal_konsultasi->id_pasien ?>"><?php echo $jadwal_konsultasi->nama_pasien ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" onchange="setDay()" value="<?php echo $jadwal_konsultasi->tanggal ?>">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Waktu</label>
                                        <input type="time" class="form-control" name="jam" id="waktu" onchange="setTime()" value="<?php echo $jadwal_konsultasi->jam ?>">
                                    </div>
                                </div>
                            </div>
                          </div>
                          </div>
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Edit</button>
                            </div>
                        </form>
                
                </div>
          </div>
        </div>
      </div>


