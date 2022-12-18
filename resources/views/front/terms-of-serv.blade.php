@extends('layouts.front')

@section('title', __('message.terms_service.terms'))

@section('tools', 'uk-active')
@section('terms-of-serv-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.tools')</a></li>
                        <li><span>@lang('message.terms_service.terms')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb content end -->

    <main id="main" class="security-page">

        <div class="uk-section in-liquid-6 in-offset-top-10">
            <div class="uk-container">
                <div class="uk-grid uk-flex uk-flex-center">
                    <div class="uk-width-5-6@m uk-background-contain uk-background-center-center">
                        <div class="uk-text-center">
                            <h1 class="uk-margin-remove">@lang('message.terms_service.terms') </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom ">
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.terms_service.client')
                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">
                                @lang('message.terms_service.b1')
                            </p>
                        </div>
                    </div>
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom ">
                            <h3 class="uk-margin-small-bottom" style="text-align: start;">
                                @lang('message.terms_service.risk')
                            </h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.terms_service.b3')
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1 in-content-10">

                        <div class="uk-grid-divider uk-child-width-1-1@m uk-child-width-1-2@s
uk-margin-medium-top uk-grid"
                            data-uk-grid="">
                            <div class="uk-first-column">
                                <h4 class="uk-heading-bullet ">@lang('message.terms_service.details')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p> @lang('message.terms_service.b4')
                                            <br><br>@lang('message.terms_service.b5')<br><br>@lang('message.terms_service.b6')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.headings.head')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>- @lang('message.headings.b1'). <br><br>- @lang('message.headings.b2') <br><br>-
                                            @lang('message.headings.b3')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.application.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.application.b1') . <br><br>@lang('message.application.b2')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.eligibility.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.eligibility.reg')
                                            . <br><br>@lang('message.eligibility.b1')
                                            <br><br>@lang('message.eligibility.eligibl')
                                            <br><br>@lang('message.eligibility.b2')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.offerings.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.offerings.b1')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.communication.head')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.communication.b1')
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.funding.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.funding.b1') . <br><br>@lang('message.funding.b2')
                                            <br><br>@lang('message.funding.b3')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.refund_policy.head')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.refund_policy.b1')
                                            . <br><br>@lang('message.refund_policy.b2')
                                            <br><br>@lang('message.refund_policy.b3')
                                            <BR>@lang('message.refund_policy.b4')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.client_fund.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.client_fund.b1')
                                            . <br><br>@lang('message.client_fund.b2')
                                            <br><br>@lang('message.client_fund.b3')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.fund_transfer.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.fund_transfer.b1') . <br><br>@lang('message.fund_transfer.b2')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.responsibility.head') </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>-@lang('message.responsibility.b1') . <br><br>-
                                            @lang('message.responsibility.b2')
                                            <br><br>-@lang('message.responsibility.b3') <br><br>-
                                            @lang('message.responsibility.b4')
                                            <br><br>- @lang('message.responsibility.b5')
                                            <br><br>@lang('message.responsibility.b6')
                                            <br><br>@lang('message.responsibility.b7')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet"> @lang('message.bonus.head') </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.bonus.b1') . <br><br>@lang('message.bonus.b2')
                                            <br><br>@lang('message.bonus.b3')
                                            <br><br>@lang('message.bonus.b4')<br><br>@lang('message.bonus.b5')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.seclusion.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.seclusion.b1')
                                            <br><br>@lang('message.seclusion.b2') <br><br>@lang('message.seclusion.b3')
                                            <br><br>@lang('message.seclusion.b4') <br><br>@lang('message.seclusion.b5')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.fees.head')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.fees.b1') . <br><br>@lang('message.fees.b2')
                                            <br><br>@lang('message.fees.b3') <br><br>@lang('message.fees.b4')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.margin.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.margin.b1') . <br><br>@lang('message.margin.b2')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.abritage.head')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.abritage.b1')</p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.derivatives_policy.head')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.derivatives_policy.b1')
                                            <br><br>@lang('message.derivatives_policy.b2')
                                            <br><br>@lang('message.derivatives_policy.b3')
                                            <br><br>@lang('message.derivatives_policy.b4')
                                            <br><br>@lang('message.derivatives_policy.b5')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.investment_advice.head') </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.investment_advice.b1')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.disputes.head')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.disputes.b1')
                                            <br><br>@lang('message.disputes.b2')
                                            <br><br>@lang('message.disputes.b3')<br><br>@lang('message.disputes.b4')
                                            <br><br>@lang('message.disputes.b5') <br><br>@lang('message.disputes.b6')
                                            <br><br>@lang('message.disputes.b7') <br><br>@lang('message.disputes.b8')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.indemnification.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.indemnification.b1')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.confidential.head')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.confidential.b1') <br><br>@lang('message.confidential.b2')
                                            <br><br>@lang('message.confidential.b3')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.termination.head')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.termination.b1') <br><br>@lang('message.termination.b2')
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
