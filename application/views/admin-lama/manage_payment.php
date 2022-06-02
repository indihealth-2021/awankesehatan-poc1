<style type="text/css">
  .modal-bukti{
    width: 30rem;
    height: 30rem;
  }
  </style>
<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Verifikasi Pembayaran Telekonsultasi</h4>
          </div>
          <div class="col-sm-7 col7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran Telekonsultasi</li>
                </ol>
            </nav>
          </div>
      </div>
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_verifikasi_payment">
                <thead>
                  <tr>
                    <th>No</th>
              		  <th>Pasien</th>
              		  <th>Biaya</th>
                    <th>Bukti Foto</th>
                    <th>Status</th>
  		              <th>Tanggal Upload</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0; 
                  foreach ($payment as $data) {
                    $no++ ?>
		                  <?php $data->status = $data->id_status_pembayaran == 2  ? 'Belum Diverifikasi' : 'Sudah Diverifikasi' ?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->name; ?></td>
                      <?php 
                        $biaya_konsultasi = $data->biaya_konsultasi ? 'Rp. '.number_format($data->biaya_konsultasi, 2, ',', '.'):'Biaya Konsultasi belum diset di bukti_pembayaran ( Kemungkinan dari Mobile )';
                        $biaya_adm = $data->biaya_adm ? 'Rp. '.number_format($data->biaya_adm, 2, ',', '.'):'Biaya Administrasi belum diset di bukti_pembayaran ( Kemungkinan dari Mobile )';
                      ?>
		                  <td><?php echo 'Biaya Konsultasi: <span class="text-success">'.$biaya_konsultasi.'</span><br/><br/>Biaya Administrasi: <span class="text-success">'.$biaya_adm.'</span><br/><br/>Total Biaya: <span class="text-success">'.$data->total_biaya.'</span>'; ?></td>
            		      <!-- <td><img data-toggle="modal" data-target="#myModal" style="width:100px; max-height: auto;" src="<?php echo $data->photo; ?>" alt="<?php //echo $data->photo ?>" class="myImg"></td> -->
                      <td>
                        <!-- Button trigger modal -->
                        <img data-toggle="modal" data-target="#exampleModal" width="50" height="50" src="<?php echo $data->photo; ?>" alt="<?php echo $data->photo ?>" class="myImg">
                      
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" >
                        <div class="col-lg-12">
                          <div class="modal-content modal-bukti" >
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Bukti</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                              <img class="modal-body modal-bukti">
                            <!-- <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div> -->
                          </div>
                        </div>
                          
                        </div>
                      </div>

                      </td>
            		      <td><?php echo $data->status; ?></td>
            		      <td><?php $tanggal = new DateTime($data->tanggal_upload_pembayaran); echo $tanggal->format('d-m-Y H:i:s');  ?></td>          
                      <td class="center" style="text-align: center;">
                      <div class="btn-group btn-group-sm">
	               		  <a href="<?php echo base_url('admin/Payment/update/'.$data->id_bukti);?>" class="btn btn-success bnt-sm"><i class="fas fa-check-circle"></i> verifikasi</i></a>
				              <a href="<?php echo base_url('admin/Payment/delete/'.$data->id_bukti);?>" onclick="confirm('Anda yakin ingin menghapus bukti ini?')" class="btn btn-danger btn-sm"><i class="fas fa-close"></i> hapus</a>
                        </div>
                      </td>
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Total Biaya</th>
                    <th>Bukti Foto</th>
                    <th>Status</th>
                    <th>Tanggal Upload</th>
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

    <?php if($this->session->flashdata('msg_payment')){ echo "<script>alert('".$this->session->flashdata('msg_payment')."')</script>"; } ?>
