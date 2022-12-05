<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Materi::orderBy('created_at', 'desc')->get();
        return view('materi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('materi.action', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required',
            'materi' =>  'required|mimes:docx,doc,pdf|max:4096'
        ]);

        // $imageName = $request->image;

        $image_path = $request->file('image')->store('image', 'public');
        $materi_path = $request->file('materi')->store('materi', 'public');

        $data = Materi::create(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title, 'file' => $materi_path]);
        return redirect('/materi')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi)
    {
        $action = 'edit';
        return view('materi.action', compact('action', 'materi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        // dd($request->image);
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required',
            'materi' => 'mimes:docx, doc, pdf|max:4096'
        ]);

        if ($request->file('image') == null) {
            $image_path = $materi->image;
        } else {
            $image_exist = 'storage/' . $materi->image;
            if (file_exists($image_exist))
                unlink($image_exist);

            $image_path = $request->file('image')->store('image', 'public');
        }

        if ($request->file('materi') == null) {
            $materi_path = $materi->file;
        } else {
            $file_exist = 'storage/' . $materi->image;
            if (file_exists($file_exist))
                unlink($file_exist);

            $materi_path = $request->file('materi')->store('materi', 'public');
        }

        $data = $materi->update(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title, 'file' => $materi_path]);
        return redirect('/materi')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        $materi->delete();
        return back()->with('message', 'Data berhasil dihapus!');
    }
}