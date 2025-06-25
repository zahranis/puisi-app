@extends('layouts.app')

@section('title', $puisi->judul)

@section('content')
    <div class="row g-3">
        <div class="col-md-8">
            <div class="card mb-4 overflow-hidden">
                @if ($puisi->gambar)
                    <img src="{{ Storage::url($puisi->gambar) }}"
                        style="max-height: 400px; object-fit: cover; object-position: center center;">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $puisi->judul }}</h2>
                    <p class="text-muted">Oleh: {{ $puisi->penulis }} | Genre: {{ $puisi->genre->nama }}</p>
                    <p class="card-text">{!! nl2br($puisi->isi) !!}</p>
                </div>
                <div class="card-footer">
                    <a href="javascript:history.back()" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                            <small class="text-muted me-2">
                                @if ($komentar->created_at->gt(now()->subMinutes()))
                                Baru saja
                                @elseif ($komentar->created_at->gt(now()->subDay()))
                                    {{ $komentar->created_at->locale('id')->diffForHumans() }}
                                @else
                                    {{ $komentar->created_at->locale('id')->translatedFormat('l, d F Y H:i') }}
                                @endif
                            </small>

                            @auth
                                @if (auth()->id() === $komentar->user_id || auth()->user()->role === 'admin')
                                    <form action="{{ route('komentars.destroy', $komentar->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @empty
                        <p>Belum ada komentar</p>
                    @endforelse

                    <!-- Form Komentar -->
                    @auth
                        <form action="{{ route('komentars.store', $puisi->id) }}" method="POST" class="d-flex flex-column">
                            @csrf
                            <div class="mb-3">
                                <textarea name="isi" class="form-control" placeholder="Tulis komentar..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary align-self-end">Kirim</button>
                        </form>
                    @else
                        <div class="alert alert-info">
                            <a href="{{ route('login') }}">Login</a> untuk menambahkan komentar
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
