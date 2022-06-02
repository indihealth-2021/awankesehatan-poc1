    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header" style="background-color: #1F60A8; color: #fff">
                          <div class="card-title">Pembayaran</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-10" style="padding-left: 27px">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Tanggal Pembuatan Resep </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <?php echo $resep->created_at ?>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Resep </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <ul><?php echo $resep->detail_obat ?></ul>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Total Harga </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
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
                                                <?php echo 'Rp. '.number_format($total_harga,2,',','.'); ?>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Pemeriksa </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <?php echo ucwords($resep->nama_dokter) ?>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Status</label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <?php 
                                            if($bukti_pembayaran_obat){
                                                if($bukti_pembayaran_obat->status){
                                                    echo "Lunas";
                                                }
                                                else{
                                                    echo "Menunggu Verifikasi";
                                                }
                                            }
                                            else{
                                                echo "Belum Bayar";
                                            }
                                            ?>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 row">
                                        <div class="col-lg-12">
                                                    <?php if($bukti_pembayaran_obat){ ?>
                                                        <div class="row" style="padding-left: 4px">
                                                            <label for="" class="col-3 col-form-label">Bukti Pembayaran </label> <span class="col-1" style="padding-top: 5px; margin-left:6px">:</span>
                                                            <img src="<?php echo base_url('assets/images/bukti_pembayaran_obat/'.$bukti_pembayaran_obat->foto) ?>" class="col-5" style="max-width: 200px;">
                                                        </div>
                                                    <?php } else { ?>
                                                        <?php echo form_open_multipart("pasien/ResepDokter/bayar/".$id_jadwal_konsultasi) ?>   
                                                        <div class="form-group row" style="padding-left: 4px">
                                                            <label for="" class="col-3 col-form-label">Bukti Pembayaran </label> <span class="col-1" style="padding-top: 5px; margin-left:6px">:</span>
                                                            <!--<input type="hidden" name="id_dokter" value="">
                                                            <input type="hidden" name="regid" value="">-->
                                                            <div class="custom-file col-5" style="margin-left:10px;">
                                                                <input type="file" name="bukti_pembayaran" class="custom-file-input" id="file_upload" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                                                                <label class="custom-file-label" for="customFile" id="filename"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mt-5 mb-5">
                                                            <button class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff">Kirim</button>
                                                        </div>
                                                        </form>
                                                    <?php } ?>
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>          
<?php if($this->session->flashdata('msg_pmbyrn_obat')){ echo "<script>alert('".$this->session->flashdata('msg_pmbyrn_obat')."')</script>"; } ?>