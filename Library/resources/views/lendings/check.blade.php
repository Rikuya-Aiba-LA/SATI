@extends('layouts.app')

@section('content')
<h1>貸出確認画面</h1>
<h2>会員情報</h2>
<form action="{{ route('lendings.store', $customer->id) }}" method="post">
  @csrf
<dl>
  <dt>会員ID</dt>
  <dd>
    <p>{{ $customer->id }}</p>
    <input type="hidden" name="cust_id" value="{{ $customer->id }}">
  </dd>
  <dt>会員名</dt>
  <dd>
    <p>{{ $customer->name }}</p>
  </dd>
</dl>
<hr>
<h2>資料情報</h2>
<dl>
  <dt>資料ID</dt>
  <dd>
    <p>{{ $book->id }}</p>
    <input type="hidden" name="book_id" value="{{ $book->id }}">
  </dd>
  <dt>資料名</dt>
  <dd>
    <p>{{ $book->title }}</p>
  </dd>
</dl>
<hr>
<?php
  $today = date('Y-m-d');
  if(strtotime($book->publish_date) > strtotime("-3 month")){
    //出版日($book->publish_date)が本日から3ヶ月以内
    $expectied_date = date("Y-m-d", strtotime("10 day"));
  }else{
    $expectied_date = date("Y-m-d", strtotime("15 day"));
  }

?>
<h2>貸出日</h2>
  <p>{{ $today }}</p>
  <input type="hidden" name="lend_date" value="{{ $today }}">
<h2>返却予定日</h2>
  <p>{{ $expectied_date }}</p>
  <input type="hidden" name="expectied_date" value="{{ $expectied_date }}">
  <input type="submit" value="貸出する">
</form>
@endsection