<?php

namespace App\Http\Controllers;

use App\Models\Puisi;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request, Puisi $puisi)
    {
        $request->validate(['isi' => 'required|string']);

        $puisi->komentars()->create([
            'isi' => $request->isi,
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Komentar berhasil ditambah!');
    }

    public function destroy(Komentar $komentar)
    {
        $this->authorize('delete', $komentar);
        $komentar->delete();
        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}
