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
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required'
        ]);

        // $imageName = $request->image;

        $image_path = $request->file('image')->store('image', 'public');

        $data = PrinsipKota::create(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title]);
        return redirect('/prinsip-kota');
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
        $prinsip = PrinsipKota::findOrFail($id)->first();
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
        $prinsip = PrinsipKota::findOrFail($id)->first();

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required'
        ]);

        if ($request->file('image') == null) {
            $image_path = $prinsip->image;
        } else {
            $image_exist = 'storage/' . $prinsip->image;
            if (file_exists($image_exist))
                unlink($image_exist);

            $image_path = $request->file('image')->store('image', 'public');
        }

        $data = $prinsip->update(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title]);
        // dd($data);
        return redirect('/prinsip-kota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prinsip = PrinsipKota::findOrFail($id)->first();
        $prinsip->delete();
        return back();
    }
}