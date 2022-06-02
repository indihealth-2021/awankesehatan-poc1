 <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href=""class="text-black font-bold-7">Jadwal Telekonsultasi</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Jadwal Telekonsultasi</h3>
          </div>
      </div>     
        <div class="row">
          <div class="col-md-12">
            <div class="bg-tab p-3">
                <div class="row p-4">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <div class="box">
                            <div class="container-1 ">
                                <span class="icon"><i class="fa fa-search font-16"></i></span>
                                <input type="search" id="search" placeholder="Cari Pasien Disini" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive font-14">
                <table class="table table-border table-hover custom-table mb-0" id="table_jadwal_telekonsultasi">
                    <thead class="text-tr">
                    <tr class="text-center">
                        <th class="text-left">No</th>
                        <th>Nama Pasien</th>
                        <th>Hari</th>
                        <th>Waktu</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php                                         
                                            foreach($list_jadwal_konsultasi as $idx => $konsultasi){
                                                $foto = $konsultasi->foto_pasien ? base_url('assets/images/users/'.$konsultasi->foto_pasien):base_url('assets/dashboard/img/user.jpg');
                                                echo "<tr class='odd gradeX'>";
                                                echo "<td>".($idx+1)."</td>";
                                                echo "<td class='text-left'><img width='28' height='28' src=" . $foto . " class='rounded-circle m-r-5' alt=''>".ucwords($konsultasi->nama_pasien)."</td>";
                                                $tanggal = new DateTime($konsultasi->tanggal);
                                                $hari = $tanggal->format('D');
                                                switch($hari){
                                                  case 'Mon':
                                                    $hari = 'Senin';
                                                    break;
                                                  case 'Tue':
                                                    $hari = 'Selasa';
                                                    break;
                                                  case 'Wed':
                                                    $hari = 'Rabu';
                                                    break;
                                                  case 'Thu':
                                                    $hari = 'Kamis';
                                                    break;
                                                  case 'Fri':
                                                    $hari = "Jum'at";
                                                    break;
                                                  case 'Sat':
                                                    $hari = 'Sabtu';
                                                    break;
                                                  case 'Sun':
                                                    $hari = 'Minggu';
                                                    break;
                                                  default:
                                                    $hari = '';
                                                    break;
                                                }
                                                $tanggal = $tanggal->format('d-m-Y');
                                                echo "<td>".$hari."</td>";
                                                echo "<td>".$konsultasi->jam." (Max. 30 Menit)</td>";
                                                echo "<td>".$tanggal."</td>";
                                                echo "<td style='text-align:center;'><a href='".base_url('dokter/Teleconsultasi/proses_teleconsultasi/?id_jadwal_konsultasi='.$konsultasi->id.'&id_pasien='.$konsultasi->id_pasien)."' class='btn btn-mulai'>Mulai</a>
                                      <a href='".base_url('dokter/HistoryMedisPasien/index/'.$konsultasi->id_pasien)."' class='btn btn-medrec' target='_blank'>Medrec</a>
                                                    </td>";
                                                echo "</tr>";
                                                                    }
                                              ?>
                     </tbody>
                </table>
            </div>
            </div>
                
        </div>
    
    </div>               

    </div>
    </div>

    <?php if($this->session->flashdata('msg_assesment')){ echo "<script>alert('".$this->session->flashdata('msg_assesment')."')</script>"; } ?>