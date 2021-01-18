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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
    <section class="content-header bg-white">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Hotel Service</h1>
                </div>
                              
<div class="col-6">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item"><a href="/service/show_hotel/1"> Hotel</a></li>
              <li class="breadcrumb-item active">Sent Hotel Services</li>

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
                                <h3 class="card-title col-3  d-inline-block">HOTEL</h3>
                                <a class="btn btn-outline-primary so_form_btn" href="/service/hotel"> <i
                                        class="fa fa-plus" aria-hidden="true"></i> Add New Service</a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table id="datatable"
                                    class="table table-responsive table-hover text-nowrap text-center">


                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Issue Date </th>
                                            <th> Refernce </th>
                                            <th>Passenger Name</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>Hotel Name</th>
                                            <th>Check In Date </th>
                                            <th>Check Out Date </th>
                                            <th>Voucher Number </th>
                                            <th>Hotel Status </th>
                                            <th>Supplier</th>
                                            <th>Supplier Cost</th>
                                            <th>Supplier Cuurency</th>
                                            <th>Passenger Cost </th>
                                            <th>Passenger Currency </th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row2">
                                        <?php $i=1 ?>
                                        @forelse($hotel as $hotels)
                                        <tr>
                                            <input type="hidden" class="delete_id" value="{{$hotels->hotel_id}}">
                                            <td>
                                                <?php echo $i;?>
                                            </td>
                                            <td>{{$hotels->Issue_date }}</td>
                                            <td> {{$hotels->refernce}} </td>
                                            <td>{{$hotels->passenger_name}}</td>
                                            <td>{{$hotels->country}}</td>
                                            <td>{{$hotels->city}}</td>
                                            <td>{{$hotels->hotel_name}}</td>
                                            <td>{{$hotels->check_in}}</td>
                                            <td>{{$hotels->check_out}}</td>
                                            <td>{{$hotels->voucher_number }}</td>
                                            @if($hotels->hotel_status==1)
                                            <td>OK</td>
                                            @elseif($hotels->hotel_status==2)
                                            <td>Issue</td>
                                            @elseif($hotels->hotel_status==3)
                                            <td>Void</td>
                                            @elseif($hotels->hotel_status==4)
                                            <td>Refund</td>
                                            @endif

                                            <td>{{$hotels->supplier_name}} </td>
                                            <td>{{$hotels->provider_cost}} </td>
                                            <td>{{$hotels->cur_name}}</td>
                                            <td>{{$hotels->cost}} </td>
                                            <td> {{$hotels->passnger_currency}} </td>
                                            <td>{{$hotels->remark}} </td>
                                            <td>
                                                @if($hotels->service_status==1)

                                                <a type="button" class="btn sendbtn btncolor text-white"><i
                                                        class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                                <a class="btn btncolor" type="button"
                                                    href="{{ url('/service/update_hotel/'.$hotels->hotel_id) }}"><i
                                                        class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                                                <a type="button" class="btn  deletebtn btncolor text-white"><i
                                                        class="fas fa-trash "></i></a>
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


                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        {{$hotel->links()}}
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
</div>
<!-- /.container-fluid -->
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
                text: "Are You  Sure to delete this Service!",
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
                            url: '/service/hotel_delete/' + id,
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
                text: "Do you want send this Ticket!",
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
                            url: '/service/send_hotel/' + id,
                            data: data,
                            success: function (response) {
                                // hoteltdata=response;
                                //console.log('hoteltdata');
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


    });
</script>
@endsection