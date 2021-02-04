<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JUBARI_TRAVEL SYSTEM</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome-free/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/ourstyle.css")}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }

        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
    </style>
      <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

  </script>
  
</head>
<body>
<div id="app">
  

    @include('includes.header')

<!-- /.navbar -->

<!-- Main Sidebar Container -->
@include('includes.sidebar')



@yield('main_content')

@include('includes.footer')

</div>

<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
function ee(from,to){
  var count=0;
  var userd_id= {{ Auth::user()->id }};

  $.ajax({
                type: "get",
                url: "message/"+from, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                //  $('.user').removeClass('active')
              //  alert(from);
                var uses = $('#'+from).find('.users');
                var pending = $('#'+from).find('.pending');
                pending.html(' '); 
                uses.addClass('active');
           
            // alert(c);
            pending.remove();


var mebody='';
$('#mseege_body').html('');
$.ajax({
url:'/user_notify/'+userd_id,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
    $('#mseege_body').html('');
  }else{
    $.map(response ,function(k,v){
      count++;
                  for(var i in k){
                  alert(k.to);
                    if(k.to==0)
{                    mebody+='<a onclick="ee('+k.from+','+k.to+')" class="dropdown-item user" id="'+k.id+'"><div class="media"><div class="media-body"> <h3 class="dropdown-item-title">'+k.name+' Send Message  In Group<span class="float-right text-sm text-danger"></span></h3><p class="text-sm">'+k.message+'</p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '+k.created_at+'</p></div></div></a>';
}                   else
{                    mebody+='<a onclick="ee('+k.from+','+k.to+')" class="dropdown-item user" id="'+k.id+'"><div class="media"><div class="media-body"> <h3 class="dropdown-item-title">'+k.name+' Send Message  For You<span class="float-right text-sm text-danger"></span></h3><p class="text-sm">'+k.message+'</p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '+k.created_at+'</p></div></div></a>';
}                   
                  }
                  $('#mseege_body').prepend(mebody);
                  $('#mecount').html(count);
}); }}});
             $('#messages').html(data);
                    scrollToBottomFunc();
                }
            });
  
}
$(document).ready(function(){
  var get_image={{ Auth::user()->id }};
  //SHOW USER IMAGE AND NAME
  $.ajax({
url:'/user_profile/'+get_image,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
    console.log(response[0]);
   // alert(response[0].e_photo);
    var img=response[0].e_photo;
    var name=response[0].ef_name +' '+response[0].em_name;
   $('#su_user_image').html('<img src="img/users/'+img+'"  class="img-circle elevation-2" alt="User Image">');
   $('#su_user_name').text(name);
   }
}
});
//SHOW USER ADDS
  var user_id= {{ Auth::user()->id }};
$.ajax({
url:'/adds_user_display_u/'+user_id,
type:'get',
dataType:'json',
success:function(response){

  if(response.length==0){
    console.log("not found thing");
  }else{
    console.log(response[0]);
    $('#myModalss').modal('show');
   $('#bbsize').html('<div class=card bg-dark id=card'+response[0].au_id+'><div class="card-body">'+response[0].a_text+'</div><div class="card-footer text-center"><div class="btn-group"><button data-dismiss="modal" onclick="ok('+response[0].au_id+')" type="button" class="btn btn-success">ok</button><button type="button" data-dismiss="modal" onclick="cansel('+response[0].au_id+')" class="btn btn-danger">cansel</button></div></div></div>');
  
      }
}
});
//SHOW NOTIFICATION COUNTER
var uuser_iid={{ Auth::user()->id }};
  
  $.ajax({
url:'/notify_count/'+uuser_iid,
type:'get',
dataType:'json',
success:function(response){
  if(response.length==0){
    console.log("not found thing");
  }else{
  $('#mecount').text(response[0].count );
   }
}
});

var mebody='';
$.ajax({
url:'/user_notify/'+uuser_iid,
type:'get',
dataType:'json',
success:function(response){
  //alert('hhhhh');

  if(response.length==0){
    console.log("not found thing");
  }else{
   // alert(response.message);
    $.map(response ,function(k,v){
      //alert(k);
                
                  for(var i in k){
                    if(k.to==0)
{                    mebody+='<a onclick="ee('+k.from+','+k.to+')" class="dropdown-item user" id="'+k.id+'"><div class="media"><div class="media-body"> <h3 class="dropdown-item-title">'+k.name+' Send Message  In Group<span class="float-right text-sm text-danger"></span></h3><p class="text-sm">'+k.message+'</p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '+k.created_at+'</p></div></div></a>';
}                   else
{                    mebody+='<a onclick="ee('+k.from+','+k.to+')" class="dropdown-item user" id="'+k.id+'"><div class="media"><div class="media-body"> <h3 class="dropdown-item-title">'+k.name+' Send Message  For You<span class="float-right text-sm text-danger"></span></h3><p class="text-sm">'+k.message+'</p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '+k.created_at+'</p></div></div></a>';
}                                    
                  }
                  $('#mseege_body').prepend(mebody);
});
   }
}
});
  

});
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function () {
        // ajax setup form csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6883c49c6bc80e6506a0', {
            cluster: 'ap2',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        var channel2 = pusher.subscribe('my-channel2');
        var n_body=$("#messages");
        var mseege_body=$("#mseege_body");
        var mecount=$("#mecount");
        var mecounter=$("#mecount").val();

        
        channel2.bind('my-event2', function (data) {
          var mess=JSON.stringify(data);
          mseege_body.prepend(mess);
        });
       
    
        channel.bind('my-event', function (data) {
            // alert(JSON.stringify(data.message));
             var n_mess=JSON.stringify(data.message);
     
    // alert(n_body);
            if (my_id == data.from||data.to==0) {
                $('#' + data.to).click();
                 n_body.prepend(n_mess);
                // mseege_body.prepend(n_mess);
                 //alert(n_body);
                 
            } else if (my_id == data.to) {
                if (receiver_id == data.from) {
                    // if receiver is selected, reload the selected user ...
                    $('#' + data.from).click();
                   n_body.prepend(n_mess);
                   //mseege_body.prepend(n_mess);
                  
                  
                } else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.from).find('.pending').html());
                   
                    if (pending) {
                       
                        $('#' + data.from).find('.pending').html(pending + 1);
                        $('#' + data.from).find('#mecount').html(mecounter+1);
               //  alert(mecount);
                        //document.getElementById('mecount').innerHTML =pending +1;
                  
                    } else {
                        $('#' + data.from).append('<span class="pending">1</span>');

                    }
                    
                }
                
            }
           
        });

        $('.user').click(function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            var c=$(this).find('.pending').val();
            var users_id=$(this).find('#eradah_id').val();
            var count=$('#mecount').val();
            $('#mecount').html(count - c);
            // alert(c);
            $(this).find('.pending').remove();


            receiver_id = $(this).attr('id');
           // alert(receiver_id);
            console.log('receiver_id');
            console.log(receiver_id);
  var userd_id= {{ Auth::user()->id }};

            ee(receiver_id,userd_id)
           
        });


        $('.group').click(function () {
            $('.group').removeClass('active');
            $(this).addClass('active');
            receiver_id = $(this).attr('id');
         alert(receiver_id);
            $.ajax({
                type: "get",
                url: "chatRepo/all" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                    $('#mgroup').html(data);
                    scrollToBottomFunc();
                }
            });
        });


        $(document).on('keyup', '.input-text input', function (e) {
            var message = $(this).val();

            // check if enter key is pressed and message is not null also receiver is selected
            if (e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val(''); // while pressed enter text box will be empty
//console.log(receiver_id);
                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "post",
                    url: "message", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {

                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
            }
        });
    });

    // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  });

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false;

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  });

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
  });

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
  });

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
  });

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };
  // DropzoneJS Demo Code End
</script>
</body>
</html>
