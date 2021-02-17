@extends('layouts.app')

@section('content')
<div class="container">
    <!-- メッセージ -->
	@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
	@endif

    <!-- カテゴリーのタブ -->
    <?php $query = request('user_id') ? ['user_id' => request('user_id')] : [] ?>
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link @if (!request('category_id')) active @endif" href="{{ route('article.index', $query) }}">ALL</a>
        </li>
        @foreach ($category_names as $category_id => $category_name)
        <li class="nav-item">
            <a class="nav-link @if ($category_id == request('category_id')) active @endif" href="{{ route('article.index', $query + ['category_id' => $category_id]) }}">{{ $category_name }}</a>
        </li>
        @endforeach
    </ul>

    <!-- 記事の一覧 -->
    @foreach ($articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <!-- 公開フラグ -->
                    @if (!$article->public_flag)
                    <span class="badge badge-danger">非公開</span>
                    @endif
                    <!-- カテゴリー -->
                    <small class="card-subtitle mb-2 text-muted">{{ $category_names[$article->category_id] ?? '' }}</small>
                </div>
                <div class="col text-right">
                    <!-- 投稿日時 -->
                    <small class="text-muted">{{ $article->posted_at }}</small>
                </div>
            </div>
            <!-- タイトル -->
            <h5 class="card-title"><a class="font-weight-bold" href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a></h5>
            <!-- 本文 -->
            <p class="card-text">{{ mb_strimwidth($article->body, 0, 160, '...') }}</p>
            <!-- ユーザー -->
            <i class="bi bi-person-fill"></i> {{ $article->user->name }}
        </div>
    </div>
    @endforeach
    @if (count($articles) == 0)
    <p class=" text-muted ml-3">記事はありません</p>
    @endif

    <!-- ページャー -->
    {{ $articles->appends(request()->query())->links() }}

</div>
@endsection
