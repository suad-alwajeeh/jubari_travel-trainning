@extends('app_layouts.master')
@section('main_content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
  /* @extend display-flex; */
  display-flex,
  .display-flex,
  .display-flex-center {
    display: flex;
  }

  a:focus,
  a:active {
    text-decoration: none;
    outline: none;
    transition: all 300ms ease 0s;

  }

  input,
  select,
  textarea {
    outline: none;
    appearance: unset !important;
  }



  input:focus,
  select:focus,
  textarea:focus {
    outline: none;
    box-shadow: none !important;
  }



  input[type=radio] {
    appearance: radio !important;
  }

  input[type=checkbox] {
    appearance: checkbox !important;
  }


  figure {
    margin: 0;
  }

  p {
    margin-bottom: 0px;
    font-size: 15px;
    color: #777;
  }

  h2 {
    line-height: 1.66;
    margin: 0;
    padding: 0;
    font-weight: 900;
    color: #222;
    font-family: 'Montserrat';
    font-size: 24px;
    text-transform: uppercase;
    text-align: center;
    margin-bottom: 40px;
  }

  .clear {
    clear: both;
  }


  body {}

  .container {

    position: relative;
    margin: 0 auto;
  }

  .display-flex {
    justify-content: space-between;

    align-items: center;
  }

  .display-flex-center {
    justify-content: center;

    align-items: center;
  }

  .position-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .signup-content {
    background: #fff;
    border-radius: 10px;

    padding: 50px 85px;
  }

  .form-group {
    overflow: hidden;
    margin-bottom: 20px;
  }

  .form-input {
    border: 1px solid #ebebeb;
    border-radius: 5px;

    padding: 17px 20px;
    box-sizing: border-box;
    font-size: 14px;
    font-weight: 500;
    color: #222;
  }

  .form-input:focus {
    border: 1px solid transparent;
    border-image-source: linear-gradient(to right, #9face6, #74ebd5);

    border-image-slice: 1;
    border-radius: 5px;
    background-origin: border-box;
    background-clip: content-box, border-box;
  }


  .form-submit {
    border-radius: 5px;

    padding: 17px 20px;
    box-sizing: border-box;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    text-transform: uppercase;
    border: none;
    float: right;
    background-image: linear-gradient(to left, #74ebd5, #9face6);
  }





  .label-agree-term {
    font-size: 12px;
    font-weight: 600;
    color: #555;
  }

  .term-service {
    color: #555;
  }

  .around {
    border-bottom: rgb(189, 184, 184) 1px solid;
  }

  .around2 {
    border-right: rgb(189, 184, 184) 1px solid;
  }

  .tab {
    overflow: hidden;
    border: 1px solid #fff;
    background-color: #fff;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ABD2EA;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ABD2EA;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #000;
    border-top: none;
  }

  /* Style the close button */
  .topright {
    float: right;
    cursor: pointer;
    font-size: 28px;
  }

  .topright:hover {
    color: red;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="content-wrapper">

  <div class="main">
    <div class="tab text-center">
      <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">
        <i class="nav-icon fas fa-plane"></i>Ticket</button>
      <button class="tablinks" onclick="openCity(ephp vent, 'bus')"> <i class="fas fa-bus"></i>Bus</button>
      <button class="tablinks" onclick="openCity(event, 'hotel')"><i class="fas fa-hotel"></i>Hotel</button>
      <button class="tablinks" onclick="openCity(event, 'visa')"><i class="fa fa-cc-visa"></i>Visa</button>
      <button class="tablinks" onclick="openCity(event, 'car')"><i class="fas fa-car"></i>Car</button>
      <button class="tablinks" onclick="openCity(event, 'repo')"><i class="fa fa-hospital-o"></i>Medical Report</button>
      <button class="tablinks" onclick="openCity(event, 'service')"> <img
          src="https://img.icons8.com/ios/30/000000/waiter.png" />General Service</button>
      <button class="tablinks" onclick="openCity(event, 'umrah')"><i class="fas fa-kaaba"></i>Umrah</button>
    </div>
    <div id="London" class="tabcontent">

      <section class="signup">
        <div class="container">
          <div class="signup-content">
            <form method="POST" action="add_ticket" enctype="multipart/form-data" id="signup-form" class="signup-form">
              @csrf
              <div class="around">
                <h2 class="form-title">Ticket Info</h2>

                <div class="form-row">
                  <div class="form-group col-6">
                    <label class="col-4">Issued Date: </label>
                    <div class="form-group " data-select2-id="44">

                      <input required type="date" class="form-control select2 select2-hidden-accessible"
                        name="Issue_date" id="date" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" />
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label class="col-4">Reference </label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="text" class="form-control select2 select2-hidden-accessible" name="refernce"
                        class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                    </div>
                  </div>
                </div>
                <div class="form-group clo-12">
                  <label class="col-4">Passenger Name : </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" class="form-control select2 select2-hidden-accessible"
                      name="passenger_name" class="form-control select2 select2-hidden-accessible"
                      style="width: 100%;" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-6">
                    <input type="radio" onchange="hideB(this)" name="aorb" class=" m-2" checked>one Way
                  </div>
                  <div class="form-group col-6">
                    <input type="radio" onchange="hideA(this)" name="aorb" class=" m-2" value="other">RoundTrip
                  </div>

                </div>


                <div class="form-row">

                  <div class="form-group col-6">
                    <label class="col-3">Airline :</label>

                    <div class="form-group" data-select2-id="44">
                      <select id="airline" name="airline" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach($airline as $airs)

                        <option value="{{$airs->id}}">{{$airs->airline_name}}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label class="col-3">code </label>
                    <div class="form-group" data-select2-id="44">
                      <select class="form-control select2 select2-hidden-accessible" name="ticket" id="code"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach($airline as $airs)

                        <option value="{{$airs->id}}">{{$airs->airline_code}}</option>

                        @endforeach

                      </select>
                    </div>


                  </div>
                </div>

                <div class="form-row">

                  <div class="form-group col-6">
                    <label class="col-5">Ticket Number :</label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="text" class="form-control select2 select2-hidden-accessible"
                        style="width:100%;" name="ticket_number" />
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label class="col-4">Ticket Status :</label>


                    <div class="form-group" data-select2-id="44">
                      <select class="form-control select2 select2-hidden-accessible" name="ticket_status" id="code"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">



                        <option value="1">OK</option>
                        <option value="2" disable>Avoid</option>
                        <option value="3" disable>Refent</option>


                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">

                  <div class="form-group col-4">
                    <label class="col-4">Dep City </label>
                    <div class="form-group" data-select2-id="44">

                      <input required name="Dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum"
                        type="text" class="form-control select2 select2-hidden-accessible" list="cars" />

                    </div>
                  </div>

                  <div class="form-group col-4">
                    <label class="col-6">Dep Date </label>
                    <div class="form-group" data-select2-id="44">
                      <input required type="date" style="width:100%"
                        class="form-control select2 select2-hidden-accessible" name="dep_date" id="date2" />
                    </div>
                  </div>
                  <div class="form-group col-4">
                    <label class="col-4">Arr City </label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="text" style="width:100%" name="arr_city" onkeyup="addHyphen(this)"
                        id="tbNum2" class="form-control select2 select2-hidden-accessible" list="cars" />

                    </div>
                  </div>
                </div>

                <div style="display:none;" class="otherAnswer">
                  <div class="form-row">

                    <div class="form-group col-4">
                      <label class="col-4">Dep City </label>
                      <div class="form-group" data-select2-id="44">


                        <input type="text" name="dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum3"
                          class="form-control select2 select2-hidden-accessible" list="cars" />

                      </div>
                    </div>

                    <div class="form-group col-4">
                      <label class="col-6">Dep Date </label>
                      <div class="form-group" data-select2-id="44">
                        <input type="date" name="dep_date2" style="width:100%"
                          class="form-control select2 select2-hidden-accessible" id="date2" />
                      </div>
                    </div>
                    <div class="form-group col-4">
                      <label class="col-4">Arr City </label>
                      <div class="form-group" data-select2-id="44">

                        <input type="text" name="arr_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum4"
                          class="form-control select2 select2-hidden-accessible" list="cars" />


                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-group" data-select2-id="44">

                      <input type="checkbox" id="myCheck" onclick="myFunction()">
                      <label class="col-4">Bursher Time </label>

                      <div id="text" class="form-group">
                        <input type="date" class="form-control select2 select2-hidden-accessible"
                          style="display:none; width:100%" name="bursher_time" id="date3" />
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="around col-12">
                <div class=" col-6  d-inline-block">
                  <h2 class="form-title">Provider Info </h2>
                  <div class="form-group">
                    <label class="col-4">Provider Name </label>


                    <div class="form-group" data-select2-id="44">
                      <select id="provider" name="due_to_supp" required
                        class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                        tabindex="-1" aria-hidden="true">

                        @foreach($suplier as $sup)

                        <option value="{{$sup->sup_id}}">{{$sup->sup_name}}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input type="text" style="width:100%;" required name="provider_cost"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select id="curency" name="cur_id" required class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                      </select>
                    </div>
                  </div>
                </div>
                <div class=" col-5  d-inline-block">
                  <h2 class="form-title"> Customer Info</h2>
                  <div class="form-group">
                    <label class="col-3">Customer Name </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="due_to_customer" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach($emp as $emps)

                        <option value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                          {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
                        @endforeach

                      </select>

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="text" name="cost" style="width: 100%;"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-3">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="passnger_currency" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">


                        <option value="" selected>YER</option>
                        <option value="">SAR</option>
                        <option value="">USD</option>

                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="around">
                <div class="form-group">
                  <h3 class="col-4">Remark </h3>

                  <div class="form-group" data-select2-id="44">

                    <textarea id="form7" class="md-textarea form-control" name="remark" rows="3"></textarea>
                  </div>
                </div>
              </div>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
          </div>
          </form>

        </div>
    </div>
    </section>

  </div>


  <!-- Bus info start-->
  <div id="bus" class="tabcontent">

    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <form method="POST" id="signup-form" class="signup-form">
            <div class="around">
              <h2 class="form-title">Bus Info</h2>

              <div class="form-row">
                <div class="form-group col-6">
                  <label class="col-4">Issued Date: </label>
                  <div class="form-group " data-select2-id="44">

                    <input required type="date" class="form-control select2 select2-hidden-accessible" name="Issue_date"
                      id="date" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Reference </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" class="form-control select2 select2-hidden-accessible" name="refernce"
                      class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
              </div>
              <div class="form-group clo-12">
                <label class="col-4">Passenger Name : </label>
                <div class="form-group" data-select2-id="44">

                  <input required type="text" name="passenger_name"
                    class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-4">Bus Number :</label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                      name="reference" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Bus Status :</label>
                  <div class="form-group" data-select2-id="44">

                    <select class="form-control select2 select2-hidden-accessible" name="ticket_status" id="code"
                      style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">



                      <option value="1">OK</option>
                      <option value="2" disable>Avoid</option>
                      <option value="3" disable>Refent</option>


                    </select>
                  </div>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-4">
                  <label class="col-4">Dep City </label>
                  <div class="form-group" data-select2-id="44">

                    <input required name="Dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum5" type="text"
                      class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>

                <div class="form-group col-4">
                  <label class="col-6">Dep Date </label>
                  <div class="form-group" data-select2-id="44">
                    <input required type="date" style="width:100%"
                      class="form-control select2 select2-hidden-accessible" name="dep_date" id="date2" />
                  </div>
                </div>
                <div class="form-group col-4">
                  <label class="col-3">Arr City </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" style="width:100%" name="arr_city" onkeyup="addHyphen(this)" id="tbNum6"
                      class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
                <div class="form-group ">
                  <label class="col-4">Bus Name </label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
              </div>


              <div class="around col-12">
                <div class=" col-6  d-inline-block">
                  <h2 class="form-title">Provider Info </h2>
                  <div class="form-group">
                    <label class="col-4">Provider Name </label>


                    <div class="form-group" data-select2-id="44">
                      <select id="provider" name="due_to_supp" required
                        class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                        tabindex="-1" aria-hidden="true">

                        @foreach($suplier as $sup)

                        <option value="{{$sup->sup_id}}">{{$sup->sup_name}}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input type="text" style="width:100%;" required name="provider_cost"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select id="curency" name="cur_id" required class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                      </select>
                    </div>
                  </div>
                </div>
                <div class=" col-5  d-inline-block">
                  <h2 class="form-title"> Customer Info</h2>
                  <div class="form-group">
                    <label class="col-3">Customer Name </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="due_to_customer" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach($emp as $emps)

                        <option value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                          {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
                        @endforeach

                      </select>

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="text" name="cost" style="width: 100%;"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-3">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="passnger_currency" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">


                        <option value="" selected>YER</option>
                        <option value="">SAR</option>
                        <option value="">USD</option>

                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="around">
                <div class="form-group">
                  <h3 class="col-4">Remark </h3>

                  <div class="form-group" data-select2-id="44">

                    <textarea id="form7" class="md-textarea form-control" name="remark" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
            </div>
          </form>

        </div>
      </div>
    </section>

  </div>
  <!-- end bus info-->
  <!-- hotel info start-->
  <div id="hotel" class="tabcontent">

    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <form method="POST" id="signup-form" class="signup-form">
            <div class="around">
              <h2 class="form-title">Hotel Info</h2>


              <div class="form-row">
                <div class="form-group col-6">
                  <label class="col-4">Issued Date: </label>
                  <div class="form-group " data-select2-id="44">

                    <input required type="date" class="form-control select2 select2-hidden-accessible" name="Issue_date"
                      id="date" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Reference </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" class="form-control select2 select2-hidden-accessible" name="refernce"
                      class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
              </div>
              <div class="form-group clo-12">
                <label class="col-4">Passenger Name : </label>
                <div class="form-group" data-select2-id="44">

                  <input required type="text" class="form-control select2 select2-hidden-accessible"
                    name="passenger_name" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-4">Voucher Number :</label>
                  <div class="form-group" data-select2-id="44">
                    <input type="text" class="form-control select2 select2-hidden-accessible" name="reference" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Hotel Status :</label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-4">
                  <label class="col-4">Dep City </label>
                  <div class="form-group" data-select2-id="44">

                    <input required name="Dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum7" type="text"
                      class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>

                <div class="form-group col-4">
                  <label class="col-6">Dep Date </label>
                  <div class="form-group" data-select2-id="44">
                    <input required type="date" style="width:100%"
                      class="form-control select2 select2-hidden-accessible" name="dep_date" id="date2" />
                  </div>
                </div>
                <div class="form-group col-4">
                  <label class="col-4">Arr City </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" style="width:100%" name="arr_city" onkeyup="addHyphen(this)" id="tbNum8"
                      class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
              </div>
              <div class="around col-12">
                <div class=" col-6  d-inline-block">
                  <h2 class="form-title">Provider Info </h2>
                  <div class="form-group">
                    <label class="col-4">Provider Name </label>


                    <div class="form-group" data-select2-id="44">
                      <select id="provider" name="due_to_supp" required
                        class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                        tabindex="-1" aria-hidden="true">

                        @foreach($suplier as $sup)

                        <option value="{{$sup->sup_id}}">{{$sup->sup_name}}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input type="text" style="width:100%;" required name="provider_cost"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select id="curency" name="cur_id" required class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                      </select>
                    </div>
                  </div>
                </div>
                <div class=" col-5  d-inline-block">
                  <h2 class="form-title"> Customer Info</h2>
                  <div class="form-group">
                    <label class="col-3">Customer Name </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="due_to_customer" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach($emp as $emps)

                        <option value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                          {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
                        @endforeach

                      </select>

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="text" name="cost" style="width: 100%;"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-3">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="passnger_currency" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">


                        <option value="" selected>YER</option>
                        <option value="">SAR</option>
                        <option value="">USD</option>

                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="around">
                <div class="form-group">
                  <h3 class="col-4">Remark </h3>

                  <div class="form-group" data-select2-id="44">

                    <textarea id="form7" class="md-textarea form-control" name="remark" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
            </div>
          </form>

        </div>
      </div>
    </section>

  </div>
  <!-- end hotel info-->
  <!-- visa info start-->
  <div id="visa" class="tabcontent">

    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <form method="POST" id="signup-form" class="signup-form">
            <div class="around">
              <h2 class="form-title">Visa Info</h2>


              <div class="form-row">
                <div class="form-group col-6">
                  <label class="col-4">Issued Date: </label>
                  <div class="form-group " data-select2-id="44">

                    <input required type="date" class="form-control select2 select2-hidden-accessible" name="Issue_date"
                      id="date" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Reference </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" class="form-control select2 select2-hidden-accessible" name="refernce"
                      class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
              </div>
              <div class="form-group clo-12">
                <label class="col-4">Passenger Name : </label>
                <div class="form-group" data-select2-id="44">

                  <input required type="text" class="form-control select2 select2-hidden-accessible"
                    name="passenger_name" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-4">Visa Number :</label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                      name="reference" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Visa Status :</label>
                  <div class="form-group" data-select2-id="44">

                    <select class="form-control select2 select2-hidden-accessible" name="ticket_status" id="code"
                      style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">



                      <option value="1">OK</option>
                      <option value="2" disable>Avoid</option>
                      <option value="3" disable>Refent</option>


                    </select>
                  </div>
                </div>
              </div>


              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-4">Country </label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />
                  </div>
                </div>


                <div class="form-group col-6">
                  <label class="col-4">Visa Type</label>
                  <div class="form-group" data-select2-id="44">
                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
                <div class="form-group col-12">
                  <label>Additional Info </label>
                  <div class="form-group" data-select2-id="44">
                    <input type="text" class="form-control select2 select2-hidden-accessible" name="info" />
                  </div>
                </div>

              </div>
            </div>
            <div class="around col-12">
              <div class=" col-6  d-inline-block">
                <h2 class="form-title">Provider Info </h2>
                <div class="form-group">
                  <label class="col-4">Provider Name </label>


                  <div class="form-group" data-select2-id="44">
                    <select id="provider" name="due_to_supp" required
                      class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                      tabindex="-1" aria-hidden="true">

                      @foreach($suplier as $sup)

                      <option value="{{$sup->sup_id}}">{{$sup->sup_name}}</option>
                      @endforeach

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-4">Cost </label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" style="width:100%;" required name="provider_cost"
                      class="form-control select2 select2-hidden-accessible" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-4">Currency </label>
                  <div class="form-group" data-select2-id="44">

                    <select id="curency" name="cur_id" required class="form-control select2 select2-hidden-accessible"
                      style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                    </select>
                  </div>
                </div>
              </div>
              <div class=" col-5  d-inline-block">
                <h2 class="form-title"> Customer Info</h2>
                <div class="form-group">
                  <label class="col-3">Customer Name </label>
                  <div class="form-group" data-select2-id="44">

                    <select name="due_to_customer" class="form-control select2 select2-hidden-accessible"
                      style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                      @foreach($emp as $emps)

                      <option value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                        {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
                      @endforeach

                    </select>

                  </div>
                </div>
                <div class="form-group">
                  <label class="col-4">Cost </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" name="cost" style="width: 100%;"
                      class="form-control select2 select2-hidden-accessible" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-3">Currency </label>
                  <div class="form-group" data-select2-id="44">

                    <select name="passnger_currency" class="form-control select2 select2-hidden-accessible"
                      style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">


                      <option value="" selected>YER</option>
                      <option value="">SAR</option>
                      <option value="">USD</option>

                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="around">
              <div class="form-group">
                <h3 class="col-4">Remark </h3>

                <div class="form-group" data-select2-id="44">

                  <textarea id="form7" class="md-textarea form-control" name="remark" rows="3"></textarea>
                </div>
              </div>
            </div>


            <div class="form-group">
              <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
            </div>
          </form>

        </div>
      </div>
    </section>

  </div>
  <!-- end visa info-->

  <!-- car info start-->
  <div id="car" class="tabcontent">

    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <form method="POST" id="signup-form" class="signup-form">
            <div class="around">
              <h2 class="form-title">Car Info</h2>


              <div class="form-row">
                <div class="form-group col-6">
                  <label class="col-4">Issued Date: </label>
                  <div class="form-group " data-select2-id="44">

                    <input required type="date" class="form-control select2 select2-hidden-accessible" name="Issue_date"
                      id="date" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Reference </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" class="form-control select2 select2-hidden-accessible" name="refernce"
                      class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
              </div>
              <div class="form-group clo-12">
                <label class="col-4">Passenger Name : </label>
                <div class="form-group" data-select2-id="44">

                  <input required type="text" class="form-control select2 select2-hidden-accessible"
                    name="passenger_name" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-4">Voucher Number :</label>
                  <div class="form-group" data-select2-id="44">
                    <input type="text" class="form-control select2 select2-hidden-accessible" name="reference" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Car Status :</label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-4">
                  <label class="col-4">Dep City </label>
                  <div class="form-group" data-select2-id="44">

                    <input required name="Dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum9" type="text"
                      class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>

                <div class="form-group col-4">
                  <label class="col-6">Dep Date </label>
                  <div class="form-group" data-select2-id="44">
                    <input required type="date" style="width:100%"
                      class="form-control select2 select2-hidden-accessible" name="dep_date" id="date2" />
                  </div>
                </div>
                <div class="form-group col-4">
                  <label class="col-4">Arr City </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" style="width:100%" name="arr_city" onkeyup="addHyphen(this)" id="tbNum10"
                      class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
                <div class="form-group col-12">
                  <label>Additional Info </label>
                  <div class="form-group" data-select2-id="44">
                    <input type="text" class="form-control select2 select2-hidden-accessible" name="info" />
                  </div>
                </div>
              </div>
            </div>

            <div class="around col-12">
              <div class=" col-6  d-inline-block">
                <h2 class="form-title">Provider Info </h2>
                <div class="form-group">
                  <label class="col-4">Provider Name </label>


                  <div class="form-group" data-select2-id="44">
                    <select id="provider" name="due_to_supp" required
                      class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                      tabindex="-1" aria-hidden="true">

                      @foreach($suplier as $sup)

                      <option value="{{$sup->sup_id}}">{{$sup->sup_name}}</option>
                      @endforeach

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-4">Cost </label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" style="width:100%;" required name="provider_cost"
                      class="form-control select2 select2-hidden-accessible" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-4">Currency </label>
                  <div class="form-group" data-select2-id="44">

                    <select id="curency" name="cur_id" required class="form-control select2 select2-hidden-accessible"
                      style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                    </select>
                  </div>
                </div>
              </div>
              <div class=" col-5  d-inline-block">
                <h2 class="form-title"> Customer Info</h2>
                <div class="form-group">
                  <label class="col-3">Customer Name </label>
                  <div class="form-group" data-select2-id="44">

                    <select name="due_to_customer" class="form-control select2 select2-hidden-accessible"
                      style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                      @foreach($emp as $emps)

                      <option value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                        {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
                      @endforeach

                    </select>

                  </div>
                </div>
                <div class="form-group">
                  <label class="col-4">Cost </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" name="cost" style="width: 100%;"
                      class="form-control select2 select2-hidden-accessible" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-3">Currency </label>
                  <div class="form-group" data-select2-id="44">

                    <select name="passnger_currency" class="form-control select2 select2-hidden-accessible"
                      style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">


                      <option value="" selected>YER</option>
                      <option value="">SAR</option>
                      <option value="">USD</option>

                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="around">
              <div class="form-group">
                <h3 class="col-4">Remark </h3>

                <div class="form-group" data-select2-id="44">

                  <textarea id="form7" class="md-textarea form-control" name="remark" rows="3"></textarea>
                </div>
              </div>
            </div>

            <div class="form-group">
              <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
            </div>
          </form>

        </div>
      </div>
    </section>

  </div>
  <!-- end car info-->

  <!-- repo info start-->
  <div id="repo" class="tabcontent">

    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <form method="POST" id="signup-form" class="signup-form">
            <div class="around">
              <h2 class="form-title">Medical Report Info</h2>


              <div class="form-row">
                <div class="form-group col-6">
                  <label class="col-4">Issued Date: </label>
                  <div class="form-group " data-select2-id="44">

                    <input required type="date" class="form-control select2 select2-hidden-accessible" name="Issue_date"
                      id="date" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Reference </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" class="form-control select2 select2-hidden-accessible" name="refernce"
                      class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
              </div>
              <div class="form-group clo-12">
                <label class="col-4">Passenger Name : </label>
                <div class="form-group" data-select2-id="44">

                  <input required type="text" class="form-control select2 select2-hidden-accessible"
                    name="passenger_name" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-3">Document Number :</label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" name="reference" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-3">Report Status :</label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-3">From city </label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />
                  </div>
                </div>


                <div class="form-group col-12">
                  <label>Additional Info </label>
                  <div class="form-group" data-select2-id="44">
                    <input type="text" class="form-control select2 select2-hidden-accessible" name="info">
                  </div>
                </div>
              </div>
              <div class="around col-12">
                <div class=" col-6  d-inline-block">
                  <h2 class="form-title">Provider Info </h2>
                  <div class="form-group">
                    <label class="col-4">Provider Name </label>


                    <div class="form-group" data-select2-id="44">
                      <select id="provider" name="due_to_supp" required
                        class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                        tabindex="-1" aria-hidden="true">

                        @foreach($suplier as $sup)

                        <option value="{{$sup->sup_id}}">{{$sup->sup_name}}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input type="text" style="width:100%;" required name="provider_cost"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select id="curency" name="cur_id" required class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                      </select>
                    </div>
                  </div>
                </div>
                <div class=" col-5  d-inline-block">
                  <h2 class="form-title"> Customer Info</h2>
                  <div class="form-group">
                    <label class="col-3">Customer Name </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="due_to_customer" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach($emp as $emps)

                        <option value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                          {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
                        @endforeach

                      </select>

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="text" name="cost" style="width: 100%;"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-3">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="passnger_currency" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">


                        <option value="" selected>YER</option>
                        <option value="">SAR</option>
                        <option value="">USD</option>

                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="around">
                <div class="form-group">
                  <h3 class="col-4">Remark </h3>

                  <div class="form-group" data-select2-id="44">

                    <textarea id="form7" class="md-textarea form-control" name="remark" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
            </div>
          </form>

        </div>
      </div>
    </section>

  </div>
  <!-- end repo info-->

  <!-- service info start-->
  <div id="service" class="tabcontent">

    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <form method="POST" id="signup-form" class="signup-form">
            <div class="around">
              <h2 class="form-title">General Service Info</h2>


              <div class="form-row">
                <div class="form-group col-6">
                  <label class="col-4">Issued Date: </label>
                  <div class="form-group " data-select2-id="44">

                    <input required type="date" class="form-control select2 select2-hidden-accessible" name="Issue_date"
                      id="date" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Reference </label>
                  <div class="form-group" data-select2-id="44">

                    <input required type="text" class="form-control select2 select2-hidden-accessible" name="refernce"
                      class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                  </div>
                </div>
              </div>
              <div class="form-group clo-12">
                <label class="col-4">Passenger Name : </label>
                <div class="form-group" data-select2-id="44">

                  <input required type="text" class="form-control select2 select2-hidden-accessible"
                    name="passenger_name" class="form-control select2 select2-hidden-accessible" style="width: 100%;" />
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-4">Voucher Number :</label>
                  <div class="form-group" data-select2-id="44">
                    <input type="text" class="form-control select2 select2-hidden-accessible" name="reference" />
                  </div>
                </div>
                <div class="form-group col-6">
                  <label class="col-4">Service Status :</label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>
              </div>
              <div class="form-row">

                <div class="form-group col-6">
                  <label class="col-3">Offered Service</label>
                  <div class="form-group" data-select2-id="44">

                    <input type="text" class="form-control select2 select2-hidden-accessible" list="cars" />

                  </div>
                </div>

                <div class="form-group col-12">
                  <label>Additional Info </label>
                  <div class="form-group" data-select2-id="44">
                    <input type="text" class="form-control select2 select2-hidden-accessible" name="info">
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-group" data-select2-id="44">

                    <label class="col-5">Bursher Time </label>

                    <input type="checkbox" class="form-control select2 select2-hidden-accessible" id="myChecks"
                      onclick="myFunctions()">
                    <div id="text" class="form-group">
                      <input type="date" class="form-input" style="display:none;" name="date" id="date4" />
                    </div>
                  </div>
                </div>
              </div>


              <div class="around col-12">
                <div class=" col-6  d-inline-block">
                  <h2 class="form-title">Provider Info </h2>
                  <div class="form-group">
                    <label class="col-4">Provider Name </label>


                    <div class="form-group" data-select2-id="44">
                      <select id="provider" name="due_to_supp" required
                        class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                        tabindex="-1" aria-hidden="true">

                        @foreach($suplier as $sup)

                        <option value="{{$sup->sup_id}}">{{$sup->sup_name}}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input type="text" style="width:100%;" required name="provider_cost"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select id="curency" name="cur_id" required class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                      </select>
                    </div>
                  </div>
                </div>
                <div class=" col-5  d-inline-block">
                  <h2 class="form-title"> Customer Info</h2>
                  <div class="form-group">
                    <label class="col-3">Customer Name </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="due_to_customer" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @foreach($emp as $emps)

                        <option value="{{$emps->emp_id}}">{{$emps->emp_first_name}} {{$emps->emp_middel_name}}
                          {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
                        @endforeach

                      </select>

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-4">Cost </label>
                    <div class="form-group" data-select2-id="44">

                      <input required type="text" name="cost" style="width: 100%;"
                        class="form-control select2 select2-hidden-accessible" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-3">Currency </label>
                    <div class="form-group" data-select2-id="44">

                      <select name="passnger_currency" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">


                        <option value="" selected>YER</option>
                        <option value="">SAR</option>
                        <option value="">USD</option>

                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="around">
                <div class="form-group">
                  <h3 class="col-4">Remark </h3>

                  <div class="form-group" data-select2-id="44">

                    <textarea id="form7" class="md-textarea form-control" name="remark" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
            </div>
          </form>

        </div>
      </div>
    </section>

  </div>
  <!-- end service info-->
</div>
</div>

<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
  $(document).ready(function () {
    let td = '';
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear() + "-" + (month) + "-" + (day);

    $('#date').val(today);
    $('#date2').val(today);
    $('#date3').val(today);
    $('#date4').val(today);
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
    $('#provider').change(function () {
      var id = $('#provider').val();
      console.log('insede airline');
      console.log(id);
      $.ajax({
        url: "{{url('/suplier/suplier_row')}}",
        data: { id: id },
        success: function (data) {
          console.log('sec');
          console.log(data);
          if (JSON.parse(data) === null)
            $('#curency').html('null');

          else {
            $.each(JSON.parse(data), function (key, value) {
              for (var i = 0; i < value.length; i++) {
                console.log('value[i]');
                console.log(value[i]);
                myJSON = JSON.parse(data);
                td += '<option value="' + value[i].cur_id + '">' + value[i].cur_name + '</option>';

                $('#curency').html(td);
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
</script>

@endsection