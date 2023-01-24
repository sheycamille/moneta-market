@section('topbar')
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin1">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-brand">
                    <!-- Logo icon -->
                    <a href="/">
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('front/logo.png') }}" alt="homepage" class="logo dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{ asset('front/logo.png') }}" alt="homepage" class="logo light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{ asset('front/logo.png') }}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            {{-- <img src="{{ asset('front/logo.png') }}" class="light-logo" alt="homepage" /> --}}
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                    data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin1">
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav w-100 align-items-center">
                    <li class="nav-item ml-0 ml-md-3 ml-lg-0">
                        <a class="nav-link search-bar" href="javascript:void(0)">
                            <form class="my-2 my-lg-0" action="{{ route('refreshaccounts') }}">
                                <div class="customize-input customize-input-v4">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    <i class="form-control-icon" data-feather="search"></i>
                                </div>
                            </form>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="col-5 d-flex align-self-center">
                            <ul class="d-flex flex-row align-self-center text-white">
                                <li class="breadcrumb-item text-white"><a class="text-white" href="/dashboard">Home</a></li>
                                <?php $segments = ''; ?>
                                @for ($i = 1; $i <= count(Request::segments()); $i++)
                                    <?php $segments .= '/' . Request::segment($i); ?>
                                    @if ($i < count(Request::segments()))
                                        <li class="breadcrumb-item text-white">{{ ucfirst(Request::segment($i)) }}
                                        </li>
                                    @else
                                        <li class="breadcrumb-item text-white active">{{ ucfirst(Request::segment($i)) }}
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ml-auto">
                        <div class="col-5 d-flex align-self-center">
                            <ul class="d-flex flex-row align-self-center">
                                @if (App::getLocale() == 'en')
                                    <li><a class="btn btn-warning text-white" href="{{ route('switchlang', 'fr') }}">FR</a>
                                    </li>
                                    <li><a class="btn btn-danger text-white" href="{{ route('switchlang', 'es') }}">ES</a>
                                    </li>
                                @elseif (App::getLocale() == 'fr')
                                    <li><a class="btn btn-success text-white" href="{{ route('switchlang', 'en') }}">EN</a>
                                    </li>
                                    <li><a class="btn btn-danger text-white" href="{{ route('switchlang', 'es') }}">ES</a>
                                    </li>
                                @else
                                    <li><a class="btn btn-success text-white" href="{{ route('switchlang', 'en') }}">EN</a>
                                    </li>
                                    <li><a class="btn btn-primary text-white" href="{{ route('switchlang', 'FR') }}">FR</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
@endsection
