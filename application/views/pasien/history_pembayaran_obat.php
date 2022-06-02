<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Pembayaran/history_obat') ?>"class="text-black font-bold-7">Riwayat Pembayaran Obat</a></li>
                </ol>
            </nav>
            </div>
            <div class="col-sm-12 col-12">
                <h3 class="page-title">Riwayat Pembayaran Obat</h3>
            </div>
        </div> 


        <div class="row">
            <div class="col-md-12">
                <div class="bg-tab p-3">
                    <div class="row mb-4">
                      <div class="col-md-3 mx-3">
                            <div class="box">
                                <div class="container-1 ">
                                    <span class="icon"><i class="fa fa-search font-16"></i></span>
                                    <input type="search" id="search" placeholder="Cari Dokter Disini" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-border table-hover custom-table mb-0" id="table_histori">
                            <thead class="text-tr">
                                <tr class="font-16">
                                    <th>No</th>
                                    <th>Tanggal Konsultasi</th>
                                    <th style="max-width: 20px;">Resep</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Bukti Foto / Nomor Klaim / VA Num</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Order Status</th>
                                    <th>Tanggal Upload</th>
                                </tr>
                            </thead>
                            <tbody class="font-14">
                                <?php foreach($list_pembayaran as $idx=>$bpo){ ?>
                                    <?php 
                                        $dompet_digital = $bpo->id_payment == 3 ? 'OVO':($bpo->id_payment == 4 ? 'DANA':'ShopeePay');    
                                    ?>
                                <tr>
                                    <td align="center"><?php echo $idx+1; ?></td>
                                    <td><?php $tanggal_konsul = $bpo->tanggal_konsultasi ? (new DateTime($bpo->tanggal_konsultasi))->format('d-m-Y H:i:s'):'-';
                                        echo $tanggal_konsul;
                                    ?></td>
                                    <td></ul><?php echo $bpo->detail_obat; ?></ul></td>
                                    <td><?php echo $bpo->metode_pembayaran == 1 ? 'Transfer':($bpo->metode_pembayaran == 2 ? 'Owlexa':($bpo->metode_pembayaran == 3 ? 'Virtual Account' : ($bpo->metode_pembayaran == 4 ? 'Dompet Digital - '.$dompet_digital : 'Credit Card / Debit Card') )); ?></td>
                                    <td><?php if($bpo->metode_pembayaran == 1){ ?>
                                            <img src="<?php echo base_url('assets/images/bukti_pembayaran_obat/'.$bpo->foto) ?>" style="max-width: 150px;">
                                        <?php }else if($bpo->metode_pembayaran == 2){ ?>
                                            <?php echo $bpo->claim_number; ?>
                                        <?php }else if($bpo->metode_pembayaran == 3){ ?>
                                            <?php echo $bpo->va_number; ?>
                                        <?php } ?>
                                    </td>
                                    <?php 
                                        $list_harga_obat = explode(',', $bpo->harga_obat);
                                        $list_harga_obat_per_n_unit = explode(',', $bpo->harga_obat_per_n_unit);
                                        $list_jumlah_obat = explode(',', $bpo->jumlah_obat);
                                        $jml_data = count($list_harga_obat);
                                        $list_total_harga = [];
                                        $total_harga = 0;
                                        for($i=0; $i<$jml_data; $i++){
                                            $list_total_harga[$i] = ( $list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i] ) * $list_harga_obat[$i];
                                        }

                                        foreach($list_total_harga as $tot_harga){
                                            $total_harga+=$tot_harga;
                                        }
                                        $total_harga+=$bpo->biaya_pengiriman;
                                    ?>
                                    <td><?php echo 'Rp. '.number_format($total_harga,2,',','.'); ?></td>
                                    <?php if ($bpo->status == 1) {
                                                    $status = $bpo->metode_pembayaran == 1 ? '<font color="green">Lunas</font>':'<font color="green">PAID</font>';
                                            }else if($bpo->status == 0 && ($bpo->metode_pembayaran == 3 || $bpo->metode_pembayaran == 4 || $bpo->metode_pembayaran == 5)){
                                                    $status = '<font color="red">Belum Bayar</font>';
                                            }else if ($bpo->status == 0)  {
                                                    $status = '<font color="blue">Sedang Diproses</font>';
                                            }else{
                                                $status = '<font color="red">Ditolak</font>';
                                            } ?>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo $bpo->order_status == 2 ? 'On Progress':($bpo->order_status == 3 ? 'REJECTED':($bpo->order_status == 1 ? 'DELIVERED':'PENDING')); ?><?php if($bpo->metode_pengiriman == 2){ ?><br/><button class="btn btn-success btn-block" data-toggle="modal" data-target="#modalTrackingJNE" data-token="<?= $bpo->token ?>" data-resi="<?= $bpo->no_resi ?>" id="btnTrack-1" type="button"><i class="fas fa-search"></i> Track</button><?php } ?></td>
                                    <?php
                                    $tanggal = new DateTime($bpo->created_at);
                                    $tanggal = $tanggal->format('d-m-Y H:i:s');
                                    ?>
                                    <td><?php echo $tanggal; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>  
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTrackingJNE" tabindex="-1" role="dialog" aria-labelledby="modalTrackingJNETitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="height: 400px">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tracking Obat JNE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow-y: scroll;">
        <div class="row">
            <div class="col-4">
                <b>Status</b>
            </div>
            <div class="col-1">
                :
            </div>
            <div class="col-7">
                <span class="status-text"></span>
            </div>

            <div class="col-4">
                <b>Alamat Pengirim</b>
            </div>
            <div class="col-1">
                :
            </div>
            <div class="col-7">
                <span class="alamat-pengirim"></span>
            </div>

            <div class="col-4">
                <b>Alamat Penerima</b>
            </div>
            <div class="col-1">
                :
            </div>
            <div class="col-7">
                <span class="alamat-penerima"></span>
            </div>
        </div>
        <div class="row mt-4" style="background-color: #E8EFEB; border: 0.5px solid #000">
            <div class="col-4">
                <img src="" alt="foto-kurir" class="img-fluid foto-kurir">
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-12" style="border-bottom: 1px solid #000;">
                        <h3>Kurir JNE</h3>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <i class="fas fa-user"></i> <span class="nama-kurir"></span><br/>
                        <i class="fas fa-motorcycle"></i> <span class="nopol-kurir"></span><br/>
                        <i class="fas fa-phone"></i> <span class="nomor-kurir"></span>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>