@section('sidebar')
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand">
            <a href="/">
                <img class="c-sidebar-brand-full" src="{{ asset('front/img/group-logo.png') }}" width="100" alt="Moneta Market Logo">
                <img class="c-sidebar-brand-minimized" src="{{ asset('front/favicon.png') }}" width="40" alt="Moneta Market Logo">
            </a>
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('dashboard') }}">
                    <i class="cil-speedometer c-sidebar-nav-icon"></i>
                    @lang('message.dashboard.dash')
                </a>
            </li>

            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle @yield('my-account')" href="#">
                    <i class="cil-wallet c-sidebar-nav-icon"></i>
                    @lang('message.dashboard.my_act')
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('my-profile')" href="{{ route('account.profile') }}">
                            @lang('message.dashboard.my_pfl')
                        </a>
                    </li>
                    @if (\App\Models\Setting::getValue('enable_kyc') == 'yes')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link @yield('kyc')" href="{{ route('account.verify') }}">
                                <span class="link-collapse">@lang('message.dashboard.kyc')</span>
                            </a>
                        </li>
                    @endif
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('security')" href="{{ route('account.security') }}">
                            <span class="sub-item">@lang('message.dashboard.sec')</span>
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('withdrawal-info')" href="{{ route('withdrawaldetails') }}">
                            <span class="sub-item">@lang('message.dashboard.with_info')</span>
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('notifications')" href="{{ route('notifications') }}">
                            <span class="sub-item">@lang('message.dashboard.notif')</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle @yield('accounts')" href="#">
                    <i class="cil-window-restore c-sidebar-nav-icon"></i>
                    @lang('message.dashboard.trade')
                </a>

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('live-accounts')" href="{{ route('account.liveaccounts') }}">
                            <span class="sub-item">@lang('message.dashboard.live')</span>
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('demo-accounts')" href="{{ route('account.demoaccounts') }}">
                            <span class="sub-item">@lang('message.dashboard.demo')</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @yield('transactions')" href="{{ route('account.history') }}">
                <i class="cil-history c-sidebar-nav-icon"></i>
                @lang('message.dashboard.trans')
            </a>
        </li> --}}

            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle @yield('deposits-and-withdrawals')" href="#">
                    <i class="cil-money c-sidebar-nav-icon"></i>
                    @lang('message.dashboard.deposits')
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('deposits')" href="{{ route('account.deposits') }}">
                            <span class="sub-item">@lang('message.dashboard.depo')</span>
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link @yield('withdrawals')" href="{{ route('account.withdrawals') }}">
                            <span class="sub-item">@lang('message.dashboard.with')</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link @yield('downloads')" href="{{ route('account.downloads') }}">
                    <i class="cil-cloud-download c-sidebar-nav-icon"></i>
                    @lang('message.dashboard.down')
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link @yield('support')" href="{{ route('account.support') }}">
                    <i class="cil-headphones c-sidebar-nav-icon"></i>
                    @lang('message.dashboard.sup')
                </a>
            </li>
        </ul>
    </div>
@endsection
