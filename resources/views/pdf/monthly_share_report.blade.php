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
        }
        @media print {
            #buttons {
                display: none;
            }
        }
        th, td {
            border: 1px solid black;
            border-collapse: collapse;
            border-style: dotted;
            padding: 4px;
        }
        .heading {
            background-color: #d3d3d3; /* Light grey background */
            font-weight: bold;
        }
        .shop-details {
            text-align: center;
            margin-bottom: 20px;
        }
        .shop-logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div style="width:16cm; padding:0.5cm; margin:0cm; border:solid 0px #304346">
        <!-- Shop Logo, Name, and Address -->
        <div class="shop-details">
            <img src="{{url('/admin/images/logo/login.jpg')}}" alt="Shop Logo" class="shop-logo"><br>
            <strong>Ziya </strong><br>
            Qatar Qasiya<br>
            9633740021
        </div>

        <table border="0" width="100%">
            <tr>
                <td colspan="3" align="center"><strong>Partner Statement</strong></td>
            </tr>
            <tr>
                <td>Name: <strong>{{$partnerName}}</strong></td>
                <td>&nbsp;</td>
                <td align="right">Year: <strong>{{$year}}</strong></td>
            </tr>
            <tr>
                <td>{{$contact_number}}</td>
                <td>&nbsp;</td>
                <td align="right">Month: <strong>{{$month}}</strong></td>
            </tr>
            <tr> 
                <td colspan="3">
                    <table border="0" width="100%" cellspacing="0" cellpadding="4">
                        <tr class="heading">
                            <th>Date</th>
                            <th>Description</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Opening Balance</td>
                            <td>0</td>
                            <td>0</td>
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
                            <td>{{ $da['profit'] }}</td>
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
                            <td></td>
                            <td>Bank Transfer</td>
                            <td></td>
                            <td>{{$trans->amount}}</td>
                        </tr>
                        @endforeach
                        
                        <tr>
                            <td></td>
                            <td>Closing Balance</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <!-- <tr><td colspan="4">----------------------------------------------------------------------------------------------------</td></tr> -->
                        <tr>
                            <td colspan="2" align="right"><strong>Total:</strong></td>
                            <td><strong>{{ $totalProfit }}</strong></td>
                            <td><strong>{{ $totaltransfar }}</strong></td>
                        </tr>
                        <!-- <tr><td colspan="4">----------------------------------------------------------------------------------------------------</td></tr> -->
                    </table>
                </td>
            </tr>
            <!-- <tr>
                <td colspan="3">&nbsp;</td>
            </tr> -->
        </table>
    </div>

</body>
</html>
