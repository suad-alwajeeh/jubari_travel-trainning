@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row">
  <div class="col-12">
  <h1 class="text-center">display airline</h1>
  </div>
  
<div class="container">            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>airline_code</th>
        <th>name</th>
        <th>country</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
      <tr id="tr{{$item->id}}" >
      <td>{{$item->airline_code}}</td>
      <td>{{$item->airline_name}}</td>
      <td>{{$item->country}}</td>
        <td>
        <div class="btn-group btn-group-sm">
  <a type="button" class="btn btn-success" href="airline_edit/{{$item->id}}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalair{{$item->id}}" ><i class="fas fa-trash "></i></a>
</div>
     <!-- The Modal -->
     <div class="modal fade" id="myModalair{{$item->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row text-center"><div class="col-12 p-4"><i style="font-size: 70px;" class="fas fa-exclamation-circle text-center text-danger"></i></div><div class="col-12 p-3"><h3 class="text-center">are you sure you want to delete airline??</h3></div><div class="col-12 p-2"><button type="button" class="btn btn-success" data-dismiss="modal" >cansel</button><button type="button" class="btn btn-danger" onclick="delete{{$item->id}}()" style="width:15%;">ok</button></div></div>
      </div>
   </div>
  </div>
</div>
        </td>
      </tr>
      <script>
      
function delete{{$item->id}}() {
 
 $.ajax({
       type:'get',
       url:'/airline_delete/'+{{$item->id}},
       data:{id:{{$item->id}}},
       success:function(response){console.log(response);
        $('#myModalair{{$item->id}}').modal('toggle');
        document.getElementById('tr{{$item->id}}').style.display ='none';
       },
       error:function(error){console.log(error);
       } 
   });
} 

</script>
     @endforeach
    </tbody>
  </table>
  {{$data->links()}}
</div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
