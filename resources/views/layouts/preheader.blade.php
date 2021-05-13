<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('meta_tag_title')</title>
    <meta name="description" content="@yield('meta_tag_description')" />
    <meta name="keywords" content="@yield('meta_tag_keywords')" />


    <meta property="og:title" content="ООО БЛИЦ Бурение и обустройство скважин на воду">
    <meta property="og:site_name" content="ООО БЛИЦ">
    <meta property="og:url" content="https://burenie57.com">
    <meta property="og:description" content="Профессиональное бурение и обустройство скважин на воду в городе Орле">
    <meta property="og:image" content="https://burenie57.com/img/tpl_img/main_image.jpg">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
{{--    <script defer src="{{ asset('js/vue/appClient.js') }}"></script>--}}
    <script type="module" src="{{ mix('js/vue/appComponents.js') }}" defer></script>
    <script src="{{ asset('js/plugins.js') }}" defer></script>
    @stack('scripts')
    <link href="{{ asset('img/tpl_img/favicon.png') }}" rel="shortcut icon">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet">
    @stack('styles')
    <link rel="image_src" href="http://burenie57.com/img/tpl_img/main_image.jpg">
</head>
