<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DY.ID | Indonesian Electronic Store</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-info">
    <div id="app">
        <nav class="navbar navbar-expand navbar-light bg-warning shadow-sm">

            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('storage/layout/logo.svg') }}" height="50" alt="">
                </a>
                <form class="d-inline w-100" method="POST" action="{{ route('search') }}">
                    @csrf
                    <div class="form-group input-group">
                        <input type="text" class="form-control input-sm" placeholder="Search product..." id="sitesearch" name="query">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-outline-dark">Search</button>
                        </span>
                    </div> 
                </form>
            </div>
        </nav>
        <nav class="navbar navbar-expand navbar-dark bg-info shadow-sm">
            <div class="container">
                <ul class="navbar-nav">
            
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>

                    @auth
                        @if (Auth::user()->role == 'member')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart') }}">My Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('transaction_history') }}">Transaction History</a>
                            </li>
                        @endif
                        
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link  dropdown-toggle" data-bs-toggle="dropdown" href="#">Manage Product</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('view_product') }}">View Product</a></li>
                                    <li><a class="dropdown-item" href="{{ route('add_product') }}">Add Product</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link  dropdown-toggle" data-bs-toggle="dropdown" href="#">Manage Category</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('view_category') }}">View Category</a></li>
                                    <li><a class="dropdown-item" href="{{ route('add_category') }}">Add Category</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </nav>

        <main class="py-4 bg-primary" style="min-height:70vh;">
            @yield('content')
        </main>
    </div>
</body>
<footer class="bg-info">
    <div class="container" style="min-height: 50px;">
        <div class="text-center text-white p-4">
            © 2021 Copyright: Nayra Jannatri & Jason Cornelius
        </div>
    </div>
</footer>
</html>
