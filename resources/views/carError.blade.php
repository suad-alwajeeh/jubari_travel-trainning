@extends('app_layouts.master')
@section('main_content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container p-4">
    <!-- Main content -->
    <div class="col-12 ">
      <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/TicketError" role="tab">Ticket</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Buserror" role="tab">Bus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/HotelError" role="tab">Hotel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                aria-selected="true">Car</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/VisaError" role="tab">Via</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/MedError" role="tab">Medical</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/GenError" role="tab">General</a>
            </li>
          </ul>
        </div>
        <div class="card-body">

          <div class="tab-pane fade active show" id="custom-tabs-four-profile" role="tabpanel"
            aria-labelledby="custom-tabs-four-profile-tab">
            <div class="card">
              <div class="card-header border-transparent">
                <!--  start add Modal -->
                <div class="modal fade" id="add2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" action="" id="addForm">
                          @csrf
                          <div class="card-body">
                            <div class="form-group row">

                              <div class="col-md-12 m-2">

                                <input type="hidden" class="form-control" id="car_id" name="car_id">
                                <input type="hidden" class="form-control" id="Car_remark_id" name="remark_id" required>
                                <input type="hidden" class="form-control" id="Car_service_id" name="service_id"
                                  required>
                                <input type="hidden" class="form-control" id="Car_emp_id" name="emp_id" required>
                                <input type="hidden" class="form-control" id="voucher_number10" name="emp_id" required>

                                <input type="checkbox" name="remark[]" id="issue_date1" class="col-sm-1  d-inline-block"
                                  onclick="myFunction()"> Issue Date : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="issue_val" readonly>
                                <input type="text" class="form-control  col-11" style="display:none; width:100%"
                                  name="issue_date" value="null" id="issue_date" />
                              </div>
                              <div class="col-md-12 m-2">
                                <input type="checkbox" name="remark[]" value="issue_date" id="refernce2"
                                  onclick="myFunction2()"> Refernce : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="refernce_val"
                                  readonly>
                                <input type="text" class="form-control col-11 " style="display:none; width:100%"
                                  name="issue_date" id="refernce" value="null" />
                              </div>
                              <div class="col-md-12 m-2">
                                <input type="checkbox" name="remark[]" id="passenger_name2"
                                  onclick="myFunction3()">Passenger Name : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="passnger_name_val"
                                  readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="passenger_name" value="null" id="passenger_name" />


                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="voucher_number2"
                                  onclick="myFunction5()">Voucher Number : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="voucher_number_val"
                                  readonly>
                                <input type="text" class="form-control col-11 " style="display:none; width:100%"
                                  name="voucher_number" value="null" id="voucher_number3" />
                              </div>
                              <div class="col-md-12 m-2">


                                <input type="checkbox" name="remark[]" id="car_status2" onclick="myFunction4()"> Car
                                Status : <input class="form-control col-md-6 d-inline-block m-2" type="text"
                                  id="car_status_val" readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="car_status" value="null" id="car_status" />
                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="car_info2"
                                  onclick="myFunction9()">Info: <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="car_info_val"
                                  readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="car_info" value="null" id="car_info" />
                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="Dep_city2"
                                  onclick="myFunction6()">Dep City : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="Dep_city_val"
                                  readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="Dep_city" value="null" id="Dep_city" />
                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="arr_city2"
                                  onclick="myFunction7()">Arr City :<input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="arr_city_val"
                                  readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="arr_city" value="null" id="arr_city" />


                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="dep_date2"
                                  onclick="myFunction8()">Dep Date : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="dep_date_val"
                                  readonly>
                                <input type="text" class="form-control col-11 " style="display:none; width:100%"
                                  name="dep_date" value="null" id="dep_date" />
                              </div>

                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="due_to_supp2"
                                  onclick="myFunction10()">Provider Name: <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="supplier_name_val"
                                  readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="due_to_supp" value="null" id="due_to_supp" />
                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="provider_cost2"
                                  onclick="myFunction11()">Provider Cost: <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="provider_cost_val"
                                  readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="provider_cost" value="null" id="provider_cost" />


                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="cur_id2"
                                  onclick="myFunction12()"> Provider Currency : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="cur_name_val"
                                  readonly>
                                <input type="text" class="form-control col-11 " style="display:none; width:100%"
                                  name="cur_id" value="null" id="cur_id" />
                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="due_to_customer2"
                                  onclick="myFunction13()">Employee Name :<input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="employee2_val2"
                                  readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="due_to_customer" value="null" id="due_to_customer" />
                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="cost2"
                                  onclick="myFunction14()">Customer Cost :<input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="cost_val" readonly>
                                <input type="text" class="form-control col-11 " style="display:none; width:100%"
                                  name="cost" value="null" id="cost" />
                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="passnger_currency2"
                                  class="" onclick="myFunction15()">Customer Currency:<input
                                  class="form-control col-md-6 d-inline-block m-2" type="text"
                                  id="passnger_currency_val" readonly>
                                <input type="text" class="form-control col-11 " style="display:none; width:100%"
                                  name="passnger_currency" value="null" id="passnger_currency" />



                              </div>
                            </div>
                          </div>


                      </div>
                      <!-- /.card-body -->

                      <!-- /.card-footer -->
                      </form>
                      <div class="modal-footer">
                        <a href=""><button type="button" class="btn btn-secondary   m-3 p-2 float-left"
                            data-dismiss="modal">Close</button></a>
                        <a id="save"> <button type="button" class="btn btncolor m-3 p-2 float-right">Save
                            changes</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                      <tr>
                        <th>ID </th>
                        <th>Status </th>
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1 ?>
                      @foreach($data as $item)
                      <tr>
                   
                        <td>
                          <?php echo $i;?>
                        </td>
                        <td><span class="badge badge-danger">In Progress</div></td>
                        <td>{{$item->Issue_date }}</td>
                        <td> {{$item->refernce}} </td>
                        <td>{{$item->passenger_name}}</td>
                        <td>{{$item->voucher_number }}</td>
                        <td>{{$item->car_info}} </td>
                        @if($item->car_status==1)
                        <td>OK</td>
                        @endif
                        <td>{{$item->Dep_city}} </td>
                        <td> {{$item->arr_city}} </td>
                        <td> {{$item->dep_date}} </td>
                        <td>{{$item->supplier_name}} </td>
                        <td>{{$item->provider_cost}} </td>
                        <td>{{$item->cur_name}}</td>
                        <td>{{$item->emp_first_name}} {{$item->emp_middel_name}} {{$item->emp_thired_name}} {{$item->emp_lastst_name}}</d>
                        <td>{{$item->cost}} </td>
                        <td> {{$item->passnger_currency}} </td>
                        <td>{{$item->remark}} </td>

                       
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

@endsection