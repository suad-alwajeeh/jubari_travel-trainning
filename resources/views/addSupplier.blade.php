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
  
<h2>Add Supplier Page</h2>

<form id="supplier_display" method="post" action="/add_supplier"  enctype="multipart/form-data">
    <div class="form-group">
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
    <div class="form-group mb-3">
      <label for="supplier_mobile">Mobile</label>
      <input type="number" class="form-control" id="mobile" placeholder="777777777" name="supplier_mobile">
      <small id="helpId1" class="text-muted"></small>
     
    </div>
    <div class="form-group mb-3">
      <label for="supplier_phone">Phone</label>
      <input type="number" class="form-control"  id="phone" placeholder="444444 " name="supplier_phone">
      <small id="helpId2" class="text-muted"></small>
     
    </div>
    <div class="form-group mb-3">
      <label for="supplier_email">Email</label>
      <input type="email" class="form-control" value="{{old('supplier_email')}}" id="supplier_email" placeholder="supplier_email" name="supplier_email">
      <small id="helpId3" class="text-muted"></small>

    </div>
    <div class="form-group mb-3">
      <label for="supplier_photo">Photo</label> 
      <input type="file" class="form-control"  id="supplier_photo" placeholder="supplier_photo" name="supplier_photo">
   
    </div>
    <div class="form-group mb-3">
      <label for="supplier_address">Address</label>
      <input type="text" class="form-control" value="{{old('supplier_address')}}" id="supplier_address" placeholder="supplier_address" name="supplier_address">
    
    </div>
    <div class="form-group mb-3">
      <label for="supplier_acc_no">Supplier Account No.</label>
      <input type="number" class="form-control" value="{{old('supplier_acc_no')}}" id="supplier_acc_no" placeholder="supplier_acc_no" name="supplier_acc_no">
     
    </div>
    <!-- -->
    <div class="form-group mb-3">
    <label for="supplier_service">Service</label>
    <select class="form-control col-2   mx-5 d-inline-block select2" name="supplier_service[]" multiple="multiple" id="dropselect" placeholder="select service" style="width: 100%;">
    <option value="">select service</option>
                @if(count($data1))
                      @foreach($data1 as $service)

                      <option  value="{{$service->ser_id}}">{{$service->ser_name}}</option>

                      @endforeach
                  @endif
              
                  
                </select>
                </div>
               
                
    <div class="form-group mb-3">
      <label for="supplier_remark">Remark</label>
      <textarea class="form-control" name="supplier_remark" id="supplier_remark"></textarea>
    </div>
    <div class="form-group mb-3">
      <label for="supplier_currency">Select currency</label>
     <select class="form-control col-2   mx-5 d-inline-block select2" multiple="multiple" name="supplier_currency[]" id="">
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
    <div class="form-group mb-3">
      <label for="is_active">is_active</label>
     <select class="form-control col-2 mx-5 d-inline-block select2" name="is_active" id="">
     <option value=1>1</option>
     <option value=0>2</option>
     
     </select>
     @if($errors->any('is_active'))
      <span class="text-danger">{{$errors->first('is_active')}}</span>
      @endif
    </div>
   
    <button type="submit" class="btn btn-primary">send</button>
   
  </form> 
  
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



    
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Supplier successful added!" );
    }
  });
  $('#supplier_display').validate({
    rules: {
      supplier_name: {
        required:true,
        minlength: 25
      },
      supplier_mobile: {
        required: true,
        number: true,
        maxlength: 11
      },
      supplier_phone: {
        required: true,
        number: true,
        maxlength: 11
      },
      supplier_email: {
        required: true,
        email: true,
      },
      supplier_photo: {
        required: true,
        accept: "jpg|jpeg|png|ico|bmp"
      },
      supplier_address: {
        required: true
      },
      supplier_acc_no: {
        required: true,
        number: true
      },
      "supplier_service[]": {
        required: true
       
      },
      supplier_remark: {
        required: true
      },
      "supplier_currency[]": {
        required: true
      },
      is_active: {
        required: true
      },
    },
    messages: {
      
      supplier_name: {
        required: "Please enter supplier name",
        minlength: "Spplier name must be at least 25 characters long"
    },
    supplier_mobile: {
        required: "Please enter supplier mobile",
        number: "Mobile must be numbers",
        maxlength: "Spplier Mobile must be 11 characters long"
      },
      supplier_phone: {
        required: "Please enter supplier Phone",
        number: "Phone must be numbers",
        maxlength: "Spplier Phone must be 11 characters long"
      },
      supplier_email: {
        required: "Please enter a supplier email address",
        email: "Please enter a vaild supplier email address"
      },
      supplier_photo: {
        required: "Please enter a supplier photo",
        accept: "accepted formats are: jpg , jpeg , png , ico , bmp"
      }
      supplier_address: {
        required: "Please enter a supplier address"
      }
      supplier_acc_no: {
        required: "Please enter supplier account number",
        number: "Account number must be numbers"
      }
      "supplier_service[]": {
        required: "Please add service"
        
      },
      supplier_remark: "Please enter remark"
    },
    "supplier_currency[]":{
      required: "Please add currency"
    },
    is_active: {
        required: "Please make supplier active or  not"
      },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});


/*

    var sub = document.getElementById("sub");
    var phone = document.getElementById("phone");
    var mobile = document.getElementById("mobile");
    var email = document.getElementById("email");
var mass1 = document.getElementById("helpId1");
var mass2 = document.getElementById("helpId2");
var mass3 = document.getElementById("helpId3");
var mass4 = document.getElementById("helpId4");

var nameFormat = /^[A-Za-z ]+$/;
var phoneNumber = "^[0-9]{6}$";
var mobileNumber = "^[0-9]{9}$";
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;


sub.addEventListener("keyup", function confirmName() {

if (sub.value.match(nameFormat)) {
  sub.style.borderColor = "green";
    return true;
}
else {
    mass4.innerHTML = "*Enter field Name ";
    sub.style.borderColor = "red";
    return false;
}
});



phone.addEventListener("keyup", function confirmName() {

    if (phone.value.match(phoneNumber)) {
      phone.style.borderColor = "green";
        return true;
    }
    else {
        mass2.innerHTML = "*Enter field Name ";
        phone.style.borderColor = "red";
        return false;
    }
});
mobile.addEventListener("keyup", function confirmName() {

if (mobile.value.match(mobileNumber)) {
  mobile.style.borderColor = "green";
    return true;
}
else {
    mass1.innerHTML = "*Enter field Number Mobile  ";
    mobile.style.borderColor = "red";
    return false;
}
});*/

  </script>
  
  @endsection


