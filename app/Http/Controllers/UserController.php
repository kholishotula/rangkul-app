<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request){
        $rules = array(
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json([
                'status' => 'error',
                'error' => $error->errors()->all()
            ]);
        }

        $data = array(
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password
        );

        $user = User::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    public function show($id) {
        $user = User::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }
}
