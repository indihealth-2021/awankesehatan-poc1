<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-5 col-5">
                <h4 class="page-title">Laporan 10 Diagnosa Terbanyak</h4>
            </div>
            <div class="col-sm-7 col-7">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Diagnosa Terbanyak</li>
                    </ol>
                </nav>
            </div>
        </div>
        <form method="GET">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filterby" id="filterby1" value="1" <?php echo isset($_GET['filterby']) ? ($_GET['filterby'] == "1" ? 'checked':''):'checked' ?>>
                        <label class="form-check-label" for="filterby1">Filter berdasarkan Poli</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filterby" id="filterby2" value="2" <?php echo isset($_GET['filterby']) ? ($_GET['filterby'] == "2" ? 'checked':''):'' ?>>
                        <label class="form-check-label" for="filterby2">Filter berdasarkan Dokter</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 input-poli">
                    <div class="form-group">
                        <label>Poli</label>
                        <select class="form-control" name="poli">
                            <option value=''>Pilih Poli</option>
                            <?php foreach ($list_poli as $poli) { ?>
                                <option value="<?php echo $poli->id ?>" <?php echo isset($_GET['poli']) ? ($_GET['poli'] == $poli->id ? 'selected':''):'' ?>><?php echo $poli->poli ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 input-dokter">
                    <div class="form-group">
                        <label>Dokter</label>
                        <select class="form-control" name="dokter">
                            <option value=''>Pilih Dokter</option>
                            <?php foreach ($list_dokter as $dokter) { ?>
                                <option value='<?php echo $dokter->id_dokter ?>' <?php echo isset($_GET['dokter']) ? ($_GET['dokter'] == $dokter->id_dokter ? 'selected':''):'' ?>><?php echo $dokter->nama_dokter ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Dari</label>
                        <div class="cal-icon">
                            <input class="form-control datetimepicker" type="text" name="from" value="<?php echo $this->input->get('from') ? $this->input->get('from') : ''; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Sampai</label>
                        <div class="cal-icon">
                            <input class="form-control datetimepicker" type="text" name="to" value="<?php echo $this->input->get('to') ? $this->input->get('to') : ''; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label></label>
                        <button class="btn btn-primary form-control">Submit</button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label></label>
                        <div class="dropdown">
                            <button class="btn btn-primary  dropdown-toggle form-control" type="button" data-toggle="dropdown"><i class="fa fa-download fa-md"></i> Save As
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu bg-blue">
                                <?php
                                $from = isset($_GET['from']) ? (!empty(trim($_GET['from'])) ? $_GET['from']:'' ):'';
                                $to = isset($_GET['to']) ? (!empty(trim($_GET['to'])) ? $_GET['to']:'' ):'';
                                $poli = isset($_GET['poli']) ? (!empty(trim($_GET['poli'])) ? $_GET['poli']:'' ):'';
                                $dokter = isset($_GET['dokter']) ? (!empty(trim($_GET['dokter'])) ? $_GET['dokter']:'' ):'';
                                ?>
                                <li class="dropdown-item"><a class="btn btn-default btn-block" href="<?php echo base_url('admin/Invoice/export_to_pdf_diagnosa_terbanyak/?from='.$from.'&to='.$to.'&poli='.$poli.'&dokter=' . $dokter) ?>">PDF</a></li>
                                <li class="dropdown-item"><a class="btn btn-default btn-block" href="<?php echo base_url('admin/Invoice/export_to_excel_diagnosa_terbanyak/?from='.$from.'&to='.$to.'&poli='.$poli.'&dokter=' . $dokter); ?>">Excel</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="display nowrap table table-border table-hover custom-table mb-0" id="table_diagnosa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Diagnosa</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_diagnosa = 0; ?>
                            <?php foreach ($list_diagnosa as $idx => $diagnosa) { ?>
                                <tr>
                                    <td><?php echo $idx + 1 ?></td>
                                    <td><?php echo $diagnosa->id ?></td>
                                    <td><?php echo $diagnosa->nama ?></td>
                                    <td><?php echo $diagnosa->jumlah_diagnosa ?></td>
                                    <?php $total_diagnosa+=$diagnosa->jumlah_diagnosa ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <span class="bg-primary text-white"><b>Total Diagnosa: </b><?php echo $total_diagnosa ?></span>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->

<script>
var filterby = "<?php echo isset($_GET['filterby']) ? $_GET['filterby']:'' ?>";
</script>

<?php echo $this->session->flashdata('msg_export_invoice') ? '<script>alert("' . $this->session->flashdata('msg_export_invoice') . '");</script>' : ''; ?>