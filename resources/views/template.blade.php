<!doctype html>
<html lang="{{ str_replace('_', '-', app()-> getLocale()) }}">
@include('layouts.preheader')
<body>
<div id="app">
    @include('layouts.header', ['headerMini' => false, 'viewHeader'=> true])

    <div class="wrapper-bg">
        @yield('content')
        @include('layouts.block-services')
        @include('layouts.block-work')
        @include('layouts.block-price')
        @include('layouts.block-form')
        @include('layouts.block-reviews')
    </div>
    @include('layouts.footer')
</div>

</body>
</html>

