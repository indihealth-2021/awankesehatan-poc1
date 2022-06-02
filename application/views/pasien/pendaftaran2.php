<section class="content">
<div class="container-fluid">
<div class="card">
    <div class="card-header" style="background: #1F60A8; color: #fff">
        <h3 class="card-title">Pendaftaran</h3>
    </div>  
    <div class="card-body">
        <table cellspacing="5" cellpadding="5" border="0">
        <tbody>
        <form method="GET" action="<?php echo base_url('pasien/Pendaftaran') ?>">
        <tr>
            <td>Poli:</td>
            <td>
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
                Hari:</td>
            </td>
            <td>
                <select class="form-control form-control-sm" style="width: 100%;" name="hari" id="hari" onchange="hari_onchange();">
                <?php $hari = $this->input->get('hari') ?>
                <option value="all" <?php echo $hari == 'all' ? 'selected' : '' ?>>Semua Hari</option>
                <option value="Senin" <?php echo $hari == 'Senin' ? 'selected' : '' ?>>Senin</option>
                <option value="Selasa" <?php echo $hari == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                <option value="Rabu" <?php echo $hari == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                <option value="Kamis" <?php echo $hari == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                <option value="Jum'at" <?php echo $hari == "Jum'at" ? 'selected' : '' ?>>Jum'at</option>
                </select>
            </td>
            <!--<td>
                <a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>" class="btn btn-sm btn-primary">Cek Jadwal Terdaftar</a>
            </td>-->
           </form>
        </tr>
    </tbody></table>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-dark-blue-menu">
    <tr>
        <th class="text-white">No</th>
        <th class="text-white">Nama Dokter</th>
        <th class="text-white">Poli</th>
        <th class="text-white">Nominal</th>
        <th class="text-white">Hari</th>
        <th class="text-white">Waktu</th>
        <th class="text-white">Tanggal</th>
        <th class="text-white">Aksi</th>
    </tr>
    </thead>
    <tbody>
        <?php
            if(count($list_jadwal_dokter) > 0){
                foreach($list_jadwal_dokter as $idx => $jadwal_dokter){
                    // $button = "<td class='text-center'><a data-toggle='modal' data-target='#exampleModal' class='btn btn-primary btn-block' onclick='return confirm(\"Apakah anda yakin ingin mendaftar jadwal ini?\");' href='".base_url('pasien/Pendaftaran/daftar?id_jadwal='.$jadwal_dokter['id'])."'>Pilih</a></td>";
                    $button = "<td class='text-center'><a class='btn btn-primary btn-block' onclick='return confirm(\"Apakah anda yakin ingin mendaftar jadwal ini?\");' href='".base_url('pasien/Pendaftaran/daftar?id_jadwal='.$jadwal_dokter['id'])."'>Pilih</a></td>";
                    $nominal = $this->db->query('SELECT harga FROM nominal WHERE poli = "'.$jadwal_dokter["poli"].'"')->row();
                    echo "<tr>";
                    echo "<td>".($idx+1)."</td>";
                    echo "<td>".ucwords($jadwal_dokter['nama_dokter'])."</td>";
                    echo "<td>".$jadwal_dokter["poli"]."</td>";
                    echo "<td>".'Rp '.number_format($nominal->harga,2,',','.')."</td>";
                    echo "<td>".ucwords($jadwal_dokter['hari'])."</td>";
                    echo "<td>".$jadwal_dokter['waktu']."</td>";
                    $jadwal_dokter['tanggal'] = $jadwal_dokter['tanggal'] ? $jadwal_dokter['tanggal'] : 'Jadwal Rutin';
                    echo "<td>".$jadwal_dokter['tanggal']."</td>";
                    echo $button;
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
    <tfoot class="bg-dark-blue-menu">
    <tr>
        <th class="text-white">No</th>
        <th class="text-white">Nama Dokter</th>
        <th class="text-white">Poli</th>
        <th class="text-white">Nominal</th>
        <th class="text-white">Hari</th>
        <th class="text-white">Waktu</th>
        <th class="text-white">Tanggal</th>
        <th class="text-white">Aksi</th>
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
    location.href = "<?php echo base_url() ?>pasien/Pendaftaran?poli="+document.getElementById('poli').value+"&hari="+document.getElementById('hari').value;
}

function hari_onchange(){
    location.href = "<?php echo base_url() ?>pasien/Pendaftaran?poli="+document.getElementById('poli').value+"&hari="+document.getElementById('hari').value;
}
</script>



<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1F60A8; color: #fff">
        <h4 class="modal-title" align="center" id="exampleModalLabel" >Pendaftaran</h4>
        <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row">
        <label for="" class="col-4 col-form-label">Tanggal Konsultasi</label>
        <div class="col-8">
          <input required="" type="date" class="form-control" name="tanggal" id="tanggal" onchange="setDay()" value="<?php ;?>">
        </div>
      </div>  
      <div class="form-group row">
        <label for="" class="col-4 col-form-label">Metode Pembayaran</label>
        <div class="col-8">
          	<select class="custom-select">
			  <option selected>Metode Pembayaran</option>
			  <option value="asuransi">Asuransi</option>
			  <option value="bpjs">BPJS</option>
			</select>
        </div>
      </div>
      <!-- <div class="form-group row">
      	<label for="" class="col-4 col-form-label">Nomor Kartu</label>
        <div class="col-8">
          	<input required="" type="number" class="form-control" name="nomor" id="nomor" value="<?php ;?>" placeholder="nomor kartu">
        </div>
      </div>
      <div class="form-group row">
      	<label for="" class="col-4 col-form-label">Nomor SEP</label>
        <div class="col-8">
          	<input required="" type="number" class="form-control" name="nomor" id="nomor" value="<?php ;?>" placeholder="nomor sep">
        </div>
      </div> -->
      <div class="modal-dialog modal-dialog-scrollable" style="height: 250px">
      <div class="modal-content">
      	<div class="modal-header">
      		<div class="modal-title">Persetujuan SOP Telekonsultasi</div>
      	</div>
      	<div class="modal-body">
      		<p>
      		<h5 align="center"><b>BAB I</b></h5>
<h5 align="center"><b>DASAR HUKUM</b></h5>
<h6><p>
Dasar Hukum :<br>
a. Peraturan Menteri Kesehatan Republik Indonesia No. 20 Tahun 2019 
tentang Penyelenggaraan Pelayanan Telemedicine antar Fasilitas Pelayanan Kesehatan
</p></h6>
<h5 align="center"><b>BAB II</b></h5>
<h5 align="center"><b>PELAYANAN</b></h5>
<b>Bagian Kesatu
Jenis Pelayanan<br>
Pasal 2</b><br>
Pelayanan Telemedicine dilaksanakan oleh tenaga kesehatan
yang memiliki surat izin praktik di Fasyankes penyelenggara.
Pasal 3<br>
(1) Pelayanan Telemedicine sebagaimana dimaksud dalam
Pasal 2 terdiri atas pelayanan:<br>
a. teleradiologi;<br>
b. teleelektrokardiografi;<br>
c. teleultrasonografi;<br>
d. telekonsultasi klinis; dan<br>
e. pelayanan konsultasi Telemedicine lain sesuai
dengan perkembangan ilmu pengetahuan dan
teknologi.<br>
(2) Teleradiologi sebagaimana dimaksud pada ayat (1)
huruf a merupakan pelayanan radiologi diagnostik 
dengan menggunakan transmisi elektronik image dari
semua modalitas radiologi beserta data pendukung dari
Fasyankes Peminta Konsultasi ke Fasyankes Pemberi
Konsultasi, untuk mendapatkan Expertise dalam hal
penegakan diagnosis.<br>
(3) Teleelektrokardiografi sebagaimana dimaksud pada
ayat (1) huruf b merupakan pelayanan elektrokardiografi
dengan menggunakan transmisi elektronik gambar dari
semua modalitas elektrokardiografi beserta data
pendukung dari Fasyankes Peminta Konsultasi ke
Fasyankes Pemberi Konsultasi, untuk mendapatkan
Expertise dalam hal penegakan diagnosis.<br>
(4) Teleultrasonografi sebagaimana dimaksud pada ayat (1)
huruf c merupakan pelayanan ultrasonografi obstetrik
dengan menggunakan transmisi elektronik gambar dari
semua modalitas ultrasonografi obstetrik beserta data
pendukung dari Fasyankes Peminta Konsultasi ke
Fasyankes Pemberi Konsultasi, untuk mendapatkan
Expertise dalam hal penegakan diagnosis.<br>
(5) Telekonsultasi klinis sebagaimana dimaksud pada
ayat (1) huruf d merupakan pelayanan konsultasi klinis
jarak jauh untuk membantu menegakkan diagnosis,
dan/atau memberikan pertimbangan/saran tata laksana.<br>
(6) Telekonsultasi klinis sebagaimana dimaksud pada
ayat (5) dapat dilakukan secara tertulis, suara, dan/atau
video.<br>
(7) Telekonsultasi klinis sebagaimana dimaksud pada
ayat (6) harus terekam dan tercatat dalam rekam medis
sesuai dengan ketentuan peraturan perundangundangan.<br>
Pasal 4<br>
Pelayanan Telemedicine sebagaimana dimaksud dalam Pasal 3
dilaksanakan sesuai dengan standar sesuai dengan ketentuan
peraturan perundang-undangan.<br>

Bagian Kedua
Fasyankes Penyelenggara
Pasal 5
Fasyankes penyelenggara sebagaimana dimaksud dalam Pasal
2 meliputi Fasyankes Pemberi Konsultasi dan Fasyankes
Peminta Konsultasi.
Pasal 6
(1) Fasyankes Pemberi Konsultasi sebagaimana dimaksud
dalam Pasal 5 berupa rumah sakit.
(2) Rumah sakit sebagaimana dimaksud pada ayat (1)
merupakan rumah sakit milik Pemerintah Pusat,
Pemerintah Daerah, dan swasta yang memenuhi
persyaratan.
(3) Fasyankes Peminta Konsultasi sebagaimana dimaksud
dalam Pasal 5 berupa rumah sakit, Fasyankes tingkat
pertama, dan Fasyankes lain.
Pasal 7
(1) Fasyankes Pemberi Konsultasi sebagaimana dimaksud
dalam Pasal 5 memiliki tugas:
a. menetapkan sumber daya manusia dalam
melaksanakan Pelayanan Telemedicine;
b. menetapkan standar prosedur operasional
Pelayanan Telemedicine melalui keputusan
kepala/direktur rumah sakit;
c. mendokumentasikan Pelayanan Telemedicine dalam
rekam medis sesuai dengan ketentuan peraturan
perundang-undangan; dan
d. merespon setiap keluhan/usul/kritik atas Pelayanan
Telemedicine dari Fasyankes Peminta Konsultasi.
(2) Fasyankes Peminta Konsultasi sebagaimana dimaksud
dalam Pasal 5 memiliki tugas:
a. menetapkan sumber daya manusia dalam
melaksanakan Pelayanan Telemedicine;
-7-
b. menetapkan standar prosedur operasional
Pelayanan Telemedicine melalui keputusan pimpinan
Fasyankes;
c. mendokumentasikan Pelayanan Telemedicine dalam
rekam medis sesuai dengan ketentuan peraturan
perundang-undangan; dan
d. memberikan jasa Pelayanan Telemedicine sesuai
dengan perjanjian kerja sama.
</p>
      		<div class="form" style="float: ">
			    <div class="form-group">
			    <div class="form-check">
			      <input class="form-check-input" type="checkbox" id="gridCheck">
			      <label class="form-check-label" for="gridCheck">
			        Saya Setuju
			      </label>
			    </div>
			  </div>
			</div>
      	</div>
      </div>	
      </div>
        
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary">Daftar</button>
      </div>
    </div>
  </div>
</div>