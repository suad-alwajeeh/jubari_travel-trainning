@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  
<h2>add user page</h2>
@foreach($errors->all() as $er)
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
{{$er}}
</div>
@endforeach
<form  method="post" action="/edituser" >
@csrf
<div class=row>

    <div class="form-group mb-3">
      <label for="is_active">is_active</label>
     <select class="form-control" name="is_active" id="">
     <option value=1>yes</option>
     <option value=0>no</option>
     </select>
    </div>
    <input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">

    <div class="form-group">
    <label>select roles</label>
    <div class="checkbox">
    @foreach($data3 as $item33)
  <label><input type="checkbox" name="role[]" value="{{$item33->id}}">{{$item33->name}}</label>
  @endforeach
</div>
</div>
   
    <button type="submit" class="btn btn-primary">add user</button>
   
  </form>  

  <script>
       function dep_selecty(){
       var i= $('#department').val();
       $('#emp').html(' ');
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
            $('#user_data').html('<div class="form-group mb-3 col-md-6 col-sm-12"> <label for="pwd">user_name</label><input type="text" class="form-control" id="" value="'+response[0].emp_first_name+' '+ response[0].emp_middel_name+'" name="name" readonly></div> <div class="form-group mb-3 col-md-6 col-sm-12"><label for="adds_text">user_email</label><input type="email" class="form-control" id="" value="'+response[0].emp_email+'" name="email" readonly><input type="text" class="form-control" id="" value="'+response[0].emp_id+'" name="u_id" hidden=hidden></div>');
     },
             error:function(error){console.log(error);
            alert("data dont saved");
             } 
         });
       }

    </script>

  </div>
  </div>
  @endsection


