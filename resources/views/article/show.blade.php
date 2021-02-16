@extends('layouts.app')

@section('title', $article->title)
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

    <div class="row">
        <div class="col">
            <!-- 公開フラグ -->
            @if (!$article->public_flag)
            <span class="badge badge-danger">非公開</span>
            @endif
            <!-- カテゴリー -->
            {{ $category_names[$article->category_id] ?? '' }}
        </div>
        <!-- 投稿日時 -->
        <div class="col text-right">
            <span class="text-muted">{{ $article->posted_at }}</span>
        </div>
    </div>

    <!-- タイトル -->
    <h1>{{ $article->title }}</h1>
    <hr>

    <!-- 本文 -->
    <pre class="lead">{{ $article->body }}</pre>

    <!-- ユーザー -->
    <i class="bi bi-person-fill"></i> {{ $article->user->name }}

    <!-- 作成日時：{{ $article->created_at }} -->
    <!-- 更新日時：{{ $article->updated_at }} -->

    <!-- 修正 / 削除 -->
    @auth
    @if ($article->user_id == Auth::user()->id)
    <div class="text-right">
        <a class="btn btn-outline-secondary" href="{{ route('article.edit',$article->id) }}">　修正　</a>
        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">　削除　</button>
    </div>

    <!-- 削除のモーダル -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">記事の削除</h5>
                </div>
                <div class="modal-body">記事を削除します。<br>よろしいですか？</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">キャンセル</button>
                    <form action="{{ route('article.destroy', $article->id)}}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">　削除　</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endauth

    <!-- コメント -->
    <h6 class="text-center"><i class="bi bi-chat-right-dots"></i> コメント</h6>
    （実装予定）<br>    


</div>
@endsection
