
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background: #1F60A8; color: #fff">
              <h3 class="card-title">Data Dokter</h3>
            </div>
            <!-- /.card-header -->
            <div class="col-sm-12">
              <div class="row">
              <div class="col-sm-2">
              <a href="<?php echo base_url('admin/Dokter/form_dokter') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="margin-left: 20px; margin-top: 20px; width: 155px"><i class="fa fa-plus"> Tambah Dokter</i></a>
            </div>
                
              </div>
            </div>
            
            <div class="card-body">
		<div class="table-responsive">
              <table id="table_dokter" class="table table-bordered table-striped">
                <thead class="bg-dark-blue-menu">
                <tr class="text-center">
                  <th class="text-white">No</th>
                  <th class="text-white">Nama</th>
		              <th class="text-white">Username</th>
                  <th class="text-white">Email</th>
                  <th class="text-white">Telp</th>
                  <th class="text-white">Status</th>
                  <th class="text-white">Aksi</th>
                </tr>
                </thead>
          		<tbody>
          			<?php foreach($list_dokter as $idx=>$dokter){ ?>
          				<tr>
          					<td><?php echo $idx+1 ?></td>
          					<td><?php echo ucwords($dokter->name) ?></td>
          					<td><?php echo $dokter->username ?></td>
          					<td><?php echo $dokter->email ?></td>
          					<td><?php echo $dokter->telp ?></td>
          					<?php $status = $dokter->aktif ? 'Aktif' : 'Tidak Aktif'; ?>
          					<td><?php echo $status ?></td>
                    <td class="center" style="text-align: center;">
                                  <div class="btn-group btn-group-sm">
                                    <a href="<?php echo base_url('admin/Dokter/tampilEditDokter/'.$dokter->id);?>" class="btn btn-success"><i class="fas fa-edit "></i></a>
                                    <a href="<?php echo base_url('admin/Dokter/hapusDokter/'.$dokter->id);?>" class="btn btn-danger" onclick="return confirm('yakin hapus Data Dokter?')"><i class="fas fa-trash"></i></a>
                                  </div>
                                </td>
          				</tr>
          			<?php } ?>
          		</tbody>
              <tfoot class="bg-dark-blue-menu">
                <tr class="text-center"> 
                  <th class="text-white">No</th>
                  <th class="text-white">Nama</th>
                  <th class="text-white">Username</th>
                  <th class="text-white">Email</th>
                  <th class="text-white">Telp</th>
                  <th class="text-white">Status</th>
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
  
