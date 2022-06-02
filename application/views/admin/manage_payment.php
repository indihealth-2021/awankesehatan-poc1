
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/payment') ?>" class="text-black font-bold-7">Pembayaran</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Pembayaran Telekonsultasi</h3>
          </div>
      </div>  
      <div class="row">
          <div class="col-sm-12 col-12 text-right m-b-20">
              <a href="<?php echo base_url('admin/History') ?>" class="text-tele font-14 float-right">Lihat Riwayat Pembayaran</a>
          </div>
      </div>
            
        <div class="row">
          <div class="col-md-12">
            <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="" data-toggle="tab">Poli</a></li>
            </ul> -->
            <div class="bg-tab p-3">
              <div class="tab-pane show pt-3">
                <div class="col-md-12">
                  <div class="box">
                      <div class="container-1">
                          <span class="icon"><i class="fa fa-search font-16"></i></span>
                          <input type="search" id="search" placeholder="Cari Pasien Disini" />
                      </div>
                    </div>
                  <div class="table-responsive pt-0">
                    <table class="table table-border table-hover custom-table mb-0" id="table_verifikasi_payment">
                      <thead class="text-tr">
                        <tr class="text-center">
                          <th class="text-left">No</th>
                          <th>Pasien</th>
                          <th>Biaya</th>
                          <th>Tanggal Upload</th>
                          <th>Bukti Pembayaran</th>
                          <th>Aksi</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="font-14">
                        <?php $no = 0; 
                          foreach ($payment as $data) {
                            $no++ ?>
                              <?php $data->status = $data->id_status_pembayaran == 2  ? 'Belum Diverifikasi' : 'Sudah Diverifikasi' ?>
                            <tr class="odd gradeX">
                              <td><?php echo $no; ?></td>
                              <td><?php echo $data->name; ?></td>
                              <?php 
                                $biaya_konsultasi = $data->biaya_konsultasi ? 'Rp. '.number_format($data->biaya_konsultasi, 2, ',', '.'):'Biaya Konsultasi belum diset di bukti_pembayaran ( Kemungkinan dari Mobile )';
                                $biaya_adm = $data->biaya_adm ? 'Rp. '.number_format($data->biaya_adm, 2, ',', '.'):'Biaya Administrasi belum diset di bukti_pembayaran ( Kemungkinan dari Mobile )';
                              ?>
                              <td><?php echo 'Biaya Konsultasi: <span class="text-success">'.$biaya_konsultasi.'</span><br/><br/>Biaya Administrasi: <span class="text-success">'.$biaya_adm.'</span><br/><br/>Total Biaya: <span class="text-success">'.$data->total_biaya.'</span>'; ?></td>
                              <!-- <td><img data-toggle="modal" data-target="#myModal" style="width:100px; max-height: auto;" src="<?php echo $data->photo; ?>" alt="<?php //echo $data->photo ?>" class="myImg"></td> -->
                              
                              <td width="18%"><?php $tanggal = new DateTime($data->tanggal_upload_pembayaran); echo $tanggal->format('d-m-Y H:i:s');  ?></td>
                              <td>
                                <!-- Button trigger modal -->
                                <img data-toggle="modal" data-target="#exampleModal" width="88" height="61" src="<?php echo $data->photo; ?>" alt="<?php echo $data->photo ?>" class="myImg">
                              
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" >
                                <div class="col-lg-12">
                                  <div class="modal-content modal-bukti" >
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Bukti</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                      <img class="modal-body modal-bukti">
                                    <!-- <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div> -->
                                  </div>
                                </div>
                                  
                                </div>
                              </div>

                              </td>
                              <td class="text-center">
                                        <a class="btn btn-kirim" href="<?php echo base_url('admin/Payment/update/'.$data->id_bukti);?>">Verifikasi</a>
                              </td>
                              <td>
                                <a class="font-icon" href="<?php echo base_url('admin/Payment/delete/'.$data->id_bukti);?>" onclick="confirm('Anda yakin ingin menghapus bukti ini?')" >
                                  <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                  <path d="M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z" fill="black" fill-opacity="0.35"/>
                                  <path d="M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z" fill="black" fill-opacity="0.35"/>
                                  </svg></i>
                                </a>
                              </td>
                          </tr>
                              <?php } ?>
                        </tbody>
                    </table> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
    <?php if($this->session->flashdata('msg_payment')){ echo "<script>alert('".$this->session->flashdata('msg_payment')."')</script>"; } ?>





<style type="text/css">
  .modal-bukti{
    width: 30rem;
    height: auto;
  }
  </style>