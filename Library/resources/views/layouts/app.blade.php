<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/nav.css">
</head>
<body>
    <header>
        @include('commons/nav')
        <div class="container">
            <a class="brand" href="/">{{ config('app.name') }}</a>
        </div>
    </header>
    <main>
        <div class="container">
           @yield('content')
        </div>
    </main>
</body>
</html>