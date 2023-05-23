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
            <td><a href="#">{{ $lending->customer->name }}</a></td>
            <td>{{ $lending->book_id }}</td>
            <td><a href="#">{{ $lending->book->title }}</a></td>
            <td>{{ $lending->lend_date }}</td>
            <td>{{ $lending->expectied_date }}</td>
            <td>{{ $lending->return_date }}</td>
            

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