<?php

namespace App\Http\Controllers;

use App\Models\PrinsipKota;
use Illuminate\Http\Request;

class PrinsipKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PrinsipKota::orderBy('created_at', 'desc')->get();
        return view('prinsip_kota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('prinsip_kota.action', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $formatFile = $request->file('image')->getClientOriginalExtension();
            if ($formatFile == 'png' || $formatFile == 'jpg' || $formatFile == 'jpeg') {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'desc' => 'required',
                    'title' => 'required'
                ]);

                $image_path = $request->file('image')->store('image', 'public');

                PrinsipKota::create(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title]);
                return redirect('/prinsip-kota')->with('message', 'Data berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Format gambar yang diunggah tidak sesuai!');
            }
        }
        return back()->with('warning', 'Silakan unggah gambar!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'edit';
        $prinsip = PrinsipKota::findOrFail($id);
        return view('prinsip_kota.action', compact('action', 'prinsip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prinsip = PrinsipKota::findOrFail($id);

        if ($request->hasFile('image')) {
            $formatFile = $request->file('image')->getClientOriginalExtension();
            if ($formatFile == 'png' || $formatFile == 'jpg' || $formatFile == 'jpeg') {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'desc' => 'required',
                    'title' => 'required'
                ]);

                $image_exist = 'storage/' . $prinsip->image;
                if (file_exists($image_exist))
                    unlink($image_exist);

                $image_path = $request->file('image')->store('image', 'public');
            } else {
                return back()->with('error', 'Format gambar yang diunggah tidak sesuai!');
            }
        } else {
            $request->validate([
                'desc' => 'required',
                'title' => 'required'
            ]);
            $image_path = $prinsip->image;
        }

        $prinsip->update(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title]);

        return redirect('/prinsip-kota')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prinsip = PrinsipKota::findOrFail($id);
        $prinsip->delete();
        return back()->with('message', 'Data berhasil dihapus!');
    }
}