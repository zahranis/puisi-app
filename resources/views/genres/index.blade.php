@extends('layouts.app')

@section('title', 'Manajemen Genre')

@section('content')
    @if (auth()->user()->role !== 'admin')
        <div class="alert alert-danger">
            Akses ditolak! Hanya admin yang bisa mengelola genre.
        </div>
    @else
        <div class="d-flex justify-content-between mb-4">
            <h2>Daftar Genre</h2>
            <a href="{{ route('genres.create') }}" class="btn btn-primary">Tambah Genre</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Genre</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td>{{ $genre->nama }}</td>
                            <td>
                                <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus genre ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
