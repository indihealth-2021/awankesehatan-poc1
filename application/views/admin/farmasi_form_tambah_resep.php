
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
                    <li class="breadcrumb-item"><a href="<?php echo base_url('farmasi/farmasi');?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Tambah Obat</a></li>
                </ol>
            </nav>
          </div>
      </div>

      <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <form method="post" action="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                          <label>Nama Obat</label>
                            <select name="id_obat" id="obat" class="form-control" onchange="obat_onchange();" required>
                              <option disabled selected value="">Pilih Obat</option>
                              <option value="">Obaaat</option>
                              <option value="">Obaaat</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">
                          <div class="col-sm-10 col-10">
                            <label>Jumlah</label>
                              <input type="number" min=1 max=100 name="jumlah_obat" class="form-control form-control-sm" id="unit" placeholder="Jumlah" required>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Aturan Pakai</label>
                              <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Simpan</button>
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

  </div>
  </div>