@extends('layouts.app')

@section('title', $article->title)
@section('content')
<div class="container">
    <!-- メッセージ -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
	@endif
	@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
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
            <span class="text-muted">{{ ($article->posted_at) ? $article->posted_at->format('Y-m-d H:i') : '' }}</span>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
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
    <hr>
    @auth
    <h6><i class="bi bi-chat-right-dots"></i> コメント <small class="text-muted">※ 最大100文字</small></h6>
    <form class="mb-3" action="{{ route('comment.store')}}" method="POST">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <div class="form-group">
            <input class="form-control form-control-sm" id="text" name="text" type="text" value="{{ old('text') }}" autocomplete="off" maxlength="100" required>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-info btn-sm">　コメント　</button>    
        </div>
    </form>
    @else
    <h6><i class="bi bi-chat-right-dots"></i> コメント</h6>
    @endauth

    @foreach ($comments as $comment)
    <h6>
        <i class="bi bi-person-fill"></i> {{ $comment->user->name }}
        <small class="text-muted">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
        @auth
        @if ($comment->user_id == Auth::user()->id)
        <form action="{{ route('comment.destroy', $comment->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="close" onclick="return confirm('コメントを削除します。よろしいですか？');""><span>&times;</span></button>
        </form>
        @endif
        @endauth
    </h6>
    <p>{{ $comment->text }}</p>
    @endforeach
</div>
@endsection
