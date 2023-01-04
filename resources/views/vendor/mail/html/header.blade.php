<tr>
    <td class="header" style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
        <a href="{{ $url }}" style="display: inline-block; margin:auto; width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('front/img/group-logo.png') }}" class="logo" alt="Moneta Market">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>

