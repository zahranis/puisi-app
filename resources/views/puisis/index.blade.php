@extends('layouts.app')

@section('title', 'Daftar Puisi')

@section('content')
    <div class="row">
        @foreach ($puisis as $puisi)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($puisi->gambar)
                        <img src="{{ Storage::url($puisi->gambar) }}" class="card-img-top" alt="{{ $puisi->judul }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $puisi->judul }}</h5>
                        <p class="card-text">{{ Str::limit($puisi->isi, 100) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('puisis.show', $puisi->id) }}" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
