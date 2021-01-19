@extends('app_layouts.master')
@section('main_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet'
    href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
<link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'>
<link rel="stylesheet" href="./style.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title"> Add Supplier Page</h2>
            </div>
<div class="card-body">

<form id="supplier_display" method="post" action="/add_supplier"  enctype="multipart/form-data">
<div class="row">
    <div class="form-group col-md-6 mb-3">
      <label for="supplier_name">Supplier Name</label>
      <input type="text" class="form-control" value="{{old('supplier_name')}}" id="supplier_name" required placeholder="supplier_name" name="supplier_name">
      <small id="helpId4" class="text-muted"></small>
        <div class="card-body">
      @if($errors->any('supplier_name'))
      <span class="text-danger">
                 {{$errors->first('supplier_name')}}
                
      </span>
      @endif
        </div>
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_mobile">Mobile</label>
      <input type="number" class="form-control" id="mobile" required placeholder="777777777" name="supplier_mobile">
      <small id="helpId1" class="text-muted"></small>
     
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_phone">Phone</label>
      <input type="number" class="form-control"  id="phone" required placeholder="444444 " name="supplier_phone">
      <small id="helpId2" class="text-muted"></small>
     
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="supplier_address">Address</label>
      <input type="text" class="form-control" required value="{{old('supplier_address')}}" id="supplier_address" placeholder="supplier_address" name="supplier_address">
    
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_email">Email</label>
      <input type="email" class="form-control" required value="{{old('supplier_email')}}" id="supplier_email" placeholder="supplier_email" name="supplier_email">
      <small id="helpId3" class="text-muted"></small>

    </div>
   
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_acc_no">Supplier Account No.</label>
      <input type="number" class="form-control" required value="{{old('supplier_acc_no')}}" id="supplier_acc_no" placeholder="supplier_acc_no" name="supplier_acc_no">
     
    </div>
    <div class="form-group col-md-6 mb-3">
    <label for="supplier_service">Service</label>
    <select class="form-control col-2    mx-5 d-inline-block select2" required name="supplier_service[]" multiple="multiple" id="dropselect" placeholder="select service" style="width: 100%;">
    <option value="" disabled>select service</option>
                @if(count($data1))
                      @foreach($data1 as $service)

                      <option  value="{{$service->ser_id}}">{{$service->ser_name}}</option>

                      @endforeach
                  @endif
              
                  
                </select>
                </div>
                <div class="form-group col-md-3 mb-3">
      <label for="supplier_currency">Select currency</label>
     <select class="form-control   mx-5 d-inline-block select2" required multiple="multiple" name="supplier_currency[]" id="">
     <option value="" disabled>select currency</option>
                @if(count($data2))
                      @foreach($data2 as $cur)

                      <option  value="{{$cur->cur_id}}">{{$cur->cur_name}}</option>

                      @endforeach
                  @endif
              
                  
                </select>
    <!-- @if($errors->any('is_active'))
      <span class="text-danger">{{$errors->first('is_active')}}</span>
      @endif -->
    </div>
    
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_photo">Photo</label> 
      <input type="file" class="form-control"  id="supplier_photo" required placeholder="supplier_photo" name="supplier_photo">
   
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="supplier_remark">Remark</label>
      <textarea class="form-control" name="supplier_remark" required id="supplier_remark"></textarea>
    </div>
    <!-- -->
    <br>
    <div class="form-group col-md-12 mb-3">
    <label class="checkbox-inline"><input type="checkbox" name="is_active" checked value="1">   Active</label>
    </div>
               
                
    </div>
    </div>
    <div class="card-footer" >
   <a href="/displaySupplier" class="btn btn-outline-danger so_form_btn">cansel</a>
   <button type="submit" class="btn btn-outline-primary so_form_btn">send</button>
    </div> 
    
    
  </form> 
  
  
</div>
  
  </div> 
  </div>
<!-- jquery-validation -->
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script> 

  <script>
    $('#supplier_display').on('submit',function(e){
         e.preventDefault();
         $.ajax({
             type:'post',
             url:'/addSupplier',
             data:$('#supplier_display').serialize(),
             success:function(response){console.log(response);
             alert("data saved");
             },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });

    });



    



  </script>
  
  @endsection


