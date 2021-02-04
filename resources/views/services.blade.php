@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
      <!--  start add Modal -->
 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('messages.add service')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="width:500px">
      <form class="form-horizontal">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">{{__('messages.serviece name')}}:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="ser_name" name="ser_name" required
                    placeholder="{{__('messages.serviece name')}}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">{{__('messages.Discrption')}} :</label>
                <div class="col-sm-8">
                  <textarea type="text" class="form-control" id="discrption" name="discrption" required
                    placeholder="{{__('messages.Discrption')}}  "></textarea>
                </div>
              </div>


              <div class="form-group row">
                <div class="offset-sm-4 col-sm-8">
                  <div class="form-check">
                    <input type="checkbox" checked class="form-check-input" name="is_active" id="active">
                    <label class="form-check-label" for="exampleCheck2">{{__('messages.Active')}} </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <input type="hidden" id="id">
            <!-- /.card-footer -->
          </form>
        </div>
        <div class="modal-footer">
          <a href="{{url('service')}}"><button type="button" class="btn btn-outline-danger  m-3 p-2 float-left" data-dismiss="modal">{{__('messages.cancel')}} </button></a>
      <a id="add2"> <button type="button" class="btn btn-outline-primary">{{__('messages.save')}} </button></a>
      </div>
    </div>
  </div>
</div>
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
            <div class="card-header">
              <h2 class="card-title">
              {{__('messages.DISPLAY SERVICE')}} 
              </h2>
              <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
    {{__('messages.status')}}  
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="/services">{{__('messages.all')}} </a>
      <a class="dropdown-item " href="/services/1"> {{__('messages.Active')}} </a>
      <a class="dropdown-item " href="/services/0">{{__('messages.notactive')}}  </a>
    </div>
  </div>
  <a type="button" class="btn btn-outline-success so_form_btn" data-toggle="modal" data-target="#add">{{__('messages.add new')}}</a>
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
        <th>{{__('messages.Name')}} </th>
                      <th> {{__('messages.Discrption')}} </th>
                      <th> {{__('messages.Employee')}} </th>
        <th>{{__('messages.status')}} </th>
        <th>{{__('messages.Opreation')}} </th>
      </tr>
    </thead>
    <tbody id="pp">
    @forelse($data as $item)
      <tr id="tr{{$item->ser_id}}" class="status{{$item->is_active}}" >
      <input type="hidden" class="delete_id" value="{{$item->ser_id}}">

      <td><?php echo $i;?><span style="display:none;" >{{$item->ser_id}}</span></td>
      <td>{{$item->ser_name}}</td>
                      <td>{{$item->discrption}}</td>
                      <td>{{$item->emp_first_name}} {{$item->emp_middel_name}} {{$item->emp_thired_name}}
                        {{$item->emp_last_name}}</td>

      <td>
      @if($item->is_active == 0)
      
      <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input onclick="myFunction{{$item->ser_id}}()" type="checkbox" class="custom-control-input" id="customSwitch{{$item->ser_id}}">
                      <label class="custom-control-label" for="customSwitch{{$item->ser_id}}"></label>
                    </div>
                  </div>
                  @elseif($item->is_active == 1)
                  <div class="form-group">
                    <div  class="custom-control custom-switch custom-switch-on-success custom-switch-off-danger ">
                      <input onclick="myFunction{{$item->ser_id}}()" checked type="checkbox" class="custom-control-input" id="customSwitch{{$item->ser_id}}">
                      <label class="custom-control-label" for="customSwitch{{$item->ser_id}}"></label>
                    </div>
                  </div>
@endif
      </td>
        <td>
        <div class="btn-group btn-group-sm">
        @if($item->ser_id == 1||$item->ser_id == 2||$item->ser_id == 3||$item->ser_id == 4||$item->ser_id == 5||$item->ser_id == 6||$item->ser_id == 7)
  <a type="button" class="btn btn-outline-success" href="{{ url('/service/service-edit/'.$item->ser_id) }}"><i class="fas fa-pencil-alt "></i></a>
@else
<a type="button" class="btn btn-outline-success" href="{{ url('/service/service-edit/'.$item->ser_id) }}"><i class="fas fa-pencil-alt "></i></a>
  <a type="button" class="btn btn-outline-danger deletebtn"   ><i class="fas fa-trash "></i></a>

@endif


</div>

        </td>
      </tr>
        <!-- The Modal -->
        <div class="modal fade" id="myModalair{{$item->ser_id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
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
function myFunction{{$item->ser_id}}() {
  var checkBox{{$item->ser_id}} = document.getElementById("customSwitch{{$item->ser_id}}");
  
  if (checkBox{{$item->ser_id}}.checked == true){
    $.ajax({
             type:'get',
             url:'/is_active_ser/'+{{$item->ser_id}},
             data:{id:{{$item->ser_id}}},
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
             url:'/no_active_ser/'+{{$item->ser_id}},
             data:{id:{{$item->ser_id}}},
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
    $(document).ready(function () {
      console.log('add');
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    
 
    $("#add2").click(function () {
      var ser_name = $('#ser_name').val();
      var discrption = $('#discrption').val();
      var is_active = $('#is_active').val();
      console.log(ser_name);
      console.log(id);
      $.ajax({
        url: "{{url('service/insert')}}",
        data: { is_active: is_active, ser_name: ser_name, discrption: discrption },
        success: function (data) {
          console.log('sec');
          $('#add').remove();
          swal("{{__('messages.insSuccessfully')}}", {
            icon: "success",
            
          }).then((willDelete) => {
            location.reload();
          });
        },
        error: function () {
          console.log('err');
        }

      });
    });
    $('.deletebtn').click(function (e) {
      e.preventDefault();
      var id = $(this).closest("tr").find('.delete_id').val();
      console.log(id);

      //alert(id);
      swal({
        title: "{{__('messages.delete')}}",
        text: "{{__('messages.delconfig')}}",
        icon: "error",
        buttons: ["{{__('messages.no')}}", "{{__('messages.yes')}}"],
         dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var data = {
              '_token': $('input[name=_token]').val(),
              'id': id,
            };

            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "GET",
              url: '/service/service_delete/' + id,
              data: data,
              success: function (response) {
                swal("{{__('messages.delSuccessfully')}}", {
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
