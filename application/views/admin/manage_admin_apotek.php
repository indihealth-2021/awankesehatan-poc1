
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-4">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/dokter') ?>" class="text-black font-bold-7">User Management</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">User Management</h3>
          </div>
          <div class="col-sm-12 col-12">
              <h7 class="page-subtitle">Admin Apotek</h7>
          </div>
      </div>  
      
            
        <div class="row">
          <div class="col-md-12">
            <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="" data-toggle="tab">Dokter</a></li>
            </ul> -->
            <div class="bg-tab px-3">
              <div class="tab-pane show pt-3" id="admin">
                <div class="col-md-12">
                  <div class="box">
                      <div class="container-1">
                          <span class="icon"><i class="fa fa-search font-16 text-tele"></i></span>
                          <input type="search" id="search" style="background: #ffffff !important;" placeholder="Cari Admin Apotek Disini" />
                      </div>
                    </div>
                  <div class="">
                      <a href="<?php echo base_url('admin/AdminApotek/form_admin_apotek') ?>" class="btn btn btn-tele btn-rounded float-right  "><i class="fa fa-plus"></i> Tambah Admin Apotek</a>
                  </div>
                  <div class="table-responsive pt-4">
                    <table class="table table-border table-hover custom-table mb-0" id="table_dokter">
                      <thead class="text-tr">
                        <tr class="text-center">
                          <th class="text-left">No</th>
                          <th>Nama</th>
                          <!-- <th>Spesialis</th> -->
                          <th>Username</th>
                          <th>Email</th>
                          <th>Telp</th>
                          <th>Apotek</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="font-14">
                        <?php foreach($list_admin_apotek as $idx=>$admin_apotek){ ?>
                  <tr>
                    <td><?php echo $admin_apotek->id ?></td>
                    <td>
                      <?php echo ucwords($admin_apotek->name) ?><br>
                    </td>
                    <td><?php echo $admin_apotek->username ?></td>
                    <td><?php echo $admin_apotek->email ?></td>
                    <td><?php echo $admin_apotek->telp ?></td>
                    <td><?php echo $admin_apotek->nama_apotek ?></td>
                    <td class="text-center"><?php echo $admin_apotek->aktif == 1 ? '<span class="status-aktif">Aktif</span>' : '<span class="status-nonaktif">Tidak Aktif</span>' ?></td>
                    <td width="10%"> 
                                <a class="font-icon" href="#modalHapus" data-toggle="modal" data-href="<?php echo base_url('admin/AdminApotek/delete/'.$admin_apotek->id);?>" data-nama="<?php echo $admin_apotek->name ?>" onclick="$('#modalHapus #form')" >
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                  <path d="M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z" fill="black" fill-opacity="0.35"/>
                                  <path d="M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z" fill="black" fill-opacity="0.35"/>
                                  </svg></i>
                              </a>
                              <a class="mx-3" href="<?php echo base_url('admin/AdminApotek/edit/'.$admin_apotek->id);?>"><!-- <i class="fas fa-pen font-16"></i> -->
                                  <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                  <path d="M15.8333 16.6667H4.16667C3.94566 16.6667 3.73369 16.7545 3.57741 16.9108C3.42113 17.0671 3.33334 17.279 3.33334 17.5C3.33334 17.7211 3.42113 17.933 3.57741 18.0893C3.73369 18.2456 3.94566 18.3334 4.16667 18.3334H15.8333C16.0544 18.3334 16.2663 18.2456 16.4226 18.0893C16.5789 17.933 16.6667 17.7211 16.6667 17.5C16.6667 17.279 16.5789 17.0671 16.4226 16.9108C16.2663 16.7545 16.0544 16.6667 15.8333 16.6667ZM4.16667 15H4.24167L7.71667 14.6834C8.09733 14.6455 8.45337 14.4777 8.725 14.2084L16.225 6.70838C16.5161 6.40085 16.6734 5.99047 16.6625 5.56716C16.6516 5.14385 16.4733 4.74213 16.1667 4.45004L13.8833 2.16671C13.5853 1.88679 13.1948 1.72618 12.7861 1.71542C12.3774 1.70467 11.979 1.84452 11.6667 2.10838L4.16667 9.60838C3.89731 9.88001 3.72959 10.236 3.69167 10.6167L3.33334 14.0917C3.32211 14.2138 3.33795 14.3368 3.37972 14.452C3.42149 14.5673 3.48817 14.6719 3.575 14.7584C3.65287 14.8356 3.74522 14.8967 3.84675 14.9382C3.94828 14.9797 4.057 15.0007 4.16667 15ZM12.725 3.33338L15 5.60838L13.3333 7.23338L11.1 5.00004L12.725 3.33338Z" fill="black" fill-opacity="0.35"/>
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
        

<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-modal-header p-3">Hapus Data Dokter</h5>
      </div>
      <form method="post" action="<?php echo base_url('admin/AdminApotek/delete'.$admin_apotek->id);?>">
      <div class="modal-body font-modal-body">
          <p class="p-3">Anda yakin ingin menghapus data admin apotek <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <div class="mx-auto">
          <a href="" class="btn btn-ya" id="buttonHapus">Ya</a>
          <button type="button" class="btn btn-tidak ml-5" data-dismiss="modal">Tidak</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  </div>

  <?php if($this->session->flashdata('error_add_dokter')){ ?>
<script>
alert("<?php echo $this->session->flashdata('error_add_dokter'); ?>");
</script>
  <?php } ?>
  
  <?php echo $this->session->flashdata('msg_add_dokter') ? "<script>alert('".$this->session->flashdata('msg_add_dokter')."')</script>" : ''; ?>
  <?php echo $this->session->flashdata('msg_edit_dokter') ? "<script>alert('".$this->session->flashdata('msg_edit_dokter')."')</script>" : ''; ?>
  <?php echo $this->session->flashdata('msg_hps_dokter') ? "<script>alert('".$this->session->flashdata('msg_hps_dokter')."')</script>" : ''; ?>

