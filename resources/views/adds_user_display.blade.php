@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row card-outline so_panal">
  <div class="col-12 card ">
            <div class="card-header">
              <h2 class="card-title">
              Display Users Advertisements Status
              </h2>
              <div class="dropdown so_form_btn">
    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
      status 
    </button>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="/adds_user_display">all</a>
    <a class="dropdown-item" href="/adds_user_display/1">send</a>
      <a class="dropdown-item " href="/adds_user_display/2"> read</a>
      <a class="dropdown-item " href="/adds_user_display/3">cansel</a>
    </div>
  </div>

            </div>

<div class="container"> 
<?php $i=1 ?> 
           
  <table class="table table-hover text-center">
    <thead>
      <tr>
        <th>#</th>
        <th>Adds Name</th>
        <th>User Name</th>
        <th>Status</th>
        <th>Opreation</th>
      </tr>
    </thead>
    <tbody>
    @forELSE($data as $item)
    <td><?php echo $i; ?> </td>
    <td>{{$item->a_name}}</td>
      <td>{{$item->u_name}}</td>
      <td>
      @if($item->au_status==1)
        <span class="badge badge-success">send</span>
        @endif

      @if($item->au_status==2)
        <span class="badge badge-secondary">read</span>
        @endif
      @if($item->au_status==3)
        <span class="badge badge-warning">cansel</span>
      @endif
     </td>
        <td>
        <div class="btn-group btn-group-sm">
  <a type="button" class="btn btn-outline-info" data-toggle="modal" onclick="getdata{{$item->au_id}}()" data-target="#myModal{{$item->au_id}}" ><i class="fas fa-eye "></i></a>
</div>
     <!-- The Modal -->
     <div class="modal fade" id="myModal{{$item->au_id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div id="accordion">

  <div class="card card-outline so_panal">
    <div class="card-header su_head">
      <a class="card-link su_inf" data-toggle="collapse" href="#collapseOne">
        adds information
      </a>
    </div>
    <div id="collapseOne" class="collapse show" data-parent="#accordion">
      <div class="card-body">
      <div class="table-responsive">
    <table class="table table-bordered">
            <tbody>
        <tr>
        <td>name</td>
        <td id="a_name{{$item->au_id}}"></td>
        </tr>
        <tr>
        <td>contaent</td>
        <td id="a_text{{$item->au_id}}"></td>
        </tr>
      </tbody>
    </table>
  </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header su_head">
      <a class="collapsed card-link su_inf" data-toggle="collapse" href="#collapseThree">
        user information
      </a>
    </div>
    <div id="collapseThree" class="collapse" data-parent="#accordion">
      <div class="card-body">
      <div class="table-responsive">
    <table class="table table-bordered">
            <tbody>
        <tr>
        <td>name</td>
        <td id="u_name{{$item->au_id}}"></td>
        </tr>
      </tbody>
    </table>
  </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header su_head">
      <a class="collapsed card-link su_inf" data-toggle="collapse" href="#collapseTwo">
      adds status
      </a>
    </div>
    <div id="collapseTwo" class="collapse" data-parent="#accordion">
      <div class="card-body">
      <div class="table-responsive">
    <table class="table table-bordered">
            <tbody>
        <tr>
        <td>name</td>
        <td id="au_status{{$item->au_id}}">
        @if($item->au_status==1)
        <span class="badge badge-success">send</span>
      @elseif($item->au_status==2)
        <span class="badge badge-secondary">read</span>
      @elseif($item->au_status==3)
        <span class="badge badge-warning">cansel</span>
      
      @endif
        </td>
        </tr>
      </tbody>
    </table>
  </div>
      </div>
    </div>
  </div>
</div>
           <a  type="button" class="btn btn-danger" data-dismiss="modal">close</a>
      </div>
   </div>
  </div>
</div>
        </td>
      </tr>
      <script>
      function getdata{{$item->au_id}}(){
          var id={{$item->au_id}};
       $.ajax({
url:'/adds_user_display_row/'+id,
type:'get',
dataType:'json',
success:function(response){
   // alert("ooo");
  if(response.length==0){
    console.log("not found thing");
  }else{

    console.log(response[0]);
    $('#a_name'+id).text(response[0].a_name);
    $('#a_text'+id).text(response[0].a_text);
    $('#u_name'+id).text(response[0].u_name);
      if(response[0].au_status=1){$('#au_status'+id).html('<span class="badge badge-success">send</span>');}
      if(response[0].au_status=2){$('#au_status'+id).html('<span class="badge badge-secondary">read</span>');}
      if(response[0].au_status=3){$('#au_status'+id).html('<span class="badge badge-warning">cansele</span>');}
  }
}
});
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
  {{$data->links()}}
</div>
  </div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
