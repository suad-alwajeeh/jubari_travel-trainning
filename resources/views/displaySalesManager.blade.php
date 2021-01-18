@extends('app_layouts.master')
@section('main_content')

 
  <!-- Content Wrapper. Contains page content -->
  
<div class="col-12">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item"><a href="/sales">Sales Manager</a></li>
            </ol>
  </div>
  </br>
  </br>
  <div class="content-wrapper">
  <div class="container p-4">
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <h5 class="mb-2">     </h5>
        
        <div class="row">
        <div class="col-md-6 col-sm-12 col-12">
            <div class="info-box">
              <span class="info-box-icon su_icon"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">ticket service</span>
                <div class="row">
                <a class="btn btn-info su_acc_btn" href="/sales_review/ticket">review
                  <span>
                    @foreach($tic1 as $t1)
                    {{$t1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/sales_finish/ticket/{{ Auth::user()->id }}">finished
                <span>
                    @foreach($tic2 as $t2)
                    {{$t2->finish}}
                    @endforeach
                  </span>
</a>
              </div>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-12 col-12">
            <div class="info-box">
              <span class="info-box-icon su_icon"><i class="far fa-flag" ></i></span>
              <div class="info-box-content">
                <span class="info-box-text">car service</span>
                <div class="row">
                <a class="btn btn-info su_acc_btn" href="/sales_review/car">review
                  <span>
                    @foreach($car1 as $c1)
                    {{$c1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/sales_finish/car/{{ Auth::user()->id }}">finished
                <span>
                    @foreach($car2 as $c2)
                    {{$c2->finish}}
                    @endforeach
                  </span>
                </a>
              </div>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-12 col-12">
            <div class="info-box">
              <span class="info-box-icon su_icon"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">bus service</span>
                <div class="row">
                <a class="btn btn-info su_acc_btn" href="/sales_review/bus">review
                  <span>
                    @foreach($bus1 as $b1)
                    {{$b1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/sales_finish/bus/{{ Auth::user()->id }}">finished
                <span>
                    @foreach($bus2 as $b2)
                    {{$b2->finish}}
                    @endforeach
                  </span>
                </a>
              </div>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-12 col-12">
            <div class="info-box">
              <span class="info-box-icon su_icon"><i class="far fa-flag "></i></span>
              <div class="info-box-content">
                <span class="info-box-text">medical service</span>
                <div class="row">
                <a class="btn btn-info su_acc_btn" href="/sales_review/medical">review
                  <span>
                    @foreach($med1 as $m1)
                    {{$m1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/sales_finish/medical/{{ Auth::user()->id }}">finished
                <span>
                    @foreach($med2 as $m2)
                    {{$m2->finish}}
                    @endforeach
                  </span>
                </a>
              </div>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-12 col-12">
            <div class="info-box">
              <span class="info-box-icon su_icon"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">visa service</span>
                <div class="row">
                <a class="btn btn-info su_acc_btn" href="/sales_review/visa">review
                  <span>
                    @foreach($vis1 as $v1)
                    {{$v1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/sales_finish/visa/{{ Auth::user()->id }}">finished
                <span>
                    @foreach($vis2 as $v2)
                    {{$v2->finish}}
                    @endforeach
                  </span>
                </a>
              </div>
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-12 col-12">
            <div class="info-box">
              <span class="info-box-icon su_icon"><i class="far fa-flag "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">general service</span>
                <div class="row">
                <a class="btn btn-info su_acc_btn"  href="/sales_review/general">review
                  <span>
                    @foreach($gen1 as $g1)
                    {{$g1->accountant}}
                    @endforeach
                  </span>
                </a>
                <a class="btn btn-success su_acc_btn" href="/sales_finish/general/{{ Auth::user()->id }}">finished
                <span>
                    @foreach($gen2 as $g2)
                    {{$g2->finish}}
                    @endforeach
                  </span>
                </a>
              </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-12 col-12">
            <div class="info-box">
              <span class="info-box-icon su_icon"><i class="far fa-flag "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">hotel service</span>
                <div class="row">
                <a class="btn btn-info su_acc_btn" href="/sales_review/hotel">review
                  <span>
                    @foreach($hot1 as $h1)
                    {{$h1->accountant}}
                    @endforeach
                  </span>
                </a>
                <a class="btn btn-success su_acc_btn" href="/sales_finish/hotel/{{ Auth::user()->id }}">finished
                <span>
                    @foreach($hot2 as $h2)
                    {{$h2->finish}}
                    @endforeach
                  </span>
                </a>
              </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          </div>
        
</section>
</div>
</div>

  
  
  
  
  @endsection


