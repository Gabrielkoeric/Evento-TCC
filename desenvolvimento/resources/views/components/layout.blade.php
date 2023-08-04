<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - Controle de Carros</title>
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
</head>
<body>
    <nav class="nav navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $title }}</a>
            @auth
            <a href="{{route('logout')}}">Sair</a>
            @endauth
        </div>
    </nav>


    <div class="container">
    <h1>{{ $title }}</h1>

    {{ $slot }}
</div>
</body>
</html>
