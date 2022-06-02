 <!-- Main content -->
 <div class="page-wrapper">
     <div class="content">
         <div class="row mb-3">
             <div class="col-sm-12 col-12 ">
                 <nav aria-label="">
                     <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
                         <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Antrian') ?>" class="text-black font-bold-7">Nomor Antrian</a></li>
                     </ol>
                 </nav>
             </div>
             <div class="col-sm-12 col-12">
                 <h3 class="page-title">Nomor Antrian</h3>
             </div>
         </div>
         <div class="bg-tab p-3">
             <div class="row">
                 <div class="col-md-3">
                     <div class="box">
                         <div class="container-1 ">
                             <span class="icon"><i class="fa fa-search font-16"></i></span>
                             <input type="search" id="search" placeholder="Cari Dokter Disini" />
                         </div>
                     </div>
                 </div>
                 <!-- <div class="col-md-3">
                <form method="GET" action="<?php echo base_url('pasien/Antrian/') ?>">
                <select class="form-control form-control-select" id="id_jadwal" name="id_jadwal">
                    <option value="" <?php $s = $this->input->get('id_jadwal') ? 'selected' : '';
                                        echo $s; ?>>Semua</option>
                <?php
                foreach ($list_dokter_diantri as $dokter) {
                    $s = $this->input->get('id_jadwal') == $dokter->id_jadwal ? 'selected' : '';
                    $waktu_praktek = $dokter->tanggal ? (new DateTime($dokter->tanggal))->format('d-m-Y') : $dokter->hari;
                    echo "<option value='" . $dokter->id_jadwal . "'" . $s . ">" . ucwords($dokter->name) . " ( " . $waktu_praktek . " )" . "</option>";
                }
                ?>
                </select>
                
            </div>
            <div>
                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
            </div> -->
                 <div class="col-md-8 ml-5 text-right">
                     <a href="<?php echo base_url('pasien/Telekonsultasi/jadwal') ?>" class="btn btn-pendaftaran">Cek Jadwal Konsultasi</a>
                 </div>

             </div>

             <div class="table-responsive">
                 <table class="table table-border table-hover custom-table mb-0" id="table_antrian">
                     <thead class="text-tr">
                         <tr class="font-16">
                             <th class="text-left">No</th>
                             <th>Nama Dokter</th>
                             <th>Tanggal / Hari Praktek</th>
                             <th>Poli</th>
                             <th>No Antrian</th>
                             <th>Status</th>
                             <!-- <th class="text-white">Hari</th>
        <th class="text-white">Waktu</th> -->
                         </tr>
                     </thead>
                     <tbody class="font-14">
                         <?php
                            if (count($list_antrian) > 0) {
                                foreach ($list_antrian as $idx => $antrian) {
                                    $foto = $antrian->foto_dokter ? base_url('assets/images/users/' . $antrian->foto_dokter) : base_url('assets/dashboard/img/user.jpg');
                                    if ($antrian->id_pasien == $this->session->userdata('id_user')) {
                                        $no_antrian = '<b style="color: red;">' . $antrian->antrian . ' ( Anda )</b>';
                                    } else {
                                        $no_antrian = $antrian->antrian;
                                    }

                                    if (!$antrian->status) {
                                        $antrian->status = 'Antri';
                                    } else {
                                        $antrian->status = 'Sedang Konsultasi';
                                    }

                                    echo "<tr>";
                                    echo "<td>" . ($idx + 1) . "</td>";
                                    echo "<td><img width='28' height='28' src=" . $foto . " class='rounded-circle m-r-5' alt=''>" . ucwords($antrian->nama_dokter) . "</td>";
                                    if ($antrian->tanggal) {
                                        $tanggal = new DateTime($antrian->tanggal);
                                        $day_eng = $tanggal->format('D');
                                        if ($day_eng == 'Mon') {
                                            $day_ind = 'Senin';
                                        } else if ($day_eng == 'Tue') {
                                            $day_ind = 'Selasa';
                                        } else if ($day_eng == 'Wed') {
                                            $day_ind = 'Rabu';
                                        } else if ($day_eng == 'Thu') {
                                            $day_ind = 'Kamis';
                                        } else if ($day_eng == 'Fri') {
                                            $day_ind = 'Jum\'at';
                                        } else if ($day_eng == 'Sat') {
                                            $day_ind = 'Sabtu';
                                        } else if ($day_eng == 'Sun') {
                                            $day_ind = 'Minggu';
                                        } else {
                                            $day_ind = 'Unkown';
                                        }

                                        $tanggal = $tanggal->format('d-m-Y');
                                        echo "<td>" . $day_ind .', '.$tanggal . " ( <span title='Khusus'>K</span> )</td>";
                                    } else {
                                        echo "<td>" . $antrian->hari . ", " . (new DateTime($antrian->tanggal_konsultasi))->format('d-m-Y') . " ( <span title='Rutin'>R</span> )</td>";
                                    }
                                    echo "<td>" . $antrian->poli . "</td>";
                                    echo "<td class='text-center'>" . $no_antrian . "</td>";
                                    echo "<td class='text-center'>" . $antrian->status . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td align='center' colspan='5'>Kamu tidak bisa melihat antrian, karena belum memiliki jadwal konsultasi</td></tr>";
                            }
                            ?>
                     </tbody>
                 </table>
             </div>

         </div>
     </div>

 </div>
 </div>