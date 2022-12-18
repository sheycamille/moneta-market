@section('sidebar')
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand" style="padding: 20px;">
            <a href="/">
                <img class="c-sidebar-brand-full" src="{{ asset('front/img/group-logo.png') }}" width="160"
                    alt="Moneta Market Logo">
                <img class="c-sidebar-brand-minimized" src="{{ asset('front/favicon.png') }}" width="100"
                    alt="Moneta Market Logo">
            </a>
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link @yield('dashboard')" href="{{ route('admin.dashboard') }}">
                    <i class="cil-speedometer c-sidebar-nav-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="c-sidebar-nav-dropdown @yield('manage-users')">
                <a class="c-sidebar-nav-dropdown-toggle" href="{{ route('manageusers') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>
                    Manage Users
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @if (auth('admin')->user()->hasPermissionTo('muser-list', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('users')" href="{{ route('manageusers') }}">
                                All Users</a>
                        </li>
                    @endif

                    @if (\App\Models\Setting::getValue('enable_kyc') == 'yes' &&
                        auth('admin')->user()->hasPermissionTo('mkyc-list', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('kyc')" href="{{ route('kyc') }}">
                                KYC
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="c-sidebar-nav-dropdown @yield('manage-dw')">
                <a class="c-sidebar-nav-dropdown-toggle" data-toggle="collapse" href="#mdw">
                    <i class="cil-money c-sidebar-nav-icon"></i>
                    Manage D/W
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @if (auth('admin')->user()->hasPermissionTo('mdeposit-list', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('deposits')" href="{{ route('mdeposits') }}">
                                Manage Deposits
                            </a>
                        </li>
                    @endif

                    @if (auth('admin')->user()->hasPermissionTo('mwithdrawal-list', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('withdrawals')" href="{{ route('mwithdrawals') }}">
                                Manage Withdrawals
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="c-sidebar-nav-dropdown @yield('maccounts')">
                <a class="c-sidebar-nav-dropdown-toggle" data-toggle="collapse" href="#macc">
                    <i class="cil-monitor c-sidebar-nav-icon"></i>
                    Trader7 Accounts
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @if (auth('admin')->user()->hasPermissionTo('mftd-list', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('ftds')" href="{{ route('mftds') }}">
                                FTDs
                            </a>
                        </li>
                    @endif
                    @if (auth('admin')->user()->hasPermissionTo('macctype-list', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('accounttypes')" href="{{ route('accounttypes') }}">
                                Account Types
                            </a>
                        </li>
                    @endif
                    @if (auth('admin')->user()->hasPermissionTo('macctype-create', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('addaccounttype')" href="{{ route('showaddaccounttype') }}">
                                Add Account Type
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="c-sidebar-nav-dropdown @yield('manage-admins')">
                <a class="c-sidebar-nav-dropdown-toggle" data-toggle="collapse" href="#adm">
                    <i class="cil-user-unfollow c-sidebar-nav-icon"></i>
                    Administrator(s)
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @if (auth('admin')->user()->hasPermissionTo('madmin-list', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('admins')" href="{{ route('madmins') }}">
                                Manage Administrator(s)
                            </a>
                        </li>
                    @endif
                    @if (auth('admin')->user()->hasPermissionTo('mrole-list', 'admin'))
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('roles')" href="{{ route('manageroles') }}">
                                Manage Role(s)
                            </a>
                    @endif
            </li>
            @if (auth('admin')->user()->hasPermissionTo('mperm-list', 'admin'))
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link @yield('perms')" href="{{ route('manageperms') }}">
                        Manage Permission(s)
                    </a>
                </li>
            @endif
        </ul>
        </li>

        {{-- <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @yield('frontend-control')" href="{{ route('frontpage') }}">
                <i class="fa fa-sitemap" aria-hidden="true"></i>
                <p>Front-end control</p>
            </a>
        </li> --}}

        @if (auth('admin')->user()->hasPermissionTo('msetting-list', 'admin'))
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle @yield('settings')" data-toggle="collapse">
                    <i class="cil-settings c-sidebar-nav-icon"></i>
                    Settings
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('siteinfo')" href="{{ route('settings') }}">
                            Site Information
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('sitepref')" href="{{ route('preferencesettings') }}">
                            Site Preferences
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('sitepay')" href="{{ route('paymentsettings') }}">
                            Payment Settings
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
    </div>
@endsection
