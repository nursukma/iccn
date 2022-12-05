<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Setting::orderBy('created_at', 'desc')->get();
        $up = Setting::first();
        return view('setting.index', compact('data', 'up'));
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
        $data = $request->validate([
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'alamat' => 'required',
            'whatsapp' => 'required',
            'instagram' => 'required',
            'email' => 'required',
            'nama_situs' => 'required'
        ]);

        // $image_path = $request->file('image')->store('setting', 'public');

        $input = [
            'nama_situs' => $data['nama_situs'],
            // 'image' => $image_path,
            'alamat' => $data['alamat'],
            'desc' => $data['desc'],
            'kontak' => [
                'whatsapp' => $data['whatsapp'],
                'instagram' => $data['instagram'],
                'email' => $data['email']
            ]
        ];

        Setting::create($input);
        return redirect('/setting')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'alamat' => 'required',
            'whatsapp' => 'required',
            'instagram' => 'required',
            'email' => 'required',
            'nama_situs' => 'required'
        ]);

        // $image_path = $request->file('image')->store('setting', 'public');

        $input = [
            'nama_situs' => $data['nama_situs'],
            // 'image' => $image_path,
            'alamat' => $data['alamat'],
            'desc' => $data['desc'],
            'kontak' => [
                'whatsapp' => $data['whatsapp'],
                'instagram' => $data['instagram'],
                'email' => $data['email']
            ]
        ];

        $setting->update($input);
        return redirect('/setting')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function upImages(Request $request)
    {
        $data = Setting::first();
        $resp = [
            "type" => "-",
            "status" => "-",
            "message" => ""
        ];

        try {
            if ($data == null) {
                $resp["type"] = "Create";

                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
                ]);

                $image_path = $request->file('image')->store('setting', 'public');
                Setting::create(['image' => $image_path]);


                $resp["message"] = "Gambar berhasil ditambahkan!";
            } else {
                $resp["type"] = "Update";

                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
                ]);

                $image_path = 'storage/' . $data->image;
                if (file_exists($image_path))
                    unlink($image_path);

                $image_path = $request->file('image')->store('setting', 'public');
                $data->update(['image' => $image_path]);


                $resp["message"] = "Gambar berhasil diubah!";
            }
            $resp['status'] = "Succes";
            return response()->json($resp);
        } catch (Throwable $e) {
            $resp["status"] = "Gagal";
            if ($resp['type'] == "Create") {
                $resp["message"] = "Gambar gagal ditambahkan!" . " " . json_encode($e->getMessage(), true);
            } else {
                $resp["message"] = "Gambar gagal diubah!" . " " . json_encode($e->getMessage(), true);
            }
            return response()->json($resp);
        }
    }
}