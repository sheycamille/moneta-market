@section('topbar')
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <div class="container d-flex">
            <div class="c-sidebar-brand" style="margin-left:2%;">
                <a href="/">
                    <img class="c-sidebar-brand-full" src="{{ asset('front/img/group-logo.png') }}" width="150"
                        alt="Moneta Market Logo">
                    <img class="c-sidebar-brand-minimized" src="{{ asset('front/favicon.png') }}" width="100"
                        alt="Moneta Market Logo">
                </a>
            </div>

            <ul class="c-header-nav ml-auto mr-4 d-md-down-none">
                <li class="c-header-nav-link">
                    <a class="nav-link" href="{{ route('refreshaccounts') }}" aria-expanded="false">
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-reload') }}"></use>
                        </svg>
                        <strong>@lang('message.topmenu.refresh') </strong>
                    </a>
                </li>

                <li class="c-header-nav-item">
                    <a class="c-header-nav-link @yield('dashboard')" href="{{ route('dashboard') }}">
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-layers') }}"></use>
                        </svg>
                        @lang('message.dashboard.dash')
                    </a>
                </li>

                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link @yield('accounts')" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-wallet') }}"></use>
                        </svg>
                        @lang('message.dashboard.trade')
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-menu') }}"></use>
                        </svg>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="c-sidebar-nav-item">
                            <a class="c-header-nav-link @yield('live-accounts')" href="{{ route('account.liveaccounts') }}">
                                <span class="sub-item">@lang('message.dashboard.live')</span>
                            </a>
                        </li>

                        <li class="dropdown-divider"></li>

                        <li class="c-sidebar-nav-item">
                            <a class="c-header-nav-link @yield('demo-accounts')" href="{{ route('account.demoaccounts') }}">
                                <span class="sub-item">@lang('message.dashboard.demo')</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link @yield('deposits-and-withdrawals')" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-money') }}"></use>
                        </svg>
                        @lang('message.dashboard.deposits')
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-menu') }}"></use>
                        </svg>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="c-header-nav-link">
                            <a class="nav-link @yield('deposits')" href="{{ route('account.deposits') }}">
                                <span class="sub-item">@lang('message.dashboard.depo')</span>
                            </a>
                        </li>

                        <li class="dropdown-divider"></li>

                        <li class="c-header-nav-link">
                            <a class="nav-link @yield('withdrawals')" href="{{ route('account.withdrawals') }}">
                                <span class="sub-item">@lang('message.dashboard.with')</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="c-header-nav-item">
                    <a class="c-header-nav-link @yield('downloads')" href="{{ route('account.downloads') }}">
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-cloud-download') }}">
                            </use>
                        </svg>
                        @lang('message.dashboard.down')
                    </a>
                </li>

                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link @yield('kyc')" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        KYC
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-menu') }}"></use>
                        </svg>
                    </a>
                    <ul class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                        @if (Auth::user()->account_verify == 'Verified')
                            <li class="quick-actions-header text-center">
                                <span>
                                    KYC Status: Verified
                                </span>
                            </li>
                        @else
                            <li class="quick-actions-header text-center">
                                <span><a>KYC status: {{ Auth::user()->account_verify }}</a></span>
                            </li>
                            <li class="dropdown-divider"></li>
                        @endif

                        @if (Auth::user()->account_verify != 'Verified')
                            <li class="quick-actions-scroll scrollbar-outer">
                                <div class="quick-actions-items">
                                    <div class="m-0 row">
                                        <a href="{{ route('account.verify') }}" class="btn btn-success">Verify
                                            Account </a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link @yield('my-profile')" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        @lang('message.topmenu.hi') {{ Auth::user()->name }}
                        <svg class="c-icon">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-menu') }}"></use>
                        </svg>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item" href="{{ route('account.profile') }}">@lang('message.dashboard.my_pfl')</a>
                        </li>

                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item" href="{{ route('changepassword') }}">@lang('message.topmenu.chg_pss')</a>
                        </li>

                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item @yield('support')" href="{{ route('account.support') }}">
                                @lang('message.dashboard.sup')
                            </a>
                        </li>

                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item @yield('security')" href="{{ route('account.security') }}">
                                <span class="sub-item">@lang('message.dashboard.sec')</span>
                            </a>
                        </li>

                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item @yield('withdrawal-info')" href="{{ route('withdrawaldetails') }}">
                                <span class="sub-item">@lang('message.dashboard.with_info')</span>
                            </a>
                        </li>

                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item @yield('notifications')" href="{{ route('notifications') }}">
                                <span class="sub-item">@lang('message.dashboard.notif')</span>
                            </a>
                        </li>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            @lang('message.topmenu.log')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </li>
            </ul>

            <ul class="c-header-nav ml-auto mr-4 d-lg-none d-sm-flex mobile-menu">
                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link @yield('my-profile')" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <h5>
                            @lang('message.topmenu.hi')
                            @if (auth()->user()->name)
                                {{ auth()->user()->name }}
                            @else
                                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                            @endif
                            <svg class="c-icon">
                                <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-menu') }}"></use>
                            </svg>
                        </h5>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <h5>
                            <a class="" href="{{ route('refreshaccounts') }}" aria-expanded="false">
                                <svg class="c-icon">
                                    <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-reload') }}"></use>
                                </svg>
                                <strong>@lang('message.topmenu.refresh') </strong>
                            </a>
                        </h5>
                        <div class="dropdown-divider"></div>

                        <h5>
                            <a class="@yield('dashboard')" href="{{ route('dashboard') }}">
                                <svg class="c-icon">
                                    <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-layers') }}"></use>
                                </svg>
                                @lang('message.dashboard.dash')
                            </a>
                        </h5>
                        <div class="dropdown-divider"></div>

                        <h5>
                            <svg class="c-icon">
                                <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-wallet') }}"></use>
                            </svg>
                            @lang('message.dashboard.trade')
                        </h5>
                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="c-header-nav-link @yield('live-accounts')" href="{{ route('account.liveaccounts') }}">
                                <span class="sub-item">@lang('message.dashboard.live')</span>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>

                        <li class="c-sidebar-nav-item">
                            <a class="c-header-nav-link @yield('demo-accounts')" href="{{ route('account.demoaccounts') }}">
                                <span class="sub-item">@lang('message.dashboard.demo')</span>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>

                        <h5>
                            <svg class="c-icon">
                                <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-money') }}"></use>
                            </svg>
                            @lang('message.dashboard.deposits')
                        </h5>
                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="c-header-nav-link @yield('deposits')" href="{{ route('account.deposits') }}">
                                <span class="sub-item">@lang('message.dashboard.depo')</span>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>

                        <li class="c-sidebar-nav-item">
                            <a class="c-header-nav-link @yield('withdrawals')" href="{{ route('account.withdrawals') }}">
                                <span class="sub-item">@lang('message.dashboard.with')</span>
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="c-header-nav-link @yield('downloads')" href="{{ route('account.downloads') }}">
                                <svg class="c-icon">
                                    <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-cloud-download') }}">
                                    </use>
                                </svg>
                                @lang('message.dashboard.down')
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>

                        <h5>KYC</h5>
                        <li class="dropdown-divider"></li>

                        @if (Auth::user()->account_verify == 'Verified')
                            <li class="c-sidebar-nav-item text-center">
                                <span>
                                    KYC Status: Verified
                                </span>
                            </li>
                        @else
                            <li class="c-sidebar-nav-item text-center">
                                <span><a>KYC status: {{ Auth::user()->account_verify }}</a></span>
                            </li>
                            <li class="dropdown-divider"></li>
                        @endif

                        <li class="c-sidebar-nav-item">
                            @if (Auth::user()->account_verify != 'Verified')
                                <span class="c-header-nav-link">
                                    <a href="{{ route('account.verify') }}" class="btn btn-success btn-sm">Verify Account
                                    </a>
                                </span>
                            @endif
                        </li>
                        <li class="dropdown-divider"></li>

                        <h5>My Account</h5>
                        <div class="dropdown-divider"></div>
                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item" href="{{ route('account.profile') }}">@lang('message.dashboard.my_pfl')</a>
                        </li>
                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item" href="{{ route('changepassword') }}">@lang('message.topmenu.chg_pss')</a>
                        </li>
                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item @yield('support')" href="{{ route('account.support') }}">
                                @lang('message.dashboard.sup')
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item @yield('security')" href="{{ route('account.security') }}">
                                <span class="sub-item">@lang('message.dashboard.sec')</span>
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item @yield('withdrawal-info')" href="{{ route('withdrawaldetails') }}">
                                <span class="sub-item">@lang('message.dashboard.with_info')</span>
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>

                        <li class="c-sidebar-nav-item">
                            <a class="dropdown-item @yield('notifications')" href="{{ route('notifications') }}">
                                <span class="sub-item">@lang('message.dashboard.notif')</span>
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            @lang('message.topmenu.log')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </li>
            </ul>

        </div>
    </header>
@endsection
