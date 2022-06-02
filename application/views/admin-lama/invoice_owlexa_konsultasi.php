
<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-12">
              <h4 class="page-title">Laporan Owlexa Telekonsultasi</h4>
          </div>
          <div class="col-sm-7 col-12">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Owlexa Telekonsultasi</li>
                </ol>
            </nav>
          </div>
      </div>
      <form method="GET">
                  <div class="row mb-3">
                    <!-- <div class="col-sm-2">
                      <div class="form-group">
                        <label>Metode Pembayaran</label>
                          <select class="form-control" name="metode">
                            <option>Pilih Metode</option>
                            <option>Transfer</option>
                            <option>Owlexa</option>
                          </select>
                      </div>
                    </div> -->
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Status</label>
                          <select class="form-control" name="status">
                            <option>Pilih Status</option>
                            <option>Semua</option>
                            <option>Paid</option>
                            <option>Canceled</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Dari</label>
                        <div class="cal-icon">
                          <input class="form-control datetimepicker" name="from" type="text" value="<?php echo $this->input->get('from') ? $this->input->get('from'):''; ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Sampai</label>
                        <div class="cal-icon">
                          <input class="form-control datetimepicker" name="to" type="text" value="<?php echo $this->input->get('to') ? $this->input->get('to'):''; ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-2 pt-2">
                      <div class="form-group">
                        <label></label>
                        <button class="btn btn-primary form-control">Submit</button>
                      </div>
                    </div>
                    <div class="col-sm-2 pt-2">
                      <div class="form-group">
                        <label></label>
                        <div class="dropdown">
                          <button class="btn btn-primary  dropdown-toggle form-control" type="button" data-toggle="dropdown"><i class="fa fa-download fa-md"></i> Save As
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu bg-blue">
                            <?php 
                                $from = $this->input->get('from');
                                $to = $this->input->get('to');
                                if(!$from || !$to){
                                    $tanggal = '';
                                }
                                else{
                                    $tanggal = '?from='.$from.'&to='.$to;
                                }
                            ?>
                            <li class="dropdown-item"><a class="btn btn-default btn block" href="<?php echo base_url('admin/Invoice/export_to_pdf_owlexa_konsultasi'.$tanggal) ?>">PDF</a></li>
                            <li class="dropdown-item"><a class="btn btn-default btn block" href="<?php echo base_url('admin/Invoice/export_to_excel_owlexa_konsultasi'.$tanggal) ?>">Excel</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                </div>
              </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                              <table class="display nowrap table table-border table-hover custom-table" id="table_faktur" style="width: 100%">                
                              <thead>
                              <tr>
                                <th>No</th>
                                <th>Claim Number</th>
                                <th>Telemedicine Trans Number</th>
                                <th>Transaction Time</th>
                                <th>Card Number</th>
                                <th>Member Name</th>
                                <th>Diagnosis Code</th>
                                <th>Diagnosis Name</th>
                                <th>Admission Date</th>
                                <th>Charge Time</th>
                                <th>Type of Service</th>
                                <th>Provider Nama</th>
                                <th>Doctor Name</th>
                                <th>Doctor Speciality</th>
                                <th>Claim Type</th>
                                <th>Benefit Description</th>
                                <th>Charge Benefit Item</th>
                                <th>Approved Benefit Item</th>
                                <th>Excess Benefit Item</th>
                                <th>Pre Paid Excess Item</th>
                                <th>Paid To Provider Item</th>
                                <th>Claim Remarks</th>
                                <th>Status</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php foreach($list_pembayaran as $idx=>$pembayaran){ ?>
                                <?php 
                                  $pembayaran->tanggal_pembayaran = new DateTime($pembayaran->tanggal_pembayaran);
                                  $charged_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
                                  $admission_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
                                  $pembayaran->tanggal_pembayaran = $pembayaran->tanggal_pembayaran->format('d/m/Y H:i:s');  
                                ?>
                                  <tr>
                                      <td><?php echo $idx+1 ?></td>
                                      <td><?php echo $pembayaran->claim_number ?></td>
                                      <td><?php echo $pembayaran->id_registrasi ?></td>
                                      <td><?php echo $pembayaran->tanggal_pembayaran ?></td>
                                      <td><?php echo $pembayaran->card_number ?></td>
                                      <td><?php echo $pembayaran->nama_pasien ?></td>
                                      <td><?php echo $pembayaran->diagnosis_code ?></td>
                                      <td><?php echo $pembayaran->diagnosis_name ?></td>
                                      <td><?php echo $admission_date ?></td>
                                      <td><?php echo $charged_date ?></td>
                                      <td>OUTPATIENT</td>
                                      <td>RS. TESTING OWLEXA</td>
                                      <td><?php echo $pembayaran->nama_dokter ?></td>
                                      <td><?php echo $pembayaran->nama_poli ?></td>
                                      <td>CASHLESS</td>
                                      <td>Biaya Konsultasi<br/>Biaya Administrasi</td>
                                      <?php 
                                        $biaya_adm = $pembayaran->biaya_adm ? $pembayaran->biaya_adm:0;
                                        $biaya_konsultasi = $pembayaran->biaya_konsultasi ? $pembayaran->biaya_konsultasi:0;
                                      ?>
                                      <td><?php echo "Rp. ".number_format($biaya_konsultasi, 2, ".", ","); ?><br/><?php echo "Rp. ".number_format($biaya_adm, 2, ".", ","); ?></td>
                                      <td><?php echo "Rp. ".number_format($biaya_konsultasi, 2, ".", ","); ?><br/><?php echo "Rp. ".number_format($biaya_adm, 2, ".", ","); ?></td>
                                      <td>0</br>0</td>
                                      <td>0<br/>0</td>
                                      <td><?php echo "Rp. ".number_format($biaya_konsultasi, 2, ".", ","); ?><br/><?php echo "Rp. ".number_format($biaya_adm, 2, ".", ","); ?></td>
                                      <td><!--EXCESS DIBAYAR DI TEMPAT<br/>-->BIAYA ADMIN TERDIRI DARI, BIAYA KONSULTASI & BIAYA ADMINISTRASI TELEMEDICINE</td>
                                      <td>PAID</td>
                                  </tr>
                                  <!-- <tr>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td>Biaya Administrasi</td>
                                  </tr> -->
                              <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>No</th>
                                <th>Claim Number</th>
                                <th>Telemedicine Trans Number</th>
                                <th>Transaction Time</th>
                                <th>Card Number</th>
                                <th>Member Name</th>
                                <th>Diagnosis Code</th>
                                <th>Diagnosis Name</th>
                                <th>Admission Date</th>
                                <th>Charge Time</th>
                                <th>Type of Service</th>
                                <th>Provider Nama</th>
                                <th>Doctor Name</th>
                                <th>Doctor Speciality</th>
                                <th>Claim Type</th>
                                <th>Benefit Description</th>
                                <th>Charge Benefit Item</th>
                                <th>Approved Benefit Item</th>
                                <th>Excess Benefit Item</th>
                                <th>Pre Paid Excess Item</th>
                                <th>Paid To Provider Item</th>
                                <th>Claim Remarks</th>
                                <th>Status</th>
                              </tr>
                              </tfoot>
                              </table>
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
<?php echo $this->session->flashdata('msg_export_invoice') ? '<script>alert("'.$this->session->flashdata('msg_export_invoice').'");</script>':''; ?>

<style>
  .bg-blue{
    background-color: #f1f1f1;
    color: #fff;
  }
</style>