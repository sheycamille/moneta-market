@component('mail::message')
    @php echo("\r \n Hello Admin \r\n") @endphp

    @php echo("\r \n This is to inform you of a successfull Deposit that just occured on your system. The proof of payment is attached with this mail, please login to review this changes. \r\n") @endphp

    @component('mail::button', ['url' => "{{ config('app.url') }}"])
        Login Now
    @endcomponent

    @php echo("\r \n Thanks") @endphp,
    {{ "\r \n " . {{ config('app.name') }} }} @php echo("your reputable financial broker.\r\n") @endphp

@endcomponent
