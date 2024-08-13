@extends('layouts.layout')
@section('content')
<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>
<div class="main-panel">
<div class="content-wrapper">
<div class="col-12 grid-margin createtable">
              <div class="card">
                <div class="card-body">
           
                  
                        <div class="row">
                        <div class="col-md-6">
                                 <h4 class="card-title">New Company</h4>
                        </div>
                           <div class="col-md-6 heading">
                             <a href="{{ route('store.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    
                    <div class="row">
                    <br>
                   </div>
                
                  <div class="col-xl-12 col-md-12 col-sm-12 col-12">
           
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><br />
          @endif
          
        </div>
                  <form class="form-sample"  action="{{ route('store.store') }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Code</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"  name="code" value="{{$code}}" readonly   />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Store Name" name="name" value="{{old('name')}}"   />
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Company </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="company_id" name="comapny_id">
                          @foreach($company as $company)
                      <option value="{{$company->id}}">{{$company->name}}</option>
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>
    
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Logo</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" name="image"    />
                          </div>
                        </div>
                      </div>

                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" placeholder="E-mail" name="email"  value="{{old('email')}}"  />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label ">Country</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Country" name="country"  value="{{old('country')}}"  />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">PROVINCE</label>
                          <div class="col-sm-9">
                          <select class="form-control form-control-lg" id="emirate" name="emirate">
                          @foreach($province as $province)
                      <option value="{{$province->id}}">{{$province->name}}</option>
                   @endforeach
                       </select>
                        
                          </div>
                        </div>
                      </div>


                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Contact No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Contact No" name="contact_number"  required="true"  value="{{old('contact_number')}}" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> WhatsApp No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="WhatsApp No" name="whatsapp_number" value="{{old('whatsapp_number')}}"   />
                          </div>
                        </div>
                      </div>
   
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Address</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="address" ></textarea>
                         
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Admin Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="User Name" name="username" id="username"  required="true" value="{{old('username')}}"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Password</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Password" name="password" id="password"  required="true" />
                          </div>
                        </div>
                      </div>
                      <!-- <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> No of Partners</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="No of Partners" name="no_of_partners"  required="true"  value="{{old('no_of_partners')}}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Total Capita</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="Share Value" name="share_value"  required="true"  value="{{old('share_value')}}" />
                          </div>
                        </div>
                      </div> -->
                      
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Description</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="description" ></textarea>
                         
                          </div>
                        </div>
                      </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Status </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="status" name="status">
                      <option value="1">Active</option>
                     <option value="0">Deactive</option>
                       </select>
                          </div>
                        </div>
                      </div>
                           

             
          
     

                      </div>

                
                <div class="submitbutton">
                    <button type="submit" class="btn btn-primary mb-2 submit">Submit<i class="fas fa-save"></i>


</button>
                    </div>
                    
                    
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
            </div>
               
@endsection
@section('script')
<script>
    $(document).ready( function () {
    $('#username').val('');
    $('#password').val('');
} );
</script>
@endsection