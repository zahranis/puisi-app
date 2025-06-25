@extends('layouts.app')

@section('title', 'Manajemen Genre')

@section('content')
    @if (auth()->user()->role !== 'admin')
        <div class="alert alert-danger">
            Akses ditolak! Hanya admin yang bisa mengelola genre.
        </div>
    @else
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Daftar Genre</h2>
            <a href="{{ route('genres.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Genre
            </a>
        </div>

        <div class="table-responsive rounded border">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nama Genre</th>
                        <th style="width: 150px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td class="text-center">{{ $genres->firstItem() + $loop->index }}</td>
                            <td>{{ $genre->nama }}</td>
                            <td class="text-center gap-2">
                                <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Hapus genre ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($genres->hasPages())
            <div class="mt-4">
                {{ $genres->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @endif
@endsection
