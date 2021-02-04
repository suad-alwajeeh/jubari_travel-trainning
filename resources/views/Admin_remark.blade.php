@extends('app_layouts.master')
@section('main_content')


<!-- Content Wrapper. Contains page content -->

<div class="col-12 ">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item active ">  Services Status</li>
            </ol>
  </div>
  </br>
  </br>
 
<div class="content-wrapper">
    <div class="container p-4">
        <!-- Main content -->
        <div class="col-12 ">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-home-tab" data-toggle="pill"
                                href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                aria-selected="false">Ticket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="true">Bus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                                aria-selected="false">Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings"
                                aria-selected="false">Car</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-visa-tab" data-toggle="pill"
                                href="#custom-tabs-four-visa" role="tab" aria-controls="custom-tabs-four-settings"
                                aria-selected="false">Via</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-med-tab" data-toggle="pill"
                                href="#custom-tabs-four-med" role="tab" aria-controls="custom-tabs-four-settings"
                                aria-selected="false">Medical</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-gen-tab" data-toggle="pill"
                                href="#custom-tabs-four-gen" role="tab" aria-controls="custom-tabs-four-settings"
                                aria-selected="false">General</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">

                        <div class="tab-pane fade" id="custom-tabs-four-home" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <!--  start add Modal -->
                                    <div class="modal fade" id="addTicket2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" method="get" id="addFormticket">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Add Remark
                                                                    :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                        id="ticket_remark_body" name="remark_body"
                                                                        required placeholder="Remark ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="ticket_id" name="id" required
                                                                        placeholder="Department Name ">
                                                                        <input type="hidden" class="form-control"
                                                                        id="ticket_number" name="id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control remark_id"
                                                                        id="ticket_remark_id" name="remark_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control service_id"
                                                                        id="ticket_service_id" name="service_id"
                                                                        required placeholder="Department Name emp_id">
                                                                    <input type="hidden" class="form-control"
                                                                        id="ticket_emp_id" name="emp_id" required
                                                                        placeholder="Department Name ">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- /.card-body -->

                                                        <!-- /.card-footer -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href=""><button type="button"
                                                            class="btn btn-secondary   m-3 p-2 float-left"
                                                            data-dismiss="modal">Close</button></a>
                                                    <a href="" id="saveTicket"> <button type="button"
                                                            class="btn btncolor m-3 p-2 float-right">Save
                                                            changes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add model-->
                                    <h3 class="card-title">Latest Ticket Service</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>Issue Date </th>
                                                    <th>Ticket Number </th>
                                                    <th>Refernce</th>
                                                    <th>Employee Name</th>
                                                    <th>Status</th>
                                                    <th>Send Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ticket as $item)
                                                <tr>
                                                    <input type="hidden" class="id" value="{{$item->tecket_id}}">
                                                    <input type="hidden" class="ticket_number" value="{{$item->ticket_number}}">
                                                    <input type="hidden" class="emp_id" value="{{$item->emp_id}}">
                                                    <input type="hidden" class="service_id"
                                                        value="{{$item->service_id}}">
                                                    <input type="hidden" class="remark_id" value="{{Auth::user()->id}}">
                                                    <td>{{$item->Issue_date}}</td>
                                                    <td>{{$item->ticket_number}}</td>
                                                    <td>{{$item->refernce}}</td>
                                                    <td>{{$item->emp_first_name}}</td>
                                                    @if($item->service_status==1)

                                                    <td><span class="badge badge-danger">Sales Excutive</span></td>
                                                    @elseif($item->service_status==2)
                                                    <td><span class="badge badge-warning">Sales Manager</span></td>
                                                    @elseif($item->service_status==3)
                                                    <td><span class="badgebadge-info">Accountant Manager</span>
                                                    </td>
                                                    @else
                                                    <td><span class="badge badge-primary">Archived</span></td>
                                                    @endif
                                                    <td>
                                                        <a class="btn btncolor text-white addTicket"> <i
                                                                class="fa fa-plus" aria-hidden="true"></i>Remark</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{$ticket->links()}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade active show" id="custom-tabs-four-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <!--  start add Modal -->
                                    <div class="modal fade" id="add2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="" id="addForm">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Add Remark
                                                                    :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                        name="remark_body" required id="remark_body"
                                                                        placeholder="Remark">
                                                                    <input type="hidden" class="form-control" id="bus_id"
                                                                        name="bus_id">
                                                                        <input type="hidden" class="form-control"
                                                                        id="bus_number" name="id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="bus_remark_id" name="remark_id" required>
                                                                    <input type="hidden" class="form-control"
                                                                        id="bus_service_id" name="service_id" required>
                                                                    <input type="hidden" class="form-control"
                                                                        id="bus_emp_id" name="emp_id" required>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- /.card-body -->

                                                        <!-- /.card-footer -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href=""><button type="button"
                                                            class="btn btn-secondary   m-3 p-2 float-left"
                                                            data-dismiss="modal">Close</button></a>
                                                    <a href="" id="save"> <button type="button"
                                                            class="btn btncolor m-3 p-2 float-right">Save
                                                            changes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add model-->
                                    <h3 class="card-title">Latest Bus Service</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>Bus Name </th>
                                                    <th>Bus Number </th>
                                                    <th>Refernce</th>
                                                    <th>Employee Name</th>
                                                    <th>Status</th>
                                                    <th>Send Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $item)
                                                <tr>
                                                    <input type="hidden" class="bus_number" value="{{$item->bus_number}}">
                                                    <input type="hidden" class="id" value="{{$item->bus_id}}">
                                                    <input type="hidden" class="emp_id" value="{{$item->emp_id}}">
                                                    <input type="hidden" class="service_id"
                                                        value="{{$item->service_id}}">
                                                    <input type="hidden" class="remark_id" value="{{Auth::user()->id}}">
                                                    <td>{{$item->bus_name}}</td>
                                                    <td>{{$item->bus_number}}</td>
                                                    <td>{{$item->refernce}}</td>
                                                    <td>{{$item->emp_first_name}}</td>
                                                    @if($item->service_status==1)

                                                    <td><span class="badge badge-danger">Sales Excutive</span></td>
                                                    @elseif($item->service_status==2)
                                                    <td><span class="badge badge-warning">Sales Manager</span></td>
                                                    @elseif($item->service_status==3)
                                                    <td><span class="badge badge-info">Accountant Manager</span>
                                                    </td>
                                                    @else
                                                    <td><span class="badge badge-primary">Archived</span></td>
                                                    @endif
                                                    <td>
                                                        <a class="btn btncolor text-white add"> <i class="fa fa-plus"
                                                                aria-hidden="true"></i>Remark</a>
                                                    </td>
                                                </tr>
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
                        <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                            aria-labelledby="custom-tabs-four-messages-tab">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <!--  start add Modal -->
                                    <div class="modal fade" id="addHotel2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" method="get" id="addFormHotel">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Add Remark
                                                                    :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                        id="hotel_remark_body" name="remark_body"
                                                                                                required placeholder="Remark ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="hotel_id" name="bus_id" required
                                                                        placeholder="Department Name ">
                                                                        <input type="hidden" class="form-control"
                                                                        id="hotel_voucher_number" name="bus_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="hotel_remark_id" name="remark_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="hotel_service_id" name="service_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="hotel_emp_id" name="emp_id" required
                                                                        placeholder="Department Name ">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- /.card-body -->

                                                        <!-- /.card-footer -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href=""><button type="button"
                                                            class="btn btn-secondary   m-3 p-2 float-left"
                                                            data-dismiss="modal">Close</button></a>
                                                    <a href="" id="saveHotel"> <button type="button"
                                                            class="btn btncolor m-3 p-2 float-right">Save
                                                            changes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add model-->
                                    <h3 class="card-title">Latest Hotel Service</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>Hotel Name </th>
                                                    <th> Country </th>
                                                    <th>Refernce</th>
                                                    <th>Employee Name</th>
                                                    <th>Status</th>
                                                    <th>Send Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($hotel as $item)
                                                <tr>
                                         
                                                    <input type="hidden" class="id" value="{{$item->hotel_id}}">
                                                    <input type="hidden" class="hotel_voucher_number" value="{{$item->voucher_number}}">
                                                    <input type="hidden" class="emp_id" value="{{$item->emp_id}}">
                                                    <input type="hidden" class="service_id"
                                                        value="{{$item->service_id}}">
                                                    <input type="hidden" class="remark_id" value="{{Auth::user()->id}}">
                                                    <td>{{$item->hotel_name}}</td>
                                                    <td>{{$item->country}}</td>
                                                    <td>{{$item->refernce}}</td>
                                                    <td>{{$item->emp_first_name}}</td>
                                                    @if($item->service_status==1)

                                                    <td><span class="badge badge-danger">Sales Excutive</span></td>
                                                    @elseif($item->service_status==2)
                                                    <td><span class="badge badge-warning">Sales Manager</span></td>
                                                    @elseif($item->service_status==3)
                                                    <td><span class="badge badge-warning">Accountant Manager</span>
                                                    </td>
                                                    @else
                                                    <td><span class="badge badge-primary">Archived</span></td>
                                                    @endif
                                                    <td>
                                                        <a class="btn btncolor text-white addHotel"> <i
                                                                class="fa fa-plus" aria-hidden="true"></i>Remark</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{$hotel->links()}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                            aria-labelledby="custom-tabs-four-settings-tab">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <!--  start add Modal -->
                                    <div class="modal fade" id="addCar2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" method="get" id="addFormCar">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Add Remark
                                                                    :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                        id="car_remark_body" name="remark_body" required
                                                                        placeholder="Remark ">
                                                                        <input type="hidden" class="form-control"
                                                                        id="car_voucher_number" name="bus_id" required
                                                                        placeholder="Department Name ">
                                                                     <input type="hidden" class="form-control" id="car_id"
                                                                        name="bus_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="car_remark_id" name="remark_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="car_service_id" name="service_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control" id="car_emp_id"
                                                                        name="emp_id" required
                                                                        placeholder="Department Name ">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- /.card-body -->

                                                        <!-- /.card-footer -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href=""><button type="button"
                                                            class="btn btn-secondary   m-3 p-2 float-left"
                                                            data-dismiss="modal">Close</button></a>
                                                    <a href="" id="saveCar"> <button type="button"
                                                            class="btn btncolor m-3 p-2 float-right">Save
                                                            changes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add model-->
                                    <h3 class="card-title">Latest Car Service</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th> Issue Date </th>
                                                    <th>Voucher Number </th>
                                                    <th>Refernce</th>
                                                    <th>Employee Name</th>
                                                    <th>Status</th>
                                                    <th>Send Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($car as $item)
                                                <tr>
                           
                                                                    
                                                    <input type="hidden" class="id" value="{{$item->car_id}}">
                                                    <input type="hidden" class="car_voucher_number" value="{{$item->voucher_number}}">
                                                    <input type="hidden" class="emp_id" value="{{$item->emp_id}}">
                                                    <input type="hidden" class="service_id"
                                                        value="{{$item->service_id}}">
                                                    <input type="hidden" class="remark_id" value="{{Auth::user()->id}}">
                                                    <td>{{$item->Issue_date}}</td>
                                                    <td>{{$item->voucher_number}}</td>
                                                    <td>{{$item->refernce}}</td>
                                                    <td>{{$item->emp_first_name}}</td>
                                                    @if($item->service_status==1)

                                                    <td><span class="badge badge-danger">Sales Excutive</span></td>
                                                    @elseif($item->service_status==2)
                                                    <td><span class="badge badge-warning">Sales Manager</span></td>
                                                    @elseif($item->service_status==3)
                                                    <td><span class="badgebadge-info">Accountant Manager</span>
                                                    </td>
                                                    @else
                                                    <td><span class="badge badge-primary">Archived</span></td>
                                                    @endif
                                                    <td>
                                                        <a class="btn btncolor text-white addCar"> <i
                                                                class="fa fa-plus" aria-hidden="true"></i>Remark</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{$car->links()}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-visa" role="tabpanel"
                            aria-labelledby="custom-tabs-four-visa-tab">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <!--  start add Modal -->
                                    <div class="modal fade" id="addVisa2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" method="get" id="addFormVisa">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Add Remark
                                                                    :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                        id="visa_remark_body" name="remark_body" required
                                                                        placeholder="Remark ">
                                                                    <input type="hidden" class="form-control" id="visa_id"
                                                                        name="bus_id" required
                                                                        placeholder="Department Name ">
                                                                        <input type="hidden" class="form-control"
                                                                        id="visa_voucher_number" name="bus_id" required
                                                                        placeholder="Department Name "> <input type="hidden" class="form-control"
                                                                        id="visa_remark_id" name="remark_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="visa_service_id" name="service_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control" id="visa_emp_id"
                                                                        name="emp_id" required
                                                                        placeholder="Department Name ">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- /.card-body -->

                                                        <!-- /.card-footer -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href=""><button type="button"
                                                            class="btn btn-secondary   m-3 p-2 float-left"
                                                            data-dismiss="modal">Close</button></a>
                                                    <a href="" id="saveVisa"> <button type="button"
                                                            class="btn btncolor m-3 p-2 float-right">Save
                                                            changes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add model-->
                                    <h3 class="card-title">Latest Visa Service</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th> Issue Date </th>
                                                    <th>Voucher Number </th>
                                                    <th>Refernce</th>
                                                    <th>Employee Name</th>
                                                    <th>Status</th>
                                                    <th>Send Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($visa as $item)
                                                <tr>
                                                    <input type="hidden" class="id" value="{{$item->visa_id}}">
                                                    <input type="hidden" class="visa_voucher_number" value="{{$item->voucher_number}}">
                                                   <input type="hidden" class="emp_id" value="{{$item->emp_id}}">
                                                    <input type="hidden" class="service_id"
                                                        value="{{$item->service_id}}">
                                                    <input type="hidden" class="remark_id" value="{{Auth::user()->id}}">
                                                    <td>{{$item->Issue_date}}</td>
                                                    <td>{{$item->voucher_number}}</td>
                                                    <td>{{$item->refernce}}</td>
                                                    <td>{{$item->emp_first_name}}</td>
                                                    @if($item->service_status==1)

                                                    <td><span class="badge badge-danger">Sales Excutive</span></td>
                                                    @elseif($item->service_status==2)
                                                    <td><span class="badge badge-warning">Sales Manager</span></td>
                                                    @elseif($item->service_status==3)
                                                    <td><span class="badgebadge-info">Accountant Manager</span>
                                                    </td>
                                                    @else
                                                    <td><span class="badge badge-primary">Archived</span></td>
                                                    @endif
                                                    <td>
                                                        <a class="btn btncolor text-white addVisa"> <i
                                                                class="fa fa-plus" aria-hidden="true"></i>Remark</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{$visa->links()}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-med" role="tabpanel"
                            aria-labelledby="custom-tabs-four-med-tab">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <!--  start add Modal -->
                                    <div class="modal fade" id="addMed2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" id="addFormMed">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Add Remark
                                                                    :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                        id="med_remark_body" name="remark_body" required
                                                                        placeholder="Remark ">
                                                                    <input type="hidden" class="form-control" id="med_id"
                                                                        name="bus_id" required
                                                                        placeholder="Department Name ">
                                                                        <input type="hidden" class="form-control"
                                                                        id="document_number">     
                                                                         <input type="hidden" class="form-control"
                                                                        id="med_remark_id" name="remark_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="med_service_id" name="service_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control" id="med_emp_id"
                                                                        name="emp_id" required
                                                                        placeholder="Department Name ">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- /.card-body -->

                                                        <!-- /.card-footer -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href=""><button type="button"
                                                            class="btn btn-secondary   m-3 p-2 float-left"
                                                            data-dismiss="modal">Close</button></a>
                                                    <a href="" id="saveMed"> <button type="button"
                                                            class="btn btncolor m-3 p-2 float-right">Save
                                                            changes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add model-->
                                    <h3 class="card-title">Latest Medical Service</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th> Issue Date </th>
                                                    <th>Document Number </th>
                                                    <th>Refernce</th>
                                                    <th>Employee Name</th>
                                                    <th>Status</th>
                                                    <th>Send Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($med as $item)
                                                <tr>
                                               
                                                    <input type="hidden" class="id" value="{{$item->med_id}}">
                                                    <input type="hidden" class="document_number" value="{{$item->document_number}}">
                                                    <input type="hidden" class="emp_id" value="{{$item->emp_id}}">
                                                    <input type="hidden" class="service_id"
                                                        value="{{$item->service_id}}">
                                                    <input type="hidden" class="remark_id" value="{{Auth::user()->id}}">
                                                    <td>{{$item->Issue_date}}</td>
                                                    <td>{{$item->document_number}}</td>
                                                    <td>{{$item->refernce}}</td>
                                                    <td>{{$item->emp_first_name}}</td>
                                                    @if($item->service_status==1)

                                                    <td><span class="badge badge-danger">Sales Excutive</span></td>
                                                    @elseif($item->service_status==2)
                                                    <td><span class="badge badge-warning">Sales Manager</span></td>
                                                    @elseif($item->service_status==3)
                                                    <td><span class="badgebadge-info">Accountant Manager</span>
                                                    </td>
                                                    @else
                                                    <td><span class="badge badge-primary">Archived</span></td>
                                                    @endif
                                                    <td>
                                                        <a class="btn btncolor text-white addMed"> <i class="fa fa-plus"
                                                                aria-hidden="true"></i>Remark</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{$med->links()}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-gen" role="tabpanel"
                            aria-labelledby="custom-tabs-four-gen-tab">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <!--  start add Modal -->
                                    <div class="modal fade" id="addGen2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="get" class="form-horizontal" id="addFormGen">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Add Remark
                                                                    :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                        id="gen_remark_body" name="remark_body" required
                                                                        placeholder="Remark ">
                                                                        <input type="hidden" class="form-control"
                                                                        id="med_voucher_number" name="bus_id" required
                                                                        placeholder="Department Name ">                      <input type="hidden" class="form-control" id="gen_id"
                                                                        name="" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="gen_remark_id" name="remark_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control"
                                                                        id="gen_service_id" name="service_id" required
                                                                        placeholder="Department Name ">
                                                                    <input type="hidden" class="form-control" id="gen_emp_id"
                                                                        name="emp_id" required
                                                                        placeholder="Department Name ">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- /.card-body -->

                                                        <!-- /.card-footer -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href=""><button type="button"
                                                            class="btn btn-secondary   m-3 p-2 float-left"
                                                            data-dismiss="modal">Close</button></a>
                                                    <a href="" id="saveGen"> <button type="button"
                                                            class="btn btncolor m-3 p-2 float-right">Save
                                                            changes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end add model-->
                                    <h3 class="card-title">Latest General Service</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th> Issue Date </th>
                                                    <th>Voucher Number </th>
                                                    <th>Refernce</th>
                                                    <th>Employee Name</th>
                                                    <th>Status</th>
                                                    <th>Send Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($gen as $item)
                                                <tr> 
                                                    <input type="hidden" class="id" value="{{$item->gen_id}}">
                                                    <input type="hidden" class="med_voucher_number" value="{{$item->voucher_number}}">
                                                    <input type="hidden" class="emp_id" value="{{$item->emp_id}}">
                                                    <input type="hidden" class="service_id"
                                                        value="{{$item->service_id}}">
                                                    <input type="hidden" class="remark_id" value="{{Auth::user()->id}}">
                                                    <td>{{$item->Issue_date}}</td>
                                                    <td>{{$item->voucher_number}}</td>
                                                    <td>{{$item->refernce}}</td>
                                                    <td>{{$item->emp_first_name}}</td>
                                                    @if($item->service_status==1)

                                                    <td><span class="badge badge-danger">Sales Excutive</span></td>
                                                    @elseif($item->service_status==2)
                                                    <td><span class="badge badge-warning">Sales Manager</span></td>
                                                    @elseif($item->service_status==3)
                                                    <td><span class="badgebadge-info">Accountant Manager</span>
                                                    </td>
                                                    @else
                                                    <td><span class="badge badge-primary">Archived</span></td>
                                                    @endif
                                                    <td>
                                                        <a class="btn btncolor text-white addGen"> <i class="fa fa-plus"
                                                                aria-hidden="true"></i>Remark</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{$gen->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
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

        console.log('inscript');

        $(document).ready(function () {
            //bus
            $(".add").click(function () {
                var id = $(this).closest("tr").find('.id').val();
                var emp_id = $(this).closest("tr").find('.emp_id').val();
                var service_id = $(this).closest("tr").find('.service_id').val();
                var remark_id = $(this).closest("tr").find('.remark_id').val();
                var bus_number = $(this).closest("tr").find('.bus_number').val();

                console.log('id');
                console.log(id);
                console.log(remark_id);
                console.log(service_id);
                console.log(emp_id);

                $('#bus_id').val(id);
                $('#bus_emp_id').val(emp_id);
                $('#bus_service_id').val(service_id);
                $('#bus_remark_id').val(remark_id);
                $('#bus_number').val(bus_number);
                $('#add2').modal('show');

            });

            $("#save").click(function () {
                var bus_id = $('#bus_id').val();
                var emp_id = $('#bus_emp_id').val();
                var remark_id = $('#bus_remark_id').val();
                var remark_body = $('#remark_body').val();
                var service_id = $('#bus_service_id').val();
                var bus_number = $('#bus_number').val();
                // console.log('remark_body');
                // console.log(remark_body);
                console.log('service_id');
                console.log(service_id);
                console.log('remark_id');
                console.log(remark_id);
                console.log('emp_id');
                console.log(emp_id);
                $.ajax({
                    url: "{{url('dashboard/addBusRemark')}}",
                    data: { bus_id:bus_id, emp_id:emp_id, remark_id:remark_id, remark_body: remark_body,service_id: service_id,bus_number:bus_number },
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

            //ticket

            $(".addTicket").click(function () {
                var id = $(this).closest("tr").find('.id').val();
                var emp_id = $(this).closest("tr").find('.emp_id').val();
                var service_id = $(this).closest("tr").find('.service_id').val();
                var remark_id = $(this).closest("tr").find('.remark_id').val();
                var ticket_number = $(this).closest("tr").find('.ticket_number').val();
                $('#ticket_id').val(id);
                $('#ticket_emp_id').val(emp_id);
                $('#ticket_service_id').val(service_id);
                $('#ticket_remark_id').val(remark_id);
                $('#ticket_number').val(ticket_number);
                $('#addTicket2').modal('show');

            });

            $("#saveTicket").click(function () {
                var ticket_id = $('#ticket_id').val();
                var ticket_emp_id = $('#ticket_emp_id').val();
                var ticket_remark_id = $('#ticket_remark_id').val();
                var ticket_remark_body = $('#ticket_remark_body').val();
                var ticket_service_id = $('#ticket_service_id').val();
                var ticket_number = $('#ticket_number').val();
                console.log('id');
                console.log(ticket_id);
                // console.log(ticket_emp_id);
                // console.log(ticket_remark_id);
                // console.log(ticket_remark_body);
                $.ajax({
                    url: "{{url('dashboard/addTicketRemark')}}",
                    data: { ticket_id: ticket_id, ticket_emp_id: ticket_emp_id, ticket_remark_id: ticket_remark_id, ticket_remark_body: ticket_remark_body, ticket_service_id: ticket_service_id,ticket_number:ticket_number },
                    success: function (data) {
                        console.log('sec');
                        $('#addTicket').remove();
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

            //hotel

            $(".addHotel").click(function () {
                var hotel_id = $(this).closest("tr").find('.id').val();
                var emp_id = $(this).closest("tr").find('.emp_id').val();
                var service_id = $(this).closest("tr").find('.service_id').val();
                var remark_id = $(this).closest("tr").find('.remark_id').val();
                var hotel_voucher_number = $(this).closest("tr").find('.hotel_voucher_number').val();
console.log(hotel_id);
               
                $('#hotel_id').val(hotel_id);
                $('#hotel_emp_id').val(emp_id);
                $('#hotel_service_id').val(service_id);
                $('#hotel_remark_id').val(remark_id);
                $('#hotel_voucher_number').val(hotel_voucher_number);
                $('#addHotel2').modal('show');

            });

            $("#saveHotel").click(function () {
                var hotel_id = $('#hotel_id').val();
                var hotel_emp_id = $('#hotel_emp_id').val();
                var hotel_remark_id = $('#hotel_remark_id').val();
                var hotel_remark_body = $('#hotel_remark_body').val();
                var hotel_service_id = $('#hotel_service_id').val();
                var hotel_voucher_number = $('#hotel_voucher_number').val();

                $.ajax({
                    url: "{{url('dashboard/addHotelRemark')}}",
                    data: { hotel_id: hotel_id, hotel_emp_id: hotel_emp_id, hotel_remark_id: hotel_remark_id, hotel_remark_body: hotel_remark_body, hotel_service_id: hotel_service_id,hotel_voucher_number:hotel_voucher_number },
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

            //car

            $(".addCar").click(function () {
                var car_id = $(this).closest("tr").find('.id').val();
                var emp_id = $(this).closest("tr").find('.emp_id').val();
                var service_id = $(this).closest("tr").find('.service_id').val();
                var remark_id = $(this).closest("tr").find('.remark_id').val();
                var car_voucher_number = $(this).closest("tr").find('.car_voucher_number').val();

                

                $('#car_id').val(car_id);
                $('#car_emp_id').val(emp_id);
                $('#car_service_id').val(service_id);
                $('#car_remark_id').val(remark_id);
                $('#car_voucher_number').val(car_voucher_number);
                $('#addCar2').modal('show');

            });

            $("#saveCar").click(function () {
                var car_id = $('#car_id').val();
                var car_emp_id = $('#car_emp_id').val();
                var car_remark_id = $('#car_remark_id').val();
                var car_remark_body = $('#car_remark_body').val();
                var car_service_id = $('#car_service_id').val();
                var car_voucher_number = $('#car_voucher_number').val();

                $.ajax({
                    url: "{{url('dashboard/addCarRemark')}}",
                    data: { car_id: car_id, car_emp_id: car_emp_id, car_remark_id: car_remark_id, car_remark_body: car_remark_body, car_service_id: car_service_id,car_voucher_number:car_voucher_number },
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


            //visa

            $(".addVisa").click(function () {
                var visa_id = $(this).closest("tr").find('.id').val();
                var emp_id = $(this).closest("tr").find('.emp_id').val();
                var service_id = $(this).closest("tr").find('.service_id').val();
                var remark_id = $(this).closest("tr").find('.remark_id').val();
                var visa_voucher_number = $(this).closest("tr").find('.visa_voucher_number').val();
console.log(visa_id);

                $('#visa_id').val(visa_id);
                $('#visa_emp_id').val(emp_id);
                $('#visa_service_id').val(service_id);
                $('#visa_remark_id').val(remark_id);
                $('#visa_voucher_number').val(visa_voucher_number);
                $('#addVisa2').modal('show');

            });

            $("#saveVisa").click(function () {
                var visa_id = $('#visa_id').val();
                var visa_emp_id = $('#visa_emp_id').val();
                var visa_remark_id = $('#visa_remark_id').val();
                var visa_remark_body = $('#visa_remark_body').val();
                var visa_service_id = $('#visa_service_id').val();
                var visa_voucher_number = $('#visa_voucher_number').val();

                $.ajax({
                    url: "{{url('dashboard/addVisaRemark')}}",
                    data: { visa_id: visa_id, visa_emp_id: visa_emp_id, visa_remark_id: visa_remark_id,visa_remark_body: visa_remark_body, visa_service_id: visa_service_id,visa_voucher_number:visa_voucher_number },
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

            //hotel

            $(".addMed").click(function () {
                var med_id = $(this).closest("tr").find('.id').val();
                var emp_id = $(this).closest("tr").find('.emp_id').val();
                var service_id = $(this).closest("tr").find('.service_id').val();
                var remark_id = $(this).closest("tr").find('.remark_id').val();
                var document_number = $(this).closest("tr").find('.document_number').val();
console.log(med_id);
               
                $('#med_id').val(med_id);
                $('#med_emp_id').val(emp_id);
                $('#med_service_id').val(service_id);
                $('#med_remark_id').val(remark_id);
                $('#document_number').val(document_number);
                $('#addMed2').modal('show');

            });

            $("#saveMed").click(function () {
                var med_id = $('#med_id').val();
                var med_emp_id = $('#med_emp_id').val();
                var med_remark_id = $('#med_remark_id').val();
                var med_remark_body = $('#med_remark_body').val();
                var med_service_id = $('#med_service_id').val();
                var document_number = $('#document_number').val();
                console.log('med_id');
                console.log(med_service_id);

                $.ajax({
                    url: "{{url('dashboard/addMedRemark')}}",
                    data: { med_id: med_id, med_emp_id: med_emp_id,med_remark_id:med_remark_id, med_remark_body:med_remark_body, med_service_id:med_service_id,document_number:document_number },
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
            
            //hotel

            $(".addGen").click(function () {
                var gen_id = $(this).closest("tr").find('.id').val();
                var emp_id = $(this).closest("tr").find('.emp_id').val();
                var service_id = $(this).closest("tr").find('.service_id').val();
                var remark_id = $(this).closest("tr").find('.remark_id').val();
                var gen_voucher_number = $(this).closest("tr").find('.gen_voucher_number').val();
console.log(gen_id);
    
                $('#gen_id').val(gen_id);
                $('#gen_emp_id').val(emp_id);
                $('#gen_service_id').val(service_id);
                $('#gen_remark_id').val(remark_id);
                $('#gen_voucher_number').val(gen_voucher_number);
                $('#addGen2').modal('show');

            });

            $("#saveGen").click(function () {
                var gen_id = $('#gen_id').val();
                var gen_emp_id = $('#gen_emp_id').val();
                var gen_remark_id = $('#gen_remark_id').val();
                var gen_remark_body = $('#gen_remark_body').val();
                var gen_service_id = $('#gen_service_id').val();
                var gen_voucher_number = $('#gen_voucher_number').val();

                $.ajax({
                    url: "{{url('dashboard/addGenRemark')}}",
                    data: { gen_id: gen_id,gen_emp_id: gen_emp_id,gen_remark_id: gen_remark_id, gen_remark_body: gen_remark_body, gen_service_id: gen_service_id,gen_voucher_number:gen_voucher_number },
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


        });
    </script>



    @endsection