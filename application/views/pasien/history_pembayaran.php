<!-- Main content -->
    <div class="page-wrapper">
      <div class="content">
          <div class="row mb-3">
              <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Pembayaran/history') ?>"class="text-black font-bold-7">Riwayat Pembayaran Telekonsultasi</a></li>
                    </ol>
                </nav>
              </div>
              <div class="col-sm-12 col-12">
                  <h3 class="page-title">Riwayat Pembayaran Telekonsultasi</h3>
              </div>
          </div> 

        <div class="row">
            <div class="col-md-12">
                <div class="bg-tab p-3">
                    <div class="row mb-4">
                      <div class="col-md-3 mx-3">
                            <div class="box">
                                <div class="container-1 ">
                                    <span class="icon"><i class="fa fa-search font-16"></i></span>
                                    <input type="search" id="search" placeholder="Cari Dokter Disini" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-border table-hover custom-table mb-0" id="table_histori">
                        <thead class="text-tr">
                        <tr class="font-16">
                            <th class="text-left">No</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Biaya</th>
                            <th>Metode Pembayaran</th>
                            <th>Bukti Foto / Nomor Klaim / VA Num</th>
                            <th>Status</th>
                            <th>Tanggal Bukti</th>
                        </tr>
                        </thead>
                            <tbody class="font-14">
                                <?php
                                    if(count($list_pembayaran) > 0){
                                        foreach($list_pembayaran as $idx => $pembayaran){
                                            $idx+=1;
                                            $dompet_digital = $pembayaran['id_payment'] == 3 ? 'OVO' : ($pembayaran['id_payment'] == 4 ? 'DANA' : 'ShopeePay');
                                            $va_number = $pembayaran['metode_pembayaran'] == 1 || $pembayaran['metode_pembayaran'] == 2 || $pembayaran['metode_pembayaran'] == 3 ? $pembayaran['va_number'] : null;
                                            $metode_pembayaran = $pembayaran['metode_pembayaran'] == 1 ? 'Transfer Manual' : ($pembayaran['metode_pembayaran'] == 2 ? 'Owlexa' : ($pembayaran['metode_pembayaran'] == 3 ? 'Virtual Account' : ($pembayaran['metode_pembayaran'] == 4 ? 'Dompet Digital - '.$dompet_digital : 'Credit Card / Debit Card')));
                                            echo "<tr>";
                                            echo "<td>".$idx++."</td>";
                                            echo "<td>".ucwords($pembayaran['nama_pasien'])."</td>";
                                            $nama_dokter = $pembayaran['nama_dokter'] ? ucwords($pembayaran['nama_dokter']) : 'Dokter Tidak Ada';
                                            echo "<td>".$nama_dokter."</td>";
                                            $biaya_adm = $pembayaran['biaya_adm'] ? $pembayaran['biaya_adm']:0;
                                            $biaya_konsultasi = $pembayaran['biaya_konsultasi'] ? $pembayaran['biaya_konsultasi']:0;
                                            $total_biaya = $biaya_adm+$biaya_konsultasi;
                                            echo "<td>Biaya Konsultasi: <span class='text-success'>".'Rp. '.number_format($biaya_konsultasi, 2, ',', '.')."</span><br/><br/>Biaya Administrasi: <span class='text-success'>".'Rp. '.number_format($biaya_adm, 2, ',', '.').'</span><br/><br/>Total Biaya: <span class="text-success">'.'Rp. '.number_format($total_biaya, 2, ',', '.').'</span></td>';
                                            echo "<td>".$metode_pembayaran."</td>";
                                            echo $pembayaran['metode_pembayaran'] == 1 ? "<td><img src='".base_url('assets/images/bukti_pembayaran/').$pembayaran['foto']."' style='max-width: 100px;'></td>":($pembayaran['metode_pembayaran'] == 2 ? "<td>".$pembayaran['claim_number']."</td>":"<td>".$va_number."</td>");
                                            //$status = $pembayaran['status'] == 1 ? 'Diverifikasi' : 'Ditolak';
                                            if ($status = $pembayaran['status'] == 1) {
                                                $status = $pembayaran['metode_pembayaran'] == 1 ? 'Lunas' : 'PAID';
                                            }elseif ($status = $pembayaran['status'] == 0)  {
                                                $status = 'Sedang Diproses';
                                            }else{
                                                $status = 'Di Tolak';
                                            }
                                            echo "<td>".$status."</td>";
                                            $tanggal = new DateTime($pembayaran['created_at']);
                                            $tanggal = $tanggal->format('d-m-Y H:i:s');
                                            echo "<td>".$tanggal."</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else{
                                        echo "No Data";
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
