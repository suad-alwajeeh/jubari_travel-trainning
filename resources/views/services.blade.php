@extends('app_layouts.master')
@section('main_content')

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                
<div class="col-12">
            <ol class="breadcrumb float-sm-right ">
              <li class="breadcrumb-item"><a href="/services"> Services</a></li>

            </ol>
  </div>
  </br>
  </br>
  <!--  start add Modal -->
  <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Service Name :</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="ser_name" name="ser_name" required
                    placeholder="Service Name ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Discrption :</label>
                <div class="col-sm-8">
                  <textarea type="text" class="form-control" id="discrption" name="discrption" required
                    placeholder="Descrption "></textarea>
                </div>
              </div>


              <div class="form-group row">
                <div class="offset-sm-4 col-sm-8">
                  <div class="form-check">
                    <input type="checkbox" checked class="form-check-input" name="is_active" id="active">
                    <label class="form-check-label" for="exampleCheck2">Active</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <input type="hidden" id="id">
            <!-- /.card-footer -->
          </form>
        </div>
        <div class="modal-footer">
          <a href="{{url('service')}}"><button type="button" class="btn btn-secondary  m-3 p-2 float-left"
              data-dismiss="modal">Close</button></a>
          <a id="add2"> <button type="button" class="btn btncolor  m-3 p-2 float-right">Save changes</button></a>
        </div>
      </div>
    </div>
  </div>
  <!-- end add model-->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Service</h1>
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
                <h3 class="card-title col-3  d-inline-block">Services</h3>
                <select class="form-control col-2   mx-5 d-inline-block" id="dropselect">
                  <option class="form-control  d-inline-block" value="2">ALL</option>
                  <option class="form-control  d-inline-block" value="1">Active</option>
                  <option class="form-control  d-inline-block" value="0">Deactive</option>
                </select>
                <a class="btn btncolor col-2 float-right p-2 d-inline-block" href="" data-toggle="modal"
                  data-target="#add"> <i class="fa fa-plus" aria-hidden="true"></i> New Service</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th> Discrption</th>
                      <th> Employee</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="row2">
                    @foreach($service as $ser)
                    <tr>
                      <input type="hidden" class="delete_id" value="{{$ser->ser_id}}">
                      <td>{{$ser->ser_id}}</td>
                      <td>{{$ser->ser_name}}</td>
                      <td>{{$ser->discrption}}</td>
                      <td>{{$ser->emp_first_name}} {{$ser->emp_middel_name}} {{$ser->emp_thired_name}}
                        {{$ser->emp_last_name}}</td>
                      @if($ser->is_active==1)
                      <td><span class="badge badge-success">Active</span></td>
                      @else
                      <td><span class="badge badge-danger">Deactive</span></td>
                      @endif

                      <td>
                        <a class="" href="{{ url('service/service-edit/'.$ser->ser_id) }}"><i
                            class="fas fa-pencil-alt text-primary "></i></a>
                        <a class=" deletebtn"><i class="fas fa-trash text-danger "></i></a>
              </div>
              @endforeach
              </tbody>

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

  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    let td = '';
    $("#dropselect").change(function () {

      console.log('jbwjebfjw');
      console.log($("#dropselect"));

      var id = $('#dropselect').val();
      console.log(id);
      $.ajax({
        url: "{{url('services')}}",
        data: { id: id },
        success: function (data) {
          console.log('sec');
          //console.log(data);

          $.each(JSON.parse(data), function (key, value) {
            if (value.length > 0) {
              for (var i = 0; i < value.length; i++) {
                console.log('value.length');
                console.log(value.length);
                if (value.length > 0) {
                  myJSON = JSON.parse(data);
                  if (value[i].is_active == 1) {
                    td += '<tr><input type="hidden" class="delete_id" value="' + value[i].ser_id + '"><td>' + value[i].ser_id + '</td><td>' + value[i].ser_name + '</td> <td>' + value[i].discrption + '</td><td>' + value[i].emp_first_name + ' ' + value[i].emp_middel_name + ' ' + value[i].emp_thired_name + ' ' + value[i].emp_last_name + '</td>   <td><span class="badge badge-success">Active</span></td><td><a  class="m-2" href="/service/service-edit/' + value[i].ser_id + '"><i class="fas fa-pencil-alt text-primary "></i></a> <a class="deletebtn m-2"><i class="fas fa-trash text-danger"></i></a></td></tr>';
                  }
                  else {
                    td += '<tr><input type="hidden" class="delete_id" value="' + value[i].ser_id + '"><td>' + value[i].ser_id + '</td><td>' + value[i].ser_name + '</td> <td>' + value[i].discrption + '</td><td>' + value[i].emp_first_name + ' ' + value[i].emp_middel_name + ' ' + value[i].emp_thired_name + ' ' + value[i].emp_last_name + '</td>   <td><span class="badge badge-danger">Deactive</span></td><td><a  class="m-2" href="/service/service-edit/' + value[i].ser_id + '"><i class="fas fa-pencil-alt text-primary"></i></a> <a  class="deletebtn m-2"><i class="fas fa-trash text-danger"></i></a></td></tr>';
                  }

                  $('.row2').html(td);
                }
              }
            }
            else {
              td = '<div class="txte-center">No Data</div>';
              $('.row2').html(td);
            }
            td = '';



          });
        },
        error: function () {
          console.log('err');
        }
      });
    });

    $("#add2").click(function () {
      var ser_name = $('#ser_name').val();
      var discrption = $('#discrption').val();
      var is_active = $('#is_active').val();
      console.log(ser_name);
      console.log(id);
      $.ajax({
        url: "{{url('service/insert')}}",
        data: { is_active: is_active, ser_name: ser_name, discrption: discrption },
        success: function (data) {
          console.log('sec');
          $('#add').remove();
          swal("Data Insert", {
            icon: "success",
          }).then((willDelete) => {
            location.reload();
          });
        },
        error: function () {
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
              url: '/service/service_delete/' + id,
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