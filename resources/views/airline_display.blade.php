@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
            <div class="card-header">
              <h2 class="card-title">
              Display Airlines
              </h2>
              <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
      status 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/airline_display">all</a>
      <a class="dropdown-item " href="/airline_display/1"> Active</a>
      <a class="dropdown-item " href="/airline_display/0">No Active</a>
    </div>
  </div>
  <a type="button" class="btn btn-outline-success so_form_btn" href="{{ url('airline_add') }}">add new</a>

            </div>
</br>
            @foreach($data1 as $item1)
<div  class="alert so-alert-message" >{{$item1}} <button type="button" data-dismiss="alert" class="close">&times;</button></div>         
  @endforeach
  <div id="so-alert-message"></div>         

<div class="container">            
  <table class="table table-hover text-center">
    <thead>
    <?php $i=1 ?> 

      <tr>
      <th>#</th>
      <th>Airline Code</th>
      <th>Code</th>
        <th>Name</th>
        <th>Country</th>
        <th>Status</th>
        <th>Opration</th>
      </tr>
    </thead>
    <tbody>
    @forelse($data as $item)
      <tr id="tr{{$item->id}}" >
      <td><?php echo $i;?></td>
      <td>{{$item->airline_code}}</td>
      <td>{{$item->code}}</td>
      <td>{{$item->airline_name}}</td>
      <td>{{$item->country}}</td>
      <td>
      @if($item->is_active == 0)
      
      <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input onclick="myFunction{{$item->id}}()" type="checkbox" class="custom-control-input" id="customSwitch{{$item->id}}">
                      <label class="custom-control-label" for="customSwitch{{$item->id}}"></label>
                    </div>
                  </div>
                  @elseif($item->is_active == 1)
                  <div class="form-group">
                    <div  class="custom-control custom-switch custom-switch-on-success custom-switch-off-danger ">
                      <input onclick="myFunction{{$item->id}}()" checked type="checkbox" class="custom-control-input" id="customSwitch{{$item->id}}">
                      <label class="custom-control-label" for="customSwitch{{$item->id}}"></label>
                    </div>
                  </div>
@endif
      </td>
        <td>
        <div class="btn-group btn-group-sm">
  <a type="button" class="btn btn-outline-success" href="airline_edit/{{$item->id}}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModalair{{$item->id}}" ><i class="fas fa-trash "></i></a>
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
      <div class="row text-center"><div class="col-12 p-4"><i style="font-size: 70px;" class="fas fa-exclamation-circle text-center text-danger"></i></div><div class="col-12 p-3"><h3 class="text-center">are you sure you want to delete item ??</h3></div><div class="col-12 p-2"><button type="button" class="btn btn-success so_form_btn" style="float:none" data-dismiss="modal" >cansel</button><button type="button" class="btn btn-danger" onclick="delete{{$item->id}}()" style="width:15%;">ok</button></div></div>
      </div>
   </div>
  </div>
</div>
        </td>
      </tr>
      <script>
      function myFunction{{$item->id}}() {
  var checkBox{{$item->id}} = document.getElementById("customSwitch{{$item->id}}");
  
  if (checkBox{{$item->id}}.checked == true){
    $.ajax({
             type:'get',
             url:'/is_active_airline/'+{{$item->id}},
             data:{id:{{$item->id}}},
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
             url:'/no_active_airline/'+{{$item->id}},
             data:{id:{{$item->id}}},
             success:function(response){console.log(response);
            // alert("data saved");
             },
             error:function(error){console.log(error);
            // alert("data dont saved");
             } 
         });
}
}
function delete{{$item->id}}() {
 
 $.ajax({
       type:'get',
       url:'/airline_delete/'+{{$item->id}},
       data:{id:{{$item->id}}},
       success:function(response){console.log(response);
         $('#myModalair'+{{$item->id}}).modal('toggle');
              document.getElementById('tr{{$item->id}}').style.display ='none';
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
