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
            width: 54px;
            margin-top: -40px;
            margin-left: 90px;
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
                {{ $header }}
                <tr>
                    {{ $slot }}
                </tr>
                <tr>
                    <td class="main-td-p" style="border-collapse:collapse;padding-right:90px;padding-left:90px;">
                        <p
                            style="font-family:Helvetica, Arial, sans-serif;font-style:normal;font-weight:normal;font-size:14px;line-height:28px;letter-spacing:0.1px;color:#545A87;margin-bottom:0px;margin-top:0px;">
                            Best Wishes, <br> Eloking.com Team ✌️
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
    {{ $footer }}
</table>
</body>

</html>

