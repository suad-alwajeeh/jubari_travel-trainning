@extends('app_layouts.master')
@section('main_content')





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  <div class="row">
  <div class="col-12">
  <h1 class="text-center">display adds with user</h1>
  </div>
  
<div class="container">            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>adds_name</th>
        <th>user_name</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
    <td>{{$item->au_id}}</td>
    <td>{{$item->a_name}}</td>
      <td>{{$item->u_name}}</td>
      <td>
      @if($item->au_status==1)
        <span class="badge badge-success">send</span>
      @elseif($item->au_status==2)
        <span class="badge badge-secondary">read</span>
      @elseif($item->au_status==3)
        <span class="badge badge-warning">cansele</span>
      
      @endif
     </td>
        <td>
        <div class="btn-group btn-group-sm">
  <a type="button" class="btn btn-info" data-toggle="modal" onclick="getdata{{$item->au_id}}()" data-target="#myModal{{$item->au_id}}" ><i class="fas fa-eye "></i></a>
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

  <div class="card">
    <div class="card-header su_head">
      <a class="card-link su_inf" data-toggle="collapse" href="#collapseOne">
        adds_info
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
        user_info
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
      adds_status
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
        <span class="badge badge-warning">cansele</span>
      
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
