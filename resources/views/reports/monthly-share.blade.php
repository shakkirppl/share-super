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
                <form class="form-sample"  action="{{url('monthly-share-report-store-wise')}}" method="get" >
                          {{csrf_field()}}
                    <div class="row">
                     
                     

                      <div class="col-md-4 col-sm-6 col-xs-12 mt-2">
                      <select class="form-control" name="month" id="month">
                    <option value=''>Select Month</option>
                    @foreach($months as $key => $month)
                 <option value="{{ $month }}">{{ $month }}</option>
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
 
                 <p>Selected Month:{{$selectmonth}}</p>
                  <p class="card-description">
                
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover" id="value-table" >
                      <thead>
                        <tr>
                          <th>Store</th>
                          <th>Income</th>
                          <th>Expense</th>
                          <th>Profit</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($stores))
                                    @foreach($stores as $store)
                                        <tr>
                                            <td>{{ $store['name'] }}</td>
                                            <td>{{ number_format($store['income'], 2) }}</td>
                                            <td>{{ number_format($store['expense'], 2) }}</td>
                                            <td>{{ number_format($store['profit'], 2) }}</td>
                                            <td>
                                              <form class="form-sample" action="{{ url('monthly-share-report-store-wise-generate-pdf') }}" method="get">
    {{ csrf_field() }}
    
    <input type="hidden" class="form-control" name="select_month" id="select_month" value="{{ $selectmonth }}" required />
    
    <input type="hidden" class="form-control" name="store_id" id="store_id" value="{{ $store['store_id'] }}" required />
    
    <div class="col-md-2 col-sm-6 col-xs-12 mt-2">
        <div class="submitbutton">
            <button type="submit" class="btn btn-primary mb-2 submit">Generate PDF</button>
        </div>
    </div>
</form>
                                            </td>
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
function validateForm() {
        var month = document.getElementById('month').value;
        if (month === '') {
            alert('Select the Month');
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

</script>
@endsection
