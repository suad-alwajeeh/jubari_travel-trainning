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
              <a class="nav-link" href="/salesHotelLog" role="tab">Hotel</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/salesCarLog" role="tab">Car</a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                aria-selected="true">Visa</a>
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
                        <th>visa Info </th>
                        <th>visa Status </th>
                        <th>Visa Type </th>
                        <th> Country </th>
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
                        <input type="hidden" class="id" value="{{$item->visa_id}}">
                  
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
                        <td>{{$item->car_info}} </td>
                        @if($model=='voucher_number')
                        @if($val=='null')
                         <td> {{ $item->voucher_number}}</td>
                         @else
                         <td class="text-red"> {{ $item->voucher_number}}</td>
                         @endif
                         @endif


                         
                        @if($model=='visa_info')
                        @if($val=='null')
                         <td> {{ $item->visa_info}}</td>
                         @else
                         <td class="text-red"> {{ $item->visa_info}}</td>
                         @endif
                         @endif
                         
                         @if($model=='visa_status')
                        @if($val=='null')
                         <td>OK</td>
                         @else
                         <td class="text-red"> OK</td>
                         @endif
                         @endif

                         @if($model=='visa_type')
                        @if($val=='null')
                         <td> {{ $item->visa_type}}</td>
                         @else
                         <td class="text-red"> {{ $item->visa_type}}</td>
                         @endif
                         @endif
                        @if($model=='country')
                        @if($val=='null')
                         <td> {{ $item->country}}</td>
                         @else
                         <td class="text-red"> {{ $item->country}}</td>
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
                            href="{{ url('/sales/update_visa/'.$item->visa_id) }}"><i class="fa fa-pencil-alt"
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
              url: '/salesManager/visa_send/' + id,
              data: data,
              success: function (response) {
                // visatdata=response;
                //console.log('visatdata');
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