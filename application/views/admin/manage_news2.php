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
            <div class="col-sm-12">
              <div class="row">
              <div class="col-sm-2">
              <a href="<?php echo base_url('admin/News/formAdd') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="margin-left: 20px; margin-top: 20px; width: 145px"><i class="fa fa-plus"> Tambah News</i></a>
            </div>
              </div>
            </div>
            
            <div class="card-body">
            <div class="table-responsive">
              <table id="table_news" class="table table-bordered table-striped display">
                <thead class="bg-dark-blue-menu">
                  <tr class="text-center">
                    <th class="text-white">No</th>
  		              <th class="text-white">Foto</th>
                    <th class="text-white">Judul</th>
                    <th class="text-white">Berita</th>
                    <th class="text-white">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0; 
                  foreach ($news as $data) {
                    $no++?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
                      <td><img class="img-news" src="<?php echo base_url('assets/images/news/'.$data->foto) ?>"></td>
		                  <td><?php echo $data->judul; ?></td>
                      <td><?php echo substr($data->berita,3,300); ?></td>
                      <td class="center" style="text-align: center;">
                        <div class="btn-group btn-group-sm">
			                   <a href="<?php echo base_url('admin/News/viewDetail/'.$data->id) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          <a href="<?php echo base_url('admin/News/formEdit/'.$data->id) ?>" class="btn btn-success"><i class="fas fa-edit "></i></a>
                          <a href="<?php echo base_url('admin/News/delete/'.$data->id) ?>" class="btn btn-danger" onclick="return confirm('yakin hapus Berita?')"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot class="bg-dark-blue-menu">
                  <tr class="text-center">
                    <th class="text-white">No</th>
                    <th class="text-white">Foto</th>
                    <th class="text-white">Judul</th>
                    <th class="text-white">Berita</th>
                    <th class="text-white">Aksi</th>
                  </tr>
                </tfoot>
              </table>
              <div class="col-lg-12">
              <a href="<?php echo base_url('admin/Admin') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="float: right; margin-top: 20px; width: 140px">Kembali</a>
            </div> 
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
  
