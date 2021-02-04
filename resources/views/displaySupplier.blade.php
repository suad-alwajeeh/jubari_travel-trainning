@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row">
  <div class="col-12">
  <h1 class="text-center">Display Suppliers</h1>
</div>
 
<div class="col-10">
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Filter 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/displaySupplier">all</a>
      <a class="dropdown-item " href="/displaySupplier/1"> Active</a>
      <a class="dropdown-item " href="/displaySupplier/0">No Active</a>
    </div>
  

  </div>
</div>
  
<div class="col-2">
<a type="button" class="btn btn-success" href="{{ url('/addSupplier') }}"> Add Supplier</a> 
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
        <th>Operations</th>
       
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
        <td>
        <div class="btn-group btn-group-sm">
  <a type="button" class="btn btn-success" href="{{ url('editSupplier/'.$item->s_no) }}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-danger" href="{{ url('deleteSupplier/'.$item->s_no) }}"><i class="fas fa-trash "></i></a>
  <a type="button" class="btn btn-secondary" data-id="{{$item->s_no}}" data-toggle="modal" data-target="#supplier-show"><i class="fas fa-eye "></i></a>
  
        </td>
        
      </tr>
     
     @endforeach
    </tbody>
  </table>
<!----  start add Modal -->
<div class="modal fade" id="supplier-show"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Show All Supplier details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" >
            @csrf
            <div class="card-body">
            <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Supplier Name</th>
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
            <!-- /.card-body -->
           
            <!-- /.card-footer -->
        </form>     </div>
      <div class="modal-footer">
      <a><button type="button" class="btn btn-secondary   m-3 p-2 float-left" data-dismiss="modal">Close</button></a>
      
      </div>
    </div>
  </div>
</div>
<!-- end add model-->
  
</div>
  {{$data->links()}}

  
</div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
