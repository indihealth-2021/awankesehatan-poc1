
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/Config/poli') ?>" class="text-black">Rumah Sakit</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Poli</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">         
          <form method="post" id="form-edit-poli" action="<?php echo base_url('admin/Config/updatePoli/' . $data->id) ?>">
            <p class="title-form">Tambah Poli</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nama Poli</label>
                    <input type="text" class="form-control floating" name="name" id="poli" value="<?php echo $data->name_poli; ?>" required required placeholder="Masukan Nama Poli">
                </div>
              </div> 
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-label-form">Durasi Konsultasi (menit)</label>
                  <div class="col-md-14">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i  class="fas fa-clock"></i></span>
                      </div>
                      <input type="number" required class="form-control" name="durasi" value="<?php echo $data->durasi/60; ?>"  min="1" placeholder="Masukan Durasi (Menit)">
                    </div>
                    <!-- <div class="alert mt-2" id="rupiah_2" role="alert"> -->
                    </div>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-label-form">Tarif</label>
                  <div class="col-md-14">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp. </span>
                      </div>
                      <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukan Tarif" required value="<?php echo $data->harga ?>">
                    </div>
                    <div class="alert mt-2" id="rupiah" role="alert">
                      <?php echo 'Rp. ' . number_format($data->harga, 2, ',', '.'); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-label-form">Biaya Administratif</label>
                  <div class="col-md-14">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp. </span>
                      </div>
                      <input type="number" class="form-control" name="biaya_adm" id="biaya_adm" value="<?php echo $data->biaya_adm ?>" placeholder="Masukan Biaya Administratif">
                    </div>
                    <div class="alert mt-2" id="rupiah_2" role="alert">
                      <?php echo $data->biaya_adm ? 'Rp. ' . number_format($data->biaya_adm, 2, ',', '.'):''; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 font-14">
                <label class="gen-label text-label-form">Status :</label>
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=1 required <?php echo $data->aktif ? 'checked' : ''; ?> required>Aktif
                    </label>
                  </div>
                  <div class="form-check-inline pl-5 ml-5">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=0 required <?php echo $data->aktif == 0 ? 'checked' : ''; ?> required>Non Aktif
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="ml-3">
                <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="5" hidden>
                <button class="btn btn-simpan" id="btn-edit-poli">Simpan</button>
                <a href="<?php echo base_url('admin/Config/poli') ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
              </div>
            </div>
          </form>
        </div>
      </div> 

<?php if ($this->session->flashdata('msg_poli')) {
  echo "<script>alert('" . $this->session->flashdata('msg_poli') . "')</script>";
} ?>

<script type="text/javascript">
  var rupiah = document.getElementById('harga');
  var rupiah_2 = document.getElementById('biaya_adm');

  var show_to = document.getElementById('rupiah');
  var show_to_2 = document.getElementById('rupiah_2');
  rupiah.addEventListener('change', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    show_to.innerHTML = formatRupiah(this.value, 'Rp. ');
  });

  rupiah.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    show_to.innerHTML = formatRupiah(this.value, 'Rp. ');
  });

  rupiah_2.addEventListener('change', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    show_to_2.innerHTML = formatRupiah(this.value, 'Rp. ');
  });

  rupiah_2.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    show_to_2.innerHTML = formatRupiah(this.value, 'Rp. ');
  });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
</script>