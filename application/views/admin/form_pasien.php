
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <!-- /.card -->

            <div class="card card-info" style="padding: 40px;">
              <h5 class="text-bold mb-4" style="text-decoration: underline;">User Login</h5>
              <form method="post" id="form-add-pasien">
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <h6 for="exampleInputEmail1">Email address</h6>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="email" class="form-control" id="email" name="email">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <h6 for="exampleInputEmail1">Username</h6>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="text" class="form-control" id="username" name="username">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <h6 for="exampleInputPassword1">Password</h6>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <h6>Status Akun</h6>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <select class="form-control select2" style="width: 100%;" name="aktif" id="aktif">
                        <option value="0" selected="selected">Nonaktif</option>
                        <option value="1">Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <h5 class="text-bold mb-4" style="text-decoration: underline;">Biodata</h5>
              <div class="card-body">
                <!-- Date range -->
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <h6 for="exampleInputPassword1">Nama</h6>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" name="name" id="name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <h6 for="exampleInputEmail1">Tempat/Tanggal Lahir</h6>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group" style="padding-right: 35px">
                              <input type="text" class="form-control" name="lahir_tempat" id="lahir_tempat">
                            </div>
                          </div>
                          <div class="col-1">/</div>
                          <div class="col-5">
                            <div class="form-group">
                              <input type="date" class="form-control" name="lahir_tanggal" id="lahir_tanggal">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <h6>Jenis Kelammin</h6>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <select class="form-control select2" style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin">
                          <option value="Laki-laki" selected="selected">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <h6 for="exampleInputEmail1">Jalan</h6>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <input type="text" class="form-control" name="alamat_jalan" id="alamat_jalan">
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <h6 for="exampleInputEmail1">Kelurahan/Desa</h6>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" name="alamat_kelurahan" id="alamat_kelurahan">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <h6 for="exampleInputEmail1">Kecamatan</h6>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" name="alamat_kecamatan" id="alamat_kecamatan">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <h6 for="exampleInputEmail1">Kabupaten/Kota</h6>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" name="alamat_kota" id="alamat_kota">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <h6 for="exampleInputEmail1">Provinsi</h6>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" name="alamat_provinsi" id="alamat_provinsi">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <h6 for="exampleInputEmail1">No. Telp/HP</h6>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control" name="telp" id="telp">
                      </div>
                    </div>
                  </div>
                  <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="0" hidden>
              </div>
              </form> 
              <!-- /.card-body -->
              <div class="row justify-content-end">
                <div class="col-lg-2">
                  <button type="button" class="btn btn-primary w-100" id="btn-add-pasien">TAMBAH</button>
                </div>
                <div class="col-lg-2">
                  <a href="<?php echo base_url('admin/Pasien');?>"><button type="button" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
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
    <!-- /.content -->
