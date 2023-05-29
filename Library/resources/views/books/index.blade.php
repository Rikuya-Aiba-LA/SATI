@extends('layouts/app')

@section('content')
  @if($books->whereNotNull('trash_date')->count() > 0)
    <h1>廃棄資料一覧</h1>
  @else
    <h1>在庫資料一覧</h1>
  @endif
  <div class="replace">
    <div class="button_line004">
    <button onclick="location.href='{{ route('books.create') }}'" class="btn2">新規資料登録</button>
    </div>
  </div>
  
  <div class="contents">
    <div class="item">
      <form action="{{ route('books.index') }}" class="button_line004" method="get">
        <input type="hidden" name="id" value = ''>
        <input type="submit" onclick="changeExists()" class="btn2" value="在庫資料一覧">
      </form>
    </div>
    <div class="item">
      <form action="{{ route('books.index') }}" class="button_line004" method="get">
        <input type="hidden" name="trash_date" value="日本語">
        <input type="submit" onclick="changeTrash()" class="btn2" value="廃棄資料一覧">
      </form>
    </div>
    <div class="item">
      <form action="{{ route('books.index') }}" class="button001" method="get">
        <input type="number" name="id" value="{{ request('id') }}" class="box" placeholder="資料ID" required>
        <input type="submit" class="btn" value="検索する">
      </form>
    </div>
  </div>

  @if($books->count() == 0)
    <p>該当する資料が存在しません</p>
  @else
    <table>
      <thead>
        <tr>
          <th>資料ID</th>
          <th>資料名</th>
          <th>著者</th>
          <th>出版日</th>
          @if($books->whereNotNull('trash_date')->count() > 0)
            <th>廃棄年月日</th>
          @endif
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
          @endif
        </tr>
      @endforeach
    </table>
    {{ $books->links() }}
  @endif
@endsection