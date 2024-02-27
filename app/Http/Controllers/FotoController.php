<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::with(['album', 'user'])->get();
        return view('fotos.index', compact('fotos'));
    }
    public function create()
    {
        $albums = Album::all();
        return view('fotos.create', compact('albums'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul_foto' => 'required|string|max:255',
            'deskripsi_foto' => 'nullable|string',
            'lokasi_file' => 'required|image|max:2048',
            'album_id' => 'required|exists:gallery_album,album_id'
        ]);
        $path = $request->file('lokasi_file')->store('public/fotos');

        Foto::create([
            'judul_foto' => $request->judul_foto,
            'deskripsi_foto' => $request->deskripsi_foto,
            'lokasi_file' => $path,
            'album_id' => $request->album_id,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('foto.index')->with('success', 'Foto has been added');
    }
    public function show($id)
    {
        $foto = Foto::with(['album', 'user', 'komentars.user'])->findOrFail($id);
        return view('fotos.show', compact('foto'));
    }
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
        // try deleting from disk
        Storage::delete($foto->lokasi_file);
        // delete from db
        $foto->delete();

        return back()->with('success', 'Foto has been deleted');
    }
}
