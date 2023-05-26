@extends('layouts/app')

@section('content')
  <h1>資料管理</h1>
  <button onclick="location.href='{{ route('books.create') }}'">新規登録</button>
  <form action="{{ route('books.index') }}" method="get">
    <input type="number" name="id" value="{{ request('id') }}" placeholder="資料ID" required>
    <input type="submit" value="検索する">
  </form>
  <form action="{{ route('books.index') }}" method="get">
    <input type="hidden" name="trash_date" value="日本語">
    <input type="submit" value="廃棄済み資料">
  </form>
  <hr>
  @if($books->count() == 0)
    <p>該当するIDが存在しません</p>
  @else
    <table border="1">
      <thead>
        <tr>
          <th>資料ID</th>
          <th>資料名</th>
          <th>著者</th>
          <th>出版日</th>
          <th>廃棄年月日</th>
        </tr>
      </thead>
      @foreach($books as $book)
        <tr>
          <td>{{ $book->id }}</td>
          <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td>
          <td>{{ $book->author }}</td>
          <?php
            preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$book->publish_date, $publish_date_match);
          ?>
          <td>{{ $publish_date_match[0] }}</td>
          @if($book->trash_date)
            <?php
              preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$book->trash_date, $trash_date_match);
            ?>
            <td>{{ $trash_date_match[0] }}</td>
          @else
            <td></td>
          @endif
        </tr>
      @endforeach
    </table>
    {{ $books->links() }}
  @endif
  <form action="{{ route('books.index') }}" method="get">
    <input type="hidden" name="id" value = ''>
    <input type="submit" value="一覧で表示する">
  </form>
@endsection