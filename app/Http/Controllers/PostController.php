<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\PostApiService;
use App\Http\Controllers\Services\UserApiService;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = new PostApiService();
        $posts = $posts->postsInfo();
        return view('home')->with('data', $posts);
    }
    public function showEditForm($id)
    {
        $post = new PostApiService();
        $post = $post->postInfo($id);
        return view('posts.edit_post')->with('data', $post);
    }
    public function show($id)
    {
        $post = new PostApiService();
        $post = $post->postInfo($id);
        
        return view('posts.post')->with('data', $post);
    }
    public function storeForm()
    {
        $user = new UserApiService();
        $user = $user->id(session('username'));
        return view('posts.post_create')->with('user', $user);
    }
    public function store(Request $request)
    {
        $user = new UserApiService();
        $user = $user->id(session('username'));
        try {
            Post::create([
                'title' => strtoupper($request->title),
                'content' => ucfirst($request->content),
                'author_id' => $user->original['data'][0]['id'],
                'author' => $user->original['data'][0]['name']
            ]);
        } catch (Exception $error) {
            echo $error;
        }
        return redirect()->route('posts.index');
    }
    public function update(Request $request)
    {
        try {
            Post::where('id', $request->id)->update([
                'title' => strtoupper($request->title),
                'content' => ucfirst($request->content)
            ]);
            return redirect()->route('posts.index');
        } catch (Exception $error) {
            echo $error;
        }

    }
    public function delete(Request $request)
    {
        try {
            Post::where('id', $request->id)->delete();
            return redirect()->route('posts.index');
        } catch (Exception $error) {
            echo $error;
        }

    }
}
