<style type="text/css">
    @media print{
        html, body{
            display: none;
        }
    }
</style>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #1F60A8; color: #fff">
              <h3 class="card-title"><?php echo $title ?></h3>
            </div>
            <!-- /.card-header -->
            <div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped display">
                                    <thead class="bg-dark-blue-menu" style="color: #fff">
                                        <tr>                                            
                                            <th class="text-white" style="text-align:center">Tanggal</th>
                                            <th class="text-white" style="text-align:center">Notifikasi</th>
                                            <th class="text-white" style="text-align:center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"><a href="" class="btn btn-primary btn-block">Detail</a></td>
                                            </tr>
                                    </tbody>
                                    <tfoot class="bg-dark-blue-menu" style="color: #fff">
                                        <tr>                                            
                                            <th class="text-white" style="text-align:center">Tanggal</th>
                                            <th class="text-white" style="text-align:center">Notifikasi</th>
                                            <th class="text-white" style="text-align:center">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="col-lg-12">
                                  <a href="<?php echo base_url('pasien/Dashboard') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="float: right; margin-top: 20px; width: 140px">Kembali</a>
                                </div> 
                            </div>
                            <!-- /.table-responsive -->                            
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
