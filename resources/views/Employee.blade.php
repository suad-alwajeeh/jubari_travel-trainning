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
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
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
            <h1> Employees</h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
   
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
                <h3 class="card-title col-3  d-inline-block">Employees</h3>
                <select  class="form-control col-2   mx-5 d-inline-block" id="dropselect">
<option  class="form-control  d-inline-block" value="2">ALL</option>
<option  class="form-control  d-inline-block" value="1">Active</option>
<option  class="form-control  d-inline-block" value="0">Deactive</option>
</select>
            <a class="btn btn-primary  col-2 float-right p-2 d-inline-block" href="{{url('employees/insert')}}">  <i class="fa fa-plus" aria-hidden="true"></i>Add New Employee</a>
      </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th> Mobile</th>
                    <th> Department</th>
                    <th> Salary</th>
                    <th> Hire Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="row2">
                 @foreach($emps as $emp)
                  <tr>
                  <input type="hidden" class="delete_id" value="{{$emp->emp_id}}">

                    <td>{{$emp->emp_id}}</td>
                    <td>{{$emp->emp_first_name}}  {{$emp->emp_midel_name}}  {{$emp->emp_thired_name}}  {{$emp->emp_last_name}}</td>
                    <td>{{$emp->emp_mobile}}</td>
                    <td>{{$emp->name}}</td>
                    <td>{{$emp->emp_salary}}</td>
                    <td>{{$emp->emp_hirdate}}</td>
                    
                    <td>
                    <a type="button" class="btn btn-success" href="{{ url('employees/employee-edit/'.$emp->id) }}"><i class="fas fa-pencil-alt "></i></a>
                   
                    <button type="button" class="btn btn-danger deletebtn"><i class="fas fa-trash "></i></button>

</td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th> 
                    <th>Name</th>
                    <th> Mobile</th>
                    <th> Department</th>
                    <th> Salary</th>
                    <th> Hire Date</th>
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
      <!-- /.container-fluid -->

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      <script>
                console.log('inseode scripy');

$(document).ready(function(){
  let  td='';
  console.log('insede redar');

//var table=$('#datatable').DataTable();
$("#dropselect").change(function () {

  console.log('jbwjebfjw');
  console.log($("#dropselect"));

                var id=$('#dropselect').val();
                console.log(id);
                $.ajax({
        url:"{{url('employees')}}",
        data: {id:id},
        success: function (data) {
          console.log('sec');
          console.log(data);
          if(JSON.parse(data)===null)
          $('.row2').html('null');

          else
         { $.each(JSON.parse(data), function (key, value) {
            for (var i = 0; i < value.length; i++){
              console.log('value[i]');
              console.log(value[i]);
myJSON = JSON.parse(data);
td +='<tr><td>'+value[i].emp_id+'</td><td>'+value[i].emp_first_name+' ' +value[i].emp_midel_name +'  ' +value[i].emp_thired_name+' '+value[i].emp_last_name+'</td> <td>'+value[i].emp_mobile+'</td> <td>'+value[i].name+'</td> <td>'+value[i].emp_salary+'</td> <td>'+value[i].emp_hirdate+'</td><td><div class="btn-group btn-group-sm"><a type="button" class="btn btn-success" href=""><i class="fas fa-pencil-alt "></i></a><a type="button" class="btn btn-danger deletebtn" href=""><i class="fas fa-trash "></i></a></div></td></tr>';
$('.row2').html(td);
            }
            td='';


});}


        },
        error:function(){
          console.log('err');


        }
          
            }); 
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
              url:'employees/employee_delete/' + id,
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
   
});
</script>
@endsection