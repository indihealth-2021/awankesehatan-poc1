<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3 px-3">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Invoice/invoice_telekonsultasi') ?>" class="text-black font-bold-7">Telekonsultasi</a></li>
          </ol>
        </nav>
      </div>
      <div class="col-sm-12 col-12">
        <h3 class="page-title">Telekonsultasi</h3>
      </div>
    </div>
    <form method="GET" class="font-14" action="<?php echo base_url('admin/Invoice/invoice_telekonsultasi') ?>">
      <div class="row mb-3 px-3">
        <div class="col-sm-6">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="filterby" id="filterby1" value="1" <?php echo isset($_GET['filterby']) ? ($_GET['filterby'] == "1" ? 'checked' : '') : 'checked' ?>>
            <label class="form-check-label" for="filterby1">Filter berdasarkan Poli</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="filterby" id="filterby2" value="2" <?php echo isset($_GET['filterby']) ? ($_GET['filterby'] == "2" ? 'checked' : '') : '' ?>>
            <label class="form-check-label" for="filterby2">Filter berdasarkan Dokter</label>
          </div>
        </div>
      </div>
      <div class="row px-3">
        <div class="col-sm-12 input-poli">
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Pilih Poli</label>
            <div class="col-sm-3">
              <select class="form-control" name="poli">
                <option value="">Pilih Poli</option>
                <?php foreach ($list_poli as $poli) { ?>
                  <option value="<?php echo $poli->id ?>" <?php echo isset($_GET['poli']) ? ($_GET['poli'] == $poli->id ? 'selected' : '') : '' ?>><?php echo $poli->poli ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-12 input-dokter">
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Pilih Dokter</label>
            <div class="col-sm-3">
              <select class="form-control" name="dokter">
                <option value=''>Pilih Dokter</option>
                <?php foreach ($list_dokter as $dokter) { ?>
                  <option value='<?php echo $dokter->id_dokter ?>' <?php echo isset($_GET['dokter']) ? ($_GET['dokter'] == $dokter->id_dokter ? 'selected' : '') : '' ?>><?php echo $dokter->nama_dokter ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row px-3">
        <div class="col-sm-12">
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Tanggal Input</label>
            <div class="col-sm-2">
              <div class="cal-icon">
                <input class="form-control datetimepicker" type="text" name="from" value="<?php echo $this->input->get('from') ? $this->input->get('from') : ''; ?>">
              </div>
            </div>
            <label class="col-sm-1 col-form-label">Sampai</label>
            <div class="col-sm-2">
              <div class="cal-icon">
                <input class="form-control datetimepicker" type="text" name="to" value="<?php echo $this->input->get('to') ? $this->input->get('to') : ''; ?>">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row pt-5 mx-0">
        <div class="col-sm-6">
          <div class="form-group">
            <button class="btn btn-tele form-control">Tampilkan</button>
          </div>
        </div>
        <div class="col-sm-6 text-right">
          <div class="form-group">
            <div class="dropdown">
              <button class="btn btn-tele  dropdown-toggle form-control" type="button" data-toggle="dropdown"><i class="fa fa-download fa-md"></i> Save As
                <span class="caret"></span></button>
              <ul class="dropdown-menu bg-blue">
                <?php
                $from = isset($_GET['from']) ? (!empty(trim($_GET['from'])) ? $_GET['from'] : '') : '';
                $to = isset($_GET['to']) ? (!empty(trim($_GET['to'])) ? $_GET['to'] : '') : '';
                $poli = isset($_GET['poli']) ? (!empty(trim($_GET['poli'])) ? $_GET['poli'] : '') : '';
                $dokter = isset($_GET['dokter']) ? (!empty(trim($_GET['dokter'])) ? $_GET['dokter'] : '') : '';
                ?>
                <li class="dropdown-item"><a class="btn btn-default btn-block" href="<?php echo base_url('admin/Invoice/export_to_pdf_telekonsultasi/?from=' . $from . '&to=' . $to . '&poli=' . $poli . '&dokter=' . $dokter) ?>">PDF</a></li>
                <li class="dropdown-item"><a class="btn btn-default btn-block" href="<?php echo base_url('admin/Invoice/export_to_excel_telekonsultasi/?from=' . $from . '&to=' . $to . '&poli=' . $poli . '&dokter=' . $dokter); ?>">Excel</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-md-12">
        <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="" data-toggle="tab">Poli</a></li>
            </ul> -->
        <div class="">
          <div class="tab-pane show pt-0">
            <div class="col-md-12">
              <div class="table-responsive pt-0">
                <table class="table table-border table-hover custom-table mb-0" id="table_konsultasi">
                  <thead class="text-tr">

                  </thead>
                  <tbody class="font-14">
                    <?php foreach ($list_pembayaran_konsultasi as $idx => $pembayaran_konsultasi) { $page++?>
                      <tr class="font-12" style="border-top: 3px solid #21AAC4;">
                        <td colspan="1"></td>
                        <td colspan="1">
                          <span>Tanggal Konsultasi</span><br>
                          <?php echo (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('d-m-Y'); ?>
                        </td>
                        <td colspan="1">
                          <span>Jam</span><br>
                          <?php echo (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('H:i'); ?>
                        </td>
                        <td colspan="4">
                          <span>Durasi</span><br>
                          <?php
                          if ($pembayaran_konsultasi->selesai_konsultasi != null) {
                            $awal_konsultasi = (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('H:i');
                            $awal_konsultasi = new DateTime($awal_konsultasi);

                            $akhir_konsultasi = (new DateTime($pembayaran_konsultasi->selesai_konsultasi))->format('H:i');
                            $akhir_konsultasi = new DateTime($akhir_konsultasi);

                            $diff = $awal_konsultasi->diff($akhir_konsultasi);

                            if ($diff->h < 1) {
                              $durasi = $diff->i . ' Menit';
                            } else {
                              $jam_menit = $diff->h * 60;
                              $durasi = ($diff->i + $jam_menit) . ' Menit';
                            }
                          } else {
                            $durasi = 'NOT SET';
                          }
                          ?>
                          <?php echo $durasi ?>
                        </td>
                      </tr>

                      <tr class="text-top">
                        <td><?php echo $page ?></td>
                        <td class="text-top" width="13%">
                          <span class="font-tr-table">Pasien</span><br>
                          <?php echo $pembayaran_konsultasi->nama_pasien ?>
                        </td>
                        <td class="text-top" width="18%">
                          <span class="font-tr-table">Dokter</span><br>
                          <span><?php echo $pembayaran_konsultasi->nama_dokter ?></span><br>
                          <span class="font-12"><?php echo $pembayaran_konsultasi->poli ?></span>
                        </td>
                        <td class="text-top" width="13%">
                          <span class="font-tr-table">Diagnosa</span><br>
                          <?php echo '( ' . $pembayaran_konsultasi->kode_diagnosa . ' ) ' . $pembayaran_konsultasi->nama_diagnosa ?>
                        </td>
                        <td class="text-top" width="16%">
                          <span class="font-tr-table">Resep</span><br>
                          <?php echo $pembayaran_konsultasi->nama_obat ?>
                        <td class="text-top">
                          <span class="font-tr-table">No. MR</span><br>
                          <?php echo $pembayaran_konsultasi->no_medrec ?>
                        </td>
                        <td class="text-top" width="25%">
                          <span class="font-tr-table">No. Registrasi</span><br>
                          <?php echo $pembayaran_konsultasi->id_registrasi ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="row pt-3">
                <div class="col-sm-12">
                  <div>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center">
                        <?php echo $pagination ?>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <script>
    var filterby = "<?php echo isset($_GET['filterby']) ? $_GET['filterby'] : '' ?>";
  </script>

  <?php echo $this->session->flashdata('msg_export_invoice') ? '<script>alert("' . $this->session->flashdata('msg_export_invoice') . '");</script>' : ''; ?>