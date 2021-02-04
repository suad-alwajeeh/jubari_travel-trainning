@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
            <div class="card-header">
              <h2 class="card-title">
              Display Employees
              </h2>
              <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
      status 
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/employees">all</a>
      <a class="dropdown-item " href="/employees/1"> Active</a>
      <a class="dropdown-item " href="/employees/0">No Active</a>
    </div>
  </div>
  <a type="button" class="btn btn-outline-success so_form_btn" data-toggle="modal" data-target="#add">add new</a>
            </div>
</br>
@if (session('seccess'))
<div  class="alert so-alert-message" >        {{ session('seccess') }}
 <button type="button" data-dismiss="alert" class="close">&times;</button></div>         
  @endif        
  <div id="so-alert-message"></div>         

<div class="container"> 
<?php $i=1 ?> 

  <table class="table table-hover text-center " id="table">
    <thead>
      <tr>
      <th>#</th>
        <th>Name</th>
                    <th> Mobile</th>
                    <th> Department</th>
                    <th> Salary</th>
                    <th> Hire Date</th>
                    <th> Account Number</th>
                    <th> Cv</th>
        <th>Status</th>
        <th>Opreation</th>
      </tr>
    </thead>
    <tbody id="pp">
    @forelse($emps as $emp)
      <tr id="tr{{$emp->emp_id}}" class="status{{$emp->is_active}}" >
      <td><?php echo $i;?><span style="display:none;">{{$emp->emp_id}}</span></td>
      <input type="hidden" class="delete_id" value="{{$emp->emp_id}}">

                    <td>{{$emp->emp_first_name}}{{$emp->emp_middel_name}}  {{$emp->emp_thired_name}}  {{$emp->emp_last_name}}</td>
                    <td>{{$emp->emp_mobile}}</td>
                    <td>{{$emp->name}}</td>
                    <td>{{$emp->emp_salary}}</td>
                    <td>{{$emp->emp_hirdate}}</td>
                    <td>{{$emp->account_number}}</td>
                    <td> <a href="{{asset('img/attchment/'.$emp->attchment)}}"><img src="{{asset('assets/img/pdf.jpg')}}"
                  class="text-center" width="80px"></a></td>

                    
                    <td>
      @if($emp->is_active == 0)
      
      <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input onclick="myFunction{{$emp->emp_id}}()" type="checkbox" class="custom-control-input" id="customSwitch{{$emp->emp_id}}">
                      <label class="custom-control-label" for="customSwitch{{$emp->emp_id}}"></label>
                    </div>
                  </div>
                  @elseif($emp->is_active == 1)
                  <div class="form-group">
                    <div  class="custom-control custom-switch custom-switch-on-success custom-switch-off-danger ">
                      <input onclick="myFunction{{$emp->emp_id}}()" checked type="checkbox" class="custom-control-input" id="customSwitch{{$emp->emp_id}}">
                      <label class="custom-control-label" for="customSwitch{{$emp->emp_id}}"></label>
                    </div>
                  </div>
@endif
      </td>
    
        <td>
        <div class="btn-group btn-group-sm">
  <a type="button" class="btn btn-outline-success" href="{{ url('employees/employee-edit/'.$emp->emp_id) }}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-outline-danger deletebtn"   ><i class="fas fa-trash "></i></a>
</div>

        </td>
      </tr>
        <!-- The Modal -->
        <div class="modal fade" id="myModalair{{$emp->emp_id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
      <div class="row text-center"><div class="col-12 p-4"><i style="font-size: 70px;" class="fas fa-exclamation-circle text-center text-danger"></i></div><div class="col-12 p-3"><h3 class="text-center">are you sure you want to delete emp ??</h3></div><div class="col-12 p-2"><button type="button" class="btn btn-success so_form_btn" style="float:none" data-dismiss="modal" >cansel</button><button type="button" class="btn btn-danger" onclick="delete{{$emp->emp_id}}()" style="width:15%;">ok</button></div></div>
      </div>
   </div>
  </div>
</div>

      <script>
     function dep_select(){
     var m= $("#selectdep").val();
     if(m==1){
      $('.dep4').css('display','none');
        }
     }
    
function myFunction{{$emp->emp_id}}() {
  var checkBox{{$emp->emp_id}} = document.getElementById("customSwitch{{$emp->emp_id}}");
  
  if (checkBox{{$emp->emp_id}}.checked == true){
    $.ajax({
             type:'get',
             url:'/is_active_emp/'+{{$emp->emp_id}},
             data:{id:{{$emp->emp_id}}},
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
             url:'/no_active_emp/'+{{$emp->emp_id}},
             data:{id:{{$emp->emp_id}}},
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
  </div>
  </div>
  </div>
  </div>
  

<script>
    
    $(document).ready(function(){ 
      let  td='';
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    
        $('.deletebtn').click(function (e) {
          e.preventDefault();
          //var id =$('#deletebtn').val();
          var id = $(this).closest("tr").find('.delete_id').val();
          console.log('id');
          console.log(id);
    
          //alert(id);
          swal({
            title: "Are you sure?",
            text: "Are You  Sure to delete this filed!",
            icon: "error",
            buttons: true,
            dangerMode: true,
          })
            .then((willDelete) => {
              if (willDelete) {
                var data = {
                  '_token': $('input[name=_token]').val(),
                  'id':id,
                };
    
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type:"GET",
                  url: '/employees/employee_delete/'+id,
                  data: data,
                  success: function (response) {
                    console.log(response);
                    swal("Delete Successfully", {
                     icon: "success",
                    }).then((willDelete) => {
                      location.reload();
                    });
                  }
                });
              }
              
              
            });
        });
    });
    
      </script>
  <!-- /.content-wrapper -->
@endsection
