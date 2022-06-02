 <!-- Main content -->
 <div class="page-wrapper">
   <div class="content">
     <div class="row mb-3">
       <div class="col-sm-8 col-12 ml-3">
         <nav aria-label="">
           <ol class="breadcrumb" style="background-color: transparent;">
             <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/PembayaranObat') ?>" class="text-black">Pembayaran</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/PembayaranObat/history') ?>" class="text-black font-bold-7">Riwayat Pembayaran Obat</a></li>
           </ol>
         </nav>
       </div>
       <div class="ml-3 col-md-12">
         <div class="box">
           <div class="container-1">
             <span class="icon" id="searchButton"><i class="fa fa-search font-16 text-tele"></i></span>
             <form method="GET" id="searchForm" action="<?php echo base_url('admin/PembayaranObat/history') ?>">
               <input type="search" name="nama_pasien" id="search" style="background: #ffffff !important;" value="<?php echo isset($_GET['nama_pasien']) ? $_GET['nama_pasien'] : ''; ?>" placeholder="Cari Pasien Disini" />
             </form>
           </div>
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-md-12">
         <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="" data-toggle="tab">Poli</a></li>
            </ul> -->
         <div class="">
           <div class="tab-pane show pt-0">
             <div class="col-md-12">
               <div class="table-responsive pt-0">
                 <table class="table table-border table-hover custom-table mb-0" id="table_histori">
                   <thead class="text-tr">

                   </thead>
                   <tbody class="font-14">
                     <?php foreach ($list_resep as $idx => $data) {
                        $page++; ?>
                        <?php 
                        $dompet_digital = $data->id_payment == 3 ? 'OVO':($data->id_payment == 4 ? 'DANA':'ShopeePay');
                        ?>
                       <tr class="font-12" style="border-top: 3px solid #21AAC4;">
                         <td colspan="1"></td>
                         <td colspan="1">
                           <span>Tanggal Konsultasi</span><br>
                           <?php echo $data->tanggal_konsultasi ? (new DateTime($data->tanggal_konsultasi))->format('d-m-Y') : '-'; ?>
                         </td>

                         <td colspan="1">
                           <span class="mr-2">Status Konsultasi</span><br>
                           <span class="text-success">Sudah Konsultasi</span>
                         </td>
                         <td colspan="6" class="text-right">
                           <span class="mr-2">Tanggal Pembayaran</span><br>
                           <span class="tgl-kirim"><?php echo (new DateTime($data->tanggal_pembayaran))->format('d-m-Y H:i:s');
                                                    ?></span>
                         </td>
                       </tr>

                       <tr class="text-top">
                         <td><?php echo $page ?></td>
                         <td class="text-top" width="13%">
                           <span class="font-tr-table">Pasien</span><br>
                           <?php echo $data->nama_pasien ?>
                         </td>
                         <td class="text-top" width="10%">
                           <span class="font-tr-table">Resep</span><br>
                           <ul><?php echo $data->detail_obat ?></ul>
                         </td>
                         <?php
                          $list_harga_obat = explode(',', $data->harga_obat);
                          $list_harga_obat_per_n_unit = explode(',', $data->harga_obat_per_n_unit);
                          $list_jumlah_obat = explode(',', $data->jumlah_obat);
                          $jml_data = count($list_harga_obat);
                          $list_total_harga = [];
                          $total_harga = 0;
                          for ($i = 0; $i < $jml_data; $i++) {
                            $list_total_harga[$i] = ($list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i]) * $list_harga_obat[$i];
                          }

                          foreach ($list_total_harga as $tot_harga) {
                            $total_harga += $tot_harga;
                          }
                          $total_harga += $data->biaya_pengiriman;
                          ?>
                         </td>
                         <!-- <td class="text-top"  width="15%">
                                      <span class="font-tr-table">Biaya</span><br> -->
                         <?php //echo 'Biaya Konsultasi: <span class="text-success">'.$biaya_konsultasi.'</span><br/><br/>Biaya Administrasi: <span class="text-success">'.$biaya_adm.'</span><br/><br/>Total Biaya: <span class="text-success">Rp. '.number_format($total_harga,2,',','.').'</span>'; 
                          ?>
                         <td class="text-top" width="10%">
                           <span class="font-tr-table">Total Biaya</span><br>
                           <?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?>
                         </td>
                         <td class="text-top" width="18%">
                           <span class="font-tr-table">Metode Bayar</span><br>
                           <?php echo $data->metode_pembayaran == 1 ? 'Transfer' : ($data->metode_pembayaran == 2 ? 'Owlexa':($data->metode_pembayaran == 3 ? 'Virtual Account' : ($data->metode_pembayaran == 4 ? 'Dompet Digital - '.$dompet_digital:'Credit Card / Debit Card'))); ?>
                         </td>
                         <td width="18%" class="text-top">
                           <span class="font-tr-table">Bukti Bayar/Nomor Claim </span><br>
                           <?php if ($data->metode_pembayaran == 1) { ?>
                             <!-- Button trigger modal -->
                             <img data-toggle="modal" data-target="#exampleModal" width="88" height="61" src="<?php echo base_url('assets/images/bukti_pembayaran_obat/' . $data->foto_bukti); ?>" class="myImg" alt="">
                             <!-- Modal -->
                             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-scrollable">
                                 <div class="col-lg-12">
                                   <div class="modal-content modal-bukti" style="height: auto">
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
                           <?php } else if($data->metode_pembayaran == 2){ ?>
                             <?php echo $data->claim_number; ?>
                           <?php } else if($data->metode_pembayaran == 3){?>
                              <?php echo $data->va_number; ?>
                           <?php } ?>
                         </td>
                         <td class="text-center">
                           <span class="font-tr-table">Status</span><br>
                           <span class="status-terkirim"><?php
                                                          if ($data->status_bukti == 1) {
                                                            // echo "<font color='green'>Diverifikasi</font>";
                                                            echo "Diverifikasi";
                                                          } else if($data->status_bukti == 0 && ($data->metode_pembayaran == 3 || $data->metode_pembayaran == 4 || $data->metode_pembayaran == 5)){
                                                            echo "Belum Bayar";
                                                          }else if($data->status_bukti == 0){
                                                            echo "Sedang Diproses";
                                                          }else {
                                                            // echo "<font color='red'>Ditolak</font>";
                                                            echo "Ditolak";
                                                          }
                                                          ?>
                           </span>
                         </td>
                       </tr>
                     <?php } ?>
                   </tbody>
                 </table>
               </div>
               <div class="row pt-3">
                 <div class="col-sm-12">
                   <div>
                     <nav aria-label="Page navigation example">
                       <ul class="pagination justify-content-center">
                         <?php echo $pagination ?>
                       </ul>
                     </nav>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <!-- /.card-body -->
     </div>
     <!-- /.card -->
   </div>