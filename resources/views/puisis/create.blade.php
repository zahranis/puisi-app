@extends('layouts.app')

@section('title', 'Tambah Puisi Baru')

@section('content')
    <div class="card">
        <div class="card-header">Tambah Puisi Baru</div>
        <div class="card-body">
            <form action="{{ route('puisis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Puisi</label>
                    <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" required>
                </div>
                <div class="mb-3">
                    <label for="genre_id" class="form-label">Genre</label>
                    <select class="form-select" id="genre_id" name="genre_id" required>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar (Opsional)</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
