<nav class="main-header navbar navbar-expand navbar-white navbar-light " id="adds" onload="get_data()">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/logout" class="nav-link">logout</a>
      </li>
     
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     <!-- Messages Dropdown Menu -->
     <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge" id="mecount">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
      
    
      <div  id="mseege_body">
      </div>

          <a href="/home" class="dropdown-item dropdown-footer">See All Messaes</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="counter_notify"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notify_body">
          <!--span class="dropdown-item dropdown-header"> Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#"  class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a-->
         
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <div class="tcontainer"><div class="ticker-wrap"><div class="ticker-move">
  @foreach($addss as $aa)
  <div class="ticker-item"> {{$aa->adds_text}}</div>
@endforeach
  </div></div></div>
</div>
      <!-- The Modal -->
      <div class="modal fade" id="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="bb">

      <a  type="button" class="btn btn-danger" data-dismiss="modal">yes</a>
      </div>
   </div>
  </div>
</div>
  <!-- The Modal -->
  <div class="modal fade" id="myModalss" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="bbsize">

      <a  type="button" class="btn btn-danger" data-dismiss="modal">yes</a>
      </div>
   </div>
  </div>
</div>
  <script>
  function status_notify(s,f,t){
    $.ajax({
url:'/status_notify/'+s+'/'+f+'/'+t+'/'+1,
type:'get',
dataType:'json',
success:function(response){
  alert(s);
}
});
  }
  function ok(id){
  $('#card'+id).css("display","none");

$.ajax({
url:'/ok/'+id,
type:'get',
dataType:'json',
success:function(response){
}
});
}
function cansel(id){
$('#card'+id).css("display","none");
$.ajax({
url:'/cansel/'+id,
type:'get',
dataType:'json',
success:function(response){
$('#card'+id).css("display","none");
}
});
}

</script>