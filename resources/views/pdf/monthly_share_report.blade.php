<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Monthly Share Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body {
            font-family: Verdana, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        @media print {
            #buttons {
                display: none;
            }
        }
        th, td {
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 8px;
            text-align: left;
        }
        .heading {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .shop-details {
            text-align: center;
            margin-bottom: 20px;
        }
        .shop-logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .partner-statement {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #000;
            border-collapse: collapse;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        .total-row {
            background-color: #d3d3d3;
            font-weight: bold;
        }
        .balance-row {
            background-color: #e8e8e8;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div style="width:16cm; padding:0.5cm; margin:0cm; border:solid 0px #304346">
        <!-- Shop Logo, Name, and Address -->
        <div class="shop-details">
            <img src="{{ url('/admin/images/logo/login.jpg') }}" alt="Shop Logo" class="shop-logo"><br>
        </div>

        <div class="partner-statement">
            Partner Statement
        </div>

        <table>
            <tr>
                <td>Name: <strong>{{ $partnerName }}</strong></td>
                <td>&nbsp;</td>
                <td align="right">Year: <strong>{{ $year }}</strong></td>
            </tr>
            <tr>
                <td>{{ $contact_number }}</td>
                <td>&nbsp;</td>
                <td align="right">Month: <strong>{{ $month }}</strong></td>
            </tr>
        </table>

        <table>
            <tr class="heading">
                <th>Date</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
            </tr>
            <tr>
                <td></td>
                <td>Opening Balance</td>
                <td>{{ number_format(0, 2) }}</td>
                <td>{{ number_format(0, 2) }}</td>
            </tr>
            @php
                $totalProfit = 0;
            @endphp
            @foreach($data as $da)
            <tr>
                @php
                    $totalProfit += $da['profit'];
                @endphp
                <td>{{ $da['date'] }}</td>
                <td>Profit Share ({{ $da['percentage'] }}%) - {{ $da['store_name'] }}</td>
                <td>{{ number_format($da['profit'], 2) }}</td>
                <td></td>
            </tr>
            @endforeach
            @php
                $totaltransfar = 0;
            @endphp
            @foreach($transfer as $trans)
            <tr>
                @php
                    $totaltransfar += $trans->amount;
                @endphp
                <td>{{ $endDate }}</td>
                <td>Bank Transfer</td>
                <td></td>
                <td>{{ number_format($trans->amount, 2) }}</td>
            </tr>
            @endforeach
            
            @php
                $closingBalance = $totalProfit - $totaltransfar;
            @endphp
            <tr class="balance-row">
                <td></td>
                <td>Closing Balance</td>
                <td>{{ number_format($closingBalance > 0 ? $closingBalance : 0, 2) }}</td>
                <td>{{ number_format($closingBalance < 0 ? abs($closingBalance) : 0, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="2" align="right"><strong>Total:</strong></td>
                <td><strong>{{ number_format($totalProfit, 2) }}</strong></td>
                <td><strong>{{ number_format($totaltransfar, 2) }}</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
