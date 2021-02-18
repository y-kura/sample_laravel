@extends('layouts.app')

@section('title', 'ログイン')
@section('content')
<div class="container" style="max-width:500px">
    <div class="card">
        <h5 class="card-header">ログイン</h5>
        <div class="card-body">
            <!-- メッセージ -->
            @if ($errors->any())
            <div class="alert alert-danger">
                ユーザー名またはパスワードに誤りがあります。
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- ユーザー名 -->
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">ユーザー名</label>
                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus minlength="2" maxlength="16" pattern="^[0-9A-Za-z_]+$" required>
                    </div>
                </div>
                <!-- パスワード -->
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" autocomplete="current-password" minlength="2" maxlength="16" required>
                    </div>
                </div>
                <!-- ログイン状態の保持 -->
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember"><small>ログイン状態を保持する</small></label>
                        </div>
                    </div>
                </div>
                <!-- ボタン -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">　ログイン　</button>
                </div>
            </form>
        </div>
    </div>

    <hr>
    <div class="text-muted small">
    ※<br>
    新規登録が面倒な方は、テスト用に用意してある、<br>
    下記のいずれかのアカウントでログインしてください。
    <table class="table table-sm w-auto">
        <thead>
            <tr><th>ユーザー名</th><th>パスワード</th></tr>
        </thead>
        <tbody>
            <tr><td>guest1</td><td>guest1</td></tr>
            <tr><td>guest2</td><td>guest2</td></tr>
            <tr><td>guest3</td><td>guest3</td></tr>
        </tbody>
    </table>
    </div>

</div>
@endsection
