<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Expense</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <style>
        body {
            padding: .1in;
        }

        .form-heading {
            display: inline-block;
            width: 70%;
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
            padding-top: -40px !important;
        }

        .header-date {
            font-style: italic;
            padding-top: 0px !important;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            padding-bottom: 30px;
        }

        td,
        th,
        tr {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
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

    </style>
</head>

<body>

    <div class="form-heading" style="vertical-align: top; padding-top: -50px !important;">
        <h3 style=" padding-bottom:-10px !important;">SHADOW AIDE <span style="color: #fd7635;">&</span>
            <span style="color: green">LIFE LINE</span>
        </h3>
    </div>

    <div style="text-align: left;">
        <h2 class="head-font">Balance Sheet</h2>
    </div>

    @if(isset($start_date))
        <div class="input-field" style="padding-top: 20px !important;">
            <h4>Starting Date : </h4>
            <p>
                {{ date('d-m-Y', strtotime($start_date)) }}
            </p>
        </div>

        <div class=" input-field">
            <h4>Ending Date : </h4>
            <p>
                {{ date('d-m-Y', strtotime($end_date)) }}
            </p>
        </div>
    @endif

    @foreach($data as $date => $d)

        <div style="text-align: left;">
            <h2 class="header-date">Date : {{ $date }}</h2>
        </div>

        <table style="width:100%">

            <tr>
                <th colspan="2" style="text-align: left; background-color:black; color: white;">Income Summary</th>
            </tr>

            @if(count($d["income"]) > 0)

                @foreach($d["income"] as $batch => $income)
                    <tr>
                        <td style="white-space: nowrap; text-align: left;">{{ $batch }}</td>
                        <td style="white-space: nowrap; text-align: right">{{ $income }} Tk</td>
                    </tr>
                @endforeach

                <tr>
                    <th style="white-space: nowrap; text-align: left;">Total Income</th>
                    <th style="white-space: nowrap; text-align: right">{{ $d["total_income"] }}
                        Tk</th>
                </tr>

            @else

                <tr>
                    <td colspan="2" style="white-space: nowrap; text-align: left;">No Transactions Available</td>
                </tr>

            @endif

            <tr>
                <th colspan="2" style="text-align: left; background-color:black; color: white;">Expense Summary</th>
            </tr>

            @if(count($d["expense"]) > 0)

                @foreach($d["expense"] as $item => $expense)
                    <tr>
                        <td style="white-space: nowrap; text-align: left;">{{ $item }}</td>
                        <td style="white-space: nowrap; text-align: right">{{ $expense }} Tk</td>
                    </tr>
                @endforeach

                <tr>
                    <th style="white-space: nowrap; text-align: left;">Total Expense</th>
                    <th style="white-space: nowrap; text-align: right">
                        {{ $d['total_expense'] }} Tk</th>
                </tr>

            @else

                <tr>
                    <td colspan="2" style="white-space: nowrap; text-align: left;">No Transactions Available</td>
                </tr>

            @endif

            <tr>
                <th colspan="2" style="white-space: nowrap; text-align: right; background-color:black; color: white;">
                    Net
                    Income : {{ $d['net_income'] }} Tk</th>
            </tr>

        </table>

        <hr>

    @endforeach

    <div style="text-align: left;">
        <h2 class="header-date">FULL SUMMARY</h2>
    </div>

    <table style="width:100%">

        <tr>
            <td style="white-space: nowrap; text-align: left;">Total Days Count</td>
            <td style="white-space: nowrap; text-align: right">{{ $summary['total_days'] }}
                days
            </td>
        </tr>
        @foreach($summary["batch_per_income"] as $batch => $income)
            <tr>
                <td style="white-space: nowrap; text-align: left;">{{ $batch }}</td>
                <td style="white-space: nowrap; text-align: right">{{ $income }} Tk</td>
            </tr>
        @endforeach

        <tr>
            <td style="white-space: nowrap; text-align: left; font-weight: bold">All Income</td>
            <td style="white-space: nowrap; text-align: right">{{ $summary['all_income'] }} Tk
            </td>
        </tr>

        <tr>
            <td style="white-space: nowrap; text-align: left; font-weight: bold">All Expense</td>
            <td style="white-space: nowrap; text-align: right">{{ $summary['all_expense'] }} Tk
            </td>
        </tr>

        <tr>
            <td style="white-space: nowrap; text-align: left; font-weight: bold">Net Income Summary</td>
            <td style="white-space: nowrap; text-align: right">{{ $summary['all_net_income'] }}
                Tk
            </td>
        </tr>

    </table>

    <div class="divFooter" style="position: absolute; bottom: 5px;font-size:11px">
        <p style=""> Print Date: {{ Carbon\Carbon::now()->format('d-m-Y') }} & Print Time:
            {{ Carbon\Carbon::now('Asia/dhaka')->format('h:i:s a') }}
        </p>
    </div>

</body>

</html>
