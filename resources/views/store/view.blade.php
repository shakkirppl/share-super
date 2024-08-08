@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Company Detail</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12 exelbuton" style="text-align:end;">
                           
                    </div>
                       
                   
                </div>
                 
                 
                  <div class="row">
                  <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                    <p class="card-description">
                  <img src="{{url('/uploads/store/'.$store->logo) }}" alt="" width="150px" height="150px">
                  </p>

                    </div>

                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                    <p class="card-description">

                  </p>
                  <lable>Current Status:</lable>
                  <?php  
                                        $stat = $store->status;
                                        if ($stat=='0'||$stat==null) { ?>

                                            <img src="{{url('/uploads/images/disable.png') }}" alt="" width="30px" height="30px">
 <a href="{{url('store-active/'.$store->id)}}" class="btn btn-success">Active</a>
                                       <?php }else{ ?>

                                        <img src="{{url('/uploads/images/enable.png') }}" alt="" width="30px" height="30px">
                                          <a href="{{url('store-deactive/'.$store->id) }}" class="btn btn-danger">Deactive</a>

                    </div>
                    <?php  }
                                        ?>
                  </div>
               
                  <a href="{{url('store-renewal/'.$store->id)}}" class="btn btn-success">
                  Partners Add/Change
                        </a>
                     
                    
                   
                     
                     
            <hr>
                       
                        <div class="table-responsive">
                 
                  <div class="table-responsive">
                    <table class="table table-hover">
                    <tbody>
 
                                        <tr>
                                        <td>Name</td>
                                        <td>{{$store->name}}</td>      
                                        </tr>
                                        <tr>
                                        <td>Address</td>
                                        <td>{{$store->address}}</td>      
                                        </tr>
                                        <tr>
                                        <td>Emirate</td>
                                        <td>{{$store->emirate}}</td>     
                                         </tr>
                                        
                                         <tr>
                                        <td>Country</td>
                                       <td>{{$store->country}}</td>
                                         </tr>
                                         <tr>
                                        <td>Contact Number</td>
                                       <td>{{ $store->contact_number }}</td>
                                         </tr>
                                         <tr>
                                        <td>Whatsapp Number	</td>
                                       <td>{{ $store->whatsapp_number }}</td>
                                         </tr>
                                         <tr>
                                        <td>Email</td>
                                       <td>{{ $store->email }}</td>
                                         </tr>
                                         

                            
                           
            
                        
                       
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
let button = document.querySelector("#myexel");

button.addEventListener("click", e => {
  let table = document.querySelector("#value-table");
  TableToExcel.convert(table);
});
</script>
@endsection
