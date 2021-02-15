@extends('layouts.app')

@section('content')
<div class="container">
  <table class="table">
    <tr>
      <th>タイトル</th>
      <th>カテゴリ</th>
      <th>公開設定</th>
      <th>投稿日時</th>
    </tr>
    @foreach ($articles as $article)
    <tr>
      <td><a href="{{ route('article.show',$article->id) }}">{{ $article->title }}</a></td>
      <td>{{ $category_names[$article->category_id] ?? '' }}</td>
      <td>{{ $article->getPlublicFlagDisplay() }}</td>
      <td>{{ $article->posted_at }}</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
