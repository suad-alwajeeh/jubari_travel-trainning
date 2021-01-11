@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content// -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row">
  <div class="col-12">
  <h1 class="text-center"></h1>
</div>
 
<div class="card card-primary card-outline col-12">
          
          <div class="card-body">
            
          <!--  <h4 class="mt-5 ">Custom Content Above</h4> -->
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
  <li class="nav-item">
                <a class="nav-link active" id="custom-content-above-ticket-tab" data-toggle="pill" href="#custom-content-above-ticket" role="tab" aria-controls="custom-content-above-ticket" aria-selected="true">Ticket</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-bus-tab" data-toggle="pill" href="#custom-content-above-bus" role="tab" aria-controls="custom-content-above-bus" aria-selected="false">Bus</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-hotels-tab" data-toggle="pill" href="#custom-content-above-hotels" role="tab" aria-controls="custom-content-above-hotels" aria-selected="false">Hotels</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-visa-tab" data-toggle="pill" href="#custom-content-above-visa" role="tab" aria-controls="custom-content-above-visa" aria-selected="false">Visa</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-car-tab" data-toggle="pill" href="#custom-content-above-car" role="tab" aria-controls="custom-content-above-car" aria-selected="false">Car</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-medical-tab" data-toggle="pill" href="#custom-content-above-medical" role="tab" aria-controls="custom-content-above-medical" aria-selected="false">Medical</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-general-tab" data-toggle="pill" href="#custom-content-above-general" role="tab" aria-controls="custom-content-above-general" aria-selected="false">General</a>
              </li>
            </ul>
            <div class="tab-custom-content">
              <p class="lead mb-0">Services and its Status</p>
            </div>
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-ticket" role="tabpanel" aria-labelledby="custom-content-above-ticket-tab">
              <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Employee Name</th>
        <th>Status</th>
        <th>Add Remark</th>
       
      </tr>
    </thead>
    <tbody>
    
    @foreach($data as $item)
    <tr>
        <th>{{$item->id}}</th>
        <th>{{$item->emp_first_name}} {{$item->emp_last_name}}</th>
        <th>
          @if($item->ticket_status==1)
            <small class="badge badge-danger"><i class="far fa-clock"></i> in sales executive</small>
          
                    @elseif($item->ticket_status==2)
                      <small class="badge badge-warning"><i class="far fa-clock"></i> in manager executive</small>   
                    
                    @elseif($item->ticket_status==3)
                      <small class="badge badge-primary"><i class="far fa-clock"></i> in accountant</small>
                    
                    @else($item->ticket_status==4)
                      <small class="badge badge-success"> archived</small>
                     
                    @endif
                    
              </th>
        <th><a type="button" class="btn btn-warning" data-id="{{$item->s_no}}" data-toggle="modal" data-target="#supplier-show"><i class="fas fa-pencil-alt "></i></a></th>
      </tr>
      <tr>
       
      @endforeach
    </tbody>
  </table>
  {{$data->links()}}
</div>

              <div class="tab-pane fade" id="custom-content-above-bus" role="tabpanel" aria-labelledby="custom-content-above-bus-tab">
              <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Employee Name</th>
        <th>Status</th>
        <th> Remark</th>
       
      </tr>
    </thead>
    <tbody>
    @foreach($data1 as $item)
    <tr>
        <th>{{$item->bus_id}}</th>
        <th>{{$item->emp_first_name}} {{$item->emp_last_name}}</th>
        <th>
          @if($item->bus_status==1)
            <small class="badge badge-danger"><i class="far fa-clock"></i> in sales executive</small>
          
                    @elseif($item->bus_status==2)
                      <small class="badge badge-warning"><i class="far fa-clock"></i> in manager executive</small>   
                    
                    @elseif($item->bus_status==3)
                      <small class="badge badge-primary"><i class="far fa-clock"></i> in accountant</small>
                    
                    @else($item->bus_status==4)
                      <small class="badge badge-success"> archived</small>
                     
                    @endif
                    
              </th>
        <th><a type="button" class="btn btn-warning" data-id="{{$item->s_no}}" data-toggle="modal" data-target="#supplier-show"><i class="fas fa-pencil-alt "></i></a></th>
      </tr>
      <tr>
       
      @endforeach
    </tbody>
  </table>
  {{$data->links()}}
              </div>
              <div class="tab-pane fade" id="custom-content-above-hotels" role="tabpanel" aria-labelledby="custom-content-above-hotels-tab">
              <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Employee Name</th>
        <th>Status</th>
        <th> Remark</th>
       
      </tr>
    </thead>
    <tbody>
    @foreach($data2 as $item)
    <tr>
        <th>{{$item->hotel_id}}</th>
        <th>{{$item->emp_first_name}} {{$item->emp_last_name}}</th>
        <th>
          @if($item->hotel_status==1)
            <small class="badge badge-danger"><i class="far fa-clock"></i> in sales executive</small>
          
                    @elseif($item->hotel_status==2)
                      <small class="badge badge-warning"><i class="far fa-clock"></i> in manager executive</small>   
                    
                    @elseif($item->hotel_status==3)
                      <small class="badge badge-primary"><i class="far fa-clock"></i> in accountant</small>
                    
                    @else($item->hotel_status==4)
                      <small class="badge badge-success"> archived</small>
                      
                    @endif
                    
              </th>
        <th><a type="button" class="btn btn-warning" data-id="{{$item->s_no}}" data-toggle="modal" data-target="#supplier-show"><i class="fas fa-pencil-alt "></i></a></th>
      </tr>
      <tr>
       
      @endforeach
    </tbody>
  </table>
 
  {{$data->links()}}

              </div>
              <div class="tab-pane fade" id="custom-content-above-visa" role="tabpanel" aria-labelledby="custom-content-above-visa-tab">
              <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Employee Name</th>
        <th>Status</th>
        <th> Remark</th>
       
      </tr>
    </thead>
    <tbody>
    @foreach($data3 as $item)
    <tr>
        <th>{{$item->visa_id}}</th>
        <th>{{$item->emp_first_name}} {{$item->emp_last_name}}</th>
        <th>
          @if($item->visa_status==1)
            <small class="badge badge-danger"><i class="far fa-clock"></i> in sales executive</small>
          
                    @elseif($item->visa_status==2)
                      <small class="badge badge-warning"><i class="far fa-clock"></i> in manager executive</small>   
                    
                    @elseif($item->visa_status==3)
                      <small class="badge badge-primary"><i class="far fa-clock"></i> in accountant</small>
                    
                    @else($item->visa_status==4)
                      <small class="badge badge-success"> archived</small>
                    
                    @endif
                    
              </th>
        <th><a type="button" class="btn btn-warning" data-id="{{$item->s_no}}" data-toggle="modal" data-target="#supplier-show"><i class="fas fa-pencil-alt "></i></a></th>
      </tr>
      <tr>
       
      @endforeach
    </tbody>
  </table>
   <!--  start add Modal -->
<div class="modal fade" id="supplier-show"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="GET" id="remark_body" >

   
    
    <input type="checkbox" name='remark[]' value="refernce" onChange="toggleDiv()" /> Refernce <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="refernce1" placeholder="refernce" name="refernce" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="passenger_name" onChange="toggleDiv2()"> Passenger name <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="passenger_name1" placeholder="passenger_name" name="passenger_name" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="voucher_number" onChange="toggleDiv3()"> Voucher number <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="voucher_number1" placeholder="voucher_number" name="voucher_number" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="country" onChange="toggleDiv4()"> Country <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="country1" placeholder="country" name="country" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="visa_type" onChange="toggleDiv5()"> Visa type <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="visa_type1" placeholder="visa_type" name="visa_type" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="visa_info" onChange="toggleDiv6()" /> Visa info<br/>
    <div class="form-group mb-3">
      <input class="form-control" id="visa_info1" placeholder="visa_info" name="visa_info" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="due_to_supp" onChange="toggleDiv7()"> Supplier <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="due_to_supp1" placeholder="due_to_supp" name="due_to_supp" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="provider_cost" onChange="toggleDiv8()"> Provider cost <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="provider_cost1" placeholder="provider_cost" name="provider_cost" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="cost" onChange="toggleDiv9()"> Cost <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="cost1" placeholder="cost" name="cost" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="passnger_currency" onChange="toggleDiv10()"> Passnger currency <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="passnger_currency1" placeholder="passnger_currency" name="passnger_currency" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="remark" onChange="toggleDiv11()"> Remark <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="remark1" placeholder="remark" name="remark" style="display:none;">
    </div>
    <input type="checkbox" name='remark[]' value="attachment" onChange="toggleDiv12()"> Attachment <br/>
    <div class="form-group mb-3">
      <input class="form-control" id="attachment1" placeholder="attachment" name="attachment" style="display:none;">
    </div>

    <button type="submit" class="btn btn-primary" name="submit">send</button>
      
</form>
     
      <div class="modal-footer">
      <a href="/displaySalesManager/saved"><button type="button" class="btn btn-secondary   m-3 p-2 float-left" data-dismiss="modal" >Close</button></a>
      
      </div>
    </div>
  </div>
</div>
<!-- end add model-->

  {{$data->links()}}
              </div>
              <div class="tab-pane fade" id="custom-content-above-car" role="tabpanel" aria-labelledby="custom-content-above-car-tab">
              <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Employee Name</th>
        <th>Status</th>
        <th> Remark</th>
       
      </tr>
    </thead>
    <tbody>
    @foreach($data4 as $item)
    <tr>
        <th>{{$item->car_id}}</th>
        <th>{{$item->emp_first_name}} {{$item->emp_last_name}}</th>
        <th>
          @if($item->car_status==1)
            <small class="badge badge-danger"><i class="far fa-clock"></i> in sales executive</small>
          
                    @elseif($item->car_status==2)
                      <small class="badge badge-warning"><i class="far fa-clock"></i> in manager executive</small>   
                    
                    @elseif($item->car_status==3)
                      <small class="badge badge-primary"><i class="far fa-clock"></i> in accountant</small>
                    
                    @else($item->car_status==4)
                      <small class="badge badge-success"> archived</small>
                      
                    @endif
                    
              </th>
        <th><a type="button" class="btn btn-warning" data-id="{{$item->s_no}}" data-toggle="modal" data-target="#supplier-show"><i class="fas fa-pencil-alt "></i></a></th>
      </tr>
      <tr>
       
      @endforeach
    </tbody>
  </table>
  {{$data->links()}}
              </div>
              <div class="tab-pane fade" id="custom-content-above-medical" role="tabpanel" aria-labelledby="custom-content-above-medical-tab">
              <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Employee Name</th>
        <th>Status</th>
        <th> Remark</th>
       
      </tr>
    </thead>
    <tbody>
    @foreach($data5 as $item)
    <tr>
        <th>{{$item->med_id}}</th>
        <th>{{$item->emp_first_name}} {{$item->emp_last_name}}</th>
        <th>
          @if($item->medical_status==1)
            <small class="badge badge-danger"><i class="far fa-clock"></i> in sales executive</small>
          
                    @elseif($item->medical_status==2)
                      <small class="badge badge-warning"><i class="far fa-clock"></i> in manager executive</small>   
                    
                    @elseif($item->medical_status==3)
                      <small class="badge badge-primary"><i class="far fa-clock"></i> in accountant</small>
                    
                    @else($item->medical_status==4)
                      <small class="badge badge-success"> archived</small>
                      
                    @endif
                    
              </th>
        <th><a type="button" class="btn btn-warning" data-id="{{$item->s_no}}" data-toggle="modal" data-target="#supplier-show"><i class="fas fa-pencil-alt "></i></a></th>
      </tr>
      <tr>
       
      @endforeach
    </tbody>
  </table>
  {{$data->links()}}
              </div>
              <div class="tab-pane fade" id="custom-content-above-general" role="tabpanel" aria-labelledby="custom-content-above-general-tab">
              <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Employee Name</th>
        <th>Status</th>
        <th> Remark</th>
       
      </tr>
    </thead>
    <tbody>
    @foreach($data6 as $item)
    <tr>
        <th>{{$item->gen_id}}</th>
        <th>{{$item->emp_first_name}} {{$item->emp_last_name}}</th>
        <th>
          @if($item->general_status==1)
            <small class="badge badge-danger"><i class="far fa-clock"></i> in sales executive</small>
          
                    @elseif($item->general_status==2)
                      <small class="badge badge-warning"><i class="far fa-clock"></i> in manager executive</small>   
                    
                    @elseif($item->general_status==3)
                      <small class="badge badge-primary"><i class="far fa-clock"></i> in accountant</small>
                    
                    @else($item->general_status==4)
                      <small class="badge badge-success"> archived</small>
                      
                    @endif
                    
              </th>
        <th><a type="button" class="btn btn-warning" data-id="{{$item->s_no}}" data-toggle="modal" data-target="#supplier-show"><i class="fas fa-pencil-alt "></i></a></th>
      </tr>
      <tr>
       
      @endforeach
    </tbody>
  </table>
  {{$data->links()}}
              </div>


            </div>
  </div>
  <!-- /.content-wrapper -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->
        <script type="text/javascript">
function toggleDiv() {

// first check if display then hide otherwise show
if ((document.getElementById('refernce1').style.display == 'none')) {
 document.getElementById('refernce1').style.display="block";
}
else {
document.getElementById('refernce1').style.display="none";
}
}

function toggleDiv2() {

// first check if display then hide otherwise show
if ((document.getElementById('passenger_name1').style.display == 'none')) {
 document.getElementById('passenger_name1').style.display="block";
}
else {
document.getElementById('passenger_name1').style.display="none";
}
}

function toggleDiv3() {

// first check if display then hide otherwise show
if ((document.getElementById('voucher_number1').style.display == 'none')) {
 document.getElementById('voucher_number1').style.display="block";
}
else {
document.getElementById('voucher_number1').style.display="none";
}
}
function toggleDiv4() {

// first check if display then hide otherwise show
if ((document.getElementById('country1').style.display == 'none')) {
 document.getElementById('country1').style.display="block";
}
else {
document.getElementById('country1').style.display="none";
}
}
function toggleDiv5() {

// first check if display then hide otherwise show
if ((document.getElementById('visa_type1').style.display == 'none')) {
 document.getElementById('visa_type1').style.display="block";
}
else {
document.getElementById('visa_type1').style.display="none";
}
}
function toggleDiv6() {

// first check if display then hide otherwise show
if ((document.getElementById('visa_info1').style.display == 'none')) {
 document.getElementById('visa_info1').style.display="block";
}
else {
document.getElementById('visa_info1').style.display="none";
}
}
function toggleDiv7() {

// first check if display then hide otherwise show
if ((document.getElementById('due_to_supp1').style.display == 'none')) {
 document.getElementById('due_to_supp1').style.display="block";
}
else {
document.getElementById('due_to_supp1').style.display="none";
}
}
function toggleDiv8() {

// first check if display then hide otherwise show
if ((document.getElementById('provider_cost1').style.display == 'none')) {
 document.getElementById('provider_cost1').style.display="block";
}
else {
document.getElementById('provider_cost1').style.display="none";
}
}
function toggleDiv9() {

// first check if display then hide otherwise show
if ((document.getElementById('cost1').style.display == 'none')) {
 document.getElementById('cost1').style.display="block";
}
else {
document.getElementById('cost1').style.display="none";
}
}

function toggleDiv10() {

// first check if display then hide otherwise show
if ((document.getElementById('passnger_currency1').style.display == 'none')) {
 document.getElementById('passnger_currency1').style.display="block";
}
else {
document.getElementById('passnger_currency1').style.display="none";
}
}
function toggleDiv11() {

// first check if display then hide otherwise show
if ((document.getElementById('remark1').style.display == 'none')) {
 document.getElementById('remark1').style.display="block";
}
else {
document.getElementById('remark1').style.display="none";
}
}
function toggleDiv12() {

// first check if display then hide otherwise show
if ((document.getElementById('attachment1').style.display == 'none')) {
 document.getElementById('attachment1').style.display="block";
}
else {
document.getElementById('attachment1').style.display="none";
}
}


$('#remark_body').on('submit',function(e){
         e.preventDefault();
         $.ajax({
             type:'GET',
             url:'/displaySalesManager',
             data:$('#remark_body').serialize(),
             success:function(response){console.log(response);
             alert("data saved");
             },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });

    });
</script>
@endsection



