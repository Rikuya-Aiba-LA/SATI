<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf8">
    <title>{{ config('app.name')}}</title>
</head>
<body>
<h1>会員管理画面</h1>
<form action="#" method="post">
    <button type="submit" value="#">新規会員登録</button>
</form>
<form action="{{ route('customers.index') }}" method="get">
    <input type="email" name="email" value="{{ request('email') }}" placeholder="Email">
    <input type="submit" value="検索する">
  </form>
<table border="1">
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>Email</th>
    </tr>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td><a href="#">{{ $customer->name }}</a></td>
                <td>{{ $customer->email }}</td>
            </tr>
        @endforeach
        
</table>
</body>
</html>
