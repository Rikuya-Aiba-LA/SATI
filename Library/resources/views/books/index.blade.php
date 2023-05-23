<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf8">
  <title>図書管理システム</title>
</head>
<body>
  <h1>資料管理</h1>
  <button onclick="location.href='#'">新規登録</button>
  <form action="#" method="post">
    <input type="text" name="keyword" value="検索情報保持するとこ" placeholder="資料ID">
    <input type="button" value="検索する">
  </form>
  <hr>
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
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->publisher }}</td>
      </tr>
    @endforeach
  </table>
</body>
</html>