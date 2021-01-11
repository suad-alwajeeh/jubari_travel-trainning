@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  
<h2>add airline page</h2>
<!--form action="airline_display1" method="post"-->
@foreach($errors->all() as $er)
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
{{$er}}
</div>
@endforeach
<form id="airline_display" method="post" action="/addairline" >
@csrf
<div class="row">
    <div class="form-group col-md-6">
      <label for="email">code</label>
      <input type="number" class="form-control" id="" placeholder=" 123" name="airline_code">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">airline</label>
      <input type="text" class="form-control" id="" placeholder="airline_name" name="airline">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">country</label>
      <input type="text" class="form-control" id="country" placeholder="country " name="country">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">carrier_code</label>
      <input type="text" class="form-control" id="carrier_code" placeholder=" carrier_code" name="carrier_code">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">code</label>
      <input type="text" class="form-control" id="code" placeholder="code " name="code">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">IATA</label>
      <input type="text" class="form-control" id="IATA" placeholder="IATA" name="IATA">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">	remark</label>
      <textarea class="form-control" name="remark" id="remark"></textarea>
    </div>
    <div class="form-group col-md-6">
      <label for="is_active">is_active</label>
     <select class="form-control" name="is_active" id="">
     <option value=1>1</option>
     <option value=0>2</option>
     </select>
    </div>
   </div>
    <button type="submit" class="btn btn-primary">send</button>
   
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


