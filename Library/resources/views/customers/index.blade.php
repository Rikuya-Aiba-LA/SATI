@extends('layouts/app')

@section('content')
@if($customers->whereNotNull('unsub_date')->count() > 0)
    <h1>退会会員一覧</h1>
@else
    <h1>登録会員一覧</h1>
@endif
    
<div class="replace">
    <div class="button_line004">
      <button onclick="location.href='{{ route('customers.create') }}'" class="btn2">新規会員登録</button>
    </div>
</div>

<div class="contents">
    <div class="item">
        <form action="{{ route('customers.index') }}" class="button_line004" method="get">
            <input type="hidden" name="email" value = ''>
            <input type="submit" class="btn2" value="登録会員一覧">
        </form>
    </div>
    <div class="item">
        <form action="{{ route('customers.index') }}" class="button_line004" method="get">
            <input type="hidden" name="unsub_date" value="1">
            <input type="submit" class="btn2" value="退会会員一覧">
        </form>
    </div>
    <div class="item">
        <form action="{{ route('customers.index') }}" class="button001" method="get">
            <input type="email" name="email" value="{{ request('email') }}" class="box" placeholder="Email" required>
            <input type="submit" class="btn" value="検索する">
        </form>
    </div>
</div>
@if($customers->count() == 0)
<p>該当する会員が存在しません</p>
 @else
<table>
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
