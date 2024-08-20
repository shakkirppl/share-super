@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Payment Voucher Report</h4>
                    </div>
                   
                       
                   
                </div>
                <form class="form-sample"  action="{{url('payment-voucher-report')}}" method="get" >
                          {{csrf_field()}}
                    <div class="row">
                     
                     

                      <div class="col-md-4 col-sm-6 col-xs-12 mt-2">
                        <input type="date" name="from_date" class="form-control">
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mt-2">
                        <input type="date" name="to_date" class="form-control">
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12 mt-2">
                    <div class="submitbutton">
                    <button type="submit" class="btn btn-primary mb-2 submit">Get


</button>
</div>

                    </div></div>
</form>       
@if($message = Session::get('success'))
<div class="alert alert-sucess">
  <p>{{$message}}</p>
</div>
@endif
 
                 
                  <p class="card-description">
                
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover" id="value-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Date</th>
                          <th>Customer</th>
                          <th>Amount</th>
                          <th>Vat</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($results))
                        @foreach($results as $key=>$data)
                        <tr id="">
                            <td>{{$data->invoice_no}}</td>
                            <td class="name">{{$data->in_date}}</td>
                            <td class="name">@foreach($data->expense as $exp){{$exp->name}}@endforeach</td>
                            <td class="name">{{$data->amount}}</td>
                            <td class="name">{{$data->vat_amount}}</td>
                            <td class="name">{{$data->total_amount}}</td>
                          
                              </form>
                            </td>
                      </tr>
                        @endforeach
                        @else
                        <tr><td colspan="2">Sorry, No Records found!</td></tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
            
@endsection
@section('script')
<script>
    $(document).ready( function () {
    $('#value-table').DataTable();
} );
</script>
@endsection
