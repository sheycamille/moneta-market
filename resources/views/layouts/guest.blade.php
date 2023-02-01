<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | {{ \App\Models\Setting::getValue('site_name') }}</title>

    <meta name="description"
        content="{{ \App\Models\Setting::getValue('site_description') }} Moneta Market offers CFDs on currency pairs and five other asset classes. Start trading forex online with the world’s best forex broker.">
    <meta name="keywords"
        content="forex, exchange, broker, crypto, trading, indices, shares, stocks, bonds, cryptocurrencies, futures, energies">
    <meta name="author" content="gestiondupatrimoine.net">

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
    <link rel="preload" href="{{ asset('front/fonts/inter-v2-latin-regular.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('front/fonts/inter-v2-latin-500.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('front/fonts/inter-v2-latin-700.woff2') }}" as="font" type="font/woff2"
        crossorigin>

    <!-- Libraries CSS Files -->
    <link href="{{ asset('front/css/vendors/uikit.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <!-- preloader begin -->
    <div class="in-loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- preloader end -->

    <header>
        <!-- header content begin -->
        <div class="uk-section uk-padding-remove-vertical in-header-inner uk-background-cover uk-background-top-center"
            style="background-image: url({{ asset('front/img/in-liquid-slide-bg.png') }});">
            <nav class="uk-navbar-container" data-uk-sticky="show-on-up: true; animation: uk-animation-slide-top;">
                <div class="uk-container" data-uk-navbar>
                    <div class="uk-navbar-left">
                        <div class="uk-navbar-item">
                            <!-- logo begin -->
                            <a class="uk-logo" href="/">
                                <img src="{{ asset('front/img/group-logo.png') }}"
                                    data-src="{{ asset('front/img/group-logo.png') }}" alt="logo" width="160"
                                    height="34" data-uk-img>
                            </a>
                            <!-- logo end -->
                            <!-- navigation begin -->
                            <ul class="uk-navbar-nav uk-visible@m">
                                <li><a href="#">Markets<i class="fas fa-chevron-down"></i></a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li><a href="{{ route('forex') }}">Forex</a></li>
                                            <li><a href="{{ route('futures') }}">Futures</a></li>
                                            <li><a href="{{ route('indices') }}">Indices</a></li>
                                            <li><a href="{{ route('shares') }}">Shares</a></li>
                                            <li><a href="{{ route('metals') }}">Metals</a></li>
                                            <li><a href="{{ route('energies') }}">Energies</a></li>
                                            <li><a href="{{ route('crypto') }}">@lang('message.crypto_title')</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">Tools<i class="fas fa-chevron-down"></i></a>
                                    <div class="uk-navbar-dropdown uk-navbar-dropdown-width-2">
                                        <div class="uk-navbar-dropdown-grid uk-child-width-1-2" data-uk-grid>
                                            <div>
                                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                                    <li>
                                                        <h3>Platforms</h3>
                                                    </li>
                                                    <li><a href="{{ route('webtrader') }}">Web Trader</a></li>
                                                    <li><a href="{{ route('metatrader') }}">@lang('metatrader_five')</a></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                                    <li>
                                                        <h3>Trading Tools</h3>
                                                    </li>
                                                    <li><a href="{{ route('calender') }}">Economic Calender</a></li>
                                                    <li><a href="{{ route('news') }}">Forex News</a></li>
                                                    <li><a href="{{ route('calculator') }}">Calculator</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="{{ route('about') }}">Company<i class="fas fa-chevron-down"></i></a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li><a href="{{ route('about') }}">About Moneta Market</a></li>
                                            <li><a href="{{ route('credit-score') }}">Credit Score</a></li>
                                            <li><a href="{{ route('security') }}">Security</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                            <!-- navigation end -->
                        </div>
                    </div>
                    <div class="uk-navbar-right">
                        <div class="uk-navbar-item uk-visible@m in-optional-nav">
                            <a href="{{ route('register') }}" class="uk-button uk-button-primary uk-border-rounded"
                                style="margin-right: 10px;">Create Account</a>
                            <a href="{{ route('login') }}"
                                class="uk-button uk-button-primary uk-border-rounded">Login <i
                                    class="fas fa-user-circle"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- header content end -->
    </header>

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical in-liquid-breadcrumb">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <ul class="uk-breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><span>@yield('title')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->


    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    <footer>
        <!-- footer content begin -->
        <div class="uk-section uk-section-secondary in-footer-feature uk-margin-medium-top">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-6@m">
                        <div class="uk-grid uk-child-width-1-3@s" data-uk-grid>
                            <div class="uk-flex uk-flex-middle">
                                <div class="uk-margin-right">
                                    <i class="fas fa-history in-icon-wrap"></i>
                                </div>
                                <div>
                                    <h6 class="uk-margin-remove">5 years of Excellence</h6>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle uk-flex-center@m">
                                <div class="uk-margin-right">
                                    <i class="fas fa-trophy in-icon-wrap"></i>
                                </div>
                                <div>
                                    <h6 class="uk-margin-remove">15+ Global Awards</h6>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle uk-flex-right@m">
                                <div class="uk-margin-right">
                                    <i class="fas fa-phone-alt in-icon-wrap"></i>
                                </div>
                                <div>
                                    <h6 class="uk-margin-remove">24/6 Customer Support</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-section uk-background-secondary uk-light">
            <div class="uk-container uk-text-small">
                <div class="uk-child-width-1-2@m" data-uk-grid>
                    <div class="in-footer-logo">
                        <img src="{{ asset('front/img/in-lazy.gif') }}"
                            data-src="{{ asset('front/img/group-logo.png') }}" alt="logo" width="127"
                            height="27" data-uk-img>
                    </div>
                </div>
                <div class="uk-child-width-1-2@s uk-child-width-1-4@m uk-margin-large-top" data-uk-grid>
                    <div>
                        <h5>Markets</h5>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('forex') }}">Forex</a></li>
                            <li><a href="{{ route('futures') }}">Futures</a></li>
                            <li><a href="{{ route('indices') }}">Indices</a></li>
                            <li><a href="{{ route('shares') }}">Shares</a></li>
                            <li><a href="{{ route('metals') }}">Metals</a></li>
                            <li><a href="{{ route('energies') }}">Energies</a></li>
                            <li><a href="{{ route('crypto') }}">@lang('message.crypto_title')</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5>Trading Platforms</h5>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('webtrader') }}">Web Trader</a></li>
                            <li><a href="{{ route('metatrader') }}">@lang('metatrader_five')</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5>Trading Tools</h5>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('calender') }}">Economic Calender</a></li>
                            <li><a href="{{ route('news') }}">Forex News</a></li>
                            <li><a href="{{ route('calculator') }}">Calculator</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5>Company</h5>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('about') }}">About Moneta Market</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('credit-score') }}">Credit Score</a></li>
                            <li><a href="{{ route('security') }}">Security</a></li>
                        </ul>
                    </div>
                </div>
                <div class="uk-grid uk-margin-large-top">
                    <div class="uk-width-1-1">
                        <p class="uk-heading-line uk-margin-large-bottom"><span>Copyright ©2022 Moneta Market. All
                                Rights Reserved.</span></p>
                        <p class="in-trading-risk">Trading derivatives and leveraged products carries a high level of
                            risk, including the risk of losing substantially more than your initial investment. It is
                            not suitable for everyone. Before you make any decision in relation to a financial product
                            you should obtain and consider our Product Disclosure Statement (PDS) and Financial Services
                            Guide (FSG) available on our website and seek independent advice if necessary</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer content end -->
        <!-- totop begin -->
        <div class="uk-visible@m">
            <a href="#" class="in-totop fas fa-chevron-up" data-uk-scroll></a>
        </div>
        <!-- totop end -->
    </footer>

    <!-- Javascript -->
    <script src="{{ asset('front/js/vendors/uikit.min.js') }}"></script>
    <script src="{{ asset('front/js/vendors/blockit.min.js') }}"></script>

</body>

</html>
