@extends('app_layouts.master')
@section('main_content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    @if (session('seccess'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('seccess') }}
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
    @endif
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Department</h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
     <!--  start add Modal -->
 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
                            <input type="checkbox"  class="form-check-input" name="is_active" checked id="active">
                    <label class="form-check-label" for="exampleCheck2">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
           
            <!-- /.card-footer -->
        </form>     </div>
      <div class="modal-footer">
      <a  href="{{url('department')}}"><button type="button" class="btn btn-secondary   m-3 p-2 float-left" data-dismiss="modal">Close</button></a>
      <a id="add2"> <button type="button" class="btn btncolor m-3 p-2 float-right">Save changes</button></a>
      </div>
    </div>
  </div>
</div>
<!-- end add model-->
    <!-- /.content -->
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
         
            <div class="card">
              <div class="card-header">
                <h3 class="card-title col-3  d-inline-block">Department</h3>
                <select  class="form-control col-2  mx-5 d-inline-block" id="dropselect">
<option  class="form-control  d-inline-block" value="2">ALL</option>
<option  class="form-control  d-inline-block" value="1">Active</option>
<option  class="form-control  d-inline-block" value="0">Deactive</option>
</select>
            <a class="btn btncolor col-3 p-2 text-white float-right d-inline-block"data-toggle="modal" data-target="#add">  <i class="fa fa-plus" aria-hidden="true"></i>New Department</a>
      </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Department</th>
                    <th>Create At</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="row2">
                 
                 @foreach($dept as $department)
                  <tr >
                  <input type="hidden" class="delete_id" value="{{$department->id}}">

                    <td>{{$department->id}}</td>
                    <td>{{$department->name}}</td>
                    <td>{{$department->created_at}}</td>
                    <td>
                    <input type="hidden" id="test">
                    <div class="btn-group btn-group-sm">
  <a  class="m-2" href="{{ url('/department/department-edit/'.$department->id) }}"><i class="fas fa-pencil-alt text-primary "></i></a>
  <a class="m-2 deletebtn" ><i class="fas fa-trash text-danger"></i></a>
</div></td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Department</th>
                    <th>Create At</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      </div>
  

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  console.log('inseode scripy');

  $(document).ready(function () {
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
  let  td='';
  console.log('insede redar');

//var table=$('#datatable').DataTable();
$("#dropselect").change(function () {

  console.log('jbwjebfjw');
  console.log($("#dropselect"));

                var id=$('#dropselect').val();
                console.log(id);
                $.ajax({
        url:"{{url('department')}}",
        data: {id:id},
        success: function (data) {
          console.log('sec');
          //console.log(data);
           $.each(JSON.parse(data), function (key, value) {
            for (var i = 0; i < value.length; i++){
              console.log(value.length);
              console.log(value.length);
              if(value.length>0)
{myJSON = JSON.parse(data);
td +='<tr><input type="hidden" class="delete_id" value="'+value[i].id+'"><td>'+value[i].id+'</td><td>'+value[i].name+'</td> <td>'+value[i].created_at+'</td><td><div class="btn-group btn-group-sm"><a type="button" class="m-2" href="/department/department-edit/'+value[i].id+'"><i class="fas fa-pencil-alt  text-primary"></i></a><a class="m-2" ><i class="fas fa-trash text-danger "></i></a></div></td></tr>';
$('.row2').html(td);}
            }
            td='';
            


});  },
        error:function(){
          console.log('err');
   }    }); 
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
@endsection