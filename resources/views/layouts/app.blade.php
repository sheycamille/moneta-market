<!DOCTYPE html>
<html lang="en">

<head>
    @yield('loadPaypal')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | {{ \App\Models\Setting::getValue('site_name') }}</title>

    <meta name="description"
        content="{{ \App\Models\Setting::getValue('site_description') }} Moneta Market offers CFDs on currency pairs and five other asset classes. Start trading forex online with the world's best forex broker.">
    <meta name="keywords"
        content="forex, exchange, broker, crypto, trading, indices, shares, stocks, bonds, cryptocurrencies, futures, energies">
    <meta name="author" content="monetamarket.ca">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f2f3f5" />

    <link rel="icon" href="{{ asset('front/favicon.png') }}" type="image/png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons-->
    <link href="{{ asset('admin/css/free.min.css') }}" rel="stylesheet"> <!-- icons -->

    {{-- <link href="{{ asset('admin/css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons --> --}}
    <!-- Main styles for this application-->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body class="c-app">

    @yield('sidebar')

    <div class="c-wrapper">

        @yield('topbar')

        <div class="c-body container">

            <main class="c-main">

                @yield('content')

            </main>

            <footer class="c-footer">
                <div><a href="https://monetamarket.ca">Moneta Market</a> &copy; 2022.</div>
                <div class="ml-auto">Powered by&nbsp;<a href="https://monetamarket.ca/">Moneta Market</a></div>
            </footer>
        </div>
    </div>

    <!-- Moneta Market and necessary plugins-->
    <script src="{{ asset('admin/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/coreui-utils.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    @yield('javascript')

</body>

</html>
