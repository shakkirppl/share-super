@extends('layouts.layout')
@section('content')
<style>
  .center-text {
    text-align: center;
}
  </style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title center-text">Month: {{ $month }}</h4>
                    @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

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
                                                <td>{{ $pay->amount }}</td>
                                                <td>{{ $pay->vat_amount }}</td>
                                                <td>{{ $pay->total_amount }}</td>
                                            </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6">Sorry, No Records found!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <h4 class="card-title">Receipt Voucher</h4>
                            <div class="table-responsive">
                                <table class="table table-hover" id="value-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Expense</th>
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
                                                <td>{{ $rece->amount }}</td>
                                                <td>{{ $rece->vat_amount }}</td>
                                                <td>{{ $rece->total_amount }}</td>
                                                
                                            </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">Sorry, No Records found!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#value-table').DataTable();
    });
    $(document).ready(function () {
        $('#value-table-zero').DataTable();
    });
</script>
@endsection
