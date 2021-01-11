@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row">
  <div class="col-12">
  <h1 class="text-center">Supplier Reports</h1>
  
  
  <br>
  <div class="col-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">SupplierReports</li>
            </ol>
  </div>
</div>


<br>

<div class="col-3">
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Filter Status
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/supplierRepo">all</a>
      <a class="dropdown-item " href="/supplierRepo/1"> Active</a>
      <a class="dropdown-item " href="/supplierRepo/0">No Active</a>
    </div>

  </div>
</div>
<div class="col-3">
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Filter Name 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/supplierRepo">all</a>
      @if(count($data))
                      @foreach($data as $name)

                      <a class="dropdown-item" href="/supplierRepo/display_row/{{$name->s_no}}">{{$name->supplier_name}}</a>

                      @endforeach
                  @endif
    </div>

  </div>
</div>
<div class="col-3">
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Filter Service 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/supplierRepo">all</a>
      <a class="dropdown-item " href="/supplierRepo/6"> Ticket Service</a>
      <a class="dropdown-item " href="/supplierRepo/7">Bus Service</a>
      <a class="dropdown-item " href="/supplierRepo/8">Hotel Service</a>
      <a class="dropdown-item " href="/supplierRepo/9">Car Service</a>
      <a class="dropdown-item " href="/supplierRepo/10">Medical Service</a>
      <a class="dropdown-item " href="/supplierRepo/11">Visa Service</a>
      <a class="dropdown-item " href="/supplierRepo/12">General Service</a>
    </div>

  </div> 
</div>
<div class="col-3">
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Filter Currency
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/supplierRepo">all</a>
      <a class="dropdown-item " href="/supplierRepo/3"> USD</a>
      <a class="dropdown-item " href="/supplierRepo/4">YER</a>
      <a class="dropdown-item " href="/supplierRepo/5">SAR</a>
    </div>

  </div> 
 
</div>
  </div>
<br>
<div class="container">            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Supplier Name</th>
        <th>Mobile</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Photo</th>
        <th>Account No.</th>
        <th>Services</th>
        <th>Currency</th>
        <th>Remark</th>
        <th>Address</th>
        <th>Is Active</th>
        <th>Date created</th>
        
        
        
       
      </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
      <tr>
      <td>{{$item->s_no}}</td>
      <td>{{$item->supplier_name}}</td>
      <td>{{$item->supplier_mobile}}</td>
      <td>{{$item->supplier_phone}}</td>
      <td>{{$item->supplier_email}}</td>
      <td><img src="{{asset('img/suppliers/'.$item->supplier_photo)}}" width=40px; hight=40px;></td>
      <td>{{$item->supplier_acc_no}}</td>
      <td>{{$item->ser_name}}</td>
      <td>{{$item->cur_name}}</td>
      <td>{{$item->supplier_remark}}</td>
      <td>{{$item->supplier_address}}</td>
      <td>{{$item->is_active}}</td>
      <td>{{$item->created_at}}</td>
        
      </tr>
     
     @endforeach
    </tbody>
  </table>
  
</div>
 

  
</div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
