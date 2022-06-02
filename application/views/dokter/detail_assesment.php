<!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
              <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/SelfAssesment/verification');?>"class="text-black">Assesment</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Detail Assesment Pasien</a></li>
              </ol>
          </nav>
        </div>
        <div class="col-sm-12 col-12">
            <h3 class="page-title">Detail Assesment Pasien</h3>
        </div>
      </div>
      <?php if($assesment){ ?>
      <div class="row">
        <div class="col-md-8">
          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="font-18 font-bold-7">Data Assesment Pasien</p><br>
              <p class="font-16 font-bold-4">Nama Pasien &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</span><span class="font-16 font-bold-7">: <?php echo ucwords($assesment->nama_pasien) ?></p>  
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <div class="form-group form-focus-asses">
                    <label class="focus-label">Berat Badan</label>
                    <input type="number" class="form-control floating" value="<?php if ($assesment) {echo $assesment->berat_badan;} ?>" name="berat_badan" placeholder="Isi Berat Badan Disini" required>
                    <label class="focus-label-right">Kg</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <div class="form-group form-focus-asses">
                    <label class="focus-label">Tinggi Badan</label>
                    <input type="number" class="form-control floating" value="<?php if ($assesment) {echo $assesment->tinggi_badan;} ?>" name="tinggi_badan" placeholder="Isi Tinggi Badan Disini" required>
                    <label class="focus-label-right">Cm</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <div class="form-group form-focus-asses">
                    <label class="focus-label">Tekanan Darah</label>
                    <input type="text" class="form-control floating" name="tekanan_darah" value="<?php if ($assesment) { echo $assesment->tekanan_darah; } ?>" placeholder="Isi Tekanan Darah Disini">
                    <label class="focus-label-right">mmHg</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <div class="form-group form-focus-asses">
                    <label class="focus-label">Suhu</label>
                    <input type="text" class="form-control floating" name="suhu" value="<?php if ($assesment) { echo $assesment->suhu; } ?>"placeholder="Isi Suhu Disini">
                    <label class="focus-label-right">Celcius</label>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <div class="form-group font-12">
                    <label for="" class="text-abu col-form-label">Merokok</label><br>
                    <label class="radio-inline">
                        <input required type="radio" name="merokok" id="merokok-1" value=1 <?php if ($assesment) { if ($assesment->merokok) { echo "checked";}} ?>> Ya
                    </label><br>
                    <label class="radio-inline">
                        <input required type="radio" name="merokok" id="merokok-0" value=0 <?php if ($assesment) {if (!$assesment->merokok) {echo "checked";}} ?>> Tidak
                    </label>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                  <div class="form-group font-12">
                      <label for="" class="text-abu col-form-label">Di Rawat</label><br>
                        <label class="radio-inline">
                          <input required type="radio" name="dirawat" id="dirawat-1" value=1 <?php if ($assesment) { if ($assesment->dirawat) {  echo "checked"; } } ?>> Pernah
                      </label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="dirawat" id="dirawat-0" value=0 <?php if ($assesment) { if (!$assesment->dirawat) {  echo "checked"; } } ?>> Tidak Pernah
                      </label>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                  <div class="form-group font-12">
                      <label for="" class="text-abu col-form-label">Minum Alkohol</label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="alkohol" id="alkohol-1" value=1 <?php if ($assesment) { if ($assesment->alkohol) { echo "checked"; } } ?>> Ya
                      </label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="alkohol" id="alkohol-0" value=0 <?php if ($assesment) { if (!$assesment->alkohol) { echo "checked"; } } ?>> Tidak
                      </label>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                  <div class="form-group font-12">
                      <label for="" class="text-abu col-form-label">Kecelakaan</label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="kecelakaan" id="kecelakaan-1" value=1 <?php if ($assesment) { if ($assesment->kecelakaan) { echo "checked"; } } ?>> Pernah
                      </label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="kecelakaan" id="kecelakaan-0" value=0 <?php if ($assesment) { if (!$assesment->kecelakaan) {  echo "checked"; } } ?>> Tidak Pernah
                      </label>
                  </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                  <div class="form-group font-12">
                      <label for="" class="text-abu col-form-label">Operasi</label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="operasi" id="operasi-1" value=1 <?php if ($assesment) { if ($assesment->operasi) { echo "checked"; } } ?>> Pernah
                      </label><br>
                      <label class="radio-inline">
                          <input required type="radio" name="operasi" id="operasi-0" value=0 <?php if ($assesment) { if (!$assesment->operasi) { echo "checked"; } } ?>> Tidak Pernah
                      </label>
                  </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-5 pb-5">
                  <div class="form-group form-focus-asses">
                      <label class="focus-label">Keluhan</label>
                      <textarea required rows="4" class="font-12 form-control floating" name="keluhan"><?php if ($assesment) { echo $assesment->keluhan; } ?></textarea>
                 </div>
              </div>
            </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>