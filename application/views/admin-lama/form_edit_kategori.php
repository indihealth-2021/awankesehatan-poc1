<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-5 col-12">
                        <h4 class="page-title">Edit Kategori Obat</h4>
                    </div>
                    <div class="col-sm-7 col-12">
                    <nav aria-label="">
                        <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('pasien/pasien');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kategori Obat</li>
                        </ol>
                    </nav>
                  </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" id="form-add-poli" action="<?php echo base_url('admin/KategoriObat/update') ?>">
                            <div class="row">
                                <div class="col-sm-6 offset-lg-3">
                                    <div class="form-group">
                                        <label>Kategori Obat</label>
                                        <input type="text" value="<?php echo $kategori_obat->name ?>" class="form-control" name="id_kategori_obat" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="sendKategori">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>