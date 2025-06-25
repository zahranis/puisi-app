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

        return back();
    }

    public function destroy(Komentar $komentar)
    {
        if (auth()->id() !== $komentar->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $komentar->delete();
        return back();
    }
}
