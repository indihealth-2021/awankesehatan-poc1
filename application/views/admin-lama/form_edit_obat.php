<style type="text/css">
  .alert{
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
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Edit Obat</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Obat</li>
                </ol>
            </nav>
          </div>
      </div>

      <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <form method="post" id="" action="<?php echo base_url('admin/Obat/update/'.$obat->id) ?>">
                <div class="row">
                    <!-- <div class="col-sm-4 col-8">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="id_kategori_obat" required>
                            <?php foreach($list_kategori as $kategori){ ?>
                                <option value="<?php echo $kategori->id ?>" <?php echo $kategori->id == $obat->id_kategori ? 'selected' : ''; ?>><?php echo ucwords($kategori->name) ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2 col-4 mt-4">
                        <div class="form-group mt-2">
                            <button type="button" class="btn btn-success btn-block" id="buttonTambah" data-toggle="modal" data-target="#exampleModal" data-aksi="tambah">Tambah</button>      
                        </div>
                    </div> -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Obat</label>
                            <input type="text" class="form-control" name="nama" id="" placeholder="nama obat" value="<?php echo $obat->name ?>" >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Satuan Obat</label>
                            <input type="text" class="form-control" name="satuan" id="satuan_input" placeholder="satuan" value="<?php echo $obat->unit ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                          <div class="col-sm-12 col-12">
                            <label>Harga / N Unit</label>
                              <input type="number" class="form-control" name="harga_per_n_unit" id="harga_per" value=<?php echo $obat->harga_per_n_unit ?> placeholder="N (default: 1)" min=1 required>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga" value=<?php echo $obat->harga ?> min=1 placeholder="harga" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Status</label>
                        <select name="active" class="form-control" id="exampleFormControlSelect1">
                          <option value="1" <?php echo $obat->active ? 'selected':''; ?>>Aktif</option>
                          <option value="0" <?php echo !$obat->active ? 'selected':''; ?>>Nonaktif</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 mt-2">
                      <div class="form-group row">
                        <div class="col-sm-12 col-12 alert">
                          <div id="formatHarga"><?php echo 'Rp. '.number_format($obat->harga,2,',','.'); ?> / <?php echo $obat->harga_per_n_unit ?> <?php echo $obat->unit ?></div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Edit</button>
                </div>            
                </form>  
          </div>
      </div>
            
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php if($this->session->flashdata('msg_obat')){ echo "<script>alert('".$this->session->flashdata('msg_obat')."')</script>"; } ?>
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