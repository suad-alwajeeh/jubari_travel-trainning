@extends('app_layouts.master')
@section('main_content')
<style>
.widget-user .widget-user-image > img {
    border: 3px solid #fff;
    height: 100px;
    width: 120px;
}
.colored{
  background-color: rgb(8, 2, 49) !important;

}
</style>

<div class="content-wrapper" >
<div class="row m-2">
<div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user ">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white colored" >
            <a class="btn  col-2 float-left p-2" href="{{url('/service/ticket')}}">  <i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                <h3 class="widget-user-username text-right">Ticket Service</h3>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('img/images/20945753.jpg')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$save_ticket}}</h5>
                      <a  href="{{url('/service/show_ticket/1') }}">
                      <span class="text-dark">Saved</span>
                    </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$sent_ticket}}</h5>
                      <a  href="{{url('/service/sent_ticket/2') }}">
                      <span class="text-dark">Sent</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$archev_ticket}}</h5>
                      <a  href="/excutive_finish/ticket/{{ Auth::user()->id }}">
                      <span class="text-dark">Archived</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
         

          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user ">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white colored" >
            <a class="btn  col-2 float-left p-2" href="{{url('/service/bus')}}">  <i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                <h3 class="widget-user-username text-right">Bus Service</h3>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('img/images/5282.jpg')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$save_bus}}</h5>
  <a  href="{{ url('/service/show_bus/1') }}">
                      <span class="text-dark">Saved</span></a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$sent_bus}}</h5>
  <a  href="{{ url('/service/sent_bus/2') }}">
                      <span class="text-dark">Sent</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$archev_bus}}</h5>
  <a  href="/excutive_finish/bus/{{ Auth::user()->id }}">
                      <span class="text-dark">Archived</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          
          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user ">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white colored" >
            <a class="btn  col-2 float-left p-2" href="{{url('/service/hotel')}}">  <i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                <h3 class="widget-user-username text-right">Hotel Service</h3>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('img/images/10811.jpg')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$save_hotel}}</h5>
  <a  href="{{ url('/service/show_hotel/1') }}">
                      <span class="text-dark">Saved</span>
                      </a>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$sent_hotel}}</h5>
  <a  href="{{ url('/service/sent_hotel/2') }}">
                      <span class="text-dark">Sent</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$archev_hotel}}</h5>
  <a  href="/excutive_finish/hotel/{{ Auth::user()->id }}">
                      <span class="text-dark">Archived</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
   </div>

   <div class="row m-2">
<div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user ">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white colored" >
            <a class="btn  col-2 float-left p-2" href="{{url('/service/visa')}}">  <i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                <h3 class="widget-user-username text-right">Visa Service</h3>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('img/images/11006.jpg')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$save_visa}}</h5>
  <a  href="{{ url('/service/show_visa/1') }}">
                      <span class="text-dark">Saved</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$sent_visa}}</h5>
  <a  href="{{ url('/service/sent_visa/2') }}">
                      <span class="text-dark">Sent</span>
                   </a> </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$archev_visa}}</h5>
  <a  href="/excutive_finish/visa/{{ Auth::user()->id }}">
                      <span class="text-dark">Archived</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
         

          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user ">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white colored" >
            <a class="btn  col-2 float-left p-2" href="{{url('/service/car')}}">  <i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                <h3 class="widget-user-username text-right">Car Service</h3>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('img/images/8655.jpg')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$save_car}}</h5>
  <a  href="{{ url('/service/show_car/1') }}">
                      <span class="text-dark">Saved</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$sent_car}}</h5>
  <a  href="{{ url('/service/sent_car/2') }}">
                      <span class="text-dark">Sent</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$archev_car}}</h5>
  <a  href="/excutive_finish/car/{{ Auth::user()->id }}">
                      <span class="text-dark">Archived</span>
                      </a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          
          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user ">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white colored" >
            <a class="btn  col-2 float-left p-2" href="{{url('/service/medical')}}">  <i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                <h3 class="widget-user-username text-right">Medical Service</h3>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('img/images/6301.jpg')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$save_med}}</h5>
  <a  href="{{ url('/service/show_medical/1') }}">
                      <span class="text-dark">Saved</span></a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$sent_med}}</h5>
  <a  href="{{ url('/service/sent_medical/2') }}">
                      <span class="text-dark">Sent</span></a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$archev_med}}</h5>
  <a  href="/excutive_finish/medical/{{ Auth::user()->id }}">
                      <span class="text-dark">Archived</span></a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
   </div>
   
   <div class="row m-2">
<div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user ">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white colored" >
            <a class="btn  col-2 float-left p-2" href="{{url('/service/general')}}">  <i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                <h3 class="widget-user-username text-right">General Service</h3>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('img/images/6340.jpg')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$save_service}}</h5>
  <a  href="{{ url('/service/show_general/1') }}">
                      <span class="text-dark">Saved</span></a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$sent_service}}</h5>
  <a  href="{{ url('/service/sent_general/2') }}">
                      <span class="text-dark">Sent</span></a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$archev_service}}</h5>
  <a  href="/excutive_finish/general/{{ Auth::user()->id }}">
                      <span class="text-dark ">Archived</span></a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div></div>
   </div>
    
@endsection