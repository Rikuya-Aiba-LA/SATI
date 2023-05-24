@extends('layouts/app')

@section('content')
<body>
    <h1>貸出台帳</h1>
<form action="{{ route('lendings.index') }}" method="get">
    <input type="number" name="cust_id"  placeholder="会員番号ID" value="{{ request('cust_id') }}" >
    <input type="submit" value="検索する">
  </form>
 @if($lendings->count() == 0)
<p>該当するIDが存在しません</p>
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
            @if($lending->return)
                <?php
                    preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$lending->return, $return_date_match);
                ?>
                <td>{{ $return_date_match[0] }}</td>
            @else
                <td>{{ $lending->return_date }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
    </table>
    @endif
    <form action="{{ route('lendings.index') }}" method="get">
    <input type="hidden" name="cust_id" value = '0'>
    <input type="submit" value="一覧で表示する">
  </form>
@endsection