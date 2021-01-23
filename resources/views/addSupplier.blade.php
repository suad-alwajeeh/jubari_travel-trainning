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
      <small id="helpId1" class="text-muted"></small>
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_mobile">Mobile</label>
      <input type="number" class="form-control" id="mobile" required placeholder="777777777" name="supplier_mobile">
      <small id="helpId2" class="text-muted"></small>
     
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_phone">Phone</label>
      <input type="number" class="form-control"  id="phone" required placeholder="444444 " name="supplier_phone">
      <small id="helpId3" class="text-muted"></small>
     
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="supplier_address">Address</label>
      <input type="text" class="form-control" required value="{{old('supplier_address')}}" id="supplier_address" placeholder="supplier_address" name="supplier_address">
      <small id="helpId4" class="text-muted"></small>
    
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_email">Email</label>
      <input type="email" class="form-control" required value="{{old('supplier_email')}}" id="supplier_email" placeholder="supplier_email" name="supplier_email">
      <small id="helpId5" class="text-muted"></small>

    </div>
   
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_acc_no">Supplier Account No.</label>
      <input type="number" class="form-control" required value="{{old('supplier_acc_no')}}" id="supplier_acc_no" placeholder="supplier_acc_no" name="supplier_acc_no">
      <small id="helpId6" class="text-muted"></small>
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
      <label for="supplier_remark">Remark</label>
      <textarea class="form-control" name="supplier_remark" required id="supplier_remark"></textarea>
    </div>
    <!-- -->
    <div class="form-group col-md-3 mb-3">
      <img id="supplier_photo1" name="supplier_photo" style="border:1px solid #CC8B79; width:150px; height:150px" alt=""
      height="200px" width="200px"
      class="img-fluid rounded shadow-sm  d-block">
      <label for="supplier_photo" class=" p-2 mt-3 mx-3 btncolor">Select Photo</label> 
      <input type="file" class="form-control"  id="supplier_photo" required placeholder="supplier_photo" name="supplier_photo"
      onchange="onFilePicked(event)" accept="image/*" style="display: none;">
   
    </div>
    
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
<!-- jquery-validation --->
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script> 

  <script>
    var formsup = document.getElementById("supplier_display");
    var nameFormat = /^[A-Za-z-0-9-ا-ب-ت-ث-ج-ح-خ-د-ذ-ر-ز-س-ش-ص-ض-ط-ظ-ع-غ-ف-ق-ك-ل-م-ن-ه-و-ي-ة]+$/;
    var phoneNumber = "^[0-9]{9}$";
    var accountNumber = "^[0-9]{5}$";
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var mass1 = document.getElementById("helpId1");
    var mass2 = document.getElementById("helpId2");
    var mass3 = document.getElementById("helpId3");
    var mass4 = document.getElementById("helpId4");
    var mass5 = document.getElementById("helpId5");
    var mass6 = document.getElementById("helpId6");

    formsup[0].addEventListener("keyup", function confirmName() {

      if (formsup[0].value.match(nameFormat)) {
      formsup[0].style.borderColor = "green";
      return true;
           }
      else {
      mass1.innerHTML = "Enter Valid Name ";
      formsup[0].style.borderColor = "red";
       return false;
          }
        });

        formsup[1].addEventListener("keyup", function confirmName() {

          if (formsup[1].value.length == 9) {
           formsup[1].style.borderColor = "green";
           return true;
              }
              else if (formsup[1].value.match(phoneNumber)) {
                formsup[1].style.borderColor = "green";
                return true;
              } 
          else {
           mass2.innerHTML = "Enter 9 Degits";
           formsup[1].style.borderColor = "red";
            return false;
            }
          });
          formsup[2].addEventListener("keyup", function confirmName() {

          if (formsup[2].value.length == 9) {
            formsup[2].style.borderColor = "green";
              return true;
               }
               else if (formsup[2].value.match(phoneNumber)) {
                formsup[2].style.borderColor = "green";
                return true;
              } 
            else {
        mass3.innerHTML = "Enter 9 Degits";
        formsup[2].style.borderColor = "red";
          return false;
         }
          });

          formsup[3].addEventListener("keyup", function confirmName() {

          if (formsup[3].value.match(nameFormat)) {
            formsup[3].style.borderColor = "green";
              return true;
                   }
              else {
              mass4.innerHTML = "Enter Valid Address ";
            formsup[3].style.borderColor = "red";
                return false;
                  }
               });

          formsup[4].addEventListener("keyup", function confirmEmail() {

          if (formsup[4].value.match(mailformat)) {
            formsup[4].style.borderColor = "green";
            return true;
            }
          else {
          mass5.innerHTML = "Enter Valid Email ";
          formsup[4].style.borderColor = "red";
           return false;
             }
          });

          formsup[5].addEventListener("keyup", function confirmName() {

            if (formsup[5].value.match(accountNumber)) {
            formsup[5].style.borderColor = "green";
            return true;
                }
    
          else {
            mass6.innerHTML = "Enter 5 Degits";
            formsup[5].style.borderColor = "red";
            return false;
             }
          });

    $('#supplier_display').on('submit',function(e){
         e.preventDefault();
         $.ajax({
             type:'post',
             url:'/addSupplier',
             data:$('#supplier_display').serialize(),
             success:function(response){console.log(response);
              $('#so-alert-message').html('<div  class="alert so-alert-message" >Supplier Added successfully...<button type="button" data-dismiss="alert" class="close">&times;</button></div>');
             },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });

    });

    function onFilePicked(event) {

const files = event.target.files
console.log(files)
let filename = files[0].name
if (filename.lastIndexOf('.') <= 0) {
    return alert('not image')
}
let filesize = files[0].size
console.log(filesize)

let fileType = files[0].type
console.log(fileType)

if (fileType !== 'image/png') {
    if (fileType !== 'image/jpeg') {
        return alert('image type not supported')
    }
}
const fileReder = new FileReader()
let formData = new FormData()
formData.append('file', files[0])
fileReder.addEventListener('load', () => {
    let dataURI = fileReder.result
    if (dataURI) {
        document.getElementById('supplier_photo1').src = dataURI

    }
})
fileReder.readAsDataURL(files[0])
console.log(this.image)
}

    



  </script>
  
  @endsection


