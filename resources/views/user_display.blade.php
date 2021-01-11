@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row">
  <div class="col-10">
  <h1 class="text-center">display users	</h1>
  </div>
  <div class="col-2">
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      status 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/user_display">all</a>
      <a class="dropdown-item " href="/user_display/1"> Active</a>
      <a class="dropdown-item " href="/user_display/0">No Active</a>
    </div>
  </div>
</div>
<div class="container">  
@if(Session::has('success'))  
<div class="alert alert-success" role="alert">
{{Session::get('success')}}
</div>
@endif
  <table class="table table-striped" id="table">
    <thead>
      <tr>
        <th>#</th>
        <th>user_name</th>
        <th>user_email</th>
        <th>department</th>
        <th>password</th>
        <th>user_status</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
      <tr id="tr{{$item->u_id}}" class="status{{$item->u_is_active}}" >
      <td>{{$item->u_id}}</td>
      <td>{{$item->u_name}}</td>
      <td>{{$item->u_email}}</td>      
      <td>{{$item->d_name}}</td>
      <td>{{$item->pass}}</td> 
      <td>
      @if($item->u_is_active == 0)
      
      <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input onclick="myFunction{{$item->u_id}}()" type="checkbox" class="custom-control-input" id="customSwitch{{$item->u_id}}">
                      <label class="custom-control-label" for="customSwitch{{$item->u_id}}"></label>
                      
                    </div>
                  </div>
                  @elseif($item->u_is_active == 1)
                  <div class="form-group">
                    <div  class="custom-control custom-switch custom-switch-on-success custom-switch-off-danger ">
                      <input onclick="myFunction{{$item->u_id}}()" checked type="checkbox" class="custom-control-input" id="customSwitch{{$item->u_id}}">
                      <label class="custom-control-label" for="customSwitch{{$item->u_id}}"></label>
                    </div>
                  </div>

@endif

      </td>   
        <td>
        <div class="btn-group btn-group-sm">
  <a type="button" class="btn btn-success" href="{{ url('user_edit/'.$item->u_id) }}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-danger"  data-toggle="modal" data-target="#myModalair{{$item->u_id}}"  ><i class="fas fa-trash "></i></a>
</div>
        </td>
      </tr>
      <!-- The Modal -->
      <div class="modal fade" id="myModalair{{$item->u_id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row text-center"><div class="col-12 p-4"><i style="font-size: 70px;" class="fas fa-exclamation-circle text-center text-danger"></i></div><div class="col-12 p-3"><h3 class="text-center">are you sure you want to delete role ??</h3></div><div class="col-12 p-2"><button type="button" class="btn btn-success" data-dismiss="modal" >cansel</button><button type="button" class="btn btn-danger" onclick="delete{{$item->u_id}}()" style="width:15%;">ok</button></div></div>
      </div>
   </div>
  </div>
</div> 

      <script>
     function dep_select(){
     var m= $("#selectdep").val();
     if(m==1){
      $('.dep4').css('display','none');
        }
     }
function myFunction{{$item->u_id}}() {
  var checkBox{{$item->u_id}} = document.getElementById("customSwitch{{$item->u_id}}");
  
  if (checkBox{{$item->u_id}}.checked == true){
    $.ajax({
             type:'get',
             url:'/is_active_user/'+{{$item->u_id}},
             data:{id:{{$item->u_id}}},
             success:function(response){console.log(response);
            // alert("data saved");
             },
             error:function(error){console.log(error);
            // alert("data dont saved");
             } 
         });
  } else{
    $.ajax({
             type:'get',
             url:'/no_active_user/'+{{$item->u_id}},
             data:{id:{{$item->u_id}}},
             success:function(response){console.log(response);
            // alert("data saved");
             },
             error:function(error){console.log(error);
            // alert("data dont saved");
             } 
         });
}
}


function delete{{$item->u_id}}() {
 
       $.ajax({
             type:'get',
             url:'/user_delete/'+{{$item->u_id}},
             data:{id:{{$item->u_id}}},
             success:function(response){console.log(response);
              $('#myModalair{{$item->u_id}}').modal('toggle');

              document.getElementById('tr{{$item->u_id}}').style.display ='none';
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
