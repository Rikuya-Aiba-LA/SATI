@extends('layouts.app')

@section('content')
<h1>会員情報編集</h1>
@if ($errors->count())
<ul class = "alert">
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<form action="{{ route('customers.update',$customer->id) }}" method="post">
    @method('patch')
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
            <input type="text" name="tel" value="{{ old('tel', $customer->tel) }}">
        </dd>
        <dt>E-mail</dt>
        <dd>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}">
        </dd>
        <dt>生年月日</dt>
        <dd>
            <input type="datetime" name="birth" value="{{ old('birth', $customer->birth) }}">
        </dd>
    </dl>
    <button type="submit">更新</button>
</form>
<!-- 更新ボタンが押された際のポップアップの表示処理 -->
@endsection
