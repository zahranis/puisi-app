@extends('layouts.app')

@section('title', 'Tambah Genre Baru')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (auth()->user()->role !== 'admin')
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-1"></i> Akses ditolak! Hanya admin yang bisa menambah genre.
                    </div>
                @else
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white fs-5">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Genre Baru
                        </div>
                        <div class="card-body">
                            <form action="{{ route('genres.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Genre</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Contoh: Puisi Cinta" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('genres.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
