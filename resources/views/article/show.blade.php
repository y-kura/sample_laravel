@extends('layouts.app')

@section('title', $article->title)
@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $article->id }}</td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $article->title }}</td>
        </tr>
        <tr>
            <th>本文</th>
            <td>{{ $article->body }}</td>
        </tr>
        <tr>
            <th>カテゴリー</th>
            <td>{{ $category_names[$article->category_id] ?? '' }}</td>
        </tr>
        <tr>
            <th>公開設定</th>
            <td>{{ $article->getPlublicFlagDisplay() }}</td>
        </tr>
        <tr>
            <th>投稿日時</th>
            <td>{{ $article->posted_at }}</td>
        </tr>
        <tr>
            <th>作成日時</th>
            <td>{{ $article->created_at }}</td>
        </tr>
        <tr>
            <th>更新日時</th>
            <td>{{ $article->updated_at }}</td>
        </tr>
    </table>

    <a href="{{ route('article.edit',$article->id)}}">編集</a>
    <form action="{{ route('article.destroy', $article->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" name="" value="削除">
    </form>
</div>
@endsection
