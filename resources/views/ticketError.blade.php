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
              <a class="nav-link" href="/displaySalesManager/MedError" role="tab">Medical</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/displaySalesManager/GenError" role="tab">General</a>
            </li>
          </ul>
        </div>
      
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                      <tr>
                      <th>ID</th>
                        <th>Status</th>
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
                      <td><span class="badge badge-danger">In Progress</div></td>
 <td>
                          <?php echo $i;?>
                        </td>
                        @if($item->Dep_city2==null)
                        <td> One Way</td>
                        @else
                        <td> Rounded Way</td>
                        @endif

                        <td>{{$item->Issue_date }}</td>
                        <td> {{$item->refernce}} </td>
                        <td>{{$item->passenger_name}}</td>
                        <td>{{$item->airline_name}}</td>
                        <td>{{$item->ticket_number}} </td>
                        <td>{{$item->Dep_city}} </td>
                        <td> {{$item->dep_date}} </td>
                        <td> {{$item->arr_city}} </td>
                        @if($item->Dep_city2==null)
                        <td>--</td>
                        @else
                        <td> {{$item->Dep_city2}} </td>
                        @endif
                        @if($item->dep_date2==null)
                        <td>--</td>
                        @else
                        <td> {{$item->dep_date2}} </td>
                        @endif
                        @if($item->arr_city2==null)
                        <td>--</td>
                        @else
                        <td> {{$item->arr_city2}} </td>
                        @endif
                        @if($item->bursher_time==null)
                        <td>--</td>
                        @else
                        <td> {{$item->bursher_time}} </td>
                        @endif
                        <td>{{$item->supplier_name}} </td>
                        <td>{{$item->provider_cost}} </td>
                        <td>{{$item->cur_name}}</td>
                        <td>{{$item->cost}} </td>
                        <td> {{$item->passnger_currency}} </td>
                        @if($item->ticket_status==1)
                        <td>OK</td>
                        @endif
                       
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

</script>



@endsection