<!DOCTYPE html>
<html lang="{{ config('locale') }}" dir="ltr">

<head>
    <!-- Standard Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | {{ \App\Models\Setting::getValue('site_name') }}</title>

    <meta name="description" content="{{ \App\Models\Setting::getValue('site_description') }}">
    <meta name="keywords" content="{{ \App\Models\Setting::getValue('keywords') }}">
    <meta name="author" content="monetamarket.ca">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f2f3f5" />

    <link rel="icon" href="{{ asset('front/favicon.png') }}" type="image/png" />

    <!-- Critical preload -->
    <link rel="preload" href="{{ asset('front/js/vendors/uikit.min.js') }}" as="script">
    <link rel="preload" href="{{ asset('front/css/vendors/uikit.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('front/css/style.css') }}" as="style">

    <!-- Icon preload -->
    <link rel="preload" href="{{ asset('front/fonts/fa-brands-400.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('front/fonts/fa-solid-900.woff2') }}" as="font" type="font/woff2"
        crossorigin>

    <!-- Font preload -->
    <link rel="preload" href="{{ asset('front/fonts/lato-v16-latin-700.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('front/fonts/lato-v16-latin-regular.woff2') }}" as="font"
        type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('front/fonts/montserrat-v14-latin-600.woff2') }}" as="font"
        type="font/woff2" crossorigin>

    <!-- Libraries CSS Files -->
    <link href="{{ asset('front/css/vendors/uikit.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">

    @yield('stylesheets')

</head>

<body>
    <!-- preloader begin -->
    <div class="in-loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- preloader end -->

    <main class="container">
        @yield('content')
    </main>

    <div class="uk-visible@m">
        <a href="#" class="in-totop fas fa-chevron-up uk-animation-slide-top" data-uk-scroll=""
            style="opacity: 1;"></a>
    </div>

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('front/js/vendors/uikit.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('front/js/vendors/indonez.min.js') }}" defer></script>
    @yield('scripts')
</body>

</html>
