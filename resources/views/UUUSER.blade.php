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
<div class="form-group mb-3 col-md-4 col-sm-12">
<label for="is_active">choese employee</label>
     <select class="form-control select2" onchange="emp_selecty()" name="emp_id" id="emp">
     <option class="disabled" >choice employee</option>
     @foreach($data1 as $item1)
     <option value="{{$item1->emp_id}}">{{$item1->emp_first_name}} {{$item1->emp_middel_name}} {{$item1->emp_last_name}}</option>
     @endforeach
     </select>
     <small id="helpId1" class="text-muted">*must select employee to create account</small>

    </div>
    <div class="form-group mb-3 col-md-4 col-sm-12" style="display:none;">
      <label for="is_active">choese employee</label>
     <select class="form-control" >
     </select>
     <small id="helpId2" class="text-muted">*must select employee</small>

    </div>
    <input hidden="hidden" type="text" class="form-control" value="{{ Auth::user()->id }}"  name="how_create_it">

    <div class="form-group mb-3 col-md-4 col-sm-12">
      <label for="is_active">is_active</label>
     <select class="form-control" name="is_active" id="">
     <option value=1>yes</option>
     <option value=0>no</option>
     </select>
    </div>
    </div>
    <div class=row id='user_data'>
    
    </div>
    <div class=row id="tempoo">
    <div class="form-group mb-3 col-md-6 col-sm-12">
     <label for="pwd">user name</label>
     <input type="text" class="form-control" id="" value="" name="name" readonly>
     </div> 
    <div class="form-group mb-3 col-md-6 col-sm-12">
    <label for="adds_text">user email</label>
    <input type="email" class="form-control"  name="email" readonly>
    </div>
    </div>
    <div class="form-group">
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
</form>  
</div>

   <div class="card-footer" >
   <a href="/user_display" class="btn btn-outline-danger so_form_btn">cansel</a>
   <button type="submit" onclick="send_data()" class="btn btn-outline-primary so_form_btn">send</button>
    </div>    
    </div>

  <script>
       function dep_selecty(){
       var i= $('#department').val();
       $('#emp').html('');
$.ajax({
             type:'get',
             dataType:'json',
             url:'/employee_dept/'+i,
             data:{id:i},
             success:function(response){
               $('#emp').append('<option value="0">select employee</option>');
               $.map(response ,function(k,v){
                  console.log(k.emp_id);
                  for(var i in k){
                    console.log(k[i].emp_id);
                  }
                  
                  $('#emp').append('<option value="'+k.emp_id+'">'+k.emp_first_name+' '+k.emp_middel_name+'</option>');

               });
                
              },
             error:function(error){console.log(error);
            alert("data dont saved");
             } 
         });
       }
       function emp_selecty(){
         
       var i= $('#emp').val();
       $.ajax({
             type:'get',
             dataType:'json',
             url:'/employee_data/'+i,
             data:{id:i},
             success:function(response){
               console.log(response);
               $('#tempoo').html("");
            $('#user_data').html('<div class="form-group mb-3 col-md-6 col-sm-12"> <label for="pwd">user_name</label><input type="text" class="form-control" id="" value="'+response[0].emp_first_name+' '+ response[0].emp_middel_name+'" name="name" readonly></div> <div class="form-group mb-3 col-md-6 col-sm-12"><label for="adds_text">user_email</label><input type="email" class="form-control" id="" value="'+response[0].emp_email+'" name="email" readonly><input type="text" class="form-control" id="" value="'+response[0].emp_id+'" name="u_id" hidden=hidden></div>');
     },
             error:function(error){console.log(error);
            alert("data dont saved");
             } 
         });
       }
       function send_data(){
      var dept = $("#department").val();
      var emp = $("#emp").val();
      if (dept != "" || emp != ""){
         $.ajax({
             type:'post',
             url:'/adduser',
             data:$('#so_form').serialize(),
             success:function(response){console.log(response);
              window.location.href = "/user_display1/1";
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });
    }else{
      mass1.innerHTML = "<p class=text-danger>*This field requaired </p>";
      mass2.innerHTML = "<p class=text-danger>*This field requaired </p>";
     
    }
}
    </script>

  </div>
  </div>
  @endsection


