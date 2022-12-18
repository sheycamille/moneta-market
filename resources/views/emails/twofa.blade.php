@component('mail::message')
    # Hello {{ $demo->receiver_name }},

    {!! $demo->message !!}

    @php echo("\r Find below your two factor code, please discard this email if you didn't request for it, thanks. \r \n") @endphp

    @php echo("\r 2 Factor code: ")@endphp {{ $demo->token_2fa . " \r \n" }}

    @php echo("\r Thanks! \r\n") @endphp

    @php echo("\r Kind regards \r \n") @endphp,
    {{ "\r " . $demo->sender }} @php echo("your reputable financial broker. \r\n") @endphp

@endcomponent
