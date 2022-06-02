
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header col-lg-12 " style="background-color: #1F60A8; color: #fff">
              <div class="card-title">Tambah Berita</div>
            </div>
              <!-- <form method="post" id="form-add-news"> -->
	           <?php echo form_open_multipart('admin/News/create');  ?>  
                                <div class="card-body">
                                      <div class="form-group">
                                      <div class="col-lg-12 mb-2">
                                        <label for="formGroupExampleInput" style="font-family: calibri"><b>Judul</b></label>
                                        <input type="text" class="form-control" name="judul" id="formGroupExampleInput" placeholder="masukkan judul" required>
                                      </div>
                                        <div class="form-group">
                                          <div class="col-lg-6 ">
                                          <label for="formGroupExampleInput" style="font-family: calibri"><b>Foto</b></label>
                                          <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="foto" id="file_upload" required>
                                          <label class="custom-file-label" id="filename">Choose file</label>
                                        </div>
                                        </div>  
                                        </div>
                                      <div class="form-group">
                                        <div class="col-lg-12">
                                        <label for="formGroupExampleInput" style="font-family: calibri"><b>Berita</b></label>
                                      <textarea class="ckeditor" id="ckedtor" name="berita" required></textarea>  
                                      </div>                                   
                                      </div>
                                      </div>
                                      </div>  
                                      <div class="col-lg-12">
                                        <div class="row mb-5 mt-2 justify-content-center">
                                          <div class="col-lg-4 mb-3">
                                            <button type="submit" class="btn btn-primary w-100" style="background-color: #1F60A8"  id="btn-add-dokter">TAMBAH</button>
                                          </div>
                                          <div class="col-lg-4">
                                            <a href="<?php echo base_url('admin/News');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
                                          </div>
                                        </div>  
                                        </div>
                           <?php echo form_close();  ?>
                                </div>
                            </div>
                        </div>
              
            <!-- /.card -->

          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
