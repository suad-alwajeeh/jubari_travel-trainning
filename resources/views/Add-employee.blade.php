@extends('app_layouts.master')
@section('main_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet'
  href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
<link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'>
<link rel="stylesheet" href="./style.css">
<div class="content-wrapper">
  <div class="container p-4">


    <!-- /.card-header -->
    <!-- form start -->
    <div class="card card-outline card-info">
      <div class="card-header">
        <h2 class="card-title">
          Add Employee page
        </h2>
      </div>
      <div class="card-body">

        <form class="signup-form" id="form1" method="POST" action="saved" enctype="multipart/form-data">
          @csrf

          <div class="form-row col-md-12 col-sm-12 col-xm-12">
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12">Firest Name :</label>
              <div class="form-group " data-select2-id="44">

                <input type="text" class="form-control" id="user" name="emp_first_name" placeholder="First_name">
                <small id="helpId1" class="text-muted"></small>
              </div>
            </div>
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-xm-12">Middel Name :</label>
              <div class="form-group" data-select2-id="44">
                <input type="text" class="form-control" id="emp_middel_name" name="emp_medil_name" required
                  placeholder="Middel Name ">
                <small id="helpId2" class="text-muted"></small>
              </div>
            </div>

            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-xm-12">Thired Name :</label>
              <div class="form-group" data-select2-id="44">
                <input type="text" class="form-control" id="emp_thired_name" name="emp_thired_name" required
                  placeholder="Thired Name ">
                <small id="helpId3" class="text-muted"></small>
              </div>
            </div>
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-xm-12">last Name :</label>
              <div class="form-group" data-select2-id="44">
                <input type="text" class="form-control" id="emp_last_name" name="emp_last_name" required
                  placeholder="last Name ">
                <small id="helpId4" class="text-muted"></small>
              </div>
            </div>
          </div>


          <div class="form-row col-md-12 col-sm-12 col-xm-12">
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12">Dpartment :</label>
              <div class="form-group " data-select2-id="44">
                <select name="dept_id" class="form-control col-sm-12 select2 select2-hidden-accessible"
                  style="width: 100%;" data-select2-id="1" tabindex="0" aria-hidden="true">
                  @foreach($emps as $emp)
                  <option value="{{$emp->id}}">{{$emp->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12">Hire Date :</label>
              <div class="form-group " data-select2-id="44">
                <input type="date" value="YYYY-MM-DD" class="form-control" id="start-date" required name="emp_hirdate">
              </div>
            </div>
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12">Mobile :</label>
              <div class="form-group " data-select2-id="44">
                <input type="number" inputmode="numeric" maxlength="9" minlength="9" id="emp_mobile" name="emp_mobile"
                  min="1" max="999999999" class="form-control" placeholder="123456789" required>
                <small id="helpId6" class="text-muted">Mobile Number</small>

              </div>
            </div>
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12">Salary :</label>
              <div class="form-group " data-select2-id="44">
                <input type="number" class="form-control" name="emp_salary" required placeholder=" Salary ">
                <small id="helpId7" class="text-muted">accept only number</small>

              </div>
            </div>
          </div>
          <div class="form-row col-md-12 col-sm-12 col-xm-12">
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-xm-12"> email :</label>
              <div class="form-group" data-select2-id="44">

                <div class="d-flex align-items-center">
                  <input type="text" class="form-control col-md-11" id="" name="email" required
                    placeholder="email@example.com  ">
                  <i class="fa fa-times-circle  text-danger" id="x-circle" style="display:none;"></i>

                  <i id="circle" class="fa fa-check-circle text-primary" aria-hidden="true" style="display:none;"></i>
                  <div id="spinner" class="spinner-border spinner-border-sm  ml-auto text-primary" role="status"
                    aria-hidden="true" style="display:none;"></div>
                </div>
                <small id="helpId8" class="text-muted"></small>

              </div>
            </div>

            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12">
                Identity number:</label>
              <div class="form-group " data-select2-id="44">
                <input type="number" inputmode="numeric" maxlength="11" minlength="11" class="form-control"
                  name="emp_ssn" required placeholder=" Identity number ">
                <small id="helpId5" class="text-muted"></small>

              </div>
            </div>
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12">Account Number :</label>
              <div class="form-group " data-select2-id="44">
                <input type='number' class="form-control" name="account_number" />
              </div>
            </div>
            <div class="form-group col-md-3 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12">CV :</label>
              <div class="form-group " data-select2-id="44">
                <input type="file" class="form-control" accept=".pdf" name="attchment" required placeholder="  ">
                <small> Only Accept Pdf File</small>
              </div>
            </div>
          </div>
          <div class="form-row col-md-12 col-sm-12 col-xm-12">
            <div class="form-group col-md-4 col-sm-12 col-xm-12">
              <label class="col-md-12 col-sm-12 col-xm-12"> Photo of Proof of identity :</label>
              <div class="form-group " data-select2-id="44">
                <img id="image1" name="emp_photo" style="border:1px solid #CC8B79; width:150px; height:150px" alt=""
                  height="200px" width="200px" name="main_img" class="img-fluid rounded shadow-sm mx-auto d-block">


                <div class="input-group ">
                  <label for="upload" class=" p-2 mt-3 mx-auto btncolor">Chose Image:</label>
                  <input id="upload" type="file" name="emp_photo" onchange="onFilePicked(event)" accept="image/*"
                    style="display: none;">

                </div>
              </div>
            </div>

            <div class="form-group col-md-3 col-sm-12 col-xm-12 ">
              <div class="offset-sm-4 col-sm-8">
                <div class="form-check">
                  <input type="checkbox" checked class="form-check-input" name="is_active" id="active">
                  <label class="form-check-label" for="exampleCheck2">Active</label>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-5">
            <a href="{{url('employees')}}" class="btn btn-outline-danger so_form_btn">Cancel</a>
            <button type="submit" id="login_btn" class="btn btn-outline-primary so_form_btn disabled "
              id="submit">SEND</button>

          </div>
          <!-- /.card-footer -->
        </form>

      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
  integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
  crossorigin="anonymous"></script>
<script>
  var login_btn = document.querySelector("#login_btn");
  login_btn.disabled = true;
  /*form validation*/
  var form1 = document.getElementById("form1");
  var sub = document.getElementById("sub");
  var spinner = document.getElementById("spinner");
  var circle = document.getElementById("circle");
  var x_circle = document.getElementById("x-circle");

  var mass1 = document.getElementById("helpId1");
  var mass2 = document.getElementById("helpId2");
  var mass3 = document.getElementById("helpId3");
  var mass4 = document.getElementById("helpId4");
  var mass5 = document.getElementById("helpId5");
  var mass6 = document.getElementById("helpId6");
  var mass7 = document.getElementById("helpId7");
  var mass8 = document.getElementById("helpId8");
  //format the input 
  var nameFormat = /^[A-Za-z-0-9-ا-ب-ت-ث-ج-ح-خ-د-ذ-ر-ز-س-ش-ص-ض-ط-ظ-ع-غ-ف-ق-ك-ل-م-ن-ه-و-ي-ة]+$/;
  var phoneNumber = "^[0-9]{9}$";
  var ssnNumber = "^\d{0-9}$";
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;





  //validation first name
  form1[0].addEventListener("keyup", function confirmName() {

    if (form1[0].value.match(nameFormat)) {
      form1[0].style.borderColor = "green";
      return true;
    }
    else {
      mass2.innerHTML = "*Enter field Name ";
      form1[0].style.borderColor = "red";
      return false;
    }
  });
  //validation middel name

  form1[1].addEventListener("keyup", function confirmName() {

    if (form1[1].value.match(nameFormat)) {
      form1[1].style.borderColor = "green";
      return true;
    }
    else {
      mass2.innerHTML = "*Enter field Name ";
      form1[1].style.borderColor = "red";
      return false;
    }
  });
  //validation thired name

  form1[3].addEventListener("keyup", function confirmName() {

    if (form1[3].value.match(nameFormat)) {
      form1[3].style.borderColor = "green";
      return true;
    }
    else {
      mass3.innerHTML = "*Enter field Name ";
      form1[3].style.borderColor = "red";
      return false;
    }
  });
  //validation last name

  form1[4].addEventListener("keyup", function confirmName() {

    if (form1[4].value.match(nameFormat)) {
      form1[4].style.borderColor = "green";
      return true;
    }
    else {
      mass4.innerHTML = "*Enter field Name ";
      form1[4].style.borderColor = "red";
      return false;
    }
  });
  //validation Identity number

  form1[10].addEventListener("keyup", function confirmName() {

    if (form1[10].value.length == 11) {
      form1[10].style.borderColor = "green";
      return true;
    }
    else {
      mass5.innerHTML = "*Enter 11 Degit";
      form1[10].style.borderColor = "red";
      return false;
    }
  });
  //validation phone number 

  form1[7].addEventListener("keyup", function confirmName() {

    if (form1[7].value.match(phoneNumber)) {
      form1[7].style.borderColor = "green";
      return true;
    }
    else {
      mass6.innerHTML = "*Enter phone 777777777";
      form1[7].style.borderColor = "red";
      return false;
    }
  });
  //validation Email format

  form1[9].addEventListener("input", function confirmEmail() {
    console.log('nnnnnnnn');
    if (form1[9].value.match(mailformat)) {
      spinner.style.display = "block";

      var email = form1[9].value;
      console.log('email');
      console.log(email);
      //validation if email is exsiit

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: '/employees/checkEmail',
        data: { email: email },

      }).done(function (response) {
        if (response == 0) {
          form1[9].style.borderColor = "green";
          mass8.innerHTML = " ";
          spinner.style.display = "none";
          x_circle.style.display = "none";
          circle.style.display = "block";
          login_btn.disabled = false;
          login_btn.className = "btn btn-outline-primary so_form_btn enabled"
          return true;
        }

        else {
          console.log('response');
          console.log(response);
          spinner.style.display = "none";
          circle.style.display = "none";
          x_circle.style.display = "block";
          mass8.innerHTML = "*This Email Already Existing";
        }

      })
    }
    else {
      mass8.innerHTML = "*Enter Field Email ";
      form1[9].style.borderColor = "red";
      return false;
    }
  });

  //validation upload file

  function onFilePicked(event) {

    const files = event.target.files
    console.log(files)
    let filename = files[0].name
    if (filename.lastIndexOf('.') <= 0) {
      return alert('not image')
    }
    let filesize = files[0].size
    console.log(filesize)

    let fileType = files[0].type
    console.log(fileType)

    if (fileType !== 'image/png') {
      if (fileType !== 'image/jpeg') {
        return alert('image type not supported')
      }
    }
    const fileReder = new FileReader()
    let formData = new FormData()
    formData.append('file', files[0])
    fileReder.addEventListener('load', () => {
      let dataURI = fileReder.result
      if (dataURI) {
        document.getElementById('image1').src = dataURI

      }
    })
    fileReder.readAsDataURL(files[0])
    console.log(this.image)
  }
</script>
@endsection