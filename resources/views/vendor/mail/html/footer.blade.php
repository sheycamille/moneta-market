<tr>
    <td class="row" style="padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff; text-align:center;">
        <h1
            style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:28px;font-weight:bold;letter-spacing:-0.02em; text-align:center;">
            Download Your Platform!</h1>
        <p style="text-align:center;">Web & Mobile Apps</p>

        <div class="col-sml icons"
            style="display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;">
            <a style="text-align:center;"
                href="https://play.google.com/store/apps/details?id=com.mtrader7.terminal&hl=en">
                <img class="" src="{{ URL::to('/') }}/dash/images/google_play_badge.png" alt="Andriod Download"
                    tilte="Andriod Download" height="66" />
                <br><br>
                <span>Download Now</span>
            </a>
        </div>

        <div class="col-sml icons"
            style="display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;">
            <a style="text-align:center;" href="https://apps.apple.com/gb/app/mobiustrader-7/id1355359598"
                target="_blank">
                <img src="{{ URL::to('/') }}/dash/images/app-store-en.png" alt="iPhone Download"
                    tilte="iPhone Download" height="66" />
                <br><br>
                <span>Download Now</span>
            </a>
        </div>


    </td>
</tr>

<hr style="width:70%;text-align:center; color:#edf2f7;">

<tr>
    <td class="row"
        style="padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border:none; text-align:center;">
        <p style="text-align:center;">Desktop Apps</p>

        <div class="col-sml icons"
            style="display:inline-block;width:100%;max-width:145px;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;">
            <a style="text-align:center;"
                href="https://mobius-trader.s3.eu-north-1.amazonaws.com/SkyGoldMarkets/SkyGoldMarkets-Mobius.win.exe">
                <img class="" src="{{ asset('dash/images/logo-windows-13475.png') }}" alt="Windows Download"
                    tilte="Windows Download" height="66" />
                <br><br>
                <span>Download Now</span>
            </a>
        </div>

        <div class="col-sml icons"
            style="display:inline-block;width:100%;max-width:145px;;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;">
            <a style="text-align:center;"
                href="https://mobius-trader.s3.eu-north-1.amazonaws.com/SkyGoldMarkets/SkyGoldMarkets-Mobius.mac.dmg"
                target="_blank">

                <img src="{{ asset('dash/images/pngegg.png') }}" alt="MacOS Download" tilte="MacOS Download"
                    height="66" />
                <br><br>
                <span>Download Now</span>
            </a>
        </div>

        <div class="col-sml icons"
            style="display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;">
            <a style="text-align:center;"
                href="https://mobius-trader.s3.eu-north-1.amazonaws.com/SkyGoldMarkets/SkyGoldMarkets-Mobius.linux.AppImage">
                <img class="col-md-6" src="{{ asset('dash/images/linux-22618.png') }}" alt="Linux Download"
                    tilte="Linux Download" height="80" />
                <br> <br>
                <span>Download Now</span>
            </a>
        </div>
    </td>
</tr>

<tr>
    <td style="padding:30px;font-size:10px;background-color:#1a2989;color:#cccccc;">
        <span style="text-align:center!important;">{{ Illuminate\Mail\Markdown::parse($slot) }}</span>
    </td>
</tr>
