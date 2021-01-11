@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  
<h2>add role page</h2>
<!--form action="airline_display1" method="post"-->
@foreach($errors->all() as $er)
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
{{$er}}
</div>
@endforeach
@foreach($data as $item)
<form id="" method="post" action="/editrole" >
@csrf

    <div class="form-group mb-3">
      <label for="pwd">role_name</label>
      <input type="text" class="form-control" value="{{$item->display_name}}" placeholder="role_name" name="role_name">
    </div>
    <div class="form-group mb-3">
    <input type="text" hidden="hidden" value="{{$item->id}}" class="form-control" id="id" placeholder="id" name="id">
    <input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">
    </div>
    <div class="form-group mb-3">
      <label for="role_descripe">	role_descripe</label>
      <textarea class="form-control" name="role_descripe" id="role_descripe">
      {{$item->description}}
</textarea>
    </div>
    <div class="form-group mb-3">
      <label for="is_active">is_active</label>
     <select class="form-control" name="is_active" id="">
     <option value=1>yes</option>
     <option value=0>no</option>
     </select>
    </div>
   
    <button type="submit" class="btn btn-primary">send</button>
    @endforeach

  </form>  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

  <script>
    $('#airline_display1').on('submit',function(e){
         e.preventDefault();
         $.ajax({
             type:'post',
             url:'/addairline',
             data:$('#airline_display1').serialize(),
             success:function(response){console.log(response);
             alert("data saved");
             },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });

    });
  </script>

  </div>
  </div>
  @endsection


