<?php

namespace App\Http\Controllers;

use App\Models\PrinsipKota;
use Illuminate\Http\Request;

class PrinsipKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PrinsipKota::all();
        return view('prinsip_kota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('prinsip_kota.action', compact('action'));
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

        // $imageName = $request->image;

        $image_path = $request->file('image')->store('image', 'public');

        $data = PrinsipKota::create(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title]);
        return redirect('/prinsip-kota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'edit';
        $prinsip = PrinsipKota::findOrFail($id)->first();
        return view('prinsip_kota.action', compact('action', 'prinsip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prinsip = PrinsipKota::findOrFail($id)->first();

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required'
        ]);

        // $imageName = $request->image;

        if ($request->file('image') == null) {
            $image_path = $prinsip->image;
        } else {
            $image_path = $request->file('image')->store('image', 'public');
        }

        $data = $prinsip->update(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title]);
        // dd($data);
        return redirect('/prinsip-kota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prinsip = PrinsipKota::findOrFail($id)->first();
        $prinsip->delete();
        return back();
    }

    public function getPrinsip(Request $request)
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
        $totalRecords = PrinsipKota::select('count(*) as allcount')->count();
        $filter = PrinsipKota::query();
        $filter->when($searchValue, function ($query) use ($searchValue) {
            return $query->where('title', 'like', '%' . $searchValue . '%');
        });

        $totalRecordswithFilter = $filter->count();

        // Fetch records
        $query = PrinsipKota::query();
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
}