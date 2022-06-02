<style type="text/css">
  .img-news{
    width: 100px;
    height: 100px;
  }
</style>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #1F60A8; color: #fff">
              <h3 class="card-title">Data Berita</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped display">
                <thead class="bg-dark-blue-menu" style="color: #fff">
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Foto</th>
                  <th>Berita</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; 
                  foreach ($news as $data) {
                    $no++?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->judul; ?></td>
                      <td><img class="img-news" src="<?php echo base_url('assets/images/news/').$data->foto; ?>"></td>
                      <td><?php echo substr($data->berita,3,300); ?></td>
                      <td class="center" style="text-align: center;">
                        <div class="btn-group btn-group-sm">
                          <a href="<?php echo site_url('dokter/News/lihat/'.$data->id) ?>" class="btn btn-success" onclick="return confirm('Lihat Data?')"><i class="fas fa-eye "></i></a>
                      </td>
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot class="bg-dark-blue-menu" style="color: #fff">
                  <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Foto</th>
                  <th>Berita</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
              
              <div class="col-lg-12">
                <a href="<?php echo base_url('dokter/Dashboard') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="float: right; margin-top: 20px; width: 140px">Kembali</a>
              </div> 
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
