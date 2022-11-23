<?php

namespace App\Http\Controllers;

use App\Models\Berita;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index() {
        $data = Berita::orderBy('created_at', 'desc')->get();
        return view ('news.index', compact('data'));
    }

    public function create() {
        $action = 'add';
        return view ('news.action', compact('action'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required', 
            'deskripsi' => 'required', 
            'image' => 'required', 
            'date' => 'required', 
            'penulis' => 'required'
        ]);

        $image_path = $request->file('image')->store('image', 'public');

        $data = Berita::create(['link' => $request->link, 'image' => $image_path, 'title' => $request->title]);
        return redirect('/berita')->with('message', 'Data berhasil Ditambahkan');
    }

    public function show() {
        
    }

    public function edit() {
        $action = 'edit';
        return view('news.action', compact('action', 'berita'));
    }

    public function update() {

    }

    public function destroy(Berita $berita) {
        $berita->delete();
        return back();
    }
}
