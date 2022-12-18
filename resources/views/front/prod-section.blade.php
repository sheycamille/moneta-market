<div class="uk-section uk-section-secondary in-liquid-10">
    <div class="uk-container uk-light">
        <div class="uk-grid-medium uk-child-width-1-3@m uk-flex uk-flex-middle uk-grid" data-uk-grid="">
            <div class="uk-first-column">
                <h2>@lang('message.discover')</h2>
                <p class="uk-text-lead">@lang('message.choose_platform')?</p>
                <a class="uk-button uk-button-default uk-border-rounded uk-margin-top"
                    href="#">@lang('message.start_trading')<i class="fas fa-angle-right uk-margin-small-left"></i></a>
            </div>
            <div>
                <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded uk-text-center">
                    <img class="uk-margin-small-bottom" src="{{ asset('front/img/in-liquid-icon-17.svg') }}"
                        data-src="{{ asset('front/img/in-liquid-icon-17.svg') }}" alt="wave-award" width="72"
                        height="72" data-uk-img="">
                    <h3 class="uk-margin-top">SGM @lang('message.mtd')</h3>

                </div>
            </div>
            <div>
                <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded uk-text-center">
                    <img class="uk-margin-small-bottom" src="{{ asset('front/img/in-liquid-icon-18.svg') }}"
                        data-src="{{ asset('front/img/in-liquid-icon-18.svg') }}" alt="wave-award" width="72"
                        height="72" data-uk-img="">
                    <h3 class="uk-margin-top">@lang('message.trading_platforms.mobile_apps')</h3>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- section content begin -->
<div class="uk-section uk-padding-large in-padding-large-vertical@s in-profit-4">
    <div class="uk-container uk-margin-small-top uk-margin-medium-bottom">
        <div class="uk-grid uk-flex uk-flex-center " data-uk-grid>
            <div class="uk-width-5-6@m">
                <div class="uk-grid uk-flex-middle" data-uk-grid>
                    <div class="uk-width-expand@m">
                        <h2></h2>
                    </div>
                    <div class="uk-width-3-5@m">
                        <p class="uk-text-lead">@lang('message.home.access_more')</p>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1">
                <div class="uk-child-width-1-2@s uk-child-width-1-5@m in-profit-stockprice" data-uk-grid>
                    <div>
                        <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                            <span class="uk-float-left">
                                <img src="{{ asset('front/img/in-lazy.svg') }}"
                                    data-src="{{ asset('front/img/in-profit-ticker-1.svg') }}" alt="profit-ticker"
                                    width="77" height="20" data-uk-img>
                            </span>
                            <span class="uk-float-right down">
                                <i class="fas fa-arrow-down"></i>1,526.05
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                            <span class="uk-float-left">
                                <img src="{{ asset('front/img/in-lazy.svg') }}"
                                    data-src="{{ asset('front/img/in-profit-ticker-2.svg') }}" alt="profit-ticker"
                                    width="77" height="20" data-uk-img>
                            </span>
                            <span class="uk-float-right down">
                                <i class="fas fa-arrow-down"></i>205.37
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                            <span class="uk-float-left">
                                <img src="{{ asset('front/img/in-lazy.svg') }}"
                                    data-src="{{ asset('front/img/in-profit-ticker-3.svg') }}" alt="profit-ticker"
                                    width="77" height="20" data-uk-img>
                            </span>
                            <span class="uk-float-right down">
                                <i class="fas fa-arrow-down"></i>267.97
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                            <span class="uk-float-left">
                                <img src="{{ asset('front/img/in-lazy.svg') }}"
                                    data-src="{{ asset('front/img/in-profit-ticker-4.svg') }}" alt="profit-ticker"
                                    width="77" height="20" data-uk-img>
                            </span>
                            <span class="uk-float-right up">
                                <i class="fas fa-arrow-up"></i>59,230
                            </span>
                        </div>
                    </div>
                    <div class="uk-visible@m">
                        <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-pill">
                            <span class="uk-float-left">
                                <img src="{{ asset('front/img/in-lazy.svg') }}"
                                    data-src="{{ asset('front/img/in-profit-ticker-5.svg') }}" alt="profit-ticker"
                                    width="77" height="20" data-uk-img>
                            </span>
                            <span class="uk-float-right up">
                                <i class="fas fa-arrow-up"></i>78.98
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-5-6@m">
                <div class="uk-grid-large uk-flex-middle" data-uk-grid>
                    <div class="uk-width-auto@m">
                        <h4 class="uk-margin-remove-bottom uk-text-primary">@lang('message.home.ready_2trade')</h4>
                        <p class="uk-margin-remove-top">@lang('message.home.get_stat')</p>
                    </div>
                    <div class="uk-width-expand@m">
                        <form class="uk-grid-small" data-uk-grid action="{{ route('register') }}">
                            <div class="uk-width-1-1 uk-width-expand@m">
                                <input name="email" class="uk-input uk-border-rounded" type="text"
                                    placeholder="@lang('message.register.email')">
                            </div>
                            <div class="uk-width-1-1 uk-width-expand@m">
                                <input name="phone" class="uk-input uk-border-rounded" type="text"
                                    placeholder="@lang('message.body.phone')">
                            </div>
                            <div class="uk-width-1-1 uk-width-auto@m">
                                <button
                                    class="uk-button uk-button-primary uk-border-rounded uk-width-expand">@lang('message.open_account')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
