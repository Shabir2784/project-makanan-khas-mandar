<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN</div>
    </a>
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">INTERFACE</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduk">
            <i class="fas fa-box"></i>
            <span>Produk</span>
        </a>
        <div id="collapseProduk" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Produk</h6>
                <a class="collapse-item" href="{{ route('admin.produk.index') }}">Kelola Produk</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengguna">
            <i class="fas fa-user"></i>
            <span>Pengguna</span>
        </a>
        <div id="collapsePengguna" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengguna</h6>
                <a class="collapse-item" href="{{ route('admin.pengguna.index') }}">Kelola Pengguna</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVerifikasi">
            <i class="fas fa-user-check"></i>
            <span>Verifikasi</span>
        </a>
        <div id="collapseVerifikasi" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Verifikasi</h6>
                <a class="collapse-item" href="{{ route('admin.verifikasi.penjual') }}">Verifikasi Penjual</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePembayaran">
            <i class="fas fa-credit-card"></i>
            <span>Pembayaran</span>
        </a>
        <div id="collapsePembayaran" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item" href="{{ route('admin.pembayaran.index') }}">Lihat Pembayaran</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi">
            <i class="fas fa-exchange-alt"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseTransaksi" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item" href="{{ route('admin.transaksi.index') }}">Lihat Transaksi</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan">
            <i class="fas fa-chart-line"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan</h6>
                <a class="collapse-item" href="{{ route('admin.laporan') }}">Laporan Penjualan</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUlasan">
            <i class="fas fa-comments"></i>
            <span>Ulasan</span>
        </a>
        <div id="collapseUlasan" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Ulasan</h6>
                <a class="collapse-item" href="{{ route('admin.ulasan') }}">Moderasi Komentar</a>
            </div>
        </div>
    </li>
</ul>


  

