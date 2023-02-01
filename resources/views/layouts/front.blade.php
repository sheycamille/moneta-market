<!DOCTYPE html>
<html lang="{{ config('locale') }}" dir="ltr">

<head>
    <!-- Standard Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | {{ \App\Models\Setting::getValue('site_name') }}</title>

    <meta name="description" content="{{ \App\Models\Setting::getValue('site_description') }}">
    <meta name="keywords" content="{{ \App\Models\Setting::getValue('keywords') }}">
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
    <link rel="preload" href="{{ asset('front/fonts/lato-v16-latin-700.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('front/fonts/lato-v16-latin-regular.woff2') }}" as="font"
        type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('front/fonts/montserrat-v14-latin-600.woff2') }}" as="font"
        type="font/woff2" crossorigin>

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
        <div class="uk-section uk-padding-small in-profit-ticker">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <div data-uk-slider="autoplay: true; autoplay-interval: 5000">
                            <ul class="uk-grid-large uk-slider-items uk-child-width-1-3@s uk-child-width-1-6@m uk-text-center"
                                data-uk-grid>
                                <li>
                                    <i class="fas fa-angle-up in-icon-wrap small circle up"></i> XAUUSD <span
                                        class="uk-text-success">1478.81</span>
                                </li>
                                <li>
                                    <i class="fas fa-angle-down in-icon-wrap small circle down"></i> GBPUSD <span
                                        class="uk-text-danger">1.3191</span>
                                </li>
                                <li>
                                    <i class="fas fa-angle-down in-icon-wrap small circle down"></i> EURUSD <span
                                        class="uk-text-danger">1.1159</span>
                                </li>
                                <li>
                                    <i class="fas fa-angle-up in-icon-wrap small circle up"></i> USDJPY <span
                                        class="uk-text-success">109.59</span>
                                </li>
                                <li>
                                    <i class="fas fa-angle-up in-icon-wrap small circle up"></i> USDCAD <span
                                        class="uk-text-success">1.3172</span>
                                </li>
                                <li>
                                    <i class="fas fa-angle-up in-icon-wrap small circle up"></i> USDCHF <span
                                        class="uk-text-success">0.9776</span>
                                </li>
                                <li>
                                    <i class="fas fa-angle-down in-icon-wrap small circle down"></i> AUDUSD <span
                                        class="uk-text-danger">0.67064</span>
                                </li>
                                <li>
                                    <i class="fas fa-angle-up in-icon-wrap small circle up"></i> GBPJPY <span
                                        class="uk-text-success">141.91</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section uk-padding-remove-vertical">
            <!-- module navigation begin -->
            <nav class="uk-navbar-container uk-navbar-transparent"
                data-uk-sticky="show-on-up: true; top: 80; animation: uk-animation-fade;">
                <div class="uk-container" data-uk-navbar>
                    <div class="uk-navbar-left uk-width-auto">
                        <div class="uk-navbar-item">
                            <!-- module logo begin -->
                            <a class="uk-logo" href="{{ route('home') }}">
                                <img class="in-offset-top-10" src="{{ asset('front/img/group-logo.png') }}"
                                    data-src="{{ asset('front/img/group-logo.png') }}" alt="logo" width="180"
                                    height="36" data-uk-img>
                            </a>
                            <!-- module logo begin -->
                        </div>
                    </div>

                    <div class="uk-navbar-right uk-width-expand uk-flex uk-flex-right">
                        <ul class="uk-navbar-nav uk-visible@m">
                            <li class="@yield('home-menu-item')"><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>

                            <li class="@yield('markets')"><a href="#">@lang('message.markets')<i
                                        class="fas fa-chevron-down"></i></a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class="@yield('forex-menu-item')"><a
                                                href="{{ route('forex') }}">@lang('message.frex')</a></li>
                                        <li class="@yield('futures-menu-item')"><a
                                                href="{{ route('futures') }}">@lang('message.fts')</a></li>
                                        <li class="@yield('indices-menu-item')"><a
                                                href="{{ route('indices') }}">@lang('message.idc')</a></li>
                                        <li class="@yield('shares-menu-item')"><a
                                                href="{{ route('shares') }}">@lang('message.shr')</a></li>
                                        <li class="@yield('metals-menu-item')"><a
                                                href="{{ route('metals') }}">@lang('message.mtl')</a></li>
                                        <li class="@yield('energies-menu-item')"><a
                                                href="{{ route('energies') }}">@lang('message.egy')</a></li>
                                        <li class="@yield('crypto-menu-item')"><a
                                                href="{{ route('crypto') }}">@lang('message.crypto_title')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="@yield('tools')"><a href="#">@lang('message.tools')<i
                                        class="fas fa-chevron-down"></i></a>
                                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-2">
                                    <div class="uk-navbar-dropdown-grid uk-child-width-1-2" data-uk-grid>
                                        <div>
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li>
                                                    <h3>@lang('message.pfm')</h3>
                                                </li>
                                                <li class="@yield('webtrader-menu-item')"><a
                                                        href="{{ route('webtrader') }}">@lang('message.wtd')</a></li>
                                                <li class="@yield('trader7-menu-item')"><a
                                                        href="{{ route('trader7') }}">@lang('message.mtd')</a>
                                                </li>
                                                <br>

                                                <li>
                                                    <h6>@lang('message.policies')</h6>
                                                </li>
                                                <li class="@yield('privacy-menu-item')"><a
                                                        href="{{ route('privacy') }}">@lang('message.pri_pol')</a>
                                                </li>
                                                <li class="@yield('terms-of-serv-menu-item')"><a
                                                        href="{{ route('terms-of-serv') }}">@lang('message.trms')
                                                    </a></li>
                                                <li class="@yield('order-execution-menu-item')"><a
                                                        href="{{ route('order-execution') }}">@lang('message.ordr')
                                                    </a></li>
                                                <li class="@yield('risk-disclosure-menu-item')"><a
                                                        href="{{ route('risk-disclosure') }}">@lang('message.risk_dis')</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li>
                                                    <h3>@lang('message.trading_tools')</h3>
                                                </li>
                                                <li class="@yield('calender-menu-item')"><a
                                                        href="{{ route('calender') }}">@lang('message.ecn_cal')</a>
                                                </li>
                                                <li class="@yield('news-menu-item')"><a
                                                        href="{{ route('news') }}">@lang('message.frx_nws_page')</a>
                                                </li>
                                                <li class="@yield('calculator-menu-item')"><a
                                                        href="{{ route('calculator') }}">@lang('message.calc')</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="@yield('company')">
                                <a href="#">
                                    @lang('message.company')<i class="fas fa-chevron-down"></i>
                                </a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class="@yield('about-menu-item')"><a
                                                href="{{ route('about') }}">@lang('message.abt')</a></li>
                                        <li class="@yield('contact-menu-item')"><a
                                                href="{{ route('contact') }}">@lang('message.ctc')</a></li>
                                        <li class="@yield('contact-menu-item')"><a
                                                href="{{ route('account-types') }}">@lang('message.account_types')</a></li>
                                        <li class="@yield('credit-score-menu-item')"><a
                                                href="{{ route('credit-score') }}">@lang('message.cdt')</a></li>
                                        <li class="@yield('security-menu-item')"><a
                                                href="{{ route('security') }}">@lang('message.sec')</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li><a href="#">{{ strtoupper(App::getLocale()) }}<i
                                        class="fas fa-chevron-down"></i></a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        @if (App::getLocale() == 'en')
                                            <li><a href="{{ route('switchlang', 'fr') }}">FR</a></li>
                                            <li><a href="{{ route('switchlang', 'es') }}">ES</a></li>
                                        @elseif (App::getLocale() == 'fr')
                                            <li><a href="{{ route('switchlang', 'en') }}">EN</a></li>
                                            <li><a href="{{ route('switchlang', 'es') }}">ES</a></li>
                                        @else
                                            <li><a href="{{ route('switchlang', 'en') }}">EN</a></li>
                                            <li><a href="{{ route('switchlang', 'FR') }}">FR</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        </ul>

                        <div class="uk-navbar-item in-mobile-nav uk-hidden@m">
                            <a class="uk-button" href="#modal-full" data-uk-toggle=""><i
                                    class="fas fa-bars"></i></a>
                        </div>

                        <div class="uk-navbar-item uk-visible@m in-optional-nav">
                            <div>
                                <a href="{{ route('login') }}" class="uk-button uk-button-text">
                                    @lang('message.log') <i class="fas fa-user-circle"></i></a>
                                <a href="{{ route('register') }}" class="uk-button uk-button-text"
                                    style="margin-right: 10px;">@lang('message.crt_acnt')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- module navigation end -->
        </div>
        <!-- header content end -->
    </header>

    @yield('content')

    <footer>
        <!-- footer content begin -->
        <div class="uk-section uk-section-primary uk-padding-large uk-padding-remove-horizontal uk-margin-medium-top">
            <div class="uk-container">
                <div class="uk-child-width-1-2@s uk-child-width-1-5@m uk-flex" data-uk-grid>
                    <div>
                        <h4 class="uk-heading-bullet">@lang('Overview')</h4>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('forex') }}">@lang('message.frex')</a></li>
                            <li><a href="{{ route('futures') }}">@lang('message.fts')</a></li>
                            <li><a href="{{ route('indices') }}">@lang('message.idc')</a></li>
                            <li><a href="{{ route('shares') }}">@lang('message.shr')</a></li>
                            <li><a href="{{ route('metals') }}">@lang('message.mtl')</a></li>
                            <li><a href="{{ route('energies') }}">@lang('message.egy')</a></li>
                            <li><a href="{{ route('crypto') }}">@lang('message.crypto_title')</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="uk-heading-bullet">@lang('message.company')</h4>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('about') }}">@lang('message.abt')</a></li>
                            <li><a href="{{ route('contact') }}">@lang('message.ctc')</a></li>
                            <li><a href="{{ route('credit-score') }}">@lang('message.cdt')</a></li>
                            <li><a href="{{ route('security') }}">@lang('message.sec')</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="uk-heading-bullet">@lang('message.policies')</h4>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('privacy') }}">@lang('message.pri_pol')</a></li>
                            <li><a href="{{ route('terms-of-serv') }}">@lang('message.trms') </a></li>
                            <li><a href="{{ route('order-execution') }}">@lang('message.ordr') </a></li>
                            <li><a href="{{ route('risk-disclosure') }}">@lang('message.risk_dis')</a></li>
                        </ul>

                        <h5>@lang('message.pfm')</h5>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('webtrader') }}">@lang('Web Trader')</a></li>
                            <li><a href="{{ route('trader7') }}">@lang('message.mtd')</a></li>
                        </ul>
                    </div>

                    <div class="uk-visible@m">
                        <h4 class="uk-heading-bullet">@lang('message.trading_tools')</h4>
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('calender') }}">@lang('message.ecn_cal')</a></li>
                            <li><a href="{{ route('news') }}">@lang('message.frx_nws_page')</a></li>
                            <li><a href="{{ route('calculator') }}">@lang('message.calc')</a></li>
                        </ul>
                    </div>

                    <div class="uk-flex-first uk-flex-last@m">
                        <ul class="uk-list uk-link-text">
                            <li><a href="{{ route('home') }}"><img class="uk-margin-small-bottom"
                                        src="{{ asset('front/img/group-logo.png') }}"
                                        data-src="{{ asset('front/img/group-logo.png') }}" alt="logo"
                                        width="180" height="36" data-uk-img></a></li>
                            <li><a href="mailto:support@gestiondupatrimoine.net"><i
                                        class="fas fa-envelope uk-margin-small-right"></i>support@gestiondupatrimoine.net</a>
                            </li>
                            <li><a href="#"><i class="fas fa-map-marker-alt uk-margin-small-right"></i>F26 First
                                    Floor, Eden Plaza, Eden Island, Seychelles</a></li>
                        </ul>
                    </div>
                </div>

                <div class="uk-grid uk-flex uk-flex-center uk-margin-large-top" data-uk-grid>
                    <div class="uk-width-5-6@m uk-margin-bottom">
                        <div class="in-footer-warning in-margin-top-20@s">
                            <h5 class="uk-text-small uk-text-uppercase"><span>@lang('Risk Warning')</span></h5>
                            <p class="uk-text-small">@lang('message.copyright_2')</p>
                        </div>
                    </div>
                    <div class="uk-width-1-2@m in-copyright-text">
                        <p><span>@lang('message.copyright').</span></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer content end -->

        <div class="uk-visible@m">
            <a href="#" class="in-totop fas fa-chevron-up uk-animation-slide-top" data-uk-scroll=""
                style="opacity: 1;"></a>
        </div>
    </footer>

    <!-- Javascript -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('front/js/vendors/uikit.min.js') }}" defer></script>
    <script src="{{ asset('front/js/vendors/indonez.min.js') }}" defer></script>
    <script src="{{ asset('front/js/vendors/tp.widget.bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/config-theme.js') }}" defer></script>

    <div id="modal-full" class="uk-modal-full uk-modal" data-uk-modal="" style="">
        <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport=""
            style="min-height: calc(100vh);">
            <a class="uk-modal-close-full uk-button"><i class="fas fa-times"></i></a>
            <div class="uk-width-large uk-padding-large">
                <ul class="uk-nav-default uk-nav-parent-icon uk-nav" data-uk-nav="">
                    <li class="@yield('home-menu-item')"><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>

                    <li class="@yield('markets') uk-parent"><a href="#">@lang('message.markets')</a>
                        <ul class="uk-nav-sub">
                            <li class="@yield('forex-menu-item')"><a href="{{ route('forex') }}">@lang('message.frex')</a>
                            </li>
                            <li class="@yield('futures-menu-item')"><a href="{{ route('futures') }}">@lang('message.fts')</a>
                            </li>
                            <li class="@yield('indices-menu-item')"><a href="{{ route('indices') }}">@lang('message.idc')</a>
                            </li>
                            <li class="@yield('shares-menu-item')"><a href="{{ route('shares') }}">@lang('message.shr')</a>
                            </li>
                            <li class="@yield('metals-menu-item')"><a href="{{ route('metals') }}">@lang('message.mtl')</a>
                            </li>
                            <li class="@yield('energies-menu-item')"><a href="{{ route('energies') }}">@lang('message.egy')</a>
                            </li>
                            <li class="@yield('crypto-menu-item')"><a href="{{ route('crypto') }}">@lang('message.crypto_title')</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@yield('tools') uk-parent">
                        <a href="#">@lang('message.tools')</a>
                        <ul class="uk-nav-sub">
                            <li>
                                <h3>@lang('message.pfm')</h3>
                            </li>
                            <li class="@yield('webtrader-menu-item')"><a
                                    href="{{ route('webtrader') }}">@lang('message.wtd')</a></li>
                            <li class="@yield('trader7-menu-item')"><a href="{{ route('trader7') }}">@lang('message.mtd')</a>
                            </li>
                            <br>

                            <li>
                                <h6>@lang('message.policies')</h6>
                            </li>
                            <li class="@yield('privacy-menu-item')"><a href="{{ route('privacy') }}">@lang('message.pri_pol')</a>
                            </li>
                            <li class="@yield('terms-of-serv-menu-item')"><a
                                    href="{{ route('terms-of-serv') }}">@lang('message.trms')
                                </a></li>
                            <li class="@yield('order-execution-menu-item')"><a
                                    href="{{ route('order-execution') }}">@lang('message.ordr')
                                </a></li>
                            <li class="@yield('risk-disclosure-menu-item')"><a
                                    href="{{ route('risk-disclosure') }}">@lang('message.risk_dis')</a>
                            </li>
                            <br>

                            <li>
                                <h3>@lang('message.trading_tools')</h3>
                            </li>
                            <li class="@yield('calender-menu-item')"><a href="{{ route('calender') }}">@lang('message.ecn_cal')</a>
                            </li>
                            <li class="@yield('news-menu-item')"><a href="{{ route('news') }}">@lang('message.frx_nws_page')</a>
                            </li>
                            <li class="@yield('calculator-menu-item')"><a
                                    href="{{ route('calculator') }}">@lang('message.calc')</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@yield('company') uk-parent">
                        <a href="#">@lang('message.company')</a>
                        <ul class="uk-nav-sub">
                            <li class="@yield('about-menu-item')"><a href="{{ route('about') }}">@lang('message.abt')</a>
                            </li>
                            <li class="@yield('contact-menu-item')"><a href="{{ route('contact') }}">@lang('message.ctc')</a>
                            </li>
                            <li class="@yield('contact-menu-item')"><a
                                    href="{{ route('account-types') }}">@lang('message.account_types')</a></li>
                            <li class="@yield('credit-score-menu-item')"><a
                                    href="{{ route('credit-score') }}">@lang('message.cdt')</a></li>
                            <li class="@yield('security-menu-item')"><a href="{{ route('security') }}">@lang('message.sec')</a>
                            </li>
                        </ul>
                    </li>

                    <li class="uk-parent"><a href="#">{{ strtoupper(App::getLocale()) }}</a>
                        <ul class="uk-nav-sub">
                            @if (App::getLocale() == 'en')
                                <li><a href="{{ route('switchlang', 'fr') }}">FR</a></li>
                            @else
                                <li><a href="{{ route('switchlang', 'en') }}">EN</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
                <a href="{{ route('login') }}"
                    class="uk-button uk-button-primary uk-border-rounded uk-align-center">LOGIN<i
                        class="fas fa-sign-in-alt uk-margin-small-left"></i></a>
            </div>
        </div>
    </div>
</body>

</html>
