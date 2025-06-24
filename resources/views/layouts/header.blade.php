<header class="bg-dark text-white p-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="text-white text-decoration-none h4">Puisi App</a>

        <nav class="d-flex align-items-center gap-3">
            @auth
                <!-- Menu untuk semua user -->
                <a href="{{ route('puisis.index') }}" class="text-white">Puisi</a>
                <a href="{{ route('puisis.mypuisi') }}" class="text-white">Puisi Saya</a>

                <!-- Menu khusus admin -->
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('genres.index') }}" class="text-white">Genre</a>
                @endif

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-white p-0">Logout</button>
                </form>
            @else
                <!-- Menu guest -->
                <a href="{{ route('login') }}" class="text-white">Login</a>
                <a href="{{ route('register') }}" class="text-white">Register</a>
            @endauth
        </nav>
    </div>
</header>
