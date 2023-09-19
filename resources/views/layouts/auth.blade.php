<!DOCTYPE html>
<html lang="{{ config('locale') }}" dir="ltr">

<head>
    <!-- Standard Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | {{ \App\Models\Setting::getValue('site_name') }}</title>

    <meta name="description" content="{{ \App\Models\Setting::getValue('site_description') }}">
    <meta name="keywords" content="{{ \App\Models\Setting::getValue('keywords') }}">
    <meta name="author" content="monetamarkets.net">

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

        <!-- section content begin -->
        <div class="uk-section uk-padding-remove-vertical">
            <div class="uk-container uk-container-expand">
                <div class="uk-grid" data-uk-height-viewport="expand: true">
                    <div class="uk-width-3-5@m uk-background-cover uk-background-center-right uk-visible@m uk-box-shadow-xlarge"
                        style="background-image: url({{ asset('front/img/in-signin-image.jpeg') }});">
                    </div>
                    <div class="uk-width-expand@m uk-flex uk-flex-middle">
                        <div class="uk-grid uk-flex-center">
                            <div class="uk-width-3">
                                <div class="in-padding-horizontal@s">
                                    <div class="">
                                        <ul class="ul">
                                            @if (App::getLocale() == 'en')
                                                <li><a class="li-1" href="{{ route('switchlang', 'fr') }}">FR</a>
                                                </li>
                                                <li><a class="li-2" href="{{ route('switchlang', 'es') }}">ES</a>
                                                </li>
                                            @elseif (App::getLocale() == 'fr')
                                                <li><a class="li-1" href="{{ route('switchlang', 'en') }}">EN</a>
                                                </li>
                                                <li><a class="li-2" href="{{ route('switchlang', 'es') }}">ES</a>
                                                </li>
                                            @else
                                                <li><a class="li-1" href="{{ route('switchlang', 'en') }}">EN</a>
                                                </li>
                                                <li><a class="li-2" href="{{ route('switchlang', 'FR') }}">FR</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <!-- module logo begin -->
                                    <a class="uk-logo" href="https://monetamarkets.net/">
                                        <img class="in-offset-top-10" src="{{ asset('front/img/group-logo.png') }}"
                                            data-src="{{ asset('front/img/group-logo.png') }}" alt="logo"
                                            width="180" height="36" data-uk-img>
                                    </a>
                                    <!-- module logo begin -->

                                    @yield('content')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- section content end -->

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
