
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Berita</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                </ol>
            </nav>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 col-12 text-right m-b-20">
              <a href="<?php echo base_url('admin/News/formAdd') ?>" class="btn btn btn-primary btn-rounded float-left"><i class="fa fa-plus"></i> Tambah Berita</a>
          </div>
      </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-hover custom-table mb-0" id="table_news">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Deskripsi Berita</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; 
                                    foreach ($news as $data) {
                                      $no++?>
                                      <tr class="odd gradeX">
                                        <td><?php echo $no; ?></td>
                                        <td><img class="img-news" width="160" height="100" src="<?php echo base_url('assets/images/news/'.$data->foto) ?>"></td>
                                        <td><?php echo $data->judul; ?></td>
                                        <td><?php echo substr(strip_tags($data->berita),0,100); ?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item btn btn-xs btn-default" href="<?php echo base_url('admin/News/viewDetail/'.$data->id) ?>"><i class="fa fa-eye m-r-5"></i> Lihat</a>
                                                    <a class="dropdown-item btn btn-xs btn-default" href="<?php echo base_url('admin/News/formEdit/'.$data->id) ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item btn btn-xs btn-default" href="#modalHapus" data-toggle="modal" data-href="<?php echo base_url('admin/News/delete/'.$data->id) ?>" data-nama="<?php echo $data->judul ?>" onclick="$('#modalHapus #form')" ><i class="fas fa-trash fa-sm"></i> Hapus</a>
                                                </div>
                                            </div>
                                        </td>
                                      </tr>
                                      <?php }?>
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Deskripsi Berita</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>



  <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Berita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p>Anda yakin ingin menghapus data berita <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="buttonHapus">Ya</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
  </div>