<?php

namespace App\Http\Controllers;

use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.security');
    }

    public function getData(Request $request, Security $security)
    {
        $data = $security->getData();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<a type="button" data-id="'.$data->uuid.'" data-toggle="modal" class="btn btn-success text-white btn-sm" id="ediSecurityData">Edit</a>
                    <a type="button" data-id="'.$data->uuid.'" data-toggle="modal" class="btn btn-danger text-white  btn-sm" id="deleteSecurityData">Delete</a>';
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
	
        $path = '';
        
        $security = Security::updateOrCreate(['uuid' => $request->uuid],
        [   
            'employee_no' => '01',
            'nama' => $request->nama, 'status_pernikahan' => $request->status_kawin,
            'tanggal_masuk' => $request->tanggal_masuk, 'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender, 'agama' => $request->agama,
            'nama_client' => $request->nama_client, 'area' => $request->area,
            'kota' => $request->kota, 'FM' => $request->fm,
            'BM' => $request->bm, 'lokasi_kerja' => $request->lokasi_kerja,
            'posisi' => $request->posisi, 'jabatan_baru' => $request->jabatan_baru,
            'skill' => $request->skill, 'fungsi' => $request->fungsi,
            'mitra' => $request->mitra, 'nama_file_foto' => $path != '' ? $path : '',
        ]);   
        
        $image = $request->file('gambar');
        if($request->hasFile('gambar')){ 

            $_path = 'security/' . $security->uuid . '_' . $request->nama;
            Storage::disk('public')->delete($security->nama_file_foto);
            $path = Storage::disk('public')->put($_path, $image);

            $update = Security::find($security->id);
            $update->nama_file_foto = $path != '' ? $path : '';
            $update->save();
        }
   
        return response()->json(['error'=>'false', 'message' => 'Data berhasil ditambahkan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Security  $security
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $security = Security::where('uuid', $uuid)->first();
        return response()->json($security);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Security  $security
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        Security::where('uuid', $uuid)->delete();
        return response()->json(['error'=>'false', 'message' => 'Data berhasil dihapus']);
    }
}
