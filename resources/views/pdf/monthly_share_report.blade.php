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
        th {
            border: 1px solid black;
            border-collapse: collapse;
            border-style: dotted;
        }
    </style>
</head>
<body>
    <div style="width:16cm; padding:0.5cm; margin:0cm; border:solid 0px #304346">
        <table border="0" width="100%">
            <tr>
                <td colspan="3" align="center"><strong>Monthly Share Report</strong></td>
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
                        <tr>
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
                            <td>Profit Share({{ $da['percentage'] }})%-{{ $da['store_name'] }}</td>
                            <td>{{ $da['profit'] }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td>Closing Balance</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr><td colspan="4">----------------------------------------------------------------------------------------------------</td></tr>
                        <tr>
                            <td colspan="2" align="right"><strong>Total:</strong></td>
                            <td><strong>{{ $totalProfit }}</strong></td>
                            <td><strong>{{ $totalProfit }}</strong></td>
                        </tr>
                        <tr><td colspan="4">----------------------------------------------------------------------------------------------------</td></tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>
    </div>
    <div style="padding-left:18px" id="buttons">
        <button onclick="window.print(); return false">Print</button>
        @if(Request::get('destination'))
        <button onclick="window.location='{{ URL::to(Request::get('destination')) }}'; return false">Close</button>
        @else
        <button onclick="window.close(); return false">Close</button>
        @endif
    </div>
</body>
</html>
