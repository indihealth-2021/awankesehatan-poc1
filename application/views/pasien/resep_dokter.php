 <!-- Main content -->
 <div class="page-wrapper">
      <div class="content">
          <div class="row mb-3">
              <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/ResepDokter') ?>"class="text-black font-bold-7">Resep Obat</a></li>
                    </ol>
                </nav>
              </div>
              <div class="col-sm-12 col-12">
                  <h3 class="page-title">Resep Obat</h3>
              </div>
          </div> 
          <div class="row">
            <div class="col-md-12">
              <div class="bg-tab p-3">
                <div class="row">
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
                <table class="table table-border table-hover custom-table mb-0" id="table_resep">
                                    <thead class="text-tr">
                                        <tr>                                            
                                            <th class="text-left">No</th>
                                            <th>Tanggal Konsultasi</th>
                                            <th width="250px">Resep</th>
                                            <th>Total Harga</th>
                                            <th>Pemeriksa</th>
                                            <th class="text-center">Aksi</th>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($list_resep as $idx => $resep){?>
                                        <?php if($resep->status_bukti != 1){ ?>
                                            <tr>        
                                                <td class="text-center"><?php echo $idx+1 ?></td>
                                                <td>
                                                <?php $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi))->format('d-m-Y H:i:s'):'-'; 
                                                    echo $tanggal_konsul;
                                                ?></td>
                                                <td><ul><?php echo $resep->detail_obat ?></ul></td>
                                                <?php 
                                                    $list_harga_obat = explode(',', $resep->harga_obat);
                                                    $list_harga_obat_per_n_unit = explode(',', $resep->harga_obat_per_n_unit);
                                                    $list_jumlah_obat = explode(',', $resep->jumlah_obat);
                                                    $jml_data = count($list_harga_obat);
                                                    $list_total_harga = [];
                                                    $total_harga = 0;
                                                    for($i=0; $i<$jml_data; $i++){
                                                        $list_total_harga[$i] = ( $list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i] ) * $list_harga_obat[$i];
                                                    }

                                                    foreach($list_total_harga as $tot_harga){
                                                        $total_harga+=$tot_harga;
                                                    }
                                                    $total_harga+=$resep->biaya_pengiriman;
                                                ?>
                                                <td><?php echo 'Rp. '.number_format($total_harga,2,',','.'); ?></td>
                                                <td><?php echo $resep->nama_dokter ?></td>    
                                                <?php 
                                                    if($resep->status_bukti && $resep->diverifikasi_user == 1){
                                                        if($resep->status_bukti == 1){
                                                          if($user->vip == 1){
                                                            if($resep->diterima_user == 1){
                                                              $directLink = base_url('pasien/ResepDokter/pembayaran/'.$resep->id_jadwal_konsultasi);
                                                              $button = 'Diterima';
                                                              $warna = 'lunas';
                                                            } else{
                                                              $directLink = base_url('pasien/ResepDokter/terima/'.$resep->id_jadwal_konsultasi);
                                                              $button = 'Belum Diterima';
                                                              $warna = 'simpan';
                                                            }
                                                          }else{
                                                            $directLink = base_url('pasien/ResepDokter/pembayaran/'.$resep->id_jadwal_konsultasi);
                                                            $button = 'Lunas';
                                                            $warna = 'lunas';
                                                          }
                                                        }
                                                        else if($resep->status_bukti == 0){
                                                            $button = 'Sedang Diproses';
                                                            $warna = 'simpan';
                                                        }
                                                        else{
                                                          $directLink = base_url('pasien/ResepDokter/pembayaran/'.$resep->id_jadwal_konsultasi);
                                                          $button = 'Bayar';
                                                          $warna = 'bayar';                                 
                                                        }
                                                    }
                                                    else{
                                                        $directLink = base_url('pasien/ResepDokter/konfirmasi/'.$resep->id_jadwal_konsultasi);
                                                        $button = 'Konfirmasi Obat';
                                                        $warna = 'bayar';
                                                    }
                                                ?>
                                                <td class='text-center'>
                                                <a href="<?php echo $directLink ?>" class='btn btn-<?php echo $warna ?>  font-12'> <?php echo $button ?></a>
                                                <?php } ?>
                                                <?php if($resep->status_bukti == null){ ?>
                                                  <a href="#modalHapus" data-toggle="modal" data-href="<?php echo base_url('pasien/ResepDokter/batalkan/'.$resep->id_jadwal_konsultasi) ?>" data-tipe="resep" data-title="Pembatalan" data-nama="resep dokter ini" onclick="$('#modalHapus #form')" class="ml-2">
                                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                      <path d="M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z" fill="black" fill-opacity="0.35"/>
                                                      <path d="M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z" fill="black" fill-opacity="0.35"/>
                                                      </svg></i>
                                                  </a>
                                                <?php }else{ ?>
                                                <?php   if(!$resep->status_bukti){ ?>
                                                  <a href="#modalHapus" data-toggle="modal" data-href="<?php echo base_url('pasien/ResepDokter/batalkan_pembayaran/'.$resep->id_bukti_obat) ?>" data-tipe="pembayaran" data-title="Pembatalan Pembayaran" data-nama="resep dokter ini" onclick="$('#modalHapus #form')" class="ml-2">
                                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z" fill="black" fill-opacity="0.35"/>
                                                    <path d="M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z" fill="black" fill-opacity="0.35"/>
                                                    </svg></i>
                                                  </a>
                                                <?php   } ?>
                                                <?php } ?>
                                                </td>                              
                                            </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                    </table>
              </div> 
              </div>
            </div>
          </div>                          
        </div>
      </div>
<?php if($this->session->flashdata('msg_resep_dokter')){ ?>
<script>
alert("<?php echo $this->session->flashdata('msg_resep_dokter') ?>");
</script>
<?php } ?>


<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-modal-header p-3 title">Pembatalan Resep Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body font-modal-body">
          <p class="p-3">Anda yakin menyetujui <b class="tipe"></b> <span id="nama"></span> ?</p>
      </div>
      <div class="modal-footer">
        <div class="mx-auto">
          <a href="" class="btn btn-ya" id="buttonHapus">Ya</a>
          <button type="button" class="btn btn-tidak ml-5" data-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>
  </div>

<?php if($this->session->flashdata('msg_pmbyrn_obat')){ ?>
<script>
alert("<?php echo $this->session->flashdata('msg_pmbyrn_obat'); ?>")
</script>
<?php } ?>