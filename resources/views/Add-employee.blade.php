@extends('app_layouts.master')
@section('main_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet'
    href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
<link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'>
<link rel="stylesheet" href="./style.css">

<div class="content-wrapper">


    <!-- /.card-header -->
    <!-- form start -->
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form class="signup-form" id="form1" method="POST" action="saved" enctype="multipart/form-data">
                        @csrf
                        <h2 class="form-title">Ticket Info</h2>

                        <div class="form-row col-md-12 col-sm-12 col-xm-12">
                            <div class="form-group col-md-3 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-sm-12 col-xm-12">Firest Name :</label>
                                <div class="form-group " data-select2-id="44">

                                    <input type="text" class="form-control" id="user" name="emp_first_name"
                                        placeholder="First_name">
                                    <small id="helpId1" class="text-muted"></small>
                                </div>
                            </div>
                            <div class="form-group col-md-3 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-xm-12">Middel Name :</label>
                                <div class="form-group" data-select2-id="44">
                                    <input type="text" class="form-control" id="emp_middel_name" name="emp_medil_name"
                                        required placeholder="Middel Name ">
                                    <small id="helpId2" class="text-muted"></small>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-3 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-xm-12">Thired Name :</label>
                                <div class="form-group" data-select2-id="44">
                                    <input type="text" class="form-control" id="emp_thired_name" name="emp_thired_name"
                                        required placeholder="Thired Name ">
                                    <small id="helpId3" class="text-muted"></small>
                                </div>
                            </div>
                            <div class="form-group col-md-3 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-xm-12">last Name :</label>
                                <div class="form-group" data-select2-id="44">
                                    <input type="text" class="form-control" id="emp_last_name" name="emp_last_name"
                                        required placeholder="last Name ">
                                    <small id="helpId4" class="text-muted"></small>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-row col-md-12 col-sm-12 col-xm-12">
                            <div class="form-group col-md-3 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-sm-12 col-xm-12">Dpartment :</label>
                                <div class="form-group " data-select2-id="44">
                                    <select name="dept_id"
                                        class="form-control col-sm-12 select2 select2-hidden-accessible"
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
                                    <input type="date" value="YYYY-MM-DD" class="form-control" id="start-date" required
                                        name="emp_hirdate">
                                </div>
                            </div>
                            <div class="form-group col-md-3 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-sm-12 col-xm-12">Mobile :</label>
                                <div class="form-group " data-select2-id="44">
                                    <input type="text" id="emp_mobile" name="emp_mobile" class="form-control"
                                        placeholder="123456789" required>
                                    <small id="helpId6" class="text-muted">Mobile Number</small>

                                </div>
                            </div>
                            <div class="form-group col-md-3 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-sm-12 col-xm-12">Salary :</label>
                                <div class="form-group " data-select2-id="44">
                                    <input type="number" class="form-control" name="emp_salary" required
                                        placeholder=" Salary ">
                                    <small id="helpId7" class="text-muted">accept only number</small>

                                </div>
                            </div>
                        </div>
                        <div class="form-row col-md-12 col-sm-12 col-xm-12">
                            <div class="form-group col-md-6 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-sm-12 col-xm-12">
                                    Identity number:</label>
                                <div class="form-group " data-select2-id="44">
                                    <input type="number" class="form-control" name="emp_ssn" required
                                        placeholder=" Identity number ">
                                    <small id="helpId5" class="text-muted"></small>

                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-sm-12 col-xm-12">Account Number :</label>
                                <div class="form-group " data-select2-id="44">
                                    <input type='number' class="form-control" name="account_number" id="email" />
                                    <small id="helpId8" class="text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row col-md-12 col-sm-12 col-xm-12">
                            <div class="form-group col-md-4 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-sm-12 col-xm-12"> Photo of Proof of identity :</label>
                                <div class="form-group " data-select2-id="44">
                                    <img id="image1" name="emp_photo"
                                        style="border:1px solid #CC8B79; width:150px; height:150px" alt=""
                                        height="200px" width="200px" name="main_img"
                                        class="img-fluid rounded shadow-sm mx-auto d-block">


                                    <div class="input-group ">
                                        <label for="upload" class=" p-2 mt-3 mx-auto btncolor">Chose Image:</label>
                                        <input id="upload" type="file" name="emp_photo" onchange="onFilePicked(event)"
                                            accept="image/*" style="display: none;">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-sm-12 col-xm-12">CV :</label>
                                <div class="form-group " data-select2-id="44">
                                    <input type="file" class="form-control" accept=".pdf" name="attchment" required
                                        placeholder="  ">
                                    <small> Only Accept Pdf File</small>
                                </div>
                            </div>
                            <div class="form-group col-md-3 col-sm-12 col-xm-12 ">
                    <div class="offset-sm-4 col-sm-8">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" id="active">
                            <label class="form-check-label" for="exampleCheck2">Active</label>
                        </div>
                    </div>
                </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-12 col-xm-12">
                                <label class="col-md-12 col-xm-12"> email :</label>
                                <div class="form-group" data-select2-id="44">
                                    <input type="text" class="form-control" id="" name="email"
                                        required placeholder="email@example.com  ">
                                    <small id="helpId2" class="text-muted"></small>
                                </div>
                            </div>

                        <div class="">
                            <a href="{{url('employees')}}" class="btn btn-default  m-2 p-2 float-left col-3">Cancel</a>
                            <button type="submit" class="btn btncolor text-white m-2 p-2 col-3 float-right"
                                id="submit">ADD</button>

                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
        </section>

    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
    integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
    crossorigin="anonymous"></script>
<script>
    /*form validation*/
    var form1 = document.getElementById("form1");
    var sub = document.getElementById("sub");


    var mass1 = document.getElementById("helpId1");
    var mass2 = document.getElementById("helpId2");
    var mass3 = document.getElementById("helpId3");
    var mass4 = document.getElementById("helpId4");
    var mass5 = document.getElementById("helpId5");
    var mass6 = document.getElementById("helpId6");
    var mass7 = document.getElementById("helpId7");
    var mass8 = document.getElementById("helpId8");

    var nameFormat = /^[A-Za-z ]+$/;
    var phoneNumber = "^[0-9]{9}$";
    var ssnNumber = "^\d{0-9}$";
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;






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
    form1[9].addEventListener("keyup", function confirmName() {

        if (form1[9].value.length == 11) {
            form1[9].style.borderColor = "green";
            return true;
        }
        else {
            mass5.innerHTML = "*Enter 11 Degit";
            form1[9].style.borderColor = "red";
            return false;
        }
    });
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
   /* form1[10].addEventListener("keyup", function confirmEmail() {
        if (form1[10].value.match(mailformat)) {
            form1[10].style.borderColor = "green";
            return true;
        }
        else {
            mass8.innerHTML = "*Enter Field Email ";
            form1[10].style.borderColor = "red";
            return false;
        }
    });*/






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