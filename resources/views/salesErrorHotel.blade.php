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
              <a class="nav-link" href="/salesTicketLog" role="tab">Ticket</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/salesBusLog" role="tab">Bus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                aria-selected="true">Hotel</a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="/salesCarLog" role="tab">Car</a>
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
                        <th>ID </th>
                        <th>Issue Date </th>
                        <th> Refernce </th>
                        <th>Passenger Name</th>
                        <th>Voucher Number </th>
                        <th>Hotel Name </th>
                        <th> Country </th>
                        <th>City </th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Hotel Status </th>
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
   
  @if($model=='voucher_number')
@if($val=='null')
 <td> {{ $item->voucher_number}}</td>
 @else
 <td class="text-red"> {{ $item->voucher_number}}</td>
 @endif
 @endif
 @if($model=='hotel_name')
@if($val=='null')
 <td> {{ $item->hotel_name}}</td>
 @else
 <td class="text-red"> {{ $item->hotel_name}}</td>
 @endif
 @endif 

 @if($model=='country')
@if($val=='null')
 <td> {{ $item->country}}</td>
 @else
 <td class="text-red"> {{ $item->country}}</td>
 @endif
 @endif


  @if($model=='city')
@if($val=='null')
 <td> {{ $item->city}}</td>
 @else
 <td class="text-red"> {{ $item->city}}</td>
 @endif
 @endif 

 @if($model=='check_in')
@if($val=='null')
 <td> {{ $item->check_in}}</td>
 @else
 <td class="text-red"> {{ $item->check_in}}</td>
 @endif
 @endif 

 @if($model=='check_out')
@if($val=='null')
 <td> {{ $item->check_out}}</td>
 @else
 <td class="text-red"> {{ $item->check_out}}</td>
 @endif
 @endif 
@if($model=='hotel_status')
@if($val=='null')
 <td> OK</td>
 @else
 <td class="text-red"> OK</td>
 @endif
 @endif
                       
                        @if($model=='due_to_supp')
                        @if($val=='null')
                         <td> {{ $item->supplier_name}}</td>
                         @else
                         <td class="text-red"> {{ $item->supplier_name}}</td>
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
                         <td> {{$item->emp_first_name}} {{$item->emp_last_name}}</td>
                         @else
                         <td class="text-red"> {{$item->emp_first_name}} {{$item->emp_last_name}}</td>
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
                        
                              <a class="btn btncolor" type="button"
                            href="{{ url('/sales/update_hotel/'.$item->hotel_id) }}"><i class="fa fa-pencil-alt"
                              aria-hidden="true"></i></a>                        </td>
                      </tr>
                      <?php $i++ ?>

                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.hoteld-body -->
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
              url: '/salesManager/hotel_send/' + id,
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