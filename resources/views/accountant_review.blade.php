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
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
      <div class="info-box">
          <div class='col-1'>
                <button onclick="add_color('007bff38')" class="btn bookmarkb"></button>
                <button onclick="add_color('ff696978')" class="btn  bookmarkr"></button>
                <button onclick="add_color('fff25c7d')" class="btn bookmarky"></button>
                <button onclick="add_color('69ff9082')" class="btn bookmarkg"></button>
                <button onclick="add_color('ff38ef4f')" class="btn bookmarkp"></button>
                <button onclick="add_color('fff')" class="btn bookmarkw"></button>
          </div>
                   <div class="form-group col-1" style="display:">
                  <label>service</label>
                  <!--select onchange="filter_item('filter_m_ser','=')" id="filter_m_ser" class="form-control select2" style="width: 100%;"-->
                  <select onchange="chang_stat()"  id="filter_m_ser" class="ses_repo_filter form-control select2" style="width: 100%;">
                                    <option selected="selected" value="0">all</option>
                    @foreach($data3 as $d3)
                    <option value="{{$d3->ser_id}}">{{$d3->ser_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-1">
                  <label>status</label>
                  <select onchange="filter_item('ses_status','in')" id="ses_status" class="ses_repo_filter form-control select2" data-placeholder="Select a State" style="width: 100%;">
                  <option value="no"></option>
                  <option value="1,2,3,4">all</option>
                  <option value="1">ok</option>
                  <option value="2">issue</option>
                  <option value="3">void</option>
                  <option value="4">refund</option>
                  </select>
                </div>
                   <div class="form-group col-2">
                  <label>issue date</label>
                  <select onchange="filter_item('issue_date','=')" id="issue_date" class="ses_repo_filter form-control select2" style="width: 100%;">
                  <option value="no"></option>
                  <option value="CURRENT_DATE()">today</option>
                  <option value="CURRENT_DATE()-1">yestrday</option>
                  </select>
                </div>
                   <div class="form-group col-2">
                  <label>issue by</label>
                  <select onchange="filter_item('user_id','=')" id="user_id" class="form-control select2" style="width: 100%;">
                  <option value="no"></option>
                  @foreach($data5 as $d5)
                    <option value="{{$d5->u_id}}">{{$d5->u_name}}</option>
                  @endforeach
                </select>
                </div>
                   <div class="form-group col-2">
                  <label>provider name</label>
                  <select onchange="filter_item('due_to_supp','=')" id="due_to_supp" class="form-control select2" style="width: 100%;">
                  <option value="no"></option>
                   @foreach($data4 as $d4)
                    <option value="{{$d4->s_no}}">{{$d4->supplier_name}}</option>
                  @endforeach
                  </select>
                </div>
                   <div class="form-group col-1">
                  <label> currency</label>
                  <select onchange="filter_item('ses_cur_id','=')" id="ses_cur_id" class="form-control select2" style="width: 100%;">
                 <option value="no"></option>
                  @foreach($data6 as $d6)
                  <option value="{{$d6->cur_id}}">{{$d6->cur_name}}</option>
                  @endforeach             
                     </select>
                </div>
                <div class=" form-group col-1 mt-4 pt-2">
                  <button class="btn btn-info disabled" id="ses_first_type" onclick="get_filter()">go</button>
                </div>
              </div>
  </div>
        <div class="row" >
          <div class="col-12">

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">
                @foreach($data1 as $item1)
                {{$item1}}
                @endforeach
                </h3>
                <a type="button" style="float:right;display:none" class="btn btn-outline-success" id="bill_for_all" onclick="bill_all()" ><i class="fas fa-plus ">add bill number for selected item</i></a>

              </div>
              
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                <!--div  class="alert so-alert-message" id="in_success_or_not" ><button type="button" data-dismiss="alert" class="close">&times;</button></div-->         
                <table id=""  class="table table-striped">
                
    <thead>
      <tr>
      <th>
      <input id="selectall" onclick="return selectall()" type="checkbox">
      </th>
      <th>id</th>
      <th>type</th>
      <th>issuedDate</th>
      <th>issuedBy</th>
      <th>passenger</th>
      <th>provider</th>
      <th>cost</th>
      <th>c</th>
      <th>cost</th>
        <th>status</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody id="filter_data_come_here">

    <?php $i=1;?>
@forelse($data as $lat)
          @if($lat->bookmark_how==Auth::user()->id)
      <tr style="background-color:#{{$lat->bookmark}}" id="serr{{$lat->t_id}}" >
      @else
      <tr style="" id="serr{{$lat->t_id}}" >
      @endif
      <td>
      <input hidden=hidden id=manager_id name=manager_id value='{{$lat->manager_id}}'>
      <input type=text hidden=hidden value="{{$lat->s_num}}" class="form-control mt-2 mb-2" id=nummm_all >
      <input type=text hidden=hidden value="{{$lat->uuser_resiver}}" class="form-control mt-2 mb-2" id=user_resiver_all >
      <input type="checkbox" id="serv" onclick="selectone()" name="su_service" class="selectbox " value="{{$lat->t_id}}"></td>
<input type="hidden" id="main_serv" value="{{$lat->st_id}}">
    </td>
    <td><?php echo $i; ?></td>
    <td>
                      @if($lat->st_id==1)
                      Ticket
                      @elseif($lat->st_id==2)
                      Bus
                      @elseif($lat->st_id==3)
                      Car	
                      @elseif($lat->st_id==4)
                      Medical
                      @elseif($lat->st_id==5)
                      Hotel	
                      @elseif($lat->st_id==6)
                      Visa	
                      @elseif($lat->st_id==7)
                      General	
                      @endif
                      </td>
    <td>{{$lat->t_idate}}</td>
    <td>{{$lat->u_name}}</td>
      <td>{{$lat->t_pn}}</td>
      <td>{{$lat->s_name}}</td>
      <td>{{$lat->tp_c}}</td>
      <td>{{$lat->cur_n}}</td>
      <td>{{$lat->cost}}</td>
      <td>
      @if($lat->s_st==1)
                      <span class="badge badge-success">ok</span>
                      @elseif($lat->s_st==2)
                      <span class="badge badge-info">issue</span>
                      @elseif($lat->s_st==3)
                      <span class="badge badge-danger">void</span>
                      @elseif($lat->s_st==4)
                      <span class="badge badge-primary">refund</span>
                      @endif
                      </td>
        <td>
        <div class="btn-group btn-group-sm">
        <a type="button" class="btn btn-outline-info su_all_c"   onclick="display_data('{{$lat->t_id}}',{{$lat->st_id}})" ><i class="fas fa-eye "></i></a>
        <a type="button" class="btn btn-outline-success su_all_c" onclick="bill_num()" ><i class="fas fa-plus ">bill_num</i></a>
</div>
<!-- The Modal -->
<div class="modal fade" id="myModal_acc">
  <div class="modal-dialog su_modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
      <a  type="button" class="btn btn-outline-success su_send_remark ses_valiide" id="" onclick="sendremark()">send remark</a>
     
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
     <h4> bill number </h4>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="details1">
      <input type=number class="form-control mt-2 mb-2" id=bill_num name=bill>
      <input type=text hidden=hidden value="{{$lat->uuser_resiver}}" class="form-control mt-2 mb-2" id=user_resiver name=user_resiver>
      <input type=text hidden=hidden value="{{$lat->s_num}}" class="form-control mt-2 mb-2" id=nummm name=nummm>
      <a  type="button" onclick="send_bill('{{$lat->t_id}}',{{$lat->st_id}})" class="btn btn-outline-success" data-dismiss="modal">save</a>
      <a  type="button" class="btn btn-outline-danger" data-dismiss="modal">cansel</a>
      </div>
   </div>
  </div>
</div>
<div class="modal fade text-center" id="bill_all">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
     <h4> bill number </h4>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="details1">
      <input type=number class="form-control mt-2 mb-2" id=bill_num_all name=bill>
      <a  type="button" onclick="add_bill_for_all()" class="btn btn-outline-success" data-dismiss="modal">save</a>
      <a  type="button" class="btn btn-outline-danger" data-dismiss="modal">cansel</a>
      </div>
   </div>
  </div>
</div>
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
        <!-- /.row -->
</section>
</div>

<script>
function filter_item(col,op){
    var val=$('#'+col).val();
    if(col=="ses_status"){
val='('+$('#'+col).val()+')';
    }
    $.ajax({
     url:'/accountant/filter_item/'+col+'/'+op+'/'+val,
       type:'get',
  success:function(response){
  }
  });
  }
  function get_filter(){
var m=$('#filter_m_ser').val();
    $.ajax({
     url:'/accountant/filter_do/'+m,
       type:'get',
       dataType:'json',
  success:function(response){
    // $(".ses_repo_filter").reset();

  if(response.length==0){
    $('#filter_data_come_here').html('<tr><td class=text-center colspan="10">There is No data in table...<td></tr>');
  }else{
   // alert("found thing");
   $('#in_success_or_not').text('filter done successfuly');
    $('#filter_data_come_here').html('');
var user_f={{Auth::user()->id}};
var type_f="";
var status_f="";
var count_f=1;
var tr_f="";

              $.map(response ,function(k,v){
                 // console.log(k.st_id);
                  for(var i in k){
                  //  console.log(k[i].st_id);
                  }
                 // alert(k.st_id);
                  if(k.s_st==1){
                    status_f='<span class="badge badge-success">ok</span>';
                  }if(k.s_st==2){
                    status_f=' <span class="badge badge-info">issue</span>';
                  }if(k.s_st==3){
                    status_f='<span class="badge badge-danger">void</span>';
                  }if(k.s_st==4){
                    status_f='<span class="badge badge-primary">refund</span>';
                  }

                  if(k.st_id==1){
                      type="Ticket";
                  }if(k.st_id==2){
                      type="Bus";
                  }if(k.st_id==3){
                      type="Car";
                  }if(k.st_id==4){
                      type="Medical";
                  }if(k.st_id==5){
                      type="Hotel";
                  }if(k.st_id==6){
                      type="Visa";
                  }if(k.st_id==7){
                      type="General";
                  }

if(k.bookmark_how==user_f){
  tr_f='<tr style="background-color:#'+k.bookmark+'" id="serr'+k.t_id+'" >';
}else{
  tr_f='<tr style="" id="serr'+k.t_id+'" >';
}
//alert("found thing"+tr_f);


        var content_of_f=tr_f+'<td>';
        content_of_f+='<input type=text hidden=hidden value="'+k.s_num+'" class="form-control mt-2 mb-2" id=nummm_all >';
        content_of_f+='<input type=text hidden=hidden value="'+k.uuser_resiver+'" class="form-control mt-2 mb-2" id=user_resiver_all >';
        content_of_f+='<input type="checkbox" id="serv" onclick="selectone()" name="su_service" class="selectbox " value="'+k.t_id+'"></td>';
        content_of_f+='<input type="hidden" id="main_serv" value="'+k.st_id+'">';
        content_of_f+='</td>';
        content_of_f+='<td>'+count_f+'</td>';
        content_of_f+='<td>'+type+'</td>';
        content_of_f+='<td>'+k.t_idate+'</td>';
        content_of_f+='<td>'+k.u_name+'</td>';
        content_of_f+='<td>'+k.t_pn+'</td>';
        content_of_f+='<td>'+k.s_name+'</td>';
        content_of_f+='<td>'+k.tp_c+'</td>';
        content_of_f+='<td>'+k.cur_n+'</td>';
        content_of_f+='<td>'+k.cost+'</td>';
        content_of_f+='<td>'+status_f+'</td>';
        content_of_f+='<td><div class="btn-group btn-group-sm"><a type="button" class="btn btn-outline-info su_all_c"   onclick=display_data('+'"'+k.t_id+'"'+','+k.st_id+') ><i class="fas fa-eye "></i></a><a type="button" class="btn btn-outline-success su_all_c" onclick="bill_num()" ><i class="fas fa-plus ">bill_num</i></a></div>';
        content_of_f+='<div class="modal fade" id="myModal_acc"><div class="modal-dialog su_modal-dialog"><div class="modal-content"><div class="modal-header"><a  type="button" class="btn btn-outline-success su_send_remark" onclick="sendremark()">send remark</a><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body" id="details"></div><div class="modal-footer"></div></div></div></div></td></tr><div class="modal fade text-center" id="myModalcus_del"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4> bill number </h4></div><div class="modal-body" id="details1"><input type=number class="form-control mt-2 mb-2" id=bill_num name=bill><input type=text hidden=hidden value="'+k.uuser_resiver+'" class="form-control mt-2 mb-2" id=user_resiver name=user_resiver><input hidden=hidden id=manager_id name=manager_id value='+k.manager_id+'><input type=text hidden=hidden value="'+k.s_num+'" class="form-control mt-2 mb-2" id=nummm name=nummm><a  type="button" onclick="send_bill('+'"'+k.t_id+'"'+','+k.st_id+')" class="btn btn-outline-success" data-dismiss="modal">save</a><a  type="button" class="btn btn-outline-danger" data-dismiss="modal">cansel</a></div></div></div></div><div class="modal fade text-center" id="bill_all"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4> bill number </h4></div><div class="modal-body" id="details1"><input type=number class="form-control mt-2 mb-2" id=bill_num_all name=bill><a  type="button" onclick=add_bill_for_all() class="btn btn-outline-success" data-dismiss="modal">save</a><a  type="button" class="btn btn-outline-danger" data-dismiss="modal">cansel</a></div></div></div></div></td></tr>';
                  $('#filter_data_come_here').append(content_of_f);
                  ++count_f;
               });

  }
  } 
    });
  
  }
  
  function selectall() {
    var checkBox = document.getElementById("selectall");
    if (checkBox.checked == true){
      $('.su_all_c').addClass('disabled'); 
      $('#bill_for_all').css('display','block');
   $("input[name='su_service']").prop('checked', true);
    }
   else if (checkBox.checked == false){
    $('.su_all_c').removeClass('disabled'); 
    $('#bill_for_all').css('display','none');
   $("input[name='su_service']").prop('checked', false);
    }
 }

function selectone() {
  if (!$(this).prop("checked")) {
    $("#selectall").prop("checked", false);
    $('.su_all_c').removeClass('disabled'); 
    $('#bill_for_all').css('display','none');

  }
}
function chang_stat(){
            $('#ses_first_type').removeClass('disabled');
          }
function add_bill_for_all(){
  var num=$('#nummm_all').val();
  var user={{ Auth::user()->id }};
  var main=$('#main_serv').val();
  var resiver=$('#user_resiver_all').val();
  var bill=$('#bill_num_all').val();
  var manager=$('#manager_id').val();
  var service_checked=[];
  $.each($("input[name='su_service']:checked"),function(){
    service_checked.push($(this).val());
    $.ajax({
     url:'/accountant/bill_num/'+$(this).val()+'/'+main+'/'+bill+'/'+user+'/'+resiver+'/'+num+'/'+manager,
       type:'get',
  success:function(response){
    $('#in_success_or_not').text('bill number added successfuly');

    location.reload();
  }
  });
  });
}
function add_color(color){
  var user={{ Auth::user()->id }};
  var main=$('#main_serv').val();
  var service_checked=[];
  $.each($("input[name='su_service']:checked"),function(){
    service_checked.push($(this).val());
    $('#serr'+$(this).val()).css('background-color','#'+color);
    $.ajax({
     url:'/accountant/add_bookmark/'+main+'/'+$(this).val()+'/'+color+'/'+user,
       type:'get',
  success:function(response){
  }
  });
  });
}
function bill_num(){
  $('#myModalcus_del').modal('show');
  
}
function bill_all(){
  $('#bill_all').modal('show');
  
}
function send_bill(service,main){
var bill=$('#bill_num').val();
var user={{ Auth::user()->id }};
var reciver=$('#user_resiver').val();
var num=$('#nummm').val();
var manager=$('#manager_id').val();

$.ajax({
  url:'/accountant/bill_num/'+service+'/'+main+'/'+bill+'/'+user+'/'+reciver+'/'+num+'/'+manager,
       type:'get',
  success:function(response){
location.reload();
  }
  });
}
function display_data(id,type){
  console.log(type);
   if(type==1){
    $.ajax({
     url:'/accountant/ticket/'+id,
       type:'get',
       dataType:'json',
  success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{

    var tic='<input hidden=hidden id=manager_how  name=manager_how value='+response[0].manager_id+'><input hidden=hidden id=num name=num value='+response[0].ticket_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].tecket_id+'><h4 class="modal-title">ticket service details</h4><div class=row><div class="col-md-6 col-sm-12"><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    tic+='<tr><td>Issue date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
    tic+='<tr><td>Issue by<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
    tic+='<tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>passenger name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>airline name</td><td>'+response[0].airline_name+'</td><td class="su_t_h"><input id="airline_name" oninput=send("airline_name","'+response[0].airline_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("airline_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("airline_name")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>ticket number</td><td>'+response[0].ticket_number+'</td><td class="su_t_h"><input id="ticket_number" oninput=send("ticket_number","'+response[0].ticket_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("ticket_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("ticket_number")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>ticket</td><td>'+response[0].ticket+'</td><td class="su_t_h"><input id="ticket" oninput=send("ticket","'+response[0].ticket+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("ticket")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("ticket")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Dep city1</td><td>'+response[0].Dep_city+'</td><td class="su_t_h"><input id="Dep_city1" oninput=send("Dep_city1","'+response[0].Dep_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Dep_city1")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("Dep_city1")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>Dep city2</td><td>'+response[0].Dep_city2+'</td><td class="su_t_h"><input id="Dep_city2" oninput=send("Dep_city2","'+response[0].Dep_city2+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Dep_city2")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("Dep_city2")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='</tbody></table></div><div class="col-md-6 col-sm-12"><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
     tic+='<tr><td>arr city</td><td>'+response[0].arr_city+'</td><td class="su_t_h"><input id="arr_city1" oninput=send("arr_city1","'+response[0].arr_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("arr_city1")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("arr_city1")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>arr city2</td><td>'+response[0].arr_city2+'</td><td class="su_t_h"><input id="arr_city2" oninput=send("arr_city2","'+response[0].arr_city2+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("arr_city2")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("arr_city2")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>dep date1</td><td>'+response[0].dep_date+'</td><td class="su_t_h"><input id="dep_date1" oninput=send("dep_date1","'+response[0].dep_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("dep_date1")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("dep_date1")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>dep date2</td><td>'+response[0].dep_date2+'</td><td class="su_t_h"><input id="dep_date2" oninput=send("dep_date2","'+response[0].dep_date2+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("dep_date2")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("dep_date2")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
     tic+='<tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';
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
url:'/accountant/bus/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var bus ='<input hidden=hidden id=manager_how  name=manager_how value='+response[0].manager_id+'><input hidden=hidden id=num name=num value='+response[0].bus_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'>';
    bus +='<input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].bus_id+'>';
    bus +='<h4 class="modal-title">bus service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    bus +='<tr><td>Issue date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr><tr>';
    bus +='<td>Issue_by<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>bus_number</td><td>'+response[0].bus_number+'</td><td class="su_t_h"><input id="bus_number" oninput=send("bus_number","'+response[0].bus_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("bus_number")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("bus_number")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>Dep_city</td><td>'+response[0].Dep_city+'</td><td class="su_t_h"><input id="Dep_city" oninput=send("Dep_city","'+response[0].Dep_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("Dep_city")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("Dep_city")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>arr_city</td><td>'+response[0].arr_city+'</td><td class="su_t_h"><input id="arr_city" oninput=send("arr_city","'+response[0].arr_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("arr_city")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("arr_city")><i class="fas fa-trash "></i></button></div></td></tr><tr></tbody></table>';
    bus +='</div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    bus +='<td>dep_date</td><td>'+response[0].dep_date+'</td><td class="su_t_h"><input id="dep_date" oninput=send("dep_date","'+response[0].dep_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("dep_date")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("dep_date")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>bus_name</td><td>'+response[0].bus_name+'</td><td class="su_t_h"><input id="bus_name" oninput=send("bus_name","'+response[0].bus_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("bus_name")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("bus_name")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    bus +='<tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-outline-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-outline-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';
    $('#myModal_acc').modal('show');
    $('#details').html(bus);
        console.log(response[0]);
  }
}
});
}
if(type==3){
 // alert(id);
$.ajax({
url:'/accountant/car/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var car='<input hidden=hidden id=manager_how  name=manager_how value='+response[0].manager_id+'><input hidden=hidden id=num name=num value='+response[0].voucher_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].car_id+'><h4 class="modal-title">car service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
car+='<tr><td>Issue_date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Issue_by<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>car_info</td><td>'+response[0].car_info+'</td><td class="su_t_h"><input id="car_info" oninput=send("car_info","'+response[0].car_info+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("car_info")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("car_info")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>car_number</td><td>'+response[0].voucher_number+'</td><td class="su_t_h"><input id="voucher_number" oninput=send("voucher_number","'+response[0].voucher_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("voucher_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("voucher_number")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Dep_city</td><td>'+response[0].Dep_city+'</td><td class="su_t_h"><input id="Dep_city" oninput=send("Dep_city","'+response[0].Dep_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Dep_city")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("Dep_city")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
car+='<tr><td>arr_city</td><td>'+response[0].arr_city+'</td><td class="su_t_h"><input id="arr_city" oninput=send("arr_city","'+response[0].arr_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("arr_city")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("arr_city")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>dep_date</td><td>'+response[0].dep_date+'</td><td class="su_t_h"><input id="dep_date" oninput=send("dep_date","'+response[0].dep_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("dep_date")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("dep_date")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';

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
url:'/accountant/general/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var gg='<input hidden=hidden id=manager_how  name=manager_how value='+response[0].manager_id+'><input hidden=hidden id=num name=num value='+response[0].voucher_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].gen_id+'><h4 class="modal-title">car service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
        gg+='<tr><td>Issue_date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>Issue_by<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>general_info</td><td>'+response[0].gen_info+'</td><td class="su_t_h"><input id="gen_info" oninput=send("gen_info","'+response[0].gen_info+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("gen_info")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("gen_info")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>general_number</td><td>'+response[0].voucher_number+'</td><td class="su_t_h"><input id="voucher_number" oninput=send("voucher_number","'+response[0].voucher_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("voucher_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("voucher_number")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
        gg+='<tr><td>busher_time</td><td>'+response[0].busher_time+'</td><td class="su_t_h"><input id="dep_date" oninput=send("busher_time","'+response[0].busher_time+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("busher_time")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("busher_time")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
        gg+='<tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';
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
url:'/accountant/medical/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var meed='<input hidden=hidden id=manager_how  name=manager_how value='+response[0].manager_id+'><input hidden=hidden id=num name=num value='+response[0].document_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].med_id+'><h4 class="modal-title">medical service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    meed+='<tr><td>Issue_date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>Issue_by</td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>medical_info</td><td>'+response[0].	med_info+'</td><td class="su_t_h"><input id="med_info" oninput=send("med_info","'+response[0].med_info+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("med_info")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("med_info")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>document_number</td><td>'+response[0].document_number+'</td><td class="su_t_h"><input id="document_number" oninput=send("document_number","'+response[0].document_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("document_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("document_number")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>Dep_city</td><td>'+response[0].Dep_city+'</td><td class="su_t_h"><input id="Dep_city" oninput=send("Dep_city","'+response[0].Dep_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Dep_city")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("Dep_city")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>arr_city</td><td>'+response[0].arr_city+'</td><td class="su_t_h"><input id="arr_city" oninput=send("arr_city","'+response[0].arr_city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("arr_city")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("arr_city")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    meed+='<tr><td>dep_date</td><td>'+response[0].dep_date+'</td><td class="su_t_h"><input id="dep_date" oninput=send("dep_date","'+response[0].dep_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("dep_date")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("dep_date")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    meed+='<tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';

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
url:'/accountant/hotel/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var hot='<input hidden=hidden id=manager_how  name=manager_how value='+response[0].manager_id+'><input hidden=hidden id=num name=num value='+response[0].voucher_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].hotel_id+'><h4 class="modal-title">hotel service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    hot+='<tr><td>Issue_date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>Issue_by<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>country</td><td>'+response[0].country+'</td><td class="su_t_h"><input id="country" oninput=send("country","'+response[0].country+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("country")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("country")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>city</td><td>'+response[0].city+'</td><td class="su_t_h"><input id="city" oninput=send("city","'+response[0].city+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("city")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("city")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>hotel_number</td><td>'+response[0].voucher_number+'</td><td class="su_t_h"><input id="voucher_number" oninput=send("voucher_number","'+response[0].bus_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("voucher_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("bus_number")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>hotel_name</td><td>'+response[0].hotel_name+'</td><td class="su_t_h"><input id="hotel_name" oninput=send("hotel_name","'+response[0].hotel_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("hotel_name")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("hotel_name")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
    hot+='<tr><td>check_out</td><td>'+response[0].check_out+'</td><td class="su_t_h"><input id="check_out" oninput=send("check_out","'+response[0].check_out+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("check_out")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("check_out")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>check_in</td><td>'+response[0].check_in+'</td><td class="su_t_h"><input id="check_in" oninput=send("check_in","'+response[0].check_in+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("check_in")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("check_in")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
    hot+='<tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';
    $('#myModal_acc').modal('show');
    $('#details').html(hot);
    console.log(response[0]);
  }
}
});
}
if(type==6){
 // alert(id);
$.ajax({
url:'/accountant/visa/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    var car='<input hidden=hidden id=manager_how  name=manager_how value='+response[0].manager_id+'><input hidden=hidden id=num name=num value='+response[0].voucher_number+'><input hidden=hidden id=to name=to value='+response[0].user_id+'><input hidden=hidden id=main_service name=main_service value='+response[0].service_id+'><input hidden=hidden id=service_id name=service_id value='+response[0].visa_id+'><h4 class="modal-title">visa service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
car+='<tr><td>Issue_date<input name=colname value=Issue_date hidden=hidden></td><td>'+response[0].Issue_date+'<input name=oldval value='+response[0].Issue_date+' hidden=hidden></td><td class="su_t_h"><input id="Issue_date" oninput=send("Issue_date","'+response[0].Issue_date+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_date")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_date")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>Issue_by<input type=text value=user_id name=colname hidden=hidden></td><td>'+response[0].name+'<input name=oldval value='+response[0].user_id+' hidden=hidden></td><td class="su_t_h"><input oninput=send("user_id","'+response[0].user_id+'") id="Issue_by" class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("Issue_by")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("Issue_by")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>refernce</td><td>'+response[0].refernce+'</td><td class="su_t_h"><input id="refernce" oninput=send("refernce","'+response[0].refernce+'") class="form-control su_remark_input" type=text  name=newval></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("refernce")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("refernce")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td><td class="su_t_h"><input id="passenger_name" oninput=send("passenger_name","'+response[0].passenger_name+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passenger_name")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("passenger_name")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>car_number</td><td>'+response[0].voucher_number+'</td><td class="su_t_h"><input id="voucher_number" oninput=send("voucher_number","'+response[0].voucher_number+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("voucher_number")> <i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("voucher_number")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>visa_type</td><td>'+response[0].visa_type+'</td><td class="su_t_h"><input id="visa_type" oninput=send("visa_type","'+response[0].visa_type+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("visa_type")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("visa_type")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='</tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th><th class="su_t_h">remark</th><th>opration</th></tr></thead><tbody>';
car+='<tr><td>car_info</td><td>'+response[0].visa_info+'</td><td class="su_t_h"><input id="visa_info" oninput=send("visa_info","'+response[0].visa_info+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("visa_info")><i class="fas fa-pencil-alt "></i> </button><button type="button" class="btn btn-dark" onclick=hidden_input("visa_info")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>provider</td><td>'+response[0].supplier_name+'</td><td class="su_t_h"><input id="due_to_supp" oninput=send("due_to_supp","'+response[0].due_to_supp+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("due_to_supp")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("due_to_supp")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>provider</td><td>'+response[0].country+'</td><td class="su_t_h"><input id="country" oninput=send("country","'+response[0].country+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("country")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("country")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td><td class="su_t_h"><input id="provider_cost" oninput=send("provider_cost","'+response[0].provider_cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("provider_cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("provider_cost")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>currancy</td><td>'+response[0].cur_name+'</td><td class="su_t_h"><input id="cur_id"  oninput=send("cur_id","'+response[0].cur_id+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cur_id")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cur_id")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>cost</td><td>'+response[0].cost+'</td><td class="su_t_h"><input id="cost" oninput=send("cost","'+response[0].cost+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("cost")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("cost")><i class="fas fa-trash "></i></button></div></td></tr>';
car+='<tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td class="su_t_h"><input id="passnger_currency" oninput=send("passnger_currency","'+response[0].passnger_currency+'") class="form-control su_remark_input" type=text  name=newval ></td><td><div class="btn-group"><button type="button" class="btn btn-info" onclick=display_input("passnger_currency")><i class="fas fa-pencil-alt "></i></button><button type="button" class="btn btn-dark" onclick=hidden_input("passnger_currency")><i class="fas fa-trash "></i></button></div></td></tr></tbody></table></div></div>';

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
             url:'/accountant/add_remark/'+id+'/'+oldval+'/'+newval+'/'+status,
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
var oold=oldval.replace('/','-');
//alert(oold);
$.ajax({
             type:'get',
             url:'/accountant/add_remark/'+col+'/'+oold+'/'+newval+'/'+status,
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
  $('.ses_valiide').addClass('disabled');
  var m=$('#main_service').val();
  var s=$('#service_id').val();
  var n=$('#num').val();
  var to=$('#to').val();
  var manager=$('#manager_how').val();
  //alert(s);
  var from={{ Auth::user()->id }};
  $.ajax({
             type:'get',
             url:'/accountant/send_remark/'+m+'/'+s+'/'+to+'/'+from+'/'+n+'/'+manager,
             data:{id:status},
             success:function(response){
               $('#myModal_acc').modal('toggle');
               $("#serr"+s).css('display','none');
               $('#in_success_or_not').text('remark send done successfuly');

             },
             error:function(error){
               console.log(error);
             } 
         });


}
</script>
  @endsection