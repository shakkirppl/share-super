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
                                 <h4 class="card-title">New Transfer</h4>
                        </div>
                           <div class="col-md-6 heading">
                             <a href="{{ route('bank-transfer.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
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
                  <form class="form-sample"  action="{{ route('bank-transfer.store') }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Type </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="type" name="type">
                      <option value="BANK">BANK</option>
                     <option value="CASH">CASH</option>
                       </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Date</label>
                          <div class="col-sm-9">
                          <input type="date" class="form-control" name="in_date" required="true" value="" readonly id="dateField"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Month </label>
                          <div class="col-sm-9">
                          <select class="form-control" name="month" id="month">
                    <option value=''>Select Month</option>
                    @foreach($months as $key => $month)
                 <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                    </select>
                          </div>
                        </div>
                      </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Partner </label>
                          <div class="col-sm-9">
                          <select class="form-control form-control-lg" id="partner_id" name="partner_id">
                          @foreach($expense as $expens)
                      <option value="{{$expens->id}}">{{$expens->name}}</option>
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>
                           
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Reference</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"  name="reference"  required="true" value="{{old('reference')}}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Attach Document</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control"  name="document" readonly/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Description </label>
                          <div class="col-sm-9">
                          <textarea class="form-control" name="w3review" rows="4" cols="50"> </textarea>
                          </div>
                        </div>
                      </div>
             
          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Amount</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="amount" id="amount" name="amount" required="true" step="any"  value="{{old('amount')}}"  />
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
    // Get today's date in the format YYYY-MM-DD
    const today = new Date().toISOString().split('T')[0];
    // Set the value of the input field
    document.getElementById('dateField').value = today;
</script>
@endsection