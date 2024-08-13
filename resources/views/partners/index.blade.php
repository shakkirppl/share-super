@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Partners</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                    <a href="{{ route('partners.create') }}" class="newicon"><i class="mdi mdi-new-box"></i></a>
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
                          <th>Code</th>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Contact</th>
                          <th>E Mail</th>
                          <th>Nationality</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($results))
                        @foreach($results as $key=>$result)
                        <tr id="{{$result->id}}">
                            <td>{{1+$key}}  </td>
                            <td class="name">{{$result->code}}</td>
                            <td class="name">{{$result->name}}</td>
                            <td class="name">{{$result->address}}</td>
                            <td class="name">{{$result->contact_number}}</td>
                            <td class="name">{{$result->email}}</td>
                            <td class="name"> {{$result->nationality}}</td>
 
                      
                            <td><form action="{{ route('partners.destroy',$result->id) }}" method="post">
                            <a class="btn btn-minier btn-warning btn-edit" href="{{ route('partners.edit',$result->id) }}"><i class="fa fa-edit"></i> Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">delete</button>
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
