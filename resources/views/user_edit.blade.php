@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  

<!--form action="airline_display1" method="post"-->

<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title">
              Add User Page
              </h2>
            </div>
            
            <!-- /.card-header method="post" action="/addadds"  -->
            <div class="card-body">
<form id="so_form" >
<div class="row">
@foreach($data as $item)
    <input hidden="hidden" type="text" id="user_id" class="form-control" value="{{$item->id}}"  name="id">
    </div>
    <div class=row id="">
    <div class="form-group mb-3 col-md-6 col-sm-12">
     <label for="pwd">user name</label>
     <input type="text" class="form-control" value="{{$item->name}}" id="name" name="name" >
     <small id="helpId1" class="text-muted"></small>
</div> 
     <div class="form-group mb-3 col-md-6 col-sm-12">
    <label for="adds_text">user email</label>
    <input type="email" class="form-control" value="{{$item->email}}" id="email" oninput="emailtt()"  name="email" >
    <input type="text" class="form-control" value="{{$item->email}}" hidden=hidden id="email1"  >
    <small id="helpId2" class="text-muted"></small>

    </div>
    <div class="form-group mb-3 col-md-6 col-sm-12">
    <label for="adds_text">user password</label>
    <input type="email" class="form-control" value="{{$item->pass}}" maxlength="8" id=pass1  name="password" >
    <small id="helpId3" class="text-muted"></small>
</div>
    <div class="form-group mb-3 col-md-6 col-sm-12">
     <label for="pwd"> password again</label>
     <input type="text" class="form-control" value="{{$item->pass}}"  maxlength="8" id="pass2" name="password1" >
     <small id="helpId4" class="text-muted"></small>
</div> 
   
    </div>
    <div class="form-group col-md-2 ">
    <div class=row>

    @if($item->is_active == 1)
       <label class="checkbox-inline"><input type="checkbox" name="is_active" checked value="1">active</label>
        @else
        <label class="checkbox-inline"><input type="checkbox" name="is_active"  value="0">active</label>
      @endif    
      </div>
   </div>
   @endforeach
   <div class="form-group col-md-9 mt-4">
    <label>select roles</label>
<div class=row>
    @foreach($data3 as $item1)
    <div class="col-md-3">
    <div class="checkbox">
  <label><input  type="checkbox" id="role{{$item1->id}}" onclick="send({{$item1->id}})"  name="role[]" value="{{$item1->id}}">{{$item1->name}}</label>
  </div>
  </div>
@endforeach
</div>
</div>
<input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">

</form>  
</div>

   <div class="card-footer" >
   <a href="/user_display" class="btn btn-outline-danger so_form_btn">cansel</a>
   <button type="submit" onclick="send_data()" class="btn btn-outline-primary so_form_btn">send</button>
    </div>    
    </div>

  <script>
    var form1 = document.getElementById("so_form");
    var nameFormat = /^[A-Za-z-0-9-ا-ب-ت-ث-ج-ح-خ-د-ذ-ر-ز-س-ش-ص-ض-ط-ظ-ع-غ-ف-ق-ك-ل-م-ن-ه-و-ي-ة]+$/;
      var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var mass1 = document.getElementById("helpId1");
    var mass2 = document.getElementById("helpId2");
    var mass3 = document.getElementById("helpId3");
    var mass4 = document.getElementById("helpId4");
    var regularExpression  = /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;

    form1[4].addEventListener("keyup", function confirmName() {

if (form1[4].value.match(regularExpression)) {
    form1[4].style.borderColor = "green";
    return true;
}
else {
    mass3.innerHTML = "*Enter 8 char with number capital ,small char  password ";
    form1[4].style.borderColor = "red";
    return false;
}
});
/*form1[5].addEventListener("keyup", function confirmName() {
      var ppass = document.getElementById("pass1");

if (form1[5].value == ppass) {
    form1[5].style.borderColor = "green";
    return true;
}
else {
    mass4.innerHTML = "*must be as password faild ";
    form1[5].style.borderColor = "red";
    return false;
}
});*/
    form1[2].addEventListener("keyup", function confirmName() {

if (form1[2].value.match(mailformat)) {
    form1[2].style.borderColor = "green";
    return true;
}
else {
    mass2.innerHTML = "*Enter field email ";
    form1[2].style.borderColor = "red";
        return false;
}
});
      function emailtt(){
        var email = $("#email").val();
        var email1 = $("#email1").val();
        $.ajax({
             type:'get',
             url:'/checkmail/'+email,
             data:{id:email},
             success:function(response){console.log(response[0]);
             if(response[0]==0){
             }
             if(response[0]==1 && email != email1){
              $("#email").css('border-color','red');
              var mass= document.getElementById("helpId2");
              mass.style.color="red";
              mass.innerHTML='email used by other user ENTER new please';
             }
                 },
             error:function(error){console.log(error);
             } 
         });
      }
       function send_data(){
      var email = $("#email").val();
      var name = $("#name").val();
      var pass1 = $("#pass1").val();
      var pass2 = $("#pass2").val();
      if (email != "" && name != "" && pass1 != "" && pass2 != ""){
         $.ajax({
             type:'post',
             url:'/edituser',
             data:$('#so_form').serialize(),
             success:function(response){console.log(response);
              window.location.href = "/user_display1/2";
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });
    }else{
      mass1.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass2.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass3.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass4.innerHTML = "<p class=text-danger>*This field requaired </p>";
     
    }
}
function send(r){
    var checkBox = document.getElementById("role"+r);
    var adds_text = $("#how_create_it").val();
      var adds_name = $("#user_id").val();
      if (checkBox.checked == true){
      $.ajax({
             type:'get',
             url:'/addroleuser1/'+r+'/'+adds_name+'/'+adds_text,
             data:{},
             success:function(response){
               console.log(response);
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });
  }else if (checkBox.checked == false){
    $.ajax({
             type:'get',
             url:'/addroleuser2/'+r+'/'+adds_name+'/'+adds_text,
             data:{},
             success:function(response){
               console.log(response);
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
  });
  }
  }
    </script>

  </div>
  </div>
  @endsection


