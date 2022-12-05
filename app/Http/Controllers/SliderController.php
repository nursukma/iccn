<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Response;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slider::orderBy('created_at', 'desc')->get();
        return view('sliders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('sliders.action', compact('action'));
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
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'link' => 'required',
                'title' => 'required'
            ]);

            $image_path = $request->file('image')->store('image', 'public');

            $data = Slider::create(['link' => $request->link, 'image' => $image_path, 'title' =>  $request->title]);
            // dd($data);
            return redirect('/sliders')->with('message', 'Data Berhasil ditambahkan!');
        }
        return back()->with('warning', 'Silakan unggah gambar!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $action = 'edit';
        return view('sliders.action', compact('action', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'required',
            'title' => 'required'
        ]);

        if ($request->file('image') == null) {
            $image_path = $slider->image;
        } else {
            $image_exist = 'storage/' . $slider->image;
            if (file_exists($image_exist))
                unlink($image_exist);

            $image_path = $request->file('image')->store('image', 'public');
        }

        $data = $slider->update(['link' => $request->link, 'image' => $image_path, 'title' =>  $request->title]);
        // dd($data);
        return redirect('/sliders')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return back()->with('message', 'Data berhasil dihapus!');
    }
}