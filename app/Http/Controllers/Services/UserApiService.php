<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserApiService extends Controller
{
    public function users(){
        $data = User::all();
        return response()->json([
            'data'=>$data
        ]);
    }
    public function id($username)
    {
        $data = User::where('name', $username)->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
