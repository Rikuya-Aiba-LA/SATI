<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf8">
    <title>TITLE</title>
</head>
<body>
<h1>会員管理画面</h1>
<form action="#" method="post">
    <button type="submit" value="#">新規会員登録</button>
</form>
<form action="#" method="post">
    <input type="text" name="keyword" value="検索情報保持するとこ" placeholder="Email">
    <input type="button" value="検索する">
  </form>
<table border="1">
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>Email</th>
    </tr>
        <!-- foreach($customers as $customer) -->
            <tr>
                <td>id</td>
                <td>氏名</td>
                <td>email</td>
            </tr>
        <!-- endforeach -->
        
</table>
</body>
</html>
