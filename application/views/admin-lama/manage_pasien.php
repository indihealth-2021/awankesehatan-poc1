
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Pasien</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pasien</li>
                </ol>
            </nav>
          </div>
      </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_pasien">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
		              <th>Username</th>
                  <th>Email</th>
                  <th>Telp</th>
                  <th>Status</th>
                  <th class="text-right">Aksi</th>
                </tr>
                </thead>
            		<tbody>
            			<?php foreach($list_pasien as $idx=>$pasien){ ?>
            				<tr>
            					<td><?php echo $idx+1 ?></td>
            					<td><?php echo ucwords($pasien->name) ?></td>
            					<td><?php echo $pasien->username ?></td>
            					<td><?php echo $pasien->email ?></td>
            					<td><?php echo $pasien->telp ?></td>
            					<?php $status = $pasien->aktif ? 'Aktif' : 'Tidak Aktif'; ?>
            					<td><?php echo $status ?></td>
                      <td class="text-right">
                        <div class="dropdown dropdown-action">
                          <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item btn btn-xs btn-default" href="<?php echo base_url('admin/Pasien/tampilEditPasien/'.$pasien->id);?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a class="dropdown-item btn btn-xs btn-default" href="#modalHapus" data-toggle="modal" data-href="<?php echo base_url('admin/Pasien/hapusPasien/'.$pasien->id);?>" data-nama="<?php echo $pasien->name ?>" onclick="$('#modalHapus #form')" ><i class="fas fa-trash fa-sm"></i> Hapus</a>
                            <!-- <a class="dropdown-item" href="<?php echo base_url('admin/Pasien/hapusPasien/'.$pasien->id);?>" onclick="return confirm('yakin hapus Data Pasien?')"><i class="fas fa-trash"></i> Delete</a> -->
                          </div>
                        </div>
                      </td>
            				</tr>
            			<?php } ?>
            		</tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Telp</th>
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
    </section>
    <!-- /.content -->
  
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Pasien</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url('admin/Pasien/hapusPasien/'.$pasien->id);?>">
      <div class="modal-body">
          <p>Anda yakin ingin menghapus data pasien <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="buttonHapus">Ya</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  
  <?php echo $this->session->flashdata('msg_edit_pasien') ? "<script>alert('".$this->session->flashdata('msg_edit_pasien')."')</script>" : ''; ?>
  <?php echo $this->session->flashdata('msg_hps_pasien') ? "<script>alert('".$this->session->flashdata('msg_hps_pasien')."')</script>" : ''; ?>
