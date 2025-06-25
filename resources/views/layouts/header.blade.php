<header class="bg-dark text-white p-3 sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="text-white text-decoration-none h4">Puisi App</a>

        <nav class="d-flex align-items-center gap-2 flex-wrap">
            @auth
                <!-- Menu untuk semua user -->
                <span class="mx-3">Welcome, <strong>{{ auth()->user()->name }}</strong></span>
                <a href="{{ route('puisis.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-journal-text me-1"></i> Puisi
                </a>
                <a href="{{ route('puisis.mypuisi') }}" class="btn btn-outline-light">
                    <i class="bi bi-person-lines-fill me-1"></i> Puisi Saya
                </a>

                <!-- Menu khusus admin -->
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('genres.index') }}" class="btn btn-outline-warning">
                        <i class="bi bi-tags me-1"></i> Genre
                    </a>
                @endif

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            @else
                <!-- Menu guest -->
                <a href="{{ route('login') }}" class="btn btn-outline-light">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light">
                    <i class="bi bi-person-plus me-1"></i> Register
                </a>
            @endauth
        </nav>
    </div>
</header>
