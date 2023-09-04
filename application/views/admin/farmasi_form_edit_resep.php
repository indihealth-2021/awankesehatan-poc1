<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('farmasi/farmasi'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/FarmasiVerifikasiObat') ?>" class="text-black">Verifikasi Obat</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Obat</a></li>
          </ol>
        </nav>
      </div>
      <div class="col-sm-12 col-12 mb-3">
        <h3 class="page-title">Edit Obat</h3><br>
        <span class="alert alert-info" style="font-size: 10px;"><i class="fa fa-warning"></i> Menambah/menghapus obat akan mengubah total harga obat sesuai kalkulasi dari sistem, harap <a href="<?= base_url('admin/FarmasiVerifikasiObat/edit_harga/' . $id_jadwal_konsultasi) ?>" style="text-decoration: underline; font-weight: bolder;"> <i class="fa fa-pencil"></i> ubah total harga</a> apabila harga tidak sesuai dengan harga di apotek.</span>
      </div>
    </div>

    <form method="POST" action="<?php echo base_url('admin/FarmasiVerifikasiObat/submit_resep'); ?>">
      <div class="row mb-5">
        <div class="col-md-3">
          <button type="button" class="btn btn-tele btn-block" data-toggle="modal" data-target="#ModalResep"><i class="fa fa-plus"></i> Tambah Obat</button>
        </div>
        <div class="col-md-3">
          <button type="button" class="btn btn-tele btn-block" onclick="location.reload()"><i class="fa fa-refresh"></i> Reload Data</button>
        </div>
      </div>
      <div class="bg-tab">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-border table-hover custom-table mb-0" id="table_farmasi">
              <thead class="text-tr">
                <tr>
                  <th>Nama Obat</th>
                  <th>Jumlah</th>
                  <th>Aturan Pakai</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="listResep">
                <?php foreach ($list_obat as $idx => $obat) { ?>
                  <tr class="font-14">
                    <!-- <td><span title="<?php echo $obat->nama_obat ?>"><?php echo strlen($obat->nama_obat) > 50 ? substr($obat->nama_obat, 0, 49) . '...' : $obat->nama_obat ?></span> <?php echo $obat->active ? '' : '<span class="badge badge-danger">Nonaktif</span>'; ?></td> -->
                    <td><span title="<?php echo $obat->nama_obat ?>"><?php echo $obat->nama_obat ?></span> <?php echo $obat->active ? '' : '<span class="badge badge-danger">Nonaktif</span>'; ?></td>
                    <input type="hidden" name="id_obat[]" value="<?php echo $obat->id_obat; ?>">
                    <td><?php echo $obat->jumlah_obat . ' ' . $obat->nama_unit ?></td>
                    <input type="hidden" name="jumlah_obat[]" value="<?php echo $obat->jumlah_obat ?>">
                    <td><?php echo $obat->aturan_pakai ?></td>
                    <input type="hidden" name="keterangan[]" value="<?php echo $obat->aturan_pakai ?>">
                    <td>
                      <a style="cursor: pointer;" type="button" onclick="return (this.parentNode).parentNode.remove();">
                        <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z" fill="black" fill-opacity="0.35" />
                            <path d="M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z" fill="black" fill-opacity="0.35" />
                          </svg></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="m-t-20">
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
      <form id="formResepDokter">
        <div class="modal-body">
          <div class="col-12">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label font-12">Pilih Obat</label>
                  <?php foreach ($list_master_obat as $obat) { ?>
                    <div id="obat-<?php echo $obat->id ?>" style="display: none"><?php echo $obat->unit ?></div>
                  <?php } ?>
                  <select name="id_obat" id="obat" class="form-control form-control-sm" onchange="obat_onchange();" required>
                    <option disabled selected value="">Pilih Obat</option>
                    <?php foreach ($list_master_obat as $obat) { ?>
                      <option value="<?php echo $obat->id ?>"><?php echo $obat->name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="message-text" class="col-form-label font-12">Jumlah Obat</label>
                  <input type="number" step=0.000001 min=1 name="jumlah_obat" class="form-control form-control-sm" id="unit" placeholder="Jumlah" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="message-text" class="col-form-label font-12">Aturan Pakai</label>
                  <textarea type="text" rows="3" name="keterangan" id="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required></textarea>
                </div>
              </div>
              <input type="hidden" name="satuan_obat" id="satuan_obat" value="">
              <input type="hidden" name="id_jadwal_konsultasi" value="<?= $id_jadwal_konsultasi ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mx-auto">
            <button type="button" id="buttonTambahResep" onClick="TambahResep()" class="btn btn-simpan-sm">Simpan</button>
            <button type="button" class="btn btn-batal-sm ml-5" data-dismiss="modal">Batal</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function TambahResep() {
    var dataResep = $("#formResepDokter").serializeArray();
    console.log(dataResep);
    var namaObat = $("select[name=id_obat] option:selected").text();
    var listResep = $("#listResep");
    var templateResep = "<tr><td>" + namaObat + "</td><input type=\'hidden\' name=\'id_obat[]\' value=\'" + dataResep[0].value + "\'><td>" + dataResep[1].value + " " + dataResep[3].value + "</td><input type=\'hidden\' name=\'jumlah_obat[]\' value=\'" + dataResep[1].value + "\'><td>" + dataResep[2].value + "</td><input type=\'hidden\' name=\'keterangan[]\' value=\'" + dataResep[2].value + "\'><td><button class=\'btn btn-secondary\' onclick=\'return (this.parentNode).parentNode.remove();\'><i class=\'fas fa-trash-alt\'></i></button></td></tr>";
    listResep.append(templateResep);
    alert("Resep telah ditambahkan!");
    $("#ModalResep").modal("hide");
  }

  function obat_onchange() {
    var obat = document.getElementById('obat');
    var satuan = document.getElementById('obat-' + obat.value);
    var satuan_obat_hidden = document.getElementById('satuan_obat');

    var satuan_show = document.getElementById('unit');

    satuan_show.placeholder = "Jml (" + satuan.innerHTML + ")";
    satuan_obat_hidden.value = satuan.innerHTML;
  }
</script>
<?php if ($this->session->flashdata('msg_hapus_obat')) {
  echo "<script>alert('" . $this->session->flashdata('msg_hapus_obat') . "')</script>";
} ?>