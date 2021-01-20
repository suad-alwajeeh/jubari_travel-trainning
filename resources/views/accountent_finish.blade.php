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
  <div class="container p-4">
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row" >
          <div class="col-12" style="display:none">
            <div class="info-box">
           
            
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12">

            <!-- TABLE: itemEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">service name</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                <table id="su_table_filter" class="table table-striped" >
                
    <thead>
      <tr>
      <th>id</th>
      <th>type</th>
      <th>bill num</th>
      <th>issue date</th>
      <th>issue by</th>
      <th>passenger</th>
        <th>provider</th>
        <th>c</th>
        <th>cost</th>
        <th>status</th>
        <th>opration</th>
      </tr>
    </thead>
    <tbody>
    <?php $i=1;?>
@forelse($data as $item)
   <tr id="serr{{$item->t_id}}" >
   <td><?php echo $i;?></td>
   <td>
                      @if($item->st_id==1)
                      Ticket
                      @elseif($item->st_id==2)
                      Bus
                      @elseif($item->st_id==3)
                      Car	
                      @elseif($item->st_id==4)
                      Medical
                      @elseif($item->st_id==5)
                      Hotel	
                      @elseif($item->st_id==6)
                      Visa	
                      @elseif($item->st_id==7)
                      General	
                      @endif
                      </td>
      <td>{{$item->bill}}</td>
      <td>{{$item->t_idate}}</td>
      <td>{{$item->u_name}}</td>
      <td>{{$item->t_pn}}</td>
      <td>{{$item->s_name}}</td>
      <td>{{$item->cur_n}}</td>
      <td>{{$item->cost}}</td>
      <td>
       @if($item->s_st==1)
                      <span class="badge badge-success">ok</span>
                      @elseif($item->s_st==2)
                      <span class="badge badge-info">issue</span>
                      @elseif($item->s_st==3)
                      <span class="badge badge-danger">void</span>
                      @elseif($item->s_st==4)
                      <span class="badge badge-primary">refund</span>
                      @endif
                      </td>
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
</div>

<script>

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
       $('#myModal_acc').modal('show');

    $('#details').html('<h4 class="modal-title">ticket service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue_date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Issue_by</td><td>'+response[0].name+'</td></tr><tr><td>refernce</td><td>'+response[0].refernce+'</td></tr><tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>airline</td><td>'+response[0].airline_name+'</td></tr><tr><td>ticket_number</td><td>'+response[0].ticket_number+'</td></tr><tr><td>Dep_city1</td><td>'+response[0].Dep_city+'</td></tr><tr><td>Dep_city2</td><td>'+response[0].Dep_city2+'</td></tr><tr><td>arr_city1</td><td>'+response[0].arr_city+'</td></tr><tr><td>arr_city2</td><td>'+response[0].arr_city2+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>dep_date1</td><td>'+response[0].dep_date+'</td></tr><tr><td>dep_date2</td><td>'+response[0].dep_date2+'</td></tr><tr><td>provider</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>currancy</td><td>'+response[0].cur_name+'</td></tr><tr><td>cost</td><td>'+response[0].cost+'</td></tr><tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
     var cc= ' <h4 class="modal-title">bus service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue_date</td><td>'+response[0].Issue_date+'</td>';
     cc+=' </td></tr><tr><td>Issue_by</td><td>'+response[0].name+'</td></tr>';
     cc+='<tr><td>refernce</td><td>'+response[0].refernce+'</td></tr><tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td> </tr><tr><td>bus_number</td><td>'+response[0].bus_number+'</td></tr><tr><td>Dep_city</td><td>'+response[0].Dep_city+'</td></tr><tr><td>arr_city</td><td>'+response[0].arr_city+'</td></tr><tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><td>dep_date</td><td>'+response[0].dep_date+'</td></tr><tr><td>bus_name</td><td>'+response[0].bus_name+'</td></tr><tr><td>provider</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>currancy</td><td>'+response[0].cur_name+'</td></tr><tr><td>cost</td><td>'+response[0].cost+'</td></tr><tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td><td></td></tr></tbody></table></div></div>';
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
url:'/accountant/car/'+id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
       $('#myModal_acc').modal('show');

    $('#details').html('<h4 class="modal-title">car service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue_date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Issue_by</td><td>'+response[0].name+'</td></tr><tr><td>refernce</td><td>'+response[0].refernce+'</td></tr><tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>car_info</td><td>'+response[0].car_info+'</td></tr><tr><td>car_number</td><td>'+response[0].voucher_number+'</td></tr><tr><td>Dep_city</td><td>'+response[0].Dep_city+'</td></tr><tr><td>arr_city</td><td>'+response[0].arr_city+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>dep_date</td><td>'+response[0].dep_date+'</td></tr><tr><td>provider</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>currancy</td><td>'+response[0].cur_name+'</td></tr><tr><td>cost</td><td>'+response[0].cost+'</td></tr><tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
       $('#myModal_acc').modal('show');

    $('#details').html('<h4 class="modal-title">visa service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue_date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Issue_by</td><td>'+response[0].name+'</td></tr><tr><td>refernce</td><td>'+response[0].refernce+'</td></tr><tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>visa_info</td><td>'+response[0].visa_info+'</td></tr><tr><td>visa_number</td><td>'+response[0].voucher_number+'</td></tr><tr><td>country</td><td>'+response[0].country+'</td></tr><tr><td>visa_type</td><td>'+response[0].visa_type+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><td>provider</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>currancy</td><td>'+response[0].cur_name+'</td></tr><tr><td>cost</td><td>'+response[0].cost+'</td></tr><tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
       $('#myModal_acc').modal('show');
    $('#details').html('<h4 class="modal-title">medical service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue_date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Issue_by</td><td>'+response[0].name+'</td></tr><tr><td>refernce</td><td>'+response[0].refernce+'</td></tr><tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>medical_info</td><td>'+response[0].med_info+'</td></tr><tr><td>document_number</td><td>'+response[0].document_number+'</td></tr><tr><td>Dep_city</td><td>'+response[0].Dep_city+'</td></tr><tr><td>arr_city</td><td>'+response[0].arr_city+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>dep_date</td><td>'+response[0].dep_date+'</td></tr><tr><td>provider</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>currancy</td><td>'+response[0].cur_name+'</td></tr><tr><td>cost</td><td>'+response[0].cost+'</td></tr><tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
       $('#myModal_acc').modal('show');
    $('#details').html('<h4 class="modal-title">hotel service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue_date</td><td>'+response[0].Issue_date+'</td><td class="su_t_h"></td></tr><tr><td>Issue_by</td><td>'+response[0].name+'</td></tr><tr><td>refernce</td><td>'+response[0].refernce+'</td></tr><tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>hotel_name</td><td>'+response[0].hotel_name+'</td></tr><tr><td>hotel_number</td><td>'+response[0].voucher_number+'</td></tr><tr><td>check_out</td><td>'+response[0].check_out+'</td></tr><tr><td>check_in</td><td>'+response[0].check_in+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>dep_date</td><td>'+response[0].dep_date+'</td></tr><tr><td>provider</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>currancy</td><td>'+response[0].cur_name+'</td></tr><tr><td>cost</td><td>'+response[0].cost+'</td></tr><tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
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
       $('#myModal_acc').modal('show');

    $('#details').html('<h4 class="modal-title">general service details</h4><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>Issue_date</td><td>'+response[0].Issue_date+'</td></tr><tr><td>Issue_by</td><td>'+response[0].name+'</td></tr><tr><td>refernce</td><td>'+response[0].refernce+'</td></tr><tr><td>busher_time</td><td>'+response[0].busher_time+'</td></tr><tr><td>passenger_name</td><td>'+response[0].passenger_name+'</td></tr><tr><td>general_info</td><td>'+response[0].gen_info+'</td></tr><tr><td>general_number</td><td>'+response[0].voucher_number+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>dep_date</td><td>'+response[0].dep_date+'</td></tr><tr><td>provider</td><td>'+response[0].supplier_name+'</td></tr><tr><td>provider_cost</td><td>'+response[0].provider_cost+'</td></tr><tr><td>currancy</td><td>'+response[0].cur_name+'</td></tr><tr><td>cost</td><td>'+response[0].cost+'</td></tr><tr><td>passnger_currency</td><td>'+response[0].cur_name+' </td></tr></tbody></table></div></div>');
        console.log(response[0]);
  }
}
});
}
}

</script>
  
  
  
  @endsection


