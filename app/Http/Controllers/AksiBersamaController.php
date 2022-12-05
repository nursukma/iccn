<?php

namespace App\Http\Controllers;

use App\Models\AksiBersama;
use App\Models\AksiBersamaItem;
use Illuminate\Http\Request;
use Response;

class AksiBersamaController extends Controller
{
    const itemData = ['title', 'image', 'link', 'aksi_bersama_id'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AksiBersama::orderBy('created_at', 'desc')->get();
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
        if ($request->file('image') != null) {
            $request->validate([
                'aksi_title' => 'required',
                'aksi_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $image_path = $request->file('aksi_image')->store('image', 'public');

            $data = AksiBersama::create(['desc' => $request->aksi_desc, 'title' =>  $request->aksi_title, 'image' => $image_path]);
            if (!$data) {
                return redirect('/aksi-bersama')->with('error', 'Terjadi kesalahan!');
            }
            return redirect('/aksi-bersama')->with('message', 'Data berhasil ditambahkan!');
        }
        return back()->with('warning', 'Silakan unggah gambar!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AksiBersama  $aksiBersama
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('image') == null) {
            $image_path = $aksiBersama->image;
        } else {
            $image_exist = 'storage/' . $aksiBersama->image;
            if (file_exists($image_exist))
                unlink($image_exist);

            $image_path = $request->file('image')->store('image', 'public');
        }

        $data = $aksiBersama->update(['desc' => $request->desc, 'title' =>  $request->title, 'image' => $image_path]);
        if (!$data) {
            return redirect('/aksi-bersama')->with('error', 'Terjadi kesalahan!');
        }
        return redirect('/aksi-bersama')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AksiBersama  $aksiBersama
     * @return \Illuminate\Http\Response
     */
    public function destroy(AksiBersama $aksiBersama)
    {
        $aksiBersama->delete();
        return redirect('/aksi-bersama')->with('message', 'Data berhasil dihapus!');
    }

    public function storeItem(Request $request, $id)
    {
        $dataItem = $request->only(self::itemData);

        $imageItem_path = $request->file('item_image')->store('image', 'public');
        $dataItem['image'] = $imageItem_path;
        $dataItem['aksi_besama_id'] = $id;

        $data = AksiBersamaItem::create(['title' => $dataItem['title'], 'link' => $dataItem['link'], 'image' => $dataItem['image'], 'aksi_bersama_id' => $id]);
        // dd($dataItem);
        return redirect('/aksi-bersama')->with('message', 'Data berhasil ditambahkan!');
    }

    public function detailAksi($id)
    {
        $data = AksiBersamaItem::where('aksi_bersama_id', $id)->orderBy('created_at', 'desc')->get();
        $arr = [];
        $no = 1;
        foreach ($data as $value) {
            $arr[] = [
                'no' => $no++,
                'id' => $value->id,
                'title' => $value->title,
                'link' => $value->link,
                'image' => $value->image,
                'aksi' => $value->id
            ];
        }
        return response()->json($arr);
    }

    public function deleteItem($id)
    {
        $data = AksiBersamaItem::findOrFail($id);
        $data->delete();
        return redirect('/aksi-bersama')->with('message', 'Data berhasil dihapus!');
    }

    public function updateItem(Request $request, $id)
    {
        $data = AksiBersamaItem::findOrFail($id);
        $dataItem = $request->only(self::itemData);

        if ($request->file('edit_item_image') == null) {
            $dataItem['image'] = $data->image;
        } else {
            $imageItem_path = $request->file('edit_item_image')->store('image', 'public');
            $dataItem['image'] = $imageItem_path;
        }
        $dataItem['aksi_besama_id'] = $id;

        $data->update(['title' => $dataItem['title'], 'link' => $dataItem['link'], 'image' => $dataItem['image']]);
        return redirect('/aksi-bersama')->with('message', 'Data berhasil diubah!');
    }

    public function getAksi($id)
    {
        $data = AksiBersamaItem::findOrFail($id);
        return response()->json($data);
    }
}