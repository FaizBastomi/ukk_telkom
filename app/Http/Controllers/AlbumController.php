<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('user')->get();
        return view('albums.index', compact('albums'));
    }
    public function create()
    {
        return view('albums.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $album = new Album([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi,
            'user_id' => auth()->id()
        ]);
        $album->save();
        return redirect()->route('albums.index')->with('success', 'Album has been created');
    }
    public function edit($id)
    {
        $album = Album::findOrFail($id);
        return view('albums.edit', compact('album'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $album = Album::findOrFail($id);
        $album->update([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('albums.index')->with('success', 'Album has been updated');
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album has been deleted');
    }
}
