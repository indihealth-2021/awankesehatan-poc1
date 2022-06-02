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
              <h4 class="page-title">Riwayat Pembayaran Telekonsultasi</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran Telekonsultasi</li>
                </ol>
            </nav>
          </div>
      </div>
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_histori">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Konsultasi (S)udah / (B)elum</th>
  		              <th>Pasien</th>
                    <th>Dokter</th>
  		              <th>Biaya</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti Foto / Nomor Klaim</th>
  		              <th class="text-center">Status</th>
                   <!-- <th class="text-white text-center">Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0; 
                  foreach ($history as $data) {
                    $no++?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
                      <?php 
                      if($data->tanggal_konsultasi_b){
                        $sudah_konsultasi = '<font color="red">B</font>';
                        $tanggal_konsultasi = new DateTime($data->tanggal_konsultasi_b);
                        $tanggal_konsultasi = $tanggal_konsultasi->format('d-m-Y');
                      }
                      else{
                        $sudah_konsultasi = '<font color="green">S</font>';
                        if(!$data->tanggal_konsultasi_s){
                          $tanggal_konsultasi = '-';
                        }
                        else{
                          $tanggal_konsultasi = new DateTime($data->tanggal_konsultasi_s);
                          $tanggal_konsultasi = $tanggal_konsultasi->format('d-m-Y');
                        }
                      }
                      ?>
                      <td><?php echo $tanggal_konsultasi; ?></td>
                      <td><?php echo $sudah_konsultasi; ?></td>
                      <td><?php echo $data->nama_pasien; ?></td>
		                  <td><?php echo $data->nama_dokter; ?></td>
                      <?php 
                        $biaya_adm = $data->biaya_adm ? $data->biaya_adm:0;
                        $biaya_konsultasi = $data->biaya_konsultasi ? $data->biaya_konsultasi:0;
                        $total_harga = $biaya_konsultasi + $biaya_adm;

                        $biaya_adm = 'Rp. '.number_format($biaya_adm, 2, ',', '.');
                        $biaya_konsultasi = 'Rp. '.number_format($biaya_konsultasi, 2, ',', '.');
                      ?>
                      <td><?php echo 'Biaya Konsultasi: <span class="text-success">'.$biaya_konsultasi.'</span><br/><br/>Biaya Administrasi: <span class="text-success">'.$biaya_adm.'</span><br/><br/>Total Biaya: <span class="text-success">Rp. '.number_format($total_harga,2,',','.').'</span>'; ?></td>
                      <td><?php echo $data->metode_pembayaran == 1 ? "Transfer":"Owlexa"; ?></td>
                      <td>
                      <?php if($data->metode_pembayaran == 1){ ?>
                        <!-- Button trigger modal -->
                        <img data-toggle="modal" data-target="#exampleModal" height="50" width="50" src="<?php echo base_url('assets/images/bukti_pembayaran/'.$data->photo); ?>" class="myImg" alt="<?php echo $data->photo ?>">
                      
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
                      <?php }else{ echo $data->claim_number; }?>
                      </td>
		                  <td><?php echo $data->status == 1 ? 'Diverifikasi' : 'Ditolak' ?></td>
                      <!-- <td class="center" style="text-align: center;">
                        <div class="btn-group btn-group-sm">
			                 <a href="#" class="btn btn-success">verifikasi</i></a>
                        </div>
                      </td> -->
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Konsultasi (S)udah / (B)elum</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Total Biaya</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti Foto / Nomor Klaim</th>
                    <th class="text-center">Status</th>
                   <!-- <th class="text-white text-center">Aksi</th> -->
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
  
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
