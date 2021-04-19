<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataApar;

class DataAparController extends Controller
{
    public function index()
    {
        return view('pages.apar');
    }

    public function getAparData(Request $request, DataApar $dataApar)
    {
        $data = $dataApar->getData();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<a type="button" data-id="'.$data->uuid.'" data-toggle="modal" class="btn btn-success text-white btn-sm" id="editAparData">Edit</a>
                    <a type="button" data-id="'.$data->uuid.'" data-toggle="modal" class="btn btn-danger text-white  btn-sm" id="deleteAparData">Delete</a>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
	
        DataApar::updateOrCreate(['uuid' => $request->uuid],
        [   
            'nama_petugas' => $request->nama_petugas, 'area' => $request->area,
            'fm' => $request->fm,
        ]);   
        
        return response()->json(['error'=>'false', 'message' => 'Data berhasil ditambahkan']);
    }

    public function edit($uuid)
    {
        $apar = DataApar::where('uuid', $uuid)->first();
        return response()->json($apar);
    }

    public function destroy($uuid)
    {
        DataApar::where('uuid', $uuid)->delete();
        return response()->json(['error'=>'false', 'message' => 'Data berhasil dihapus']);
    }
}
