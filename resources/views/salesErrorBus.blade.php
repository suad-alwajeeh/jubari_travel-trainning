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
              <a class="nav-link" href="salesTicketLog" role="tab">Ticket</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                aria-selected="true">Bus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/salesHotelLog" role="tab">Hotel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/salesCarLog" role="tab">Car</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/salesVisaLog" role="tab">Visa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/salesMedLog" role="tab">Medical</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/salesGenLog" role="tab">General</a>
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
                        <th>Bus Status </th>
                        <th>Bus Number </th>
                        <th>Bus Name </th>
                        <th>Dept City </th>
                        <th> Arr City </th>
                        <th> Dept Date </th>
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
                      @foreach($data as $item)
                      <tr>
                       
                        <input type="hidden" class="id" value="{{$item->bus_id}}">
                       
                        <td>
                          <?php echo $i;?>
                        </td>
                        
                        @foreach(json_decode($item->remark_body) as $model=>$val)
                       @if($model=='issue_date')
                        @if($val=='null')
                         <td> {{ $item->Issue_date}}</td>
                         @else
                         <td class="text-red"> {{ $item->Issue_date}}</td>
                         @endif
                         @endif
                         
                         @if($model=='refernce')
                        @if($val=='null')
                         <td> {{ $item->refernce}}</td>
                         @else
                         <td class="text-red"> {{ $item->refernce}}</td>
                         @endif
                         @endif

                         @if($model=='passenger_name')
                        @if($val=='null')
                         <td> {{ $item->passenger_name}}</td>
                         @else
                         <td class="text-red"> {{ $item->passenger_name}}</td>
                         @endif
                         @endif
                       

                         @if($model=='bus_name')
                        @if($val=='null')
                         <td> {{ $item->bus_name}}</td>
                         @else
                         <td class="text-red"> {{ $item->bus_name}}</td>
                         @endif
                         @endif

                         @if($model=='bus_number')
                        @if($val=='null')
                         <td> {{ $item->bus_number}}</td>
                         @else
                         <td class="text-red"> {{ $item->bus_number}}</td>
                         @endif
                         @endif
                         
                        @if($model=='bus_status')
                        @if($val=='null')
                         <td> OK</td>
                         @else
                         <td class="text-red"> OK</td>
                         @endif
                         @endif

                         @if($model=='Dep_city')
                        @if($val=='null')
                         <td> {{ $item->Dep_city}}</td>
                         @else
                         <td class="text-red"> {{ $item->Dep_city}}</td>
                         @endif
                         @endif

                         @if($model=='arr_city')
                        @if($val=='null')
                         <td> {{ $item->arr_city}}</td>
                         @else
                         <td class="text-red"> {{ $item->arr_city}}</td>
                         @endif
                         @endif
                         @if($model=='dep_date')
                        @if($val=='null')
                         <td> {{ $item->dep_date}}</td>
                         @else
                         <td class="text-red"> {{ $item->dep_date}}</td>
                         @endif
                         @endif

                         @if($model=='due_to_supp')
                        @if($val=='null')
                         <td> {{ $item->due_to_supp}}</td>
                         @else
                         <td class="text-red"> {{ $item->due_to_supp}}</td>
                         @endif
                         @endif


                         @if($model=='provider_cost')
                        @if($val=='null')
                         <td> {{ $item->provider_cost}}</td>
                         @else
                         <td class="text-red"> {{ $item->provider_cost}}</td>
                         @endif
                         @endif

                         @if($model=='cur_id')
                        @if($val=='null')
                         <td> {{ $item->cur_id}}</td>
                         @else
                         <td class="text-red"> {{ $item->cur_id}}</td>
                         @endif
                         @endif


                         @if($model=='due_to_customer')
                        @if($val=='null')
                         <td> {{ $item->due_to_customer}}</td>
                         @else
                         <td class="text-red"> {{ $item->due_to_customer}}</td>
                         @endif
                         @endif

                         @if($model=='cost')
                        @if($val=='null')
                         <td> {{ $item->cost}}</td>
                         @else
                         <td class="text-red"> {{ $item->cost}}</td>
                         @endif
                         @endif

                         @if($model=='passnger_currency')
                        @if($val=='null')
                         <td> {{ $item->passnger_currency}}</td>
                         @else
                         <td class="text-red"> {{ $item->passnger_currency}}</td>
                         @endif
                         @endif


  @endforeach
                    
                      
                        <td>
                          <a class="btn sendbtn btncolor text-white"><i class="fa fa-paper-plane"
                              aria-hidden="true"></i></a>
                              <a class="btn btncolor" type="button"
                            href="{{ url('/sales/update_bus/'.$item->bus_id) }}"><i class="fa fa-pencil-alt"
                              aria-hidden="true"></i></a>                        </td>
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



  $(document).ready(function () {


    $("#save").click(function () {
      console.log('save');
      var bus_id = $('#bus_id').val();
      var emp_id = $('#bus_emp_id').val();
      var remark_id = $('#bus_remark_id').val();
      var remark_body = $('#remark_body').val();
      var service_id = $('#bus_service_id').val();
      var issue_date = $('#issue_date').val();
      var refernce = $('#refernce').val();
      var passenger_name = $('#passenger_name').val();
      var bus_status = $('#bus_status').val();
      var bus_number = $('#bus_number3').val();
      var Dep_city = $('#Dep_city').val();
      var arr_city = $('#arr_city').val();
      var dep_date = $('#dep_date').val();
      var bus_name = $('#bus_name').val();
      var due_to_supp = $('#due_to_supp').val();
      var provider_cost = $('#provider_cost').val();
      var cur_id = $('#cur_id').val();
      var due_to_customer = $('#due_to_customer').val();
      var cost = $('#cost').val();
      var passnger_currency = $('#passnger_currency').val();
      // console.log('remark_body');
      // console.log(remark_body);
      var remark_body = {
        'issue_date': issue_date,
        'refernce': refernce,
        'passenger_name': passenger_name,
        'bus_status': bus_status,
        'bus_number': bus_number,
        'Dep_city': Dep_city,
        'arr_city': arr_city,
        'dep_date': dep_date,
        'bus_name': bus_name,
        'due_to_supp': due_to_supp,
        'provider_cost': provider_cost,
        'cur_id': cur_id,
        'due_to_customer': due_to_customer,
        'cost': cost,
        'passnger_currency': passnger_currency

      }
      console.log('mycheck');
      console.log(remark_body);
      var bus_id = $('#bus_id').val();
      var emp_id = $('#bus_emp_id').val();
      var remark_id = $('#bus_remark_id').val();
      var service_id = $('#bus_service_id').val();
      var bus_number10 = $('#bus_number10').val();
      $.ajax({
        url: "{{url('/displaySalesManager/saved')}}",
        data: { remark_body: remark_body, bus_id: bus_id, emp_id: emp_id, remark_id: remark_id, service_id: service_id, bus_number10: bus_number10 },
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
              url: '/salesManager/bus_send/' + id,
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