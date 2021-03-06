@extends('layouts.app')

@section('title', '記事の投稿')
@section('content')
<div class="container">
    <!-- メッセージ -->
	@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
	@endif

    <form action="{{ route('article.store')}}" method="POST">
        @csrf
        <!-- タイトル -->
        <div class="form-group">
            <label for="title">タイトル <small><span class="badge badge-danger">必須</span></small></label>
            <input class="form-control" id="title" name="title" type="text" value="{{ old('title') }}" autocomplete="off" maxlength="100" required>
            <small class="form-text text-muted">※ 最大100文字</small>
        </div>
        <!-- 本文 -->
        <div class="form-group">
            <label for="body">本文 <small><span class="badge badge-danger">必須</span></small></label>
            <textarea class="form-control" id="body" name="body" rows="10" maxlength="1000" required>{{ old('body') }}</textarea>
            <small class="form-text text-muted">※ 最大1000文字</small>
        </div>
        <div class="form-row">
            <!-- カテゴリー -->
            <div class="form-group col-md-7">
                <label for="category_id">カテゴリー <small><span class="badge badge-danger">必須</span></small></label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" hidden>( 選択してください )</option>
                    @foreach($category_names as $id => $name)
                    <option value="{{ $id }}" @if (old('category_id') == $id) selected @endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- 投稿日時 -->
            <div class="form-group col-md-5">
                <label for="posted_at">投稿日時</label>
                <input id="posted_at" name="posted_at" type="datetime-local" class="form-control" value="{{ old('posted_at') }}" placeholder="年/月/日 [時:分]">
            </div>
        </div>
        <!-- 公開フラグ -->
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="public_flag" name="public_flag" value="on" @if (!$errors->any() || old('public_flag')) checked @endif>
                <label class="form-check-label" for="public_flag">公開</label>
            </div>
        </div>
        <!-- ボタン -->
        <div class="text-right">
            <button type="submit" class="btn btn-primary">　投稿　</button>    
        </div>
    </form>
</div>
@endsection
