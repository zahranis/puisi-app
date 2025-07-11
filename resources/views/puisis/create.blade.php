@extends('layouts.app')

@section('title', 'Tambah Puisi Baru')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white fs-5">
            <i class="bi bi-plus-circle me-1"></i> Tambah Puisi Baru
        </div>
        <div class="card-body">
            <form action="{{ route('puisis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                        name="judul" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Isi -->
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Puisi</label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="5" required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penulis -->
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                        name="penulis" value="{{ old('penulis') }}" required>
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Genre -->
                <div class="mb-3">
                    <label for="genre_id" class="form-label">Genre</label>
                    <select class="form-select @error('genre_id') is-invalid @enderror" id="genre_id" name="genre_id"
                        required>
                        <option value="">Pilih genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar (Opsional)</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                        name="gambar" accept="image/*">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="javascript:history.back()" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
