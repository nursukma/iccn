<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = About::orderBy('created_at', 'desc')->get();
        return view('about.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('about.action', compact('action'));
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

        $image_path = $request->file('image')->store('image', 'public');

        $data = About::create(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title]);
        return redirect('/about')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        $action = 'edit';
        return view('about.action', compact('action', 'about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required'
        ]);

        if ($request->file('image') == null) {
            $image_path = $about->image;
        } else {
            $image_exist = 'storage/' . $about->image;
            if (file_exists($image_exist))
                unlink($image_exist);

            $image_path = $request->file('image')->store('image', 'public');
        }

        $data = $about->update(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title]);
        return redirect('/about')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $about->delete();
        return back()->with('message', 'Data berhasil dihapus!');
    }
}