   <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>"class="text-black font-bold-7">Jadwal Terdaftar</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Jadwal Terdaftar</h3>
          </div>
      </div>  

        <div class="bg-tab p-3">
            <div class="row mb-3">
                <div class="col-md-3 mb-3">
                    <div class="box">
                        <div class="container-1">
                            <span class="icon"><i class="fa fa-search font-16"></i></span>
                            <input type="search" id="search" placeholder="Cari Dokter Disini" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
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
                <div class="col-md-6 text-right">
                    <a href="<?php echo base_url('pasien/Pendaftaran?poli=&hari=all') ?>"class="btn btn-pendaftaran">Daftar Disini</a>
                </div>
            </div>
            <!-- <table cellspacing="5" cellpadding="5" border="0">
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control form-control-sm" id="poli" name="poli" onchange="poli_onchange();">
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
                            <a href="<?php echo base_url('pasien/Pendaftaran?poli=&hari=all') ?>" class="btn btn-sm btn-primary form-control">Pendaftaran</a>
                        </td>

                    </tr>
                </tbody>
            </table> -->
            <div class="table-responsive">
                <table class="table table-border table-hover custom-table mb-0" id="table_jadwal_terdaftar">
                    <thead class="text-tr">
                        <tr>
                            <th class="text-left">No</th>
                            <th>Dokter</th>
                            <th>Biaya Konsultasi</th>
                            <th>Biaya Administrasi</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="font-14">
                        <?php
                        if (count($list_jadwal_terdaftar) > 0) {
                            foreach ($list_jadwal_terdaftar as $idx => $jadwal_terdaftar) {
                                $foto = $jadwal_terdaftar->foto_dokter ? base_url('assets/images/users/'.$jadwal_terdaftar->foto_dokter):base_url('assets/dashboard/img/user.jpg');
                                $status_tipe = $jadwal_terdaftar->id_status_pembayaran != 1 ? ($jadwal_terdaftar->id_status_pembayaran == 0 ? ($jadwal_terdaftar->metode_pembayaran == 3 || $jadwal_terdaftar->metode_pembayaran == 4 || $jadwal_terdaftar->metode_pembayaran == 5 ? 'Pembayaran':'Pendaftaran'):'Pembayaran'):'';
                                if ($jadwal_terdaftar->id_status_pembayaran == 2) {
                                    $button = "
                            <td class='text-center' width='20%'>
                                <a class='btn btn-simpan font-12' href='" . base_url('pasien/Pembayaran/?regid=' . $jadwal_terdaftar->id) . "'>Sedang Diproses</a> 
                                <a class='ml-2' data-nama='" . $jadwal_terdaftar->nama_dokter . "' data-toggle='modal' data-title='".$status_tipe."' data-href='" . base_url('pasien/JadwalTerdaftar/cancel/' . $jadwal_terdaftar->id) . "' data-id-registrasi='" . $jadwal_terdaftar->id . "' onclick=\"$('#modalHapus #form')\" href='#modalHapus'>
                                	<i>
                                    	<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 20 20' fill='none'>
                                        <path d='M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z' fill='black' fill-opacity='0.35'/>
                                        <path d='M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z' fill='black' fill-opacity='0.35'/>
                                       </svg>
                                	</i>
                                </a>
                            </td>";
                                } else if ($jadwal_terdaftar->id_status_pembayaran == 1) {
                                    $button = "<td class='text-center'><a class='btn btn-lunas btn-block' href='" . base_url('pasien/Pembayaran/?regid=' . $jadwal_terdaftar->id) . "'>Lunas</a></td>";
                                } else {
                                    $button =   "<td class='text-center'>
                                    <div class='row mx-auto'>
                                    <a  class='btn btn-bayar' href='" . base_url('pasien/Pembayaran/?regid=' . $jadwal_terdaftar->id) . "'>Bayar</a> 
                                        <a class='text-abu ml-3' data-nama='" . $jadwal_terdaftar->nama_dokter . "' data-toggle='modal' data-title='".$status_tipe."' data-href='" . base_url('pasien/JadwalTerdaftar/cancel/' . $jadwal_terdaftar->id) . "' data-id-registrasi='" . $jadwal_terdaftar->id . "' onclick=\"$('#modalHapus #form')\" href='#modalHapus'><i>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 20 20' fill='none'>
                                                <path d='M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z' fill='black' fill-opacity='0.35'/>
                                                <path d='M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z' fill='black' fill-opacity='0.35'/>
                                                </svg>
                                        </i></a></div>
                                        
                                    </td>";
                                }
                                echo "<tr>";
                                echo "<td>" . ($idx + 1) . "</td>";
                                echo "<td width='15%'><img width='28' height='28' src=" . $foto . " class='rounded-circle m-r-5' alt=''>" . "<div class='ml-5' style='margin-top:-30px;'><span title='".$jadwal_terdaftar->nama_dokter."'>". ucwords(substr($jadwal_terdaftar->nama_dokter, 0, 10)) ."</span>" . "<br><span class='font-12' title='".$jadwal_terdaftar->poli."'>" . ucwords($jadwal_terdaftar->poli). "</span><div></td>";
                                $biaya_konsultasi = $jadwal_terdaftar->biaya_konsultasi_bukti ? $jadwal_terdaftar->biaya_konsultasi_bukti:$jadwal_terdaftar->harga;
                                echo "<td>" . 'Rp ' . number_format($biaya_konsultasi, 2, ',', '.') . "</td>";
                                $biaya_adm = $jadwal_terdaftar->biaya_adm_bukti ? $jadwal_terdaftar->biaya_adm_bukti :($jadwal_terdaftar->biaya_adm_poli ? $jadwal_terdaftar->biaya_adm_poli:$master_web->harga_adm);
                                echo "<td>" . 'Rp ' . number_format($biaya_adm, 2, ',', '.') . "</td>";
                                echo "<td>" . ucwords($jadwal_terdaftar->hari) . "</td>";
                                echo "<td>" . $jadwal_terdaftar->waktu . "</td>";
                                $jadwal_terdaftar->tanggal = $jadwal_terdaftar->tanggal ? (new DateTime($jadwal_terdaftar->tanggal))->format('d-m-Y') : 'Jadwal Rutin';
                                echo "<td>" . $jadwal_terdaftar->tanggal . "</td>";
                                echo $button;
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


<?php if ($this->session->flashdata('msg')) {
    echo "<script>alert('" . $this->session->flashdata('msg') . "')</script>";
} ?>
<?php if ($this->session->flashdata('msg_pmbyrn')) {
    echo "<script>alert('" . $this->session->flashdata('msg_pmbyrn') . "')</script>";
} ?>

<script>
    function poli_onchange() {
        location.href = "<?php echo base_url() ?>pasien/JadwalTerdaftar?poli=" + document.getElementById('poli').value;
    }
</script>

<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="height: auto">
            <div class="modal-header">
                <h5 class="modal-title font-modal-header p-3">Pembatalan <span class="title"></span> Telekonsultasi</h5>
            </div>
            <div class="modal-body font-modal-body">
                <p class="p-3">Anda yakin ingin membatalkan <span class="title-2"></span> telekonsultasi<br>
                <b id="nama"></b> [ <b id="tanggal"></b> ] ?</p>
            </div>
            <div class="modal-footer">
                <div class="mx-auto">
                  <a href="" class="btn btn-ya" id="buttonHapus">Ya</a>
                  <button type="button" class="btn btn-tidak ml-5" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($this->session->flashdata('msg_jadwal_terdaftar')) { ?>
    <script>
        alert("<?php echo $this->session->flashdata('msg_jadwal_terdaftar') ?>")
    </script>
<?php } ?>