<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block; margin:auto;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('front/img/logo.png') }}" class="logo" alt="Sky Gold Markets Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
