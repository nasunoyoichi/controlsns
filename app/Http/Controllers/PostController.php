<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //全ての投稿を取得
    public function index()
    {
        $posts = Post::with('user')         //Post::with('user')でリレーション先のuserテーブルの情報も取得
        ->orderBy('created_at', 'desc')     //作成日で降順に並び替え
        ->get();                            //クエリの実行
        return response()->json($posts);    //取得したデータをJSON形式で返す
    }
}
