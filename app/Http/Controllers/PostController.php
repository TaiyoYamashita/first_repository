<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $client = new \GuzzleHttp\Client(); //クライアントインスタンスの生成
        $url='https://teratail.com/api/v1/questions'; //GET通信するURL
        
        //リクエスト送信と返却データの取得
        //Bearerトークンにアクセストークンを指定して認証を行う
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        
        //API通信で取得したデータはjson形式であるため、PHPファイルに対応した連想配列にデコードする
        $questions = json_decode($response->getBody(),true);
        
        //index bladeに取得したデータを渡す
        
        return view('posts.index')->with([
            'posts' => $post->getPaginateByLimit(),
            'questions' => $questions['questions'],
        ]);
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
    
    //public function create()
    //{
    //    return view('posts.create');
    //}
    
    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
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
    
    public function update(PostRequest $request,Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
}

?>