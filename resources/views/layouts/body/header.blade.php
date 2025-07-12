<header class="navbar navbar-expand-md d-print-none bg-white border-bottom" style="height: 80px; margin-bottom: 0; padding-top: 0; padding-bottom: 0;">
    <div class="container-fluid d-flex justify-content-end align-items-center px-4" style="height: 100%;">
        <!-- Foto profil di kanan -->
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm shadow-none"
                          style="background-image: url({{ Avatar::create(Auth::user()->name)->toBase64() }}); width: 40px; height: 40px;">
                    </span>
                    <div class="d-none d-xl-block ps-2 fw-semibold">
                        <div>{{ Auth::user()->name }}</div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Akun</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
