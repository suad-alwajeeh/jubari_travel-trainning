
@extends('app_layouts.master')
@section('main_content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">General Reports</h1>
          </div><!-- /.col -->
       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$data}}</h3>

                <p>Active Services</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ url('/service_test') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$data1}}</sup></h3>

                <p>Disactive Services</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ url('/service_test') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$data2}}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('/user_display') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$data2}}</h3>

                <p>Messages</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('/user_display') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
          
          <div class="row">
              
                <div class="col-md-4">
                     <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ticket Services</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           

                    <div class="progress-group">
                      in Sales Executive
                      <span class="float-right"><b>{{$ticket1}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 90%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      in Sales Manager
                      <span class="float-right"><b>{{$ticket2}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">in Accountant</span>
                      <span class="float-right"><b>{{$ticket3}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar  bg-warning" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Archived
                      <span class="float-right"><b>{{$ticket4}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 10%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
             
              <!-- /.footer -->
            </div>
            <!-- /.card -->
                </div>
                <div class="col-md-4">
                     <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bus Services</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           

                    <div class="progress-group">
                      in Sales Executive
                      <span class="float-right"><b>{{$bus1}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 90%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      in Sales Manager
                      <span class="float-right"><b>{{$bus2}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">in Accountant</span>
                      <span class="float-right"><b>{{$bus3}}</b></span>
                      <div class="progress progress-sm">
                      <div class="progress-bar  bg-warning" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Archived
                      <span class="float-right"><b>{{$bus4}}</b></span>
                      <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 10%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
             
              <!-- /.footer -->
            </div>
            <!-- /.card -->
                </div>
              
                <div class="col-md-4">
                     <div class="card">
              <div class="card-header">
                <h3 class="card-title">Hotel Services</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           

                    <div class="progress-group">
                      in Sales Executive
                      <span class="float-right"><b>{{$hotel1}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 90%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      in Sales Manager
                      <span class="float-right"><b>{{$hotel2}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">in Accountant</span>
                      <span class="float-right"><b>{{$hotel3}}</b></span>
                      <div class="progress progress-sm">
                      <div class="progress-bar  bg-warning" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Archived
                      <span class="float-right"><b>{{$hotel4}}</b></span>
                      <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 10%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
             
              <!-- /.footer -->
            </div>
            <!-- /.card -->
                </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
        <div class="row">
              
                <div class="col-md-4">
                     <div class="card">
              <div class="card-header">
                <h3 class="card-title">Visa Services</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           

                    <div class="progress-group">
                      in Sales Executive
                      <span class="float-right"><b>{{$visa1}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 90%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      in Sales Manager
                      <span class="float-right"><b>{{$visa2}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">in Accountant</span>
                      <span class="float-right"><b>{{$visa3}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar  bg-warning" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Archived
                      <span class="float-right"><b>{{$visa4}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 10%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
             
              <!-- /.footer -->
            </div>
            <!-- /.card -->
                </div>
                <div class="col-md-4">
                     <div class="card">
              <div class="card-header">
                <h3 class="card-title">Car Services</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           

                    <div class="progress-group">
                      in Sales Executive
                      <span class="float-right"><b>{{$car1}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 90%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      in Sales Manager
                      <span class="float-right"><b>{{$car2}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">in Accountant</span>
                      <span class="float-right"><b>{{$car3}}</b></span>
                      <div class="progress progress-sm">
                      <div class="progress-bar  bg-warning" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Archived
                      <span class="float-right"><b>{{$car4}}</b></span>
                      <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 10%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
             
              <!-- /.footer -->
            </div>
            <!-- /.card -->
                </div>
              
                <div class="col-md-4">
                     <div class="card">
              <div class="card-header">
                <h3 class="card-title">Medical Services</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           

                    <div class="progress-group">
                      in Sales Executive
                      <span class="float-right"><b>{{$med1}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 90%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      in Sales Manager
                      <span class="float-right"><b>{{$med2}}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">in Accountant</span>
                      <span class="float-right"><b>{{$med3}}</b></span>
                      <div class="progress progress-sm">
                      <div class="progress-bar  bg-warning" style="width: 10%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Archived
                      <span class="float-right"><b>{{$med4}}</b></span>
                      <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 10%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
             
              <!-- /.footer -->
            </div>
            <!-- /.card -->
                </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
        <div class="row">
              
              <div class="col-md-4">
                   <div class="card">
            <div class="card-header">
              <h3 class="card-title">General Services</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
         

                  <div class="progress-group">
                    in Sales Executive
                    <span class="float-right"><b>{{$gen1}}</b></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 90%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    in Sales Manager
                    <span class="float-right"><b>{{$gen2}}</b></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 10%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">in Accountant</span>
                    <span class="float-right"><b>{{$gen3}}</b></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar  bg-warning" style="width: 10%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Archived
                    <span class="float-right"><b>{{$gen4}}</b></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 10%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
           
            <!-- /.footer -->
          </div>
          <!-- /.card -->
              </div>
              
              
      </div>
      <!-- /.row -->
      <div class="row">
      <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Users</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach($data4 as $item)
                  <li class="item">
                    <div class="product-info">
                      <a href="#" class="product-title">{{$item->name}}</a>
                      <span class="product-description">
                       {{$item->email}}
                      </span>
                    </div>
                  </li>
                  @endforeach
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{ url('/user_display') }}" class="uppercase">View All Users</a>
              </div>
              <!-- /.card-footer -->
            </div>
              </div>
      </div>
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
  @endsection
