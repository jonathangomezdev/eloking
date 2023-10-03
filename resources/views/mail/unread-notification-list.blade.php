<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eloking alert</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            line-height: 100%;
        }

        img {
            outline: none;
            text-decoration: none;
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100% !important;
            margin: 0;
            padding: 0;
            display: block;
        }

        table td {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        .main {
            border-radius: 12px;
            filter: drop-shadow(0px 10px 20px rgba(35, 43, 70, 0.04));
        }

        .banner {
            display: block;
        }

        .logo {
            width: 50px;
            margin-top: -40px;
            margin-left: 70px;
            margin-bottom: 29px;
        }

        .main-td-p {
            padding-right: 90px;
            padding-left: 90px;
        }

        .main-td-p h1 {
            font-style: normal;
            font-weight: bold;
            font-size: 28px;
            line-height: 40px;
            letter-spacing: 0.1px;
            color: #41BCBF;
            margin-top: 0;
            margin-bottom: 16px;
        }

        .main-td-p p {
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 28px;
            letter-spacing: 0.1px;
            color: #545A87;
            margin-bottom: 0px;
            margin-top: 0px;
        }

        .mb-10 {
            margin-bottom: 10px !important;
        }

        .mb-28 {
            margin-bottom: 28px!important;
        }

        .link {
            margin-top: 28px;
            margin-bottom: 28px;
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 17px;
            display: block;
            text-align: center;
            letter-spacing: 0.1px;
            color: #FFFFFF;
            background: #4842D1;
            border-radius: 31.5px;
            padding-top: 19px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            text-decoration: none;
        }

        .link-send {
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 28px;
            letter-spacing: 0.1px;
            color: #545A87;
            text-decoration: none;
            color: #41BCBF;
            margin-top: 0;
            margin-bottom: 0;
            display: inline-block;
        }

        .footer-td p {
            font-style: normal;
            font-weight: normal;
            font-size: 12px;
            line-height: 20px;
            text-align: center;
            color: #9196B6;
            margin-bottom: 0px;
            margin-top: 0px;
        }

        .footer-td span {
            color: #41BCBF;
            text-decoration: underline;
        }

        .info-last {
            margin-bottom: 28px;
        }

        .info p {
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 28px;
            letter-spacing: 0.1px;
            padding-top: 14px;
            padding-bottom: 14px;
            color: #8790A2;
        }

        .info td {
            vertical-align: middle;
        }

        .vam {
            vertical-align: middle;
        }

        .info-first {
            padding-left: 32px;
        }

        .info-answer {
            color: #545A87 !important;
            padding-right: 32px;
        }

        .lighter {
            color: #8790A2!important;
        }

        .game {
            display: inline-block;
            margin-right: 12px;
        }

        .mniddle {
            margin-left: 13px;
            margin-right: 13px;
        }

        .dib {
            display: inline-block;
        }

        .user-letter {
            font-family:Helvetica, Arial, sans-serif;
            display: inline-block;
            overflow: hidden;
            font-style: normal;
            font-weight: bold;
            font-size: 10px;
            line-height: 24px;
            width: 24px;
            height: 24px;
            position: relative;
            border-radius: 100%;
            z-index: 2;
            color: #ffffff;
            text-align: center;
            text-transform: uppercase;
            margin-right: 8px;
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 50%), linear-gradient(315deg, #fbd1e8, #bb387e);
        }
        .user-letter.a, .user-letter.b, .user-letter.c, .user-letter.d, .user-letter.e {
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 50%), linear-gradient(135deg, #033aa4 0%, #3cb4fd 100%);
        }
        .user-letter.f, .user-letter.g, .user-letter.h {
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 50%), linear-gradient(315deg, #b4ec51, #429321);
        }
        .user-letter.i, .user-letter.j, .user-letter.k {
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 50%), linear-gradient(315deg, #e86fae, #3a93e4);
        }
        .user-letter.l, .user-letter.m, .user-letter.n, .user-letter.o {
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 50%), linear-gradient(135deg, #3023ae, #c86dd7 102%);
        }
        .user-letter.p, .user-letter.q, .user-letter.r, .user-letter.s {
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 50%), linear-gradient(315deg, #ee0c78 100%, #ff6805);
        }
        .user-letter.t, .user-letter.u, .user-letter.v {
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 50%), linear-gradient(135deg, #258cbf, #4ed3be 100%);
        }
        .user-letter.w, .user-letter.y, .user-letter.z {
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 50%), linear-gradient(315deg, #8dfcfc, #ef33d9);
        }

        @media (max-width: 640px) {
            .table-612 {
                width: 412px;
            }

            .info {
                width: 322px;
            }

            .main-td-p {
                padding-left: 45px !important;
                padding-right: 45px !important;
            }
            .info .info-first {
                padding-left: 24px!important;
            }
            .info .info-answer {
                padding-right: 24px!important;
            }

            .logo {
                margin-left: 50px;
            }
        }

        @media (max-width: 440px) {
            .table-612 {
                width: 300px;
            }
            .info {
                width: 230px;
            }

            .logo {
                margin-left: 42%;
            }
        }
    </style>

</head>

<body
    style="margin-top: 0;margin-bottom: 0;margin-right: 0;margin-left: 0;padding-top: 0;padding-bottom: 0;padding-right: 0;padding-left: 0;width: 100% !important;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;line-height: 100%;margin: 0;padding: 0;">
<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#F8F8F8"
       style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;background:#F8F8F8;">
    <tr>
        <td height="80" style="border-collapse:collapse;"></td>
    </tr>
    <tr>
        <td style="border-collapse:collapse;">
            <table class="main table-612" cellpadding="0" cellspacing="0" width="612" align="center"
                   bgcolor="#FFFFFF"
                   style="background:#FFFFFF;border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;border-radius:12px;filter:drop-shadow(0px 10px 20px rgba(35, 43, 70, 0.04));">
                <tr>
                    <td style="border-collapse:collapse;">
                        <img class="banner" src="{{ asset('/img/email-header.png') }}" alt="Banner"
                             style="width:100%;outline-style: none;text-decoration: none;border-style: none;-ms-interpolation-mode: bicubic;max-width: 100% !important;margin-top: 0;margin-right: 0;margin-left: 0;padding-top: 0;padding-bottom: 0;padding-right: 0;padding-left: 0;display: block;outline: none;border: none;margin: 0;padding: 0;">
                    </td>
                </tr>
                <tr>
                    <td height="30" style="border-collapse:collapse;"></td>
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <h1
                            style="font-family: Helvetica, Arial, sans-serif;font-style: normal;font-weight: bold;font-size: 28px;line-height: 40px;letter-spacing: 0.1px;color: #41BCBF;margin-top: 0;margin-bottom: 16px;">
                            Notification Alert
                        </h1>
                    </td>
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <p class="mb-10"
                           style="font-family:Helvetica, Arial, sans-serif;font-style:normal;font-weight:normal;font-size:14px;line-height:28px;letter-spacing:0.1px;color:#545A87;margin-bottom:10px!important;margin-top:0px;">
                            Hey,
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <p class="mb-28 "
                           style="font-family:Helvetica, Arial, sans-serif;font-style:normal;font-weight:normal;font-size:14px;line-height:28px;letter-spacing:0.1px;color:#545A87;margin-bottom:28px!important;margin-top:0px;">
                            Hope you are having a good day. We are sending you this email in order to inform you
                            that you have a new notification on
                            eloking.com
                        </p>
                    </td>
                </tr>
                @foreach($notifications as $notification)
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <table bgcolor="#F8F8F8" cellpadding="0" cellspacing="0" align="center" width="432"
                               class="info"
                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                            <tr>
                                <td width="68" align="left"
                                    style="border-collapse: collapse;vertical-align: middle;">
                                    <p style="font-family: Helvetica, Arial, sans-serif;padding-left: 32px;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #8790A2;margin-bottom: 0px;margin-top: 0px;padding-top: 14px;padding-bottom: 14px;"
                                       class="info-first">
                                        @isset($notification->data['gametype'])
                                            @switch($notification->data['gametype'])
                                                @case('lol')
                                                <img src="{{ asset('/img/icons/lol.png') }}" alt="Game"
                                                     class="game vam"
                                                     style="outline: none;text-decoration: none;border: none;-ms-interpolation-mode: bicubic;margin: 0;padding: 0;display: inline-block;vertical-align: middle;margin-right: 12px;max-width: 100% !important;">
                                                @break
                                                @case('valorant')
                                                <img src="{{ asset('/img/icons/valorant.png') }}" alt="Game"
                                                     class="game vam"
                                                     style="outline: none;text-decoration: none;border: none;-ms-interpolation-mode: bicubic;margin: 0;padding: 0;display: inline-block;vertical-align: middle;margin-right: 12px;max-width: 100% !important;">
                                                @break
                                                @case('csgo')
                                                <img src="{{ asset('/img/icons/csgo.png') }}" alt="Game"
                                                     class="game vam"
                                                     style="outline: none;text-decoration: none;border: none;-ms-interpolation-mode: bicubic;margin: 0;padding: 0;display: inline-block;vertical-align: middle;margin-right: 12px;max-width: 100% !important;">
                                                @break
                                            @endswitch
                                        @else
                                            <span class="user-letter {{ strtolower($notification->data['user']['initial']) }}" style="font-family: Helvetica, Arial, sans-serif;display: inline-block;overflow: hidden;font-style: normal;font-weight: bold;font-size: 10px;line-height: 24px;width: 24px;height: 24px;position: relative;border-radius: 100%;z-index: 2;color: #ffffff;text-align: center;text-transform: uppercase;margin-right: 8px;">
                                                {{ strtoupper($notification->data['user']['initial']) }}
                                            </span>
                                        @endisset
                                    </p>
                                </td>
                                <td align="left" style="border-collapse: collapse;vertical-align: middle;">
                                    {!! $notification->data['message'] !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <a href="{{ URL::to('/panel/orders') }}" class="link"
                           style="background-attachment: scroll;font-family: Helvetica, Arial, sans-serif;margin-top: 28px;margin-bottom: 28px;font-style: normal;font-weight: 500;font-size: 14px;line-height: 17px;display: block;text-align: center;letter-spacing: 0.1px;color: #FFFFFF;background-color: #4842D1;background-image: none;background-repeat: repeat;background-position: top left;border-radius: 31.5px;padding-top: 19px;padding-bottom: 20px;padding-left: 20px;padding-right: 20px;text-decoration: none;mso-line-height-rule: exactly;mso-padding-alt: 0;background: #4842D1;">
                            <!--[if mso]>
                            <i style="letter-spacing: 25px; mso-font-width: -100%; mso-text-raise: 30pt;">&nbsp;</i>
                            <![endif]-->
                            <span style="mso-text-raise: 15pt;">
                                View Notification
                            </span>
                            <!--[if mso]>
                            <i style="letter-spacing: 25px; mso-font-width: -100%;">&nbsp;</i>
                            <![endif]-->
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <p
                            style="font-family:Helvetica, Arial, sans-serif;font-style:normal;font-weight:normal;font-size:14px;line-height:28px;letter-spacing:0.1px;color:#545A87;margin-bottom:0px;margin-top:0px;">
                            Best Wishes, <br> Eloking
                        </p>
                    </td>
                </tr>
                <tr>
                    <td height="76" style="border-collapse:collapse;"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="44" style="border-collapse:collapse;"></td>
    </tr>
    <tr>
        <td style="border-collapse:collapse;">
            <table class="footer table-612" cellpadding="0" cellspacing="0" width="612" align="center"
                   style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;">
                <tr>
                    <td class="footer-td" style="border-collapse:collapse;">
                        <p
                            style="font-family:Helvetica, Arial, sans-serif;font-style:normal;font-weight:normal;font-size:12px;line-height:20px;text-align:center;color:#9196B6;margin-bottom:0px;margin-top:0px;">
                            To stop receiving this email, please open your profile settings and disable email
                            notifications.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="footer-td" style="border-collapse:collapse;">
                        <p
                            style="font-family:Helvetica, Arial, sans-serif;font-style:normal;font-weight:normal;font-size:12px;line-height:20px;text-align:center;color:#9196B6;margin-bottom:0px;margin-top:0px;">
                            Eloking Ltd. Riga, Aleksandra Caka street 125 - 7, LV-1011
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="84" style="border-collapse:collapse;"></td>
    </tr>
</table>
</body>

</html>
