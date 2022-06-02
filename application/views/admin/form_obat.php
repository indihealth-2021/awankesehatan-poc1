
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/Obat/manage_obat') ?>" class="text-black">Rumah Sakit</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Obat/form_tambah') ?>" class="text-black font-bold-7">Tambah Obat</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">         
          <form method="post" id="form-add-poli" action="<?php echo base_url('admin/Obat/insert') ?>">
            <p class="title-form">Tambah Obat</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nama Obat</label>
                    <input type="text" class="form-control floating" name="nama" id="" required placeholder="Masukan Nama Obat">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Satuan Obat</label>
                    <input type="text" class="form-control floating" name="satuan" id="satuan_input" required placeholder="Masukan Satuan Obat">
                </div>
              </div> 
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-label-form">Dosis</label>
                  <input type="number" class="form-control" name="harga_per_n_unit" id="harga_per" placeholder="N (default: 1)" min=1 required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="text-label-form">Harga Obat</label>
                  <div class="col-md-14">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp. </span>
                      </div>
                      <input type="number" class="form-control" name="harga" id="harga" min=1  placeholder="Masukan Harga Obat" required>
                    </div>
                    <!-- <div class="alert mt-2" id="rupiah" role="alert">
                    </div> -->
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
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=1 required required>Aktif
                    </label>
                  </div>
                  <div class="form-check-inline pl-5 ml-5">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=0 required required>Non Aktif
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="ml-3">
                <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="5" hidden>
                <button class="btn btn-simpan" id="btn-add-obat">Simpan</button>
                <a href="<?php echo base_url('admin/Obat/manage_obat') ?>"><button type="button" class="btn btn-batal ml-4">Batal</button></a>
              </div>
            </div>
          </form>
        </div>
      </div> 

<?php if ($this->session->flashdata('msg_obat')) {
  echo "<script>alert('" . $this->session->flashdata('msg_obat') . "')</script>";
} ?>

<script type="text/javascript">
  var satuan_input = document.getElementById('satuan_input');

  var harga_per = document.getElementById('harga_per');

  var rupiah = document.getElementById('harga');

  var show_to = document.getElementById('formatHarga');
  rupiah.addEventListener('change', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    show_to.innerHTML = formatRupiah(this.value, 'Rp. ')+' / '+harga_per.value+' '+satuan_input.value;
  });

  rupiah.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    show_to.innerHTML = formatRupiah(this.value, 'Rp. ')+' / '+harga_per.value+' '+satuan_input.value;
  });

  satuan_input.addEventListener('keyup', function(e) {
    show_to.innerHTML = formatRupiah(rupiah.value, 'Rp. ')+' / '+harga_per.value+' '+this.value;
  });

  harga_per.addEventListener('keyup', function(e){
    show_to.innerHTML = formatRupiah(rupiah.value, 'Rp. ')+' / '+this.value+' '+satuan_input.value;
  });
  harga_per.addEventListener('change', function(e){
    show_to.innerHTML = formatRupiah(rupiah.value, 'Rp. ')+' / '+this.value+' '+satuan_input.value;
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

<div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <form id="formTambahKategori">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kategori Obat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="sendKategori">Buat</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
  </form>
</div>
</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modalHapus">
  <form id="formHapusKategori">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Kategori Obat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus kategori <b id="nama_kategori"></b> ?</p>
          <input type="hidden" name="id">
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" id="hapusKategori">Ya</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        </div>
  </form>
</div>
</div>
</div>