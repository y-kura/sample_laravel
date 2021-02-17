@extends('layouts.app')

@section('title', '新規登録')
@section('content')
<div class="container" style="max-width:500px">
    <div class="card">
        <h5 class="card-header">新規登録</h5>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- ユーザー名 -->
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">ユーザー名</label>
                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="2～16文字" minlength="2" maxlength="16" pattern="^[0-9A-Za-z_]+$" required>
                        <small class="form-text text-muted">※ 半角英数字＋アンダースコア(_)</small>
                    </div>
                </div>
                <!-- パスワード -->
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" autocomplete="new-password" placeholder="2～16文字" minlength="2" maxlength="16" required>
                    </div>
                </div>
                <!-- パスワード(確認) -->
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワード<small>(確認)</small></label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" minlength="2" maxlength="16" required>
                    </div>
                </div>
                <!-- ボタン -->
                <div class="text-center">
                    <button type="submit" class="btn btn-warning">　新規登録　</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
