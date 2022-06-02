
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <!-- /.card -->

            <div class="card card-info" style="padding: 40px;">
              <form method="post" id="form-add-antrian">
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-2 offset-lg-1 col-md-3 offset-md-1 col-sm-12 offset-sm-0">
                      <h6 for="exampleInputEmail1">Dokter</h6>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                      <select class="form-control select2" style="width: 100%;" name="id_dokter" id="id_dokter">
                        <?php foreach ($dokter as $user) { ?>
                        <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-2 offset-lg-1 col-md-3 offset-md-1 col-sm-12 offset-sm-0">
                      <h6 for="exampleInputEmail1">Pasien</h6>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                      <select class="form-control select2" style="width: 100%;" name="id_pasien" id="id_pasien">
                        <?php foreach ($pasien as $user) { ?>
                        <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-2 offset-lg-1 col-md-3 offset-md-1 col-sm-12 offset-sm-0">
                      <h6 for="exampleInputEmail1">Status</h6>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                      <select class="form-control select2" style="width: 100%;" name="id_pasien" id="id_pasien">
                        <option value="0" selected="selected">Nonaktif</option>
                        <option value="1">Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              </form> 
              <!-- /.card-body -->
              <div class="row mr-2">
                <div class="col-lg-2 offset-lg-7 col-md-3 offset-md-7 col-sm-6 offset-sm-0 mt-1">
                  <button type="button" class="btn btn-primary w-100" id="btn-add-antrian">TAMBAH</button>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 mt-1">
                  <a href="<?php echo base_url('admin/Pasien/antrian_pasien');?>"><button type="button" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
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
