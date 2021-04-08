<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <style type="text/css">
        a {
            color: #4574ec;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none !important;
        }
    </style>
</head>


<body>
<table style="width: 100%; max-width: 600px;   font-family: 'Roboto', sans-serif; margin: 0 auto; ">
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" align="center"
                   style=" width: 100%; max-width: 600px;  margin: 0 auto;  border-collapse: collapse; font-size: 16px;  "
                   class="container">
                <tr>
                    <td style="padding: 50px 15px; background: #171717; text-align: center; ">
                        <p style="margin: 0 auto; color: #03C406;font-size: 20px;line-height: 1.2;font-weight: 700;">
                            {{ config('app.name') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style=" width: 100%;  background: #121212; font-family: 'Roboto', sans-serif; color: #2e2e2e; padding: 0 15px;">
                        @yield('content')
                    </td>
                </tr>
                <tr>
                    <td style="padding: 40px  30px 30px 30px ;;font-family: 'Roboto', sans-serif;  line-height: 1.5; background: #171717;"
                        valign="top">
                        <div style="text-align:center;">
                            <div>
                                <a href="{{ config('app.url') }}">
                                    <img src="{{ url('storage/letters/images/telegram.png') }}" alt="telegram"
                                         style="display: inline-block;width: 19px; margin: 0 15px;">
                                </a>
                                <a href="{{ config('app.url') }}">
                                    <img src="{{ url('storage/letters/images/facebook.png') }}" alt="facebook"
                                         style="display: inline-block;width: 19px; margin: 0 15px;">
                                </a>
                                <a href="{{ config('app.url') }}">
                                    <img src="{{ url('storage/letters/images/twitter.png') }}" alt="twitter"
                                         style="display: inline-block;width: 19px; margin: 0 15px;">
                                </a>
                            </div>
                            <div style="margin-top: 16px;text-align: center; font-size: 14px;">
                                <a href="{{ config('app.url') }}" style="color: #B3B3B3;">
                                    {{ config('app.url') }}
                                </a>
                                <p style="margin: 5px 0 0 0; font-size: 10px; color: #B3B3B3; ;">
                                    © {{ date('Y') }} {{ config('app.name') }}
                                </p>
                            </div>
                            <div style="margin: 16px  0 0 0; text-align: center; font-weight: 600; font-size: 18px; color: #B3B3B3;">
                                <p style="margin: 0;">{{ config('app.name') }}</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
