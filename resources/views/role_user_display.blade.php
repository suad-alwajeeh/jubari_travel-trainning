@extends('app_layouts.master')
@section('main_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row">
  <div class="col-10">
  <h1 class="text-center">display user roles</h1>
  </div>
  <div class="col-2">
  <a type="button" href="/add_role_user" class="btn btn-secondary">add role to user</a>
</div>
  </div>


<div class="container">            
  <table class="table table-striped" >
    <thead>
      <tr>
        <th>#</th>
        <th>user_name</th>
        <th>roles</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody>
    
    @foreach($data as $item)
      <tr id="tr{{$item->u_id}}" >
      <td>{{$item->u_id}}</td>
      <td>{{$item->u_name}}</td>
      <td id="td{{$item->u_id}}">
   {{$item->roless}}
      </td>
        <td >
        <div class="btn-group btn-group-sm">
        <a type="button" class="btn btn-danger" onclick="deleteitem({{$item->u_id}})" ><i class="fas fa-trash "></i></a>
</div>
        </td>
      </tr>
      <script>
function deleteitem(id) {
  $('#myModalcus').modal('hide');
  $('#myModalcus_del').modal('show');
  $('#details1').html('<div class="row text-center"><div class="col-12 p-4"><i style="font-size: 70px;" class="fas fa-exclamation-circle text-center text-danger"></i></div><div class="col-12 p-3"><h3 class="text-center">are you sure you want to delete customer??</h3></div><div class="col-12 p-2"><button type="button" class="btn btn-success" data-dismiss="modal" >cansel</button><button type="button" class="btn btn-danger" onclick="deletei('+id+')" style="width:15%;">ok</button></div></div>');
  } 
function deletei(id) {
 
       $.ajax({
             type:'get',
             url:'/user_role_delete/'+id,
             data:{u_id:id},
             success:function(response){console.log(response);
              $('#myModalcus_del').modal('toggle');
              document.getElementById('tr'+id).style.display ='none';
             },
             error:function(error){console.log(error);
             } 
         });
  } 
 
</script>
<div class="modal fade" id="myModalcus_del">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="details1">

      <a  type="button" class="btn btn-success" data-dismiss="modal">ok</a>
      </div>
   </div>
  </div>
</div>
     @endforeach
    </tbody>
  </table>

  
</div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
