@extends('layouts.app')

@section('content')
<p><a href="{{ route('customers.index') }}">会員管理画面</a></p>
<p><a href="{{ route('books.index') }}">資料管理画面</a></p>
<p><a href="{{ route('lendings.index') }}">貸出台帳画面</a></p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <input type="submit" value="ログアウト">
</form>
@endsection