<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //postsテーブルのデータを全て取得
    public function getPosts()
    {
        $posts = Post::all();
        return response()->json($posts);
    }
}
