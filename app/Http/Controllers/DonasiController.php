<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index(){
        $donasi = Donasi::all();

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }

    public function store(Request $request){
        $rules = array(
            'judul' => 'required',
            'kategori' => 'required',
            'tingkatan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'target' => 'required',
            'nama_bank' => 'required',
            'no_rek' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json([
                'status' => 'error',
                'error' => $error->errors()->all()
            ]);
        }

        $data = array(
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'tingkatan' => $request->tingkatan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'target' => $request->target,
            'jumlah_kini' => 0,
            'status' => 'ongoing',
            'foto' => $request->foto,
            'nama_bank' => $request->nama_bank,
            'no_rek' => $request->no_rek,
        );

        $donasi = Donasi::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }

    public function show($id) {
        $donasi = Donasi::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }

    public function getDonasiByKategori($kategori){
        $donasi = Donasi::where('kategori', $kategori)->get();

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }

    public function getDonasiByTingkatan($tingkatan){
        $donasi = Donasi::where('tingkatan', $tingkatan)->get();

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }

    public function getDonasiPilihan(){
        $donasi = Donasi::where('status', 'ongoing')
                        ->limit(5)
                        ->orderBy('tgl_selesai')
                        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }
}
