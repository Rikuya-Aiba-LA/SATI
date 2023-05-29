@extends('layouts/app')

@section('content')
<body>
    <h1>貸出台帳</h1>
    <form action="{{ route('lendings.index') }}" class="button001" method="get">
        <input type="number" name="cust_id"  placeholder="会員ID" value="{{ request('cust_id') }}" required min="1">
        <input type="submit" class="btn" value="会員ID検索">
    </form>
    <form action="{{ route('lendings.index') }}" class="button001" method="get">
        <input type="text" name="title"  placeholder="資料名" value="{{ request('title') }}">
        <input type="submit" class="btn" value="資料名検索">
    </form>
    <form action="{{ route('lendings.index') }}" method="get">
        <input type="hidden" name="null_return_date" value = "1";>
        <input type="submit" value="未返却資料を表示">
    </form>
    <form action="{{ route('lendings.index') }}" method="get">
        <input type="hidden" name="cust_id" value = '0'>
        <input type="submit" value="貸出一覧">
    </form>
 @if($lendings->count() == 0)
<p>該当する貸出情報が存在しません</p>
 @else
    <table>
    <thead>
        <tr>
            <th>会員ID</th>
            <th>会員名</th>
            <th>資料ID</th>
            <th>資料名</th>
            <th>貸出日</th>
            <th>返却予定日</th>
            <th>返却日</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($lendings as $lending)
        <tr>
            <td>{{ $lending->cust_id }}</td>
            <td><a href="{{ route('customers.show', $lending->cust_id) }}">{{ $lending->customer->name }}</a></td>
            <td>{{ $lending->book_id }}</td>
            <td><a href="{{ route('books.show', $lending->book_id) }}"">{{ $lending->book->title }}</a></td>
            <?php
                preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$lending->lend_date, $lend_date_match);
            ?>
            <td>{{ $lend_date_match[0] }}</td>
            <?php
                preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$lending->expectied_date, $expected_date_match);
            ?>
            <td>{{ $expected_date_match[0] }}</td>
            @if($lending->return_date)
                <?php
                    preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$lending->return_date, $return_date_match);
                ?>
                <td>{{ $return_date_match[0] }}</td>
            @else
                <td>未返却</td>
            @endif
        </tr>
        @endforeach
    </tbody>
    </table>
    {{ $lendings->links() }}
    @endif
@endsection