@extends('layouts.app')

@section('content')
<div class="container" style="max-width:700px">
    <h1>記事作成</h1>
    <hr>

	@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
	@endif

    <form action="{{ route('article.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">タイトル <small><span class="badge badge-danger">必須</span></small></label>
            <input class="form-control" id="title" name="title" type="text" value="{{old('title')}}" maxlength="50" required>
            <small class="form-text text-muted">※ 最大50文字</small>
        </div>
        <div class="form-group">
            <label for="body">本文 <small><span class="badge badge-danger">必須</span></small></label>
            <textarea class="form-control" id="body" name="body" rows="7" maxlength="200" required>{{old('body')}}</textarea>
            <small class="form-text text-muted">※ 最大200文字</small>
        </div>
        <div class="form-row">
            <div class="form-group col-md-7">
                <label for="category_id">カテゴリー <small><span class="badge badge-danger">必須</span></small></label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" hidden>( 選択してください )</option>
                    @foreach($category_names as $id => $name)
                    <option value="{{ $id }}" @if (old('category_id') == $id) selected @endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="posted_at">投稿日時</label>
                <input id="posted_at" name="posted_at" type="datetime-local" class="form-control" value="{{old('posted_at')}}" placeholder="年/月/日 [時:分]">
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="public_flag" name="public_flag" value="on" @if (!$errors->any() || old('public_flag')) checked @endif>
                <label class="form-check-label" for="public_flag">公開</label>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">記事作成</button>    
        </div>
    </form>
</div>
@endsection
