@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  
<h2>edit airline page</h2>
<!--form action="airline_display1" method="post"-->
<form id="airline_edit9" method="post" action="/editairline" >
@foreach($data as $item)
<div class="row">
    <div class="form-group col-md-6">
      <label for="email">code</label>
      <input type="text" hidden=hidden  value="{{$item->id}}" class="form-control" id="email" placeholder="Enter email" name="id">
      <input type="text" value="{{$item->id}}"  class="form-control" id="email" placeholder=" airline_code" name="airline_code">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">airline</label>
      <input type="text" value="{{$item->airline_name}}"  class="form-control" id="" placeholder="airline_name" name="airline">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">country</label>
      <input type="text" value="{{$item->country}}"  class="form-control" id="country" placeholder="country " name="country">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">carrier_code</label>
      <input type="text" value="{{$item->carrier_code}}"  class="form-control" id="carrier_code" placeholder=" carrier_code" name="carrier_code">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">code</label>
      <input type="text" value="{{$item->code}}"  class="form-control" id="code" placeholder="code " name="code">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">IATA</label>
      <input type="text" value="{{$item->IATA}}"  class="form-control" id="IATA" placeholder="IATA" name="IATA">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">	remark</label>
      <textarea class="form-control" name="remark" id="remark"> 
      {{$item->remark}}
      </textarea>
    </div>
    <div class="form-group col-md-2 mt-4">
    @if($item->is_active ==1)
      <label class="checkbox-inline"><input type="checkbox" name="is_active" checked value="1">active</label>
    @else
    <label class="checkbox-inline"><input type="checkbox" name="is_active"  value="0">active</label>
    @endif    </div>  
   </div>
    <button type="submit" class="btn btn-primary">send</button>
    @endforeach

  </form>  
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
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

  </div>
  </div>
  @endsection


