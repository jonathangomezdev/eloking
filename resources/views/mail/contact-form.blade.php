<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eloking contact form</title>
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
            padding-right: 24px;
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

        .info {
            margin-bottom: 12px;
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
            vertical-align: baseline;
        }

        .info-first {
            padding-left: 24px;
        }

        .info-answer {
            color: #545A87 !important;
            padding-right: 24px;
        }

        .logo {
            width: 90px;
            margin-top: -40px;
            margin-left: 70px;
            margin-bottom: 29px;
        }

        @media (max-width: 640px) {
            .table-612 {
                width: 412px;
            }

            .main-td-p {
                padding-left: 45px !important;
                padding-right: 45px !important;
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
                             style="width:100%;outline-style: none;text-decoration: none;border-style: none;-ms-interpolation-mode: bicubic;max-width: 100% !important;margin-top: 0;margin-right: 0;margin-left: 0;padding-top: 0;padding-bottom: 0;padding-right: 0;padding-left: 0;display: block;outline: none;border: none;margin: 0;padding: 0;"/>
                    </td>
                </tr>
                <tr>
                    <td height="30" style="border-collapse:collapse;"></td>
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <h1
                            style="font-family: Helvetica, Arial, sans-serif;font-style: normal;font-weight: bold;font-size: 28px;line-height: 40px;letter-spacing: 0.1px;color: #41BCBF;margin-top: 0;margin-bottom: 16px;">
                            @if($discord)
                                Job Application Submission
                            @else
                                Contact Form Submission
                            @endif
                        </h1>
                    </td>
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <p class="mb-10"
                           style="font-family:Helvetica, Arial, sans-serif;font-style:normal;font-weight:normal;font-size:14px;line-height:28px;letter-spacing:0.1px;color:#545A87;margin-bottom:10px!important;margin-top:0px;">
                            @if($discord)
                                We have received a job application.
                            @else
                                We have received a contact form submission.
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <table bgcolor="#F8F8F8" cellpadding="0" cellspacing="0" align="left" width="432"
                               class="info"
                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-bottom: 12px;">
                            <tr>
                                <td width="108" style="border-collapse: collapse;vertical-align: baseline;">
                                    <p style="font-family: Helvetica, Arial, sans-serif;padding-left: 24px;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #8790A2;margin-bottom: 0px;margin-top: 0px;padding-top: 14px;padding-bottom: 14px;"
                                       class="info-first">
                                        Name
                                    </p>
                                </td>
                                <td style="border-collapse: collapse;vertical-align: baseline;">
                                    <p style="font-family: Helvetica, Arial, sans-serif;padding-right: 24px;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #545A87!important;margin-bottom: 0px;margin-top: 0px;padding-top: 14px;padding-bottom: 14px;"
                                       class="info-answer">
                                        {{ $name }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <table bgcolor="#F8F8F8" cellpadding="0" cellspacing="0" align="left" width="432"
                               class="info"
                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-bottom: 12px;">
                            <tr>
                                <td width="108" style="border-collapse: collapse;vertical-align: baseline;">
                                    <p style="font-family: Helvetica, Arial, sans-serif;padding-left: 24px;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #8790A2;margin-bottom: 0px;margin-top: 0px;padding-top: 14px;padding-bottom: 14px;"
                                       class="info-first">
                                        Email
                                    </p>
                                </td>
                                <td style="border-collapse: collapse;vertical-align: baseline;">
                                    <a href="mailto:{{ $email }}" class="link-send"
                                       style="font-family: Helvetica, Arial, sans-serif;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #41BCBF;text-decoration: none;margin-top: 0;margin-bottom: 0;display: inline-block;padding-right: 24px;">
                                        {{ $email }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @if($discord)
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <table bgcolor="#F8F8F8" cellpadding="0" cellspacing="0" align="left" width="432"
                               class="info"
                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-bottom: 12px;">
                            <tr>
                                <td width="108" style="border-collapse: collapse;vertical-align: baseline;">
                                    <p style="font-family: Helvetica, Arial, sans-serif;padding-left: 24px;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #8790A2;margin-bottom: 0px;margin-top: 0px;padding-top: 14px;padding-bottom: 14px;"
                                       class="info-first">
                                        Discord
                                    </p>
                                </td>
                                <td style="border-collapse: collapse;vertical-align: baseline;">
                                    <p style="font-family: Helvetica, Arial, sans-serif;padding-right: 24px;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #545A87!important;margin-bottom: 0px;margin-top: 0px;padding-top: 14px;padding-bottom: 14px;"
                                       class="info-answer">
                                        {{ $discord }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endif
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <table bgcolor="#F8F8F8" cellpadding="0" cellspacing="0" align="left" width="432"
                               class="info info-last"
                               style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-bottom: 28px;">
                            <tr>
                                <td width="108" style="border-collapse: collapse;vertical-align: baseline;">
                                    <p style="font-family: Helvetica, Arial, sans-serif;padding-left: 24px;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #8790A2;margin-bottom: 0px;margin-top: 0px;padding-top: 14px;padding-bottom: 14px;"
                                       class="info-first">
                                        Message
                                    </p>
                                </td>
                                <td style="border-collapse: collapse;vertical-align: baseline;">
                                    <p style="font-family: Helvetica, Arial, sans-serif;padding-right: 24px;font-style: normal;font-weight: normal;font-size: 14px;line-height: 28px;letter-spacing: 0.1px;color: #545A87!important;margin-bottom: 0px;margin-top: 0px;padding-top: 14px;padding-bottom: 14px;"
                                       class="info-answer">
                                        {{ $message }}
                                    </p>
                                </td>
                            </tr>
                        </table>
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
