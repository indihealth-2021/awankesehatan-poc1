<style type="text/css">
  .alert {
    /*width:150px;    */
    /*font-size: 14px;*/
    background-color: #DCDCDC;
    text-align: center;
    color: #1F60A8
  }
</style>
<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-5">
      <div class="col-sm-5 col-5">
        <h4 class="page-title">Edit Poli</h4>
      </div>
      <div class="col-sm-7 col-7">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Poli</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <form method="post" id="form-edit-poli" action="<?php echo base_url('admin/Config/updatePoli/' . $data->id) ?>">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Poli</label>
                <input type="text" class="form-control" name="name" id="poli" placeholder="nama poli" value="<?php echo $data->name_poli; ?>" required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Tarif</label>
                <div class="col-md-14">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp. </span>
                    </div>
                    <input type="number" class="form-control" name="harga" id="harga" placeholder="tarif" required value="<?php echo $data->harga ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">,00</span>
                    </div>
                  </div>
                  <div class="alert mt-2" id="rupiah" role="alert">
                    <?php echo 'Rp. ' . number_format($data->harga, 2, ',', '.'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Biaya Administrasi</label>
                <div class="col-md-14">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp. </span>
                    </div>
                    <input type="number" class="form-control" name="biaya_adm" id="biaya_adm" value="<?php echo $data->biaya_adm ?>" placeholder="biaya administrasi">
                    <div class="input-group-append">
                      <span class="input-group-text"><?php echo $data->biaya_adm ? 'Rp. ' . number_format($data->biaya_adm, 2, ',', '.'):''; ?></span>
                    </div>
                  </div>
                  <div class="alert mt-2" id="rupiah_2" role="alert">
                  <?php echo $data->biaya_adm ? 'Rp. ' . number_format($data->biaya_adm, 2, ',', '.'):''; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Status</label>
                <select name="aktif" class="form-control" id="exampleFormControlSelect1" required>
                  <option value="1" <?php echo $data->aktif ? 'selected':'' ?>>Aktif</option>
                  <option value="0" <?php echo !$data->aktif ? 'selected':'' ?>>Nonaktif</option>
                </select>
              </div>
            </div>
          </div>
          <div class="m-t-20 text-center">
            <button class="btn btn-primary submit-btn" id="btn-edit-poli">Edit</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>

<!-- /.card-body -->
<!-- /.card -->

</div>
<!-- /.col (right) -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

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