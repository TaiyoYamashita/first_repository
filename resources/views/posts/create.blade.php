<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body class="antialiased">
        <h1>Blog Name</h1>
        <form action="/posts" method="POST"> <!--action属性には送信したらどこに移るかが指定される-->
            @csrf
            <div class="title">
                <h2>Title</h2>                                                                       <!--ポストする際、送信する内容は連想配列で渡される。-->
                <input type="text" name=post[title] placeholder="タイトル" value={{ old('post.title') }}> <!--name属性の[]内が連想配列のキーになる-->
                <p class='title_error' style='color:red'>{{ $errors->first('post.title') }}</p>      <!--name属性が「文字列[～]」で一致しているもの同士で連想配列を作る-->
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も一日お疲れ様でした。" value={{ old('post.body') }}></textarea>
                <!--valueにoldを指定すると条件に合致しないで弾かれたときに入力された文字列を消さないで保持する。-->
                <p class='title_error' style='color:red'>{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="store">
        </form>
            <a href="/">戻る</a>
        </div>
    </body>
</html>