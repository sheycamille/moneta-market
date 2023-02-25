@component('mail::message')
    Hello {{ $demo->receiver_name }},

    {!! $demo->subject !!}
    
    @php echo("\r Your 2 Factor code is: ")@endphp {{ $demo->message . " \r \n" }}

    @php echo("\r Thanks! \r\n") @endphp

    @php echo("\r Kind regards \r \n") @endphp,
    

@endcomponent
