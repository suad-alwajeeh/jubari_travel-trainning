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
              <a class="nav-link active" id="custom-tabs-four-profile-tab" data-toggle="pill"
                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                aria-selected="true">Hotel</a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="/displaySalesManager/CarError" role="tab">Car</a>
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
                        <th>ID </th>
                        <th>Status </th>
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
                        <td>{{$item->hotel_name}} </td>
                      
                        <td>{{$item->country}} </td>
                        <td> {{$item->city}} </td>
                        <td> {{$item->check_in}} </td>
                        <td> {{$item->check_out}} </td>
                        @if($item->hotel_status==1)
                        <td>OK</td>
                        @endif
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




@endsection