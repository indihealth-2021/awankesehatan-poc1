<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-5 col-5">
        <h4 class="page-title">Pengaturan Web</h4>
      </div>
      <div class="col-sm-7 col-7">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan Web</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-border table-hover custom-table mb-0" id="table_pengaturan">
            <thead>
              <tr>
                <th colspan=3 class="text-center">
                  <h5><i class="fa fa-money"></i> Administrasi</h5>
                </th>
              </tr>
              <tr>
                <th>Nama</th>
                <th>Nilai</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Harga Administrasi</td>
                <td>
                  <span id="hargaAdmText"><?php echo 'Rp ' . number_format($web->harga_adm, 2, ',', '.'); ?></span>
                  <span id="hargaAdmInput">
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="number" id="hargaAdmInputText" class="form-control" aria-describedby="helpTextHargaAdm">
                        <small id="helpTextHargaAdm" class="form-text text-muted">
                          Rp 15.000,00
                        </small>
                      </div>
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-block btn-primary" id="btnOkHargaAdm"><span class="fa fa-check"></span></button>
                      </div>
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-block btn-danger" id="btnCloseHargaAdm"><span class="fa fa-close"></span></button>
                      </div>
                    </div>
                  </span>
                </td>
                <td><button class="btn btn-block btn-success" id="btnEditHargaAdm"><span class="fa fa-pencil"></span></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12 mt-5">
        <div class="table-responsive">
          <table class="table table-border table-hover custom-table mb-0" id="table_pengingat">
            <thead>
              <tr>
                <th colspan=3 class="text-center">
                  <h5><i class="fa fa-clock"></i> Pengingat Jadwal</h5>
                </th>
              </tr>
              <tr>
                <th>Nama</th>
                <th>Nilai</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Ingatkan Pada ( Menit )</td>
                <td>
                  <span id="remindAtText"><?php echo $web->ingatkan_pada; ?> Menit</span>
                  <span id="remindAtInput">
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="number" id="remindAtInputText" class="form-control" placeholder="Menit" aria-describedby="helpTextRemindAt">
                      </div>
                      <div class="col-sm-6 mt-2">
                        <button type="button" class="btn btn-block btn-primary" id="btnOkRemindAt"><span class="fa fa-check"></span></button>
                      </div>
                      <div class="col-sm-6 mt-2">
                        <button type="button" class="btn btn-block btn-danger" id="btnCloseRemindAt"><span class="fa fa-close"></span></button>
                      </div>
                    </div>
                  </span>
                </td>
                <td><button class="btn btn-block btn-success" id="btnEditRemindAt"><span class="fa fa-pencil"></span></button></td>
              </tr>
              <tr>
                <td>Ingatkan Setiap ( Menit )</td>
                <td>
                  <span id="remindEveryText"><?php echo $web->ingatkan_setiap; ?> Menit</span>
                  <span id="remindEveryInput">
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="number" id="remindEveryInputText" class="form-control" aria-describedby="helpTextRemindEvery">
                      </div>
                      <div class="col-sm-6 mt-2">
                        <button type="button" class="btn btn-block btn-primary" id="btnOkRemindEvery"><span class="fa fa-check"></span></button>
                      </div>
                      <div class="col-sm-6 mt-2">
                        <button type="button" class="btn btn-block btn-danger" id="btnCloseRemindEvery"><span class="fa fa-close"></span></button>
                      </div>
                    </div>
                  </span>
                </td>
                <td><button class="btn btn-block btn-success" id="btnEditRemindEvery"><span class="fa fa-pencil"></span></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- /.card-body -->
  </div>
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->

<script>
  var hargaAdm = <?php echo $web->harga_adm; ?>;
  var remindAt = <?php echo $web->ingatkan_pada; ?>;
  var remindEvery = <?php echo $web->ingatkan_setiap; ?>;
</script>