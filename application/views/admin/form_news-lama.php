    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-5">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Tambah Berita</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/admin');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Berita</li>
                </ol>
            </nav>
          </div>
      </div>

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <!-- <form> -->
                        <?php echo form_open_multipart('admin/News/create');  ?>  
                            <div class="form-group">
                                <label>Judul Berita</label>
                                <input type="text" class="form-control" name="judul" id="formGroupExampleInput" placeholder="masukkan judul" required>
                            </div>
                            <div class="form-group">
                                <label>Gambar Berita</label>
                                <div class="col-sm-8">
                                    <input type="file" class="custom-file-input" name="foto" id="file_upload" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png" required>
                                    <label class="custom-file-label" id="filename">Pilih Gambar</label>
                                    <small class="form-text text-muted">Maksimal. file size: 50 MB. Type gambar: jpg, gif, png.</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Berita</label>
                                <!-- <textarea class="ckeditor" id="ckedtor" name="berita" required></textarea>   -->
                                <textarea class="ckeditor" id="ckedtor" name="berita" required></textarea>  
                            </div>
                            <!-- <div class="form-group">
                                <label class="display-block">Status Berita</label>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" id="status" value=1>
                                  <label class="form-check-label" for="">
                                  Aktif
                                  </label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" id="status" value=0>
                                  <label class="form-check-label" for="berita_inactive">
                                  Tidak Aktif
                                  </label>
                                </div>
                            </div> -->
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="btn-add-berita">Buat Berita</button>
                            </div>
                            <?php echo form_close();  ?>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
            </div>
            <style>
              .custom-file-input:lang(en)~.custom-file-label::after {
                  content: "Pilih";
              }
            </style>