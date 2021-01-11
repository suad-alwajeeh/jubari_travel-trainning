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
            <a class="nav-link" href="/displaySalesManager" role="tab">Bus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/HotelError" role="tab">Hotel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/CarError" role="tab">Car</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/VisaError" role="tab">Via</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                aria-selected="true">Medical</a>
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

                                <input type="hidden" class="form-control" id="med_id" name="med_id">
                                <input type="hidden" class="form-control" id="med_remark_id" name="remark_id" required>
                                <input type="hidden" class="form-control" id="med_service_id" name="service_id"
                                  required>
                                <input type="hidden" class="form-control" id="med_emp_id" name="emp_id" required>
                                <input type="hidden" class="form-control" id="med_number10" name="emp_id" required>

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
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="med_number2"
                                  onclick="myFunction5()">Document Number : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="med_number_val"
                                  readonly>
                                <input type="text" class="form-control col-11 " style="display:none; width:100%"
                                  name="med_number" value="null" id="med_number3" />
                              </div>
                              <div class="col-md-12 m-2">


                                <input type="checkbox" name="remark[]" id="med_status2" onclick="myFunction4()"> Report
                                Status : <input class="form-control col-md-6 d-inline-block m-2" type="text"
                                  id="med_status_val" readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="med_status" value="null" id="med_status" />
                              </div>
                              <div class="col-md-12 m-2"> <input type="checkbox" name="remark[]" id="med_name2"
                                  onclick="myFunction9()">From City : <input
                                  class="form-control col-md-6 d-inline-block m-2" type="text" id="med_name_val"
                                  readonly>
                                <input type="text" class="form-control col-11" style="display:none; width:100%"
                                  name="med_name" value="null" id="med_name" />
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
                        <th>ID</th>
                        <th>Issue Date </th>
                        <th> Refernce </th>
                        <th>Passenger Name</th>
                        <th>From city </th>
                        <th>Document Number </th>
                        <th>Report Status </th>
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
                      @foreach($data as $item)
                      <tr>
                        <input type="hidden" class="med_number" value="{{$item->document_number}}">
                        <input type="hidden" class="id" value="{{$item->med_id}}">
                        <input type="hidden" class="emp_id" value="{{$item->emp_id}}">
                        <input type="hidden" class="service_id" value="{{$item->service_id}}">
                        <input type="hidden" class="issue_val2" value="{{$item->Issue_date}}">
                        <input type="hidden" class="refernce_val2" value="{{$item->refernce}}">
                        <input type="hidden" class="passenger_name_val2" value="{{$item->passenger_name}}">
                        <input type="hidden" class="med_status_val2" value="OK">
                        <input type="hidden" class="med_number_val2" value="{{$item->document_number}}">
                       <input type="hidden" class="med_name_val2" value="{{$item->from_city}}">
                        <input type="hidden" class="supplier_name_val2" value="{{$item->supplier_name}}">
                        <input type="hidden" class="provider_cost_val2" value="{{$item->provider_cost}}">
                        <input type="hidden" class="cur_name_val2" value="{{$item->cur_name}}">
                        <input type="hidden" class="employee_val2"
                          value="{{$item->emp_first_name}} {{$item->emp_middel_name}} {{$item->emp_thired_name}} {{$item->emp_lastst_name}}">
                        <input type="hidden" class="cost_val2" value="{{$item->cost}}">
                        <input type="hidden" class="passnger_currency_val2" value="{{$item->passnger_currency}}">
                        <input type="hidden" class="remark_id" value="{{Auth::user()->id}}">
                        <td>
                          <?php echo $i;?>
                        </td>

                        <td>{{$item->Issue_date }}</td>
                        <td> {{$item->refernce}} </td>
                        <td>{{$item->passenger_name}}</td>
                        <td>{{$item->from_city}}</td>
                        <td>{{$item->document_number}} </td>
                        @if($item->report_status==1)
                        <td>OK</td>
                        @endif
                      
                        <td>{{$item->supplier_name}} </td>
                        <td>{{$item->provider_cost}} </td>
                        <td>{{$item->cur_name}}</td>
                        <td>{{$item->emp_first_name}} {{$item->emp_middel_name}} {{$item->emp_thired_name}} {{$item->emp_lastst_name}}</td>
                        <td>{{$item->cost}} </td>
                        <td> {{$item->passnger_currency}} </td>
                        <td>{{$item->remark}} </td>

                        <td>
                          <a class="btn sendbtn btncolor text-white"><i class="fa fa-paper-plane"
                              aria-hidden="true"></i></a>
                          <a class="btn btncolor text-white add"> <i class="fas fa-exclamation-triangle"></i></a>
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

  function myFunction() {
    var checkBox = document.getElementById("issue_date1");
    var text = document.getElementById("issue_date");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = '';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction2() {
    var checkBox = document.getElementById("refernce2");
    var text = document.getElementById("refernce");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = '';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction3() {
    var checkBox = document.getElementById("passenger_name2");
    var text = document.getElementById("passenger_name");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction4() {
    var checkBox = document.getElementById("med_status2");
    var text = document.getElementById("med_status");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction5() {
    var checkBox = document.getElementById("med_number2");
    var text = document.getElementById("med_number3");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction6() {
    var checkBox = document.getElementById("Dep_city2");
    var text = document.getElementById("Dep_city");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction7() {
    var checkBox = document.getElementById("arr_city2");
    var text = document.getElementById("arr_city");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction8() {
    var checkBox = document.getElementById("dep_date2");
    var text = document.getElementById("dep_date");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction9() {
    var checkBox = document.getElementById("med_name2");
    var text = document.getElementById("med_name");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction10() {
    var checkBox = document.getElementById("due_to_supp2");
    var text = document.getElementById("due_to_supp");
    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction11() {
    var checkBox = document.getElementById("provider_cost2");
    var text = document.getElementById("provider_cost");
    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }
  function myFunction12() {
    var checkBox = document.getElementById("cur_id2");
    var text = document.getElementById("cur_id");
    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }

  function myFunction13() {
    var checkBox = document.getElementById("due_to_customer2");
    var text = document.getElementById("due_to_customer");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  } function myFunction14() {
    var checkBox = document.getElementById("cost2");
    var text = document.getElementById("cost");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  } function myFunction15() {
    var checkBox = document.getElementById("passnger_currency2");
    var text = document.getElementById("passnger_currency");

    if (checkBox.checked == true) {
      text.style.display = "block";
      text.value = ' ';
    } else {
      text.style.display = "none";
      text.value = 'null';
    }
  }

  $(document).ready(function () {


    //med
    $(".add").click(function () {
      var id = $(this).closest("tr").find('.id').val();
      var emp_id = $(this).closest("tr").find('.emp_id').val();
      var service_id = $(this).closest("tr").find('.service_id').val();
      var remark_id = $(this).closest("tr").find('.remark_id').val();
      var med_number = $(this).closest("tr").find('.med_number').val();
      var issue_val = $(this).closest("tr").find('.issue_val2').val();
      var refernce_val2 = $(this).closest("tr").find('.refernce_val2').val();
      var passenger_name_val2 = $(this).closest("tr").find('.passenger_name_val2').val();
      var med_status_val2 = $(this).closest("tr").find('.med_status_val2').val();
      var Dep_city_val2 = $(this).closest("tr").find('.Dep_city_val2').val();
      var med_number_val2 = $(this).closest("tr").find('.med_number_val2').val();
      var arr_city_val2 = $(this).closest("tr").find('.arr_city_val2').val();
      var dep_date_val2 = $(this).closest("tr").find('.dep_date_val2').val();
      var med_name_val2 = $(this).closest("tr").find('.med_name_val2').val();
      var supplier_name_val2 = $(this).closest("tr").find('.supplier_name_val2').val();
      var provider_cost_val2 = $(this).closest("tr").find('.provider_cost_val2').val();
      var cur_name_val2 = $(this).closest("tr").find('.cur_name_val2').val();
      var cost_val2 = $(this).closest("tr").find('.cost_val2').val();
      var employee_val2 = $(this).closest("tr").find('.employee_val2').val();
      var passnger_currency_val2 = $(this).closest("tr").find('.passnger_currency_val2').val();
      console.log('issue_val');
      console.log(issue_val);
      $('#med_id').val(id);
      $('#med_emp_id').val(emp_id);
      $('#med_service_id').val(service_id);
      $('#med_remark_id').val(remark_id);
      $('#med_number').val(med_number);
      $('#med_number10').val(med_number);
      $('#issue_val').val(issue_val);
      $('#passnger_name_val').val(passenger_name_val2);
      $('#refernce_val').val(refernce_val2);
      $('#med_status_val').val(med_status_val2);
      $('#med_number_val').val(med_number_val2);
      $('#med_name_val').val(med_name_val2);
      $('#supplier_name_val').val(supplier_name_val2);
      $('#provider_cost_val').val(provider_cost_val2);
      $('#cur_name_val').val(cur_name_val2);
      $('#employee2_val2').val(employee_val2);
      $('#cost_val').val(cost_val2);
      $('#passnger_currency_val').val(passnger_currency_val2);
      $('#add2').modal('show');

    });

    $("#save").click(function () {
      console.log('save');
      var med_id = $('#med_id').val();
      var emp_id = $('#med_emp_id').val();
      var remark_id = $('#med_remark_id').val();
      var remark_body = $('#remark_body').val();
      var service_id = $('#med_service_id').val();
      var issue_date = $('#issue_date').val();
      var refernce = $('#refernce').val();
      var passenger_name = $('#passenger_name').val();
      var med_status = $('#med_status').val();
      var med_number3 = $('#med_number3').val();
    
      var med_name = $('#med_name').val();
      var due_to_supp = $('#due_to_supp').val();
      var provider_cost = $('#provider_cost').val();
      var cur_id = $('#cur_id').val();
      var due_to_customer = $('#due_to_customer').val();
      var cost = $('#cost').val();
      var passnger_currency = $('#passnger_currency').val();
      
      var remark_body = {
        'issue_date': issue_date,
        'refernce': refernce,
        'passenger_name': passenger_name,
        'report_status': med_status,
        'document_number': med_number3,
        'med_name': med_name,
        'due_to_supp': due_to_supp,
        'provider_cost': provider_cost,
        'cur_id': cur_id,
        'due_to_customer': due_to_customer,
        'cost': cost,
        'passnger_currency': passnger_currency

      }
      console.log('mycheck');
      console.log(remark_body);
      var med_id = $('#med_id').val();
      var emp_id = $('#med_emp_id').val();
      var remark_id = $('#med_remark_id').val();
      var service_id = $('#med_service_id').val();
      var med_number10 = $('#med_number10').val();
      console.log('med_id');
      console.log(med_id);
      $.ajax({
        url: "{{url('/displaySalesManager/saved_med')}}",
        data: { remark_body: remark_body, med_id: med_id, emp_id: emp_id, remark_id: remark_id, service_id: service_id, med_number10: med_number10 },
        success: function (data) {
          console.log('sec');
          $('#add').remove();
          swal("Send Secussful", {
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

    $('.sendbtn').click(function (e) {
      e.preventDefault();
      var id = $(this).closest("tr").find('.id').val();
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
              url: '/salesManager/med_send/' + id,
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


  });
</script>



@endsection