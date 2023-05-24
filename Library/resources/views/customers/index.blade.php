@extends('layouts/app')

@section('content')
<h1>会員管理画面</h1>
    <button onclick="location.href='{{ route('customers.create') }}'">新規会員登録</button>
<form action="{{ route('customers.index') }}" method="get">
    <input type="email" name="email" value="{{ request('email') }}" placeholder="Email">
    <input type="submit" value="検索する">
  </form>
  <form action="{{ route('customers.index') }}" method="get">
    <input type="hidden" name="unsub_date" value="1">
    <input type="submit" value="退会者の表示">
  </form>
@if($customers->count() == 0)
<p>該当するIDが存在しません</p>
 @else
<table border="1">
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>Email</th>
    </tr>
    @foreach($customers as $customer)
    <tr>
        <td>{{ $customer->id }}</td>
        <td><a href="{{ route('customers.show', $customer->id) }}">{{ $customer->name }}</a></td>
        <td>{{ $customer->email }}</td>
    </tr>
    @endforeach
        
</table>
@endif
<form action="{{ route('customers.index') }}" method="get">
    <input type="hidden" name="email" value = ''>
    <input type="submit" value="一覧で表示する">
</form>
@endsection
