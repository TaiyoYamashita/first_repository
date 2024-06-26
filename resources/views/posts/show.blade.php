<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <x-slot name="header">show</x-slot>
        <body>
            <h1 class=title>
                {{ $post->title }}
            </h1>
            <div class='content'>
                <div class='content_post'>
                    <div class='edit'>
                        <a href="/posts/{{ $post->id }}/edit">edit</a>
                    </div>
                    <h3>本文</h3>
                    <p class='body'>{{ $post->body }}</p>
                </div>
            </div>
            <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
            <div class='footer'>
                <a href="/">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>