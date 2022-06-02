<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-5 col-5">
                <h4 class="page-title">Laporan Pengeluaran Obat</h4>
            </div>
            <div class="col-sm-7 col-7">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Pengeluaran Obat</li>
                    </ol>
                </nav>
            </div>
        </div>
        <form method="GET">
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
                    <table class="display nowrap table table-border table-hover custom-table mb-0" id="table_obat">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_obat as $idx => $obat) { ?>
                                <tr>
                                    <td><?php echo $idx + 1 ?></td>
                                    <td><?php echo $obat->id ?></td>
                                    <td><?php echo $obat->name ?></td>
                                    <td><?php echo $obat->total_jml_obat ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <span class="bg-primary text-white"><b>Total Diagnosa: </b><?php echo $total_obat ?></span>
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