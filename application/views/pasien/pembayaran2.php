
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
                                          <label for="" class="col-3 col-form-label">No Registratsi </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <input type="text" class="form-control-plaintext" id="" value="<?php echo $registrasi->registrasi_id ?>" name="">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Poli </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <input type="text" class="form-control-plaintext" id="" value="<?php echo $registrasi->poli; ?>" name="">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Dokter </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <input type="text" class="form-control-plaintext" id="" value="<?php echo $registrasi->nama_dokter;?>" name="">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Jumlah </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <input type="text" class="form-control-plaintext" id="" value="<?php $harga = $this->db->query('SELECT harga FROM nominal WHERE poli = "'.$registrasi->poli.'"')->row(); echo 'Rp. '.number_format($harga->harga,2,',','.');; ?>" name="">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row" style="padding-left: 6px">
                                          <label for="" class="col-3 col-form-label">Status </label> <span class="col-1" style="padding-top: 5px">:</span>
                                          <div class="col-8">
                                            <input type="text" class="form-control-plaintext" id="" value="<?php echo $registrasi->keterangan;?>" name="">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 row">
                                        <div class="col-lg-12">
                                            <?php
                                            if($registrasi->id_status_pembayaran == 0){
                                                
                                                echo '
                                                    '.form_open_multipart("pasien/Pembayaran/bayar").'
                                                    <div class="form-group row" style="padding-left: 4px">
                                                        <label for="" class="col-3 col-form-label">Bukti Pembayaran </label> <span class="col-1" style="padding-top: 5px; margin-left:6px">:</span>
                                                        <input type="hidden" name="id_dokter" value="'.$registrasi->id_dokter.'">
                                                        <input type="hidden" name="regid" value="'.$registrasi->registrasi_id.'">
                                                        <div class="custom-file col-5" style="margin-left:10px;">
                                                            <input type="file" name="bukti_pembayaran" class="custom-file-input" id="file_upload" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                                                            <label class="custom-file-label" for="customFile" id="filename"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mt-5 mb-5">
                                                        <button class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff">Kirim</button>
                                                    </div>
                                                    </form>';
                                            }
                                            else{
                                                $bukti_pembayaran = $this->db->query('SELECT * FROM bukti_pembayaran WHERE id_pasien = '.$this->session->userdata('id_user').' AND id_registrasi = "'.$registrasi->registrasi_id.'"')->row();
                                                echo '
                                                    <img src="'.base_url("assets/images/bukti_pembayaran/".$bukti_pembayaran->photo).'" style="max-width: 200px;" />
                                                ';
                                            }
                                            ?>
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
            