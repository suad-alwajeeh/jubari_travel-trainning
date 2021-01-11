@extends('app_layouts.master')
@section('main_content')
<style>
    @media screen and (min-width: 676px) {
      #myModalcus .modal-dialog {
          max-width: 80%; /* New width for default modal */
        }
    }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row">
  <div class="col-12">
  <h1 class="text-center">DISPLAY CUSTOMER</h1>
  </div>
  
<div class="container">   
<div id="cus_mess" class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong id="ttext">Success!</strong> 
</div>       
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th>ID</th>
        <th>contact_person</th>
        <th>contact_title</th>
        <th>WHATSAPP</th>
        <th>EMAIL</th>
        <th>CURRANCY</th>
        <th>VIP</th>
        <th style="display:none">ACTIVE</th>
        <th>OPERATION</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
      <tr id="tr{{$item->cus_id}}" >
      <td>{{$item->cus_id}}</td>
      <td>{{$item->contact_person}}</td>
      <td>{{$item->contact_title}}</td>
      <td>{{$item->whatsapp}}</td>
      <td>{{$item->cus_email}}</td>
      <td>{{$item->cur_name}}</td>
      <td>
         @if($item->vip == 0)
     
      <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input onclick="vip{{$item->cus_id}}()" type="checkbox" class="custom-control-input" id="customSwitch{{$item->cus_id}}">
                      <label class="custom-control-label" for="customSwitch{{$item->cus_id}}"></label>
                    </div>
                  </div>
                  @elseif($item->vip == 1)
                  <div class="form-group">
                    <div  class="custom-control custom-switch custom-switch-on-success custom-switch-off-danger ">
                      <input onclick="vip{{$item->cus_id}}()" checked type="checkbox" class="custom-control-input" id="customSwitch{{$item->cus_id}}">
                      <label class="custom-control-label" for="customSwitch{{$item->cus_id}}"></label>
                    </div>
                  </div>
@endif  
</td>
<td style="display:none">
         @if($item->is_active = 0)
      <div class="form-group">
                    <div  class="custom-control custom-switch custom-switch-on-success custom-switch-off-danger ">
                      <input onclick="vip{{$item->cus_id}}()" checked type="checkbox" class="custom-control-input" id="customSwitch1{{$item->cus_id}}">
                      <label class="custom-control-label" for="customSwitch1{{$item->cus_id}}"></label>
                    </div>
                  </div>
                  @endif  

                  @if($item->is_active = 1)
                  <div class="form-group">
                    <div  class="custom-control custom-switch custom-switch-on-success custom-switch-off-danger ">
                      <input onclick="vip{{$item->cus_id}}()" checked type="checkbox" class="custom-control-input" id="customSwitch1{{$item->cus_id}}">
                      <label class="custom-control-label" for="customSwitch1{{$item->cus_id}}"></label>
                    </div>
                  </div>
@endif  
</td>
   <td>
        <div class="btn-group btn-group-sm">
  <a type="button" class="btn btn-success" href="customer_edit/{{$item->cus_id}}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-danger" onclick="deleteitem({{$item->cus_id}})" ><i class="fas fa-trash "></i></a>
  <a type="button" class="btn btn-info" onclick="show({{$item->cus_id}})"><i class="fas fa-eye "></i></a>
</div>
     <!-- The Modal -->
     <div class="modal fade" id="myModalcus">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="details">

      <a  type="button" class="btn btn-success" data-dismiss="modal">ok</a>
      </div>
   </div>
  </div>
</div>
 <!-- The Modal -->
 <div class="modal fade" id="myModalcus_del">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="details1">

      <a  type="button" class="btn btn-success" data-dismiss="modal">ok</a>
      </div>
   </div>
  </div>
</div>
        </td>
      </tr>
<script>
function show(id) {
  $.ajax({
url:'/display_row/'+id,
type:'get',
dataType:'json',
success:function(response){
  
  if(response.length==0){
    console.log("not found thing");
    
  }else{
    var a="no";
    var v="no";

    if(response[0].vip=1){
      v="yes";
    }
    if(response[0].is_activeg=1){
      a='no';
    }
    $('#myModalcus').modal('show');

    $('#details').html('<h4 class="modal-title">customer details</h4><div STYLE="POSITION: RELATIVE;LEFT: 44%;" class="btn-group btn-group-sm"><a type="button" class="btn btn-success" href="customer_edit/'+response[0].cus_id+'" ><i class="fas fa-pencil-alt "></i></a><a type="button" class="btn btn-danger"  onclick="deleteitem('+response[0].cus_id+')"><i class="fas fa-trash "></i></a></div><div class=row><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>contact_person</td><td>'+response[0].contact_person+'</td></tr><tr><td>contact_title</td><td>'+response[0].contact_title+'</td></tr><tr><td>telephon_1</td><td>'+response[0].telephon2+'</td></tr><tr><td>telephon_2</td><td>'+response[0].telephon1+'</td></tr><tr><td>fax_1</td><td>'+response[0].fax1+'</td></tr><tr><td>fax_2</td><td>'+response[0].fax2+'</td></tr><tr><td>whatsapp</td><td>'+response[0].whatsapp+'</td></tr><tr><td>cus_email</td><td>'+response[0].cus_email+'</td></tr></tbody></table></div><div class=col-6><table class="table table-bordered"><thead><tr><th>key</th><th>value</th></tr></thead><tbody><tr><td>address</td><td>'+response[0].address+'</td></tr><tr><td>city</td><td>'+response[0].city+'</td></tr><tr><td>country</td><td>'+response[0].country+'</td></tr><tr><td>def_currency</td><td>'+response[0].cur_name+'</td></tr><tr><td>VIP</td><td>'+v+'</td></tr><tr><td>ACTIVE</td><td>'+a+'</td></tr><tr><td>how add it</td><td>'+response[0].name+'</td></tr><tr><td>  </td></tr></tbody></table>');
       console.log(response[0]);
  }
}
});
} 

function deleteitem(id) {
  $('#myModalcus').modal('hide');
  $('#myModalcus_del').modal('show');
  $('#details1').html('<div class="row text-center"><div class="col-12 p-4"><i style="font-size: 70px;" class="fas fa-exclamation-circle text-center text-danger"></i></div><div class="col-12 p-3"><h3 class="text-center">are you sure you want to delete customer??</h3></div><div class="col-12 p-2"><button type="button" class="btn btn-success" data-dismiss="modal" >cansel</button><button type="button" class="btn btn-danger" onclick="deletei('+id+')" style="width:15%;">ok</button></div></div>');
  }  
  
function deletei(id){
$.ajax({
       type:'get',
       url:'/customer_delete/'+id,
       data:{id:id},
       success:function(response){console.log(response);
        document.getElementById('tr{{$item->cus_id}}').style.display ='none';
        $('#myModalcus_del').modal('toggle');
        $('#cus_mess').css('display','block');
        $('#ttext').text('delete successfully');
       },
       error:function(error){console.log(error);
       } 
   });
}
function vip{{$item->cus_id}}() {
  var checkBox{{$item->cus_id}} = document.getElementById("customSwitch{{$item->cus_id}}");
  var checkBox1{{$item->cus_id}} = document.getElementById("customSwitch1{{$item->cus_id}}");

  if (checkBox{{$item->cus_id}}.checked == true){
    $.ajax({
             type:'get',
             url:'/is_vip/'+{{$item->cus_id}},
             data:{id:{{$item->cus_id}}},
             success:function(response){console.log(response);
            // alert("data saved");
             },
             error:function(error){console.log(error);
            // alert("data dont saved");
             } 
         });
  } else{
    $.ajax({
             type:'get',
             url:'/no_vip/'+{{$item->cus_id}},
             data:{id:{{$item->cus_id}}},
             success:function(response){console.log(response);
            // alert("data saved");
             },
             error:function(error){console.log(error);
            // alert("data dont saved");
             } 
         });
}
  
if (checkBox1{{$item->cus_id}}.checked == true){
    $.ajax({
             type:'get',
             url:'/customer/is_active/'+{{$item->cus_id}},
             data:{id:{{$item->cus_id}}},
             success:function(response){console.log(response);
            // alert("data saved");
             },
             error:function(error){console.log(error);
            // alert("data dont saved");
             } 
         });
  } else{
    $.ajax({
             type:'get',
             url:'/customer/no_active/'+{{$item->cus_id}},
             data:{id:{{$item->cus_id}}},
             success:function(response){console.log(response);
            // alert("data saved");
             },
             error:function(error){console.log(error);
            // alert("data dont saved");
             } 
         });
}
}

</script>
     @endforeach
    </tbody>
  </table>
  {{$data->links()}}
</div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
