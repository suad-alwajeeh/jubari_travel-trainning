@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  

<!--form action="airline_display1" method="post"-->

<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title">
              Add Customer Page
              </h2>
            </div>
            
            <!-- /.card-header method="post" action="/addadds"  -->
            <div class="card-body">
<form id="so_form" >
<div class="row">
  
    <div class="form-group col-md-4 col-sm-12">
      <label for="pwd">	name:</label>
      <input type="text" value="" required  class="form-control" id="cus_name"  name="cus_name">
      <small id="helpId1" class="text-muted"></small>

    </div>
   
 <div class="form-group col-md-4 col-sm-12">
      <label for="pwd">	contact_person:</label>
      <input type="text" value="" required  class="form-control" id="contact_person"  name="contact_person">
      <small id="helpId2" class="text-muted"></small>
</div>
<div class="form-group col-md-4 col-sm-12">
      <label for="pwd">contact_title:</label>
      <input type="text" value="" required class="form-control" id="contact_title" name="contact_title">
      <small id="helpId3" class="text-muted"></small>
 </div>
 <div class="form-group col-md-2 col-sm-12">
      <label for="pwd">account_number:</label>
      <input type="number" value="" required class="form-control" id="cus_account" name="cus_account">
      <small id="helpId4" class="text-muted"></small>
 </div>
 <div class="form-group col-md-2 col-sm-12">
      <label for="pwd">telephon_1:</label>
      <input type="number" value=""  class="form-control" id="telephon1"  name="telephon1">
      <small id="helpId5" class="text-muted"></small>
</div>
<div class="form-group col-md-2 col-sm-12">
      <label for="pwd">telephon_2</label>
      <input type="text" value="" required class="form-control" id="telephon2"  name="telephon2">
      <small id="helpId6" class="text-muted"></small>
</div>
<div class="form-group col-md-2 col-sm-12">
      <label for="pwd">fax_1</label>
      <input type="text" value="" required class="form-control" id="fax1" name="fax1">
      <small id="helpId7" class="text-muted"></small>
</div>
<div class="form-group col-md-2 col-sm-12">
      <label for="pwd">fax_2</label>
      <input type="text" value="" required class="form-control" id="fax2" name="fax2">
      <small id="helpId8" class="text-muted"></small>
 </div>
 <div class="form-group col-md-2 col-sm-12">
      <label for="pwd">	whatsapp</label>
      <input type="text" value="" required class="form-control" id="whatsapp"  name="whatsapp">
      <small id="helpId9" class="text-muted">00967-777777777</small>
</div>
<div class="form-group col-md-3 col-sm-12">
      <label for="pwd">email</label>
      <input type="text" value="" required  class="form-control" id="cus_email"  name="cus_email">
      <small id="helpId10" class="text-muted"></small>
</div>
<div class="form-group col-md-3 col-sm-12">
      <label for="pwd">	address</label>
      <input type="text" value="" required  class="form-control" id="address" name="address">
      <small id="helpId11" class="text-muted"></small>
</div>
<div class="form-group col-md-3 col-sm-12">
      <label for="pwd">city</label>
      <input type="text" value="" required  class="form-control" id="city"  name="city">
      <small id="helpId12" class="text-muted"></small>
</div>
<div class="form-group col-md-3 col-sm-12">
      <label for="pwd">country</label>
      <input type="text" required value=""  class="form-control" id="country" name="country">
      <small id="helpId13" class="text-muted"></small>
</div>
    

<div class="form-group col-md-3 col-sm-12">
      <label for="is_active">def_currency</label>
     <select required name="def_currency" class="form-control" id="def_currency">
     @foreach($data1 as $item1)
     <option value="{{$item1->cur_id}}">{{$item1->cur_name}}</option>
     @endforeach
     </select>
    </div>
    <div class="form-group col-md-2 col-sm-12 pt-4">
<label class="checkbox"><input type="checkbox" name="is_active" checked value="1">active</label>
</div>
    <div class="form-group col-md-2 col-sm-12 pt-4">
      <label class="checkbox "><input type="checkbox" name="vip" checked value="1">vip</label>
    </div>
   </div>
   <input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">

   </form> 
</div>
<div class="card-footer" >
   <a href="/customer_display" class="btn btn-outline-danger so_form_btn">cansel</a>
   <button type="submit" onclick="send_data()" class="btn btn-outline-primary so_form_btn">send</button>
    </div>  
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
    var mass8 = document.getElementById("helpId8");
    var mass9= document.getElementById("helpId9");
    var mass10= document.getElementById("helpId10");
    var mass11= document.getElementById("helpId11");
    var mass12= document.getElementById("helpId12");
    var mass13 = document.getElementById("helpId13");

    var nameFormat = /^[A-Za-z-0-9-ا-ب-ت-ث-ج-ح-خ-د-ذ-ر-ز-س-ش-ص-ض-ط-ظ-ع-غ-ف-ق-ك-ل-م-ن-ه-و-ي-ة]+$/;
    var fax = "^[0-9]{10}$";
    var phoneNumber = "^[0-9]{8}$";
    var whatsapp = "^[0-9]{14}$";
    var account = "^[0-9]";
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    form1[3].addEventListener("keyup", function confirmName() {

        if (form1[3].value.match(account)) {
            form1[3].style.borderColor = "green";
            return true;
        }
        else {
            mass4.innerHTML = "*field is require ";
            form1[3].style.borderColor = "red";
            return false;
        }
    });
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
form1[10].addEventListener("keyup", function confirmName() {

if (form1[10].value.match(nameFormat)) {
    form1[10].style.borderColor = "green";
    return true;
}
else {
    mass11.innerHTML = "*Enter string field  ";
    form1[10].style.borderColor = "red";
    return false;
}
});
form1[11].addEventListener("keyup", function confirmName() {

if (form1[11].value.match(nameFormat)) {
    form1[11].style.borderColor = "green";
    return true;
}
else {
    mass12.innerHTML = "*Enter string field  ";
    form1[11].style.borderColor = "red";
    return false;
}
});
form1[12].addEventListener("keyup", function confirmName() {

if (form1[12].value.match(nameFormat)) {
    form1[12].style.borderColor = "green";
    return true;
}
else {
    mass13.innerHTML = "*Enter string field  ";
    form1[12].style.borderColor = "red";
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
   
form1[2].addEventListener("keyup", function confirmName() {

if (form1[2].value.match(nameFormat)) {
    form1[2].style.borderColor = "green";
    return true;
}
else {
    mass3.innerHTML = "*Enter field  title ";
    form1[2].style.borderColor = "red";
    return false;
}
});
form1[4].addEventListener("keyup", function confirmName() {

if (form1[4].value.match(phoneNumber)) {
    form1[4].style.borderColor = "green";
    return true;
}
else {
    mass5.innerHTML = "*Enter field telepone ";
    form1[4].style.borderColor = "red";
        return false;
}
});
form1[5].addEventListener("keyup", function confirmName() {

if (form1[5].value.match(phoneNumber)) {
    form1[5].style.borderColor = "green";
    return true;
}
else {
    mass6.innerHTML = "*Enter field telepone  ";
    form1[5].style.borderColor = "red";
        return false;
}
});
form1[6].addEventListener("keyup", function confirmName() {

if (form1[6].value.match(phoneNumber)) {
    form1[6].style.borderColor = "green";
    return true;
}
else {
    mass7.innerHTML = "*Enter field fax1 ";
    form1[6].style.borderColor = "red";
        return false;
}
});
form1[7].addEventListener("keyup", function confirmName() {

if (form1[7].value.match(phoneNumber)) {
    form1[7].style.borderColor = "green";
    return true;
}
else {
    mass8.innerHTML = "*Enter field fax2 ";
    form1[7].style.borderColor = "red";
        return false;
}
});
form1[8].addEventListener("keyup", function confirmName() {

if (form1[8].value.match(whatsapp)) {
    form1[8].style.borderColor = "green";
    return true;
}
else {
    mass9.innerHTML = "*Enter field whatsapp ";
    form1[8].style.borderColor = "red";
        return false;
}
});
form1[9].addEventListener("keyup", function confirmName() {

if (form1[9].value.match(mailformat)) {
    form1[9].style.borderColor = "green";
    return true;
}
else {
    mass10.innerHTML = "*Enter field email ";
    form1[9].style.borderColor = "red";
        return false;
}
});


    function send_data(){
      var cus_name = $("#cus_name").val();
      var fax1 = $("#fax1").val();
      var fax2 = $("#fax2").val();
      var telephon1 = $("#telephon1").val();
      var telephon2 = $("#telephon2").val();
      var contact_title = $("#contact_title").val();
      var contact_person = $("#contact_person").val();
      var cus_account = $("#cus_account").val();
      var cus_email = $("#cus_email").val();
      var whatsapp = $("#whatsapp").val();
      var country = $("#country").val();
      var address = $("#address").val();
      var city = $("#city").val();
      if (cus_name != "" && cus_account != "" && address != "" && country != "" && cus_email != "" && whatsapp != "" && city != "" && contact_person != "" && contact_title != "" && telephon1 != "" && telephon2 != "" && fax1 != "" && fax2 != ""){
         $.ajax({
             type:'post',
             url:'/addcustomer',
             data:$('#so_form').serialize(),
             success:function(response){console.log(response);
              window.location.href = "/customer_display1/1";
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
      mass8.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass9.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass10.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass11.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass12.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass13.innerHTML = "<p class=text-danger>*This field requaired </p>";

    }
}
  </script>
  @endsection


