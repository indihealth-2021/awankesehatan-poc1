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
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <!-- /.card -->

            <div class="card">
            <div class="card-header" style="background-color: #1F60A8; color: #fff">
              <div class="card-title">Edit Poli</div>
            </div>
            <div class="card-body">
              <form method="post" id="form-edit-poli" action="<?php echo base_url('admin/Config/updatePoli/'.$data->id) ?>">
              <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2">
                      <label for="exampleInputEmail1">Poli</label>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12">
                      <input type="text" class="form-control" name="name" id="poli" placeholder="nama poli" value="<?php echo $data->name_poli; ?>" required >
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-lg-2">
                      <label for="exampleInputEmail1">Tarif</label >
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12 ">
                      <input type="number" class="form-control" name="harga" id="harga" placeholder="tarif" required value="<?php echo $data->harga ?>">
                      <div class="alert mt-2" id="rupiah" role="alert">
                        <?php echo 'Rp. '.number_format($data->harga,2,',','.'); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 mt-5 row  justify-content-center">
                  <div class="col-lg-4 mb-5">
                    <button class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff" id="btn-edit-poli">UBAH</button>  
                </div>
                  </form>
                <div class="col-lg-4 mb-5">
                    <a href="<?php echo base_url('admin/Config/poli');?>"><button type="button" class="btn btn-primary btn-block" style="background-color: #1F60A8; color: #fff" id="form-close">BATAL</button>  
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

<?php if($this->session->flashdata('msg_poli')){ echo "<script>alert('".$this->session->flashdata('msg_poli')."')</script>"; } ?>

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