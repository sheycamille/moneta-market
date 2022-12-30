<tr>
    <td align="center">
        <div style="width:100%;padding:250px auto;background-color:#ffffff;">
            <table role="presentation" width="100%">
                <tbody>
                    <tr>
                        <td style="padding:10px;text-align:center">
                            <h1
                                style="font-family:Helvetica,Arial,sans-serif;font-size:35px;line-height:28px;font-weight:500;margin:auto;margin-top:60px;margin-bottom:60px;text-align:center;">
                                Download Your Trading Platform</h1>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="font-size:0;text-align:center padding-bottom: 50px;">
                <div style="width:100%;max-width:300px;display:inline-block;vertical-align:top;height:100px">
                    <h2 style="text-align:center;">Android App</h2>
                    <a style="text-align:center;"
                        href="https://play.google.com/store/apps/details?id=com.mtrader7.terminal&hl=en">
                        <img class="" src="{{ asset('dash/images/google_play_badge.png') }}"
                            alt="Andriod Download" tilte="Andriod Download" height="66" />
                        <br><br>
                        <span>Download Now</span>
                    </a>
                </div>

                <div style="width:100%;max-width:300px;display:inline-block;vertical-align:top;height:100px">
                    <h2 style="text-align:center;">iOS App</h2>
                    <a style="text-align:center;" href="https://apps.apple.com/gb/app/mobiustrader-7/id1355359598"
                        target="_blank">
                        <img src="{{ asset('dash/images/app-store-en.png') }}" alt="iPhone Download"
                            tilte="iPhone Download" height="66" />
                        <br><br>
                        <span>Download Now</span>
                    </a>
                </div>

                <div style="width:100%;max-width:300px;display:inline-block;vertical-align:top;height:100px">
                    <h2 style="text-align:center;">Trader 7</h2>
                    <a style="text-align:center;"
                        href="https://mobius-trader.s3.eu-north-1.amazonaws.com/MobiusTrader/MobiusTrader-Mobius.win.exe">
                        <img class="col-md-6" src="{{ asset('dash/images/windows.png') }}" alt="Trader7"
                            tilte="Trader7" height="80" />
                        <br>
                        <span>Download Now</span>
                    </a>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
    </td>
</tr>

<tr>
    <td>
        <table class="footer text-center" align="center" width="570" cellpadding="0" cellspacing="0"
            role="presentation">
            <tr>
                <td class="content-cell text-center" align="center">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}
                </td>
            </tr>
        </table>
    </td>
</tr>
