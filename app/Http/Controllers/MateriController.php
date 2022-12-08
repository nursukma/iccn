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
        if ($request->hasFile('image') && $request->hasFile('materi')) {
            $formatImage = $request->file('image')->getClientOriginalExtension();
            $formatFile = $request->file('materi')->getClientOriginalExtension();

            if (($formatImage == 'png' || $formatImage == 'jpg' || $formatImage == 'jpeg') && ($formatFile == 'doc' || $formatFile == 'docx' || $formatFile == 'pdf')) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'desc' => 'required',
                    'title' => 'required',
                    'materi' =>  'required|mimes:docx,doc,pdf|max:4096'
                ]);

                $image_path = $request->file('image')->store('image', 'public');
                $materi_path = $request->file('materi')->store('materi', 'public');

                Materi::create(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title, 'file' => $materi_path]);
                return redirect('/materi')->with('message', 'Data berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Format gambar/materi yang diunggah tidak sesuai!');
            }
        }
        return back()->with('warning', 'Silakan unggah gambar/materi!');
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
        if ($request->hasFile('image')) {
            $formatImage = $request->file('image')->getClientOriginalExtension();
            if ($formatImage == 'png' || $formatImage == 'jpg' || $formatImage == 'jpeg') {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048'
                ]);
            } else {
                return back()->with('error', 'Format gambar/materi yang diunggah tidak sesuai!');
            }
        }

        if ($request->hasFile('materi')) {
            $formatFile = $request->file('materi')->getClientOriginalExtension();
            if ($formatFile == 'doc' || $formatFile == 'docx' || $formatFile == 'pdf') {
                $request->validate([
                    'materi' => 'mimes:docx, doc, pdf|max:4096'
                ]);
            } else {
                return back()->with('error', 'Format gambar/materi yang diunggah tidak sesuai!');
            }
        }

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

        $materi->update(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title, 'file' => $materi_path]);
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