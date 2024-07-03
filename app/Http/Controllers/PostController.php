<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    //投稿を作成
    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        //Postモデルを使って投稿を作成
        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        //作成した投稿をJSON形式で返し、HTTPステータスコード201(created)を返す
        return response()->json($post, 201);
    }
}
