<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        .icons {
            padding: 20px;
        }

        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>



    <table align="center" class="wrapper" cellpadding="0" cellspacing="0" role="presentation"
        style="margin:0;padding:0;word-spacing:normal;background-color:#939297;">
        <!--  Body -->
        <tr role="article" aria-roledescription="email" lang="en"
            style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ffffff;">

            <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                <table class="content" cellpadding="0" cellspacing="0" role="presentation"
                    style="width:94%;max-width:885px; margin:auto; border:1px solid #edf2f7 !important;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:black;">


                    <!-- Email header -->

                    {{ $header ?? '' }}

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0"
                            style="padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">
                            <h1
                                style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">
                                Greetings!
                            </h1>
                            <<<<<<< HEAD <span style="color:black;">{{ Illuminate\Mail\Markdown::parse($slot) }}</span>
                                =======
                                <span
                                    style="color: #8c8c8c!important">{{ Illuminate\Mail\Markdown::parse($slot) }}</span>
                                >>>>>>> main

                                {{ $subcopy ?? '' }}
                        </td>
                    </tr>

                    <!-- Email footer -->

                    {{ $footer ?? '' }}
                    </div>

                </table>
            </td>
        </tr>
    </table>


</body>

</html>
