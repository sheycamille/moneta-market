@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset('front/img/group-logo.png') }}" alt="{{ config('app.name') }}" style="width: 200px; margin:auto;"
                class="text-center">
        @endcomponent
    @endslot

    {{-- Body --}}

    <span style="color:#8c8c8c!important; font-family:Montserrat, lato!important;">{{ $slot }}</span>


    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
