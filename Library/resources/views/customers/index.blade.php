@extends('layouts/app')

@section('content')
@if($customers->whereNotNull('unsub_date')->count() > 0)
    <h1>退会会員一覧</h1>
@else
    <h1>登録会員一覧</h1>
@endif
    <button onclick="location.href='{{ route('customers.create') }}'">新規会員登録</button>
<form action="{{ route('customers.index') }}" method="get">
    <input type="email" name="email" value="{{ request('email') }}" placeholder="Email" required>
    <input type="submit" value="検索する">
</form>
<form action="{{ route('customers.index') }}" method="get">
    <input type="hidden" name="email" value = ''>
    <input type="submit" value="登録会員一覧">
</form>
<form action="{{ route('customers.index') }}" method="get">
    <input type="hidden" name="unsub_date" value="1">
    <input type="submit" value="退会会員一覧">
</form>
@if($customers->count() == 0)
<p>該当する会員が存在しません</p>
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
{{ $customers->links() }}
@endif
@endsection
