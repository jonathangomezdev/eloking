<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>#{{ $invoice->invoice_number }}</title>
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@400;500;600&display=swap"
        as="style"
        onload="this.onload=null;this.rel='stylesheet'"/>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 768px;
            margin: 0 auto;
            padding: 65px 90px 65px 100px;
        }
        h1 {
            color: #0F2832;
            font-size: 32px;
            font-weight: 700;
        }

        table {
            border-collapse: collapse;
            width: 100%!important;
        }

        table tr td:first-child {
            margin-left: 10px;
        }

        table tr td {
            padding: 10px;
        }

        .border {
            border-top: 1px solid #2C424A;
            border-bottom: 1px solid #2C424A;
        }
        .invoice-table-first, .invoice-table-second {
            padding-left: 15px;
            font-weight: bold;
            font-size: 9px;
            padding-top: 6px;
            padding-bottom: 8px;
        }
        .invoice-table-second {
            font-weight: normal;
            color: #0F2832;
        }
        .footer {
            position: absolute;
            bottom: 0;
            left: 100px;
            right: 0;
            padding-bottom: 65px;
        }

        .from-container {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container">
    <div>
        <table width="100%">
            <tr>
                <td>
                    <div class="logo-wrapper">
                        <img width="87px" src="{{ public_path('/img/logo.png') }}" alt="logo" style="margin-left: -20px;display:block;">
                    </div>
                </td>
                <td width="60%" align="right"></td>
                <td>
                    <div class="from-container" style="text-align: left">
                        @if($invoice->invoice_from === 'booster')
                            <div style="font-size:10px;margin-bottom:5px;color:#365163;">
                                From:
                            </div>
                        @endif
                        @if ($invoice->vendor_company)
                            <div style="font-size:10px;margin-bottom:5px;color:#365163;">
                                {{ $invoice->vendor_company }}
                            </div>
                        @endif
                        <div style="font-size:10px;color:#365163;margin-bottom:5px;">
                            {{ $invoice->vendor_name }}
                        </div>
                        @if ($invoice->vendor_city)
                            <div style="font-size:10px;margin-bottom:5px;color:#365163;">
                                {{ $invoice->vendor_street }}, {{$invoice->vendor_city}},
                            </div>
                            <div style="font-size:10px;color:#365163;margin-bottom:5px;">
                                {{$invoice->vendor_state}}, {{$invoice->vendor_country}},
                            </div>
                            <div style="font-size:10px;margin-bottom:5px;color:#365163;">
                                {{$invoice->vendor_postcode}}
                            </div>
                        @endif
                        @if ($invoice->vendor_vat_rate && $invoice->vendor_vat_number)
                            <div style="font-size:10px;margin-bottom:5px;color:#365163;">
                                {{$invoice->vendor_vat_number}}
                            </div>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td height="65px">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td height="65px"></td>
        </tr>
        <tr>
            <td align="left">
                <h1>Invoice</h1>
            </td>
            <td align="right">
                <div style="font-size:10px;color:#0F2832;margin-top:15px;padding-right:25px;">
                    Date: {{ $invoice->created_at->format('d M Y') }}
                </div>
            </td>
        </tr>
        <tr>
            <td height="20px"></td>
        </tr>
    </table>
    <div class="border">
        <table cellpadding="0" cellspacing="0" class="invoice-table">
            <tr>
                <td height="10px"></td>
            </tr>
            <tr>
                <td width="25%">
                    <div class="invoice-table-first">
                        Invoice number
                    </div>
                </td>
                <td width="75%">
                    <div class="invoice-table-second">
                        #{{ $invoice->invoice_number }}
                    </div>
                </td>
            </tr>
            <tr style="background: #F5F5F5;">
                <td>
                    <div class="invoice-table-first">
                        Customer
                    </div>
                </td>
                <td>
                    <div class="invoice-table-second">
                        {{ $invoice->customer_name }}
                    </div>
                </td>
            </tr>
            @isset($invoice->customer_country)
            <tr>
                <td>
                    <div class="invoice-table-first">
                        Country
                    </div>
                </td>
                <td>
                    <div class="invoice-table-second">
                        {{ $invoice->customer_country }}
                    </div>
                </td>
            </tr>
            @endisset
            <tr>
                <td height="10px"></td>
            </tr>
        </table>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td height="30px">&nbsp;</td>
        </tr>
    </table>
    <div class="border">
        <table cellpadding="0" cellspacing="0" class="invoice-table">
            <tr>
                <td height="10px"></td>
            </tr>
            <tr>
                <td width="25%">
                    <div class="invoice-table-first" style="font-weight:bold;">
                        &nbsp;
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second" style="font-weight:bold;">
                        Description
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second" style="font-weight:bold;">
                        Quantity
                    </div>
                </td>
                <td width="25%" align="right">
                    <div class="invoice-table-second" style="font-weight:bold;">
                        Amount
                    </div>
                </td>
            </tr>
            @foreach($invoice->items as $item)
            <tr style="{{ ($item->item_number % 2) == 0 ? "" : "background: #F5F5F5;"}} ">
                <td>
                    <div class="invoice-table-first" style="font-weight:normal;">
                        Digital Service
                    </div>
                </td>
                <td>
                    <div class="invoice-table-second">
                        {{ $item->description }}
                    </div>
                </td>
                <td>
                    <div class="invoice-table-second">
                        {{ $item->qty }}
                    </div>
                </td>
                <td align="right">
                    <div class="invoice-table-second">
                        {{ currencyFormatted($item->total, 'EUR') }}
                    </div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td height="10px"></td>
            </tr>
        </table>
    </div>
    <div class="border" style="border-top: none;">
        <table cellpadding="0" cellspacing="0" class="invoice-table">
            <tr>
                <td height="10px"></td>
            </tr>
            @if (false)
            <tr>
                <td width="25%">
                    <div class="invoice-table-first" style="font-weight:normal;">
                        Discount
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second">
                        &nbsp;
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second">
                        -2%
                    </div>
                </td>
                <td width="25%" align="right">
                    <div class="invoice-table-second">
                        -2.00 EUR
                    </div>
                </td>
            </tr>
            @endif
            @if ($invoice->vendor_vat_rate && $invoice->vendor_vat_number)
            <tr style="background: #F5F5F5;">
                <td width="25%">
                    <div class="invoice-table-first" style="font-weight:normal;">
                        VAT
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second">
                        &nbsp;
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second">
                        {{ $invoice->vendor_vat_rate }}%
                    </div>
                </td>
                <td width="25%" align="right">
                    <div class="invoice-table-second">
                        {{ currencyFormatted($invoice->vat_amount, 'EUR', true) }}
                    </div>
                </td>
            </tr>
            @endif
            <tr>
                <td width="25%">
                    <div class="invoice-table-first">
                        Grand Total
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second">
                        &nbsp;
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second">
                        &nbsp;
                    </div>
                </td>
                <td width="25%" align="right">
                    <div class="invoice-table-second" style="font-weight:bold;">
                        {{ currencyFormatted($invoice->total, 'EUR', true) }}
                    </div>
                </td>
            </tr>
            <tr>
                <td height="10px"></td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <table cellpadding="0" cellspacing="0" class="invoice-table">
            <tr>
                <td>
                    <div class="invoice-table-first" style="padding-left:0;font-size:9px;margin-bottom:-5px;">
                        @if($invoice->invoice_from === 'booster')
                            Remit to Eloking Ltd.
                        @else
                            SIA Eloking
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <div class="invoice-table-second" style="padding-left:0;font-size:10px;">
                        Aleksandra Čaka iela 125 - 7, Riga, LV-1011, Latvia
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second" style="padding-left:0;font-size:10px;">
                        info@eloking.com
                    </div>
                </td>
                <td width="25%">
                    <div class="invoice-table-second" style="padding-left:0;font-size:10px;">
                        eloking.com
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
