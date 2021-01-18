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
                            <a class="nav-link" href="reject_hotel" role="tab">Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reject_car" role="tab">Car</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reject_visa" role="tab">Visa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="true">Medical</a>
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
                                                    <th>ID</th>
                                                    <th>Issue Date </th>
                                                    <th> Refernce </th>
                                                    <th>Passenger Name</th>
                                                    <th>Report Status </th>
                                                    <th>From city </th>
                                                    <th>Document Number </th>
                                                    <th>Supplier</th>
                                                    <th>Supplier Cost</th>
                                                    <th>Supplier Cuurency</th>
                                                    <th>Employee Name</th>
                                                    <th>Passenger Cost </th>
                                                    <th>Passenger Currency </th>
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

                                                    <input type="hidden" class="id" value="{{$item->med_id}}">

                                                    <td> {{ $item->Issue_date}}</td>

                                                    <td> {{ $item->refernce}}</td>

                                                    <td> {{ $item->passenger_name}}</td>

                                                    @if($meds->report_status==1)
                                                <td>OK</td>
                                                @elseif($meds->report_status==2)
                                                <td>Issue</td>
                                                @elseif($meds->report_status==3)
                                                <td>Void</td>
                                                @elseif($meds->report_status==4)
                                                <td>Refund</td>
                                                @endif

                                                    <td> {{$item->from_city}}</td>

                                                    <td> {{$item->document_number}}</td>

                                                    <td> {{ $item->supplier_name}}</td>

                                                    <td> {{ $item->provider_cost}}</td>

                                                    <td> {{ $item->cur_id}}</td>

                                                    <td>{{$item->emp_first_name}} {{$item->emp_last_name}}</td>

                                                    <td> {{ $item->cost}}</td>

                                                    <td> {{ $item->passnger_currency}}</td>



                                                    <td>
                                                        <a class=" m-2" 
                                                            href="{{ url('/service/update_med/'.$item->med_id) }}"><i
                                                                class="fa fa-pencil-alt text-primary" aria-hidden="true"></i></a>
                                                        <a  class="m-2  deletebtn  "><i
                                                                class="fas fa-trash text-danger "></i></a>
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
                            url: '/service/med_delete/' + id,
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