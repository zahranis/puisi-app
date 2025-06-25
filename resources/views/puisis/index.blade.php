@extends('layouts.app')

@section('title', 'Daftar Puisi')

@section('content')
    <div class="row mb-5">
        @forelse ($puisis as $puisi)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm overflow-hidden">
                    @if ($puisi->gambar)
                        <img src="{{ Storage::url($puisi->gambar) }}"
                            style="max-height: 200px; object-fit: cover; object-position: center center;"
                            alt="{{ $puisi->judul }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $puisi->judul }}</h5>
                        <p class="card-text text-muted">Oleh: {{ $puisi->penulis }}</p>
                        <p class="card-text">{{ Str::limit($puisi->isi, 50) }}...</p>
                        <div class="mt-auto">
                            <a href="{{ route('puisis.show', $puisi->id) }}" class="btn btn-outline-primary">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <h4 class="mb-3"><i class="bi bi-book"></i> Belum Ada Puisi</h4>
                    <p class="mb-0">Tidak ada puisi yang tersedia saat ini.</p>
                    @auth
                        <a href="{{ route('puisis.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Buat Puisi Pertamamu
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse
    </div>

    @if ($puisis->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $puisis->links('pagination::bootstrap-4') }}
        </div>
    @endif
@endsection
