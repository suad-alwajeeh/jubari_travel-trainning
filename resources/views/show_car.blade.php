@extends('app_layouts.master')
@section('main_content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Car Service</h1>
                </div>
                                           
<div class="col-6">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item"><a href="/service/sales_repo"> Services</a></li>
              <li class="breadcrumb-item active"> Car Services</li>

            </ol>
  </div>
  </br>
  </br>
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
                                <h3 class="card-title col-3  d-inline-block">CAR</h3>
                                <a class="btn btn-outline-primary so_form_btn" href="/service/car"> <i
                                        class="fa fa-plus" aria-hidden="true"></i> Add New Service</a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table id="datatable"
                                    class="table table-responsive table-hover text-nowrap text-center">


                                    <form method="post">
                                        @csrf

                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="selectall"></th>
                                                <th>ID</th>
                                                <th>Issue Date </th>
                                                <th> Refernce </th>
                                                <th>Passenger Name</th>
                                                <th>Voucher Number </th>
                                                <th>Car Info </th>
                                                <th>Car Status </th>
                                                <th>Supplier</th>
                                                <th>Supplier Cost</th>
                                                <th>Supplier Cuurency</th>
                                                <th>Passenger Cost </th>
                                                <th>Passenger Currency </th>
                                                <th>Remark</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row2">
                                            <?php $i=1 ?>

                                            @forelse($car as $cars)
                                            <tr>
                                                <td><input type="checkbox" name="ids[]" class="selectbox"
                                                        value="{{$cars->car_id }}"></td>

                                                <input type="hidden" class="delete_id" value="{{$cars->car_id}}">
                                                <td>
                                                    <?php echo $i;?>
                                                </td>
                                                <td>{{$cars->Issue_date }}</td>
                                                <td> {{$cars->refernce}} </td>
                                                <td>{{$cars->passenger_name}}</td>
                                                <td>{{$cars->voucher_number }}</td>
                                                <td>{{$cars->car_info}} </td>
                                                @if($cars->ses_status==1)
                                                <td>OK</td>
                                                @elseif($cars->ses_status==2)
                                                <td>Issue</td>
                                                @elseif($cars->ses_status==3)
                                                <td>Void</td>
                                                @elseif($cars->ses_status==4)
                                                <td>Refund</td>
                                                @endif
                                                <td>{{$cars->supplier_name}} </td>
                                                <td>{{$cars->provider_cost}} </td>
                                                <td>{{$cars->cur_name}}</td>
                                                <td>{{$cars->cost}} </td>
                                                <td> {{$cars->passnger_currency}} </td>
                                                <td>{{$cars->remark}} </td>
                                                <td>
                                                    @if($cars->service_status==1)

                                                    <a class="m-2 sendbtn"><i class="fa fa-paper-plane text-info"
                                                            aria-hidden="true"></i></a>
                                                    <a class="m-2" type="button"
                                                        href="{{ url('/service/update_car/'.$cars->car_id) }}"><i
                                                            class="fa fa-pencil-alt text-primary"
                                                            aria-hidden="true"></i></a>
                                                    <a class=" deletebtn "><i class="fas fa-trash text-danger "></i></a>
                                                    @endif

                                                </td>
                                            </tr>

                                        </tbody>
                                        <?php $i++ ?>


                                        @empty
                                        <tr>
                                            <td colspan="10">There is No data Pleas Add Service
                                            <td>
                                        </tr>
                                        @endforelse
                                        <tfoot>
                                            <tr>
                                                <button formaction="/deleteallcar" type="submit"
                                                    class="btn btn-danger float-left p-2 m-3">Delete All
                                                    Selected</button>
                                                <button formaction="/sendallcar" type="submit"
                                                    class="btn btncolor float-right p-2 m-3">Send All
                                                    Selected</button>
                                            </tr>
                                        </tfoot>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        {{$car->links()}}
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
</div>
<!-- /.container-fluid -->
<script>
    $('.selectall').click(function () {
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall2').prop('checked', $(this).prop('checked'));
    })

    $('.selectbox').change(function () {
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if (total == number) {
            $('.selectall').prop('checked', true);
            $('.selectall2').prop('checked', true);
        } else {
            $('.selectall').prop('checked', false);
            $('.selectall2').prop('checked', false);
        }
    })


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
                text: "Are You  Sure to delete this Ticket!",
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
                            url: '/service/car_delete/' + id,
                            data: data,
                            success: function (response) {
                                console.log(response);
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

        $('.sendbtn').click(function (e) {
            e.preventDefault();
            var id = $(this).closest("tr").find('.delete_id').val();
            console.log(id);

            //alert(id);
            swal({
                title: "Are you sure?",
                text: "Do you want send this Service!",
                icon: "success",
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
                            url: '/service/send_car/' + id,
                            data: data,
                            success: function (response) {
                                // cartdata=response;
                                //console.log('cartdata');
                                console.log(response[0]);

                                if (response[0] == '<') {
                                    swal("Send Successfully", {
                                        icon: "success",
                                    }).then((willDelete) => {
                                        location.reload();
                                    });
                                }
                                else {
                                    swal("upload file before", {
                                        icon: "error",
                                    }).then((willDelete) => {
                                        location.reload();
                                    });


                                }
                            }
                        });
                    }


                });
        });
        let td = '';

    });
</script>
@endsection