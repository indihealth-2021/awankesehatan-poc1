
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <!-- /.card -->

            <div class="card">
            <div class="card-header" style="background-color: #1F60A8; color: #fff">
              <div class="card-title">Tambah Nominal</div>
            </div>
              <form method="post" id="form-add-config" action="<?php echo base_url('admin/Config/addNominal') ?>">
              <div class="card-body">
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2 offset-lg-1 col-md-3 offset-md-1 col-sm-12 offset-sm-0">
                      <label for="exampleInputEmail1">Poli</label>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12">
                      <input type="text" class="form-control" name="poli" id="poli">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2 offset-lg-1 col-md-3 offset-md-1 col-sm-12 offset-sm-0">
                      <label for="exampleInputEmail1">Harga</label >
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12">
                      <input type="number" class="form-control" name="harga" id="harga">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
              <div class="row mb-5 mt-4 justify-content-center">
                <div class="col-lg-4">
                  <button class="btn btn-primary w-100" style="background-color: #1F60A8" id="btn-add-config">TAMBAH</button>
                </div>
                </form> 
                <div class="col-lg-4">
                  <a href="<?php echo base_url('admin/Config/nominal');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
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
