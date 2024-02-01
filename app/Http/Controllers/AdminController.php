<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Services\UserApiService;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function index(){
        $data = new UserApiService();
        $data = $data->users();
        return view('admin.manager')->with('data', $data);
    }
    public function update(Request $request){
        try {
            User::where('id', $request->id)->update([
                'role' => $request->role
            ]);
            return redirect()->route('admin.index');
        } catch (Exception $error) {
            echo $error;
        }
    }
    public function delete(Request $request){
        try {
            Post::where('author_id', $request->id)->delete();
            User::where('id', $request->id)->delete();
            return redirect()->route('admin.index');
        } catch (Exception $error) {
            echo $error;
        }
    }
}
