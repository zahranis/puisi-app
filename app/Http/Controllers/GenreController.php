<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect()->back()->with('error', 'Hanya admin yang dapat mengakses halaman ini');
        }

        $genres = Genre::latest()->get();
        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect()->back()->with('error', 'Hanya admin yang dapat mengakses halaman ini');
        }

        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect()->back()->with('error', 'Hanya admin yang dapat mengakses halaman ini');
        }

        $request->validate(['nama' => 'required|unique:genres']);
        Genre::create($request->all());
        return redirect()->route('genres.index')->with('success', 'Genre berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect()->back()->with('error', 'Hanya admin yang dapat mengakses halaman ini');
        }

        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect()->back()->with('error', 'Hanya admin yang dapat mengakses halaman ini');
        }

        $request->validate(['nama' => 'required|unique:genres,nama,' . $genre->id]);
        $genre->update($request->all());
        return redirect()->route('genres.index')->with('success', 'Genre berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect()->back()->with('error', 'Hanya admin yang dapat mengakses halaman ini');
        }
        
        $genre->delete();
        return back()->with('success', 'Genre berhasil dihapus!');
    }
}
