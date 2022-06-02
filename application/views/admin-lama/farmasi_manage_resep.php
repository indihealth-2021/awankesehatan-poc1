<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Resep</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('farmasi/farmasi');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Resep</li>
                </ol>
            </nav>
          </div>
      </div>
                <div class="row">
                    <div class="col-sm-12 col-9 text-right m-b-20">
                        <a href="" class="btn btn btn-primary btn-rounded float-left"><i class="fa fa-plus"></i> Tambah Obat</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-hover custom-table mb-0" id="table_obat">                
   
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Aturan Pakai</th>
                  <th class="text-right">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                      <td><</td>
                      <td></td>
                      <td></td>
                      <td></td>  
                      <td class="text-center">
                          <a href="#"><button class="btn btn-primary btn-primary-one">Edit</button></a><br>
                          <a href="#"><button class="btn btn-danger btn-danger-one">Hapus</button>
                      </td>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th class="text-right">Aksi</th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url('admin/Obat/delete/'.$obat->id) ?>">
      <div class="modal-body">
          <p>Anda yakin ingin menghapus data obat <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="buttonHapus">Ya</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
      </form>
    </div>
  </div>
  </div>


<?php if($this->session->flashdata('msg_obat')){ echo "<script>alert('".$this->session->flashdata('msg_obat')."')</script>"; } ?>
