
    <!-- Main content -->
<div class="page-wrapper">
    <div class="content">
      <div class="row mb-4">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/PengaturanWeb') ?>" class="text-black">Pengaturan Web</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/PengaturanWeb/form_edit_manual_payment/'.$manual_payment->payment_id) ?>" class="text-black font-bold-7">Edit Master Manual Payment</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Pengaturan Web</h3>
          </div>
          <div class="col-sm-12 col-12">
              <h7 class="page-subtitle">Edit Master Manual Payment</h7>
          </div>
      </div>  
      <div class="row">
        <div class="col-md-12">
        <form style="background-color: #fff" class="p-4 row" action="<?php echo base_url('admin/PengaturanWeb/update_manual_payment/'.$manual_payment->payment_id) ?>" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama</label>
                    <input type="text" name="payment" class="form-control" id="exampleFormControlInput1" placeholder="Nama Channel ( ex: BNI )" value="<?php echo $manual_payment->payment ?>">
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?php echo base_url($manual_payment->logo) ?>" width="100px" class="img-permata">
                <div class="custom-file mt-2">
                    <input type="file" name="logo" class="custom-file-input" id="validatedCustomFile">
                    <label id="filename" class="custom-file-label" for="validatedCustomFile">Pilih logo..</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">No Rekening</label>
                    <input type="number" name="no_rekening" class="form-control" id="exampleFormControlInput1" placeholder="No Rekening ( ex: 8806081316107464 )" value="<?php echo $manual_payment->no_rekening ?>">
                </div>
            </div>
            <div class="col-md-12">
                Status:<br/><br/>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="aktif" value="1" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" <?php echo $manual_payment->aktif ? 'checked':'' ?>>
                    <label class="custom-control-label" for="customRadioInline1">Aktif</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="aktif" value="0" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" <?php echo !$manual_payment->aktif ? 'checked':'' ?>>
                    <label class="custom-control-label" for="customRadioInline2">Tidak Aktif</label>
                </div>
            </div>
            <button type="submit" class="btn btn-block bg-tele text-light mt-5">Submit</button>
        </form>
        </div>
      </div>
    </div>
</div>