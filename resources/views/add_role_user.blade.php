@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  
<h2>add role to user</h2>
<!--form action="airline_display1" method="post"-->
@foreach($errors->all() as $er)
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
{{$er}}
</div>
@endforeach
<form id="" method="post" action="/addroleuser" >
@csrf

<div class="form-group col-6">
                  <label>select user</label>
                  <select class="form-control select2" name="user_id" style="width: 100%;">
                  @foreach($data1 as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
    <div class="form-group mb-3">
      <input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">
    </div>
    <div class="form-group">
    <label>select roles</label>

    <div class="checkbox">
    @foreach($data as $item1)
  <label><input type="checkbox" name="role[]" value="{{$item1->id}}">{{$item1->name}}</label>
  @endforeach
</div>
</div>
                
    <button type="submit" class="btn btn-primary">send</button>
   
  </form>  

  <script>
$('.select2').select2();
</script>
  </div>
  </div>
  @endsection


