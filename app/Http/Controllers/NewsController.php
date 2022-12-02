<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = News::orderBy('created_at', 'desc')->get();
        return view('news.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('news.action', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // foreach (request()->file('quill_image') as $file) {
        //     dd($file)
        // }
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required',
            'penulis' => 'required'
        ]);

        $image_path = $request->file('image')->store('image', 'public');

        // if (request()->has('quill_image')) {
        //     foreach (request()->file('quill_image') as $file) {
        //         $file->store('news', 'public');
        //     }
        // }

        $data = News::create(
            [
                'desc' => $request->desc,
                'thumbnail' => $image_path,
                'title' =>  $request->title,
                'penulis' => $request->penulis
            ]
        );
        return redirect('/news')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $action = 'edit';
        return view('news.action', compact('action', 'news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required',
            'penulis' => 'required'
        ]);

        $image_path = $request->file('image')->store('image', 'public');
        $data = $news->update(
            [
                'desc' => $request->desc,
                'thumbnail' => $image_path,
                'title' =>  $request->title,
                'penulis' => $request->penulis
            ]
        );

        return redirect('/news')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect('/news')->with('message', 'Data berhasil dihapus!');
    }

    public function upImages(Request $request)
    {
        dd($request->file('quill_image'));
        $data = $request->file('quill_image')->store('news', 'public');
        return response()->json($data);
    }
}