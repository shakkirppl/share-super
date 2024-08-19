@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Monthly Share Report</h4>
                    </div>
                   
                       
                   
                </div>
                <form class="form-sample"  action="{{url('monthly-share-report-partner-wise')}}" method="get" >
                          {{csrf_field()}}
                    <div class="row">
                     
                     

                      <div class="col-md-4 col-sm-6 col-xs-12 mt-2">
                      <select class="form-control" name="month" id="month">
                    <option  value=''>Select Month</option>
                    @foreach($months as $key => $month)
                 <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                    </select>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12 mt-2">
                      <select class="form-control" name="partner_id" id="partner_id">
                    <option value=''>Select Partner</option>
                    @foreach($partners as $key => $partner)
                 <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                    @endforeach
                    </select>
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
<form class="form-sample"  action="{{url('monthly-share-report-partner-wise-generate-pdf')}}" method="get" >
{{csrf_field()}}
<p>Selected Month:{{$selectmonth}}</p>
<input type="text" class="form-control"  name="select_month" id="select_month" value="{{$selectmonth}}"  required="true" />
<div class="col-md-2 col-sm-6 col-xs-12 mt-2">
                    <div class="submitbutton">
                    <button type="submit" class="btn btn-primary mb-2 submit">Generate PDF


</button>
</div>
</div>
</form>    

                  <p class="card-description">
                
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover" id="value-table" >
                      <thead>
                        <tr>
                          <th>Store</th>
                          <th>Partner Name</th>
                          <th>Percentage</th>
                          <th>Profit</th>
               
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($partnerDetail))
                                    @foreach($partnerDetail as $partner)
                                        <tr>
                                            <td>{{ $partner['name'] }}</td>
                                            <td>{{ $partner['partnername'] }}</td>
                                            <td>{{ number_format($partner['percentage'], 2) }}</td>
                                            <td>{{ number_format($partner['profit'], 2) }}</td>
                                           
                                           
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="5">Sorry, No Records found!</td></tr>
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
