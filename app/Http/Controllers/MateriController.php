<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Materi::orderBy('created_at', 'desc')->get();
        return view('materi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'add';
        return view('materi.action', compact('action'));
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
            'title' => 'required',
            'materi' =>  'required|mimes:docx,doc,pdf|max:4096'
        ]);

        // $imageName = $request->image;

        $image_path = $request->file('image')->store('image', 'public');
        $materi_path = $request->file('materi')->store('materi', 'public');

        $data = Materi::create(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title, 'file' => $materi_path]);
        return redirect('/materi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi)
    {
        $action = 'edit';
        return view('materi.action', compact('action', 'materi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        // dd($request->image);
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'title' => 'required',
            'materi' => 'mimes:docx, doc, pdf|max:4096'
        ]);

        if ($request->file('image') == null) {
            $image_path = $materi->image;
        } else {
            $image_path = $request->file('image')->store('image', 'public');
        }

        if ($request->file('materi') == null) {
            $materi_path = $materi->file;
        } else {
            $materi_path = $request->file('materi')->store('materi', 'public');
        }

        $data = $materi->update(['desc' => $request->desc, 'image' => $image_path, 'title' =>  $request->title, 'file' => $materi_path]);
        return redirect('/materi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        $materi->delete();
        return back();
    }

    public function getMateri(Request $request)
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
        $totalRecords = Materi::select('count(*) as allcount')->count();
        $filter = Materi::query();
        $filter->when($searchValue, function ($query) use ($searchValue) {
            return $query->where('title', 'like', '%' . $searchValue . '%');
        });

        $totalRecordswithFilter = $filter->count();

        // Fetch records
        $query = Materi::query();
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
            $materi = $record->file;

            $data_arr[] = array(
                "no" => $no++,
                "id" => $id,
                "title" => $title,
                "desc" => $desc,
                "image" => $image,
                "file" => $materi
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