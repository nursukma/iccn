<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramItem;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    const itemData = ['title', 'image', 'link', 'program_id'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Program::orderBy('created_at', 'desc')->get();
        return view('program.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' => 'required'
        ]);

        $data = Program::create(['title' => $request->title, 'sub_title' =>  $request->sub_title]);
        if (!$data) {
            return redirect('/program')->with('error', 'Terjadi kesalahan!');
        }
        return redirect('/program')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'edit_title' => 'required'
        ]);

        $program->update(['title' => $request->edit_title, 'sub_title' =>  $request->edit_sub_title]);
        return redirect('/program')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect('/program')->with('message', 'Data berhasil dihapus!');
    }

    public function detailItem($id)
    {
        $data = ProgramItem::where('program_id', $id)->orderBy('created_at', 'desc')->get();
        return response()->json($data);
    }

    public function storeItem(Request $request, $id)
    {
        $dataItem = $request->only(self::itemData);

        $imageItem_path = $request->file('item_image')->store('image', 'public');
        $dataItem['image'] = $imageItem_path;
        $dataItem['program_id'] = $id;

        $data = ProgramItem::create(['title' => $dataItem['title'], 'link' => $dataItem['link'], 'image' => $dataItem['image'], 'program_id' => $id]);
        // dd($dataItem);
        return redirect('/program')->with('message', 'Data berhasil ditambahkan!');
    }
}