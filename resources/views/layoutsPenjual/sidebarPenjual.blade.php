<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PENJUAL</div>
            </a>
            <hr class="sidebar-divider">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('penjual.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Produk -->
                <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduk"
            aria-expanded="true" aria-controls="collapseProduk">
            <i class="fas fa-box"></i>
            <span>Produk</span>
        </a>
        <div id="collapseProduk" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">PRODUK:</h6>
                <a class="collapse-item" href="{{ route('penjual.produk.index') }}">Kelola Produk</a>
                <a class="collapse-item" href="{{ route('penjual.produk.create') }}">Tambah Produk</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Pesanan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePesanan"
            aria-expanded="true" aria-controls="collapsePesanan">
            <i class="fas fa-shopping-cart"></i>
            <span>Pesanan</span>
        </a>
        <div id="collapsePesanan" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">PESANAN:</h6>
                <a class="collapse-item" href="{{ route('penjual.pesanan.lihat') }}">Daftar Pesanan</a>
                <a class="collapse-item" href="{{ route('penjual.pesanan.proses') }}">Pesanan Diproses</a>
                <a class="collapse-item" href="{{ route('penjual.pesanan.riwayat') }}">Riwayat Pesanan</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Pengiriman -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengiriman"
            aria-expanded="true" aria-controls="collapsePengiriman">
            <i class="fas fa-shipping-fast"></i>
            <span>Pengiriman</span>
        </a>
        <div id="collapsePengiriman" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">PENGIRIMAN:</h6>
                <a class="collapse-item" href="{{ route('penjual.pengiriman.index') }}">Daftar Pengiriman</a>
                <a class="collapse-item" href="{{ route('penjual.pengiriman.input-resi') }}">Input No. Resi</a>
                <a class="collapse-item" href="{{ route('penjual.pengiriman.riwayat') }}">Riwayat Pengiriman</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Ulasan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUlasan"
            aria-expanded="true" aria-controls="collapseUlasan">
            <i class="fas fa-comments"></i>
            <span>Ulasan</span>
        </a>
        <div id="collapseUlasan" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ULASAN:</h6>
                <a class="collapse-item" href="{{ route('penjual.ulasan.index') }}">Ulasan Produk</a>
                <a class="collapse-item" href="{{ route('penjual.ulasan.terbaru') }}">Ulasan Terbaru</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Profil -->

</ul>