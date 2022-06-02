<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-12">
              <h4 class="page-title">Pembayaran</h4>
          </div>
          <div class="col-sm-7 col-12">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('pasien/pasien');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran Obat</li>
                </ol>
            </nav>
          </div>
      </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 card-box">
                            <div class="row text-black">
                                <div class="col-sm-12 col-12">
                                    <h4 align="center" class="mb-5"><u>Pembayaran Resep Obat</u></h4>    
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Tanggal Konsultasi</label>
                                        <label class="col-sm-1 col-1"> :</label>
                                        <div class="col-md-7 col-7">
                                        <?php 
                                        $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi))->format('d-m-Y H:i:s'):'-';
                                        ?>
                                            <p><?php echo $tanggal_konsul ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Pemeriksa</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7">
                                            <p><?php echo ucwords($resep->nama_dokter) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Resep</label>
                                        <label class="col-md-1 col-1">:</label>
                                        <div class="col-md-7 col-7" style="padding-left: 30px; margin-top:-15px;">
                                            <p><?php echo $resep->detail_obat ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Harga Obat</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7"> 
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
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Biaya Pengiriman</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7"> 
                                                <?php echo 'Rp. '.number_format($resep->biaya_pengiriman,2,',','.'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Total Harga</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7"> 
                                                <?php echo 'Rp. '.number_format($total_harga+=$resep->biaya_pengiriman,2,',','.'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Alamat Pengiriman</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7"> 
                                                <?php echo $resep->alamat_pengiriman; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Status</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7"> 
                                            <?php 
                                            if($bukti_pembayaran_obat){
                                                if($bukti_pembayaran_obat->status){
                                                    echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? "<font color='green'>Lunas</font>":"<font color='green'>PAID</font>";
                                                }
                                                else{
                                                    echo "<font color='blue'>Menunggu Verifikasi</font>";
                                                }
                                            }
                                            else{
                                                echo "<font color='red'>Belum Bayar</font>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label for="metode-pembayaran" class="col-md-4 col-4">Metode Pembayaran</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7">
                                            <div class="row" style="padding-left: 12px">
                                            <?php if(!$bukti_pembayaran_obat){ ?>
                                                <select class="form-control col-10" name="metode_pembayaran" id="metode-pembayaran">
                                                    <option value="1" selected>Transfer</option>
                                                    <option value="2">Owlexa</option>
                                                </select>
                                            <?php }else{ ?>
                                                <?php echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? 'Transfer':'Owlexa';?>
                                            <?php } ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!$bukti_pembayaran_obat){ ?>
                                <div class="col-sm-12">
                                    <hr align="center">
                                </div>
                                <?php } ?>
                                <div class="col-sm-12 col-12 <?php echo !$bukti_pembayaran_obat ? 'metode-transfer':''; ?>">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4"><?php if($bukti_pembayaran_obat){ echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? 'Bukti Pembayaran':'Claim Number'; } else { echo 'Bukti Pembayaran'; } ?></label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7"  style="padding-left: 30px;">
                                            <?php if($bukti_pembayaran_obat){ ?>
                                                        <div class="row" style="padding-left: 4px">
                                                            <?php if($bukti_pembayaran_obat->metode_pembayaran == 1){ ?>
                                                                <img src="<?php echo base_url('assets/images/bukti_pembayaran_obat/'.$bukti_pembayaran_obat->foto) ?>" class="col-5" style="max-width: 200px;">
                                                            <?php }else{ ?>
                                                                <?php echo $bukti_pembayaran_obat->claim_number; ?>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } else { ?>
                                                        <?php echo form_open_multipart("pasien/ResepDokter/bayar/".$id_jadwal_konsultasi) ?>   
                                                        <div class="form-group row">
                                                            <div class="custom-file col-10">
                                                                <input type="file" name="bukti_pembayaran" class="custom-file-input" id="file_upload" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                                                                <label class="custom-file-label" for="customFile" id="filename"></label>
                                                            </div>
                                                        </div>
                                                <?php } ?>
                                        </div>
                                    </div>
                                        <?php if($bukti_pembayaran_obat && $bukti_pembayaran_obat->status != 1){ ?>
                                        <div class="form-group row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                                            <?php echo form_open_multipart("pasien/ResepDokter/bayar/".$id_jadwal_konsultasi) ?>   
                                                            <div class="form-group row">
                                                                <!--<input type="hidden" name="id_dokter" value="">
                                                                <input type="hidden" name="regid" value="">-->
                                                                <div class="custom-file col-10">
                                                                    <input type="file" name="bukti_pembayaran" class="custom-file-input" id="file_upload" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png">
                                                                    <label class="custom-file-label" for="customFile" id="filename"></label>
                                                                </div>
                                                            </div>
                                        </div>
                                        </div>
                                        <?php } ?>
                                            <?php if(!$bukti_pembayaran_obat){ ?>
                                            <div class="mt-20 col-sm-4 offset-lg-4">
							                                <button class="btn btn-success submit-btn btn-block"><i class=""></i> KIRIM</button>
							                            </div>
                                                        </form>
                                            <?php }else{ ?>
											<?php if($bukti_pembayaran_obat->status != 1){ ?>
                                            <div class="mt-20 col-sm-4 offset-lg-4">
							                                <button class="btn btn-success submit-btn btn-block"><i class=""></i> KIRIM</button>
							                            </div>
                                                        </form>
											<?php } ?>
                                            <?php } ?>
                                </div>
                                <?php 
                                    if(!$bukti_pembayaran_obat){
                                ?>
                                <div class="col-sm-12 metode-owlexa pt-3">
                                <form method="POST" action="<?php echo base_url('pasien/ResepDokter/bayar_owlexa/'.$id_jadwal_konsultasi); ?>">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Nama Lengkap</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7" style="padding-left: 25px">
                                            <div class="row" style="padding-left: 4px">
                                                <input type="text" class="form-control col-10" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>" disabled readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 metode-owlexa">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Nomor Kartu</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7" style="padding-left: 25px">
                                            <div class="row" style="padding-left: 4px">
                                                <input type="number" class="form-control col-10" name="cardNumber" placeholder="Masukkan Nomor Kartu" value="<?php //echo $old['cardNumber'] ? $cardNumber:''; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 metode-owlexa">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Tanggal Lahir</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7" style="padding-left: 25px">
                                            <div class="row" style="padding-left: 4px">
                                                <input type="date" class="form-control col-10" name="birthDate" placeholder="Masukkan Tanggal Lahir" value="<?php echo $user->lahir_tanggal; ?>" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 metode-owlexa">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">OTP</label>
                                        <label class="col-sm-1 col-1">:</label>
                                        <div class="col-md-7 col-7" style="padding-left: 25px">
                                            <div class="row" style="padding-left: 4px">
                                                <input type="number" class="form-control col-10" name="otp" placeholder="Masukkan OTP" aria-describedby="send_otp" required>
                                                <span class="col-2"></span>
                                                <a href="#" id="btnSendOtp" class="form-text" style="font-size: 10px;">
                                                <span class="fa fa-sign-in"> Send OTP</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-t-20 col-sm-4 offset-lg-4">
                                        <input type="hidden" name="chargeValue" value="<?php echo $total_harga;?>;">
                                        <button class="btn btn-success submit-btn btn-block"><i class=""></i> KIRIM</button>
                                    </div>
                                </div>
                                </form>
                                <?php } ?>
                            </div>
                            <div class="m-t-20 text-right">
                                <a href="<?php echo base_url('pasien/ResepDokter') ?>" type="button" class="btn btn-primary">Kembali <i class="fa fa-chevron-right"></i></a>
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