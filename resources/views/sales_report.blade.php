@extends('app_layouts.master')
@section('main_content')

<style>
    @media screen and (min-width: 676px) {
      #myModal_acc .modal-dialog {
          max-width: 95%; /* New width for default modal */
        }
    }
</style>
<div class="content-wrapper">
  <div class="container py-4">
        <div class="row">
<div class="col-md-4 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Today Sales </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th>type</th>                     
                    <th>total</th>                     
                    <th>my sales</th>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($today as $to)
                    <tr>
                    <td>Ticket</td>
                    <td>{{$to->glot}}</td>
                    <td>{{$to->spet}}</td>
                    </tr> 
                    <tr>
                    <td>Bus</td>
                    <td>{{$to->glob}}</td>
                    <td>{{$to->speb}}</td>
                    </tr> 
                    <tr>
                    <td>Car</td>
                    <td>{{$to->gloc}}</td>
                    <td>{{$to->spec}}</td>
                    </tr> 
                    <tr>
                    <td>Medical</td>
                    <td>{{$to->glom}}</td>
                    <td>{{$to->spem}}</td>
                    </tr> 
                    <tr>
                    <td>Hotel</td>
                    <td>{{$to->gloh}}</td>
                    <td>{{$to->speh}}</td>
                    </tr>  
                    <tr>
                    <td>Visa</td>
                    <td>{{$to->glov}}</td>
                    <td>{{$to->spev}}</td>
                    </tr>  
                    <tr>
                    <td>Genersl</td>
                    <td>{{$to->glog}}</td>
                    <td>{{$to->speg}}</td>
                    </tr> 
                                     
                    @endforeach 
                    <thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead>                 
                    </tbody>
                  </table>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <div class="col-md-4 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Last Week Sales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th>type</th>                     
                    <th>total</th>                     
                    <th>my sales</th>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($week as $we)
                    <tr>
                    <td>Ticket</td>
                    <td>{{$we->glot}}</td>
                    <td>{{$we->spet}}</td>
                    </tr> 
                    <tr>
                    <td>Bus</td>
                    <td>{{$we->glob}}</td>
                    <td>{{$we->speb}}</td>
                    </tr> 
                    <tr>
                    <td>Car</td>
                    <td>{{$we->gloc}}</td>
                    <td>{{$we->spec}}</td>
                    </tr> 
                    <tr>
                    <td>Medical</td>
                    <td>{{$we->glom}}</td>
                    <td>{{$we->spem}}</td>
                    </tr> 
                    <tr>
                    <td>Hotel</td>
                    <td>{{$we->gloh}}</td>
                    <td>{{$we->speh}}</td>
                    </tr>  
                    <tr>
                    <td>Visa</td>
                    <td>{{$we->glov}}</td>
                    <td>{{$we->spev}}</td>
                    </tr>  
                    <tr>
                    <td>Genersl</td>
                    <td>{{$we->glog}}</td>
                    <td>{{$we->speg}}</td>
                    </tr> 
                                     
                    @endforeach 
                    <thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead>                 
                    </tbody>
                  </table>
                </div>

              </div>              </div>
              <!-- /.card-body -->
            </div>
            <div class="col-md-4 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">last Month Sales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th>type</th>                     
                    <th>total</th>                     
                    <th>my sales</th>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($month as $mo)
                    <tr>
                    <td>Ticket</td>
                    <td>{{$mo->glot}}</td>
                    <td>{{$mo->spet}}</td>
                    </tr> 
                    <tr>
                    <td>Bus</td>
                    <td>{{$mo->glob}}</td>
                    <td>{{$mo->speb}}</td>
                    </tr> 
                    <tr>
                    <td>Car</td>
                    <td>{{$mo->gloc}}</td>
                    <td>{{$mo->spec}}</td>
                    </tr> 
                    <tr>
                    <td>Medical</td>
                    <td>{{$mo->glom}}</td>
                    <td>{{$mo->spem}}</td>
                    </tr> 
                    <tr>
                    <td>Hotel</td>
                    <td>{{$mo->gloh}}</td>
                    <td>{{$mo->speh}}</td>
                    </tr>  
                    <tr>
                    <td>Visa</td>
                    <td>{{$mo->glov}}</td>
                    <td>{{$mo->spev}}</td>
                    </tr>  
                    <tr>
                    <td>Genersl</td>
                    <td>{{$mo->glog}}</td>
                    <td>{{$mo->speg}}</td>
                    </tr> 
                                     
                    @endforeach 
                    <thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead>                 
                    </tbody>
                  </table>
                </div>

              </div>              </div>
              <!-- /.card-body -->
            </div>
            <div class="col-md-4 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">All Sales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th>type</th>                     
                    <th>total</th>                     
                    <th>my sales</th>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all as $a)
                    <tr>
                    <td>Ticket</td>
                    <td>{{$a->glot}}</td>
                    <td>{{$a->spet}}</td>
                    </tr> 
                    <tr>
                    <td>Bus</td>
                    <td>{{$a->glob}}</td>
                    <td>{{$a->speb}}</td>
                    </tr> 
                    <tr>
                    <td>Car</td>
                    <td>{{$a->gloc}}</td>
                    <td>{{$a->spec}}</td>
                    </tr> 
                    <tr>
                    <td>Medical</td>
                    <td>{{$a->glom}}</td>
                    <td>{{$a->spem}}</td>
                    </tr> 
                    <tr>
                    <td>Hotel</td>
                    <td>{{$a->gloh}}</td>
                    <td>{{$a->speh}}</td>
                    </tr>  
                    <tr>
                    <td>Visa</td>
                    <td>{{$a->glov}}</td>
                    <td>{{$a->spev}}</td>
                    </tr>  
                    <tr>
                    <td>Genersl</td>
                    <td>{{$a->glog}}</td>
                    <td>{{$a->speg}}</td>
                    </tr> 
                                     
                    @endforeach 
                    <thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead>                 
                    </tbody>
                  </table>
                </div>

              </div>               </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="col-md-8 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"> Sales By Currancy</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th colspan="1"></th>                     
                    <th colspan="2">USD</th>                     
                    <th colspan="2"> YER</th>                     
                    <th colspan="2"> SAR</th>                     
                    </tr>
                    <tr>
                    <th colspan="1">type</th>                     
                    <td colspan="">COUNT</td>                     
                    <td colspan=""> COST</td>                     
                    <td colspan=""> COUNT</td>
                    <td colspan="">COST</td>                     
                    <td colspan=""> COUNT</td>                     
                    <td colspan=""> COST</td>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all as $a)
                    <tr>
                    <th>Ticket</th>
                    <td>{{$a->glot}}</td>
                    <td>{{$a->glot}}</td>
                    
                    <td>{{$a->glot}}</td>
                    <td>{{$a->glot}}</td>
                   
                    <td>{{$a->glot}}</td>
                    <td>{{$a->glot}}</td>
                    </tr> 
                    @endforeach 
                    <thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead>                 
                    </tbody>
                  </table>
                </div>

              </div>               </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            </div>
            <!-- PIE CHART -->
            <div class="col-md-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
          <!-- /.col (LEFT) -->
          </div>
          </div>
          <!-- /.col (LEFT) -->
          </div>
     
@endsection
