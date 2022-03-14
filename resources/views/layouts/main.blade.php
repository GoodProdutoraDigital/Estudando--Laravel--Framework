<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
        {{-- CDN CSS Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/scripts.js"></script>
    </head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbar">
            <a href="/" class="navbar-brand">
                <img src="/img/icons/github.svg" alt="HDC Event">
            </a>
            <div class="msg-div">
                @if($user)
                <p>Seja Bem vindo(a) </p>
                <h1>{{$user->name}}</h1>
                @else
                @endif
            </div>
            <ul class="navbar-nav">
                <li class="navbar-iten">
                    <a href="/" class="nav-link">Eventos</a>
                </li>
                <li class="navbar-iten">
                    <a href="/events/create" class="nav-link">Criar Eventos</a>
                </li>
                @auth
                <li class="navbar-iten">
                    <a href="/dashboard" class="nav-link">Meus Eventos</a>
                </li>
                <li class="navbar-iten">
                    <form action="/logout" method="post">
                        @csrf
                        <a href="/logout" class="nav-link" onclick="event.preventDefault();
                        this.closest('form').submit();">
                        Sair
                    </a>
                    </form>
                </li>    
                @endauth
                @guest
                <li class="navbar-iten">
                    <a href="/login" class="nav-link">Entrar</a>
                </li>
                <li class="navbar-iten">
                    <a href="/register" class="nav-link">Cadastrar</a>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
<main>
    <div class="container-fluid">
        <div class="row">
            {{--Diretiva flash message--}}
            @if(session('success-msg'))
                <p class="success-msg">{{session('success-msg')}}</p>
            @endif
            @if(session('error-msg'))
                <p class="error-msg">{{session('error-msg')}}</p>
            @endif
            
            @yield('content')
        </div>
    </div>
</main>
<footer>
    <p>HDC Events &copy; 2022</p>
</footer>

{{-- JQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- Ionicons--}}
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>