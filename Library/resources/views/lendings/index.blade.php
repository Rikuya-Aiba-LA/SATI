<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>貸出台帳</h1>
<form action="#" method="post">
    <input type="text" name="keyword" value="検索情報保持するとこ" placeholder="資料ID">
    <input type="button" value="検索する">
  </form>
 
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
            <td>{{ $lending->customer->name }}</td>
            <td>{{ $lending->book_id }}</td>
            <td>{{ $lending->book->title }}</td>
            <td>{{ $lending->lend_date }}</td>
            <td>{{ $lending->expectied_date }}</td>
            <td>{{ $lending->return_date }}</td>
            

        </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>