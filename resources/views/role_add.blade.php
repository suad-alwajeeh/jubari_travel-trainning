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
<form id="" method="post" action="/addrole" >
@csrf

    <div class="form-group mb-3">
      <label for="pwd">role_name</label>
      <input type="text" class="form-control" id="" placeholder="role_name" name="role_name">
    </div>
    <div class="form-group mb-3">
      <input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">
    </div>
    <div class="form-group mb-3">
      <label for="role_descripe">	role_descripe</label>
      <textarea class="form-control" name="role_descripe" id="role_descripe"></textarea>
    </div>
    <div class="form-group mb-3">
      <label for="is_active">is_active</label>
     <select class="form-control" name="is_active" id="">
     <option value=1>yes</option>
     <option value=0>no</option>
     </select>
    </div>
  
                
    <button type="submit" class="btn btn-primary">send</button>
   
  </form>  

  <script>
$('.select2').select2();
</script>
  </div>
  </div>
  @endsection


