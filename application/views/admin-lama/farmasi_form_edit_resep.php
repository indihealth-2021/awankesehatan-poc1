
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Edit Resep</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('farmasi/farmasi');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Resep</li>
                </ol>
            </nav>
          </div>
      </div>
      <form method="POST" action="<?php echo base_url('admin/FarmasiVerifikasiObat/submit_resep'); ?>">
                <div class="row">
                    <div class="col-md-3">
                      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#ModalResep"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                    <div class="col-md-3">
                      <button type="button" class="btn btn-primary btn-block" onclick="location.reload()"><i class="fa fa-refresh"></i> Reload Data</button>
                    </div>
                    <div class="col-md-12 pt-2">
                        <div class="table-responsive">
                            <table class="table table-border table-hover custom-table mb-0" id="table_farmasi">                
                              <thead>
                                <tr>
                                  <th>Nama Obat</th>
                                  <th>Jumlah</th>
                                  <th>Aturan Pakai</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody id="listResep">
                              <?php foreach($list_obat as $idx=>$obat){ ?>
                                <tr>
                                  <td><?php echo $obat->nama_obat ?> <?php echo $obat->active ? '':'<span class="badge badge-danger">Nonaktif</span>'; ?></td>
                                  <input type="hidden" name="id_obat[]" value="<?php echo $obat->id_obat; ?>">
                                  <td><?php echo $obat->jumlah_obat.' '.$obat->nama_unit ?></td>
                                  <input type="hidden" name="jumlah_obat[]" value="<?php echo $obat->jumlah_obat ?>">
                                  <td><?php echo $obat->aturan_pakai ?></td>
                                  <input type="hidden" name="keterangan[]" value="<?php echo $obat->aturan_pakai ?>">
                                  <td><button class="btn btn-danger btn-block" type="button" onclick="return (this.parentNode).parentNode.remove();" ><i class="fa fa-close"></i></button></td>
                                </tr>
                              <?php } ?>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Nama Obat</th>
                                  <th>Jumlah</th>
                                  <th>Aturan Pakai</th>
                                  <th>Aksi</th>
                                </tr>
                              </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                <input type="hidden" name="id_pasien" value="<?php echo $list_obat[0]->id_pasien; ?>">
                <input type="hidden" name="id_dokter" value="<?php echo $list_obat[0]->id_dokter; ?>">
                  <input type="hidden" name="id_jadwal_konsultasi" value="<?php echo $id_jadwal_konsultasi; ?>">
                    <button type="submit" class="btn btn-primary submit-btn">Simpan</button>
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
    
    <div class="modal fade" id="ModalResep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-white" style="background:linear-gradient(to right, #36d1dc, #009efb)">
        <h4 class="modal-title" id="exampleModalLabel">Resep Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formResepDokter">
          <div class="col-12">
          	<div class="row">
          		<div class="col-6">
          			<div class="form-group">
			            <!-- <label for="recipient-name" class="col-form-label">Nama Obat :</label> -->
			            <?php foreach($list_master_obat as $obat){ ?>
			              <div id="obat-<?php echo $obat->id ?>" style="display: none"><?php echo $obat->unit ?></div>
			            <?php } ?>
			              <select name="id_obat" id="obat" class="form-control 
			                                              form-control-sm" onchange="obat_onchange();" required>
			              <option disabled selected value="">Pilih Obat</option>
			                    <?php foreach($list_master_obat as $obat){ ?>
			              <option value="<?php echo $obat->id ?>"><?php echo $obat->name ?></option>
			                    <?php } ?>
			              </select>
			          </div>	
          		</div>
          		<div class="col-3">
          			<div class="form-group">
			           <!-- <label for="message-text" class="col-form-label">Jumlah :</label> -->
			           <input type="number" min=1 max=100 name="jumlah_obat" class="form-control form-control-sm" id="unit" placeholder="Jml" required>
			        </div>			
          		</div>
          		<div class="col-3">
	          		<div class="form-group">
			            <!-- <label for="message-text" class="col-form-label">Aturan Minum :</label> -->
			            <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required>
			        </div>
	          	</div>
                <input type="hidden" name="satuan_obat" id="satuan_obat" value="">
          	</div>
          </div>
      </div>
      <div class="modal-footer">
      	<button id="buttonTambahResep" class="btn btn-primary">Submit</button> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <!-- <button type="button" class="btn btn-primary">Tambah</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

<script>
function obat_onchange(){
  var obat = document.getElementById('obat');
  var satuan = document.getElementById('obat-'+obat.value);
  var satuan_obat_hidden = document.getElementById('satuan_obat');
  
  var satuan_show = document.getElementById('unit');

  satuan_show.placeholder = "Jml ("+satuan.innerHTML+")";
  satuan_obat_hidden.value = satuan.innerHTML;
}
</script>
<?php if($this->session->flashdata('msg_hapus_obat')){ echo "<script>alert('".$this->session->flashdata('msg_hapus_obat')."')</script>"; } ?>