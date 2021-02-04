@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
      <!--  start add Modal -->
      
 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="width:500px">
      <form class="form-horizontal" >
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">Department Name :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name"  name="name" required placeholder="Department Name ">
                    </div>
                </div>
               
                <div class="form-group row">
                    <div class="offset-sm-4 col-sm-8">
                        <div class="form-check">
                            <input type="checkbox"  class="form-check-input" name="is_active" checked id="is_active">
                    <label class="form-check-label" for="exampleCheck2">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
           
            <!-- /.card-footer -->
        </form>     </div>
      <div class="modal-footer">
      <a  href="{{url('department')}}"><button type="button" class="btn btn-outline-danger  m-3 p-2 float-left" data-dismiss="modal">Close</button></a>
      <a id="add2"> <button type="button" class="btn btn-outline-primary">Save changes</button></a>
      </div>
    </div>
  </div>
</div>
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
            <div class="card-header">
              <h2 class="card-title">
              Display Department
              </h2>
              <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
      status 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/department">all</a>
      <a class="dropdown-item " href="/department/1"> Active</a>
      <a class="dropdown-item " href="/department/0">No Active</a>
    </div>
  </div>
  <a type="button" class="btn btn-outline-success so_form_btn" data-toggle="modal" data-target="#add">add new</a>
            </div>
</br>
@if (session('seccess'))
<div  class="alert so-alert-message" >        {{ session('seccess') }}
 <button type="button" data-dismiss="alert" class="close">&times;</button></div>         
  @endif
  <div id="so-alert-message"></div>         

<div class="container"> 
<?php $i=1 ?> 

  <table class="table table-hover text-center " id="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Department</th>
        <th>Create At</th>
        <th>Status</th>
        <th>Opreation</th>
      </tr>
    </thead>
    <tbody id="pp">
    @forelse($dept as $item)
      <tr id="tr{{$item->id}}" class="status{{$item->is_active}}" >
      <input type="hidden" class="delete_id" value="{{$item->id}}">

      <td><?php echo $i;?><span style="display:none;" >{{$item->id}}</span></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->created_at}}</td>

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
  <a type="button" class="btn btn-outline-success" href="{{ url('/department/department-edit/'.$item->id) }}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-outline-danger deletebtn"   ><i class="fas fa-trash "></i></a>
</div>

        </td>
      </tr>
        <!-- The Modal -->
        <div class="modal fade" id="myModalair{{$item->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
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
function myFunction{{$item->id}}() {
  var checkBox{{$item->id}} = document.getElementById("customSwitch{{$item->id}}");
  
  if (checkBox{{$item->id}}.checked == true){
    $.ajax({
             type:'get',
             url:'/is_active_dep/'+{{$item->id}},
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
             url:'/no_active_dep/'+{{$item->id}},
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
  {{$dept->links()}}

  
  </div>
  </div>
  </div>
  </div>
  </div>
 
<script>
    $(document).ready(function () {
      console.log('add');
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.deletebtn').click(function (e) {
      e.preventDefault();
      var id = $(this).closest("tr").find('.delete_id').val();
      console.log(id);

      //alert(id);
      swal({
        title: "Are you sure?",
        text: "Are You  Sure to delete this filed!",
        icon: "error",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var data = {
              '_token': $('input[name=_token]').val(),
              'id': id,
            };

            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "GET",
              url: 'department/department_delete/' + id,
              data: data,
              success: function (response) {
                swal("Delete Successfully", {
                 icon: "success",
                }).then((willDelete) => {
                  location.reload();
                });
              }
            });
          }
          
          
        });
    });
 $("#add2").click(function () {

console.log('add');

              //var id=$('#add').val();
              //var id=$('#id').val();
              var name=$('#name').val();
              //var discrption=$('#discrption').val();
              var is_active=$('#is_active').val();
              console.log(name);
              //console.log(id);
              $.ajax({
      url:"{{url('department/insert')}}",
      data: {is_active:is_active,name:name},
      success: function (data) {
        console.log('sec');
        $('#add').remove();
        swal("Data Insert", {
      icon: "success",
    }).then((willDelete) => {
                  location.reload();
                });
     },
      error:function(){
        console.log('err');
      }
        
          }); });
        });


  </script>
  
  <!-- /.content-wrapper -->
@endsection
