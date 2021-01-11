@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  
<h2>edit customer </h2>
@foreach($errors->all() as $er)
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
{{$er}}
</div>
@endforeach
<!--form action="airline_display1" method="post"-->
<form id="airline_edit9" method="post" action="/editcustomer" >
@foreach($data as $item)
<div class="row">
      <input type="text" hidden=hidden  value="{{$item->cus_id}}" required class="form-control" id="email" placeholder="Enter email" name="id">
      <div class="form-group col-md-6">
      <label for="pwd">	name:</label>
      <input type="text" value="{{$item->cus_name}}" required  class="form-control"  name="cus_name">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">account_number:</label>
      <input type="number" value="{{$item->cus_account}}" required class="form-control" name="cus_account">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">	contact_person:</label>
      <input type="text" value="{{$item->contact_person}}" required  class="form-control"  name="contact_person">
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">contact_title:</label>
      <input type="text" value="{{$item->contact_title}}" required class="form-control" name="contact_title">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">telephon_1:</label>
      <input type="text" value="{{$item->telephon1}}"  class="form-control"  name="telephon1">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">telephon_2</label>
      <input type="text" value="{{$item->telephon2}}" required class="form-control"  name="telephon2">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">fax_1</label>
      <input type="text" value="{{$item->fax1}}" required class="form-control" name="fax1">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">fax_2</label>
      <input type="text" value="{{$item->fax2}}" required class="form-control" name="fax2">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">	whatsapp</label>
      <input type="text" value="{{$item->whatsapp}}" required class="form-control"  name="whatsapp">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">email</label>
      <input type="text" value="{{$item->cus_email}}" required  class="form-control"  name="cus_email">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">	address</label>
      <input type="text" value="{{$item->address}}" required  class="form-control" name="address">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">city</label>
      <input type="text" value="{{$item->city}}" required  class="form-control"  name="city">
    </div>
    <div class="form-group col-md-4">
      <label for="pwd">country</label>
      <input type="text" required value="{{$item->country}}"  class="form-control" name="country">
    </div>
    <div class="form-group col-md-2 mt-4">
    @if($item->is_active ==1)
      <label class="checkbox-inline"><input type="checkbox" name="is_active" checked value="1">active</label>
    @else
    <label class="checkbox-inline"><input type="checkbox" name="is_active"  value="0">active</label>
    @endif
    @if($item->vip ==1)
      <label class="checkbox-inline"><input type="checkbox" name="vip" checked value="1">vip</label>
      @else
      <label class="checkbox-inline"><input type="checkbox" name="vip"  value="0">vip</label>
      @endif
    </div>
    @endforeach

    <div class="form-group col-md-4">
      <label for="is_active">def_currency</label>
     <select required name="def_currency" class="form-control" id="">
     @foreach($data1 as $item1)
     <option value="{{$item1->cur_id}}">{{$item1->cur_name}}</option>
     @endforeach
     </select>
    </div>
   
   </div>
   <button type="submit" class="btn btn-primary">send</button>
   <a href="/customer_display" class="btn btn-dark">cansel</a>
  

  </form>  
  

  </div>
  </div>
  @endsection


