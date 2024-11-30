@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Payment </h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                    <a href="{{ route('bank-transfer.create') }}" class="newicon"><i class="mdi mdi-new-box"></i></a>
                    </div>
                       
                   
                </div>
                    
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
                          <th>Partner</th>
                          <th>Amount</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($payment))
    @foreach($payment as $key => $pay)
    <tr>
        <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration for better readability -->
        <td class="name">{{ $pay->in_date }}</td>
        <td class="name">
            @foreach($pay->partners as $part)
                {{ $part->name }} 
            @endforeach
        </td>
        <td class="name">{{ $pay->amount }}</td>
        <td>
            <form action="{{ route('bank-transfer.destroy', $pay->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5">Sorry, No Records found!</td> <!-- Updated colspan to 5 to match the number of columns -->
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
            
@endsection
@section('script')
<script>
    $(document).ready( function () {
    $('#value-table').DataTable();
} );
</script>
@endsection
