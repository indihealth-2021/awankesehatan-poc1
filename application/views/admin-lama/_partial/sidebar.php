<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Utama</li>
                <?php if ($user->id_user_level == 1) { ?>
                    <li class="<?php if (isset($this->uri->segments[2])) {
                                    echo strtolower($this->uri->segments[2]) == 'admin' && !isset($this->uri->segments[3]) ? 'active' : '';
                                } ?>">
                        <a href="<?php echo base_url('admin/admin') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="<?php if (isset($this->uri->segments[3])) {
                                    echo strtolower($this->uri->segments[3]) == 'manage_admin' ? 'active' : '';
                                } ?>">
                        <a href="<?php echo base_url('admin/admin/manage_admin') ?>"><i class="fa fa-user"></i> <span>Admin</span></a>
                    </li>
                    <li class="<?php if (isset($this->uri->segments[2])) {
                                    echo strtolower($this->uri->segments[2]) == 'dokter' && !isset($this->uri->segments[3]) ? 'active' : '';
                                } ?>">
                        <a href="<?php echo base_url('admin/dokter') ?>"><i class="fa fa-user-md"></i> <span>Dokter</span></a>
                    </li>
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'pasien' && !isset($this->uri->segments[3]) ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/pasien') ?>"><i class="fa fa-wheelchair"></i> <span>Pasien</span></a>
                    </li>
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'config' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/Config/poli') ?>"><i class="fa fa-plus-square"></i> <span>Poli</span></a>
                    </li>
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'obat' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/Obat/manage_obat') ?>"><i class="fa fa-plus-circle"></i> <span>Obat</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#" class="<?php if (isset($this->uri->segments[3])) {
                                                echo strtolower($this->uri->segments[2]) == 'pengirimanobat' && (strtolower($this->uri->segments[3]) == 'status_resep' || strtolower($this->uri->segments[3]) == 'history_pengiriman_obat') ? 'active' : '';
                                            } ?>"><i class="fas fa-truck"></i> <span>Pengiriman Obat</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="<?php if (isset($this->uri->segments[3])) {
                                            echo strtolower($this->uri->segments[3]) == 'status_resep' ? 'active' : '';
                                        } ?>">
                                <a href="<?php echo base_url('admin/PengirimanObat/status_resep') ?>"><span>Status</span></a>
                            </li>
                            <li class="<?php if (isset($this->uri->segments[3])) {
                                            echo strtolower($this->uri->segments[3]) == 'history_pengiriman_obat' ? 'active' : '';
                                        } ?>">
                                <a href="<?php echo base_url('admin/PengirimanObat/history_pengiriman_obat') ?>"><span>Riwayat</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if (!isset($this->uri->segments[3])) {
                                    echo strtolower($this->uri->segments[2]) == 'pengirimanobat' ? 'active' : '';
                                } ?>">
                        <a href="<?php echo base_url('admin/PengirimanObat') ?>"><i class="fas fa-file-invoice-dollar"></i> <span>Biaya Pengiriman Obat</span></a>
                    </li>
                    <!-- <li class="submenu <?php echo strtolower($this->uri->segments[2]) == 'obat' || strtolower($this->uri->segments[2]) == 'kategoriobat' ? 'active' : ''; ?>">
                            <a href="#"><i class="fa fa-plus-circle"></i> <span> Obat </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li class="<?php if (isset($this->uri->segments[3])) {
                                                echo strtolower($this->uri->segments[3]) == 'manage_obat' ? 'active' : '';
                                            } ?>">
                                    <a href="<?php echo base_url('admin/Obat/manage_obat') ?>">Obat</a>
                                </li class="<?php if (isset($this->uri->segments[2])) {
                                                echo strtolower($this->uri->segments[2]) == 'kategoriobat' ? 'active' : '';
                                            } ?>">
                                <li><a href="<?php echo base_url('admin/KategoriObat') ?>">Kategori Obat</a></li>
                            </ul>
                        </li> -->
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'news' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/news') ?>"><i class="fa fa-newspaper-o"></i> <span>Berita</span></a>
                    </li>
                    <li class="<?php if (isset($this->uri->segments[3])) {
                                    echo strtolower($this->uri->segments[3]) == 'jadwal_dokter' ? 'active' : '';
                                } ?>">
                        <a href="<?php echo base_url('admin/dokter/jadwal_dokter') ?>"><i class="fa fa-calendar-check-o"></i> <span>Jadwal Dokter</span></a>
                    </li>
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'selfassesment' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/selfAssesment') ?>"><i class="fa fa-check-square"></i> <span>Assesment Pasien</span></a>
                    </li>
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'teleconsultasi' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/teleconsultasi') ?>"><i class="fa fa-calendar-check-o"></i> <span>Jadwal Telekonsultasi</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#" class="<?php echo strtolower($this->uri->segments[2]) == 'payment' || strtolower($this->uri->segments[2]) == 'history' ? 'active' : ''; ?>"><i class="fa fa-money"></i> <span> Pembayaran </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li class="submenu"><a href="#"><span>Telekonsultasi</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'payment' ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url('admin/payment') ?>" class="submenu">Verifikasi</a>
                                    </li>
                                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'history' ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url('admin/History') ?>" class="submenu">Riwayat</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="submenu <?php if (isset($this->uri->segments[3])) {
                                                    echo strtolower($this->uri->segments[2]) == 'pembayaranobat' || strtolower($this->uri->segments[3]) == 'history' ? 'active' : '';
                                                } ?>">
                                <a href="#"><span>Obat</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'pembayaranobat' ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url('admin/PembayaranObat') ?>" class="submenu">Verifikasi</a>
                                    </li>
                                    <li class="<?php if (isset($this->uri->segments[3])) {
                                                    echo strtolower($this->uri->segments[3]) == 'history' ? 'active' : '';
                                                } ?>">
                                        <a href="<?php echo base_url('admin/PembayaranObat/history') ?>" class="submenu">Riwayat</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" class="<?php echo strtolower($this->uri->segments[2]) == 'invoice' ? 'active' : ''; ?>"><i class="fas fa-file-invoice"></i> <span>Laporan</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="<?php if (isset($this->uri->segments[3])) {
                                            echo strtolower($this->uri->segments[3]) == 'invoice_diagnosa_terbanyak' ? 'active' : '';
                                        } ?>">
                                <a href="<?php echo base_url('admin/Invoice/invoice_diagnosa_terbanyak') ?>"><span>Diagnosa Terbanyak</span></a>
                            </li>
                            <li class="<?php if (isset($this->uri->segments[3])) {
                                            echo strtolower($this->uri->segments[3]) == 'invoice_telekonsultasi' ? 'active' : '';
                                        } ?>">
                                <a href="<?php echo base_url('admin/Invoice/invoice_telekonsultasi') ?>"><span>Telekonsultasi</span></a>
                            </li>
                            <li class="<?php if (isset($this->uri->segments[3])) {
                                            echo strtolower($this->uri->segments[3]) == 'invoice_owlexa_konsultasi' ? 'active' : '';
                                        } ?>">
                                <a href="<?php echo base_url('admin/Invoice/invoice_owlexa_konsultasi') ?>"><span>Owlexa Telekonsultasi</span></a>
                            </li>
                            <li class="<?php if (isset($this->uri->segments[3])) {
                                            echo strtolower($this->uri->segments[3]) == 'invoice_owlexa_obat' ? 'active' : '';
                                        } ?>">
                                <a href="<?php echo base_url('admin/Invoice/invoice_owlexa_obat') ?>"><span>Owlexa Obat</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if (isset($this->uri->segments[3])) {
                                    echo strtolower($this->uri->segments[3]) == 'antrian_pasien' ? 'active' : '';
                                } ?>">
                        <a href="<?php echo base_url('admin/pasien/antrian_pasien') ?>"><i class="fa fa-plus-circle"></i> <span>Antrian Pasien</span></a>
                    </li>
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'logactivity' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/LogActivity') ?>"><i class="fa fa-cog"></i> <span>Log Activity</span></a>
                    </li>
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'pengaturanweb' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/PengaturanWeb') ?>"><i class="fa fa-wrench"></i> <span>Pengaturan Web</span></a>
                    </li>
                    <!-- <li class="mb-5 <?php echo strtolower($this->uri->segments[2]) == 'reminder' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/Reminder') ?>"><i class="fa fa-clock"></i> <span>Pengingat Jadwal</span></a>
                        </li> -->
                <?php } else { ?>
                    <li class="<?php echo strtolower($this->uri->segments[2]) == 'farmasiverifikasiobat' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url('admin/FarmasiVerifikasiObat') ?>"><i class="fa fa-money"></i> <span>Verifikasi Resep Obat</span></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>