
    <!-- Main content -->
<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/PengaturanWeb') ?>" class="text-black font-bold-7">Pengaturan Web</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Pengaturan Web</h3>
          </div>
      </div>  
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-border table-hover custom-table mb-0" id="table_pengaturan">
            <thead>
              <tr>
                <th colspan=3 class="text-center">
                  <h4><i class="fa fa-money"></i> Administrasi</h4>
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
                <td>Biaya Administrasi</td>
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
                        <button type="button" class="btn btn-block btn-ya-web" id="btnOkHargaAdm"><span class="fa fa-check"></span></button>
                      </div>
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-block btn-tidak-web" id="btnCloseHargaAdm"><span class="fa fa-close"></span></button>
                      </div>
                    </div>
                  </span>
                </td>
                <td><button class="btn btn-block btn-edit-web" id="btnEditHargaAdm"><span class="fa fa-pencil"></span></button></td>
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
                  <h4><i class="fa fa-clock"></i> Pengingat Jadwal</h4>
                </th>
              </tr>
              <tr>
                <th>Nama</th>
                <th>Menit</th>
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
                        <button type="button" class="btn btn-block btn-ya-web" id="btnOkRemindAt"><span class="fa fa-check"></span></button>
                      </div>
                      <div class="col-sm-6 mt-2">
                        <button type="button" class="btn btn-block btn-tidak-web" id="btnCloseRemindAt"><span class="fa fa-close"></span></button>
                      </div>
                    </div>
                  </span>
                </td>
                <td><button class="btn btn-block btn-edit-web" id="btnEditRemindAt"><span class="fa fa-pencil"></span></button></td>
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
                        <button type="button" class="btn btn-block btn-ya-web" id="btnOkRemindEvery"><span class="fa fa-check"></span></button>
                      </div>
                      <div class="col-sm-6 mt-2">
                        <button type="button" class="btn btn-block btn-tidak-web" id="btnCloseRemindEvery"><span class="fa fa-close"></span></button>
                      </div>
                    </div>
                  </span>
                </td>
                <td><button class="btn btn-block btn-edit-web" id="btnEditRemindEvery"><span class="fa fa-pencil"></span></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12 mt-5">
            <div class="table-responsive">
                <table class="table table-border table-hover custom-table mb-0" id="table-manual-payment">
                    <thead>
                        <tr>
                          <th colspan=6 class="text-center">
                              <h4><i class="fa fa-money"></i> Channel Bank Verifikasi Manual</h4>
                          </th>
                        </tr>
                        <tr>
                          <th colspan=6 class="text-center">
                              <button class="btn btn-block bg-tele text-light"><i class="fa fa-plus"> Tambah Channel</i></button>
                          </th>
                        </tr>
                        <tr>
                          <th>ID</th>
                          <th>Nama</th>
                          <th>No Rekening</th>
                          <th>Logo</th>
                          <th>Status</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list_manual_payment as $manual_payment){ ?>
                            <tr>
                                <td><?php echo $manual_payment->payment_id ?></td>
                                <td><?php echo $manual_payment->payment ?></td>
                                <td><?php echo $manual_payment->no_rekening ?></td>
                                <td><img src="<?php echo $manual_payment->logo ?>" width="100px" class="img-permata"></td>
                                <td class="text-center"><?php echo $manual_payment->aktif == 1 ? '<span class="status-aktif">Aktif</span>' : '<span class="status-nonaktif">Tidak Aktif</span>' ?></td>
                                <td class="text-center"><a href="<?php echo base_url('admin/PengaturanWeb/form_edit_manual_payment/'.$manual_payment->payment_id) ?>"><button class="btn btn-sm"><span class="fa fa-pencil"></span></button></a> | <button class="btn btn-sm"><span class="fa fa-trash"></span></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-border table-hover custom-table mb-0" id="table-va">
                    <thead>
                        <tr>
                          <th colspan=6 class="text-center">
                              <h4><i class="fa fa-money"></i> Channel Bank Virtual Account</h4>
                          </th>
                        </tr>
                        <tr>
                          <th colspan=6 class="text-center">
                              <button class="btn btn-block bg-tele text-light"><i class="fa fa-plus"> Tambah Channel</i></button>
                          </th>
                        </tr>
                        <tr>
                          <th>ID</th>
                          <th>Nama</th>
                          <th>Logo</th>
                          <th>ID SOF</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list_payment_va as $payment_va){ ?>
                            <tr>
                                <td><?php echo $payment_va->payment_id ?></td>
                                <td><?php echo $payment_va->payment ?></td>
                                <td><img src="<?php echo $payment_va->logo ?>" width="100px" class="img-permata"></td>
                                <td><?php echo $payment_va->id_sof ?></td>
                                <td class="text-center"><button class="btn btn-sm"><span class="fa fa-pencil"></span></button> | <button class="btn btn-sm"><span class="fa fa-trash"></span></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-border table-hover custom-table mb-0" id="table-e-wallet">
                    <thead>
                        <tr>
                          <th colspan=6 class="text-center">
                              <h4><i class="fa fa-money"></i> Channel E Wallet </h4>
                          </th>
                        </tr>
                        <tr>
                          <th colspan=6 class="text-center">
                              <button class="btn btn-block bg-tele text-light"><i class="fa fa-plus"> Tambah Channel</i></button>
                          </th>
                        </tr>
                        <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Logo</th>
                        <th>ID SOF</th>
                        <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list_e_wallet as $e_wallet){ ?>
                            <tr>
                                <td><?php echo $e_wallet->payment_id ?></td>
                                <td><?php echo $e_wallet->payment ?></td>
                                <td><img src="<?php echo $e_wallet->logo ?>" width="100px" class="img-permata"></td>
                                <td><?php echo $e_wallet->id_sof ?></td>
                                <td class="text-center"><button class="btn btn-sm"><span class="fa fa-pencil"></span></button> | <button class="btn btn-sm"><span class="fa fa-trash"></span></button></td>
                            </tr>
                        <?php } ?>
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