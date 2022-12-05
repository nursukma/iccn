<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Struktur::orderBy('created_at', 'desc')->get();
        return view('struktur.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('struktur.action', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image') != null) {
            $data = $request->validate([
                'nama' => 'required',
                'jabatan' => 'required',
                'periode' => 'required',
                'jabatan' => 'required',
                'image' =>  'image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $data['image'] = $request->file('image')->store('image', 'public');

            Struktur::create($data);
            return redirect('/struktur')->with('message', 'Data berhasil ditambahkan!');
        }
        return back()->with('warning', 'Silakan unggah gambar!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Struktur  $struktur
     * @return \Illuminate\Http\Response
     */
    public function show(Struktur $struktur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Struktur  $struktur
     * @return \Illuminate\Http\Response
     */
    public function edit(Struktur $struktur)
    {
        $action = 'edit';
        return view('struktur.action', compact('action', 'struktur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Struktur  $struktur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Struktur $struktur)
    {
        $data = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'periode' => 'required',
            'jabatan' => 'required',
            'image' =>  'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->file('image') == null) {
            $data['image'] = $struktur->image;
        } else {
            $image_exist = 'storage/' . $struktur->image;
            if (file_exists($image_exist))
                unlink($image_exist);

            $data['image'] = $request->file('image')->store('image', 'public');
        }

        if ($struktur->periode != $request->periode) {
            $up = Struktur::query()->update(['periode' => $request->periode]);
            if ($up) {
                $struktur->update($data);
            }
        } else {
            $struktur->update($data);
        }


        return redirect('/struktur')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Struktur  $struktur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Struktur $struktur)
    {
        $struktur->delete();
        return redirect('/struktur')->with('message', 'Data berhasil dihapus!');
    }

    public function getStruktur()
    {
        $struktur = Struktur::all();
        return response()->json($struktur);
    }
}