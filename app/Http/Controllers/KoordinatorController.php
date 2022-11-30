<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Koordinator::orderBy('created_at', 'desc')->get();
        return view('koordinator.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('koordinator.action', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'desc' => 'required',
            'title' => 'required'
        ]);

        Koordinator::create($data);
        return redirect('/koordinator')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Koordinator  $koordinator
     * @return \Illuminate\Http\Response
     */
    public function show(Koordinator $koordinator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Koordinator  $koordinator
     * @return \Illuminate\Http\Response
     */
    public function edit(Koordinator $koordinator)
    {
        $action = 'edit';
        return view('koordinator.action', compact('action', 'koordinator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Koordinator  $koordinator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Koordinator $koordinator)
    {
        $data =  $request->validate([
            'desc' => 'required',
            'title' => 'required'
        ]);

        $koordinator->update($data);
        return redirect('/koordinator')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Koordinator  $koordinator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Koordinator $koordinator)
    {
        $koordinator->delete();
        return redirect('/koordinator')->with('message', 'Data berhasil dihapus!');
    }
}