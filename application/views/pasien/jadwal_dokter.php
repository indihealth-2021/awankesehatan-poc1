 <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Dokter/jadwal') ?>"class="text-black font-bold-7">Jadwal Dokter</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Jadwal Dokter</h3>
          </div>
      </div>  

    <div class="bg-tab p-3">
        <table cellspacing="5" cellpadding="5" border="0">
        <tbody><tr>
            <td>
                <div class="box">
                            <div class="container-1 ">
                                <span class="icon"><i class="fa fa-search font-16"></i></span>
                                <input type="search" id="search" placeholder="Cari Dokter Disini" />
                            </div>
                        </div>
            </td>
            <td>
                <form method="GET" action="<?php echo base_url('pasien/Dokter/jadwal') ?>">
                <select class="form-control form-control-sm col-sm-12" id="poli" name="poli">
                    <option value="" <?php $s = $this->input->get('poli') ? 'selected' : ''; echo $s; ?>>Semua Poli</option>
                <?php
                    foreach($data_poli as $poli){
                        $s = $this->input->get('poli') == $poli->poli ? 'selected' : '';
                        echo "<option value='".$poli->poli."'".$s.">".$poli->poli."</option>";
                    }
                ?>
                </select>
            </td>
            <td>
                <button class="btn btn-sm btn-cari" type="submit">Cari</button>
            </td>
            
        </tr>
    </tbody></table>

                
<div class="table-responsive font-14">
              <table class="table table-border table-hover custom-table mb-0" id="table_jadwal_dokter">
                <thead class="text-tr">
                <tr class="text-center">
                    <th class="text-left">No</th>
                    <th>Nama Dokter</th>
                    <th>Poli</th>
                    <th>Hari</th>
                    <th>Waktu</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
    <tbody>
        <?php
            if(count($list_jadwal_dokter) > 0){
                foreach($list_jadwal_dokter as $idx => $jadwal_dokter){
                    $foto = $jadwal_dokter->foto_dokter ? base_url('assets/images/users/'.$jadwal_dokter->foto_dokter):base_url('assets/dashboard/img/user.jpg');
                    echo "<tr class='text-center'>";
                    echo "<td class='text-left'>".($idx+1)."</td>";
                    echo "<td class='text-left'><img width='28' height='28' src=" . $foto . " class='rounded-circle m-r-5' alt=''><div class='ml-5' style='margin-top:-25px;'><span title='".$jadwal_dokter->nama_dokter."'>" .ucwords(substr($jadwal_dokter->nama_dokter, 0, 15))."</span><div></td>";
                    echo "<td class='text-left'>".$jadwal_dokter->poli."</td>";
                    echo "<td>".ucwords($jadwal_dokter->hari)."</td>";
                    echo "<td>".$jadwal_dokter->waktu."</td>";
                    $jadwal_dokter->tanggal = $jadwal_dokter->tanggal ? $jadwal_dokter->tanggal : 'Jadwal Rutin';
                    $tanggal = $jadwal_dokter->tanggal != 'Jadwal Rutin' ? new DateTime($jadwal_dokter->tanggal) : 'Jadwal Rutin';
                    $tanggal = $tanggal != 'Jadwal Rutin' ? $tanggal->format('d-m-Y') : 'Jadwal Rutin';
                    echo "<td>".$tanggal."</td>";
                    echo "</tr>";
                }
            }
            else{
                echo "";
            }
        ?>
    </tbody>
    </table>
</div>        
    </div>
</div>
</div>

<?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>