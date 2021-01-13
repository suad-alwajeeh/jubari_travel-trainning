@extends('app_layouts.master')
@section('main_content')

<style>
    @media screen and (min-width: 676px) {
      #myModal_acc .modal-dialog {
          max-width: 95%; /* New width for default modal */
        }
    }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @if (session('seccess'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('seccess') }}
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
    @endif
  <div class="container p-4">
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row" >
          <div class="col-12" style="display:none">
            <div class="info-box">
            <div class='row'>
                <div class='col-4'>
                <div class='row'>
              <div class='col-6'>
                <button class="btn btn-primary"></button>
                <button class="btn btn-danger"></button>
                <button class="btn btn-warning"></button>
              </div>
              <div class='col-6'>
                <button class="btn btn-info"></button>
                <button class="btn btn-secondary"></button>
                <button class="btn btn-success"></button>
              </div>
              </div>
                </div>
                <div class='col-4'>
                <div class='row'>
              <div class='col-6'>
                <button class="btn btn-primary"></button>
                <button class="btn btn-danger"></button>
                <button class="btn btn-warning"></button>
              </div>
              <div class='col-6'>
                <button class="btn btn-info"></button>
                <button class="btn btn-secondary"></button>
                <button class="btn btn-success"></button>
              </div>
              </div>
                </div>

            </div>
            
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12">

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">
               service name
                </h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-striped">
                
    <thead>
      <tr>
        <th>id</th>
        <th>passenger</th>
        <th>issuedBy</th>
        <th>issuedDate</th>
        <th>provider</th>
        <th>provider cost</th>
        <th>currency</th>
        <th>customer</th>
        <th>passenger cost</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
      <tr id="serr{{$item->t_id}}" >
      <td>{{$item->t_id}}</td>
      <td>{{$item->t_pn}}</td>
      <td>{{$item->u_name}}</td>
      <td>{{$item->t_idate}}</td>
      <td>{{$item->s_name}}</td>
      <td>{{$item->t_pc}}</td>
      <td>{{$item->cur_n}}</td>
      <td>{{$item->u_name}}</td>
      <td>{{$item->cost}}</td>
        <td>
        <div class="btn-group btn-group-sm">
        <a type="button" class="btn btn-info"   onclick="display_data('{{$item->t_id}}',{{$item->st_id}})" ><i class="fas fa-eye "></i></a>
        <a type="button" class="btn btncolor" onclick="bill_num()" ><i class="fas fa-paper-plane "></i></a>

</div>
<!-- The Modal -->
<div class="modal fade" id="myModal_acc">
  <div class="modal-dialog su_modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
      <a  type="button" class="btn btn-danger" data-dismiss="modal">ok</a>
      <a  type="button" class="btn btn-success su_send_remark" onclick="sendremark()">send remark</a>
     
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="details">           
         </div>
         <div class="modal-footer">
       </div>
      </div>
    </div>
</div>
   
        </td>
      </tr>
      <!-- The Modal -->
 <div class="modal fade text-center" id="myModalcus_del">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
     <h4> Send Service</h4>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="details1">
     <p class="text-center"> Are You Sure You Want To Send This Service</p><br><br>
      <input type=text hidden=hidden value="{{$item->uuser_resiver}}" class="form-control mt-2 mb-2" id=user_resiver name=user_resiver>
      <input type=text hidden=hidden value="{{$item->s_num}}" class="form-control mt-2 mb-2" id=nummm name=nummm>
      <a  type="button" onclick="send_bill('{{$item->t_id}}',{{$item->st_id}})" class="btn btncolor" data-dismiss="modal">Send</a>
      <a  type="button" class="btn btn-danger" data-dismiss="modal">cansel</a>
      </div>
   </div>
  </div>
</div>
     @endforeach
    </tbody>
  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</section>
</div>
</div>

<script>
function bill_num(){
  $('#myModalcus_del').modal('show');
}
function send_bill(service,main){
var bill=$('#bill_num').val();
var user={{ Auth::user()->id }};
var reciver=$('#user_resiver').val();
var num=$('#nummm').val();
$.ajax({
     url:'/sales/saved/'+service+'/'+main+'/'+num+'/'+user+'/'+reciver,
       type:'get',
  success:function(response){
    $("#serr"+service).css('display','none');
    location.reload();
  }
  });
}
function display_data(id,type){
  //alert('lll');

  console.log(type);
   if(type==1){
    $.ajax({
     url:'/sales/ticket/'+id,
       type:'get',
       dataType:'json',
  success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var tic='<input hidden=hidden id=num name=num value='+response[0].ticket_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].tecket_id+'><h4 class="modal-title">ticket service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    tic+='<tr><td>Issue Date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
    tic+='<tr><td>Empolyee Name<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
    tic+='<tr><td>Refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Airline Name</td><td>'+response[0].airline_name+'</td><td class="su_t_h"><input id="airline_name" oninput=send("airline_name","'+response[0].airline_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("airline_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("airline_name")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Ticket Number</td><td>'+response[0].ticket_number+'</td><td class="su_t_h"><input id="ticket_number" oninput=send("ticket_number","'+response[0].ticket_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("ticket_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("ticket_number")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Airline Code</td><td>'+response[0].ticket+'</td><td class="su_t_h"><input id="ticket" oninput=send("ticket","'+response[0].ticket+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("ticket")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("ticket")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Dep City</td><td>'+response[0].Dep_city1+'</td><td class="su_t_h"><input id="Dep_city1" oninput=send("Dep_city1","'+response[0].Dep_city1+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Dep_city1")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("Dep_city1")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Dep City2</td><td>'+response[0].Dep_city2+'</td><td class="su_t_h"><input id="Dep_city2" oninput=send("Dep_city2","'+response[0].Dep_city2+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Dep_city2")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("Dep_city2")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
     tic+='<tr><td>Arr City</td><td>'+response[0].arr_city1+'</td><td class="su_t_h"><input id="arr_city1" oninput=send("arr_city1","'+response[0].arr_city1+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("arr_city1")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("arr_city1")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Arr City2</td><td>'+response[0].arr_city2+'</td><td class="su_t_h"><input id="arr_city2" oninput=send("arr_city2","'+response[0].arr_city2+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("arr_city2")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("arr_city2")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Dep Date</td><td>'+response[0].dep_date1+'</td><td class="su_t_h"><input id="dep_date1" oninput=send("dep_date1","'+response[0].dep_date1+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("dep_date1")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("dep_date1")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Dep Date2</td><td>'+response[0].dep_date2+'</td><td class="su_t_h"><input id="dep_date2" oninput=send("dep_date2","'+response[0].dep_date2+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("dep_date2")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("dep_date2")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Provider Name</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Provider Cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Provider Currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td> Passenger Cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';
    $('#myModal_acc').modal('show');
    $('#details').html(tic);
     console.log(response[0]);
  }
  }
  });
}
 if(type==2){
 // alert(id);
$.ajax({
url:'/sales/bus/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    $('#myModal_acc').modal('show');
    $('#details').html('<input hidden=hidden id=num name=num value='+response[0].bus_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].bus_id+'><h4 class="modal-title">bus service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody><tr><td>Issue_date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")>cansel</button></div></td></tr><tr><td>Issue_by<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")>cansel</button></div></td></tr><tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")>cansel</button></div></td></tr><tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")>cansel</button></div></td></tr><tr><td>bus_number</td><td>'+response[0].bus_number+'</td><td class="su_t_h"><input id="bus_number" oninput=send("bus_number","'+response[0].bus_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("bus_number")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("bus_number")>cansel</button></div></td></tr><tr><td>Dep_city</td><td>'+response[0].Dep_city+'</td><td class="su_t_h"><input id="Dep_city" oninput=send("Dep_city","'+response[0].Dep_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Dep_city")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("Dep_city")>cansel</button></div></td></tr><tr><td>arr_city</td><td>'+response[0].arr_city+'</td><td class="su_t_h"><input id="arr_city" oninput=send("arr_city","'+response[0].arr_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("arr_city")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("arr_city")>cansel</button></div></td></tr><tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody><td>dep_date</td><td>'+response[0].dep_date+'</td><td class="su_t_h"><input id="dep_date" oninput=send("dep_date","'+response[0].dep_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("dep_date")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("dep_date")>cansel</button></div></td></tr><tr><td>bus_name</td><td>'+response[0].bus_name+'</td><td class="su_t_h"><input id="bus_name" oninput=send("bus_name","'+response[0].bus_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("bus_name")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("bus_name")>cansel</button></div></td></tr><tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")>cansel</button></div></td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")>cansel</button></div></td></tr><tr><td>currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")>cansel</button></div></td></tr><tr><td>cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")>cansel</button></div></td></tr><tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")>add remark</button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")>cansel</button></div></td></tr></tbody></table></div></div>');
    console.log(response[0]);
  }
}
});
}
if(type==3){
 // alert(id);
$.ajax({
url:'/sales/car/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var car='<input hidden=hidden id=num name=num value='+response[0].voucher_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].car_id+'><h4 class="modal-title">car service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
car+='<tr><td>Issue Date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Employee Name<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Car Info</td><td>'+response[0].car_info+'</td><td class="su_t_h"><input id="car_info" oninput=send("car_info","'+response[0].car_info+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("car_info")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("car_info")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Car Number</td><td>'+response[0].voucher_number+'</td><td class="su_t_h"><input id="voucher_number" oninput=send("voucher_number","'+response[0].voucher_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("voucher_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("voucher_number")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Dep City</td><td>'+response[0].Dep_city+'</td><td class="su_t_h"><input id="Dep_city" oninput=send("Dep_city","'+response[0].Dep_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Dep_city")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("Dep_city")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
car+='<tr><td>Arr City</td><td>'+response[0].arr_city+'</td><td class="su_t_h"><input id="arr_city" oninput=send("arr_city","'+response[0].arr_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("arr_city")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("arr_city")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Dep Date</td><td>'+response[0].dep_date+'</td><td class="su_t_h"><input id="dep_date" oninput=send("dep_date","'+response[0].dep_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("dep_date")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("dep_date")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Provider Cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Provider Currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Passenger Cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';

    $('#myModal_acc').modal('show');
    $('#details').html(car);
        console.log(response[0]);
  }
}
});
}
if(type==7){
 // alert(id);
$.ajax({
url:'/sales/general/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var gg='<input hidden=hidden id=num name=num value='+response[0].voucher_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].gen_id+'><h4 class="modal-title">car service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
        gg+='<tr><td>Issue Date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>Employee Name <input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>Refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>General Info</td><td>'+response[0].gen_info+'</td><td class="su_t_h"><input id="gen_info" oninput=send("gen_info","'+response[0].gen_info+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("gen_info")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("gen_info")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>General Number</td><td>'+response[0].voucher_number+'</td><td class="su_t_h"><input id="voucher_number" oninput=send("voucher_number","'+response[0].voucher_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("voucher_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("voucher_number")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
        gg+='<tr><td>Busher Time</td><td>'+response[0].busher_time+'</td><td class="su_t_h"><input id="dep_date" oninput=send("busher_time","'+response[0].busher_time+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("busher_time")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("busher_time")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>Provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>Provider Cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>Provider currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>Passenger cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>passnger currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';
    $('#myModal_acc').modal('show');
    $('#details').html(gg);
         console.log(response[0]);
  }
}
});
}
if(type==4){
 // alert(id);
$.ajax({
url:'/sales/medical/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var meed='<input hidden=hidden id=num name=num value='+response[0].document_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].gen_id+'><h4 class="modal-title">medical service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    meed+='<tr><td>Issue Date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>Employee Name<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>Medical Info</td><td>'+response[0].med_info+'</td><td class="su_t_h"><input id="med_info" oninput=send("med_info","'+response[0].med_info+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("med_info")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("med_info")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>Document Number</td><td>'+response[0].document_number+'</td><td class="su_t_h"><input id="document_number" oninput=send("document_number","'+response[0].document_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("document_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("document_number")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    meed+='<tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>provider Cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>provider currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td> Passenger cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>passnger Currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';

    $('#myModal_acc').modal('show');
    $('#details').html(meed);
     console.log(response[0]);
  }
}
});
}
if(type==5){
 // alert(id);
$.ajax({
url:'/sales/hotel/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var hot='<input hidden=hidden id=num name=num value='+response[0].voucher_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].hotel_id+'><h4 class="modal-title">hotel service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    hot+='<tr><td>Issue Date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Employee Name<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>country</td><td>'+response[0].country+'</td><td class="su_t_h"><input id="country" oninput=send("country","'+response[0].country+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("country")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("country")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>city</td><td>'+response[0].city+'</td><td class="su_t_h"><input id="city" oninput=send("city","'+response[0].city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("city")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("city")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Hotel Number</td><td>'+response[0].voucher_number+'</td><td class="su_t_h"><input id="voucher_number" oninput=send("voucher_number","'+response[0].bus_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("voucher_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("bus_number")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Hotel Name</td><td>'+response[0].hotel_name+'</td><td class="su_t_h"><input id="hotel_name" oninput=send("hotel_name","'+response[0].hotel_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("hotel_name")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("hotel_name")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    hot+='<tr><td>Check Out</td><td>'+response[0].check_out+'</td><td class="su_t_h"><input id="check_out" oninput=send("check_out","'+response[0].check_out+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("check_out")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("check_out")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Check In</td><td>'+response[0].check_in+'</td><td class="su_t_h"><input id="check_in" oninput=send("check_in","'+response[0].check_in+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("check_in")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("check_in")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Provider Cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Provider currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Passenger cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';
    $('#myModal_acc').modal('show');
    $('#details').html(hot);
    console.log(response[0]);
  }
}
});
}
if(type==6){
 alert(id);
$.ajax({
url:'/sales/visa/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var car='<input hidden=hidden id=num name=num value='+response[0].voucher_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].visa_id+'><h4 class="modal-title">visa service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
car+='<tr><td>Issue Date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Employee Name<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Visa Number</td><td>'+response[0].voucher_number+'</td><td class="su_t_h"><input id="voucher_number" oninput=send("voucher_number","'+response[0].voucher_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("voucher_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("voucher_number")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Visa Type</td><td>'+response[0].visa_type+'</td><td class="su_t_h"><input id="visa_type" oninput=send("visa_type","'+response[0].visa_type+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("visa_type")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("visa_type")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
car+='<tr><td>Visa Info</td><td>'+response[0].visa_info+'</td><td class="su_t_h"><input id="visa_info" oninput=send("visa_info","'+response[0].visa_info+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("visa_info")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("visa_info")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Country</td><td>'+response[0].country+'</td><td class="su_t_h"><input id="country" oninput=send("country","'+response[0].country+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("country")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("country")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Provider Cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td> Provider currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Passnger cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Passnger Currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';

    $('#myModal_acc').modal('show');
    $('#details').html(car);
        console.log(response[0]);
  }
}
});
}
}

function display_input(id){
  $(".su_t_h").css('display','block');

  $("#"+id).css('display','block');
  $(".su_send_remark").css('display','block');

}

function hidden_input(id){
$("#"+id).css('display','none');
var status=0;
var oldval=0;
var newval=0;
$.ajax({
             type:'get',
             url:'/sales/add_remark/'+id+'/'+oldval+'/'+newval+'/'+status,
             data:{id:status},
             success:function(response){
               console.log(response);
             },
             error:function(error){
               console.log(error);
             } 
         });
}

function send(col,oldval){
  var newval=$('#'+col).val();
  var status=1;

$.ajax({
             type:'get',
             url:'/sales/add_remark/'+col+'/'+oldval+'/'+newval+'/'+status,
             data:{id:status},
             success:function(response){
               console.log(response);
               console.log(newval);
             },
             error:function(error){
               console.log(error);
             } 
         });
}
function sendremark(){
  var m=$('#main_service').val();
  var s=$('#service_id').val();
  var n=$('#num').val();
  var to=$('#to').val();
  var from={{ Auth::user()->id }};
  $.ajax({
             type:'get',
             url:'/sales/send_remark/'+m+'/'+s+'/'+to+'/'+from+'/'+n,
             data:{id:status},
             success:function(response){
               //$('#myModal_acc').modal('toggle');
              // $("#serr"+service).css('display','none'); 
               location.reload();   
             },
             error:function(error){
               console.log(error);
             } 
         });


}
</script>
  
  
  
  @endsection


