 <!-- Main content -->
 <div class="page-wrapper">
   <div class="content">
     <div class="row mb-3 px-3">
       <div class="col-sm-12 col-12 ">
         <nav aria-label="">
           <ol class="breadcrumb" style="background-color: transparent;">
             <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
             <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Dokter/profil/all') ?>" class="text-black font-bold-7">Profile Dokter</a></li>
           </ol>
         </nav>
       </div>
       <div class="col-sm-12 col-12">
         <h3 class="page-title">Profile Dokter</h3>
         <div style="border-bottom: 3px solid #59A799;"></div>
       </div>
     </div>

     <div class="row px-3">
       <div class="col-md-3 col-12 mb-3">
         <div class="box">
           <div class="container-2">
             <span class="icon" id="searchButton"><i class="fa fa-search font-16"></i></span>
             <form method="GET" id="searchForm" action="<?php echo base_url('pasien/Dokter/profil/'.$id_poli) ?>">
             <input type="search" name="nama_dokter" id="search" value="<?php echo isset($_GET['nama_dokter']) ? $_GET['nama_dokter']:''; ?>" placeholder="Cari Dokter Disini" />
             </form>
           </div>
         </div>
       </div>
       <div class="col-md-3 col-12">
         <select class="form-control form-control-select" id="id_poli" name="id_poli">
           <option value="all">Pilih Poli</option>
           <?php foreach ($list_poli as $poli) { ?>
             <option value=<?php echo $poli->id ?> <?php if ($this->uri->segment(4) == $poli->id) {
                                                      echo 'selected';
                                                    } ?>><?php echo $poli->poli ?></option>
           <?php } ?>
         </select>
       </div>
     </div>

     <div class="row mx-auto">
       <?php foreach ($list_dokter as $dokter) { ?>
         <?php
          $pengalaman = $dokter->pengalaman_kerja ? (new DateTime($dokter->pengalaman_kerja)) : false;
          $sekarang = (new DateTime('now'));
          $diff = $pengalaman ? $pengalaman->diff($sekarang)->y : '-';
          ?>
         <div class="card-profile ml-3 my-2">
           <div class="d-inline-flex">
             <div class="doctor-img px-3 my-4">
               <a class="avatar"><img alt="" src="<?php echo $dokter->foto ? base_url('assets/images/users/' . $dokter->foto) : base_url('assets/telemedicine/img/default.png'); ?>"></a>
             </div>
             <div class="p-2 ml-3 mt-3" style="width: 200px">
               <span class="font-16"><?php echo ucwords($dokter->name) ?></span>
               <div class="text-abu font-12">
                 <span>STR : <?php echo $dokter->str ?></span><br>
                 <span><?php echo $dokter->poli ? $dokter->poli : '-'; ?> </span><br>
                 <span>Pengalaman <?php echo $diff ?> Tahun</span>
               </div>
             </div>
             <!-- <div class="my-auto text-abu">
              <i class="fas fa-ellipsis-h"></i>
            </div> -->
           </div>

         </div>
       <?php } ?>
     </div>
     <div class="row">
       <div class="col-sm-12">
         <div>
           <nav aria-label="Page navigation example">
             <ul class="pagination justify-content-center">
               <?php echo $pagination ?>
             </ul>
           </nav>
         </div>
       </div>
     </div>
   </div>
 </div>