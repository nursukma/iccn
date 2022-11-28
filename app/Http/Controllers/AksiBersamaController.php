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
        $request->validate([
            'aksi_desc' => 'required',
            'aksi_title' => 'required',
            'aksi_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image_path = $request->file('aksi_image')->store('image', 'public');

        $data = AksiBersama::create(['desc' => $request->aksi_desc, 'title' =>  $request->aksi_title, 'image' => $image_path]);
        if (!$data) {
            return redirect('/aksi-bersama')->with('error', 'Terjadi kesalahan!');
        }
        return redirect('/aksi-bersama')->with('message', 'Data berhasil ditambahkan!');
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
            'desc' => 'required',
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('image') == null) {
            $image_path = $aksiBersama->image;
        } else {
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

    public function getAksiBersama(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = AksiBersama::select('count(*) as allcount')->count();
        $filter = AksiBersama::query();
        $filter->when($searchValue, function ($query) use ($searchValue) {
            return $query->where('title', 'like', '%' . $searchValue . '%');
        });

        $totalRecordswithFilter = $filter->count();

        // Fetch records
        $query = AksiBersama::query();
        $query->when($searchValue, function ($query) use ($searchValue) {
            return $query->where('title', 'like', '%' . $searchValue . '%');
        });
        $records = $query->orderBy('id', 'desc')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $no = $start + 1;
        foreach ($records as $record) {
            $id = $record->id;
            $title = $record->title;
            $desc = $record->desc;
            $image = $record->image;

            $data_arr[] = array(
                "no" => $no++,
                "id" => $id,
                "title" => $title,
                "desc" => $desc,
                "image" => $image
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    public function detailItem(Request $request, $id)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = AksiBersamaItem::select('count(*) as allcount')->where('aksi_bersama_id', $id)->count();
        $filter = AksiBersamaItem::query();
        $filter->when($searchValue, function ($query) use ($searchValue) {
            return $query->where('title', 'like', '%' . $searchValue . '%');
        });

        $totalRecordswithFilter = $filter->count();

        // Fetch records
        $query = AksiBersamaItem::query();
        $query->when($searchValue, function ($query) use ($searchValue) {
            return $query->where('title', 'like', '%' . $searchValue . '%');
        });
        $records = $query->orderBy('id', 'desc')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $no = $start + 1;
        foreach ($records as $record) {
            $id = $record->id;
            $title = $record->title;
            $link = $record->link;
            $image = $record->image;

            $data_arr[] = array(
                "no" => $no++,
                "id" => $id,
                "title" => $title,
                "link" => $link,
                "image" => $image
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    public function detailAksi($id)
    {
        $data = AksiBersamaItem::where('aksi_bersama_id', $id)->orderBy('created_at', 'desc')->get();
        return response()->json($data);
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
}