@extends('layouts.front')

@section('title', __('message.privacy_policy.policy'))

@section('tools', 'uk-active')
@section('privacy-menu-item', 'uk-active')

@section('content')

    <!-- breadcrumb content begin -->
    <div class="uk-section uk-padding-remove-vertical">
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1 in-breadcrumb">
                    <ul class="uk-breadcrumb uk-float-right">
                        <li><a href="{{ route('home') }}">@lang('message.topmenu.home')</a></li>
                        <li><a href="#">@lang('message.tools')</a></li>
                        <li><span>@lang('message.privacy_policy.policy')</span></li>
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
                            <h1 class="uk-margin-remove">@lang('message.privacy_policy.policy')</h1>
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
                            <p class="uk-text-lead uk-text-muted uk-margin-remove "
                                style="text-align: start; font-size: 1rem;">@lang('message.privacy_policy.b1').</p>
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
                            <h3 class="uk-margin-small-bottom" style="text-align: center;">
                                @lang('message.privacy_policy.personal')</h3>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove"
                                style="text-align: start; font-size: 1rem;">@lang('message.privacy_policy.b2')
                            </p>
                            <ul class="uk-list uk-list-bullet in-list-check">
                                <li>@lang('message.privacy_policy.list1') </li>
                                <li>@lang('message.privacy_policy.list2') </li>
                                <li>@lang('message.privacy_policy.list3') </li>
                            </ul>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove"
                                style="text-align: start; font-size: 1rem;">@lang('message.privacy_policy.b3')
                            </p>
                            <p class="uk-text-lead uk-text-muted uk-margin-remove"
                                style="text-align: start; font-size: 1rem;">@lang('message.privacy_policy.b4')
                            </p>
                        </div>
                    </div>

                    <div class="uk-width-1-1 in-content-10">
                        <div class="uk-grid-divider uk-child-width-1-2@m uk-child-width-1-2@s uk-margin-medium-top uk-grid"
                            data-uk-grid="">
                            <div class="uk-first-column">
                                <h4 class="uk-heading-bullet">@lang('message.privacy_policy.revising')
                                </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.privacy_policy.b5') </p>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet">@lang('message.privacy_policy.usage') </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.privacy_policy.b6') <br><br>@lang('message.privacy_policy.b7')
                                        </p>
                                        <ul class="uk-list uk-list-bullet in-list-check">
                                            <li>@lang('message.privacy_policy.b8')
                                            </li>
                                            <li>@lang('message.privacy_policy.b9')
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-1-1 uk-flex uk-flex-center">
                        <div class="uk-width-3-4@m uk-margin-medium-bottom">
                            <h3 class="uk-margin-small-bottom" style="text-align: center;">
                                @lang('message.privacy_policy.security') </h3>
                        </div>
                    </div>

                    <div class="uk-width-1-1 in-content-10">
                        <div class="uk-grid-divider uk-child-width-1-2@m uk-child-width-1-2@s
uk-margin-medium-top uk-grid"
                            data-uk-grid="">
                            <div class="uk-first-column">
                                <h4 class="uk-heading-bullet">@lang('message.privacy_policy.cookies') </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.privacy_policy.b10') <br><br>@lang('message.privacy_policy.b11')
                                        </p>
                                        <ul class="uk-list uk-list-bullet in-list-check">
                                            <li>@lang('message.privacy_policy.list4') </li>
                                            <li>@lang('message.privacy_policy.list5') </li>
                                            <li>@lang('message.privacy_policy.list6') </li>
                                            <li>@lang('message.privacy_policy.list7') </li>
                                        </ul>
                                        <p>@lang('message.privacy_policy.list8')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet"> @lang('message.privacy_policy.update') </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.privacy_policy.b12')</p>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet"> @lang('message.privacy_policy.links') </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.privacy_policy.b13')
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-visible@m">
                                <h4 class="uk-heading-bullet"> @lang('message.privacy_policy.questions') </h4>
                                <div class="uk-grid uk-grid-small" data-uk-grid="">
                                    <div class="uk-width-expand@m uk-first-column">
                                        <p>@lang('message.privacy_policy.b14')
                                        </p>
                                        <ul class="uk-list uk-list-bullet in-list-check">
                                            <li>@lang('message.privacy_policy.pol') </li>
                                            <li>@lang('message.privacy_policy.changes') </li>
                                            <li>@lang('message.privacy_policy.access')
                                            </li>
                                        </ul>
                                        <p>@lang('message.privacy_policy.b15')
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
