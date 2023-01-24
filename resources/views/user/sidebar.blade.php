@section('sidebar')
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="user-profile text-center pt-2">

            <div class="profile-section">
                <p class="font-weight-light mb-0 font-18">{{ Auth::user()->name }}</p>
                <span class="op-7 font-14"></span>
                <div class="row border-top border-bottom mt-3 no-gutters">
                </div>
            </div>
        </div>

        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>

                    <li class="sidebar-item @yield('dashboard-li')">
                        <a class="sidebar-link sidebar-link @yield('dashboard')" href="{{ route('dashboard') }}"
                            aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">@lang('message.dashboard.dash')</span>
                        </a>
                    </li>

                    <li class="sidebar-item @yield('accounts-li')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('accounts-li')" data-toggle="dropdown" href="#"
                                aria-expanded="false" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="grid" class="feather-icon"></i>
                                <span class="hide-menu">@lang('message.dashboard.trade')</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item @yield('laccounts')" href="{{ route('account.liveaccounts') }}">
                                    <i class="fas fa-circle text-success font-12 mr-2"></i>
                                    @lang('message.dashboard.live')
                                </a>
                                <a class="dropdown-item @yield('daccounts')" href="{{ route('account.demoaccounts') }}">
                                    <i class="fas fa-circle text-warning font-12 mr-2"></i>
                                    @lang('message.dashboard.demo')
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="sidebar-item @yield('dw-li')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('accounts')" data-toggle="dropdown" href="#"
                                aria-expanded="false" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="dollar-sign" class="dollar-sign-icon"></i>
                                <span class="hide-menu">@lang('message.dashboard.deposits')</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item @yield('deposits')" href="{{ route('account.deposits') }}">
                                    <i class="fas fa-circle text-success font-12 mr-2"></i>
                                    @lang('message.dashboard.depo')
                                </a>
                                <a class="dropdown-item @yield('withdrawals')" href="{{ route('account.withdrawals') }}">
                                    <i class="fas fa-circle text-warning font-12 mr-2"></i>
                                    @lang('message.dashboard.with')
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="sidebar-item @yield('downloads-li')">
                        <a class="sidebar-link sidebar-link @yield('downloads')" href="{{ route('account.downloads') }}"
                            aria-expanded="false">
                            <i data-feather="download" class="download-icon"></i>
                            <span class="hide-menu">@lang('message.dashboard.down')</span>
                        </a>
                    </li>

                    <li class="sidebar-item @yield('support-li')">
                        <a class="sidebar-link sidebar-link @yield('support')" href="{{ route('account.support') }}"
                            aria-expanded="false">
                            <i data-feather="help-circle" class="help-circle-icon"></i>
                            @lang('message.dashboard.sup')
                        </a>
                    </li>

                    <li class="sidebar-item @yield('profile-li')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('profile') @yield('changepassword') @yield('security') @yield('support') @yield('winfo') @yield('notifications')"
                                data-toggle="dropdown" href="#" aria-expanded="false" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="user" class="user-icon"></i>
                                <span class="hide-menu">@lang('message.dashboard.my_pfl')</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item @yield('profile')" href="{{ route('account.profile') }}">
                                    <i class="fas fa-circle text-primary font-12 mr-2"></i>
                                    @lang('message.dashboard.update_pfl')
                                </a>
                                <a class="dropdown-item @yield('cpassword')" href="{{ route('changepassword') }}">
                                    <i class="fas fa-circle text-warning font-12 mr-2"></i>
                                    @lang('message.topmenu.chg_pss')
                                </a>
                                <a class="dropdown-item @yield('security')" href="{{ route('account.security') }}">
                                    <i class="fas fa-circle text-success font-12 mr-2"></i>
                                    @lang('message.dashboard.sec')
                                </a>
                                <a class="dropdown-item @yield('winfo')" href="{{ route('withdrawaldetails') }}">
                                    <i class="fas fa-circle text-primary font-12 mr-2"></i>
                                    @lang('message.dashboard.with_info')
                                </a>
                                <a class="dropdown-item @yield('notifications')" href="{{ route('notifications') }}">
                                    <i class="fas fa-circle font-12 mr-2"></i>
                                    @lang('message.dashboard.notif')
                                </a>
                                <a class="dropdown-item @yield('referrals')" href="{{ route('referrals') }}">
                                    <i class="fas fa-circle font-12 mr-2"></i>
                                    @lang('message.dashboard.my_referrals')
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="sidebar-item @yield('kyc-li')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('kyc')" data-toggle="dropdown" href="#"
                                aria-expanded="false" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="shield" class="shield-icon"></i>
                                <span class="hide-menu">KYC</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" onclick="event.preventDefault();">
                                    KYC Status: {{ Auth::user()->account_verify }}
                                </a>

                                @if (Auth::user()->account_verify != 'Verified')
                                    <a class="dropdown-item @yield('kyc')" href="{{ route('account.verify') }}">
                                        <i class="fas fa-circle text-warning font-12 mr-2"></i>
                                        Verify Account
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>

                    <li class="sidebar-item @yield('support-li')">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i data-feather="log-out" class="log-out-icon"></i>
                            @lang('message.topmenu.log')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
@endsection
