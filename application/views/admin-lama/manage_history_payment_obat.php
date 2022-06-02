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
              <h4 class="page-title">Riwayat Pembayaran Obat</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran Obat</li>
                </ol>
            </nav>
          </div>
      </div>
            <div class="table-responsive">
              <table class="table table-border table-hover custom-table mb-0" id="table_histori">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Resep</th>
                    <th>Total Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti Foto / Nomor Klaim</th>
                    <th>Status</th>
                   <!-- <th class="text-white text-center">Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($list_resep as $idx=>$data){ ?>
                    <tr class="odd gradeX">
                      <td><?php echo $idx+1 ?></td>
                      <td><?php echo $data->nama_pasien ?></td>
                      <td><ul><?php echo $data->detail_obat ?></ul></td>
                      <?php 
                          $list_harga_obat = explode(',', $data->harga_obat);
                          $list_harga_obat_per_n_unit = explode(',', $data->harga_obat_per_n_unit);
                          $list_jumlah_obat = explode(',', $data->jumlah_obat);
                          $jml_data = count($list_harga_obat);
                          $list_total_harga = [];
                          $total_harga = 0;
                          for($i=0; $i<$jml_data; $i++){
                              $list_total_harga[$i] = ( $list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i] ) * $list_harga_obat[$i];
                          }

                          foreach($list_total_harga as $tot_harga){
                              $total_harga+=$tot_harga;
                          }
                          $total_harga+=$data->biaya_pengiriman;
                      ?>
		                  <td><?php echo 'Rp. '.number_format($total_harga,2,',','.'); ?></td>
                      <td><?php echo $data->metode_pembayaran == 1 ? 'Transfer':'Owlexa'; ?></td>
                      <td>
                        <?php if($data->metode_pembayaran == 1){ ?>
                        <!-- Button trigger modal -->
                        <img data-toggle="modal" data-target="#exampleModal" width="50" height="50" src="<?php echo base_url('assets/images/bukti_pembayaran_obat/'.$data->foto_bukti); ?>" class="myImg" alt="">
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
                        <?php }else{ ?>
                          <?php echo $data->claim_number; ?>
                        <?php } ?>
                      </td>
            		      <td><?php 
                        if($data->status_bukti == 1){
                          echo "<font color='green'>Diverifikasi</font>";
                        }
                        else{
                          echo "<font color='red'>Ditolak</font>";
                        }
                      ?></td>
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
                    <th>Nama Pasien</th>
                    <th>Resep</th>
                    <th>Total Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti Foto / Nomor Klaim</th>
                    <th>Status</th>
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
