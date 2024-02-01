<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostApiService extends Controller
{
    public function postsInfo()
    {
        $post = Post::all();
        return response()->json([
            'status' => true,
            'data' => $post
        ]);
    }
    public function postInfo($id){
        $post = Post::where('id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $post
        ]);
    }
}
