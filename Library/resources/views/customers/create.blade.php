@extends('layouts.app')

@section('content')
<h1>会員登録画面</h1>
<form action="{{ route('customers.store') }}" method="post">
@csrf
<dl>
    <dt>氏名</dt>
    <dd>
        <input type="text" name="name" value="{{ old('name', $customer->name) }}">
    </dd>
    <dt>住所</dt>
    <dd>
        <input type="text" name="address" value="{{ old('address', $customer->address) }}">
    </dd>
    <dt>電話番号</dt>
    <dd>
        <input type="number" name="tel" value="">
    </dd>
    <dt>E-mail</dt>
    <dd>
        <input type="email" name="email" value="">
    </dd>
    <dt>生年月日</dt>
    <dd>
        <input type="text" name="birth" value="{{ old('birth', $customer->birth) }}">
    </dd>
</dl>
<button type="submit">登録確認</button>
</form>
@endsection
<hr>
<a href="/">戻る</a>