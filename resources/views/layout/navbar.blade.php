<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">    
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Casual friends</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('activeHome')" href="{{route("user.index")}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('activeRequest')" href="{{route("friend-request.index")}}">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('activeFriend')" href="#">Friends</a>
                    </li>
                </ul>
                @if (Auth::check())
                    <div class="d-flex align-items-center">
                        <span class="text-light me-3">Hi, {{ Auth::user()->name }}!</span>
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex">
                        <a href="{{ url('/login') }}" class="btn btn-outline-light me-2">Login</a>
                        <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <main class="container mt-5">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
<script src="{{asset("js/bootstrap.bundle.min.js")}}"></script>
</html>
