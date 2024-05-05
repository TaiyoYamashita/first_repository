<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(5)]); // $postのgetメソッドを返す
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store(PostRequest $request,Post $post)
    {
        $input = $request['post']; //入力内容を変数に格納する
        $post->fill($input)->save(); //データベースでいうinsert構文。fillを使用するにはModelでfillableを指定しておく必要がある。
        // $post->create($input) でも同じ動作をする。
        return redirect('/posts/' . $post->id);
        // 今データベースに挿入したタプルのidが「$post->id」に格納されている。
        
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
}

?>