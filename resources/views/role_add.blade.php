@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  

<!--form action="airline_display1" method="post"-->

<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title">
              Add Role Page
              </h2>
            </div>
            
            <div class="card-body">
<form id="so_form" >
<div class="row">
<div class="form-group mb-3 col-md-6 col-sm-12">
      <label for="pwd">role name</label>
      <input type="text" class="form-control" id="" placeholder="role_name" name="role_name">
      <small id="helpId1" class="text-muted"></small>
 </div>
    <div class="form-group mb-3 col-md-6 col-sm-12">
      <label for="is_active">is active</label>
     <select class="form-control" name="is_active" id="">
     <option value=1>yes</option>
     <option value=0>no</option>
     </select>
     </div>
  
    <div class="form-group mb-3 col-sm-12">
      <label for="role_descripe">	role descripe</label>
      <textarea class="form-control" name="role_descripe" id="role_descripe"></textarea>
      <small id="helpId2" class="text-muted"></small>
</div>
   
     <div class="form-group mb-3">
      <input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">
    </div>
     </div>
     </form>  
     </div>   

     <div class="card-footer" >
   <a href="/role_display" class="btn btn-outline-danger so_form_btn">cansel</a>
   <button type="submit" onclick="send_data()" class="btn btn-outline-primary so_form_btn">send</button>
    </div>   
</div>
<script>
  var form1 = document.getElementById("so_form");
   var mass1 = document.getElementById("helpId1");
    var mass2 = document.getElementById("helpId2");

    var nameFormat = /^[A-Za-z-0-9-ا-ب-ت-ث-ج-ح-خ-د-ذ-ر-ز-س-ش-ص-ض-ط-ظ-ع-غ-ف-ق-ك-ل-م-ن-ه-و-ي-ة]+$/;
    
    form1[0].addEventListener("keyup", function confirmName() {

        if (form1[0].value.match(nameFormat)) {
            form1[0].style.borderColor = "green";
            return true;
        }
        else {
            mass1.innerHTML = "*Enter field Name ";
            form1[0].style.borderColor = "red";
            return false;
        }
    });
    
    function send_data(){
      var adds_text = $("#role_descripe").val();
      var adds_name = $("#role_name").val();
      if (adds_name != "" && adds_text != ""){
         $.ajax({
             type:'post',
             url:'/addrole',
             data:$('#so_form').serialize(),
             success:function(response){console.log(response);
              window.location.href = "/role_display1/1";
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });
    }else{
      mass1.innerHTML = "<p class=text-danger>*Enter role name </p>";
      mass2.innerHTML = "<p class=text-danger>*Enter rol description </p>";
    }
}
  </script>
  </div>
  </div>
  @endsection


