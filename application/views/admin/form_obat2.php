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
              <h4 class="page-title">Tambah Obat</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Obat</li>
                </ol>
            </nav>
          </div>
      </div>
            <div class="card-body">
              <form method="post" id="form-add-poli" action="<?php echo base_url('admin/Obat/insert') ?>">
              <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2">
                      <label for="exampleInputEmail1">Nama Obat</label>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12">
                      <input type="text" class="form-control" name="nama" id="" placeholder="nama obat" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2">
                      <label for="exampleInputEmail1">Satuan</label >
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12">
                      <input type="text" class="form-control" name="satuan" id="satuan_input" placeholder="satuan" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">
                      <label for="exampleInputEmail1">Kategori</label >
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12">
                      <select class="form-control" name="id_kategori_obat" required>
                      <?php foreach($list_kategori as $kategori){ ?>
                          <option value="<?php echo $kategori->id ?>"><?php echo ucwords($kategori->name) ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <!--<div class="col-lg-2">
                      
                    </div>-->
                     <div class="col-lg-2">
                      <button type="button" id="buttonTambah" data-toggle="modal" data-target="#exampleModal" data-aksi="tambah">Tambah</button>
                      <button type="button" id="buttonHapus" data-toggle="modal" data-target="#modalHapus" data-id="" data-name="">Hapus</button>
                      <button type="button" id="buttonEdit" data-toggle="modal" data-target="#exampleModal" data-aksi="edit" data-id="<?php echo $list_kategori[0]->id ?>" data-name="<?php echo $list_kategori[0]->name ?>">Edit</button>
                    </div> 
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2">
                      <label for="exampleInputEmail1">Harga per</label >
                    </div>
                    <div class="col-lg-2 col-md-8 col-sm-12">
                      <input type="number" class="form-control" name="harga_per_n_unit" id="harga_per" placeholder="banyak (default: 1)" required>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-12">
                      <div class="alert-default mt-1" id="satuan" role="alert">  
                      
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2">
                      <label for="exampleInputEmail1">Harga</label>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12">
                      <input type="number" class="form-control" name="harga" id="harga" placeholder="harga" required>
                      <div class="alert mt-2" id="rupiah" role="alert">  
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 mt-5 row  justify-content-center">
                  <div class="col-lg-4 mb-5">
                    <button class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff" id="">TAMBAH</button>  
                </div>
                  </form>
                <div class="col-lg-4 mb-5">
                    <a href="<?php echo base_url('admin/Obat');?>"><button type="button" class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff" id="form-close">BATAL</button>  
                </a>  
                </div>  
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
<?php if($this->session->flashdata('msg_obat')){ echo "<script>alert('".$this->session->flashdata('msg_obat')."')</script>"; } ?>
<script>
var satuan_input = document.getElementById('satuan_input');
var show_to_satuan = document.getElementById('satuan');
satuan_input.addEventListener('keyup', function(e){
  show_to_satuan.innerHTML = satuan_input.value;
});
</script>
<script type="text/javascript">
    
    var rupiah = document.getElementById('harga');
    var show_to = document.getElementById('rupiah');
    rupiah.addEventListener('change', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      show_to.innerHTML = formatRupiah(this.value, 'Rp. ');
    });

    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      show_to.innerHTML = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
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
          <div class="form-group row">
            <label class="col-sm-4">Nama Kategori</label>
            <input type="text" name="name" class="form-control col-sm-8">
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