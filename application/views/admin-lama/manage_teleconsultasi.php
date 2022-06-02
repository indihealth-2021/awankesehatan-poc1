<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Jadwal Telekonsultasi </h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jadwal Telekonsultasi</li>
                </ol>
            </nav>
          </div>
      </div>
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_telekonsultasi">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Poli</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Hari</th>
                    <th>Jam</th>
  		              <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($list_jadwal_telekonsultasi as $idx=>$jt){ ?>
          			<tr>
          				<td><?php echo $idx+1 ?></td>
          				<td><?php echo ucwords($jt->nama_pasien) ?></td>
          				<td><?php echo ucwords($jt->nama_dokter) ?></td>
                  <td><?php echo $jt->poli ?></td>
                  <?php 
                    $tanggal = new DateTime($jt->tanggal);
                    $hari = $tanggal->format('D');
                    switch($hari){
                        case 'Mon':
                        $hari = 'Senin';
                        break;
                        case 'Tue':
                        $hari = 'Selasa';
                        break;
                        case 'Wed':
                        $hari = 'Rabu';
                        break;
                        case 'Thu':
                        $hari = 'Kamis';
                        break;
                        case 'Fri':
                        $hari = "Jum'at";
                        break;
                        case 'Sat':
                        $hari = 'Sabtu';
                        break;
                        case 'Sun':
                        $hari = 'Minggu';
                        break;
                        default:
                        $hari = '';
                        break;
                    }
                    $tanggal = $tanggal->format('d-m-Y');                  
                  ?>
          				<td><?php echo $tanggal ?></td>
                  <td><?php echo $hari ?></td>
          				<td><?php echo ucwords($jt->jam)?> (Max. 30 Menit)</td>
                  <td class="text-right">
                    <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item btn btn-xs btn-default" href="<?php echo base_url('admin/Teleconsultasi/tampilEditJadwal/'.$jt->id);?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a class="dropdown-item btn btn-xs btn-default" href="#modalHapus" data-toggle="modal" data-href="<?php echo base_url('admin/Teleconsultasi/hapusJadwal/'.$jt->id.'/'.$jt->id_dokter.'/'.$jt->id_pasien);?>" data-nama="<?php echo 'Pasien '.$jt->nama_pasien.' dengan Dokter '.$jt->nama_dokter.' [ '.$jt->tanggal.' ]' ?>" onclick="$('#modalHapus #form')" ><i class="fas fa-trash fa-sm"></i> Hapus</a>

                            <!-- <a class="dropdown-item" href="<?php echo base_url('admin/Teleconsultasi/hapusJadwal/'.$jt->id.'/'.$jt->id_dokter.'/'.$jt->id_pasien);?>" class="btn btn-danger" onclick="return confirm('yakin hapus Data Konsultasi?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                        </div>
                    </div>
                </td>
          			</tr>
          		<?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Poli</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th class="text-right">Aksi</th>
                  </tr>
                </tfoot>
              </table>
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
        <h5 class="modal-title">Hapus Data Jadwal Telekonsultasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url('admin/Teleconsultasi/hapusJadwal/'.$jt->id.'/'.$jt->id_dokter.'/'.$jt->id_pasien);?>">
      <div class="modal-body">
          <p>Anda yakin ingin menghapus data jadwal Telekonsultasi <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="buttonHapus">Ya</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  
  <?php if($this->session->flashdata('msg_jadwal_konsultasi')){ echo "<script>alert('".$this->session->flashdata('msg_jadwal_konsultasi')."')</script>"; } ?>