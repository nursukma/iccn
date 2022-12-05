<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Timeline::orderBy('created_at', 'desc')->get();
        return view('timeline.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('timeline.action', compact('action'));
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
                'title' => 'required'
            ]);

            $image_path = $request->file('image')->store('image', 'public');

            $data = Timeline::create(['image' => $image_path, 'title' =>  $request->title]);
            return redirect('/timeline')->with('message', 'Data berhasil ditambahkan!');
        }
        return back()->with('warning', 'Silakan unggah gambar!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function show(Timeline $timeline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeline $timeline)
    {
        $action = 'edit';
        return view('timeline.action', compact('action', 'timeline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timeline $timeline)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required'
        ]);

        if ($request->file('image') == null) {
            $image_path = $timeline->image;
        } else {
            $image_exist = 'storage/' . $timeline->image;
            if (file_exists($image_exist))
                unlink($image_exist);

            $image_path = $request->file('image')->store('image', 'public');
        }

        $data = $timeline->update(['image' => $image_path, 'title' =>  $request->title]);
        // dd($data);
        return redirect('/timeline')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timeline $timeline)
    {
        $timeline->delete();
        return back()->with('message', 'Data berhasil dihapus!');
    }
}