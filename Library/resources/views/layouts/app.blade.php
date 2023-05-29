<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/flash.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="stylesheet" href="/css/main.css">

</head>
<body>
    <header>
    <div class="container">
            <a class="brand" href="/home">{{ config('app.name') }}</a>
        </div>
        @include('commons/nav')

    </header>
    <main>
        <div class="content">
           @yield('content')
        </div>
    </main>
</body>
</html>