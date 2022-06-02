<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Biaya Pengiriman Obat</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Biaya Pengiriman Obat</li>
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
                                <!-- <th>Biaya Pengiriman</th> -->
                                <th class="text-center">Aksi</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php foreach($list_resep as $idx=>$resep){ ?>
                                  <tr>
                                    <td><?php echo $idx+=1; ?></td>
                                    <td><?php $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi))->format('d-m-Y H:i:s'):'-'; 
                                        echo $tanggal_konsul;
                                    ?></td>
                                    <td><?php echo $resep->nama_poli; ?></td>
                                    <td><?php echo $resep->nama_pasien; ?></td>
                                    <td><?php echo $resep->nama_dokter; ?></td>
                                    <!-- <td><?php //echo 'Jalan '.ucwords(strtolower($resep->alamat_jalan)).', Kel '.ucwords(strtolower($resep->nama_kelurahan)).', Kec '.ucwords(strtolower($resep->nama_kecamatan)).', Kab/Kota '.ucwords(strtolower($resep->nama_kota)).', Kode Pos '.$resep->kode_pos.', Provinsi '.ucwords(strtolower($resep->nama_provinsi)) ?></td> -->
                                    <td><?php echo $resep->detail_obat ?></td>
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
                                    <td><?php echo 'Rp. '.number_format($total_harga,2,',','.'); ?></td>
                                    <?php $biaya_pengiriman = $resep->biaya_pengiriman ? $resep->biaya_pengiriman : 0; ?>
                                    <td id="biaya-pengiriman-<?php echo $resep->id_jadwal_konsultasi; ?>"><?php echo 'Rp. '.number_format($resep->biaya_pengiriman,2,',','.'); ?></td>
                                    <!-- <td>Rp. 15.000</td> -->
                                    <td class="text-center">
                                      <!-- <input type="number" name="harga_ongkir" class="form-control" id="id-jadwal-konsultasi-<?php echo $resep->id_jadwal_konsultasi; ?>" placeholder="Biaya Pengiriman"> -->
                                      <button class="btn btn-primary btn-block btnEdit" data-id-jadwal-konsultasi="<?php echo $resep->id_jadwal_konsultasi; ?>" data-alamat="<?php echo $resep->nama_provinsi && $resep->nama_kota && $resep->nama_kelurahan && $resep->nama_kecamatan && $resep->alamat_jalan && $resep->kode_pos ? 'Jalan '.ucwords(strtolower($resep->alamat_jalan)).', Kel '.ucwords(strtolower($resep->nama_kelurahan)).', Kec '.ucwords(strtolower($resep->nama_kecamatan)).', Kab/Kota '.ucwords(strtolower($resep->nama_kota)).', Kode Pos '.$resep->kode_pos.', Provinsi '.ucwords(strtolower($resep->nama_provinsi)) : ''; ?>" data-biaya-pengiriman="<?php echo $biaya_pengiriman; ?>" data-biaya-pengiriman-rp="<?php echo 'Rp. '.number_format($resep->biaya_pengiriman,2,',','.'); ?>" data-is-alamat-lengkap="<?php echo $resep->nama_provinsi && $resep->nama_kota && $resep->nama_kelurahan && $resep->nama_kecamatan && $resep->alamat_jalan && $resep->kode_pos ? '':' <sup>(<font color=\'red\'>*Alamat Tidak Lengkap*</font>)</sup>'; ?>" data-is-alamat-kustom="<?php if(!empty($resep->alamat_kustom)){ echo $resep->alamat_kustom == 1 ? '1':'0'; }else{ echo '0'; } ?>" data-alamat-kustom="<?php if(!empty($resep->alamat_kustom)){ echo $resep->alamat_kustom ? $resep->alamat_pengiriman : ''; } ?>" data-nama-pasien="<?php echo $resep->nama_pasien ?>" data-telp-pasien="<?php echo $resep->telp_pasien; ?>" data-email-pasien="<?php echo $resep->email_pasien ?>" data-tipe="edit" data-toggle="modal" data-target="#modalBiayaPengiriman">Biaya Pengiriman</button>
                                      <button class="btn btn-success btn-block btnSubmit" data-id-jadwal-konsultasi="<?php echo $resep->id_jadwal_konsultasi; ?>" data-alamat="<?php echo !empty($resep->alamat_kustom) ? $resep->alamat_pengiriman : '' ?>" data-biaya-pengiriman="<?php echo $biaya_pengiriman; ?>" data-biaya-pengiriman-rp="<?php echo 'Rp. '.number_format($resep->biaya_pengiriman,2,',','.'); ?>" data-is-alamat-lengkap="<?php echo $resep->nama_provinsi && $resep->nama_kota && $resep->nama_kelurahan && $resep->nama_kecamatan && $resep->alamat_jalan && $resep->kode_pos ? '':' <sup>(<font color=\'red\'>*Alamat Tidak Lengkap*</font>)</sup>'; ?>" data-tipe="submit" data-harga-obat="<?php echo $total_harga; ?>" data-harga-obat-rp="<?php echo str_replace(',00','', 'Rp. '.number_format($total_harga,2,',','.')); ?>" data-total-harga="<?php echo $total_harga+$biaya_pengiriman ?>" data-total-harga-rp="<?php echo str_replace(',00','','Rp. '.number_format($total_harga+$biaya_pengiriman,2,',','.')); ?>" data-nama-pasien="<?php echo $resep->nama_pasien ?>" data-telp-pasien="<?php echo $resep->telp_pasien; ?>" data-email-pasien="<?php echo $resep->email_pasien ?>" data-toggle="modal" data-target="#modalBiayaPengiriman">Submit</button>
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

<div class="modal fade" id="modalBiayaPengiriman" tabindex="-1" role="dialog" aria-labelledby="modalBiayaPengirimanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBiayaPengirimanLabel">Biaya Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url('admin/PengirimanObat/rilis_obat') ?>">
      <div class="modal-body">
        <div class="form-group">
            <label for="nama-pasien">Nama </label>
            <input type="text" class="form-control" id="nama-pasien" aria-describedby="namaPasienHelp" placeholder="Nama Pasien" disabled="disabled" readonly>
        </div>
        <div class="form-group">
            <label for="telp">No HP </label>
            <input type="text" class="form-control" id="telp" aria-describedby="telpHelp" placeholder="No HP" disabled="disabled" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email </label>
            <input type="text" class="form-control" id="email-pasien" placeholder="Email Pasien" disabled="disabled" readonly>
        </div>
        <hr>
        <div class="form-group">
          <label for="alamat">Alamat <span class="edit-form" id="isAlamatLengkap"></span></label>
          <textarea class="form-control" id="alamat" name="alamat" readonly></textarea>
          <span class="edit-form form-text text-muted">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="alamat_kustom" id="inlineRadio1" value="0">
              <label class="form-check-label" for="inlineRadio1">Alamat Pasien</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="alamat_kustom" id="inlineRadio2" value="1">
              <label class="form-check-label" for="inlineRadio2">Alamat Lain</label>
            </div>
          </span>
        </div>
        <div class="form-group submit-form">
          <label for="harga-obat">Harga Obat</label>
          <input type="number" name="harga_obat" class="form-control" id="harga-obat" aria-describedby="biayaPengirimanHelp" placeholder="Harga Obat" disabled="disabled" readonly>
          <small id="hargaObatHelp" class="form-text text-muted">Rp. 0,0</small>
        </div>
        <div class="form-group">
          <label for="biaya-pengiriman">Biaya Pengiriman</label>
          <input type="number" name="biaya_pengiriman" class="form-control" id="biaya-pengiriman" aria-describedby="biayaPengirimanHelp" placeholder="Biaya Pengiriman" required>
          <small id="biayaPengirimanHelp" class="form-text text-muted">Rp. 0,0</small>
        </div>
        <div class="form-group submit-form">
          <label for="total-harga">Total Harga</label>
          <input type="number" name="total_harga" class="form-control" id="total-harga" aria-describedby="biayaPengirimanHelp" placeholder="Total Harga" disabled="disabled" readonly>
          <small id="totalHargaHelp" class="form-text text-muted">Rp. 0,0</small>
        </div>
        <input type="hidden" name="id_jadwal_konsultasi" id="id_jadwal_konsultasi">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success buttonSave" id="saveBiayaPengiriman">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>

<script type="text/javascript">
    
    var rupiah = document.getElementById('biaya-pengiriman');
    var show_to = document.getElementById('biayaPengirimanHelp');
    rupiah.addEventListener('change', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      show_to.innerHTML = formatRupiah(this.value, 'Rp. ');
    });

    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      show_to.innerHTML = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  </script>  

<?php if($this->session->flashdata('msg_biaya_pengiriman')){ echo "<script>alert('".$this->session->flashdata('msg_biaya_pengiriman')."')</script>"; } ?>
