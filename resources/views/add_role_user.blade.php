@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
  

<!--form action="airline_display1" method="post"-->

<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title">
              Add Roles To User Page
              </h2>
            </div>
            
            <div class="card-body">
<form id="so_form" >
<div class="row">
<div class="form-group col-12">
                  <label>select user</label>
                  <select class="form-control select2" name="user_id" id="user_id" style="width: 100%;">
                  @foreach($data1 as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
    <div class="form-group mb-3">
      <input type="text" hidden="hidden" value="{{ Auth::user()->id }}" class="form-control" id="how_create_it" placeholder="how_create_it" name="how_create_it">
    </div>
    <div class="form-group col-md-12">
    <label>select roles</label>
<div class=row>
    
    @foreach($data as $item1)
    <div class="col-md-3">
    <div class="checkbox">
  <label><input  type="checkbox" id="role{{$item1->id}}" onclick="send({{$item1->id}})"  name="role[]" value="{{$item1->id}}">{{$item1->name}}</label>
  </div>
  </div>
@endforeach
</div>
</div>
</form>  
</div>    
</div>    

<div class="card-footer" >
   <a href="/role_user_display1\1" class="btn btn-outline-success so_form_btn">save</a>
    </div>    
    
  
  <script>
  function send(r){
    var checkBox = document.getElementById("role"+r);
    var adds_text = $("#how_create_it").val();
      var adds_name = $("#user_id").val();
      if (checkBox.checked == true){
      $.ajax({
             type:'get',
             url:'/addroleuser1/'+r+'/'+adds_name+'/'+adds_text,
             data:{},
             success:function(response){
               console.log(response);
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });
  }else if (checkBox.checked == false){
    $.ajax({
             type:'get',
             url:'/addroleuser2/'+r+'/'+adds_name+'/'+adds_text,
             data:{},
             success:function(response){
               console.log(response);
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
  });
  }
  }
  
  /* function send_data(){
      var adds_text = $("#role_descripe").val();
      var adds_name = $("#role_name").val();
      if (adds_name != "" && adds_text != ""){
         $.ajax({
             type:'post',
             url:'/addroleuser',
             data:$('#so_form').serialize(),
             success:function(response){console.log(response);
              window.location.href = "/role_user_display1/1";
                 },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });
    }else{
      mass1.innerHTML = "<p class=text-danger>*Enter role name </p>";
      mass2.innerHTML = "<p class=text-danger>*Enter rol description </p>";
    }
}*/
</script>
</div>
</div>
  </div>
  @endsection


