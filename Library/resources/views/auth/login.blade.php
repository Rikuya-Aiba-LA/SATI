<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="#">
</head>
<body>
    <header>
        <div class="container">
            <a class="brand" href="/">{{ config('app.name') }}</a>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>ログイン</h1>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <p>
                    <label>メールアドレス</label><br>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </p>
                <p>
                    <label>パスワード</label><br>
                    <input type="password" name="password" value="" required>
                </p>
                <p>
                    <button type="submit">ログイン</button>
                </p>
            </form>
        </div>
    </main>
</body>
</html>