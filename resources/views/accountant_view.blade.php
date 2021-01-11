@extends('app_layouts.master')
@section('main_content')

 
  <!-- Content Wrapper. Contains page content -->
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
                <a class="btn btn-info su_acc_btn" href="/accountant_review/ticket">review
                  <span>
                    @foreach($tic1 as $t1)
                    {{$t1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/accountant_finish/ticket/{{ Auth::user()->id }}">finished
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
                <a class="btn btn-info su_acc_btn" href="/accountant_review/car">review
                  <span>
                    @foreach($car1 as $c1)
                    {{$c1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/accountant_finish/car/{{ Auth::user()->id }}">finished
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
                <a class="btn btn-info su_acc_btn" href="/accountant_review/bus">review
                  <span>
                    @foreach($bus1 as $b1)
                    {{$b1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/accountant_finish/bus/{{ Auth::user()->id }}">finished
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
                <a class="btn btn-info su_acc_btn" href="/accountant_review/medical">review
                  <span>
                    @foreach($med1 as $m1)
                    {{$m1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/accountant_finish/medical/{{ Auth::user()->id }}">finished
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
                <a class="btn btn-info su_acc_btn" href="/accountant_review/visa">review
                  <span>
                    @foreach($vis1 as $v1)
                    {{$v1->accountant}}
                    @endforeach
                  </span>
</a>
                <a class="btn btn-success su_acc_btn" href="/accountant_finish/visa/{{ Auth::user()->id }}">finished
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
                <a class="btn btn-info su_acc_btn"  href="/accountant_review/general">review
                  <span>
                    @foreach($gen1 as $g1)
                    {{$g1->accountant}}
                    @endforeach
                  </span>
                </a>
                <a class="btn btn-success su_acc_btn" href="/accountant_finish/general/{{ Auth::user()->id }}">finished
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
                <a class="btn btn-info su_acc_btn" href="/accountant_review/hotel">review
                  <span>
                    @foreach($hot1 as $h1)
                    {{$h1->accountant}}
                    @endforeach
                  </span>
                </a>
                <a class="btn btn-success su_acc_btn" href="/accountant_finish/hotel/{{ Auth::user()->id }}">finished
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
          <div class="row">
         
          <div class="col-12">

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest ticket</h3>

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
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>type </th>
                      <th>Item</th>
                      <th>Status</th>
                      <th>Popularity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td><span class="badge badge-danger">Delivered</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-info">Processing</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>                      
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</section>
</div>
</div>

  
  
  
  
  @endsection


