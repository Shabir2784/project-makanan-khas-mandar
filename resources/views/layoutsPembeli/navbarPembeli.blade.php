<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Toko makanan Khas Mandar</a>

        <form class="d-flex" method="GET" action="{{ route('pembeli.produk.cari') }}">
            <input class="form-control me-2" type="search" placeholder="Cari makanan..." name="q">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pembeli.keranjang') }}">
                    <i class="fas fa-shopping-cart me-1"></i> Keranjang
                </a>
            </li>

            {{-- User dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-2 text-dark">{{ Auth::user()->nama ?? 'Pembeli' }}</span>
                    <img class="rounded-circle" src="{{ asset('admin/img/undraw_profile.svg') }}" width="32" height="32" alt="Profil">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow mt-2">
                    <li><a class="dropdown-item" href="{{ route('pembeli.profil') }}"><i class="fas fa-user me-2 text-muted"></i> Profile</a></li>

                    @if (Auth::user()->role === 'pembeli')
                        <li>
                            <a class="dropdown-item" href="{{ route('pembeli.pesanan') }}">
                                <i class="fas fa-clipboard-list me-2 text-muted"></i> Pesanan Saya
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('pembeli.formPenjual') }}">
                                <i class="fas fa-store me-2 text-muted"></i> Daftar Sebagai Penjual
                            </a>
                        </li>
                    @endif

                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fas fa-sign-out-alt me-2 text-muted"></i> Keluar
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
