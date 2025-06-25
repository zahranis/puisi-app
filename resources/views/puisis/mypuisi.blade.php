@extends('layouts.app')

@section('title', 'Puisi Saya')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Puisi Saya</h2>
        <a href="{{ route('puisis.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Puisi
        </a>
    </div>

    <div class="table-responsive rounded border">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">#</th>
                    <th>Judul</th>
                    <th>Genre</th>
                    <th style="width: 200px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($puisis as $puisi)
                    <tr>
                        <td class="text-center">{{ $puisis->firstItem() + $loop->index }}</td>
                        <td>{{ $puisi->judul }}</td>
                        <td>{{ $puisi->genre->nama }}</td>
                        <td class="gap-2 text-center">
                            <a href="{{ route('puisis.show', $puisi->id) }}" class="btn btn-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('puisis.edit', $puisi->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('puisis.destroy', $puisi->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Hapus puisi ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">
                            <i class="bi bi-file-earmark-text fs-3 d-block mb-2"></i>
                            Belum ada puisi yang ditulis.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($puisis->hasPages())
        <div class="mt-4">
            {{ $puisis->links('pagination::bootstrap-5') }}
        </div>
    @endif
@endsection
