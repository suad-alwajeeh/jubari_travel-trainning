@extends('app_layouts.master')
@section('main_content')

<div class="content-wrapper">
  <div class="container p-4">
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
            <div class="card-header">
              <h2 class="card-title">
              Display Users
              </h2>
              <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
      status 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/user_display">all</a>
      <a class="dropdown-item " href="/user_display/1"> Active</a>
      <a class="dropdown-item " href="/user_display/0">No Active</a>
    </div>
  </div>
 
  <a type="button" class="btn btn-outline-success so_form_btn" href="{{ url('user_add') }}">add new</a>
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
        <th>user name</th>
        <th>user email</th>
        <th>department</th>
        <th>password</th>
        <th>status</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody>
    @forelse($data as $item)
      <tr id="tr{{$item->u_id}}" class="status{{$item->u_is_active}}" >
      <td><?php echo $i;?></td>
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
  <a type="button" class="btn btn-outline-success" href="{{ url('user_edit/'.$item->u_id) }}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-outline-danger"  data-toggle="modal" data-target="#myModalair{{$item->u_id}}"  ><i class="fas fa-trash "></i></a>
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
      <div class="row text-center"><div class="col-12 p-4"><i style="font-size: 70px;" class="fas fa-exclamation-circle text-center text-danger"></i></div><div class="col-12 p-3"><h3 class="text-center">are you sure you want to delete role ??</h3></div><div class="col-12 p-2"><button type="button" class="btn btn-success so_form_btn" style="float:none" data-dismiss="modal" >cansel</button><button type="button" class="btn btn-danger so_form_btn" style="float:none" onclick="delete{{$item->u_id}}()" style="width:15%;">ok</button></div></div>
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
        $('#so-alert-message').html('<div  class="alert so-alert-message" >delete row successfully...<button type="button" data-dismiss="alert" class="close">&times;</button></div>');

             },
             error:function(error){console.log(error);
             } 
         });
  } 





</script>
<?php $i++ ?>
@empty
<tr>
                      <td class=text-center colspan="10">There is No data in table...
                      <td>
                    </tr>
     @endforelse
    </tbody>
  </table>
  {{$data->links()}}

  
  </div>
  </div>
  </div>
  </div>
  </div>
  

  <!-- /.content-wrapper -->
@endsection
