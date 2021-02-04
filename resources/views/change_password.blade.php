@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  

<!--form action="airline_display1" method="post"-->

<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title">
              Change Password  Page
              </h2>
            </div>
            
            <!-- /.card-header method="post" action="/addadds"  -->
            <div class="card-body">
<form id="so_form" action="/new_pass" method="post">
<div class="row">
@foreach($data1 as $dat)
<input hidden="hidden" type="text" id="user_id" class="form-control" value="{{$dat->id}}"  name="id">
<input hidden="hidden" type="text" id="user_pass" class="form-control" value="{{$dat->pass}}"  name="password_old">
  @endforeach</div>
    
  <div class="form-group mb-3 col-md-6 col-sm-12">
    <label for="adds_text">old password</label>
    <input type="text" class="form-control" value="" maxlength="8" id=password  name="passwordo" >
    <small id="helpId1" class="text-muted"></small>
</div>  
    
    <div class="form-group mb-3 col-md-6 col-sm-12">
    <label for="adds_text">new password</label>
    <input type="text" class="form-control" value="" maxlength="8" id=pass1  name="password" >
    <small id="helpId2" class="text-muted"></small>
</div>
    <div class="form-group mb-3 col-md-6 col-sm-12">
     <label for="pwd">new password again</label>
     <input type="text" class="form-control" value=""  maxlength="8" id="pass2" name="password1" >
     <small id="helpId3" class="text-muted"></small>
</div> 
  
</div>

   <div class="card-footer" >
   <button type="submit"  class="btn btn-outline-primary so_form_btn">send</button>
    </div>
    </form>  
    
    </div>
    </div>

  <script>
    var form1 = document.getElementById("so_form");
      var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var paas = document.getElementById("user_pass");
      var mass1 = document.getElementById("helpId1");
    var mass2 = document.getElementById("helpId2");
    var mass3 = document.getElementById("helpId3");
    var regularExpression  = /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;

    form1[2].addEventListener("keyup", function confirmName() {

if (form1[2].value() == paas) {
    form1[2].style.borderColor = "green";
    return true;
}
else {
  $('#so_form_btn').addClass('disabled');
    mass1.innerHTML = "*Enter your old password ";
    form1[2].style.borderColor = "red";
    return false;
}
});


    </script>

  </div>
  </div>
  @endsection


