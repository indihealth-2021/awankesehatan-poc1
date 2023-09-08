<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/apotek') ?>" class="text-black">Apotek Management</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/apotek/form_apotek') ?>" class="text-black font-bold-7">Tambah Apotek</a></li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?= form_open_multipart('admin/apotek/addApotek', 'id="form-add-apotek" onsubmit="return ubah();" autocomplete="off"'); ?>
        <p class="title-form">Data Apotek</p>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">Nama</label>
              <input type="text" class="form-control floating" name="nama" id="name" <?php echo isset($old) ? 'value="' . $old['name'] . '"' : ''; ?> required placeholder="Masukan Nama Apotek">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">ID Provider</label>
              <input type="number" class="form-control floating" name="provider_code" id="provider_code" <?php echo isset($old) ? 'value="' . $old['provider_code'] . '"' : ''; ?> required placeholder="Masukan ID Provider">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">Nomor Telepon</label>
              <input type="number" class="form-control floating" name="telp" id="telp" <?php echo isset($old) ? 'value="' . $old['telp'] . '"' : ''; ?> required placeholder="Masukan Nomor Telepon">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">Provinsi</label>
              <select class="form-control floating" name="alamat_provinsi" id="provinsi">
                <option>Pilih Provinsi</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">Kabupaten/Kota</label>
              <select class="form-control floating" name="alamat_kota" id="kotkab">
                <option>Pilih Kab/Kota</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">Kecamatan</label>
              <select class="form-control floating" name="alamat_kecamatan" id="kecamatan">
                <option>Pilih Kecamatan</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">Kelurahan</label>
              <select class="form-control floating" name="alamat_kelurahan" id="kelurahan">
                <option>Pilih Kelurahan</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">Kode Pos</label>
              <input type="text" class="form-control floating" name="kode_pos" <?php echo isset($old) ? 'value="' . $old['kode_pos'] . '"' : ''; ?> required placeholder="Masukan Kode Pos">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-focus">
              <label class="focus-label">Alamat Jalan</label>
              <input type="text" class="form-control floating" name="alamat_jalan" id="alamat_jalan" <?php echo isset($old) ? 'value="' . $old['alamat_jalan'] . '"' : ''; ?> required placeholder="Masukan Alamat Jalan">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-focus">
              <label class="focus-label">Latitude</label>
              <input type="text" class="form-control floating" name="latitude" <?php echo isset($old) ? 'value="' . $old['latitude'] . '"' : ''; ?> required placeholder="Masukan latitude">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-focus">
              <label for="" class="focus-label">Longitude</label>
              <input type="text" name="longitude" id="longitude" class="form-control floating" <?php echo isset($old) ? 'value="' . $old['longitude'] . '"' : ''; ?>required placeholder="Masukan longitude">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 font-14">
            <label class="gen-label text-label-form">Status :</label>
            <div class="form-group gender-select">
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="aktif" id="status" value=1 <?php if (isset($old)) {
                                                                                                  echo $old['aktif'] == 1 ? 'checked' : '';
                                                                                                } ?> required>Aktif
                </label>
              </div>
              <div class="form-check-inline pl-2">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="aktif" id="status" value=0 <?php if (isset($old)) {
                                                                                                  echo $old['aktif'] == 0 ? 'checked' : '';
                                                                                                } ?> required>Non Aktif
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-sm-12 ml-2">
          <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="5" hidden>
          <button class="btn btn-simpan" id="btn-add-apotek">Simpan</button>
          <a href="<?php echo base_url('admin/apotek') ?>"><button type="button" class="btn btn-batal ml-4" id="btn-add-apotek">Batal</button></a>
        </div>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
  <?php echo $js_addons  ?>
  <?php echo $this->session->flashdata('msg_add_apotek') ? "<script>alert('" . $this->session->flashdata('msg_add_apotek') . "')</script>" : ''; ?>