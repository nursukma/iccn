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
            $image_path = $request->file('image')->store('image', 'public');
        }

        $data = $slider->update(['link' => $request->link, 'image' => $image_path, 'title' =>  $request->title]);
        // dd($data);
        return redirect('/sliders');
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
        return back();
    }

    public function getSliders(Request $request)
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
        $totalRecords = Slider::select('count(*) as allcount')->count();
        $filter = Slider::query();
        $filter->when($searchValue, function ($query) use ($searchValue) {
            return $query->where('title', 'like', '%' . $searchValue . '%');
        });

        $totalRecordswithFilter = $filter->count();

        // Fetch records
        $query = Slider::query();
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
}