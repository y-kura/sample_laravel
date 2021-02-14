@extends('layouts.app')

@section('content')
<h1>詳細画面</h1>
<p><a href="{{ route('article.index')}}">一覧画面</a></p>
 
<table border="1">
    <tr>
        <th>id</th>
        <th>title</th>
        <th>body</th>
        <th>category_id</th>
        <th>public_flag</th>
        <th>title</th>
        <th>posted_at</th>
        <th>created_at</th>
        <th>updated_at</th>
    </tr>
    <tr>
        <td>{{ $article->id }}</td>
        <td>{{ $article->title }}</td>
        <td>{{ $article->body }}</td>
        <td>{{ $article->category_id }}</td>
        <td>{{ $article->public_flag }}</td>
        <td>{{ $article->posted_at }}</td>
        <td>{{ $article->created_at }}</td>
        <td>{{ $article->updated_at }}</td>
    </tr>
</table>
@endsection
