<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf8">
  <title>図書管理システム</title>
</head>
<body>
  <h1>資料管理</h1>
  <button onclick="location.href='#'">新規登録</button>
  <form action="{{ route('books.index') }}" method="get">
    <input type="number" name="id" value="{{ request('id') }}" placeholder="資料ID">
    <input type="submit" value="検索する">
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
        </tr>
      </thead>
      @foreach($books as $book)
        <tr>
          <td>{{ $book->id }}</td>
          <td><a href="#">{{ $book->title }}</a></td>
          <td>{{ $book->author }}</td>
          <td>{{ $book->publisher }}</td>
        </tr>
      @endforeach
    </table>
  @endif
  <form action="{{ route('books.index') }}" method="get">
    <input type="hidden" name="id" value = ''>
    <input type="submit" value="一覧で表示する">
  </form>
</body>
</html>