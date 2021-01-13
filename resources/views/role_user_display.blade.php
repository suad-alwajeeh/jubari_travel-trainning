@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
            <div class="card-header">
              <h2 class="card-title">
              Display Users Roles
              </h2>
              <a type="button" href="{{ url('add_role_user') }}" class="btn btn-outline-success so_form_btn">add role to user</a>
            </div>
</br>
            @foreach($data1 as $item1)
<div  class="alert so-alert-message" >{{$item1}} <button type="button" data-dismiss="alert" class="close">&times;</button></div>         
  @endforeach
  <div id="so-alert-message"></div>         

<div class="container"> 
<?php $i=1 ?> 

  <table class="table table-hover text-center " id="table">
    <thead>
      <tr>
        <th>#</th>
        <th>user_name</th>
        <th>roles</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody>
    
    @forelse($data as $item)
      <tr id="tr{{$item->u_id}}" >
      <td><?php echo $i;?></td>
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
  $('#details1').html('<div class="row text-center"><div class="col-12 p-4"><i style="font-size: 70px;" class="fas fa-exclamation-circle text-center text-danger"></i></div><div class="col-12 p-3"><h3 class="text-center">are you sure you want to delete role??</h3></div><div class="col-12 p-2"><button type="button" class="btn btn-success so_form_btn" style="float:none" data-dismiss="modal" >cansel</button><button type="button" class="btn btn-danger so_form_btn" style="float:none" onclick="deletei('+id+')" style="width:15%;">ok</button></div></div>');
  } 
function deletei(id) {
 
       $.ajax({
             type:'get',
             url:'/user_role_delete/'+id,
             data:{u_id:id},
             success:function(response){console.log(response);
              $('#myModalcus_del').modal('toggle');
              document.getElementById('tr'+id).style.display ='none';
              $('#so-alert-message').html('<div  class="alert so-alert-message" >delete row successfully...<button type="button" data-dismiss="alert" class="close">&times;</button></div>');

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
<?php $i++ ?>
@empty
<tr>
                      <td class=text-center colspan="10">There is No data in table...
                      <td>
                    </tr>
     @endforelse
    </tbody>
  </table>

  
  </div>
  </div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
