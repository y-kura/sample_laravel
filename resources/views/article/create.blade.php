@extends('layouts.app')

@section('content')
<h1>新規作成画面</h1>
<p><a href="{{ route('article.index')}}">一覧画面</a></p>
 
<form action="{{ route('article.store')}}" method="POST">
    @csrf
    <p>タイトル：<input type="text" name="title" value="{{old('title')}}"></p>
    <p>本文：<input type="text" name="body" value="{{old('body')}}"></p>
    <p>公開・非公開：<input type="text" name="public_flag" value="{{old('public_flag')}}"></p>
    <p>投稿日時：<input type="text" name="posted_at" value="{{old('posted_at')}}"></p>
    <p>カテゴリ：<input type="text" name="category_id" value="{{old('category_id')}}"></p>
    <input type="submit" value="登録する">
</form>
@endsection
