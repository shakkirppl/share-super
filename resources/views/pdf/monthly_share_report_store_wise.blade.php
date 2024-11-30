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
            Income Statement
        </div>

        <table>
            <tr>
                <td>Name: <strong>{{ $name }}</strong></td>
               
                <td align="right">Month: <strong>{{$month }}</strong></td>
            </tr>
          
        </table>

        <table>
            <tr class="heading">
                <th>Income</th>
                <th>Expense</th>
                <th>Profit</th>
               
            </tr>
            <tr>
               
                <td>{{ number_format($income, 2) }}</td>
                <td>{{ number_format($expense, 2) }}</td>
                <td>{{ number_format($profit, 2) }}</td>
            </tr>
           
        </table>
         <div class="row">
                        <div class="col-12">
                            <h4 class="card-title">Payment Voucher</h4>
                            <div class="table-responsive">
                                <table class="table table-hover" id="value-table-zero">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Expense</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Vat</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($payment))
                                            @foreach($payment as $key => $pay)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $pay->in_date }}</td>
                                                <td>
                                                    @foreach($pay->expense as $exp)
                                                        {{ $exp->name }}
                                                    @endforeach
                                                </td>
                                                   <td>{{$pay->description}}</td>
                                                <td>{{ $pay->amount }}</td>
                                                <td>{{ $pay->vat_amount }}</td>
                                                <td>{{ $pay->total_amount }}</td>
                                            </tr>
                                            @endforeach
                                         @endif
                                    </tbody>
                                </table>
                            </div>

                    

                            <h4 class="card-title">Receipt Voucher</h4>
                            <div class="table-responsive">
                                <table class="table table-hover" id="value-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Expense</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Vat</th>
                                            <th>Total Amount</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($receipt))
                                            @foreach($receipt as $key => $rece)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $rece->in_date }}</td>
                                                <td>
                                                    @foreach($rece->receipt as $res)
                                                        {{ $res->name }}
                                                    @endforeach
                                                </td>
                                                 <td>{{$rece->description}}</td>
                                                <td>{{ $rece->amount }}</td>
                                                <td>{{ $rece->vat_amount }}</td>
                                                <td>{{ $rece->total_amount }}</td>
                                                
                                            </tr>
                                            @endforeach
                                     
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
    </div>
</body>
</html>
