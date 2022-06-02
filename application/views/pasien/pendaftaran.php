
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Pendaftaran?poli=&hari=all') ?>"class="text-black font-bold-7">Pendaftaran</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Pendaftaran</h3>
          </div>
      </div>
            <div class="row">
                <div class="col-sm-12 col-12" style="float: right">

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="bg-tab p-3">

                        <div class="row mb-3">
                            <div class="col-md-3 mx-3">
                                <div class="box">
                                  <div class="container-1 ">
                                      <span class="icon"><i class="fa fa-search font-16"></i></span>
                                      <input type="search" id="search" placeholder="Cari Dokter Disini" />
                                  </div>
                                </div>
                            </div>

                            <form method="GET" action="https://telemedicinelintasdev.indihealth.com/pasien/Pendaftaran"></form>
                            <div class="col-md-3">
                                <select class="form-control form-control-select" name="hari" id="hari" onchange="hari_onchange();">
                                <?php $hari = $this->input->get('hari') ?>
                                <option value="all" <?php echo $hari == 'all' ? 'selected' : '' ?>>Semua Hari</option>
                                <option value="Senin" <?php echo $hari == 'Senin' ? 'selected' : '' ?>>Senin</option>
                                <option value="Selasa" <?php echo $hari == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                                <option value="Rabu" <?php echo $hari == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                                <option value="Kamis" <?php echo $hari == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                                <option value="Jum'at" <?php echo $hari == "Jum'at" ? 'selected' : '' ?>>Jum'at</option>
                            </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control form-control-select" id="poli" name="poli" onchange="poli_onchange();">
                                <option value="" <?php $s = $this->input->get('poli') ? 'selected' : '';
                                                                echo $s; ?>>Semua Poli</option>
                                <?php
                                foreach ($data_poli as $poli) {
                                    $s = $this->input->get('poli') == $poli->poli ? 'selected' : '';
                                    echo "<option value='" . $poli->poli . "'" . $s . ">" . $poli->poli . "</option>";
                                }
                                ?>
                            </select>
                            </div>
                        </div>

                        <!-- <table cellspacing="5" cellpadding="5" border="0">
                        <tbody>
                            <form method="GET" action="https://telemedicinelintasdev.indihealth.com/pasien/Pendaftaran"></form>
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm" name="hari" id="hari" onchange="hari_onchange();">
                                        <?php $hari = $this->input->get('hari') ?>
                                        <option>Pilih Hari</option>
                                        <option value="all" <?php echo $hari == 'all' ? 'selected' : '' ?>>Semua Hari</option>
                                        <option value="Senin" <?php echo $hari == 'Senin' ? 'selected' : '' ?>>Senin</option>
                                        <option value="Selasa" <?php echo $hari == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                                        <option value="Rabu" <?php echo $hari == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                                        <option value="Kamis" <?php echo $hari == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                                        <option value="Jum'at" <?php echo $hari == "Jum'at" ? 'selected' : '' ?>>Jum'at</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm" id="poli" name="poli" onchange="poli_onchange();">
                                        <option>Pilih Poli</option>
                                        <option value="" <?php $s = $this->input->get('poli') ? 'selected' : '';
                                                            echo $s; ?>>Semua</option>
                                        <?php
                                        foreach ($data_poli as $poli) {
                                            $s = $this->input->get('poli') == $poli->poli ? 'selected' : '';
                                            echo "<option value='" . $poli->poli . "'" . $s . ">" . $poli->poli . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td>
                            <a href="https://telemedicinelintasdev.indihealth.com/pasien/JadwalTerdaftar" class="btn btn-sm btn-primary">Cek Jadwal Terdaftar</a>
                        </td>

                            </tr>
                        </tbody>
                    </table> -->
                        <div class="table-responsive">
                        <table class="table table-border table-hover custom-table mb-0" id="table_pendaftaran">
                            <thead class="text-tr">
                                <tr>
                                    <th class="text-left">No</th>
                                    <th>Dokter</th>
                                    <th>Poli</th>
                                    <th>Nominal</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="font-14">
                                <?php
                                if (count($list_jadwal_dokter) > 0) {
                                    foreach ($list_jadwal_dokter as $idx => $jadwal_dokter) {
                                        $foto = $jadwal_dokter['foto_dokter'] ? base_url('assets/images/users/'.$jadwal_dokter['foto_dokter']):base_url('assets/dashboard/img/user.jpg');
                                        $button = "<td class='text-center'><a class='btn btn-pilih' onclick='return confirm(\"Apakah anda yakin ingin mendaftar jadwal ini?\");' href='" . base_url('pasien/Pendaftaran/daftar?id_jadwal=' . $jadwal_dokter['id'].'&token='.$this->session->userdata("_token")) . "'>Pilih</a></td>";
                                        $nominal = $this->db->query('SELECT harga FROM nominal WHERE poli = "' . $jadwal_dokter["poli"] . '"')->row();
                                        echo "<tr>";
                                        echo "<td>" . ($idx + 1) . "</td>";
                                        echo "<td><img width='34' height='34' src=" . $foto . " class='rounded-circle m-r-5' alt=''><div class='ml-5' style='margin-top:-30px'>" . ucwords($jadwal_dokter['nama_dokter']) . "</div></td>";
                                        echo "<td>" . $jadwal_dokter["poli"] . "</td>";
                                        echo "<td>" . 'Rp ' . number_format($nominal->harga, 2, ',', '.') . "</td>";
                                        echo "<td>" . ucwords($jadwal_dokter['hari']) . "</td>";
                                        echo "<td>" . $jadwal_dokter['waktu'] . "</td>";
                                        $jadwal_dokter['tanggal'] = $jadwal_dokter['tanggal'] ? (new DateTime($jadwal_dokter['tanggal']))->format('d-m-Y') : 'Jadwal Rutin';
                                        echo "<td>" . $jadwal_dokter['tanggal'] . "</td>";
                                        echo $button;
                                        echo "</tr>";
                                    }
                                }
                                ?>
                                <!-- <tr>
                                        <td>1</td>
                                        <td><img width="28" height="28" src="<?php echo base_url('assets/dashboard/img/user.jpg'); ?>" class="rounded-circle m-r-5" alt="">Dokter</td>
                                        <td>ANAK</td>
                                        <td>Rp. 100.000,00</td>
                                        <td>Senin</td>
                                        <td>10:00 AM - 7:00 PM</td>
                                        <td>09-11-2020</td>
                                        <td class="text-center"><a href="" type="button" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i> Pilih</a></td>
                                    </tr> -->
                            </tbody>
                        </table>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <?php if ($this->session->flashdata('msg')) {
        echo "<script>alert('" . $this->session->flashdata('msg') . "')</script>";
    } ?>
    <?php echo $this->session->flashdata('msg_2') ? $this->session->flashdata('msg_2') : ''; ?>
    <?php if ($this->session->flashdata('msg_pmbyrn')) {
        echo "<script>alert('" . $this->session->flashdata('msg_pmbyrn') . "')</script>";
    } ?>

    <script>
        function poli_onchange() {
            location.href = "<?php echo base_url() ?>pasien/Pendaftaran?poli=" + document.getElementById('poli').value + "&hari=" + document.getElementById('hari').value;
        }

        function hari_onchange() {
            location.href = "<?php echo base_url() ?>pasien/Pendaftaran?poli=" + document.getElementById('poli').value + "&hari=" + document.getElementById('hari').value;
        }
    </script>
