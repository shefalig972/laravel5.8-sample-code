<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="email=no">
    <meta name="x-apple-disable-message-reformatting">
    <!--[if !mso]>
  <!-->
    <title>User Profile</title>
    <style>
        @page {
            size: 1000px 1500px;
            margin: 0;
        }

        table,
        tr,
        td,
        th,
        tbody,
        thead,
        tfoot {
            /*page-break-inside: avoid !important;*/
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-weight: bold;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        table,
        figure {
            /*page-break-inside: avoid;*/
            font-size: 13px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table td,
        .table th {
            padding: .75rem;
            color: #6B6B6B !important;
        }

        .table-striped tbody tr:nth-of-type(even) td {
            background-color: #F9F9F9;
        }

        .span-bg li span {
            display: block;
            white-space: normal;
        }
    </style>

</head>

<body style="padding: 0; margin: 0; -webkit-font-smoothing:antialiased; background-color:#f6f8f9; -webkit-text-size-adjust:none;margin: 0;
padding: 0;	font-family: Helvetica, Arial,sans-serif; mso-line-height-rule: exactly; padding-top: 10px">
    <table style="background: #fff;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td align="left" valign="top">
                    <table style="background: #fff;" width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="padding: 15px;" align="left" valign="top">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td width="579">
                                                    <h1 style="margin-bottom:0;font-size: 24px;margin-top:0; color: #6B6B6B !important;">{{ @$invoice->name }}</h1>
                                                </td>
                                                <td width="87">
                                                    <h6 style="color: #000;margin:0; font-size: 8px; font-weight: normal;">Powered By</h6>
                                                    <h4 style="color: #000;margin:0;font-size: 15px; font-weight: bold;">MyBizz<span style="color: #30CDCC;">Hive</span></h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width="700" style="" border="0" align="center" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td align="left" valign="top" style="padding:15px 15px 0;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#fff;border-radius: 4px;">
                        <tbody>
                            <tr>
                                @if(@$file_data)
                                <td width="25%" align="left" valign="center" style="padding: 10px 0 10px 15px;"><img style="width:100%; max-height: 150px;" src="{{ $file_data  }}">

                                </td>
                                @endif
                                <td align="left" valign="center" style="padding: 10px 0 10px 20px;font-size: 24px;color: #817F80; font-weight: bold; padding-top:45px;">{{ @$invoice->userOrgMap->organization->name }}
                                    <br>
                                    <div style="font-size: small">
                                        @if(@$invoice->userOrgMap->organization->license_no)
                                            License #{{ @$invoice->userOrgMap->organization->license_no }} &nbsp;&nbsp;
                                        @endif
                                        @if($bonded) <span style="font-family: DejaVu Sans, sans-serif;color: #30CDCC">✔</span> Bonded @endif @if($insured) <span style="font-family: DejaVu Sans, sans-serif;color: #30CDCC">✔</span> Insured @endif
                                    </div>
                                </td>
                                <td width="35%" align="right" valign="center" style="padding: 10px;color: #817F80;font-family: Helvetica, Arial,sans-serif;">
                                    <p style="font-size: 14px;  bold;margin-bottom:5px;margin-top:0;font-family: Helvetica, Arial,sans-serif;">{{ @$invoice->userOrgMap->organization->street_address }}</p>
                                    <p style="font-size: 14px; bold;margin-bottom:5px;margin-top:0;font-family: Helvetica, Arial,sans-serif;">{{ @$invoice->userOrgMap->organization->city.', '.@$invoice->userOrgMap->organization->zip }}</p>
                                    <p style="font-size: 14px;  bold;margin-bottom:5px;margin-top:0;font-family: Helvetica, Arial,sans-serif;">{{ @$invoice->userOrgMap->organization->state.', '.@$invoice->userOrgMap->organization->country }}</p>
                                    <p style="font-size: 14px; bold;margin-bottom:5px;margin-top:0;font-family: Helvetica, Arial,sans-serif;">{{ @$invoice->userOrgMap->organization->phone }}</p>
                                    <a href="" style="font-size: 14px; bold;color: #4A90E2;text-decoration:none;margin-bottom:5px;display:block;font-family: Helvetica, Arial,sans-serif;">{{ @$invoice->userOrgMap->organization->email }}</a>
                                    <a href="" style="font-size: 14px;  bold;color: #4A90E2;text-decoration:none;margin-bottom:5px;display:block;font-family: Helvetica, Arial,sans-serif;">{{ @$invoice->userOrgMap->organization->website }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding:7px 5px 15px" align="left" valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td width="28%" align="left" valign="top" style="padding: 10px;">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:10px;background:#fff;border-radius: 4px;">

                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="padding-bottom: 15px;color: #6B6B6B !important;"><label style="font-size: 16px; font-weight: bold;">{{ @$invoice->contact->first_name.' '.@$invoice->contact->last_name }}</label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding-bottom: 13px;color: #6B6B6B !important;">
                                                                                    <div style="font-size: 13px; font-weight: bold;"><a href="#" style="color: #4A90E2 !important;">{{ @$invoice->contact->email }}</a></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding-bottom: 4px;color: #6B6B6B !important;">
                                                                                    <div style="font-size: 13px; font-weight: bold;">{{ @$invoice->contact->organization }}<br>
                                                                                        <span style="display: block;font-weight: normal;margin-top: 3px;">@if(@$invoice->contact->title) ({{ @$invoice->contact->title }}) @endif</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td width="36%" align="left" valign="top" style="padding: 10px;">

                                                    <table style="backgroun:#fff;" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:10px;background:#fff; border-radius: 4px;">

                                                                    <table style="background-color:#fff;" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="padding-bottom: 10px;color: #6B6B6B !important;" align="left" valign="top">
                                                                                    <label style="margin-bottom: 4px; display: block;">Date</label>
                                                                                    @if(@$invoice->event_date)
                                                                                    <div style="font-size: 13px; font-weight: bold;">{{ date('D, M d, Y', strtotime(@$invoice->event_date))   }}</div>
                                                                                    @endif
                                                                                </td>
                                                                                <td style="padding-bottom: 10px;color: #6B6B6B !important;" align="left" valign="top">
                                                                                    <label style="margin-bottom: 4px; display: block;">Start Time</label>
                                                                                    <div style="font-size: 13px; font-weight: bold;"> @if(@$invoice->event_date) {{ date('h:i A', strtotime(@$invoice->event_date))   }} @endif @if(@$invoice->event_duration) <span style="font-weight: normal;">({{ @$invoice->event_duration }})</span> @endif </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="padding-bottom: 4px;color: #6B6B6B !important;"><label style="margin-bottom: 4px; display: block;">Location</label>
                                                                                    <div style="font-size: 13px; font-weight: bold;">{{ @$invoice->event_location }} </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td width="36%" align="left" valign="top" style="padding: 10px;">

                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:10px;background:#fff; border-radius: 4px;">
                                                                    <table style="background-color:#fff;" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="50%" style="padding-bottom: 10px;color: #6B6B6B !important;" align="left" valign="top">
                                                                                    <label style="margin-bottom: 4px; display: block;">Invoice Date</label>

                                                                                    <div style="font-size: 13px; font-weight: bold;">@if(@$invoice->timeline->sent_at) {{ date('D, M d, Y', strtotime(@$invoice->timeline->sent_at))   }} @endif </div>

                                                                                </td>
                                                                                <td width="50%" style="padding-bottom: 10px;color: #6B6B6B !important;" align="left" valign="top">
                                                                                    <label style="margin-bottom: 4px; display: block;">Invoice ID</label>

                                                                                    <div style="font-size: 13px; font-weight: bold;">{{ $invoice['invoice_serial_no']  }}</div>

                                                                                </td>

                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table style="background-color:#fff;" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="50%" style="padding-bottom: 10px;color: #6B6B6B !important;" align="left" valign="top">
                                                                                    <label style="margin-bottom: 4px; display: block;">Total Amount Due</label>
                                                                                    <div style="font-size: 13px; font-weight: bold;font-size:24px;">${{ number_format($invoice['amount_balance'],2)  }}</div>
                                                                                </td>

                                                                                <td width="50%" style="padding-bottom: 10px;color: #6B6B6B !important;" align="left" valign="top">
                                                                                    <label style="margin-bottom: 4px; display: block;">Due Date</label>
                                                                                    <div style="font-size: 13px; font-weight: bold;">@if(@$invoice->due_date) {{ date('D, M d, Y', strtotime(@$invoice->due_date))   }} @endif</div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" style="padding: 0 15px 7px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding: 15px 25px;background:#fff;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2 style="margin-bottom: 0;margin-top:0;color: #6B6B6B !important;">{{ @$item['invoice_service_name'] }}</h2>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="background:#fff;border-top: none; padding:0 15px">

                                    <table class="table table-striped smart-table mb-0" border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="border-bottom: solid 1px #ddd;color: #6B6B6B !important;" width="25%" align="left" valign="top">{{ @$item['item_heading_name'] }}</th>
                                                <th style="border-bottom: solid 1px #ddd;color: #6B6B6B !important;" width="50%" align="left" valign="top">{{ @$item['item_heading_description'] }}</th>
                                                <th style="border-bottom: solid 1px #ddd;color: #6B6B6B !important;" width="25%" align="left" valign="top">{{ @$item['item_heading_charges'] }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(@$item['item'])
                                            @foreach($item['item'] as $key => $val)
                                            <tr>
                                                <td style="color: #6B6B6B !important;" align="left" valign="top" class="qt-activity-name"><strong>{{ $val['item_name'] }}</strong></td>
                                                <td style="color: #6B6B6B !important;" align="left" valign="top" class="qt-desc"> {{ $val['item_description'] }} </td>
                                                <td style="color: #6B6B6B !important;" align="left" valign="top" class="qt-fees"><strong>${{ number_format($val['item_charge'],2)  }}</strong></td>
                                            </tr>
                                            @endforeach
                                            @endif

                                            <tr>
                                                <th style="border-bottom: solid 1px #ddd;color: #6B6B6B !important;" width="100%" align="left" valign="top" colspan="3"></th>
                                            </tr>
                                            <tr>
                                                <td style="border-top: solid 1px #BCBCBC;background: #fff;color: #6B6B6B !important;"></td>
                                                <td style="font-size: 15px; border-bottom: solid 1px #BCBCBC;color: #6B6B6B !important;border-top: solid 1px #BCBCBC;background: #fff;" align="right" valign="top" class="qt-qttotal qt-subtotal">Sub-total</td>
                                                <td style="font-size: 15px;border-bottom: solid 1px #BCBCBC;color: #6B6B6B !important;border-top: solid 1px #BCBCBC;background: #fff;" align="left" valign="top" class="qt-fees">${{ number_format(@$item['sub_total'],2)  }}</td>
                                            </tr>


                                            @if(@$item['fee'])
                                            @foreach(@$item['fee'] as $key => $fee)
                                            @if(!empty($fee['fee']))
                                            <tr>
                                                <td style="background: #fff;" class="qt-colblank"></td>
                                                <td style="font-size: 15px;background: #fff;" align="right" valign="top" class="qt-qttotal">{{ @$fee['fee_name'] }}</td>
                                                <td style="font-size: 15px;background: #fff;" align="left" valign="top" class="qt-fees">${{ number_format(@$fee['fee'],2)  }} </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endif

                                            @if(@$item['discount'])
                                            @foreach(@$item['discount'] as $key => $fee)
                                            @if(!empty($fee['discount']))
                                            <tr>
                                                <td style="background: #fff;" class="qt-colblank"></td>
                                                <td style="font-size: 15px;background: #fff;" align="right" valign="top" class="qt-qttotal">{{ @$fee['discount_name'] }}</td>
                                                <td style="font-size: 15px;background: #fff; padding-left: 0;" align="left" valign="top" class="qt-fees"><span style="display: inline-block;margin:3px;">-</span>${{ number_format(@$fee['discount'],2)  }} </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endif

                                            <tr>
                                                <td style="background: #fff;" class="qt-colblank"></td>
                                                <td style="font-size: 15px;border-top: solid 1px #BCBCBC;background: #fff;" align="right" valign="top" class="qt-qttotal qt-total">Total</td>
                                                <td style="font-size: 15px;border-top: solid 1px #BCBCBC;background: #fff;" align="left" valign="top" class="qt-fees">${{ number_format($item['total'],2)  }}</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #fff;" class="qt-colblank"></td>
                                                <td style="font-size: 15px;background: #fff;" align="right" valign="top" class="qt-qttotal">Advance/Deposit</td>
                                                <td style="font-size: 15px;background: #fff; padding-left: 0;" align="left" valign="top" class="qt-fees"><span style="display: inline-block;margin:3px;">-</span>${{ number_format($invoice->amount_received,2)  }} </td>
                                            </tr>
                                            @if(@$invoice->tip_amount)
                                            <tr>
                                                <td style="background: #fff;" class="qt-colblank"></td>
                                                <td style="font-size: 15px;" align="right" valign="top" class="qt-qttotal qt-total">Tip</td>
                                                <td style="font-size: 15px;" align="left" valign="top" class="qt-fees">${{ number_format(@$invoice->tip_amount,2)  }}</td>
                                            </tr>
                                            @endif
                                            @if($invoice->invoice_status_type_id ==5)
                                            <tr>
                                                <td style="background: #fff;" class="qt-colblank"></td>
                                                <td style="font-size: 15px;border-top: solid 1px #BCBCBC;background: #fff;" align="right" valign="top" class="qt-qttotal qt-total"><strong>Amount Paid</strong></td>
                                                <td style="font-size: 15px;border-top: solid 1px #BCBCBC;background: #fff;" align="left" valign="top" class="qt-fees"><strong>${{ number_format($invoice->amount_paid,2)  }}</strong></td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td style="background: #fff;" class="qt-colblank"></td>
                                                <td style="font-size: 15px;border-top: solid 1px #BCBCBC;background: #fff;" align="right" valign="top" class="qt-qttotal qt-total"><strong>Amount Due</strong></td>
                                                <td style="font-size: 15px;border-top: solid 1px #BCBCBC;background: #fff;" align="left" valign="top" class="qt-fees"><strong>${{ number_format($invoice->amount_balance,2)  }}</strong></td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            @if(@$item['section'])
            @foreach(@$item['section'] as $key => $section)
            <tr>
                <td align="left" valign="top" style="padding:7px  15px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding:15px; background:#fff;color: #6B6B6B ;" align="left" valign="top" class="span-bg">
                                    <h2 style="margin-top:0;font-size: 20px;margin-bottom: 13px;">{{ @$section['section_name'] }}</h2>
                                    {!! @$section['section_description'] !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            @endforeach
            @endif


        </tbody>
    </table>

    <div style="text-align: center;float-left;width:100%;">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td align="left" valign="top" style="padding: 15px;background: #fff;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td width="180" align="left" valign="top" style="border-right: solid 2px #30CDCC;">
                                        <h1 style="margin-bottom:7px;margin-top:0;font-size: 24px;color: #6B6B6B !important;">{{ @$invoice->contact->first_name.' '.@$invoice->contact->last_name }} </h1>
                                        <p style="display:block; font-size: 12px;color: #6B6B6B !important;margin-right:10px;"> <strong> {{ @$invoice->contact->organization }} </strong> @if(@$invoice->contact->title) ({{ @$invoice->contact->title }}) @endif </p>

                                    </td>
                                    @if($invoice->invoice_status_type_id ==5)
                                    <td width="100" align="center" valign="top" style="color: #6B6B6B !important;border-right: solid 2px #30CDCC;">
                                        <div style="font-size: 20px;margin-bottom:6px; font-weight: bold;">${{ number_format(@$invoice['amount_paid'],2)  }}</div>
                                        <div style="display:block; font-weight: bold; font-size: 14px;margin:0">Amount Paid</div>
                                    </td>
                                    @else
                                    <td width="100" align="center" valign="top" style="color: #6B6B6B !important;border-right: solid 2px #30CDCC;">
                                        <div style="font-size: 20px;margin-bottom:6px; font-weight: bold;">${{ number_format(@$invoice['amount_balance'],2)  }}</div>
                                        <div style="display:block; font-weight: bold; font-size: 14px;margin:0">Amount Due</div>
                                    </td>
                                    @endif

                                    @if($invoice->invoice_status_type_id ==5 )
                                    <td width="100" align="center" valign="top" style="color: #6B6B6B !important;border-right: solid 2px #30CDCC;">
                                        <div style="font-size: 13px;margin-bottom:6px; font-weight: bold;">@if(@$invoice->timeline->paid_at) {{ date('D, M d, Y', strtotime(@$invoice->timeline->paid_at))   }} @endif </div>
                                        <div style="display:block; font-weight: bold; font-size: 14px;margin:0">Paid On</div>
                                    </td>
                                    @else
                                    <td width="100" align="center" valign="top" style="color: #6B6B6B !important;border-right: solid 2px #30CDCC;">
                                        <div style="font-size: 13px;margin-bottom:6px; font-weight: bold;">@if(@$invoice->due_date) {{ date('D, M d, Y', strtotime(@$invoice->due_date))   }} @endif </div>
                                        <div style="display:block; font-weight: bold; font-size: 14px;margin:0">Due Date</div>
                                    </td>
                                    @endif


                                    <td width="100" align="center" valign="top" style="color: #817F80!important;">
                                        <div style="display:block; font-weight: normal; font-size: 14px;margin:0;">Signature</div>
                                    </td>

                                    @if($invoice->invoice_status_type_id ==4 )


                                    <td width="220" align="left" valign="top" style="color: #6B6B6B !important;">
                                        <div style="background: #F8F8F8; padding: 10px; text-align: center;">
                                            <div style="font-size: 24px;margin-bottom:8px; font-weight: bold; color:#98100F !important">Past Due</div>
                                        </div>
                                    </td>

                                    @endif

                                    @if(@$invoice->accept_signature)

                                    <td width="220" align="left" valign="top" style="color: #6B6B6B !important;">
                                        <div style="background: #F8F8F8; padding: 10px; text-align: center;">
                                            <div style="font-size: 24px;margin-bottom:8px; font-weight: bold;">{{ @$invoice->accept_signature }}</div>
                                            {{--<div style="display:block; font-size: 12px;margin:0">Signed & accepted at {{ date('D, M d, Y', strtotime(@$invoice->timeline->paid_at))     }} </div>--}}
                                            <div style="display:block; font-size: 12px;margin:0">Signed & accepted at @if(isset($invoice->timeline->paid_at)){{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$invoice->timeline->paid_at)->format('D, M d, Y') }} @endif</div>
                                        </div>
                                    </td>
                                    @endif


                                    @if(@$invoice->paid_by != 'Online')

                                    <td width="220" align="left" valign="top" style="color: #6B6B6B !important;">
                                        <div style="background: #F8F8F8; padding: 10px; text-align: center;">
                                            <div style="font-size: 16px;margin-bottom:8px; font-weight: bold;">Payment Method: {{ @$invoice->paid_by }}</div>
                                            {{--<div style="display:block; font-size: 12px;margin:0">Last updated on: {{ date('D, M d, Y', strtotime(@$invoice->timeline->paid_at)) }}</div>--}}
                                            <div style="display:block; font-size: 12px;margin:0">Last updated on: @if(isset($invoice->timeline->paid_by)){{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $invoice->timeline->paid_by)->format('D, M d, Y') }} @endif</div>
                                        </div>
                                    </td>
                                    @endif

                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


</body>

</html>
