@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
  <div class="card-header">
  <h2 class="card-title">Medical Service Report</h2>


  <a type="button" class="btn btn-outline-success so_form_btn" href="/export_excel">Download as Excel file</a>


  <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
      Filter Customer
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/medicalReport">all</a>
      @foreach($all as $supp)
      <a class="dropdown-item" href="/medicalReport">{{$supp->due_to_customer}}</a>
      @endforeach
    </div>

  </div>




  <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
      Filter Supplier 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/medicalReport">all</a>
      @foreach($all as $supp)
      <a class="dropdown-item" href="/medicalReport">{{$supp->due_to_supp}}</a>
      @endforeach
    </div>

  </div> 


  <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
      Filter Currency
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/medicalReport">all</a>
      <a class="dropdown-item " href="/medicalReport/16"> USD</a>
      <a class="dropdown-item " href="/medicalReport/17">YER</a>
      <a class="dropdown-item " href="/medicalReport/18">SAR</a>
    </div>

  </div>  
  </div>
  
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
    @foreach($all as $item)
    
      <tr>
      <td>{{$item->med_id}}</td>
      
      <td>{{$item->Issue_date}}</td>
     
      <td>{{$item->refernce}}</td>
      
      <td>{{$item->passenger_name}}</td>
      
      <td>{{$item->due_to_supp}}</td>
     
      <td>{{$item->provider_cost}}</td>
      
      <td>{{$item->due_to_customer}}</td>
      
      <td>{{$item->cost}}</td>
     
      <td>{{$item->passnger_currency}}</td>
      

      </tr>
     
     @endforeach
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
