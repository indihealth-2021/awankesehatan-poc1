
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Jadwal Dokter</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jadwal Dokter</li>
                </ol>
            </nav>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 col-12 text-right m-b-20">
              <a href="<?php echo base_url('admin/Dokter/form_jadwalDokter') ?>" class="btn btn btn-primary btn-rounded float-left"><i class="fa fa-plus"></i> Tambah Jadwal</a>
          </div>
      </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-hover custom-table mb-0" id="table_jadwal_dokter">
                <thead>
                  <tr >
                    <th>No</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th class="text-right">Aksi</th>
                  </tr>
                </thead>
                                    <tbody>
                                      <?php
                                        for($i = 0; $i<count($jadwal);$i++) {
                                      ?>
                                          <tr class="odd gradeX">   
                                              <td><?php echo $i+1; ?></td>       
                                              <td><?php echo $jadwal[$i]->aktif ? ucwords($jadwal[$i]->name) : ucwords($jadwal[$i]->name).' ( <font color="red">Tidak Aktif</font> )'; ?></td>
                                              <td><?php echo $jadwal[$i]->poli ?> <?php echo $jadwal[$i]->poli_aktif ? '':'<span class="badge badge-danger">Nonaktif</span>'; ?></td>
                                              <td><?php echo $jadwal[$i]->hari ?></td>
                                              <?php 
                                                if($jadwal[$i]->tanggal){
                                                  $tanggal = new DateTime($jadwal[$i]->tanggal);
                                                  $tanggal = $tanggal->format('d-m-Y');
                                                }
                                                else{
                                                  $tanggal = 'Jadwal Rutin';
                                                }
                                              ?>
                                              <td><?php echo $tanggal; ?></td>
                                              <td><?php echo $jadwal[$i]->waktu ?></td>
                                              <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item btn btn-xs btn-default" href="<?php echo base_url('admin/Dokter/tampilEdit_jadwalDokter/'.$jadwal[$i]->id) ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item btn btn-xs btn-default" href="#modalHapus" data-toggle="modal" data-href="<?php echo base_url('admin/Dokter/hapus_jadwalDokter/'.$jadwal[$i]->id) ?>" data-nama="<?php echo $jadwal[$i]->name ?>" onclick="$('#modalHapus #form')" ><i class="fas fa-trash fa-sm"></i> Hapus</a>

                                                    <!-- <a class="dropdown-item" href="<?php echo base_url('admin/Dokter/hapus_jadwalDokter/'.$jadwal[$i]->id) ?>" class="btn btn-danger" onclick="return confirm('yakin hapus Jadwal?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                                </div>
                                            </div>
                                        </td>
                                          </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                  <tr >
                    <th>No</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
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
        <h5 class="modal-title">Hapus Data Jadwal Dokter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p>Anda yakin ingin menghapus data jadwal dokter <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="buttonHapus">Ya</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
  </div>

<?php if($this->session->flashdata('msg_jadwal_dokter')){ echo "<script>alert('".$this->session->flashdata('msg_jadwal_dokter')."')</script>"; } ?>