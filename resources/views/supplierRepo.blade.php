@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="pdf">
  <div class="container p-4">
    <div class="row card-outline so_panal">
      <div class="col-12 card ">
      <div class="card-header">
                  <h2 class="card-title">Reports</h1>

                  </div>
                  <div class="card-body">
 
          <div class="row" id="a"> 
<div class="col-md-8" id="radios">

          <label>
            <input type="radio" name="filter" value="usd" id="usd" onclick="window.location='/supplierRepo';" checked="checked"/> USD
          </label>
          <label>
            <input type="radio" value="yer" id="yer" name="filter" onclick="window.location='/supplierRepo/100';" />  YER
          </label>
          <label>
            <input type="radio" value="sar" id="sar" name="filter" onclick="window.location='/supplierRepo/101';" />  SAR
          </label>
        </div>
        <div class="col-md-2">
          <div class="dropdown">
            <button type="button" class="btn btn-outline-primary so_form_btn dropdown-toggle" data-toggle="dropdown">
              Filter By Date
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/supplierRepo/1000">All</a>
              <a class="dropdown-item " href="/supplierRepo/200"> Today</a>
              <a class="dropdown-item " href="/supplierRepo/201">Yesterday</a>
              <a class="dropdown-item " href="/supplierRepo/202">Last 7 Days</a>
              <a class="dropdown-item " href="/supplierRepo/203">Last Month</a>
              <a class="dropdown-item " href="/supplierRepo/204">Last Year</a>
        
             
            </div>
        
          </div> 
         
        </div>
        <div class="col-md-2">
          
          <input type="button" value="Export to PDF" class="btn btn-outline-danger so_form_btn " onclick="window.print();" id="pdf_btn" />
             
        </div>

   

</div>

<div class="col-md-12">
  <input type="checkbox" name='filter' value="filter" onChange="toggleDiv()" /> Filter by Currency and Date togather 
  
  <br>
  <br>
 
<div class="row" id="b" style="display:none;"> 
  <div class="col-md-2">
            <div class="dropdown">
              <button type="button" class="btn btn-outline-primary so_form_btn dropdown-toggle" data-toggle="dropdown">
                USD and Date
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/supplierRepo/1000">All</a>
                <a class="dropdown-item " href="/supplierRepo/200"> Today</a>
                <a class="dropdown-item " href="/supplierRepo/201">Yesterday</a>
                <a class="dropdown-item " href="/supplierRepo/202">Last 7 Days</a>
                <a class="dropdown-item " href="/supplierRepo/203">Last Month</a>
                <a class="dropdown-item " href="/supplierRepo/204">Last Year</a>
          
               
              </div>
          
            </div> 
           
          </div>
          <div class="col-md-2">
            <div class="dropdown">
              <button type="button" class="btn btn-outline-primary so_form_btn dropdown-toggle" data-toggle="dropdown">
                YER and Date
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/supplierRepo/1001">All</a>
                <a class="dropdown-item " href="/supplierRepo/205"> Today</a>
                <a class="dropdown-item " href="/supplierRepo/206">Yesterday</a>
                <a class="dropdown-item " href="/supplierRepo/207">Last 7 Days</a>
                <a class="dropdown-item " href="/supplierRepo/208">Last Month</a>
                <a class="dropdown-item " href="/supplierRepo/209">Last Year</a>
          
               
              </div>
          
            </div> 
           
          </div>
          <div class="col-md-2">
            <div class="dropdown">
              <button type="button" class="btn btn-outline-primary so_form_btn dropdown-toggle" data-toggle="dropdown">
                SAR and Date
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/supplierRepo/1002">All</a>
                <a class="dropdown-item " href="/supplierRepo/210"> Today</a>
                <a class="dropdown-item " href="/supplierRepo/211">Yesterday</a>
                <a class="dropdown-item " href="/supplierRepo/212">Last 7 Days</a>
                <a class="dropdown-item " href="/supplierRepo/213">Last Month</a>
                <a class="dropdown-item " href="/supplierRepo/214">Last Year</a>
          
               
              </div>
          
            </div> 
           
          </div>
          <div class="col-md-3">               
          </div>
          <div class="col-md-3">
          
            <input type="button" value="Export to PDF" class="btn btn-outline-danger so_form_btn " onclick="window.print();" id="pdf_btn" />
               
          </div>
          
  
     
  
  </div>
</div>
</div>
<br>


<div class="container"> 
<div class="row "> 
  <?php $total = 0;?>
          
  <table class="card-outline so_panal table table-hover  col-md-5 mb-3">
      <tr>
        
        <th class="text-center" colspan="2">Ticket Service </th>
        <th> <a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/ticketReport') }}"> More Details</a></th>
        
      </tr>
    <tr>
    <th>Date</th>
    <th>Number of tickets</th>
    <th>Total</th>

    </tr>
    <?php $sum = 0;
    $sum2=0; ?>
    @forelse($tic as $tickets)
    <tr>
      
     
      <td>{{$tickets->ad}}</td>
      <td>{{$tickets->tc}}</td>
      <td>{{$tickets->tt}}</td>
   
      
    </tr>
    <?php 
    $sum += $tickets->tt;
    $total += $sum;
    $sum2 += $tickets->tc; ?>
    @empty
<tr><td class="text-center" colspan="3">There is No data<td></tr>
  @endforelse 
  <tr>
    <th>Total</th>
    <td><?php echo $sum2;?></td>
    <td><?php echo $sum;?></td>
  </tr>
  </table>
  <table class="table table-hover col-md-2 mb-3">
  </table>
  
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th colspan="2">Visa Service </th>
        <th><a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/visaReport') }}"> More Details</a></th>
      </tr>
    <tr>
    <th>Date</th>
    <th>Number of tickets</th>
    <th>Total</th>

    </tr>
    <?php $sum = 0;
    $sum2=0; ?>
    @forelse($visa as $visas)
    <tr>
      
     
      <td>{{$visas->av}}</td>
      <td>{{$visas->vc}}</td>
      <td>{{$visas->vt}}</td>
   
      
    </tr>
    <?php 
    $sum += $visas->vt;
    $total += $sum;
    $sum2 += $visas->vc; ?>
    @empty
<tr><td class="text-center" colspan="3">There is No data<td></tr>
  @endforelse 
  <tr>
    <th>Total</th>
    <td><?php echo $sum2;?></td>
    <td><?php echo $sum;?></td>
  </tr>
  </table>
  </div>
  <br>
  <br>
  <br>
  <div class="row">          
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th colspan="2">Bus Service </th>
        <th><a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/busReport') }}"> More Details</a></th>
      </tr>
    <tr>
    <th>Date</th>
    <th>Number of tickets</th>
    <th>Total</th>

    </tr>
    <?php $sum = 0;
    $sum2=0; ?>
    @forelse($bus as $buss)
    <tr>
      
     
      <td>{{$buss->ab}}</td>
      <td>{{$buss->bc}}</td>
      <td>{{$buss->bt}}</td>
   
      
    </tr>
    <?php 
    $sum += $buss->bt;
    $total += $sum;
    $sum2 += $buss->bc; ?>
    @empty
<tr><td class="text-center" colspan="2">There is No data<td></tr>
  @endforelse 
  <tr>
    <th>Total</th>
    <td><?php echo $sum2;?></td>
    <td><?php echo $sum;?></td>
  </tr>
  </table>
  <table class="table table-hover col-md-2 mb-3">
  </table>
  
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th colspan="2">Car Service </th>
        <th><a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/carReport') }}"> More Details</a></th>
      </tr>
    <tr>
    <th>Date</th>
    <th>Number of tickets</th>
    <th>Total</th>

    </tr>
    <?php $sum = 0;
    $sum2=0; ?>
    @forelse($car as $carss)
    <tr>
      
     
      <td>{{$carss->ac}}</td>
      <td>{{$carss->cc}}</td>
      <td>{{$carss->ct}}</td>
   
      
    </tr>
    <?php 
    $sum += $carss->ct;
    $total += $sum;
    $sum2 += $carss->cc; ?>
    @empty
<tr><td class="text-center" colspan="2">There is No data<td></tr>
  @endforelse 
  <tr>
    <th>Total</th>
    <td><?php echo $sum2;?></td>
    <td><?php echo $sum;?></td>
  </tr>
  </table>
  </div>
  <br>
  <br>
  <br>
  <div class="row">          
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th colspan="2">Hotel Service </th>
        <th><a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/hotelReport') }}"> More Details</a></th>
      </tr>
    <tr>
    <th>Date</th>
    <th>Number of tickets</th>
    <th>Total</th>

    </tr>
    <?php $sum = 0;
    $sum2=0; ?>
    @forelse($hot as $hots)
    <tr>
      
     
      <td>{{$hots->ah}}</td>
      <td>{{$hots->hc}}</td>
      <td>{{$hots->ht}}</td>
   
      
    </tr>
    <?php 
    $sum += $hots->ht;
    $total += $sum;
    $sum2 += $hots->hc; ?>
    @empty
<tr><td class="text-center" colspan="2">There is No data<td></tr>
  @endforelse 
  <tr>
    <th>Total</th>
    <td><?php echo $sum2;?></td>
    <td><?php echo $sum;?></td>
  </tr>
  </table>
  <table class="table table-hover col-md-2 mb-3">
  </table>
  
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th colspan="2">Medical Service </th>
        <th><a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/medicalReport') }}"> More Details</a> </th>
      </tr>
    <tr>
    <th>Date</th>
    <th>Number of tickets</th>
    <th>Total</th>

    </tr>
    <?php $sum = 0;
    $sum2=0; ?>
    @forelse($med as $meds)
    <tr>
      
     
      <td>{{$meds->am}}</td>
      <td>{{$meds->mc}}</td>
      <td>{{$meds->mt}}</td>
   
      
    </tr>
    <?php 
    $sum += $meds->mt;
    $total += $sum;
    $sum2 += $meds->mc; ?>
    @empty
<tr><td class="text-center" colspan="2">There is No data<td></tr>
  @endforelse 
  <tr>
    <th>Total</th>
    <td><?php echo $sum2;?></td>
    <td><?php echo $sum;?></td>
  </tr>
  </table>
  </div>
  <br>
  <br>
  <br>
  <div class="row">          
  <table class="card-outline so_panal table table-hover col-md-5 mb-3">
      <tr>
        
        <th colspan="2">General Service </th>
        <th><a type="button" class="btn btn-outline-primary so_form_btn" href="{{ url('/generalReport') }}"> More Details</a></th>
      </tr>
    <tr>
    <th>Date</th>
    <th>Number of tickets</th>
    <th>Total</th>

    </tr>
    <?php $sum = 0;
    $sum2=0; ?>
    @forelse($gen as $gens)
    <tr>
      
     
      <td>{{$gens->ag}}</td>
      <td>{{$gens->gc}}</td>
      <td>{{$gens->gt}}</td>
   
      
    </tr>
    <?php 
    $sum += $gens->gt;
    $total += $sum;
    $sum2 += $gens->gc; ?>
    @empty
<tr><td class="text-center" colspan="2">There is No data<td></tr>
  @endforelse 
  <tr>
    <th>Total</th>
    <td><?php echo $sum2;?></td>
    <td><?php echo $sum;?></td>
  </tr> 
  </table>
  <table class="table table-hover col-md-2 mb-3">
  </table>
  

</div>
<div>
  <table class="card-outline so_panal table table-hover col-md-12 mb-3">
    <th class="text-right" >Total: <?php echo $total;?> </th>
  
</table>
  </div>
<br>
<br>
<br>

</div>
</div>
</div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
function toggleDiv() {

// first check if display then hide otherwise show
if ((document.getElementById('b').style.display == 'none')) {
 document.getElementById('b').style.display="flex";
 document.getElementById('a').style.display="none";
}
else {
document.getElementById('b').style.display="none";
document.getElementById('a').style.display="flex";
}
};


$("#pdf_btn").live("click", function () {
            var divContents = $("#pdf").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>Reports</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(pdf);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
//   console.log('ewgrjwhehnwehdwqfyetfqyhefhqwafdhwqfytfwqytefwqfewqfeyqwfeqwfefwqf');

//   var v=$('#t').val();
// //v.html('3233332');
//         console.log('total');
//         console.log(v);
    </script>

@stop
