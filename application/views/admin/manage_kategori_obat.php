
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Data Kategori Obat</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kategori Obat</li>
                </ol>
            </nav>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 col-12 text-right m-b-20">
              <a href="<?php echo base_url('admin/KategoriObat/form_tambah_kategori') ?>" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Tambah Kategori</a>
          </div>
      </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-hover custom-table datatable mb-0">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list_obat as $idx=>$obat){ ?>
                    <tr class="odd gradeX">
                    	<td><?php echo $idx+1 ?></td>
                      	<td><?php echo $obat->name ?></td>
                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item btn btn-xs btn-default" href="<?php echo base_url('admin/KategoriObat/form_edit_kategori/'.$obat->id) ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item btn btn-xs btn-default" href="#modalHapus" data-toggle="modal" data-href="" data-nama="<?php echo $obat->name ?>" onclick="$('#modalHapus #form')" ><i class="fas fa-trash fa-sm"></i> Hapus</a>
                                                    <!-- <a class="dropdown-item" href="<?php //echo base_url('admin/Obat/delete/'.$obat->id) ?>" class="btn btn-danger" onclick="return confirm('yakin ingin menghapus kategori ini?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                                </div>
                                            </div>
                                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </tfoot>
              </table>
              
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
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Kategori Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="">
      <div class="modal-body">
          <p>Anda yakin ingin menghapus data kategori obat <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="buttonHapus">Ya</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
      </form>
    </div>
  </div>
  </div>


<?php if($this->session->flashdata('msg_obat')){ echo "<script>alert('".$this->session->flashdata('msg_obat')."')</script>"; } ?>