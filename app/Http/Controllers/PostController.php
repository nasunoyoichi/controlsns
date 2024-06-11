<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //postsテーブルのデータを全て取得
    public function getPosts()
    {
        //最新のものを20件取得
        $posts = Post::latest()->take(20)->get();
        return response()->json($posts);
    }
}
