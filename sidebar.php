<!-- BEGIN SIDEBAR -->
<div class="page-sidebar " id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
        <div class="user-info-wrapper sm">
            <div class="profile-wrapper sm">
                <!-- <a class="profile-click" id="profile1" name="profile1"><img src="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/avatar.jpg" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/avatar.jpg"
                    data-src-retina="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/avatar2x.jpg" width="69" height="69" /></a> -->
                <!-- <strong style="color: white; font-size: 250%; margin-left: 5%; margin-top: 5%;">Logo</strong> -->
                <a href="/skripsi/apps/index.php">
                <!-- <img src="/PTRutan/LEAPHRIS/kerjaan/assets/img/logo.png" class="logo" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/assets/img/logo.png"
                    data-src-retina="/PTRutan/LEAPHRIS/kerjaan/assets/img/logo2x.png" width="106" height="21" /> -->
                <img style="margin-top: -100%; margin-left: -10%; height: 180px; width: 180px;" src="/skripsi/apps/assets/img/arthamakmur.png" class="logo" alt="" data-src="/skripsi/apps/assets/img/arthamakmur.png"
                    data-src-retina="/skripsi/apps/assets/img/arthamakmur.png" width="106" height="106" />
                    <!-- <strong style="color: white; font-size: 300%; margin-left: 5%; margin-top: 5%;">HRIS</strong> -->
                <!-- <strong style="color: white; font-size: 250%; margin-left: 5%; margin-top: 5%;">Artha Makmur</strong> -->
            </div>
            <div class="user-info sm usernameSidebar" id="usernameSidebar">
                <!-- <div class="username">Fred Smith</div>
                <div class="status">Life goes on...</div> -->
            </div>
        </div>
        <!-- END MINI-PROFILE -->
        <!-- BEGIN SIDEBAR MENU -->
        <br><br><br><br><br>
        <p class="menu-title sm">BROWSE <span class="pull-right"><a href="javascript:;"><i
                        class="material-icons"></i></a></span></p>
        <ul>
            <li class="start"> <a href="/skripsi/apps/index.php"><i class="material-icons">home</i> <span class="title">Dashboard</span></a></li>
            <!-- <li class="start"> <a href="/skripsi/apps/index.php"><i class="material-icons">local_shipping</i> <span class="title">Kirim Telur</span></a></li> -->
            <li id="kirim_barang">
                <a href="javascript:;"> <i class="material-icons">local_shipping</i> <span
                        class="title">Kirim Telur</span> <span class=" arrow"></span> </a>
                <ul class="sub-menu">
                    <li id="sidebar_daftar_tempat"> <a href="/skripsi/apps/distribusi/daftartempat.php">Daftar Tempat</a></li>
                    <li id="sidebar_buat_pesanan"> <a href="/skripsi/apps/distribusi/pesanan.php">Buat Pesanan</a></li>
                    <li id="sidebar_list_pesanan"> <a href="/skripsi/apps/distribusi/daftarpesanan.php">List Pesanan</a></li>
                </ul>
            </li>
            <!-- History Log -->
            <!-- <li id="history_log">
                <a href="javascript:;"> <i class="material-icons">history</i> <span
                        class="title">History Log</span> <span class=" arrow"></span> </a>
                <ul class="sub-menu">
                    <li id="sidebar_history_master"> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historymaster.php">History Master</a></li>
                    <li id="sidebar_history_data_pegawai"> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historydatapegawai.php">History Data Pegawai</a></li>
                    <li id="history_KPI"> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historylogkpi.php">History KPI</a></li>
                    <li id="history_approve_training"> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historytraining.php">History Data Training</a></li>
                    <li id="history_mutasi_karyawan"> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historymutasi.php">History Mutasi Karyawan</a></li>
                    <li id="history_merge">
                    <a href="javascript:;"> <span class="title">Kontrol</span> <span class=" arrow"></span> </a>
                    <ul class="sub-menu">
                        <li> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historykontroltraining.php">Training</a></li>
                        <li> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historykontrolevaluasi.php">Evaluasi</a></li>
                        <li> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historykontrolprofile.php">Profile</a></li>
                        <li> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historykontroltipekaryawan.php">Penyesuaian Tipe Karyawan</a></li>
                    </ul>
                    </li>
                </ul>
            </li> -->
            <!-- Stok Barang -->
            <li id="stok_barang">
                <a href="javascript:;"> <i class="material-icons">inventory</i> <span
                        class="title">Stok Barang</span> <span class=" arrow"></span> </a>
                <ul class="sub-menu">
                    <li id="sidebar_tambah_barang_baru"> <a href="/skripsi/apps/inventory/tambahbarang.php">Tambah Barang Baru</a></li>
                    <li id="sidebar_pembelian_stok"> <a href="/skripsi/apps/inventory/pembelianstok.php">Pembelian Stok</a></li>
                    <li id="sidebar_stok_barang"> <a href="/skripsi/apps/inventory/stokbarang.php">Stok Barang</a></li>
                </ul>
            </li>
            <!-- Laporan -->
            <li id="laporan">
                <a href="javascript:;"> <i class="material-icons">folder</i> <span
                        class="title">Laporan</span> <span class=" arrow"></span> </a>
                <ul class="sub-menu">
                    <!-- <li id="sidebar_history_master"> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historymaster.php">Distribusi</a></li>
                    <li id="sidebar_history_data_pegawai"> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historydatapegawai.php">Laba Rugi</a></li>
                    <li id="sidebar_history_data_pegawai"> <a href="/PTRutan/LEAPHRIS/kerjaan/history/historydatapegawai.php">Hotel</a></li> -->
                    <li id="sidebar_laporan_penghitungan_stok"> <a href="/skripsi/apps/laporan_stok/laporanstok.php">Penghitungan Stok</a></li>
                    <li id="sidebar_laporan_profile_tempat"> <a href="/skripsi/apps/profiletempat/listtempat.php">Profile Customer</a></li>
                </ul>
            </li>
            <!-- History -->
            <li id="history_log">
                <a href="javascript:;"> <i class="material-icons">history</i> <span
                        class="title">Riwayat</span> <span class=" arrow"></span> </a>
                <ul class="sub-menu">
                    <li id="sidebar_history_pengiriman"> <a href="/skripsi/apps/history_pengiriman/historypengiriman.php">Penjualan</a></li>
                    <li id="sidebar_history_pembelian"> <a href="/skripsi/apps/history_pembelian/historypembelian.php">Pembelian Stok</a></li>
                </ul>
            </li>
            <li id="master_page">
                <a href="javascript:;"> <i class="material-icons">perm_data_setting</i> <span
                        class="title">Master Data</span> <span class=" arrow"></span> </a>
                <ul class="sub-menu">
                    <li id="sidebar_history_master"> <a href="/skripsi/apps/masterpage/masterkategori.php">Master Kategori</a></li>
                </ul>
            </li>
            <!-- <li id="">
                <a href="javascript:;"> <i class="material-icons">shop</i> <span
                        class="title">Marketplace</span> <span class=" arrow"></span> </a>
                <ul class="sub-menu">
                    <li id="sidebar_history_master"> <a href="/skripsi/apps/marketplace/cobajdid.php">JD.ID</a></li>
                </ul>
            </li> -->
        </ul>
            <!-- END SIDEBAR MENU -->
    </div>
</div>
<a href="#" class="scrollup">Scroll</a>
<div class="footer-widget">
    <!-- <div class="progress transparent progress-small no-radius no-margin">
        <div class="progress-bar progress-bar-success animate-progress-bar" data-percentage="79%"
            style="width: 79%;"></div>
    </div> -->
    <div class="pull-right">
        <br>
        <br>
        <!-- <div class="details-status"> <span class="animate-number" data-value="100"
                data-animation-duration="560">100</span>% </div>
        <a href="#" name="Logout" id="Logout" class="Logout"><i name="Logout" id="Logout" class="material-icons Logout">power_settings_new</i>&nbsp;&nbsp;</a> -->
    </div>
</div>
<!-- END SIDEBAR -->