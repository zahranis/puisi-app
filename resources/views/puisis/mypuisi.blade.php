@extends('layouts.app')

@section('title', 'Puisi Saya')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h2>Puisi Saya</h2>
        <a href="{{ route('puisis.create') }}" class="btn btn-primary">Tambah Puisi</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Genre</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($puisis as $puisi)
                    <tr>
                        <td>{{ $puisi->judul }}</td>
                        <td>{{ $puisi->genre->nama }}</td>
                        <td>
                            <a href="{{ route('puisis.edit', $puisi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('puisis.destroy', $puisi->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus puisi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada puisi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
