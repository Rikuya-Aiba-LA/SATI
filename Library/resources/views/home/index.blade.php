@extends('layouts.app')

@section('content')
<p><a href="customers/index">会員管理画面</a></p>
<p><a href="books/index">書籍管理画面</a></p>
<p><a href="lendings/index">貸出台帳画面</a></p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <input type="submit" value="ログアウト">
</form>
@endsection