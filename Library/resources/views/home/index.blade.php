<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <section class="menu">
<p class="title">{{ config('app.name') }}</p>
<div class="flex">
<p class="element"><a href="{{ route('customers.index') }}">会員管理画面</a></p>
<p class="element"><a href="{{ route('books.index') }}">資料管理画面</a></p>
<p class="element"><a href="{{ route('lendings.index') }}">貸出台帳画面</a></p>
</div>
<div class="button_line004">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <input type="submit" value="ログアウト" class="btn2">
    </form>
</div>
</section>
</body>
</html>