@extends('layouts.app')

@section('title', 'Edit Puisi')

@section('content')
    <div class="card">
        <div class="card-header bg-warning text-dark fs-5">
            <i class="bi bi-pencil-square me-1"></i> Edit Puisi: <strong>{{ $puisi->judul }}</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('puisis.update', $puisi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                        name="judul" value="{{ old('judul', $puisi->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Isi Puisi -->
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Puisi</label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="5" required>{{ old('isi', $puisi->isi) }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penulis -->
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                        name="penulis" value="{{ old('penulis', $puisi->penulis) }}" required>
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
                            <option value="{{ $genre->id }}"
                                {{ old('genre_id', $puisi->genre_id) == $genre->id ? 'selected' : '' }}>
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

                    @if ($puisi->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $puisi->gambar) }}" alt="Gambar Puisi"
                                style="max-height: 150px;" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-between">
                    <a href="javascript:history.back()" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
