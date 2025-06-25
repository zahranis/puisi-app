@extends('layouts.app')

@section('title', 'Edit Genre')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (auth()->user()->role !== 'admin')
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-1"></i> Akses ditolak! Hanya admin yang bisa mengedit genre.
                    </div>
                @else
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-dark fs-5">
                            <i class="bi bi-pencil-square me-1"></i> Edit Genre: <strong>{{ $genre->nama }}</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('genres.update', $genre->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Genre</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $genre->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('genres.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="bi bi-check-circle me-1"></i> Update
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
