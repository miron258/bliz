<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">


        <!-- Styles -->
        <link href="{{ asset('css/admin/app_admin.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin/plugins.css') }}" rel="stylesheet">
        <!-- End Styles -->

        <!-- Scripts -->
        <script src="{{ asset('js/admin/app_admin.js') }}"></script>
        <script src="{{ mix("js/admin/bootstrap-notify.js") }}" defer></script>
        <!-- End Scripts -->


    </head>
    <body>



        <div id="app">




            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ 'Laravel Admin Panel' }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('menu.index') }}">Меню</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('page.index') }}">Cтраницы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('catalog.index') }}">Каталоги</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('product.index') }}">Товары</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('category.index') }}">Категории</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('material.index') }}">Материалы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gallery.index') }}">Галереи</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('review.index') }}">Отзывы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('formOrder.index') }}">Формы заказа</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>


            @yield('sidebar')

            <main class="py-4">
                @yield('content')
            </main>
        </div>


        <script src="{{ asset('js/admin/plugins.js') }}"></script>
    </body>
</html>
