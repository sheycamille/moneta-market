@extends('layouts.front')

@section('title', 'Security')

@section('company', 'uk-active')
@section('credit-score-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.company')</a></li>
                        <li><span>@lang('message.sec')</span></li>
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
                            <h1 class="uk-margin-remove">@lang('message.security.staying_safe')</h1>
                            <p class="uk-text-lead uk-text-muted uk-margin-small-top">@lang('message.security.online_security')</p>
                        </div>
                    </div>

                    <div class="uk-width-1-1 in-timeline-1" style="padding-top: 3rem;">
                        <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-4@m uk-grid" data-uk-grid="">
                            <div class="uk-first-column">
                                <div class="in-timeline-branch">
                                    <div class="uk-flex">

                                    </div>
                                </div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <h4>@lang('message.your_data')</h4>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="in-timeline-branch">
                                    <div class="uk-flex">

                                    </div>
                                </div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <h4>@lang('message.precautions')</h4>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="in-timeline-branch">
                                    <div class="uk-flex">

                                    </div>
                                </div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <h4>@lang('message.suspicious')</h4>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="in-timeline-branch">
                                    <div class="uk-flex">

                                    </div>
                                </div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <h4>@lang('message.fraud')</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom">
                            <h3 class="uk-margin-small-bottom" style="text-align: center;">@lang('message.your_data')</h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove"
                                style="text-align: center; font-size: 1rem;">@lang('message.security.safety').</p>

                        </div>
                    </div>
                    <div class="uk-width-1-1 in-timeline-1">

                        <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@m uk-grid" data-uk-grid="">
                            <div class="uk-first-column">
                                <div class="in-timeline-branch">
                                    <div class="uk-flex">

                                    </div>
                                </div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <ul class="uk-list uk-list-bullet in-list-check">
                                            <li>@lang('message.security.high_encryption')</li>
                                            <li>@lang('message.security.strong_team')</li>
                                            <li>@lang('message.security.control')</li>
                                            <li>@lang('message.security.password')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="in-timeline-branch">
                                    <div class="uk-flex">

                                    </div>
                                </div>
                                <div class="uk-box-shadow-small uk-width-expand">
                                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-border-rounded">
                                        <ul class="uk-list uk-list-bullet in-list-check">
                                            <li>@lang('message.security.updates')</li>
                                            <li>@lang('message.security.two_step')</li>
                                            <li>@lang('message.security.automated_email')</li>
                                            <li>@lang('message.security.data_protection')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom">
                            <h3 class="uk-margin-small-bottom" style="text-align: center;">@lang('message.precautions')</h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove"
                                style="text-align: center; font-size: 1rem;">@lang('message.security.online_banking').</p>

                        </div>
                    </div>
                    <div class="uk-width-1-1 in-content-10">

                        <div class="uk-grid-divider uk-child-width-1-2@m uk-child-width-1-2@s uk-margin-medium-top uk-grid"
                            data-uk-grid="">
                            <div class="uk-first-column">
                                <h4 class="uk-heading-bullet">@lang('message.security.phishing')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.security.phishing_emails')t. <br><br>@lang('message.security.phishing_emails_pt2').</p>
                                    </div>

                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.security.secure')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.security.secure_browsing'). <br><br>@lang('message.security.secure_browsing_pt2').</p>
                                    </div>

                                </div>
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <h4 class="uk-heading-bullet">@lang('message.security.virus')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.security.virus_pt1'). <br><br>@lang('message.security.virus_pt2').</p>
                                    </div>

                                </div>
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <h4 class="uk-heading-bullet">@lang('message.security.disclose')!</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.security.disclose_pt1') <br><br>@lang('message.security.disclose_pt2').</p>
                                    </div>

                                </div>
                            </div>
                            <div class="uk-grid-margin uk-first-column">
                                <h4 class="uk-heading-bullet">@lang('message.security.easy')</h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.security.easy_pt1'). </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section in-offset-top-60 in-offset-top-50@s" style="margin-top: 4rem;">
            <div class="uk-container">
                <div class="uk-grid-medium uk-child-width-1-2@m in-testimonial-7 uk-grid" data-uk-grid="">
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom">
                            <h3 class="uk-margin-small-bottom" style="text-align: center;">@lang('message.suspicious')s</h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove"
                                style="text-align: center; font-size: 1rem;">@lang('message.security.for_clarity'):</p>

                        </div>
                    </div>
                    <div class="uk-first-column">
                        <div class="uk-card uk-card-default uk-box-shadow-small uk-border-rounded">

                            <div class="uk-card-body" style="padding: 15px 40px;">

                                <p>@lang('message.security.clarity_pt1').</p>

                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-box-shadow-small uk-border-rounded">

                            <div class="uk-card-body" style="padding: 15px 40px;">

                                <p>@lang('message.security.clarity_pt2').</p>

                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-box-shadow-small uk-border-rounded">

                            <div class="uk-card-body" style="padding: 15px 40px;">

                                <p>@lang('message.security.clarity_pt3') </p>

                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-box-shadow-small uk-border-rounded">

                            <div class="uk-card-body" style="padding: 15px 40px;">

                                <p>@lang('message.security.clarity_pt4').</p>

                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-box-shadow-small uk-border-rounded">

                            <div class="uk-card-body" style="padding: 15px 40px;">

                                <p>@lang('message.security.clarity_pt5').</p>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="uk-section in-offset-top-40 in-offset-bottom-20" style="margin-top: 4rem;">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <div
                            class="uk-card uk-card-default uk-border-rounded uk-background-center uk-background-contain uk-background-image@m">
                            <div class="uk-card-body" style="padding: 70px 150px;">
                                <div class="uk-grid uk-flex uk-flex-center" style="padding: 2rem;">
                                    <div class="uk-width-3-4@m uk-text-center">
                                        <h3>@lang('message.fraud')</h3>
                                        <p>@lang('message.security.fraud_pt1').</p>
                                    </div>
                                </div>
                                <div class="uk-grid uk-child-width-1-2@m uk-margin-medium-top" data-uk-grid="">
                                    <div class="uk-flex uk-flex-left uk-first-column">

                                        <div>

                                            <p>@lang('message.security.fraud_pt2').</p>

                                        </div>
                                    </div>
                                    <div class="uk-flex uk-flex-left">

                                        <div>

                                            <p>@lang('message.security.fraud_pt3').</p>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid">
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom">
                            <h5 class="uk-margin-small-bottom" style="text-align: center;">@lang('message.security.we_remind_you') </h5>

                        </div>
                    </div>
                    <div class="uk-width-1-1 in-content-10">

                        <div class="uk-grid-divider uk-child-width-1-2@m uk-child-width-1-2@s
uk-margin-medium-top uk-grid"
                            data-uk-grid="">
                            <div class="uk-first-column">

                                <div class="uk-grid uk-grid-small uk-grid-stack" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.security.we_remind_you_pt2').</p>
                                    </div>

                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <div class="uk-grid uk-grid-small uk-grid-stack" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.security.we_remind_you_pt3').</p>
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
