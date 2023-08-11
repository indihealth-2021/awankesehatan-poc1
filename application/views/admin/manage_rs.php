
<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-4">
            <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('user/user');?>" class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7"><?php echo $title; ?></a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-12 col-12">
                <h3 class="page-title"><?php echo "Manage RS" ?></h3>
            </div>
            <div class="col-sm-12 col-12">
                <h7 class="page-subtitle">Manage Data Rumah Sakit</h7>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="bg-tab px-3">
                    <form action="<?php echo base_url('admin/RumahSakit/save_rs') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama-rs">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama-rs" value="<?php echo $rs ? ($rs->nama ? $rs->nama : ''):'' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no-telp-fax">No. Telepon / Fax</label>
                            <input type="number" name="telp_fax" class="form-control" id="no-telp-fax" value="<?php echo $rs ? ($rs->telp_fax ? $rs->telp_fax : ''):'' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control form-control-sm" name="alamat_provinsi" id="provinsi" required>
                                        <option>PILIH PROVINSI</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control form-control-sm" name="alamat_kota" id="kotkab" required>
                                        <?php if($rs){ ?>
                                            <?php if($rs->alamat_kota){ ?>
                                                <option value="<?php echo $rs->alamat_kota ?>"><?php echo $rs->nama_kota ?></option>
                                            <?php }else{ ?>
                                                <option value="0">PILIH KABUPATEN / KOTA</option>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <option value="0">PILIH KABUPATEN / KOTA</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <select class="form-control form-control-sm" name="alamat_kecamatan" id="kecamatan" required>
                                    <?php if($rs){ ?>
                                            <?php if($rs->alamat_kecamatan){ ?>
                                                <option value="<?php echo $rs->alamat_kecamatan ?>"><?php echo $rs->nama_kecamatan ?></option>
                                            <?php }else{ ?>
                                                <option value="0">PILIH KECAMATAN</option>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <option value="0">PILIH KECAMATAN</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <select class="form-control form-control-sm" name="alamat_kelurahan" id="kelurahan" required>
                                        <?php if($rs){ ?>
                                            <?php if($rs->alamat_kelurahan){ ?>
                                                <option value="<?php echo $rs->alamat_kelurahan ?>"><?php echo $rs->nama_kelurahan ?></option>
                                            <?php }else{ ?>
                                                <option value="0">PILIH KELURAHAN</option>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <option value="0">PILIH KELURAHAN</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="text" class="form-control form-control-sm" name="alamat_detail" value="<?php echo $rs ? ($rs->alamat_detail ? $rs->alamat_detail : ''):'' ?>" placeholder="Detail Alamat" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="number" class="form-control form-control-sm" name="kode_pos" value="<?php echo $rs ? ($rs->kode_pos ? $rs->kode_pos : ''):'' ?>" placeholder="Kode Pos" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama-direktur">Nama Direktur</label>
                            <input type="text" class="form-control" name="direktur" value="<?php echo $rs ? ($rs->direktur ? $rs->direktur : ''):'' ?>" id="nama-direktur" required>
                        </div>
                        <div class="form-group">
                            <label for="logo-rs">Logo</label><br/>
                            <?php if($rs){ ?>
                                <?php if($rs->logo){ ?>
                                    <img src="<?php echo base_url('assets/images/logo/'.$rs->logo.'?id='.date('now')) ?>" height="50px" class="img-fluid mb-2">
                                <?php } ?>
                            <?php } ?>
                            <div class="custom-file">
                                <input type="file" name="logo" class="custom-file-input"  id="logo-rs" size="10024" style="width: 100% !important" accept=".gif,.jpg,.jpeg,.jfif,.png">
                                <label class="custom-file-label" for="customFile" id="filename">
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block bg-tele text-light mb-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>
