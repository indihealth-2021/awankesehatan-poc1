
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Poli</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Poli</li>
                </ol>
            </nav>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 col-12 text-right m-b-20">
            <a href="<?php echo base_url('admin/Config/formAddPoli') ?>" class="btn btn btn-primary btn-rounded float-left"><i class="fa fa-plus"></i> Tambah Poli</a>
          </div>
      </div>        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_poli">                
              <thead>
                <tr>
                  <th>No</th>
                  <th>Poli</th>
                  <th>Tarif</th>
                  <th>Administrasi</th>
                  <th>Status</th>
                  <th class="text-right">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 0; 
                  foreach ($poli as $data) {
                    $no++?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
		                  <td><?php echo $data->name_poli; ?></td>
                      <td><?php echo 'Rp. '.number_format($data->harga,2,',','.'); ?></td>
                      <td><?php echo $data->biaya_adm ? 'Rp. '.number_format($data->biaya_adm,2,',','.'):''; ?></td>
                      <td>
                        <?php echo $data->aktif ? '<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-status-poli="aktif" data-nama-poli="'.$data->name_poli.'" data-id-poli="'.$data->id.'" data-target="#modalStatusPoli">Aktif</button>':'<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-status-poli="nonaktif" data-nama-poli="'.$data->name_poli.'" data-id-poli="'.$data->id.'" data-target="#modalStatusPoli">Nonaktif</button>' ?>
                        <center><small class="text-muted">klik untuk mengubah status</small></center>
                      </td>
                      <td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item btn btn-xs btn-default" href="<?php echo base_url('admin/Config/formEditPoli/'.$data->id) ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                          <a class="dropdown-item btn btn-xs btn-default" href="#modalHapus" data-toggle="modal" data-href="<?php echo base_url('admin/Config/deletePoli/'.$data->id) ?>" data-nama="<?php echo $data->name_poli ?>" onclick="$('#modalHapus #form')" ><i class="fas fa-trash fa-sm"></i> Hapus</a>

													<!-- <a class="dropdown-item" href="<?php echo base_url('admin/Config/deletePoli/'.$data->id) ?>" class="btn btn-danger" onclick="return confirm('yakin hapus Poli?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
												</div>
											</div>
										</td>
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Poli</th>
                  <th>Tarif</th>
                  <th>Administrasi</th>
                  <th>Status</th>
                  <th class="text-right">Aksi</th>
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
    </div>
    <!-- /.content -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Poli</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url('admin/Config/deletePoli/'.$data->id) ?>">
      <div class="modal-body">
          <p>Anda yakin ingin menghapus data poli <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="buttonHapus">Ya</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
      </form>
    </div>
  </div>
  </div>

<?php if($this->session->flashdata('msg_poli')){ ?>
<script>
alert('<?php echo $this->session->flashdata('msg_poli') ?>')
</script>
<?php } ?>

<div class="modal fade" id="modalStatusPoli" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Status Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apa anda yakin ingin <span class="status-poli"></span> <b class="nama-poli"></b>?</p>
      </div>
      <div class="modal-footer">
        <a class="delete-btn" style="text-decoration: none; color:white;" href=""><button type="button" class="btn btn-primary">Ya</button></a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>