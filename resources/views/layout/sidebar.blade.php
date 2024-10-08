<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <div class="nav-profile-image">

                    @if (Auth::user()->ID_JENIS_USER == 4)
                        <img src="../assets/images/faces/photo4.jpg" alt="profile" />
                    @elseif (Auth::user()->ID_JENIS_USER == 3)
                        <img src="../assets/images/faces/photo3.jpg" alt="profile" />
                    @elseif (Auth::user()->ID_JENIS_USER == 2)
                        <img src="../assets/images/faces/photo2.jpg" alt="profile" />
                    @elseif (Auth::user()->ID_JENIS_USER == 1)
                        <img src="../assets/images/faces/photo1.jpg" alt="profile" />
                    @endif
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="mb-2 font-weight-bold">
                        {{ session('name') }}
                    </span>
                    <span class="text-secondary text-small">{{ session('JENIS_USER') }}

                    </span>

                </div>
                <i class="mdi mdi mdi-minecraft nav-profile-badge"></i>
            </a>
        </li>

        <li class="nav-item ">
            <span class="nav-link">
                @if (Auth::user()->ID_JENIS_USER == 4)
                    <h6 class="menu-title">Menu Kapten</h6>
                @elseif (Auth::user()->ID_JENIS_USER == 3)
                    <h6 class="menu-title">Menu Admin</h6>
                @elseif (Auth::user()->ID_JENIS_USER == 2)
                    <h6>Menu Mahasiswa</h6>
                @elseif (Auth::user()->ID_JENIS_USER == 1)
                    <h6>Menu User</h6>
                @endif
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
                    <i class="mdi mdi-home menu-icon"></i>
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
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2,4]))
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
                    <i class="mdi mdi mdi-human-male-female menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menu.index') }}">
                    <span class="menu-title">Manajemen Menu</span>
                    <i class="mdi mdi mdi-security menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="/infogempa">
                    <span class="menu-title">Info Gempa</span>
                    <i class="mdi mdi mdi-gnome menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('postings.index') }}">
                    <span class="menu-title">Posting</span>
                    <i class="mdi mdi mdi-gnome menu-icon"></i>
                </a>
            </li>
        @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('chats.index') }}">
                <span class="menu-title">Chat Global</span>
                <i class="mdi mdi mdi-gnome menu-icon"></i>
            </a>
        </li>
    @endif
        @if (in_array(Auth::user()->ID_JENIS_USER, [1, 2, 3, 4]))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('messages.index') }}">
                    <span class="menu-title">Email</span>
                    <i class="mdi mdi mdi-email menu-icon"></i>
                </a>
            </li>
        @endif
        @if (isset($message))
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('messages.show', ['message' => $message->message_id]) }}">
                    <span class="menu-title">Inbox</span>
                    <i class="mdi mdi mdi-gnome menu-icon"></i>
                </a>
            </li>
        </ul>
        @endif


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
            <a class="nav-link" href="{{ route($menu->MENU_LINK) }}">
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
