@extends('app_layouts.master')
@section('main_content')


<!-- Content Wrapper. Contains page content -->

<div class="col-12">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item"><a href="/service/sales_repo"> Services</a></li>
            </ol>
  </div>
  </br>
  </br>
<div class="content-wrapper">
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Reject Services</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container p-4">
        <!-- Main content -->
        <div class="col-12 ">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="/reject_ticket" role="tab">Ticket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reject_bus" role="tab">Bus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reject_hotel" role="tab">Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="true">Car</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reject_visa" role="tab">Visa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reject_med" role="tab">Medical</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reject_gen" role="tab">General</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">

                    <div class="tab-pane fade active show" id="custom-tabs-four-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-four-profile-tab">
                        <div class="card">
                            <div class="card-header border-transparent">

                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>ID </th>
                                                    <th>Issue Date </th>
                                                    <th> Refernce </th>
                                                    <th>Passenger Name</th>
                                                    <th>Voucher Number </th>
                                                    <th>Car Info </th>
                                                    <th>Car Status </th>
                                                    <th>Dept City </th>
                                                    <th> Arr City </th>
                                                    <th> Dept Date </th>
                                                    <th>Supplier</th>
                                                    <th>Supplier Cost</th>
                                                    <th>Supplier Cuurency</th>
                                                    <th>Employee Name</th>
                                                    <th>Passenger Cost </th>
                                                    <th>Passenger Currency </th>
                                                    <th>Remark</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1 ?>
                                                @forelse($data as $item)
                                                <tr>
                                                    <input type="hidden" class="id" value="{{$item->car_id}}">
                                                    <td>
                                                        <?php echo $i;?>
                                                    </td>
                                                    <td> {{ $item->Issue_date}}</td>
                                                    <td> {{ $item->refernce}}</td>
                                                    <td> {{ $item->passenger_name}}</td>
                                                    <td> {{ $item->car_info}}</td>
                                                    <td> {{ $item->voucher_number}}</td>
                                                    @if($item->ses_status==1)
                                                <td>OK</td>
                                                @elseif($item->ses_status==2)
                                                <td>Issue</td>
                                                @elseif($item->ses_status==3)
                                                <td>Void</td>
                                                @elseif($item->ses_status==4)
                                                <td>Refund</td>
                                                @endif
                                                    <td> {{ $item->Dep_city}}</td>
                                                    <td> {{ $item->arr_city}}</td>
                                                    <td> {{ $item->dep_date}}</td>
                                                    <td> {{ $item->supplier_name}}</td>
                                                    <td> {{ $item->provider_cost}}</td>
                                                    <td> {{ $item->cur_name}}</td>
                                                    <td>{{$item->emp_first_name}} {{$item->emp_last_name}}</td>
                                                    <td> {{ $item->cost}}</td>
                                                    <td> {{ $item->passnger_currency}}</td>
                                                    <td> {{$item->remark}}</td>

                                                    <?php $i++ ?>


                                                    <td>
                                                        <a class="m-2" 
                                                            href="{{ url('/service/update_car/'.$item->car_id) }}"><i
                                                                class="fa fa-pencil-alt text-primary" aria-hidden="true"></i></a>
                                                        <a class="m-2  deletebtn  "><i
                                                                class="fas fa-trash text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                <?php $i++ ?>
                                                @empty
                                        <tr>
                                            <td colspan="10">There is No data 
                                            <td>
                                        </tr>
                                        @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{$data->links()}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    </section>
</div>

<script>


    $(document).ready(function () {
        $('.deletebtn').click(function (e) {
            e.preventDefault();
            var id = $(this).closest("tr").find('.id').val();
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



    });
</script>



@endsection