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
  
<div class="col-12">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item"><a href="/service/sales_repo"> Sales Excutive</a></li>
              <li class="breadcrumb-item active">Finshed Services</li>

            </ol>
  </div>
  </br>
  </br>
  <div class="content-wrapper">
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
                <h3 class="card-title">service name</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-striped">
                
    <thead>
      <tr>
      <th>ID</th>
      <th>Service Number</th>
        <th>Passenger Name</th>
        <th>Employee Name</th>
        <th>Issue Date</th>
        <th>Provider Name</th>
        <th>Provider Cost</th>
        <th>Provider Currency</th>
        <th>Passenger Cost</th>
        <th>Passenger Currency</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody>
    @forelse($data as $item)
      <tr id="serr{{$item->t_id}}" >
      <td>
                                                        <?php echo $i;?>
                                                    </td>
      <td>{{$item->s_num}}</td>
      <td>{{$item->t_pn}}</td>
      <td>{{$item->u_name}}</td>
      <td>{{$item->t_idate}}</td>
      <td>{{$item->s_name}}</td>
      <td>{{$item->t_pc}}</td>
      <td>{{$item->cur_n}}</td>
      <td>{{$item->cost}}</td>
      <td>{{$item->u_name}}</td>
        <td>
        <div class="btn-group btn-group-sm">
        <a type="button" class="btn btn-info"   onclick="display_data('{{$item->t_id}}',{{$item->st_id}})" ><i class="fas fa-eye "></i></a>
</div>
<!-- The Modal -->
<div class="modal fade" id="myModal_acc">
  <div class="modal-dialog su_modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">     
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
<?php $i++ ?>

      @empty
                                        <tr>
                                            <td colspan="10">There is No data 
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
</div>

<script>

function display_data(id,type){
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
       $('#myModal_acc').modal('show');

    $('#details').html('<h4 class="modal-title">ticket service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue Date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Employee Name</td><td>'+response[0].name+'</td></tr><tr><td>Refernce </td><td>'+response[0].refernce+'</td></tr><tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>Airline Name</td><td>'+response[0].airline_name+'</td></tr><tr><td>Ticket Number</td><td>'+response[0].ticket_number+'</td></tr><tr><td>Dep City</td><td>'+response[0].Dep_city+'</td></tr><tr><td>Dep City2</td><td>'+response[0].Dep_city2+'</td></tr><tr><td>Arr City</td><td>'+response[0].arr_city+'</td></tr><tr><td>Arr City 2</td><td>'+response[0].arr_city2+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Dep Date</td><td>'+response[0].dep_date+'</td></tr><tr><td>Dep Date</td><td>'+response[0].dep_date2+'</td></tr><tr><td>Provider Name</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>Provider Currency</td><td>'+response[0].cur_name+'</td></tr><tr><td>Passenger Cost</td><td>'+response[0].cost+'</td></tr><tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
     var cc= ' <h4 class="modal-title">bus service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue Date</td><td>'+response[0].Issue_date+'</td>';
     cc+=' </td></tr><tr><td>Employee Name</td><td>'+response[0].name+'</td></tr>';
     cc+='<tr><td>Refernce </td><td>'+response[0].refernce+'</td></tr><tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td> </tr><tr><td>Voucher Number</td><td>'+response[0].bus_number+'</td></tr><tr><td>Dep City</td><td>'+response[0].Dep_city+'</td></tr><tr><td>Arr City</td><td>'+response[0].arr_city+'</td></tr><tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><td>Dep Date</td><td>'+response[0].dep_date+'</td></tr><tr><td>Bus Name</td><td>'+response[0].bus_name+'</td></tr><tr><td>Provider Name</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>Provider Currency</td><td>'+response[0].cur_name+'</td></tr><tr><td>Passenger Cost</td><td>'+response[0].cost+'</td></tr><tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td><td></td></tr></tbody></table></div></div>';
    $('#myModal_acc').modal('show');

    $('#details').html(cc);
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
       $('#myModal_acc').modal('show');

    $('#details').html('<h4 class="modal-title">car service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue Date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Employee Name</td><td>'+response[0].name+'</td></tr><tr><td>Refernce </td><td>'+response[0].refernce+'</td></tr><tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>Car Info</td><td>'+response[0].car_info+'</td></tr><tr><td>Voucher Number</td><td>'+response[0].voucher_number+'</td></tr><tr><td>Dep City</td><td>'+response[0].Dep_city+'</td></tr><tr><td>Arr City</td><td>'+response[0].arr_city+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Dep Date</td><td>'+response[0].dep_date+'</td></tr><tr><td>Provider Name</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>Provider Currency</td><td>'+response[0].cur_name+'</td></tr><tr><td>Passenger Cost</td><td>'+response[0].cost+'</td></tr><tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
        console.log(response[0]);
  }
}
});
}
if(type==6){
 // alert(id);
$.ajax({
url:'/sales/visa/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
       $('#myModal_acc').modal('show');

    $('#details').html('<h4 class="modal-title">visa service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue Date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Employee Name</td><td>'+response[0].name+'</td></tr><tr><td>Refernce </td><td>'+response[0].refernce+'</td></tr><tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>Visa Info</td><td>'+response[0].visa_info+'</td></tr><tr><td>Voucher Number</td><td>'+response[0].voucher_number+'</td></tr><tr><td>country</td><td>'+response[0].country+'</td></tr><tr><td>Visa Type</td><td>'+response[0].visa_type+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><td>Provider Name</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>Provider Currency</td><td>'+response[0].cur_name+'</td></tr><tr><td>Passenger Cost</td><td>'+response[0].cost+'</td></tr><tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
       $('#myModal_acc').modal('show');
    $('#details').html('<h4 class="modal-title">medical service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue Date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Employee Name</td><td>'+response[0].name+'</td></tr><tr><td>Refernce </td><td>'+response[0].refernce+'</td></tr><tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>Medical Info</td><td>'+response[0].med_info+'</td></tr><tr><td>Document Number</td><td>'+response[0].document_number+'</td></tr><tr><td>From City</td><td>'+response[0].from_city+'</td></tr><tr><td>Report Status</td><td>'+response[0].report_status+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Provider Name</td><td>'+response[0].supplier_name+'</td></tr><tr><td>Provider Cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>Provider Currency</td><td>'+response[0].cur_name+'</td></tr><tr><td>Passenger Cost</td><td>'+response[0].cost+'</td></tr><tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
       $('#myModal_acc').modal('show');
    $('#details').html('<h4 class="modal-title">hotel service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue Date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Employee Name</td><td>'+response[0].name+'</td></tr><tr><td>Refernce </td><td>'+response[0].refernce+'</td></tr><tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>Hotel Name</td><td>'+response[0].hotel_name+'</td></tr><tr><td>Hotel Number</td><td>'+response[0].voucher_number+'</td></tr><tr><td>Check Out</td><td>'+response[0].check_out+'</td></tr><tr><td>Check In</td><td>'+response[0].check_in+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Dep Date</td><td>'+response[0].dep_date+'</td></tr><tr><td>Provider Name</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>Provider Currency</td><td>'+response[0].cur_name+'</td></tr><tr><td>Passenger Cost</td><td>'+response[0].cost+'</td></tr><tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
       $('#myModal_acc').modal('show');

    $('#details').html('<h4 class="modal-title">general service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue Date</td><td>'+response[0].Issue_date+'</td></tr><tr><td>Employee Name</td><td>'+response[0].name+'</td></tr><tr><td>Refernce </td><td>'+response[0].Refernce +'</td></tr><tr><td>Busher Time</td><td>'+response[0].busher_time+'</td></tr><tr><td>Passenger Name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>General Info</td><td>'+response[0].gen_info+'</td></tr><tr><td>Voucher Number</td><td>'+response[0].voucher_number+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Dep Date</td><td>'+response[0].dep_date+'</td></tr><tr><td>Provider Name</td><td>'+response[0].supplier_name+'</td></tr><tr><td>Provider Cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>Provider Currency</td><td>'+response[0].cur_name+'</td></tr><tr><td>Passenger Cost</td><td>'+response[0].cost+'</td></tr><tr><td>Passenger Currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
        console.log(response[0]);
  }
}
});
}
}

</script>
  
  
  
  @endsection


