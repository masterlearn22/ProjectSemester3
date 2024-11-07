<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ route('profile.index') }}" class="nav-link">
                <div class="nav-profile-image">

                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="profile" />
                    @else
                        <img src="{{ asset('assets/images/faces/default.jpg') }}" />
                    @endif
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="mb-2 font-weight-bold">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="text-secondary text-small">
                        {{ Auth::user()->jenisUser->JENIS_USER }}
                    </span>
                </div>
                <i class="mdi mdi-minecraft nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item ">
            <span class="nav-link">
                <h1 class="menu-title">Menu {{ Auth::user()->jenisUser->JENIS_USER }}</h1>
            </span>
        </li>

        @if (in_array(Auth::user()->ID_JENIS_USER, [3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <span class="menu-title">Dashboard admin</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jenis_user.index') }}">
                    <span class="menu-title">Daftar Role</span>
                    <i class="mdi mdi-firefox menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [3]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kategori.index') }}">
                    <span class="menu-title">Daftar Buku</span>
                    <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menu.dashboard') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [2, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ url('tambahbuku') }}">
                    <span class="menu-title">Tambah buku</span>
                    <i class="mdi mdi-account-access menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 4]))
            <li class="nav-item">
                <a class="nav-link" href="bacabuku">
                    <span class="menu-title">Buku Bacaan</span>
                    <i class="menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mahasiswa.index') }}">
                    <span class="menu-title">Data Mahasiswa</span>
                    <i class="mdi mdi-human-male-female menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menu.index') }}">
                    <span class="menu-title">Manajemen Menu</span>
                    <i class="mdi mdi-security menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="/infogempa">
                    <span class="menu-title">Info Gempa</span>
                    <i class="mdi mdi-gnome menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('postings.index') }}">
                    <span class="menu-title">Posting</span>
                    <i class="mdi mdi-folder-multiple-image menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('chats.index') }}">
                    <span class="menu-title">Chat Global</span>
                    <i class="mdi mdi-facebook-messenger menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('messages.index') }}">
                    <span class="menu-title">Email</span>
                    <i class="mdi mdi-email menu-icon"></i>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#sidebar-layouts" aria-expanded="false"
                aria-controls="sidebar-layouts">
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-playlist-play menu-icon"></i>
            </a>
            <div class="collapse" id="sidebar-layouts" style="">
                <ul class="nav flex-column sub-menu">
                    @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('emiten.index') }}">
                                <span class="menu-title">Emiten</span>
                                <i class="mdi mdi-email menu-icon"></i>
                            </a>
                        </li>
                    @endif
                    @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transaksi_harian.index') }}">
                                <span class="menu-title">Transaksi Harian</span>
                                <i class="mdi mdi-email menu-icon"></i>
                            </a>
                        </li>
                    @endif

                    @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grafik.index') }}">
                                <span class="menu-title">Grafik Transaksi</span>
                                <i class="mdi mdi-email menu-icon"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <span class="nav-link">
                <hr>
                <h6 class="menu-title">Menu Tambahan</h6>
                @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
                    @php
                        // Ambil semua menu yang diizinkan untuk user dengan ID_JENIS_USER tertentu
                        $allowedMenus = DB::table('SETTING_MENU_USER')
                            ->join('menu', 'SETTING_MENU_USER.MENU_ID', '=', 'menu.MENU_ID') // Join dengan tabel menu
                            ->where('SETTING_MENU_USER.ID_JENIS_USER', Auth::user()->ID_JENIS_USER) // Cek role user yang login
                            ->whereNull('menu.DELETE_MARK') // Pastikan menu aktif (tidak dihapus)
                            ->select('menu.*') // Pilih semua data dari tabel menu
                            ->get();
                    @endphp

                    @foreach ($allowedMenus as $menu)
        <li class="nav-item">
            <a class="nav-link" href="{{ url($menu->MENU_LINK) }}">
                <span class="menu-title">{{ $menu->MENU_NAME }}</span>
                <i class="{{ $menu->MENU_ICON }} menu-icon"></i>
            </a>
        </li>
        @endforeach
        @endif
        </span>
        </li>
    </ul>
</nav>
