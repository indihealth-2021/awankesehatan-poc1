<section class="content">
<div class="container-fluid">
<div class="card">
    <div class="card-header" style="background: #1F60A8; color: #fff">
        <h3 class="card-title">Antrian</h3>
    </div>  
    <div class="card-body">
                <table cellspacing="5" cellpadding="5" border="0">
        <tbody><tr>
            <td>Dokter:</td>
            <td>
                <form method="GET" action="<?php echo base_url('pasien/Antrian/') ?>">
                <select class="form-control form-control-sm" id="id_dokter" name="id_dokter">
                    <option value="" <?php $s = $this->input->get('id_dokter') ? 'selected' : ''; echo $s; ?>>Semua</option>
                <?php
                    foreach($list_dokter_diantri as $dokter){
                        $s = $this->input->get('id_dokter') == $dokter->id ? 'selected' : '';
                        echo "<option value='".$dokter->id."'".$s.">".ucwords($dokter->name)."</option>";
                    }
                ?>
                </select>
            </td>
            <td>
                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
            </td>
            <td>
                <a href="<?php echo base_url('pasien/Telekonsultasi/jadwal') ?>" class="btn btn-sm btn-primary">Cek Jadwal Konsultasi</a>
            </td>
        </tr>
    </tbody></table>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-dark-blue-menu">
    <tr>
        <th class="text-white">No</th>
        <th class="text-white">Nama Dokter</th>
        <th class="text-white">Poli</th>
        <th class="text-white">No Antrian</th>
        <th class="text-white">Status</th>
        <!-- <th class="text-white">Hari</th>
        <th class="text-white">Waktu</th> -->
    </tr>
    </thead>
    <tbody>
        <?php
            if(count($list_antrian) > 0){
                foreach($list_antrian as $idx => $antrian){
                    if($antrian->id_pasien == $this->session->userdata('id_user')){
                        $no_antrian = '<b style="color: red;">'.$antrian->antrian.' ( Anda )</b>';
                    }
                    else{
                        $no_antrian = $antrian->antrian;
                    }

            if(!$antrian->status){
            $antrian->status = 'Antri';
            }
            else{
            $antrian->status = 'Sedang Konsultasi';
            }

                    echo "<tr>";
                    echo "<td>".($idx+1)."</td>";
                    echo "<td>".ucwords($antrian->nama_dokter)."</td>";
                    echo "<td>".$antrian->poli."</td>";
                    echo "<td>".$no_antrian."</td>";
                    echo "<td>".$antrian->status."</td>";
                    echo "</tr>";
                }
            }
            else{
                echo "<tr><td>No Data</td></tr>";
            }
        ?>
    </tbody>
    <tfoot class="bg-dark-blue-menu">
    <tr>
        <th class="text-white">No</th>
        <th class="text-white">Nama Dokter</th>
        <th class="text-white">Poli</th>
        <th class="text-white">No Antrian</th>
        <th class="text-white">Status</th>
        <!-- <th class="text-white">Hari</th>
        <th class="text-white">Waktu</th> -->
    </tr>
    </tfoot>
    </table>
    <div class="col-lg-12">
              <a href="<?php echo base_url('pasien/Pasien') ?>" class="btn bg-dark-blue-menu btn-md pull-right text-white" style="float: right; margin-top: 20px; width: 140px">Kembali</a>
            </div> 
</div>
                
            </div>
</div>
</section>