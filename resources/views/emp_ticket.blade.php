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
              <a  class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                aria-selected="true">Ticket</a>
            </li>
            
            <li class="nav-item">
              <a  class="nav-link" href="/emp_bus" role="tab">Bus</a>
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
              <a class="nav-link" href="/emp_gen" role="tab">General</a>
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
                        <th>Type</th>
                        <th>Issue Date </th>
                        <th> Refernce </th>
                        <th>Passenger Name</th>
                        <th>Airline Code</th>
                        <th>Ticket Number </th>
                        <th>Dept City </th>
                        <th> Dept Date </th>
                        <th> Arr City </th>
                        <th>Dept City2 </th>
                        <th> Dept Date2 </th>
                        <th> Arr City2 </th>
                        <th>Busher Time</th>
                        <th>Supplier</th>
                        <th>Supplier Cost</th>
                        <th>Supplier Cuurency</th>
                        <th>Employee Name </th>
                        <th>Passenger Cost </th>
                        <th>Passenger Currency </th>
                        <th>Ticket Status </th>
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
                        @if($item->Dep_city2==null)
                        <td> One Way</td>
                        @else
                        <td> Rounded Way</td>
                        @endif

                        <input type="hidden" class="id" value="{{$item->tecket_id}}">
                     
 <td> {{ $item->Issue_date}}</td>

 <td> {{ $item->refernce}}</td>
 
 <td> {{ $item->passenger_name}}</td>

 <td> {{ $item->airline_name}}</td>
 
 <td> {{ $item->ticket_number}}</td>
 
 <td> {{ $item->Dep_city}}</td>
 <td> {{ $item->dep_date}}</td> 
 <td> {{ $item->arr_city}}</td>
 
 
 <td> {{ $item->Dep_city2}}</td>
 <td> {{ $item->dep_date2}}</td>
 <td> {{ $item->arr_city2}}</td>
 <td> {{ $item->bursher_time}}</td>
 
 <td> {{ $item->supplier_name}}</td>

 <td> {{ $item->provider_cost}}</td>
 
 <td> {{ $item->cur_id}}</td>
 
 <td>{{$item->emp_first_name}} {{$item->emp_last_name}}</td>

 <td> {{ $item->cost}}</td>
 
 <td> {{ $item->passnger_currency}}</td>
 
 <td> OK</td>
  
 <td>
                              <a class="btn btncolor accept d-inline-block" type="button">Accept</a>                        
                              <a class="btn btncolor ignore  d-inline-block" type="button">Ignore</a>                        
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
              url: '/emp_ticket/accept/' + id,
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
              url: '/emp_ticket/ignore/' + id,
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