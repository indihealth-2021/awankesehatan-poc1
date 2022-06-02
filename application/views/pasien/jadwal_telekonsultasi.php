 <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Telekonsultasi/jadwal') ?>"class="text-black font-bold-7">Jadwal Telekonsultasi</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Jadwal Telekonsultasi</h3>
          </div>
      </div>  
        <!--<?php //if(count($list_jadwal_konsultasi) > 0){ ?>
        <table cellspacing="5" cellpadding="5" border="0">
        <tbody>
        <tr>
            <td>
                <a href="<?php //echo base_url('pasien/Assesment') ?>" class="btn btn-sm btn-primary">Isi Assesment</a>
            </td>
        </tr>
    </tbody></table>
    <?php //} ?>-->        
        <div class="row">
          <div class="col-md-12">
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
                </div>
                <div class="table-responsive font-14">
                <table class="table table-border table-hover custom-table mb-0" id="table_jadwal_telekonsultasi">
                    <thead class="text-tr">
                    <tr>
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Poli</th>
                        <th>Tanggal Konsultasi</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <!-- <th class="text-center">Aksi</th> -->
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($list_jadwal_konsultasi) > 0){
                                foreach($list_jadwal_konsultasi as $idx => $jadwal_konsultasi){
                                    $foto = $jadwal_konsultasi->foto_dokter ? base_url('assets/images/users/'.$jadwal_konsultasi->foto_dokter):base_url('assets/dashboard/img/user.jpg');
                                    echo "<tr>";
                                    echo "<td>".($idx+1)."</td>";
                                    echo "<td><img width='28' height='28' src=" . $foto . " class='rounded-circle m-r-5' alt=''><div class='ml-5' style='margin-top:-25px;'><span title='".$jadwal_konsultasi->nama_dokter."'>".ucwords(substr($jadwal_konsultasi->nama_dokter, 0, 10)) . "</span><div></td>";
                                    echo "<td>".$jadwal_konsultasi->poli."</td>";
                                    $tanggal = new DateTime($jadwal_konsultasi->tanggal);
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
                                    echo "<td>".$tanggal."</td>";
                                    echo "<td>".$hari."</td>";
                                    echo "<td>".$jadwal_konsultasi->jam." (Max. 30 Menit)</td>";
                                    // echo "<td style='text-align:center;'><a target='_blank' href='".base_url('pasien/Chat/index/'.$jadwal_konsultasi->id_dokter)."' class='btn btn-success'><i class='far fa-comment-dots'></i> Chat</a></td>";
                                    echo "</tr>";
                                }
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