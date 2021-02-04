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
                    <h1> Outstanding Services</h1>
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
                            <a class="nav-link" href="/emp_ticket" role="tab">Ticket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/emp_bus" role="tab">Bus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/emp_hotel" role="tab">Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/emp_car" role="tab">Car</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/emp_visa" role="tab">Visa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/emp_med" role="tab">Medical</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="true">Genical</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">

                    <div class="tab-pane fade active show" id="custom-tabs-four-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-four-profile-tab">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <!--  start add Modal -->

                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Issue Date </th>
                                                    <th> Refernce </th>
                                                    <th>Passenger Name</th>
                                                    <th>General Status </th>
                                                    <th>Document Number </th>
                                                    <th>Offered Status </th>
                                                    <th>Info</th>
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
                                                    <td>
                                                        <?php echo $i;?>
                                                    </td>
                                                    <input type="hidden" class="id" value="{{$item->gen_id}}">

                                                    <td> {{ $item->Issue_date}}</td>

                                                    <td> {{ $item->refernce}}</td>

                                                    <td> {{ $item->passenger_name}}</td>

                                                    @if($item->general_status==1)
                                                <td>OK</td>
                                                @elseif($item->general_status==2)
                                                <td>Issue</td>
                                                @elseif($item->general_status==3)
                                                <td>Void</td>
                                                @elseif($item->general_status==4)
                                                <td>Refund</td>
                                                @endif

                                                    <td> {{ $item->voucher_number}}</td>
                                                    @if($item->ses_status==1)
                                                <td>OK</td>
                                                @elseif($item->ses_status==2)
                                                <td>Issue</td>
                                                @elseif($item->ses_status==3)
                                                <td>Void</td>
                                                @elseif($item->ses_status==4)
                                                <td>Refund</td>
                                                @endif                                                    <td> {{ $item->gen_info}}</td>
                                                    <td> {{ $item->supplier_name}}</td>
                                                    <td> {{ $item->provider_cost}}</td>
                                                    <td> {{ $item->cur_name}}</td>
                                                    <td> {{$item->emp_first_name}} {{$item->emp_last_name}}</td>
                                                    <td> {{ $item->cost}}</td>
                                                    <td> {{ $item->passnger_currency}}</td>
                                                    <td> {{$item->remark}}</td>

                                                    <td class="btn-group ">
                                                        <a  class="b_border btn btn-outline-success so_form_btn accept"
                                                            type="button">Accept</a>
                                                        <a class=" b_border ignore btn btn-outline-danger so_form_btn"
                                                            type="button">Ignore</a>
                                                    </td>
                                                </tr>
                                                <?php $i++ ?>
                                                @endforeach

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


        $('.accept').click(function (e) {
            e.preventDefault();
            var id = $(this).closest("tr").find('.id').val();
            console.log(id);

            swal({
                title: "Are you sure?",
                text: "Do you want accept this Service!",
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
                            url: '/emp_gen/accept/' + id,
                            data: data,
                            success: function (response) {

                                console.log(response[0]);
                                swal("Send Successfully", {
                                    icon: "success",
                                }).then((willDelete) => {
                                    location.reload();
                                });


                            }
                        });
                    }


                });
        });

        $('.ignore').click(function (e) {
            e.preventDefault();
            var id = $(this).closest("tr").find('.id').val();
            console.log(id);

            swal({
                title: "Are you sure?",
                text: "Do you want ignore this Service!",
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
                            url: '/emp_gen/ignore/' + id,
                            data: data,
                            success: function (response) {

                                console.log(response[0]);
                                swal("Send Successfully", {
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