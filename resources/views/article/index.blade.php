@extends('layouts.app')

@section('content')
<div class="container">

	@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
	@endif

    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#">全て</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">一般</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">政治・経済</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">ｴﾝﾀﾒ・ｽﾎﾟｰﾂ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">IT・科学</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">その他</a>
        </li>
    </ul>

    <!--
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
    -->
    
    @foreach ($articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            @if (!$article->public_flag)
            <span class="badge badge-danger">非公開</span>
            @endif
            <small class="card-subtitle mb-2 text-muted">{{ $category_names[$article->category_id] ?? '' }}</small>
            <h5 class="card-title"><a class="font-weight-bold" href="{{ route('article.show',$article->id) }}">{{ $article->title }}</a></h5>
            <p class="card-text">{{ $article->body }}</p>
            <div class="text-right">
                <a href="#" class="card-link"><i class="bi bi-person-fill"></i> user name</a>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
