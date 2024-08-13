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
                                 <h4 class="card-title">New Partner</h4>
                        </div>
                           <div class="col-md-6 heading">
                             <a href="{{ route('partners.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
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
                  <form class="form-sample"  action="{{ route('partners.store') }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">  Partners Code</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder=" Code" name="code" value="{{$invoice_no}}"  required="true" readonly />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Partners Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder=" Name" name="name"  required="true" value="{{old('name')}}"  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Email</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="E-mail" name="email" value="{{old('email')}}"    />
                          </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Contact No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Contact No" name="contact_number"  required="true" value="{{old('contact_number')}}"  />
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
                          <label class="col-sm-2 col-form-label"> Image</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" name="image"    />
                            
                          </div>
                        </div>
                      </div> 
     
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Nationality </label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Nationality" name="nationality"  required="true" value="{{old('nationality')}}"  />
                          </div>
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
<script src="{{url('front-end/assets/js/jquery-3.3.1.js')}}"></script>
<script type="text/javascript">
         $('#payment_terms').change(function(){
         if($(this).val() == 'CREDIT'){
           
             document.getElementById("credit").style.display = "block";
       
        }
        else{
          document.getElementById("credit").style.display = "none";
          // $('#credit').style.display="none";
       
        }


    });
  </script>
@endsection