<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\UserDonasi;
use App\Models\User;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserDonasiController extends Controller
{
    public function store(Request $request){
        $rules = array(
            'userId' => 'required',
            'donasiId' => 'required',
            'nominal' => 'required',
            'metode' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json([
                'status' => 'error',
                'error' => $error->errors()->all()
            ]);
        }

        $data = array(
            'userId' => $request->userId,
            'donasiId' => $request->donasiId,
            'nominal' => $request->nominal,
            'metode' => $request->metode,
            'waktu_donasi' => Carbon::now()
        );

        $userDonasi = UserDonasi::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $userDonasi,
        ], 200);
    }

    public function getDaftarDonatur($donasiId){
        $userDonasi = UserDonasi::where('donasiId', $donasiId)
                                ->join('users', 'user_donasis.userId', 'users.id')
                                ->get();

        return response()->json([
            'status' => 'success',
            'data' => $userDonasi,
        ], 200);
    }

    public function getDaftarDonasi($userId){
        $userDonasi = UserDonasi::where('userId', $userId)
                                ->join('donasis', 'user_donasis.donasiId', 'donasis.id')
                                ->get();

        return response()->json([
            'status' => 'success',
            'data' => $userDonasi,
        ], 200);
    }
}
