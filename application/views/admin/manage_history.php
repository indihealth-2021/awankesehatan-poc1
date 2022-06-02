 <!-- Main content -->
 <div class="page-wrapper">
   <div class="content">
     <div class="row mb-3">
       <div class="col-sm-8 col-12 ml-3">
         <nav aria-label="">
           <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/payment') ?>" class="text-black">Pembayaran</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/History') ?>" class="text-black font-bold-7">Riwayat Pembayaran Telekonsultasi</a></li>
           </ol>
         </nav>
       </div>
       <div class="col-md-12 ml-3">
         <div class="box">
           <div class="container-1">
             <span class="icon" id="searchButton"><i class="fa fa-search font-16 text-tele"></i></span>
             <form method="GET" id="searchForm" action="<?php echo base_url('admin/History/index') ?>">
             <input type="search" name="nama_pasien" id="search" style="background: #ffffff !important;" value="<?php echo isset($_GET['nama_pasien']) ? $_GET['nama_pasien']:''; ?>" placeholder="Cari Pasien Disini" />
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
                 <table class="table table-border table-hover custom-table mb-0" id="table_history_pengiriman_obat">
                   <thead class="text-tr">

                   </thead>
                   <tbody class="font-14">
                     <?php $no = 0;
                      foreach ($history as $data) {
                        $page++; ?>
                        <?php 
                          $dompet_digital = $data->id_payment == 3 ? "OVO" : ($data->id_payment == 4 ? "DANA":"ShopeePay");
                        ?>
                       <tr class="font-12" style="border-top: 3px solid #21AAC4;">
                         <td colspan="1"></td>
                         <td colspan="1">
                           <?php
                           if($data->status == 1){
                            if ($data->tanggal_konsultasi_b) {
                              $sudah_konsultasi = '<font color="red">Belum Konsultasi</font>';
                              $tanggal_konsultasi = new DateTime($data->tanggal_konsultasi_b);
                              $tanggal_konsultasi = $tanggal_konsultasi->format('d-m-Y');
                            } else {
                              if (!$data->tanggal_konsultasi_s) {
                                $sudah_konsultasi = '<font color="red">Belum Konsultasi</font>';
                                $tanggal_konsultasi = '-';
                              } else {
                                $sudah_konsultasi = '<font color="green">Sudah Konsultasi</font>';
                                $tanggal_konsultasi = new DateTime($data->tanggal_konsultasi_s);
                                $tanggal_konsultasi = $tanggal_konsultasi->format('d-m-Y');
                              }
                            }
                           }else{
                            $sudah_konsultasi = '<font color="red">Belum Konsultasi</font>';
                            $tanggal_konsultasi = '-';
                           }
                            ?>
                           <span>Tanggal Konsultasi</span><br>
                           <?php echo $tanggal_konsultasi; ?>
                         </td>

                         <td colspan="1">
                           <span class="mr-2">Status Konsultasi</span><br>
                           <span><?php echo $sudah_konsultasi; ?></span>
                         </td>
                         <td colspan="6" class="text-right">
                           <span class="mr-2">Tanggal Pembayaran</span><br>
                           <span class="tgl-kirim"><?php echo (new DateTime($data->tanggal_pembayaran))->format('d-m-Y') ?></span>
                         </td>
                       </tr>

                       <tr class="text-top">
                         <td><?php echo $page; ?></td>
                         <td class="text-top">
                           <span class="font-tr-table">Pasien</span><br>
                           <?php echo $data->nama_pasien; ?>
                         </td>
                         <td class="text-top">
                           <span class="font-tr-table">Dokter</span><br>
                           <span><?php echo $data->nama_dokter; ?></span><br>
                           <span class="font-12"><?php //echo $resep->nama_poli; 
                                                  ?></span>
                         </td>
                         <td class="text-top" width="15%">
                           <?php
                            $biaya_adm = $data->biaya_adm ? $data->biaya_adm : 0;
                            $biaya_konsultasi = $data->biaya_konsultasi ? $data->biaya_konsultasi : 0;
                            $total_harga = $biaya_konsultasi + $biaya_adm;

                            $biaya_adm = 'Rp. ' . number_format($biaya_adm, 2, ',', '.');
                            $biaya_konsultasi = 'Rp. ' . number_format($biaya_konsultasi, 2, ',', '.');
                            ?>
                           <span class="font-tr-table">Biaya</span><br>
                           <?php echo 'Biaya Konsultasi: <span class="text-success">' . $biaya_konsultasi . '</span><br/><br/>Biaya Administrasi: <span class="text-success">' . $biaya_adm; ?>
                         <td class="text-top" width="10%">
                           <span class="font-tr-table">Total Biaya</span><br>
                           <?php echo '<span class="text-success">Rp. ' . number_format($total_harga, 2, ',', '.') . '</span>'; ?>
                         </td>
                         <td class="text-top" width="18%">
                           <span class="font-tr-table">Metode Bayar</span><br>
                           <?php echo $data->metode_pembayaran == 1 ? "Transfer" : ($data->metode_pembayaran == 2 ? "Owlexa":($data->metode_pembayaran == 3 ? "Virtual Account" : ($data->metode_pembayaran == 4 ? "Dompet Digital - ".$dompet_digital : "Credit Card / Debit Card"))); ?>
                         </td>
                         <td width="15%" class="text-top">
                           <span class="font-tr-table">Bukti Bayar/Nomor Claim/VA Num</span><br>
                           <?php if ($data->metode_pembayaran == 1) { ?>
                             <!-- Button trigger modal -->
                             <img data-toggle="modal" data-target="#exampleModal" height="61" width="88" src="<?php echo base_url('assets/images/bukti_pembayaran/' . $data->photo); ?>" class="myImg" alt="<?php echo $data->photo ?>">

                             <!-- Modal -->
                             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-scrollable">
                                 <div class="col-lg-12">
                                   <div class="modal-content modal-bukti" style="height: auto;">
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
                           <?php } else if($data->metode_pembayaran == 2){
                              echo $data->claim_number;
                            }else if($data->metode_pembayaran == 3){ ?>
                              <?php echo $data->va_number ?>
                            <?php } ?>
                         </td>
                         <td class="text-center">
                           <span class="font-tr-table">Status</span><br>
                           <span class="status-terkirim"><?php echo $data->status == 1 ? 'Diverifikasi' : 'Ditolak' ?></span>
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
     </div>
     <!-- /.card-body -->
   </div>
   <!-- /.card -->
 </div>