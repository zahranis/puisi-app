@extends('layouts.app')

@section('title', $puisi->judul)

@section('content')
    <div class="card mb-4">
        @if ($puisi->gambar)
            <img src="{{ Storage::url($puisi->gambar) }}" class="card-img-top">
        @endif
        <div class="card-body">
            <h2 class="card-title">{{ $puisi->judul }}</h2>
            <p class="text-muted">Oleh: {{ $puisi->penulis }} | Genre: {{ $puisi->genre->nama }}</p>
            <p class="card-text">{{ nl2br($puisi->isi) }}</p>
        </div>
    </div>

    <!-- Bagian Komentar -->
    <div class="card">
        <div class="card-header">
            <h5>Komentar</h5>
        </div>
        <div class="card-body">
            @forelse($puisi->komentars as $komentar)
                <div class="mb-3 border-bottom pb-3">
                    <strong>{{ $komentar->user->name }}</strong>
                    <p>{{ $komentar->isi }}</p>
                    <small class="text-muted">{{ $komentar->created_at->diffForHumans() }}</small>

                    @auth
                        @if (auth()->id() === $komentar->user_id || auth()->user()->role === 'admin')
                            <form action="{{ route('komentars.destroy', $komentar->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @endif
                    @endauth
                </div>
            @empty
                <p>Belum ada komentar</p>
            @endforelse

            <!-- Form Komentar -->
            @auth
                <form action="{{ route('komentars.store', $puisi->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="isi" class="form-control" placeholder="Tulis komentar..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            @else
                <div class="alert alert-info">
                    <a href="{{ route('login') }}">Login</a> untuk menambahkan komentar
                </div>
            @endauth
        </div>
    </div>
@endsection
