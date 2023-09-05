<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Pendaftaran?poli=&hari=all') ?>" class="text-black font-bold-7">Pendaftaran</a></li>
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
                                        $foto = $jadwal_dokter['foto_dokter'] ? base_url('assets/images/users/' . $jadwal_dokter['foto_dokter']) : base_url('assets/dashboard/img/user.jpg');
                                        $button = "<td class='text-center'><a class='btn btn-pilih' onclick=\"openModalAndRedirect('" . base_url('pasien/Pendaftaran/daftar?id_jadwal=' . $jadwal_dokter['id'] . '&token=' . $this->session->userdata("_token")) . "','spinner-" . $jadwal_dokter['id'] . "')\"><i style='display:none;' id='spinner-" . $jadwal_dokter['id'] . "' class='fa fa-spinner fa-spin'></i>&nbsp;Pilih</a></td>";
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
                <div class="modal fade" id="tac_modal_daftar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content" style="height: 600px;">
                            <div class="modal-header text-modal-header">
                                <h5 class="modal-title font-16" id="exampleModalScrollableTitles">SYARAT DAN KETENTUAN PENGGUNAAN</h5>
                            </div>
                            <div class="modal-body">
                                <div class="font-16 text-justify" style="overflow-y: scroll; max-height: 400px; padding: 5px;" id="toc_body">
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:center;vertical-align:baseline;'><strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>SYARAT DAN KETENTUAN PENGGUNAAN</span></strong></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:center;vertical-align:baseline;'><strong><span style='font-size:15px;font-family:"Calibri",sans-serif;'>OLTIMED</span></strong></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:center;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><em><span style='font-size:15px;font-family:"Calibri",sans-serif;'>MOHON UNTUK MEMBACA SELURUH SYARAT DAN KETENTUAN PENGGUNAAN SERTA KEBIJAKAN PRIVASI YANG TERLAMPIR DENGAN CERMAT DAN SAKSAMA SEBELUM MENGGUNAKAN SETIAP FITUR DAN/ATAU LAYANAN YANG TERSEDIA DALAM PLATFORM OLTIMED.</span></em></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Syarat dan Ketentuan Penggunaan (“Ketentuan Penggunaan”) ini merupakan suatu perjanjian sah terkait tata cara dan persyaratan penggunaan fitur dan/atau layanan (“Layanan”) Platform OLTIMED (“Platform”) antara Pengguna (“Anda”) dengan pengelola Platform, yaitu Rumah Sakit Terminal Petikemas Surabaya yang didukung oleh PT. Aplikanusa Lintasarta (“Kami”). Dengan mengunduh dan/atau memasang dan/atau menggunakan Platform dan/atau menikmati Layanan Kami, Anda setuju bahwa Anda telah membaca, memahami, mengetahui, menerima, dan menyetujui seluruh informasi, syarat-syarat, dan ketentuan-ketentuan penggunaan Platform yang terdapat dalam Ketentuan Penggunaan ini. </span></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>Apabila Anda tidak setuju terhadap salah satu, sebagian, atau seluruh isi yang tertuang dalam Ketentuan Penggunaan dan Kebijakan Privasi ini, silakan untuk menghapus Platform dalam perangkat elektronik Anda dan/atau tidak mengakses Platform dan/atau tidak menggunakan Layanan Kami. Mohon untuk dapat diperhatikan pula bahwa Ketentuan Penggunaan dan Kebijakan Privasi dapat diperbarui dari waktu ke waktu.</span></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'><span style='font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</span></p>
                                    <p style='margin-right:0cm;margin-left:0cm;font-size:16px;font-family:"Times New Roman",serif;margin:0cm;text-align:justify;vertical-align:baseline;'>
                                        1.KETENTUAN UMUM <br><br>

                                    <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                                        <li><span style='font-family:"Calibri",sans-serif;'>Platform aplikasi web (aplikasi yang dapat diakses menggunakan web), website yang dikelola oleh Kami sebagaimana diperbarui dari waktu ke waktu.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Koneksi internet diperlukan untuk dapat menggunakan Layanan dan biaya terkait penggunaan koneksi internet tersebut ditanggung sepenuhnya oleh Anda. </span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Platform berfungsi sebagai sarana untuk menghubungkan Anda dengan pihak Rumah Sakit yang menyediakan layanan atau menjual barang kepada Anda seperti (tetapi tidak terbatas pada) dokter, psikolog, apotek, laboratorium, dan/atau jasa pengantaran (“Penyedia Layanan”).</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Jenis layanan yang dapat digunakan melalui Platform adalah:</span></li>
                                    </ol>
                                    <ul style="list-style-type: disc;margin-left:44px;">
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Pendaftaran online untuk telekonsultasi dengan dokter RS;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Pembayaran menggunakan asuransi Owlexa maupun pembayaran elektronik untuk non-asuransi</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Video call dan Chat dengan Dokter;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Pemberian resep dan pengambilan maupun pengiriman obat;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Layanan lain yang dapat kami tambahkan dari waktu ke waktu;</span></li>
                                    </ul>
                                    <ol start="5" style="list-style-type: lower-alpha;margin-left:26px;">
                                        <li><span style='font-family:"Calibri",sans-serif;'>Kami dapat menggunakan jasa pihak ketiga terkait penyediaan layanan pembayaran. Apabila terjadi kegagalan pada sistem pembayaran, Kami akan berupaya semaksimal mungkin dalam membantu menyelesaikan masalah yang mungkin timbul. Penyedia jasa perbankan/pembayaran yang dipilih oleh Anda dapat mengenakan biaya tambahan kepada Anda atas layanan yang diberikan. </span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Setiap fitur atau fasilitas dalam Platform dapat diperbarui atau diubah sesuai dengan kebutuhan dan perkembangan Platform.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Informasi mengenai data pribadi dan riwayat kesehatan anda tersimpan di dalam database milik RS, dan Kami akan menyimpan serta menampilkannya dalam akun Anda. Kerahasiaan data Anda terjamin dan akan digunakan oleh Rumah Sakit untuk keperluan interaksi dengan dokter dan/atau keperluan pemesanan obat serta layanan lainnya yang dilakukan di dalam Platform yang telah Anda setujui sesuai dengan ketentuan perundang-undangan yang berlaku dan Kebijakan Privasi.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Dengan menggunakan Platform, Anda memahami dan menyetujui bahwa percakapan melalui fitur video call, voice call maupun chat akan tersimpan secara otomatis dan diarsipkan untuk keperluan legal dan peningkatan kualitas layanan. Kerahasiaan percakapan Anda terjamin dan informasi tidak akan disebarluaskan.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda memahami dan menyetujui bahwa komunikasi Anda dengan fasilitas pelayanan kesehatan yang terhubung tersimpan secara otomatis dan diarsipkan untuk keperluan legal dan peningkatan kualitas layanan. Kerahasiaan percakapan Anda terjamin dan informasi tidak akan disebarluaskan.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Kami dapat menghentikan atau membatasi proses registrasi atau penggunaan Platform oleh Anda jika ditemukan pelanggaran dari Ketentuan Penggunaan ini atau peraturan perundang-undangan yang berlaku.</span></li>
                                    </ol>
                                     
                                    2.KETENTUAN KHUSUS <br><br>
                                     
                                    <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda tidak dapat menggunakan aplikasi telemedisin jika sudah melakukan perawatan secara langsung (offline)di hari yang sama</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda tidak dapat menggunakan aplikasi tememedisin jika sudah melakukan telemedisin hingga H+3 dari proses telemedisin sebelumnya</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda tidak dapat menggunakan telemedisin jika plafon anda kurang dari Rp. 1.000.000,- (satu juta rupiah)</span></li>
                                    </ol>

                                    3.LAYANAN <br><br>
                                     
                                    <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                                        <li><span style='font-family:"Calibri",sans-serif;'>Fitur ini memfasilitasi para dokter umum dari MedSos, PHC dan provider Owlexa lainnya yang terdaftar pada Rumah Sakit dan memiliki SIP, untuk berinteraksi dengan Anda melalui video call, voice call maupun chat yang dapat diakses melalui Aplikasi dan Website.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda tidak dapat membatalkan booking Chat dengan dokter, psikolog, atau psikolog klinis Kami. JIka ingin membatalkan, anda dapat menolak panggilan dari dokter kami. Konsekuensi dari proses ini adalah tidak adanya pengembalian dana sesuai dengan prosedur yang berlaku.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Dokter, psikolog, atau psikolog klinis Kami dapat membatalkan booking Chat maksimal 30 (tiga puluh) menit sebelum jadwal untuk berkonsultasi dimulai. Kami akan menawarkan untuk perubahan jadwal seperti pengunduran waktu telekonsultasi, atau mengganti nya dengan dokter lain sesuai dengan prosedur yang berlaku.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Jika Anda tidak hadir pada jadwal booking yang telah Anda pilih maka Anda menyetujui bahwa dana yang telah Anda bayarkan tidak dapat dikembalikan. </span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Kami akan mengirimkan pemberitahuan terkait janji Chat dengan Dokter melalui push notification pada perangkat elektronik Anda. Untuk dapat menerima push notification yang Kami kirimkan maka Anda harus mengaktifkan push notification tersebut. </span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda mengetahui dan menyetujui bahwa fitur ini tidak menggantikan pemeriksaan dan pengobatan dengan dokter pada umumnya atau tatap muka secara langsung. </span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Kami tidak menyarankan Anda menggunakan Platform untuk kondisi medis darurat.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda memahami bahwa Anda perlu memberikan informasi dan menjelaskan gejala atau keluhan fisik yang Anda alami secara lengkap, jelas dan akurat ketika melakukan percakapan dengan dokter rekanan Kami melalui fitur Chat dengan Dokter.</span></li>
                                    </ol>
                                     
                                    4.TRANSAKSI <br><br>
                                     
                                    <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                                        <li><span style='font-family:"Calibri",sans-serif;'>Untuk dapat bertransaksi di Platform, Anda dapat menggunakan berbagai metode pembayaran asuransi Owlexa.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Apabila Anda mencurigai adanya aktivitas yang tidak wajar dan/atau terjadi perselisihan/sengketa sehubungan dengan akun Anda, Anda dapat segera menghubungi Kami agar Kami dapat segera mengambil tindakan yang diperlukan. </span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Kami dapat melakukan penangguhan segala transaksi yang berasal dari akun Anda serta dapat melakukan tindakan penangguhan transaksi apabila kami mengidentifikasi adanya masalah pada akun Anda atau suatu transaksi tertentu.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda memahami dan menyetujui bahwa batas waktu pengajuan keluhan mengenai transaksi adalah maksimal 7 (tujuh) hari kalender setelah transaksi selesai.</span></li>
                                    </ol>
                                     
                                    5.KETENTUAN TRANSAKSI <br><br>
                                     
                                    <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                                        <li><span style='font-family:"Calibri",sans-serif;'>Fitur Video Call dan Chat dengan Dokter</span></li>
                                    </ol>
                                    <ol style="list-style-type: lower-roman;margin-left:48.5px;">
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Anda akan dikenakan tarif dengan jumlah tertentu yang sudah di tentukan oleh pihak Rumah Sakit.&nbsp;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Saat menghubungi dokter melalui chat, Anda dapat mengirimkan gambar kepada dokter yang berkaitan dengan kondisi medis Anda dengan format png, jpg, dan bitmap. &nbsp;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Setelah sesi Chat dengan Dokter selesai, dokter dapat memberikan Diagnosa dan Electronic Prescription. &nbsp;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Dokter dapat melakukan Follow Up kepada Anda untuk mengecek kondisi kesehatan Anda setelah dilakukannya sesi Chat dengan Dokter.&nbsp;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Transaksi tidak dapat dibatalkan setelah sesi Chat dengan Dokter berakhir atau selesai dilakukan.&nbsp;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Kami dapat memblokir atau membatalkan akun Anda apabila terdapat penyalahgunaan fitur Chat dengan Dokter pada akun Anda.&nbsp;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Biaya yang dikenakan tersebut belum termasuk penggunaan pembayaran dengan metode : e-banking, m-banking.&nbsp;</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;font-size:11.0pt;'>Ketepatan serta keakuratan Dokter dalam memberikan Electronic Prescription akan bergantung pada informasi yang diberikan oleh Anda. Setiap isi dan/atau pernyataan-pernyataan dalam percakapan yang dilakukan oleh Anda dengan Dokter menggunakan fitur video call, chat, Diagnosa, Electronic Prescription, pada Platform, hal tersebut ialah percakapan dan interaksi pribadi antara Anda dengan Dokter rekanan sebagai pemberi jasa layanan kesehatan.&nbsp;</span></li>
                                    </ol>
                                     
                                    6.HAK ATAS KEKAYAAN INTELEKTUAL <br><br>
                                     
                                    <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                                        <li><span style='font-family:"Calibri",sans-serif;'>Kami adalah pemilik atas nama, ikon, dan logo OLTIMED serta fitur Chat dengan Dokter, yang mana merupakan hak cipta dan merek dagang yang dilindungi undang-undang Republik Indonesia. Anda tidak dapat menggunakan, memodifikasi, atau memasang nama, ikon, logo, atau merek tersebut tanpa persetujuan tertulis dari Kami. </span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Seluruh hak atas kekayaan intelektual yang terdapat dalam Platform berdasarkan hukum negara Republik Indonesia, termasuk dalam hal ini adalah kepemilikan hak kekayaan intelektual atas seluruh source code Platform dan hak kekayaan intelektual terkait Platform. Untuk itu, Anda dilarang untuk melakukan pelanggaran atas hak kekayaan intelektual yang terdapat pada Platform ini, termasuk melakukan modifikasi, karya turunan, mengadaptasi, menduplikasi, menyalin, menjual, membuat ulang, meretas, menjual, dan/atau mengeksploitasi Platform termasuk penggunaan Platform atas akses yang tidak sah, meluncurkan program otomatis atau script, atau segala program apapun yang mungkin menghambat operasi dan/atau kinerja Platform, atau dengan cara apapun memperbanyak atau menghindari struktur navigasi atau presentasi dari Platform atau isinya.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Anda hanya diperbolehkan untuk menggunakan Platform semata-mata untuk kebutuhan pribadi dan tidak dapat dialihkan.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Kami dapat mengambil tindakan hukum terhadap setiap pelanggaran yang dilakukan oleh Anda terkait dengan hak kekayaan intelektual terkait Platform.</span></li>
                                    </ol>
                                     
                                    7.FUNGSI PLATFORM <br><br>
                                     
                                    <div style="margin-left: 26px;">
                                        Kami senantiasa melakukan upaya untuk menjaga Platform ini berfungsi dan berjalan lancar. Perlu diketahui bahwa Platform dan/atau fitur Layanan Kami dapat sewaktu-waktu tidak tersedia yang disebabkan oleh berbagai alasan, termasuk namun tidak terbatas pada keperluan pemeliharaan atau masalah teknis, dan situasi ini berada di luar kuasa kami. 
                                    </div>

                                    <br>
                                    <br>
                                     
                                    8.PENUTUP <br><br>
                                     
                                    <ol start="1" style="list-style-type: lower-alpha;margin-left:26px;">
                                        <li><span style='font-family:"Calibri",sans-serif;'>Ketentuan Penggunaan ini diatur dan ditafsirkan serta dilaksanakan berdasarkan hukum yang berlaku di Negara Republik Indonesia dan Anda dengan tegas menyetujui bahwa bahwa ketentuan Pasal 1266 Kitab Undang-Undang Hukum Perdata dan ketentuan lainnya yang mewajibkan adanya pengesahan atau persetujuan pengadilan untuk dapat mengakhiri Ketentuan Penggunaan tidak berlaku terhadap Ketentuan Penggunaan ini.</span></li>
                                        <li><span style='font-family:"Calibri",sans-serif;'>Segala sengketa yang berkaitan dengan Ketentuan Penggunaan ini, diselesaikan secara musyawarah untuk mufakat atau melalui Badan Arbitrase Nasional Indonesia (BANI), sesuai dengan prosedur yang berlaku di BANI. Apabila kedua belah pihak tidak sepakat untuk menyelesaikannya sengketa di BANI, maka sengketa akan diselesaikan melalui Pengadilan Negeri Jakarta Selatan</span></li>
                                    </ol>
                                    </p>
                                </div>
                                <hr>
                                <!-- <input type="checkbox" value="" id="tac_checkbox"> <label style="font-size: 14px;" for="toc_checkbox">Saya menyetujui syarat dan ketentuan penggunaan</label> -->
                                <div class="flex">
                                    <div>
                                        <button type="button" style="width:100% !important;" class="btn btn-simpan-sm" id="simpan_toc">Setuju</button>
                                    </div>
                                    <div>
                                        <button type="button" style="width:100% !important;" class="btn btn-batal-sm mt-2" id="batal_toc">Batalkan</button>
                                    </div>
                                </div>
                            </div>
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
    function openModalAndRedirect(url, spinner) {
        $('#' + spinner).show();

        const form = new FormData();
        form.append('userId', <?= $this->session->userdata("id_user")  ?>);
        axios.post('<?= config_item('pg_api') ?>/owlexa/Api/plafonCheck', form)
            .then(function(response) {
                $('#' + spinner).hide();
                if (response.data.data < 1000000) {
                    alert('Tidak dapat melakukan pendaftaran konsultasi karena plafon tidak mencukupi, silahkan cek plafon anda kembali');
                    return false;
                }

                $('#tac_modal_daftar').modal('show');
                $("#simpan_toc").on("click", function() {
                    window.location.href = url;
                });
                $("#batal_toc").on("click", function() {
                    $('#tac_modal_daftar').modal('hide');
                });

            })
            .catch(function(error) {
                $('#' + spinner).hide();
                console.log(error.response.data.msg)

                if (error.response.data.msg == "Data tidak ditemukan") {
                    alert("Akun anda belum terdaftar di Owlexa");

                } else {
                    alert(error.response.data.msg);
                }
            });

    }
    $(document).ready(function() {
        $('#toc_body').scroll(function(e) {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                $('#toc_checkbox').prop('disabled', false);
            }
        });
        $('#toc_checkbox').change(function(e) {
            if (this.checked) {
                $('#simpan_toc').prop('disabled', false);
                $('#simpan_toc').removeClass('btn-secondary').addClass('btn-primary');
            } else {
                $('#simpan_toc').prop('disabled', true);
                $('#simpan_toc').removeClass('btn-primary').addClass('btn-secondary');
            }
        });
    });
</script>

<script>
    function poli_onchange() {
        location.href = "<?php echo base_url() ?>pasien/Pendaftaran?poli=" + document.getElementById('poli').value + "&hari=" + document.getElementById('hari').value;
    }

    function hari_onchange() {
        location.href = "<?php echo base_url() ?>pasien/Pendaftaran?poli=" + document.getElementById('poli').value + "&hari=" + document.getElementById('hari').value;
    }
</script>