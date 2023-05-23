<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<p><a href="{{ route('customers.index') }}">会員管理画面</a></p>
<p><a href="{{ route('books.index') }}">資料管理画面</a></p>
<p><a href="{{ route('lendings.index') }}">貸出台帳画面</a></p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <input type="submit" value="ログアウト">
</form>

</body>
</html>