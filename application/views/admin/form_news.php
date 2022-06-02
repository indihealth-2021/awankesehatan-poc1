
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/news') ?>" class="text-black">Berita</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/News/formAdd') ?>" class="text-black font-bold-7">Tambah Berita</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Tambah Berita</h3>
          </div>
      </div> 

        <?php echo form_open_multipart('admin/News/create');  ?> 
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="gen-label text-label-form">Judul Berita</label>
                  <input type="text" class="form-control" name="judul"  placeholder="Masukkan Judul Berita" required>
                </div>
              </div>
              <div class="col-md-12">
              <div class="form-group">
                <label class="gen-label text-label-form">Gambar</label>
                  <div class="profile-upload">
                    <div class="upload-input">
                      <input type="file" class="form-control" name="foto" id="file_upload" size="5024" accept=".gif,.jpg,.jpeg,.jfif,.png" required>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                  <label class="gen-label text-label-form">Deskripsi</label>
                  <!-- <textarea class="ckeditor" id="ckedtor" name="berita" required></textarea>   -->
                  <textarea class="ckeditor" id="ckedtor" name="berita"></textarea>  
              </div>
            </div>
          </div>
          </div>
          <!-- <div class="col-md-4">
            <div class="row">
              <div class="col-md-12">
                <label class="gen-label text-label-form">Pilih Tag</label>
                <div class="card p-3">
                <label class="gen-label text-label-form">Tambah Tag</label>
                <input type="text" name="tag" class="form-control" placeholder="Masukan Tag Berita">
                </div>
              </div>
            </div>
          </div> -->
        </div> 
        <div class="row mt-5">
          <div class="mx-auto">
                <button class="btn btn-simpan">Simpan</button>
                <a href="<?php echo base_url('admin/news') ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
          </div>
        </div> 
        <?php echo form_close();  ?>
        <?php if($this->session->flashdata('msg_news')){ echo "<script>alert('".$this->session->flashdata('msg_news')."')</script>"; } ?>