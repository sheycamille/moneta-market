@component('mail::message')
    @php echo("\r \n Hello Admin") @endphp,

    @php echo "\r \n This is to inform you of a successfull KYC Document upload that just occured on your system. The uploaded document is attached with this mail, please login to review this changes."; @endphp,

    @component('mail::button', ['url' => "{{ config('app.url') }}"])
        Login Now
    @endcomponent

    @php echo("\r \n Kind regards") @endphp,
    {{ "\r \n " . config('app.name') }} @php echo("your reputable financial broker.\r\n") @endphp

@endcomponent
