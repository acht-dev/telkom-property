<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.daily');
    }

    public function getDailyData(Request $request, Daily $daily)
    {
        $data = $daily->getData();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<a type="button" data-id="'.$data->uuid.'" data-toggle="modal" class="btn btn-success text-white btn-sm" id="editDailyData">Edit</a>
                    <a type="button" data-id="'.$data->uuid.'" data-toggle="modal" class="btn btn-danger text-white  btn-sm" id="deleteDailyData">Delete</a>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	
        Daily::updateOrCreate(['uuid' => $request->uuid],
        [   
            'nama_petugas' => $request->nama_petugas, 'area' => $request->area,
            'fm' => $request->fm,
        ]);   
        
        return response()->json(['error'=>'false', 'message' => 'Data berhasil ditambahkan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daily  $Daily
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $daily = Daily::where('uuid', $uuid)->first();
        return response()->json($daily);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daily  $Daily
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        Daily::where('uuid', $uuid)->delete();
        return response()->json(['error'=>'false', 'message' => 'Data berhasil dihapus']);
    }
}
