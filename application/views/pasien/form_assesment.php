  <!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Assesment/menu_assesment') ?>"class="text-black">Assesment</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href=""class="text-black font-bold-7">Isi Assesment</a></li>
                </ol>
            </nav>
            </div>
            <div class="col-sm-12 col-12">
                <p class="page-title font-16">Assesment</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <form action="<?php echo base_url('pasien/Assesment/update') ?>" method="POST"> 
                    <?php $assesmentFor = isset($_GET['id_jadwal_konsultasi']) ? ucwords($jadwal_konsultasi->nama_dokter).' - '.strtoupper($jadwal_konsultasi->poli_dokter).' [ '.(new DateTime($jadwal_konsultasi->tanggal))->format('d-m-Y').' '.$jadwal_konsultasi->jam.' ]' : 'Semua Konsultasi' ?>
                    <p class="font-16 font-bold-4">Data Assesment Pasien</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-group form-focus-asses">
                                    <label class="focus-label">Berat Badan</label>
                                    <input type="number" class="form-control floating" name="berat_badan" <?php if($assesment){ echo 'value='.$assesment->berat_badan; } ?> placeholder="Isi Berat Badan Disini" required>
                                    <label class="focus-label-right">Kg</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-group form-focus-asses">
                                    <label class="focus-label">Tinggi Badan</label>
                                    <input type="number" class="form-control floating" name="tinggi_badan" <?php if($assesment){ echo 'value='.$assesment->tinggi_badan; } ?> required placeholder="Isi Tinggi Badan Disini" >
                                    <label class="focus-label-right">Cm</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-group form-focus-asses">
                                    <label class="focus-label">Tekanan Darah</label>
                                    <input type="text" class="form-control floating"name="tekanan_darah" <?php if($assesment && !isset($assesment_old)){ echo 'value="'.$assesment->tekanan_darah.'"'; } ?> placeholder="Isi Tekanan Darah Disini" >
                                    <label class="focus-label-right">mmHg</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                              <div class="form-group form-focus-asses">
                                    <label class="focus-label">Suhu</label>
                                    <input type="text" class="form-control floating" name="suhu" <?php if($assesment && !isset($assesment_old)){ echo 'value="'.$assesment->suhu.'"'; } ?> placeholder="Isi Suhu Disini" >
                                    <label class="focus-label-right">Celcius</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Merokok</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="merokok" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->merokok == 1){echo "checked";}}?> required> Ya
                                    </label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="merokok" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->merokok == 0){echo "checked";}}?> required> Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Minum Alkohol</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="alkohol" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->alkohol == 1){echo "checked";}} ?> required> Ya
                                    </label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="alkohol" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->alkohol == 0){echo "checked";}}  ?> required> Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Kecelakaan</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="kecelakaan" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->kecelakaan == 1 ){ echo "checked";  }}?> required> Pernah 
                                    </label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="kecelakaan" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->kecelakaan == 0 ){ echo "checked"; }} ?> required> Tidak Pernah
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Di Rawat</label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="dirawat" id="optionsRadiosInline2" value=1 <?php if($assesment){if($assesment->dirawat == 1 ){echo "checked"; }}    ?> required> Pernah
                                    </label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="dirawat" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->dirawat == 0 ){echo "checked"; }}    ?> required> Tidak Pernah
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Operasi</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="operasi" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->operasi == 1){echo "checked"; }}?> required> Pernah 
                                    </label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="operasi" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->operasi == 0){echo "checked";    }}?> required> Tidak Pernah
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="form-group form-focus-asses">
                                    <label class="focus-label">Keluhan</label>
                                    <textarea rows="4" class="form-control floating" name="keluhan" required><?php if($assesment && !isset($assesment_old)){ echo $assesment->keluhan; } ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php 
                            if(isset($id_jadwal_konsultasi)){
                            echo "<input type='hidden' name='id_jadwal_konsultasi' value=".$id_jadwal_konsultasi.">";
                            }
                        ?>
                    </div>
                    <div class="row mt-5 pt-5">
                        <div class="col-md-12 ml-3">
                        <button class="btn btn-simpan mr-5" type="submit" id="btn-edit-pasien">Simpan</button>
                        <a href="<?php echo base_url('admin/Pasien') ?>" class="btn btn-batal">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <p class="font-16">Data Dokter</p>
                <div class="row mx-auto">
                    <a href="#">
                        <div class="card-profile ml-3 my-2">
                            <div class="d-inline-flex">
                                <div class="doctor-img px-3 my-4">
                                    <div class="avatar"><img alt="" src="<?php echo $jadwal_konsultasi->foto_dokter ? base_url('assets/images/users/'.$jadwal_konsultasi->foto_dokter):base_url('assets/dashboard/img/user.jpg') ?>"></div>
                                </div>
                                <div class="p-2 ml-3 my-auto font-black">
                                    <span class="font-16"><?php echo ucwords($jadwal_konsultasi->nama_dokter);?></span>
                                    <div class="font-12">
                                        <span>STR : <?php echo $jadwal_konsultasi->str_dokter ?></span><br>
                                        <p><?php echo $jadwal_konsultasi->poli_dokter?></span><br>
                                        <span><?php echo (new DateTime($jadwal_konsultasi->tanggal))->format('d-m-Y');?> <?php echo $jadwal_konsultasi->jam ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>  


    <?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }
    </style>