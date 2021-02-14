@extends('layouts.app')

@section('content')
<h1>一覧画面</h1>
<p><a href="{{ route('article.create') }}">新規追加</a></p>

<table border="1">
  <tr>
    <th>タイトル</th>
    <th>詳細</th>
    <th>編集</th>
    <th>削除</th>
  </tr>
  @foreach ($articles as $article)
  <tr>
    <td>{{ $article->title }}</td>
    <td><a href="{{ route('article.show',$article->id)}}">詳細</a></td>
    <td><a href="{{ route('article.edit',$article->id)}}">編集</a></td>
    <th>
      <form action="{{ route('article.destroy', $article->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" name="" value="削除">
      </form>
    </th>
  </tr>
  @endforeach
</table>
@endsection
