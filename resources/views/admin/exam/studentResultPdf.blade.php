<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Result</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <style>
        body {
            padding: .1in;
        }

        .company-logo {
            display: inline-block;
            width: 25%;
            padding: 5px;
            margin-top: -3px;
        }

        .company-logo h2 {
            margin-top: 0px;
        }

        .form-heading {
            display: inline-block;
            width: 72%;
            padding: 5px;
            text-align: right;
        }

        .form-heading h2 {
            margin-top: 0px;
        }

        .input-field {
            padding-bottom: 10px;
        }

        .input-field h3 {
            display: inline-block;
            margin: 0px;
        }

        .input-field h4 {
            display: inline-block;
            margin: 0px;
        }

        .input-field p {
            display: inline-block;
            margin: 0px;
        }

        .head-font {
            font-style: italic;
            padding-bottom: -15px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border-collapse: none;
            border-spacing: 0;
            font-size: 0.9166em;
        }

        table thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        table thead th {
            padding: 5px 10px;
            background: #353A40;
            text-align: left;
            color: white;
            font-weight: 400;
            text-transform: uppercase;
            font-size: 18px;
        }

        table tbody td {
            padding: 5px;
            color: #777777;
            text-align: left;
            font-size: 16px;
        }

        table tbody td:last-child {
            border-right: none;
        }

        table tbody h3 {
            margin-bottom: 5px;
            color: #FEEEEF;
            font-weight: 600;
        }

        th,
        td {
            text-align: left;
            font-weight: normal;
            vertical-align: middle;
        }

        th {
            border: 0.01em solid lightgray;
        }

        #invoice td {
            border: 0.01em solid lightgray;
        }

        <blade media|%20screen%20%7B%0D>div.divFooter {
            display: none;
        }
        }

        <blade media|%20print%20%7B%0D>div.divFooter {
            position: fixed;
            bottom: 0;
        }
        }

        .total-amount-field {
            padding-bottom: 10px;
            padding-top: 10px !important;
            padding-right: 10px;
            float: right;
        }

        .total-amount-field h4 {
            display: inline-block;
            margin: 0px;
        }

        .total-amount-field p {
            display: inline-block;
            margin: 0px;
        }

        .table-data {
            text-align: center;
            font-size: 14px;
            color: black;
            padding: 15px 15px;
        }

    </style>
</head>

<body>

    <div class="company-logo">
        <img height="80px" width="160px" src="{{ public_path('company/shadowaide.jpg') }}">
    </div>

    <div class="form-heading" style="vertical-align: top; padding-top: -40px !important;"">
        @php
            $company_details = App\CompanyDetail::first();
        @endphp
        <h3 style=" padding-bottom:-10px !important;">SHADOW AIDE <span style="color: #fd7635;">&</span>
        <span style="color: green">LIFE LINE</span></h3>
        <h5 style="padding-bottom:-10px !important;"><span style="color: rgb(124, 0, 41)">(Ensure Optimal
                Education)</span><span style="color:#2c75e4;"> (Turning Student Into Assets)</span></h5>
        {{-- <h5 style="padding-bottom:-10px !important;"><span style="color:#2c75e4;"> (Turning Student Into Assets)</span>
        </h5> --}}
    </div>

    @if(isset($start_date))
        <div class="input-field" style="padding-top: 20px !important;">
            <h4>Student Name : </h4>
            <p>{{ $results[0]->first_name}} {{ $results[0]->last_name }}</p>
        </div>
        <div class="input-field">
            <h4>Student Name : </h4>
            <p>{{ $results[0]->registration_id}} {{ $results[0]->registration_id }}</p>
        </div>
        <div class="input-field">
            <h4>Starting Date : </h4>
            <p>{{ $start_date }}</p>
        </div>

        <div class="input-field">
            <h4>Ending Date : </h4>
            <p>{{ $end_date }}</p>
        </div>
    @endif



    <div style="text-align: center;">
        <h2 class="head-font">Result List</h2>
    </div>

    <table id="invoice" border="2" cellspacing="0" cellpadding="0">

        <thead>
            <tr>

                <th style="text-align: center;width:14%;"
                    style="background-color:white; color:black;font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Exam Name
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Obtained Marks
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Highest Marks
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Total Marks
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Satisfactory Marks
                </th>
                <th style="text-align: center;width:14%;"
                    style="background-color:white;color:black; font-size:8px;background-color:lightgrey;padding:10px 10px;">
                    Merit Position
                </th>

            </tr>
        </thead>

        <tbody>
            @foreach($results as $result)
                <tr>

                    <td class="table-data">
                        {{ $result->exam_name }}
                    </td>
                    <td class="table-data">
                        {{ $result->obtained_marks }}
                    </td>
                    <td class="table-data">
                        {{ $result->height_marks }}
                    </td>
                    <td class="table-data" style="text-align: right">
                        {{ $result->total_marks }}
                    </td>
                    <td class="table-data" style="text-align: right">
                        {{ $result->satisfactory_mark }}
                    </td>
                    <td class="table-data" style="text-align: right">
                        {{ $result->merit_position }}
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>

        {{--<div class= "col-12">
            <div class="divFooter" style="position: absolute; bottom: 5px;font-size:11px">
                <p style=""> Print Date: {{ Carbon\Carbon::now()->format('d-m-Y') }} & Print Time:
                    {{ Carbon\Carbon::now('Asia/dhaka')->format('h:i:s a') }}
                </p>
            </div>
        </div>--}}
        <div class="divFooter" style="position: absolute; bottom: 5px;font-size:11px;text-align:center">
            <p style=""> Made By: codegigz
            </p>
        </div>

</body>

</html>
