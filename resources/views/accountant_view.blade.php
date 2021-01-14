@extends('app_layouts.master')
@section('main_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
            <div class="card card-info shadow">
              <div class="card-header">
                <h3 class="card-title">Services Analytic</h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                      <th>type </th>
                      <th>review</th>
                      <th>finished</th>
                      <th>OK</th>
                      <th>VOID</th>
                      <th>ISSUDE</th>
                      <th>REFUND</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                     <td>Ticket</td>
                      <td>
                       <a  href="/accountant_review/ticket">
                       <span class="badge badge-success">
                         @foreach($tic1 as $t1)
                         {{$t1->accountant}}
                          @endforeach
                        </span>
                       </a>
                      </td>
                      <td>
                       <a  href="/accountant_finish/ticket/{{ Auth::user()->id }}">
                        <span class="badge badge-danger">
                            @foreach($tic2 as $t2)
                            {{$t2->finish}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/ticket/ok">
                        <span class="badge badge-success">
                            @foreach($tic3 as $t3)
                            {{$t3->ok}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/ticket/issue">
                        <span class="badge badge-primary">
                            @foreach($tic4 as $t4)
                            {{$t4->issue}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/ticket/void">
                        <span class="badge badge-danger">
                            @foreach($tic5 as $t5)
                            {{$t5->void}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/ticket/refund">
                        <span class="badge badge-dark">
                            @foreach($tic6 as $t6)
                            {{$t6->refund}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                    </tr> 
                    <tr>
                     <td>Bus</td>
                      <td>
                       <a  href="/accountant_review/bus">
                       <span class="badge badge-success">
                         @foreach($bus1 as $b1)
                         {{$b1->accountant}}
                          @endforeach
                        </span>
                       </a>
                      </td>
                      <td>
                       <a  href="/accountant_finish/bus/{{ Auth::user()->id }}">
                        <span class="badge badge-danger">
                            @foreach($bus2 as $b2)
                            {{$b2->finish}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/bus/ok">
                        <span class="badge badge-success">
                            @foreach($bus3 as $b3)
                            {{$b3->ok}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/bus/issue">
                        <span class="badge badge-primary">
                            @foreach($bus4 as $b4)
                            {{$b4->issue}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/bus/void">
                        <span class="badge badge-danger">
                            @foreach($bus5 as $b5)
                            {{$b5->void}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/bus/refund">
                        <span class="badge badge-dark">
                            @foreach($bus6 as $b6)
                            {{$b6->refund}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                    </tr>
                    <tr>
                     <td>Car</td>
                      <td>
                       <a  href="/accountant_review/car">
                       <span class="badge badge-success">
                         @foreach($car1 as $c1)
                         {{$c1->accountant}}
                          @endforeach
                        </span>
                       </a>
                      </td>
                      <td>
                       <a  href="/accountant_finish/car/{{ Auth::user()->id }}">
                        <span class="badge badge-danger">
                            @foreach($car2 as $c2)
                            {{$c2->finish}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/car/ok">
                        <span class="badge badge-success">
                            @foreach($car3 as $c3)
                            {{$c3->ok}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/car/issue">
                        <span class="badge badge-primary">
                            @foreach($car4 as $c4)
                            {{$c4->issue}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/car/void">
                        <span class="badge badge-danger">
                            @foreach($car5 as $c5)
                            {{$c5->void}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/car/refund">
                        <span class="badge badge-dark">
                            @foreach($car6 as $c6)
                            {{$c6->refund}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                    </tr> 
                    <tr>
                     <td>Hotel</td>
                      <td>
                       <a  href="/accountant_review/hotel">
                       <span class="badge badge-success">
                         @foreach($hot1 as $h1)
                         {{$h1->accountant}}
                          @endforeach
                        </span>
                       </a>
                      </td>
                      <td>
                       <a  href="/accountant_finish/hotel/{{ Auth::user()->id }}">
                        <span class="badge badge-danger">
                            @foreach($hot2 as $h2)
                            {{$h2->finish}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/hotel/ok">
                        <span class="badge badge-success">
                            @foreach($hot3 as $h3)
                            {{$h3->ok}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/hotel/issue">
                        <span class="badge badge-primary">
                            @foreach($hot4 as $h4)
                            {{$h4->issue}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/hotel/void">
                        <span class="badge badge-danger">
                            @foreach($hot5 as $h5)
                            {{$h5->void}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/hotel/refund">
                        <span class="badge badge-dark">
                            @foreach($hot6 as $h6)
                            {{$h6->refund}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                    </tr>
                    <tr>
                     <td>Visa</td>
                      <td>
                       <a  href="/accountant_review/visa">
                       <span class="badge badge-success">
                         @foreach($vis1 as $v1)
                         {{$v1->accountant}}
                          @endforeach
                        </span>
                       </a>
                      </td>
                      <td>
                       <a  href="/accountant_finish/visa/{{ Auth::user()->id }}">
                        <span class="badge badge-danger">
                            @foreach($vis2 as $v2)
                            {{$v2->finish}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/visa/ok">
                        <span class="badge badge-success">
                            @foreach($vis3 as $v3)
                            {{$v3->ok}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/visa/issue">
                        <span class="badge badge-primary">
                            @foreach($vis4 as $v4)
                            {{$v4->issue}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/visa/void">
                        <span class="badge badge-danger">
                            @foreach($vis5 as $v5)
                            {{$v5->void}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/visa/refund">
                        <span class="badge badge-dark">
                            @foreach($vis6 as $v6)
                            {{$v6->refund}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                    </tr> 
                    <tr>
                     <td>Medical</td>
                      <td>
                       <a  href="/accountant_review/medical">
                       <span class="badge badge-success">
                         @foreach($med1 as $m1)
                         {{$m1->accountant}}
                          @endforeach
                        </span>
                       </a>
                      </td>
                      <td>
                       <a  href="/accountant_finish/medical/{{ Auth::user()->id }}">
                        <span class="badge badge-danger">
                            @foreach($med2 as $m2)
                            {{$m2->finish}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/medical/ok">
                        <span class="badge badge-success">
                            @foreach($med3 as $m3)
                            {{$m3->ok}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/medical/issue">
                        <span class="badge badge-primary">
                            @foreach($med4 as $m4)
                            {{$m4->issue}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/medical/void">
                        <span class="badge badge-danger">
                            @foreach($med5 as $m5)
                            {{$m5->void}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/medical/refund">
                        <span class="badge badge-dark">
                            @foreach($med6 as $m6)
                            {{$m6->refund}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                    </tr>
                    <tr>
                     <td>General</td>
                      <td>
                       <a  href="/accountant_review/general">
                       <span class="badge badge-success">
                         @foreach($gen1 as $g1)
                         {{$g1->accountant}}
                          @endforeach
                        </span>
                       </a>
                      </td>
                      <td>
                       <a  href="/accountant_finish/general/{{ Auth::user()->id }}">
                        <span class="badge badge-danger">
                            @foreach($gen2 as $g2)
                            {{$g2->finish}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/general/ok">
                        <span class="badge badge-success">
                            @foreach($gen3 as $g3)
                            {{$g3->ok}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/general/issue">
                        <span class="badge badge-primary">
                            @foreach($gen4 as $g4)
                            {{$g4->issue}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/general/void">
                        <span class="badge badge-danger">
                            @foreach($gen5 as $g5)
                            {{$g5->void}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                     <td>
                       <a  href="/accountant_review/general/refund">
                        <span class="badge badge-dark">
                            @foreach($gen6 as $g6)
                            {{$g6->refund}}
                            @endforeach
                        </span>
                       </a>
                     </td>
                    </tr>                    
                    </tbody>
                  </table>
                </div>
               </div>
            </div>
          </div>
         
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
                    <?php $i=1;?>
                    @forelse($latest as $lat)
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td>Call of Duty IV</td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr>
                                         
                    <?php $i++ ?>
@empty
<tr>
                      <td class=text-center colspan="10">There is No data in table...
                      <td>
                    </tr>
     @endforelse
    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
             
            </div>
            <!-- /.card -->
          </div>
          </div>        
 </section>
</div>
</div>

  
  
  
  
  @endsection


