<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title-block')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">Главная</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/catalog') }}">Каталог</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/cart') }}">Корзина</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        @guest
                            <button class="btn btn-outline-success me-2" onclick="window.location.href='{{ url('/login') }}'">Вход</button>
                            <button class="btn btn-outline-primary" onclick="window.location.href='{{ url('/register') }}'">Регистрация</button>
                        @else
                            <span class="navbar-text me-2">{{ Auth::user()->name }}</span>
                            <button class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>