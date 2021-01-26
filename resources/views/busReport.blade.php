@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
  <div class="card-header">
  <h2 class="card-title">Bus Service Report</h2>
  </div>
  <br>
  <div class="row">
    <div class="col-md-2">
      <div class="dropdown so_form_btn">
        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
          Filter Currency
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/busReport">all</a>
      <a class="dropdown-item " href="/busReport/4"> USD</a>
      <a class="dropdown-item " href="/busReport/5">YER</a>
      <a class="dropdown-item " href="/busReport/6">SAR</a>
        </div>
    
      </div>  
    </div>
    <div class="col-md-2">
      <div class="dropdown so_form_btn">
        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
          Filter Supplier 
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/busReport">all</a>
          @foreach($all as $supp)
          <a class="dropdown-item" href="/busReport/a/{{$supp->s_no}}">{{$supp->supplier_name}}</a>
          @endforeach
        </div>
    
      </div> 
    </div>
    <div class="col-md-2">
      <div class="dropdown so_form_btn">
        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
          Filter Customer
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/busReport">all</a>
      @foreach($all as $supp)
      <a class="dropdown-item" href="/busReport/{{$supp->emp_id}}">{{$supp->emp_first_name}} {{$supp->emp_last_name}}</a>
      @endforeach
        </div>
    
      </div>
    
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-2">
    <input type="button" value="Export to PDF" class="btn btn-outline-danger so_form_btn " onclick="window.print();" id="pdf_btn" />
    </div>
   
  
  
  
    </div>
  
 <br>
  
<div class="container">            
  <table class="table table-hover text-center">
    <thead>
      <tr>
        <th>#</th>
        
        <th>Issue date</th>
       
        <th>Refernce</th>
       
        <th>Passenger Name</th>
        
        <th>Supplier</th>
       
        <th>Provider Cost</th>
        
        <th>Customer</th>
       
        <th>Customer Cost</th>
       
        <th>Currency</th>
       
      </tr>
    </thead>
    <tbody>
      <?php $i=1 ?>
      @forelse($all as $item)
    
      <tr>
        <input type="hidden" class="delete_id" value="{{$item->bus_id}}">
        <td><?php echo $i;?></td>
      <td>{{$item->Issue_date}}</td>
     
      <td>{{$item->refernce}}</td>
      
      <td>{{$item->passenger_name}}</td>
      
      <td>{{$item->supplier_name}}</td>
     
      <td>{{$item->provider_cost}}</td>
      
      <td>{{$item->emp_first_name}} {{$item->emp_last_name}}</td>
      
      <td>{{$item->cost}}</td>
     
      <td>{{$item->passnger_currency}}</td>
      

      </tr>
     
      <?php $i++ ?>
      @empty
      <tr> <td colspan="10" >There is No data <td></tr>
                        @endforelse  
    </tbody>
  </table>
  
</div>

</div>
</div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
