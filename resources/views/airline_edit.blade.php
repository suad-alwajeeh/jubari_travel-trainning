@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  

<!--form action="airline_display1" method="post"-->

<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title">
              Add Airline Page
              </h2>
            </div>
            
            <!-- /.card-header method="post" action="/addadds"  -->
            <div class="card-body">
<form id="so_form" >
<div class="row">
  @foreach($data as $item)
<div class="form-group col-md-4 col-sm-12">
      <label for="email">code</label>
      <input type="text" class="form-control" value="{{$item->airline_code}}" id="airline_code" maxlength="3" placeholder=" 123" name="airline_code">
      <small id="helpId1" class="text-muted">*must be 3 numbers</small>
 </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="pwd">airline</label>
      <input type="text" class="form-control" value="{{$item->airline_name}}" placeholder="airline_name" name="airline">
      <small id="helpId2" class="text-muted"></small>
 </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="pwd">country</label>
      <input type="text" class="form-control" id="country" value="{{$item->country}}" placeholder="country " name="country">
      <small id="helpId3" class="text-muted"></small>
 </div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="pwd">Carrier Code</label>
      <input type="text" class="form-control" maxlength="2" value="{{$item->carrier_code}}" id="carrier_code" placeholder=" carrier_code" name="carrier_code">
      <small id="helpId4" class="text-muted"></small>
</div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="pwd">Code</label>
      <input type="text" class="form-control" id="code" value="{{$item->code}}" maxlength="3" placeholder="code " name="code">
      <small id="helpId5" class="text-muted"></small>
</div>
    <div class="form-group col-md-4 col-sm-12">
      <label for="pwd">IATA</label>
      <input type="text" class="form-control" id="itat" value="{{$item->IATA}}" placeholder="IATA" name="IATA">
      <small id="helpId6" class="text-muted"></small>
 </div>
    <div class="form-group col-md-12">
      <label for="pwd">	Remark</label>
      <textarea class="form-control" require name="remark" id="remark">{{$item->remark}}</textarea>
      <small id="helpId7" class="text-muted"></small>
 </div>
    <div class="form-group col-md-2 mt-4">
    @if($item->is_active == 1)
       <label class="checkbox-inline"><input type="checkbox" name="is_active" checked value="1">active</label>
        @else
        <label class="checkbox-inline"><input type="checkbox" name="is_active"  value="0">active</label>
      @endif    </div>
   </div>
   </div>
   <input type="text" hidden=hidden class="form-control"  value="{{$item->id}}" id="id" placeholder=" id" name="id">

@endforeach
   </form>  
   <div class="card-footer" >
   <a href="/airline_display" class="btn btn-outline-danger so_form_btn">cansel</a>
   <button type="submit" onclick="send_data()" class="btn btn-outline-primary so_form_btn">send</button>
    </div>   
</div>
</div>   
  <script>
  var form1 = document.getElementById("so_form");

    var mass1 = document.getElementById("helpId1");
    var mass2 = document.getElementById("helpId2");
    var mass3 = document.getElementById("helpId3");
    var mass4 = document.getElementById("helpId4");
    var mass5 = document.getElementById("helpId5");
    var mass6 = document.getElementById("helpId6");
    var mass7 = document.getElementById("helpId7");

    var nameFormat = /^[A-Za-z-0-9-ا-ب-ت-ث-ج-ح-خ-د-ذ-ر-ز-س-ش-ص-ض-ط-ظ-ع-غ-ف-ق-ك-ل-م-ن-ه-و-ي-ة]+$/;
    var airline = "^[0-9]{3}$";
    var _ccode = /^[A-Za-z]+$/;
    var phoneNumber = "^[0-9]{9}$";
    var ssnNumber = "^\d{0-9}$";
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    form1[0].addEventListener("keyup", function confirmName() {

        if (form1[0].value.match(airline)) {
            form1[0].style.borderColor = "green";
            return true;
        }
        else {
            mass2.innerHTML = "*Enter field is require ";
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
   
form1[3].addEventListener("keyup", function confirmName() {

if (form1[3].value.match(_ccode)) {
    form1[3].style.borderColor = "green";
    return true;
}
else {
    mass4.innerHTML = "*Enter field Carrier Code ";
    form1[3].style.borderColor = "red";
    return false;
}
});
form1[4].addEventListener("keyup", function confirmName() {

if (form1[4].value.match(_ccode)) {
    form1[4].style.borderColor = "green";
    return true;
}
else {
    mass5.innerHTML = "*Enter field Carrier Code ";
    form1[4].style.borderColor = "red";
        return false;
}
});


    function send_data(){
      var airline_code = $("#airline_code").val();
      var airline_name = $("#airline_name").val();
      var code = $("#code").val();
      var country = $("#country").val();
      var carrier_code = $("#carrier_code").val();
      var itat = $("#itat").val();
      var remark = $("#remark").val();
      if (itat != "" && remark != "" && airline_name != "" && carrier_code != "" && code != "" && carrier_code != ""){
         $.ajax({
             type:'post',
             url:'/editairline',
             data:$('#so_form').serialize(),
             success:function(response){console.log(response);
              window.location.href = "/airline_display1/2";
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });
    }else{
      mass1.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass2.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass3.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass5.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass4.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass6.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass7.innerHTML = "<p class=text-danger>*This field requaired </p>";

    }
}
  </script>
  </div>
  </div>
  @endsection


