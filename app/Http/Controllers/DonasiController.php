<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{
    public function index(){
        $donasi = Donasi::select(array('donasis.*', DB::raw("DATE_PART('day', tgl_selesai, tgl_mulai) AS sisa_hari")))->get();

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
        $donasi = Donasi::where('id', $id)->select(array('donasis.*', DB::raw("DATE_PART('day', tgl_selesai, tgl_mulai) AS sisa_hari")))->get();

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }

    public function getDonasiByKategori($kategori){
        $donasi = Donasi::where('kategori', $kategori)->select(array('donasis.*', DB::raw("DATE_PART('day', tgl_selesai, tgl_mulai) AS sisa_hari")))->get();

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }

    public function getDonasiByTingkatan($tingkatan){
        $donasi = Donasi::where('tingkatan', $tingkatan)->select(array('donasis.*', DB::raw("DATE_PART('day', tgl_selesai, tgl_mulai) AS sisa_hari")))->get();

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }

    public function getDonasiPilihan(){
        $donasi = Donasi::where('status', 'ongoing')
                        ->limit(5)
                        ->orderBy('tgl_selesai')
                        ->select(array('donasis.*', DB::raw("DATE_PART('day', tgl_selesai, tgl_mulai) AS sisa_hari")))->get();

        return response()->json([
            'status' => 'success',
            'data' => $donasi,
        ], 200);
    }
}
