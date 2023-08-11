<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('farmasi/farmasi');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/FarmasiVerifikasiObat') ?>" class="text-black">Verifikasi Obat</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Obat</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Edit Total Harga Obat</h3>
          </div>
      </div>

      <form method="POST" action="<?php echo base_url('admin/FarmasiVerifikasiObat/update_harga_obat/'.$id_jadwal_konsultasi); ?>"><div class="bg-tab">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-hover custom-table mb-0" id="table_farmasi">
                              <thead class="text-tr">
                              <tr>
                                  <th>Nama Obat</th>
                                  <th>Jumlah</th>
                                  <th>Aturan Pakai</th>
                                </tr>
                              </thead>
                              <tbody id="listResep">
                              <?php foreach($list_obat as $idx=>$obat){ ?>
                                <tr class="font-14">
                                  <td><span title="<?php echo $obat->nama_obat ?>"><?php echo strlen($obat->nama_obat) > 50 ? substr($obat->nama_obat, 0, 49).'...':$obat->nama_obat ?></span> <?php echo $obat->active ? '':'<span class="badge badge-danger">Nonaktif</span>'; ?></td>
                                  <input type="hidden" name="id_obat[]" value="<?php echo $obat->id_obat; ?>">
                                  <td><?php echo $obat->jumlah_obat.' '.$obat->nama_unit ?></td>
                                  <input type="hidden" name="jumlah_obat[]" value="<?php echo $obat->jumlah_obat ?>">
                                  <td><?php echo $obat->aturan_pakai ?></td>
                                  <input type="hidden" name="keterangan[]" value="<?php echo $obat->aturan_pakai ?>">
                                </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="m-t-20">
                <div>
                    <label for="harga_obat">Harga Obat Total</label>
                    <input type="number" name="harga_obat" id="harga_obat" class="form-control mb-3" value="<?= $harga_obat ?>">
                  </div>
                <input type="hidden" name="id_pasien" value="<?php echo $list_obat[0]->id_pasien; ?>">
                <input type="hidden" name="id_dokter" value="<?php echo $list_obat[0]->id_dokter; ?>">
                <input type="hidden" name="id_jadwal_konsultasi" value="<?php echo $id_jadwal_konsultasi; ?>">
                    <button type="submit" class="btn btn-simpan">Simpan Data</button>
                    <a href="<?php echo base_url('admin/FarmasiVerifikasiObat') ?>" type="button" class="btn btn-batal ml-5">Batalkan</a>
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
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="height: auto">
      <div class="modal-header ">
        <h4 class="modal-title font-14 font-bold-7 px-3" id="exampleModalLabel">Resep Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="pr-3">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formResepDokter">
          <div class="col-12">
          	<div class="row">
          		<div class="col-12">
          			<div class="form-group">
			           <label for="recipient-name" class="col-form-label font-12">Pilih Obat</label>
			            <?php foreach($list_master_obat as $obat){ ?>
			              <div id="obat-<?php echo $obat->id ?>" style="display: none"><?php echo $obat->unit ?></div>
			            <?php } ?>
			              <select name="id_obat" id="obat" class="form-control form-control-sm" onchange="obat_onchange();" required>
			              <option disabled selected value="">Pilih Obat</option>
			                    <?php foreach($list_master_obat as $obat){ ?>
			              <option value="<?php echo $obat->id ?>"><?php echo $obat->name ?></option>
			                    <?php } ?>
			              </select>
			          </div>
          		</div>
          		<div class="col-12">
          			<div class="form-group">
			           <label for="message-text" class="col-form-label font-12">Jumlah Obat</label>
			           <input type="number" min=1 name="jumlah_obat" class="form-control form-control-sm" id="unit" placeholder="Jumlah" required>
			        </div>
          		</div>
          		<div class="col-12">
	          		<div class="form-group">
			            <label for="message-text" class="col-form-label font-12">Aturan Pakai</label>
			            <textarea type="text" rows="3" name="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required></textarea>
			        </div>
	          	</div>
                <input type="hidden" name="satuan_obat" id="satuan_obat" value="">
          	</div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="mx-auto">
          <button id="buttonTambahResep" class="btn btn-simpan-sm">Simpan</button>
          <button type="button" class="btn btn-batal-sm ml-5" data-dismiss="modal">Batal</button>
        </div>
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
