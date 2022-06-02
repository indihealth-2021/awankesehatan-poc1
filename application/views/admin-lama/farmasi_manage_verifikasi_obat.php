<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
      <div class="row mb-5">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Verifikasi Resep Obat</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('farmasi/FarmasiVerifikasiObat/#');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verifikasi Obat</li>
                </ol>
            </nav>
          </div>
      </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-hover custom-table mb-0" id="table_farmasi">                
                              <thead>
                              <tr>
                                <th>No</th>
                                <th>Tanggal Konsultasi</th>
                                <th>Poli</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Diagnosa</th>
                                <th>Resep</th>
                                <th>Total Harga</th>
                                <th>Pemeriksa</th>
                                <th class="text-center">Aksi</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php foreach($list_resep as $idx=>$resep){ ?>
                                  <tr>
                                    <td><?php echo $idx+1; ?></td>
                                    <td><?php $tanggal = new DateTime($resep->tanggal_konsultasi); echo $tanggal->format('d-m-Y H:i:s'); ?></td>
                                    <td><?php echo $resep->nama_poli; ?></td>
                                    <td><?php echo $resep->nama_pasien; ?></td>
                                    <td><?php echo $resep->nama_dokter; ?></td>
                                    <td><?php echo $resep->diagnosis; ?></td>
                                    <td><?php echo $resep->detail_obat; ?></td>
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
                                    <td><?php echo $resep->nama_dokter; ?></td>
                                    <td class="text-center">
                                      <a class="btn btn-primary btn-primary-one" href="<?php echo base_url('admin/FarmasiVerifikasiObat/form_edit_resep/'.$resep->id_jadwal_konsultasi); ?>">Edit</a>
                                      <a href="<?php echo base_url('admin/FarmasiVerifikasiObat/verifikasi/'.$resep->id_jadwal_konsultasi); ?>" onclick="return confirm('Apakah anda yakin untuk verifikasi resep ini?');"><button class="btn btn-primary btn-primary-one mt-2">Verifikasi</button></a><br>
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
                                <th>Diagnosa</th>
                                <th>Resep</th>
                                <th>Total Harga</th>
                                <th>Pemeriksa</th>
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

<?php if($this->session->flashdata('msg_simpan_resep')){ echo "<script>alert('".$this->session->flashdata('msg_simpan_resep')."')</script>"; } ?>
<?php if($this->session->flashdata('msg_verif_resep')){ echo "<script>alert('".$this->session->flashdata('msg_verif_resep')."')</script>"; } ?>
