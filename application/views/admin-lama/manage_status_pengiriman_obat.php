<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Pengiriman Obat</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengiriman Obat</li>
                </ol>
            </nav>
          </div>
      </div>
                <div class="row">
                    <!-- <div class="col-sm-12 col-9 text-right m-b-20">
                        <a href="<?php echo base_url('admin/Obat/form_tambah') ?>" class="btn btn btn-primary btn-rounded float-left"><i class="fa fa-plus"></i> Tambah Obat</a>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-hover custom-table mb-0" id="table_obat">                
                              <thead>
                              <tr>
                                <th>No</th>
                                <th>Tanggal Konsultasi</th>
                                <th>Poli</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <!-- <th>Alamat Pasien</th> -->
                                <th>Resep</th>
                                <th>Harga Obat</th>
                                <th>Biaya Pengiriman</th>
                                <th>Alamat Pengiriman</th>
                                <!-- <th>Biaya Pengiriman</th> -->
                                <th class="text-center">Aksi</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php foreach($list_resep as $idx=>$resep){ ?>
                                  <tr>
                                    <td style="vertical-align:text-top"><?php echo $idx+=1; ?></td>
                                    <td style="vertical-align:text-top"><?php $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi))->format('d-m-Y H:i:s'):'-'; 
                                        echo $tanggal_konsul;
                                    ?></td>
                                    <td style="vertical-align:text-top"><?php echo $resep->nama_poli; ?></td>
                                    <td style="vertical-align:text-top"><?php echo $resep->nama_pasien; ?></td>
                                    <td style="vertical-align:text-top"><?php echo $resep->nama_dokter; ?></td>
                                    <td style="vertical-align:text-top"><?php echo $resep->detail_obat ?></td>
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
                                                ?>
                                    <td style="vertical-align:text-top"><?php echo 'Rp. '.number_format($total_harga,2,',','.'); ?></td>
                                    <?php $biaya_pengiriman = $resep->biaya_pengiriman ? $resep->biaya_pengiriman : 0; ?>
                                    <td style="vertical-align:text-top"><?php echo 'Rp. '.number_format($resep->biaya_pengiriman,2,',','.'); ?></td>
                                    <td style="vertical-align:text-top"><?php echo $resep->alamat ?></td>
                                    <td class="text-center">
                                      <button class="btn btn-success btn-block" data-link="<?php echo base_url('admin/PengirimanObat/kirim_obat/'.$resep->id_bukti) ?>" data-toggle="modal" data-target="#modalPengiriman">KIRIM</button>
                                  </td>
                                  </tr>
                              <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>No</th>
                                <th>Tanggal Konsultasi</th>
                                <th>Poli</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <!-- <th>Alamat Pasien</th> -->
                                <th>Resep</th>
                                <th>Harga Obat</th>
                                <th>Biaya Pengiriman</th>
                                <th>Alamat Pengiriman</th>
                                <!-- <th>Biaya Pengiriman</th> -->
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

<div class="modal fade" id="modalPengiriman" tabindex="-1" role="dialog" aria-labelledby="modalPengirimanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPengirimanLabel">Pengiriman Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan mengirim barang ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-success"><a href="" class="text-white" id="link-delete">Yakin</a></button>
      </div>
    </div>
    </form>
  </div>
</div>

<?php if($this->session->flashdata('msg_kirim_obat')){ echo "<script>alert('".$this->session->flashdata('msg_kirim_obat')."')</script>"; } ?>