@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
    <div class="row card-outline so_panal">
      <div class="col-12 card ">
      <div class="card-header">
                  <h2 class="card-title">Reports</h1>

                  </div>
                  <div class="card-body">
 
          <div class="row "> 
<div class="col-md-3">
          <label>
            <a href="/supplierRepo"> <input type="radio" checked="checked" /> USD</a>
          </label>
          <label>
            <a class="dropdown-item " href="/supplierRepo/100"> <input type="radio" />  YER</a>
          </label>
          <label>
            <a class="dropdown-item " href="/supplierRepo/101"> <input type="radio" />  SAR</a>
          </label>
        </div>
        <div class="col-md-2">
          <div class="dropdown">
            <button type="button" class="btn btn-outline-primary so_form_btn dropdown-toggle" data-toggle="dropdown">
              Filter By Date
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/supplierRepo">All</a>
              <a class="dropdown-item " href="/supplierRepo/200"> Today</a>
              <a class="dropdown-item " href="/supplierRepo/201">Yesterday</a>
              <a class="dropdown-item " href="/supplierRepo/202">Last 7 Days</a>
              <a class="dropdown-item " href="/supplierRepo/203">Last Month</a>
              <a class="dropdown-item " href="/supplierRepo/204">Last Year</a>
        
             
            </div>
        
          </div> 
         
        </div>
<div class="col-md-7">
     <form action="/supplierRepoinBetween" method="get">
            
            <div class="col-md-3">
              <div class="form-group">
              <label for="">Start Date</label>
              <input type="date" class="form-control" name="start_date">
            </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
              <label for="">End Date</label>
              <input type="date" class="form-control" name="end_date">
            </div>
            </div>

            <div class="col-md-1" >
               <div class="form-group">
                 <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
          </form>    
        </div>   

</div>


<br>


<div class="container"> 
<div class="row ">          
  <table class="card-outline so_panal table table-hover  col-md-5 mb-3">
      <tr>
        
        <th class="text-center" colspan="3">Ticket Service</th>
        
      </tr>
    <tr>
    <th>Date</th>
    <th>Number of tickets</th>
    <th>Total</th>

    </tr>
    @foreach($tic as $tickets)
    <tr>
      
     
      <td>{{$tickets->ad}}</td>
      <td>{{$tickets->tc}}</td>
      <td>{{$tickets->tt}}</td>
   
      
    </tr>
    @endforeach
  </table>
  <table class="table table-hover col-md-2 mb-3">
  </table>
  
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th class="text-center" colspan="3">Visa Service</th>
        
      </tr>
    <tr>
    <th>Date</th>
    <th>Count</th>
    <th>Total</th>

    </tr>
    @foreach($visa as $visas)
    <tr>
      
     
      <td>{{$visas->av}}</td>
      <td>{{$visas->vc}}</td>
      <td>{{$visas->vt}}</td>
   
      
    </tr>
    @endforeach
  </table>
  </div>
  <br>
  <br>
  <br>
  <div class="row">          
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th class="text-center" colspan="3">Bus Service</th>
        
      </tr>
    <tr>
    <th>Date</th>
    <th>Count</th>
    <th>Total</th>

    </tr>
    @foreach($bus as $buss)
    <tr>
      
     
      <td>{{$buss->ab}}</td>
      <td>{{$buss->bc}}</td>
      <td>{{$buss->bt}}</td>
   
      
    </tr>
    @endforeach
  </table>
  <table class="table table-hover col-md-2 mb-3">
  </table>
  
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th class="text-center" colspan="3">Car Service</th>
        
      </tr>
    <tr>
    <th>Date</th>
    <th>Count</th>
    <th>Total</th>

    </tr>
    @foreach($car as $carss)
    <tr>
      
     
      <td>{{$carss->ac}}</td>
      <td>{{$carss->cc}}</td>
      <td>{{$carss->ct}}</td>
   
      
    </tr>
    @endforeach
  </table>
  </div>
  <br>
  <br>
  <br>
  <div class="row">          
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th class="text-center" colspan="3">Hotel Service</th>
        
      </tr>
    <tr>
    <th>Date</th>
    <th>Count</th>
    <th>Total</th>

    </tr>
    @foreach($hot as $hots)
    <tr>
      
     
      <td>{{$hots->ah}}</td>
      <td>{{$hots->hc}}</td>
      <td>{{$hots->ht}}</td>
   
      
    </tr>
    @endforeach
  </table>
  <table class="table table-hover col-md-2 mb-3">
  </table>
  
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th class="text-center" colspan="3">Medical Service</th>
        
      </tr>
    <tr>
    <th>Date</th>
    <th>Count</th>
    <th>Total</th>

    </tr>
    @foreach($med as $meds)
    <tr>
      
     
      <td>{{$meds->am}}</td>
      <td>{{$meds->mc}}</td>
      <td>{{$meds->mt}}</td>
   
      
    </tr>
    @endforeach
  </table>
  </div>
  <br>
  <br>
  <br>
  <div class="row">          
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th class="text-center" colspan="3">General Service</th>
        
      </tr>
    <tr>
    <th>Date</th>
    <th>Count</th>
    <th>Total</th>

    </tr>
    @foreach($gen as $gens)
    <tr>
      
     
      <td>{{$gens->ag}}</td>
      <td>{{$gens->gc}}</td>
      <td>{{$gens->gt}}</td>
   
      
    </tr>
    @endforeach
  </table>
  <table class="table table-hover col-md-2 mb-3">
  </table>
  
  
  </div>
</div>
<br>
<br>
<br>
  
</div>
<div class="card-footer" >
<a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/ticketReport') }}"> Ticket Service</a> 
<a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/busReport') }}"> Bus Service</a> 
<a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/visaReport') }}"> Visa Service</a> 
<a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/carReport') }}"> Car Service</a> 
<a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/hotelReport') }}"> Hotel Service</a> 
<a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/medicalReport') }}"> Medical Service</a> 
<a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/generalReport') }}"> General Service</a>  
</div>
</div>
</div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>

    <script type="text/javascript">
        $(function () {
            let dateInterval = getQueryParameter('date_filter');
            let start = moment().startOf('isoWeek');
            let end = moment().endOf('isoWeek');
            if (dateInterval) {
                dateInterval = dateInterval.split(' - ');
                start = dateInterval[0];
                end = dateInterval[1];
            }
            $('#date_filter').daterangepicker({
                "showDropdowns": true,
                "showWeekNumbers": true,
                "alwaysShowCalendars": true,
                startDate: start,
                endDate: end,
                locale: {
                    format: 'YYYY-MM-DD',
                    firstDay: 1,
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
                }
            });
        });
        function getQueryParameter(name) {
            const url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
    </script>

@stop