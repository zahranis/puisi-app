<?php

namespace App\Http\Controllers;

use App\Models\Puisi;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PuisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $puisis = Puisi::with(['user', 'genre'])
            ->paginate(15);
        return view('puisis.index', compact('puisis'));
    }

    public function my()
    {
        $puisis = Puisi::with(['user', 'genre'])
            ->where('user_id', Auth::id())
            ->paginate(25);

        return view('puisis.mypuisi', compact('puisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('puisis.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'penulis' => 'required',
            'genre_id' => 'required|exists:genres,id',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('puisi-images', 'public');
        }

        $data['user_id'] = auth()->id();
        Puisi::create($data);

        return redirect()->route('puisis.mypuisi')->with('success', 'Puisi berhasil ditambah!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Puisi $puisi)
    {
        return view('puisis.show', compact('puisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puisi $puisi)
    {
        if (auth()->id() !== $puisi->user_id) {
            abort(403);
        }
        $genres = Genre::all();
        return view('puisis.edit', compact('puisi', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puisi $puisi)
    {
        if (auth()->id() !== $puisi->user_id) {
            abort(403);
        }

        $data = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'penulis' => 'required',
            'genre_id' => 'required|exists:genres,id',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($puisi->gambar) Storage::delete($puisi->gambar);
            $data['gambar'] = $request->file('gambar')->store('puisi-images', 'public');
        }

        $puisi->update($data);
        return redirect()->route('puisis.mypuisi')->with('success', 'Puisi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puisi $puisi)
    {
        if (auth()->id() !== $puisi->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        if ($puisi->gambar && Storage::disk('public')->exists($puisi->gambar)) Storage::disk('public')->delete($puisi->gambar);
        $puisi->delete();
        return back()->with('success', 'Puisi berhasil dihapus!');
    }
}
