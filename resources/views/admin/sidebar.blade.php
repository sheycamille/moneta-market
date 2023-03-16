@section('sidebar')
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="user-profile text-center pt-2">
            <div class="profile-section">
                <p class="font-weight-light mb-0 font-18">Hi {{ Auth('admin')->User()->firstName }}</p>
                <span class="op-7 font-14"></span>
                <div class="row border-top border-bottom mt-3 no-gutters">
                </div>
            </div>
        </div>

        <!-- Sidebar scroll-->
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>
                    <li class="sidebar-item @yield('dashboard-li')">
                        <a class="sidebar-link sidebar-link @yield('dashboard')" href="{{ route('admin.dashboard') }}"
                            aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">@lang('message.dashboard.dash')</span>
                        </a>
                    </li>

                    <li class="sidebar-item @yield('musers-li')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('musers')" data-toggle="dropdown"
                                href="{{ route('manageusers') }}" aria-expanded="false" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="users" class="users-icon"></i>
                                <span class="hide-menu">Manage Users</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if (auth('admin')->user()->hasPermissionTo('muser-list', 'admin'))
                                    <a class="dropdown-item @yield('musers')" href="{{ route('manageusers') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        All Users
                                    </a>
                                @endif

                                @if (\App\Models\Setting::getValue('enable_kyc') == 'yes' &&
                                    auth('admin')->user()->hasPermissionTo('mkyc-list', 'admin'))
                                    <a class="dropdown-item @yield('mkyc')" href="{{ route('kyc') }}">
                                        <i class="fas fa-circle text-warning font-12 mr-2"></i>
                                        KYC
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>

                    <li class="sidebar-item @yield('mdw-li')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('mdeposits')" data-toggle="dropdown" href="#"
                                aria-expanded="false" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="dollar-sign" class="dollar-sign-icon"></i>
                                <span class="hide-menu">Manage D/W</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if (auth('admin')->user()->hasPermissionTo('mdeposit-list', 'admin'))
                                    <a class="dropdown-item @yield('mdeposits')" href="{{ route('mdeposits') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Manage Deposits
                                    </a>
                                @endif

                                @if (auth('admin')->user()->hasPermissionTo('mwithdrawal-list', 'admin'))
                                    <a class="dropdown-item @yield('withdrawals')" href="{{ route('mwithdrawals') }}">
                                        <i class="fas fa-circle text-warning font-12 mr-2"></i>
                                        Manage Withdrawals
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>

                    <li class="sidebar-item @yield('maccounts-li')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('maccounts')" data-toggle="dropdown" href="#"
                                aria-expanded="false" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="grid" class="grid-icon"></i>
                                <span class="hide-menu">Trader7 Accounts</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if (auth('admin')->user()->hasPermissionTo('mftd-list', 'admin'))
                                    <a class="dropdown-item @yield('ftds')" href="{{ route('mftds') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        FTDs
                                    </a>
                                @endif

                                @if (auth('admin')->user()->hasPermissionTo('macctype-list', 'admin'))
                                    <a class="dropdown-item @yield('accounttypes')" href="{{ route('accounttypes') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Account Types
                                    </a>
                                @endif
                                @if (auth('admin')->user()->hasPermissionTo('macctype-create', 'admin'))
                                    <a class="dropdown-item @yield('addaccounttype')" href="{{ route('showaddaccounttype') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Add Account Type
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>

                    <li class="sidebar-item @yield('madmins')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('madmins')" data-toggle="dropdown" href="#"
                                aria-expanded="false" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="shield" class="shield-icon"></i>
                                <span class="hide-menu">Administrator(s)</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if (auth('admin')->user()->hasPermissionTo('madmin-list', 'admin'))
                                    <a class="dropdown-item @yield('admins')" href="{{ route('madmins') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Manage Administrator(s)
                                    </a>
                                @endif
                                @if (auth('admin')->user()->hasPermissionTo('mrole-list', 'admin'))
                                    <a class="dropdown-item @yield('roles')" href="{{ route('manageroles') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Manage Role(s)
                                    </a>
                                @endif

                                @if (auth('admin')->user()->hasPermissionTo('mperm-list', 'admin'))
                                    <a class="dropdown-item @yield('perms')" href="{{ route('manageperms') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Manage Permission(s)
                                    </a>
                                @endif
                            </div>
                    </li>

                    @if (auth('admin')->user()->hasPermissionTo('msetting-list', 'admin'))
                        <li class="sidebar-item @yield('msettings-li')">
                            <div class="dropdown sub-dropdown">
                                <a class="sidebar-link sidebar-link @yield('settings')" data-toggle="dropdown"
                                    href="#" aria-expanded="false" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="settings" class="settings-icon"></i>
                                    <span class="hide-menu"> Settings</span>
                                    <span class="badge rounded-circle profile-dd text-center mt-2"><i
                                            class="fas fa-angle-down"></i></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item @yield('siteinfo')" href="{{ route('settings') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Site Information
                                    </a>
                                    <a class="dropdown-item @yield('sitepref')" href="{{ route('preferencesettings') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Site Preferences
                                    </a>
                                    <a class="dropdown-item @yield('sitepay')" href="{{ route('paymentsettings') }}">
                                        <i class="fas fa-circle text-success font-12 mr-2"></i>
                                        Payment Settings
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endif

                    <li class="sidebar-item @yield('profile-li')">
                        <div class="dropdown sub-dropdown">
                            <a class="sidebar-link sidebar-link @yield('profile-li')" data-toggle="dropdown" href="#"
                                aria-expanded="false" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i data-feather="user" class="user-icon"></i>
                                <span class="hide-menu">@lang('message.dashboard.my_pfl')</span>
                                <span class="badge rounded-circle profile-dd text-center mt-2">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item @yield('profile')" href="{{ route('adminchangepass') }}">
                                    <i class="fas fa-circle text-primary font-12 mr-2"></i>
                                    Change Password
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fas fa-circle text-success font-12 mr-2"></i>
                                    @lang('message.topmenu.log')
                                </a>
                                <form id="logout-form" action="{{ route('adminlogout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
@endsection
