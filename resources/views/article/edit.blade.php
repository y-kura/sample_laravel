@extends('layouts.app')

@section('content')
<h1>編集画面</h1>
<p><a href="{{ route('article.index')}}">一覧画面</a></p>
 
@if ($message = Session::get('success'))
<p>{{ $message }}</p>
@endif
 
<form action="{{ route('article.update',$article->id)}}" method="POST">
    @csrf
    @method('PUT')
    <p>タイトル：<input type="text" name="title" value="{{ $article->title }}"></p>
    <p>本文：<input type="text" name="body" value="{{ $article->body }}"></p>
    <p>公開・非公開：<input type="text" name="public_flag" value="{{ (int) $article->public_flag }}"></p>
    <p>投稿日時：<input type="text" name="posted_at" value="{{ $article->posted_at }}"></p>
    <p>カテゴリ：<input type="text" name="category_id" value="{{ $article->category_id }}"></p>
    <input type="submit" value="編集する">
</form>
@endsection
