<section class="content">
<div class="container-fluid">
<div class="card">
    <div class="card-header" style="background: #1F60A8; color: #fff">
        <h3 class="card-title">Jadwal Terdaftar</h3>
    </div>  
    <div class="card-body">
        <table cellspacing="5" cellpadding="5" border="0">
        <tbody><tr>
            <td>Poli:</td>
            <td>
                <form method="GET" action="<?php echo base_url('pasien/JadwalTerdaftar') ?>">
                <select class="form-control form-control-sm" id="poli" name="poli" onchange="poli_onchange();">
                    <option value="" <?php $s = $this->input->get('poli') ? 'selected' : ''; echo $s; ?>>Semua</option>
                <?php
                    foreach($data_poli as $poli){
                        $s = $this->input->get('poli') == $poli->poli ? 'selected' : '';
                        echo "<option value='".$poli->poli."'".$s.">".$poli->poli."</option>";
                    }
                ?>
                </select>
            </td>
            <td>
                <a href="<?php echo base_url('pasien/Pendaftaran?poli=&hari=all') ?>" class="btn btn-sm btn-primary">Pendaftaran</a>
            </td>
           
        </tr>
    </tbody></table>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-dark-blue-menu">
    <tr>
        <th class="text-white text-center">No</th>
        <th class="text-white text-center">Nama Dokter</th>
        <th class="text-white text-center">Poli</th>
        <th class="text-white text-center">Nominal</th>
        <th class="text-white text-center">Hari</th>
        <th class="text-white text-center">Waktu</th>
        <th class="text-white text-center">Tanggal</th>
        <th class="text-white text-center">Aksi</th>
    </tr>
    </thead>
    <tbody>
        <?php
            if(count($list_jadwal_terdaftar) > 0){
                foreach($list_jadwal_terdaftar as $idx => $jadwal_terdaftar){
                    if($jadwal_terdaftar['id_status_pembayaran'] == 2){
                        $button = "<td class='text-center'><a class='btn btn-primary btn-block' href='".base_url('pasien/Pembayaran/?regid='.$jadwal_terdaftar['id'])."'>Sedang Diproses</a> <a class='btn btn-danger btn-block' onclick='return confirm(\"Anda yakin akan membatalkan pendaftaran ini?\")' href='".base_url('pasien/JadwalTerdaftar/cancel/'.$jadwal_terdaftar['id'])."'><i class='fas fa-window-close'></i> Batalkan</a></td>";
                    }
                    else if($jadwal_terdaftar['id_status_pembayaran'] == 1){
                        $button = "<td class='text-center'><a class='btn btn-success btn-block' href='".base_url('pasien/Pembayaran/?regid='.$jadwal_terdaftar['id'])."'><i class='fas fa-check-circle'></i> Lunas</a></td>";
                    }
                    else{
                        $button = "<td class='text-center'><a class='btn btn-warning btn-block' href='".base_url('pasien/Pembayaran/?regid='.$jadwal_terdaftar['id'])."'>Bayar</a> <a class='btn btn-danger btn-block' onclick='return confirm(\"Anda yakin akan membatalkan pendaftaran ini?\")' href='".base_url('pasien/JadwalTerdaftar/cancel/'.$jadwal_terdaftar['id'])."'>Batalkan</a></td>";                        
                    }
                    echo "<tr>";
                    echo "<td>".($idx+1)."</td>";
                    echo "<td>".ucwords($jadwal_terdaftar['nama_dokter'])."</td>";
                    echo "<td>".$jadwal_terdaftar["poli"]."</td>";
                    echo "<td>".'Rp '.number_format($jadwal_terdaftar['harga'],2,',','.')."</td>";
                    echo "<td>".ucwords($jadwal_terdaftar['hari'])."</td>";
                    echo "<td>".$jadwal_terdaftar['waktu']."</td>";
                    $jadwal_terdaftar['tanggal'] = $jadwal_terdaftar['tanggal'] ? $jadwal_terdaftar['tanggal'] : 'Jadwal Rutin';
                    echo "<td>".$jadwal_terdaftar['tanggal']."</td>";
                    echo $button;
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
    <tfoot class="bg-dark-blue-menu">
    <tr>
        <th class="text-white text-center">No</th>
        <th class="text-white text-center">Nama Dokter</th>
        <th class="text-white text-center">Poli</th>
        <th class="text-white text-center">Nominal</th>
        <th class="text-white text-center">Hari</th>
        <th class="text-white text-center">Waktu</th>
        <th class="text-white text-center">Tanggal</th>
        <th class="text-white text-center">Aksi</th>
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

<?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>
<?php if($this->session->flashdata('msg_pmbyrn')){ echo "<script>alert('".$this->session->flashdata('msg_pmbyrn')."')</script>"; } ?>

<script>

function poli_onchange(){
    location.href = "<?php echo base_url() ?>pasien/JadwalTerdaftar?poli="+document.getElementById('poli').value;
}
</script>