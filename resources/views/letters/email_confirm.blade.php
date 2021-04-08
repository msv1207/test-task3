@extends('letters.base_letter')

@section('content')
    <table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;   margin: 0; " width="100%"
           class="t-content">
        <tbody>
        <tr>
            <td style="padding: 20px 20px 40px 20px;font-family: 'Roboto', sans-serif;  line-height: 1.5; "
                valign="top">
                <div style="margin-top: 20px;max-width: 540px; margin-left: auto;margin-right: auto; font-size: 15px;">
                    <p style="margin: 0 ;font-size: 32px; font-weight: 700; color: #fff; text-align: center; ">
                        Let's verify your email
                    </p>
                    <div style="margin-top: 30px; font-size: 14px; line-height: 2; font-weight: 400; color: #B3B3B3;">
                        <p style="margin: 0; text-align: center;">
                            We got a request to add this email address to your {{ config('app.name') }} account.
                            Tap below to go ahead.
                        </p>
                    </div>
                    <div style="margin: 40px 0 0 0; text-align: center;">
                        <a href="{{ $confirm_url }}"
                           style="display: inline-block;min-width: 180px;background: #03C406;border-radius: 5px; padding: 10px 50px;text-align: center;letter-spacing: 0.02em; font-size: 16px; font-weight: 600; color: #fff !important;">
                            Verify My Email
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
