<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\PostApiService;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(){
        $data = new PostApiService();
        $data = $data->postsInfo();
        return response()->view('rss',[
            'data' => $data
        ])->header('Content-Type', 'text/xml');
    }
}
