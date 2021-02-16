@extends('layouts.app')

@section('content')
<div class="container">

	@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
	@endif

    <form action="{{ route('article.update',$article->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">タイトル <small><span class="badge badge-danger">必須</span></small></label>
            <input class="form-control" id="title" name="title" type="text" value="{{ $article->title }}" autocomplete="off" maxlength="50" required>
            <small class="form-text text-muted">※ 最大50文字</small>
        </div>
        <div class="form-group">
            <label for="body">本文 <small><span class="badge badge-danger">必須</span></small></label>
            <textarea class="form-control" id="body" name="body" rows="10" maxlength="200" required>{{ $article->body }}</textarea>
            <small class="form-text text-muted">※ 最大200文字</small>
        </div>
        <div class="form-row">
            <div class="form-group col-md-7">
                <label for="category_id">カテゴリー <small><span class="badge badge-danger">必須</span></small></label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" hidden>( 選択してください )</option>
                    @foreach($category_names as $id => $name)
                    <option value="{{ $id }}" @if ($article->category_id == $id) selected @endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="posted_at">投稿日時</label>
                <input id="posted_at" name="posted_at" type="datetime-local" class="form-control" value="{{ date('Y-m-d\TH:i:s', strtotime($article->posted_at)) }}" placeholder="年/月/日 [時:分]">
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="public_flag" name="public_flag" value="on" @if ($article->public_flag) checked @endif>
                <label class="form-check-label" for="public_flag">公開</label>
            </div>
        </div>

        <div class="text-right">
            <a class="btn btn-light" href="javascript:history.back()">キャンセル</a>
            <button type="submit" class="btn btn-secondary">　修正　</button>    
        </div>
    </form>
</div>
@endsection
