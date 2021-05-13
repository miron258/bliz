<!doctype html>
<html lang="{{ str_replace('_', '-', app()-> getLocale()) }}">
@include('layouts.preheader')
<body>
<div id="app">
    @include('layouts.header', ['headerMini' => true, 'viewHeader'=> true])
    @yield('content')
    @include('layouts.footer')
</div>
</body>
</html>

