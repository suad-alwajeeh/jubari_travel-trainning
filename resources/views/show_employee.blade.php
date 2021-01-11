@extends('app_layouts.master')
@section('main_content')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Employees</h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
  <div class="row m-2">
  @foreach($emps as $emp)

    <div class="wrapp wapper">
     

      <div class="profile">
      <input type="hidden" class="delete_id" value="{{$emp->emp_id}}">

        <img src="{{asset('img/users/'.$emp->emp_photo)}}" class="thumbnail">
        <h3 class="name">{{$emp->emp_first_name}}  {{$emp->emp_midel_name}}  {{$emp->emp_thired_name}}  {{$emp->emp_last_name}}</h3>
        <p class="title">{{$emp->name}}</p>
        <p class="description"><i class="fa fa fa-calendar m-2" aria-hidden="true"></i>{{$emp->emp_hirdate}}</p>
        <p class="description"><i class="far fa-money-bill-alt m-2"></i>{{$emp->emp_salary}}</p>
        <p class="description"><i class="fa fa-id-card m-2" aria-hidden="true"></i>{{$emp->emp_ssn}}</p>
        <p class="description"><i class="fa fa-phone m-2" aria-hidden="true"></i>{{$emp->emp_mobile}}</p>
        <p class="description"><i class="fas fa-envelope m-2"></i>{{$emp->emp_email}}</p>
        <p class="description"><i class="fa fa-file m-2"></i>{{$emp->attchment}}</p>
         
      </div>
      
      <div class="social-icons mx-auto text-center">
       

        <div class="icon mx-auto text-center">
          <a href="{{url('employees/employee-edit/'.$emp->emp_id) }}"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>

        </div>

        <div class="icon  mx-auto text-center">
        <input type="hidden" class="delete_id" value="{{$emp->emp_id}}">

          <a ><i class="fas fa-trash deletebtn" ></i></a>

        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
                console.log('inseode scripy');

$(document).ready(function(){
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.deletebtn').click(function (e) {
      e.preventDefault();
      var id = $(this).closest("div").find('.delete_id').val();
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
              'id': id,
            };

            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "GET",
              url: '/employees/employee_delete/' + id,
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
  let  td='';
  console.log('insede redar');

//var table=$('#datatable').DataTable();
$("#dropselect").change(function () {

  console.log('jbwjebfjw');
  console.log($("#dropselect"));

                var id=$('#dropselect').val();
                console.log(id);
                $.ajax({
        url:"{{url('employees')}}",
        data: {id:id},
        success: function (data) {
          console.log('sec');
          console.log(data);
          if(JSON.parse(data)===null)
          $('.wrapp').html('null');

          else
         { $.each(JSON.parse(data), function (key, value) {
            for (var i = 0; i < value.length; i++){
              //console.log('value[i]');
              //console.log(value[i]);
myJSON = JSON.parse(data);
td +='<div class="profile"><input type="hidden" class="delete_id" value="'+value[i].emp_id+'"><img src="{{asset("img/users/'+value[i].emp_photo+'")}}" class="thumbnail"><h3 class="name">'+value[i].emp_first_name+' ' +value[i].emp_midel_name +'  '+value[i].emp_thired_name+' '+value[i].emp_last_name+'</h3><p class="title">'+value[i].name+'</p><p class="description"><i class="fa fa-phone m-2" aria-hidden="true"></i>'+value[i].emp_mobile+'</p><p class="description"><i class="fas fa-envelope m-2"></i>'+value[i].emp_email+'</p></div><div class="social-icons"><div class="icon"><a href="/"><i class="fa fa-eye" aria-hidden="true"></i></a></div><div class="icon"><a href="update"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a> </div><div class="icon"><a ><i class="fas fa-trash deletebtn"></i></a></div></div>';
$('.wrapp').html(td);
//</div>
   }
   td='';


});}


        },
        error:function(){
          console.log('err');


        }
          
            }); 
            });
   
});
</script>
@endsection