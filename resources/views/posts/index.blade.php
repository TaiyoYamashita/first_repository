<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Blog Name</h1>
        <a href="/posts/create">create</a>
        <div class='posts'>
            @foreach($posts as $post)
                <div class='post'>
                    <a href="/posts/{{ $post->id }}"><h2  class='title'>{{ $post->title }}</h2></a>
                    <a href="">{{ $post->category->name }}</a>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class='paginate'>{{ $posts->links() }}</div>
        <!--JavaScriptの呼び出しをする。サイトの処理速度を上げるためにここで呼び出す。ポップアップを出力してOKを選択した場合に削除をする。-->
        <script>
            function deletePost(id) {
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>