<?php

namespace App\Http\Controllers;

use App\Models\AksiBersama;
use App\Models\AksiBersamaItem;
use Illuminate\Http\Request;

class AksiBersamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AksiBersama::all();
        return view('aksi_bersama.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('aksi_bersama.action', compact('action'));
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
            'desc' => 'required',
            'title' => 'required'
        ]);

        // $imageName = $request->image;

        $image_path = $request->file('image')->store('image', 'public');

        $data = AksiBersama::create(['desc' => $request->desc, 'title' =>  $request->title]);
        if ($data) {
            AksiBersamaItem::create(['link' => $request->desc, 'title' =>  $request->title, 'image' => $image_path, 'aksi_bersama_id' => $data->id]);
        }
        return redirect('/aksi-bersama');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AksiBersama  $aksiBersama
     * @return \Illuminate\Http\Response
     */
    public function show(AksiBersama $aksiBersama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AksiBersama  $aksiBersama
     * @return \Illuminate\Http\Response
     */
    public function edit(AksiBersama $aksiBersama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AksiBersama  $aksiBersama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AksiBersama $aksiBersama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AksiBersama  $aksiBersama
     * @return \Illuminate\Http\Response
     */
    public function destroy(AksiBersama $aksiBersama)
    {
        //
    }
}