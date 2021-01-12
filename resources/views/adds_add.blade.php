@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  

<!--form action="airline_display1" method="post"-->

<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title">
              Add Advertisement Page
              </h2>
            </div>
            
            <!-- /.card-header method="post" action="/addadds"  -->
            <div class="card-body">
<form id="so_form" >
<div class="row">
    <div class="form-group col-md-6 mb-3">
      <label for="pwd">Advertisements Title</label>
      <input type="text" class="form-control" id="adds_name" placeholder="adds_name" name="adds_name">
      <small id="helpId1" class="text-muted"></small>
    </div>
    <div class="form-group col-md-6 col-sm-12 mb-3">
      <label for="adds_type">Advertisements Type</label>
     <select class="form-control" name="adds_type" id="">
     <option value=1>for all</option>
     <option value=2>special users</option>
     </select>
    </div>
    <div class="form-group col-md-6 mb-3" style="display:none">
      <input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">
    </div>
    <div class="form-group col-md-12 ">
      <label for="adds_text">Advertisements Content</label>
      <textarea class="form-control" name="adds_text" id="adds_text"></textarea>
      <small id="helpId2" class="text-muted"></small>
    </div>
    <div class="form-group col-md-2 mt-4">
       <label class="checkbox-inline"><input type="checkbox" name="is_active" checked value="1">active</label>
    </div>
   </div>
   </div>
   </form>  

   <div class="card-footer" >
   <a href="/adds_display" class="btn btn-outline-danger so_form_btn">cansel</a>
   <button type="submit" onclick="send_data()" class="btn btn-outline-primary so_form_btn">send</button>
    </div>   
</div>
</div>
  <script>
  var form1 = document.getElementById("so_form");
    var sub = document.getElementById("sub");


    var mass1 = document.getElementById("helpId1");
    var mass2 = document.getElementById("helpId2");

    var nameFormat = /^[A-Za-z-0-9-ا-ب-ت-ث-ج-ح-خ-د-ذ-ر-ز-س-ش-ص-ض-ط-ظ-ع-غ-ف-ق-ك-ل-م-ن-ه-و-ي-ة]+$/;
    var phoneNumber = "^[0-9]{9}$";
    var ssnNumber = "^\d{0-9}$";
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    form1[0].addEventListener("keyup", function confirmName() {

        if (form1[0].value.match(nameFormat)) {
            form1[0].style.borderColor = "green";
            return true;
        }
        else {
            mass2.innerHTML = "*Enter field Name ";
            form1[0].style.borderColor = "red";
            return false;
        }
    });
    form1[1].addEventListener("keyup", function confirmName() {

        if (form1[1].value.match(nameFormat)) {
            form1[1].style.borderColor = "green";
            return true;
        }
        else {
            mass2.innerHTML = "*Enter field Name ";
            form1[1].style.borderColor = "red";
            return false;
        }
    });
    function send_data(){
      var adds_text = $("#adds_text").val();
      var adds_name = $("#adds_name").val();
      if (adds_name != "" && adds_text != ""){
         $.ajax({
             type:'post',
             url:'/addadds',
             data:$('#so_form').serialize(),
             success:function(response){console.log(response);
              window.location.href = "/adds_display1/1";
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });
    }else{
      mass1.innerHTML = "<p class=text-danger>*Enter title of adds </p>";
      mass2.innerHTML = "<p class=text-danger>*Enter content of adds </p>";
    }
}
  </script>

  </div>
  </div>
  @endsection


