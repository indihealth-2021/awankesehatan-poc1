 <!-- Main content -->
 <div class="page-wrapper">
   <div class="content">
     <div class="row mb-3">
       <div class="col-sm-12 col-12 ">
         <nav aria-label="">
           <ol class="breadcrumb" style="background-color: transparent;">
             <li class="breadcrumb-item active"><a href="<?php echo base_url('farmasi/FarmasiVerifikasiObat/#'); ?>" class="text-black">Dashboard</a></li>
             <li class="breadcrumb-item active"><a href="" class="text-black font-bold-7">Dashboard</a></li>
         </nav>

         <span class="btn btn-info p-1 m-3"><span class="p-2">📌 <?= "#".$apotek->id." - ".$apotek->nama." , ".$apotek->alamat_jalan ?></span></span>
       </div>
       <div class="col-sm-12 col-12">
         <h3 class="page-title">Verifikasi Obat</h3>
       </div>
     </div>
     <div class="row mb-3">
       <div class="box">
         <div class="container-1">
           <span class="icon" id="searchButton">
             <!-- <i class="fa fa-search font-16"></i> -->
             <i><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                 <g clip-path="url(#clip0)">
                   <path d="M10.2741 9.05122C11.1214 7.89508 11.5009 6.46165 11.3367 5.03773C11.1724 3.61381 10.4766 2.3044 9.38844 1.37146C8.30025 0.438531 6.89993 -0.0491216 5.46763 0.00606739C4.03533 0.0612564 2.67669 0.655217 1.66351 1.66912C0.650333 2.68302 0.0573448 4.04209 0.00318071 5.47443C-0.0509834 6.90677 0.437671 8.30674 1.37138 9.39426C2.30509 10.4818 3.615 11.1767 5.03904 11.3399C6.46308 11.5031 7.89623 11.1226 9.05177 10.2745H9.0509C9.07715 10.3095 9.10515 10.3427 9.13665 10.3751L12.5054 13.7438C12.6695 13.908 12.892 14.0003 13.1242 14.0004C13.3563 14.0005 13.5789 13.9084 13.7431 13.7443C13.9073 13.5802 13.9996 13.3576 13.9996 13.1255C13.9997 12.8934 13.9076 12.6708 13.7435 12.5066L10.3748 9.13785C10.3435 9.10618 10.3099 9.07693 10.2741 9.05035V9.05122ZM10.4999 5.68773C10.4999 6.31971 10.3754 6.94551 10.1336 7.52939C9.89172 8.11327 9.53723 8.6438 9.09035 9.09068C8.64347 9.53756 8.11294 9.89205 7.52906 10.1339C6.94519 10.3757 6.31939 10.5002 5.6874 10.5002C5.05541 10.5002 4.42962 10.3757 3.84574 10.1339C3.26186 9.89205 2.73133 9.53756 2.28445 9.09068C1.83757 8.6438 1.48308 8.11327 1.24123 7.52939C0.99938 6.94551 0.874901 6.31971 0.874901 5.68773C0.874901 4.41137 1.38193 3.18729 2.28445 2.28477C3.18697 1.38226 4.41105 0.875225 5.6874 0.875225C6.96376 0.875225 8.18783 1.38226 9.09035 2.28477C9.99287 3.18729 10.4999 4.41137 10.4999 5.68773Z" fill="#59A799" />
                 </g>
                 <defs>
                   <clipPath id="clip0">
                     <rect width="14" height="14" fill="white" />
                   </clipPath>
                 </defs>
               </svg></i>
           </span>
           <form method="GET" id="searchForm" action="<?php echo base_url('admin/FarmasiVerifikasiObat/index') ?>">
             <input type="search" name="nama_pasien" id="search" value="<?php echo isset($_GET['nama_pasien']) ? $_GET['nama_pasien'] : ''; ?>" placeholder="Cari Pasien Disini" />
           </form>
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-md-12 bg-tab px-3">
         <div class="col-md-12">
           <div class="table-responsive pt-0">
             <table class="table table-border table-hover custom-table mb-0" id="table_farmasi">
               <thead class="text-tr">

               </thead>
               <tbody class="font-14">
                <?php if(count($list_resep) > 0)  { ?>
                  <?php foreach ($list_resep as $idx => $resep) {
                    $page++ ?>
                   <tr class="font-12" style="border-top: 3px solid #21AAC4;">
                     <td colspan="1"></td>
                     <td colspan="5">

                       <span>Tanggal Konsultasi</span><br>
                       <?php $tanggal = new DateTime($resep->tanggal_konsultasi);
                        echo $tanggal->format('d-m-Y H:i:s'); ?>
                     </td>
                     <td>
                      <span>Card Number</span><br>
                      <?= $resep->card_number; ?>
                     </td>
                   </tr>

                   <tr class="text-top">
                     <td><?php echo $page; ?></td>
                     <td class="text-top">
                       <span class="font-tr-table">Pasien</span><br>
                       <?php echo $resep->nama_pasien; ?>
                     </td>
                     <td class="text-top">
                       <span class="font-tr-table">Dokter</span><br>
                       <span><?php echo $resep->nama_dokter; ?></span><br>
                       <span class="font-12"><?php echo $resep->nama_poli; ?></span>
                     </td>
                     <td class="text-top" width="15%">
                       <span class="font-tr-table">Diagnosa</span><br>
                       <?php echo $resep->diagnosis; ?>
                     <td class="text-top" width="15%">
                       <span class="font-tr-table">Resep</span><br>
                       <?php
                          $resep->obat = array_unique(explode("|", $resep->detail_obat));
                          foreach($resep->obat as $obat) {
                            if($obat != "") {
                            echo "<li>".$obat."</li>";
                            }
                          }
                       ?>

                     </td>
                     <td class="text-top">
                       <span class="font-tr-table">Total Harga</span><br>
                        <?= 'Rp. ' . number_format($harga_obat[$resep->id_jadwal_konsultasi], 2, ',', '.'); ?>
                     </td>
                     <td width="10%" class="text-top">
                       <span class="font-tr-table">Pemeriksa</span><br>
                       <?php echo $resep->nama_dokter; ?>
                     </td>
                     <td class="text-center" width="20%">
                       <span class="font-tr-table">Aksi</span><br>
                       <a href="<?php echo base_url('admin/FarmasiVerifikasiObat/verifikasi/' . $resep->id_jadwal_konsultasi); ?>" onclick="return confirm('Apakah anda yakin untuk verifikasi resep ini?');" class="mb-3 btn btn-tele-verif mt-2">Verifikasi</a>
                       <a class="btn btn-tele-one" href="<?php echo base_url('admin/FarmasiVerifikasiObat/form_edit_resep/' . $resep->id_jadwal_konsultasi); ?>"><i class="fa fa-pencil"></i> Obat</a>
                       <a class="btn btn-tele-one" href="<?php echo base_url('admin/FarmasiVerifikasiObat/edit_harga/' . $resep->id_jadwal_konsultasi); ?>"><i class="fa fa-pencil"></i> Harga</a>
                     </td>
                   </tr>
                 <?php } ?>
                  <?php }else { ?>
                    <tr>
                      <td class="d-flex justify-content-center align-items-center">Tidak ada data</td>
                    </tr>
                    <?php }?>

               </tbody>
             </table>
           </div>
           <div class="row pt-3">
             <div class="col-sm-12">
               <div>
                 <!-- <nav aria-label="Page navigation example">
                   <ul class="pagination justify-content-center">
                     <?php echo $pagination ?>
                   </ul>
                 </nav> -->
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 </div>

 <?php if ($this->session->flashdata('msg_simpan_resep')) {
    echo "<script>alert('" . $this->session->flashdata('msg_simpan_resep') . "')</script>";
  } ?>
 <?php if ($this->session->flashdata('msg_verif_resep')) {
    echo "<script>alert('" . $this->session->flashdata('msg_verif_resep') . "')</script>";
  } ?>
