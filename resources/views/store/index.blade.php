@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Company</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                    <a href="{{ route('store.create') }}" class="newicon"><i class="mdi mdi-new-box"></i></a>
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
                          <th>Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($store))
                        @foreach($store as $key=>$store)
                        <tr id="{{$store->id}}">
                            <td>{{1+$key}}  <a class="btn btnsmall btn-outline-secondary btn-icon-text" href="{{ route('store.view',$store->id) }}"> View</a></td>
                            <td class="name">{{$store->name}}</td>
                            <td>
                            @if($store->status==0) <label class="btn btn-danger">Deative</label>@else<lable class="btn btn-success">Active</label> @endif</td>
                            <td><form action="{{ route('store.destroy',$store->id) }}" method="post">
                            <a class="btn btn-success" href="{{ route('store.partners',$store->id) }}">Partners</a>
                            <a class="btn btn-minier btn-warning btn-edit" href="{{ route('store.edit',$store->id) }}"><i class="fa fa-edit"></i> Edit</a>
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
