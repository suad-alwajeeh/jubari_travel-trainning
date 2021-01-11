@extends('app_layouts.master')

@section('main_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
<link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'><link rel="stylesheet" href="./style.css">

<div class="content-wrapper">

  <div class="main">
  <section class="signup">
        <div class="container">
          <div class="signup-content">
<form method="POST" action="/service/updateBus" enctype="multipart/form-data" id="signup-form" class="signup-form">
              @csrf
             
              <div class="around">
                <h2 class="form-title">Bus Info</h2>
                @foreach($data as $item)
                @foreach(json_decode($item->remark_body) as $model=>$val)

                <div class="form-row col-md-12 col-sm-12 col-xm-12">
                  <div class="form-group col-md-6 col-sm-12 col-xm-12">
                  
                    <label class="col-md-12 col-sm-12 col-xm-12">Issued Date: </label>
                    <div class="form-group " >
<input type="hidden" value="{{$item->bus_id}}" name="id">
                    @if($model=='issue_date')
                        @if($val=='null')
                      <input required type="date" class="form-control "
                      name="Issue_date" readonly value="{{ \Carbon\Carbon::createFromDate($item->Issue_date)->format('Y-m-d')}}" />
                          @else
                            <input required type="date" class="form-control "
                              name="Issue_date" value="{{ \Carbon\Carbon::createFromDate($item->Issue_date)->format('Y-m-d')}}" />
                            @endif
                    @endif
                   
                    </div>
                  </div>
                  <div class="form-group col-md-6 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-xm-12">Reference </label>
                    <div class="form-group" >
                    @if($model=='refernce')
                        @if($val=='null')
                      <input required type="text" readonly class="form-control" value="{{$item->refernce}}" name="refernce">
                   
                      @else
                      <input required type="text"  class="form-control text-red" value="{{$item->refernce}}" name="refernce">
 
                      @endif
                      @endif  
                        </div>
                  </div>
                </div>
                <div class="form-group clo-12">
                  <label class="col-12">Passenger Name : </label>
                  <div class="form-group" >

                  @if($model=='passenger_name')
                        @if($val=='null')
                    <input required  readonly type="text" class="form-control select2 select2-hidden-accessible"
                      name="passenger_name" value="{{$item->passenger_name}}" class="form-control select2 select2-hidden-accessible"
                      style="width: 100%;" />
                      @else
                      <input required type="text" class="form-control select2 select2-hidden-accessible"
                      name="passenger_name" value="{{$item->passenger_name}}" class="form-control select2 text-red select2-hidden-accessible"
                      style="width: 100%;" />
                      @endif
                      @endif
                  </div>
                </div>

               
                
                <div class="form-row">
                <div class="form-group col-md-4 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Bus Name :</label>
                    <div class="form-group">

                    @if($model=='bus_name')
                        @if($val=='null')
                      <input required type="text" class="form-control "
                        style="width:100%;" name="bus_name" value="{{$item->bus_name}}" />
                        @else
                        <input required type="text" class="form-control text-red "
                        readonly style="width:100%;" name="bus_name" value="{{$item->bus_name}}" />
                        @endif
                        @endif
                    </div>
                  </div>
                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Bus Number :</label>
                    <div class="form-group" >

                    @if($model=='bus_number')
                        @if($val=='null')
                      <input required type="number" class="form-control "
                        readonly style="width:100%;" name="bus_number" value="{{$item->bus_number}}" />
                        @else
                        <input required type="number" class="form-control text-red "
                        style="width:100%;" name="bus_number" value="{{$item->bus_number}}" />
                        @endif
                        @endif
                    </div>
                  </div>
                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Bus Status :</label>


                    <div class="form-group" data-select2-id="44">
                    
                    @if($model=='bus_status')
                        @if($val=='null')
                      <select class="form-control select2 select2-hidden-accessible" name="bus_status" id="code"
                        style="width: 100%;" data-select2-id="1" tabindex="0" aria-hidden="true">

 
                        <option value="1" selected>OK</option>
                        @else
                        <select class="form-control select2 select2-hidden-accessible" name="bus_status" id="code"
                        style="width: 100%;" data-select2-id="1" tabindex="0" aria-hidden="true">
                        <option value="1" selected>OK</option>
                        <option value="2" disables>Avoid</option>
                        <option value="3" disables>Refent</option>
                      
                        @endif
                        @endif

                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-row col-md-12 col-sm-12 col-xm-12">

                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Dep City </label>
                    <div class="form-group" data-select2-id="44">
                    @if($model=='Dep_city')
                        @if($val=='null')
                      <input required name="Dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum"
                        type="text"  readonly value="{{$item->Dep_city}}" class="form-control " list="cars" />
                        @else
                        <input required name="Dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum"
                        type="text" value="{{$item->Dep_city}}" class="form-control " list="cars" />
                        @endif
                        @endif

                    </div>
                  </div>

                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Dep Date </label>
                    <div class="form-group" data-select2-id="44">
                    @if($model=='dep_date')
                        @if($val=='null')
                   
                      <input required type="date" style="width:100%" value="{{ \Carbon\Carbon::createFromDate($item->Dep_date)->format('Y-m-d')}}""
                        class="form-control  " readonly name="dep_date"  />
                        @else
                        <input required type="date" style="width:100%" value="{{ \Carbon\Carbon::createFromDate($item->Dep_date)->format('Y-m-d')}}""
                        class="form-control  " name="dep_date"  />
                        @endif
                        @endif

                    </div>
                  </div>
                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Arr City </label>
                    <div class="form-group" data-select2-id="44">
                    @if($model=='arr_city')
                        @if($val=='null')
                      <input required type="text" style="width:100%" name="arr_city" onkeyup="addHyphen(this)"
                        id="tbNum2" readonly class="form-control " value="{{$item->arr_city}}" list="cars" />
                        @else 
                      <input required type="text" style="width:100%" name="arr_city" onkeyup="addHyphen(this)"
                        id="tbNum2" class="form-control " value="{{$item->arr_city}}" list="cars" />
                        @endif
                        @endif
                       

                    </div>
                  </div>
                </div>
              
                @endforeach

              <div class="around col-md-12 col-sm-12 col-xm-12 m-3">
                <div class="col-md-5 col-sm-12 col-xm-12 d-inline-block">
                  <h2 class="form-title">Provider Info </h2>
                  <div class="form-group col-md-12 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Provider Name </label>


                    <div class="form-group" data-select2-id="44">
                      <select  name="due_to_supp" required
                        class="form-control select2 select2-hidden-accessible provider" style="width: 100%;" data-select2-id="6"
                        tabindex="0" aria-hidden="true">
                        <option value="{{$item->s_no}}" selected>{{$item->supplier_name}}</option>

                        @foreach($suplier as $sup)
                    
<option value="{{$sup->s_no}}" >{{$sup->supplier_name}}</option>

          
             @endforeach
                  </select>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input type="number" style="width:100%;" required name="provider_cost"
                        class="form-control " value="{{ $item->provider_cost}}" />
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xm-12">
                    <label class="col-md-4 col-sm-12 col-xm-12">Currency </label>
                    <div class="form-group" >

                      <select  name="cur_id" required class="form-control select2 select2-hidden-accessible curency"
                        style="width: 100%;" data-select2-id="8" tabindex="0" aria-hidden="true">
                        <option value="{{$item->cur_id}}" selected> {{$item->cur_name}}</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-sm-12 col-xm-12 d-inline-block">
                  <h2 class="form-title"> Customer Info</h2>
                  <div class="form-group col-md-12 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Customer Name </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="due_to_customer" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="9" tabindex="0" aria-hidden="true">

                       
                        @foreach($emp as $emps)
                        @if($item->due_to_customer==$emps->emp_id)


                        <option selected value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                          {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>@else
<option value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                          {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
@endif
                        
                        @endforeach

                      </select>

                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="number" name="cost" style="width: 100%;"
                        class="form-control " value="{{ $item->cost}}" />
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="passnger_currency" class="form-control "
                        style="width: 100%;" data-select2-id="10" tabindex="0" aria-hidden="true">

                       
                        <option value="{{$item->passnger_currency}}" selected>{{$item->passnger_currency}}</option>
                        <option value="YER" >YER</option>
                        <option value="SAR">SAR</option>
                        <option value="USD">USD</option>

                      </select>
                    </div>
                  </div>
                </div>
              </div>
             
              @endforeach
          <div class="form-group">
          <button type="submit" class="btn btncolor text-white m-2 p-2  float-right"  id="submit" >Save Change</button>
          </div>
          </form>

        </div>
    </div>
    </section>

  </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
  
// ************************ Drag and drop ***************** //
let dropArea = document.getElementById("drop-area")

// Prevent default drag behaviors
;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, preventDefaults, false)   
  document.body.addEventListener(eventName, preventDefaults, false)
})

// Highlight drop area when item is dragged over it
;['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, unhighlight, false)
})

// Handle dropped files
dropArea.addEventListener('drop', handleDrop, false)

function preventDefaults (e) {
  e.preventDefault()
  e.stopPropagation()
}

function highlight(e) {
  dropArea.classList.add('highlight')
}

function unhighlight(e) {
  dropArea.classList.remove('active')
}

function handleDrop(e) {
  var dt = e.dataTransfer
  var files = dt.files

  handleFiles(files)
}

let uploadProgress = []
let progressBar = document.getElementById('progress-bar')

function initializeProgress(numFiles) {
  progressBar.value = 0
  uploadProgress = []

  for(let i = numFiles; i > 0; i--) {
    uploadProgress.push(0)
  }
}

function updateProgress(fileNumber, percent) {
  uploadProgress[fileNumber] = percent
  let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
  console.debug('update', fileNumber, percent, total)
  progressBar.value = total
}

function handleFiles(files) {
  files = [...files]
  initializeProgress(files.length)
  files.forEach(uploadFile)
  files.forEach(previewFile)
  $(".images").hide();
}

function previewFile(file) {
  let reader = new FileReader()
  reader.readAsDataURL(file)
  reader.onloadend = function() {
    let img = document.createElement('img')
    img.src = reader.result
    document.getElementById('gallery').appendChild(img)
  }
}

function uploadFile(file, i) {
  var url = 'https://api.cloudinary.com/v1_1/joezimim007/image/upload'
  var xhr = new XMLHttpRequest()
  var formData = new FormData()
  xhr.open('POST', url, true)
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')

  // Update progress (can be used to show progress indicator)
  xhr.upload.addEventListener("progress", function(e) {
    updateProgress(i, (e.loaded * 100.0 / e.total) || 100)
  })

  xhr.addEventListener('readystatechange', function(e) {
    if (xhr.readyState == 4 && xhr.status == 200) {
      updateProgress(i, 100) // <- Add this
    }
    else if (xhr.readyState == 4 && xhr.status != 200) {
      // Error. Inform the user
    }
  })

  formData.append('upload_preset', 'ujpu6gyk')
  formData.append('file', file)
  xhr.send(formData)
}
 // Get the element with id="defaultOpen" and click on it
 $(document).ready(function () {
    let td = '';
    let rm = '';
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear() + "-" + (month) + "-" + (day);

    $('#date').val(today);
    $('#date2').val(today);
    $('#date3').val(today);
    $('#date4').val(today);
    $('#date8').val(today);
    console.log( $('#date').val(today));
    $("input[type='radio']").change(function () {
      if ($(this).val() == "other") {
        $(".otherAnswer").show();
      } else {
        $(".otherAnswer").hide();
      }
    });

    $('#airline').change(function () {
      var id = $('#airline').val();
      console.log('insede airline');
      console.log(id);
      $.ajax({
        url: "{{url('/airline/airline_row')}}",
        data: { id: id },
        success: function (data) {
          console.log('sec');
          console.log(data);
          if (JSON.parse(data) === null)
            $('#code').html('null');

          else {
            $.each(JSON.parse(data), function (key, value) {
              for (var i = 0; i < value.length; i++) {
                console.log('value[i]');
                console.log(value[i]);
                myJSON = JSON.parse(data);

                $('#code').append($('<option >', {
                  value: value[i].id,
                  text: value[i].airline_code,
                  selected: true
                }));
              }
              td = '';


            });
          }
        },
        error: function () {
          console.log('err');
        }
      });

    });


    $('#code').change(function () {
      var id = $('#code').val();
      console.log('insede airline');
      console.log(id);
      $.ajax({
        url: "{{url('/airline/airline_row')}}",
        data: { id: id },
        success: function (data) {
          console.log('sec');
          console.log(data);
          if (JSON.parse(data) === null)
            $('#code').html('null');

          else {
            $.each(JSON.parse(data), function (key, value) {
              for (var i = 0; i < value.length; i++) {
                console.log('value[i]');
                console.log(value[i]);
                myJSON = JSON.parse(data);

                $('#airline').append($('<option >', {
                  value: value[i].id,
                  text: value[i].airline_name,
                  selected: true
                }));
              }
              td = '';


            });
          }
        },
      });

    });
    $('.provider').change(function () {
      var id = $('.provider').val();
      console.log('insede airline');
      console.log(id);
      $.ajax({
        url: "{{url('/suplier/suplier_row')}}",
        data: { id: id },
        success: function (data) {
          console.log('sec');
          console.log(data);
          if (JSON.parse(data) === null)
            $('.curency').html('null');

          else {
            $.each(JSON.parse(data), function (key, value) {
              for (var i = 0; i < value.length; i++) {
                console.log('value[i]');
                console.log(value[i]);
                myJSON = JSON.parse(data);
                td += '<option value="' + value[i].cur_id + '">' + value[i].cur_name + '</option>';
                rm= value[i].supplier_remark;
                
              }
              $('.curency').html(td);
                $('#remark').html(rm);
              td = '';
            });
          }
        },
        error: function () {
          console.log('err');
        }
      });

    });


  });
  function myFunction() {
    // Get the checkbox
    var checkBox = document.getElementById("myCheck");
    // Get the output text
    var text = document.getElementById("date3");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }

  function myFunctions() {
    // Get the checkbox
    var checkBox = document.getElementById("myChecks");
    // Get the output text
    var text = document.getElementById("date4");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }

  function addHyphen(element) {
    let ele = document.getElementById(element.id);
    ele = ele.value.split('/').join('');    // Remove dash (-) if mistakenly entered.

    let finalVal = ele.match(/.{1,3}/g).join('/');
    document.getElementById(element.id).value = finalVal;
  }
  var form1 = document.getElementById("number");
    var sub = document.getElementById("sub");


    var mass2 = document.getElementById("helpId2");
  
    var phoneNumber = "^[0-9]{10}$";
    var ssnNumber = "^\d{0-9}$";
    form1.addEventListener("keyup", function confirmName() {

        if (form1.value.match(phoneNumber)) {
            form1.style.borderColor = "green";
            return true;
        }
        else {
            mass2.innerHTML = "*Enter 10 number  ";
            form1.style.borderColor = "red";
            return false;
        }
    });
</script>

@endsection