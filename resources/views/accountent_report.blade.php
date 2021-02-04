@extends('app_layouts.master')
@section('main_content')

<style>
    @media screen and (min-width: 676px) {
      #myModal_acc .modal-dialog {
          max-width: 95%; /* New width for default modal */
        }
    }
</style>
<div class="content-wrapper">
  <div class="container py-4">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Accountent Repots </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-outline-light" onclick="su_report_1()">
                    <i >generate report for one date</i>
                  </button>
                  <button type="button" class="btn btn-outline-dark" onclick="su_report_2()">
                  <i class="fas fa-calender">generate report between two dates</i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="row" id="su_report_1">

                   <div class="form-group col-1" style="display:">
                  <label>service</label>
                  <select  id="filter_m_ser" onchange="chang_stat()" class="ses_repo_filter form-control select2" style="width: 100%;">
                                    <option selected="selected" value="0">all</option>
                    @foreach($data3 as $d3)
                    <option value="{{$d3->ser_id}}">{{$d3->ser_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-1">
                  <label>status</label>
                  <select onchange="filter_item('ses_status','in')" id="ses_status" class="ses_repo_filter form-control select2" data-placeholder="Select a State" style="width: 100%;">
                  <option value="no"></option>
                  <option value="1,2,3,4">all</option>
                  <option value="1">ok</option>
                  <option value="2">issue</option>
                  <option value="3">void</option>
                  <option value="4">refund</option>
                  </select>
                </div>
                   <div class="form-group col-2">
                  <label>issue date</label>
                  <input type="date" id="issue_date" oninput="filter_item('issue_date','=')" class="ses_repo_filter form-control" id="start-date" required name="emp_hirdate">
                </div>
                   <div class="form-group col-2">
                  <label>issue by</label>
                  <select onchange="filter_item('user_id','=')" id="user_id" class="ses_repo_filter form-control select2" style="width: 100%;">
                  <option value="no"></option>
                  @foreach($data5 as $d5)
                    <option value="{{$d5->u_id}}">{{$d5->u_name}}</option>
                  @endforeach
                </select>
                </div>
                   <div class="form-group col-2">
                  <label>provider name</label>
                  <select onchange="filter_item('due_to_supp','=')" id="due_to_supp" class="form-control ses_repo_filter select2" style="width: 100%;">
                  <option value="no"></option>
                   @foreach($data4 as $d4)
                    <option value="{{$d4->s_no}}">{{$d4->supplier_name}}</option>
                  @endforeach
                  </select>
                </div>
                   <div class="form-group col-1">
                  <label> currency</label>
                  <select onchange="filter_item('ses_cur_id','=')" id="ses_cur_id" class="ses_repo_filter form-control select2" style="width: 100%;">
                 <option value="no"></option>
                  @foreach($data6 as $d6)
                  <option value="{{$d6->cur_id}}">{{$d6->cur_name}}</option>
                  @endforeach             
                     </select>
                </div>
                <div class=" form-group col-1 mt-4 pt-2">
                  <button class="btn btn-info disabled" id="ses_first_type" onclick="get_filter()">go</button>
                </div>
              </div>
              <div class="row" id="su_report_2">

<div class="form-group col-1" style="display:">
<label>service</label>
<select disabled  id="filter_m_ser2" onchange="chang_stat2()" class="form-control select2" style="width: 100%;">
                 <option selected="selected" value="0">all</option>
 @foreach($data3 as $d3)
 <option value="{{$d3->ser_id}}">{{$d3->ser_name}}</option>
 @endforeach
</select>
</div>
<div class="form-group col-1">
<label>status</label>
<select disabled onchange="filter_item2('ses_status','in')" id="ses_status2" class="form-control select2" data-placeholder="Select a State" style="width: 100%;">
<option value="1,2,3,4">all</option>
<option value="1">ok</option>
<option value="2">issue</option>
<option value="3">void</option>
<option value="4">refund</option>
</select>
</div>
<div class="form-group col-2">
<label>issue date from</label>
<input type="date" id="issue_date2"  oninput="filter_item2('issue_date','BETWEEN')" class="form-control" id="start-date" required name="emp_hirdate">
</div>
<div class="form-group col-2">
<label>to issue date</label>
<input type="date" readonly id="ISU_DATE" oninput="filter_item3()" class="form-control" id="start-date" required name="emp_hirdate">
</div>
<div class="form-group col-2">
<label>issue by</label>
<select onchange="filter_item2('user_id','=')" id="user_id2" disabled class="form-control select2" style="width: 100%;">
<option value="no"></option>
@foreach($data5 as $d5)
 <option value="{{$d5->u_id}}">{{$d5->u_name}}</option>
@endforeach
</select>
</div>
<div class="form-group col-2">
<label>provider name</label>
<select onchange="filter_item2('due_to_supp','=')" id="due_to_supp2" disabled class="form-control select2" style="width: 100%;">
<option value="no"></option>
@foreach($data4 as $d4)
 <option value="{{$d4->s_no}}">{{$d4->supplier_name}}</option>
@endforeach
</select>
</div>
<div class="form-group col-1">
<label> currency</label>
<select onchange="filter_item2('ses_cur_id','=')" id="ses_cur_id2" disabled class="form-control select2" style="width: 100%;">
<option value="no"></option>
@foreach($data6 as $d6)
<option value="{{$d6->cur_id}}">{{$d6->cur_name}}</option>
@endforeach             
  </select>
</div>
<div class=" form-group col-1 mt-4 pt-2">
<button class="btn btn-info disabled" onclick="get_filter2()" id="ses_first_type2">go</button>
</div>
</div>

<div class="table-responsive">

                <!--div  class="alert so-alert-message" id="in_success_or_not" ><button type="button" data-dismiss="alert" class="close">&times;</button></div-->         
                <table id=""  class="table acc_table_repo table-striped">
                
    <thead>
      <tr>
      <th>id</th>
      <th>type</th>
      <th>servic number</th>
      <th>bill number</th>
      <th> refrences</th>
      <th>issuedDate</th>
      <th>issuedBy</th>
      <th>passenger</th>
      <th>provider</th>
      <th>cost</th>
      <th>c</th>
      <th>cost</th>
      <th>status</th>
      </tr>
    </thead>
    <tbody id="filter_data_come_here">
    </tbody>
    </table>
    </div>
    </div>
    <p><button class="btn btn-primary" onclick="expoort()">export as excel</button></p>

    </div>
    <script>
    function expoort(){
      $('.acc_table_repo').tblToExcel();
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
    }
    </script>
              <!-- /.card-body -->
              </div>
         <div class="col-md-3 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Today Sales </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
              <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th>type</th>                     
                    <th>total</th>                     
                    <th>my sales</th>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($today as $to)
                    <tr>
                    <td>Ticket</td>
                    <td>{{$to->glot}}</td>
                    <td>{{$to->spet}}</td>
                    </tr> 
                    <tr>
                    <td>Bus</td>
                    <td>{{$to->glob}}</td>
                    <td>{{$to->speb}}</td>
                    </tr> 
                    <tr>
                    <td>Car</td>
                    <td>{{$to->gloc}}</td>
                    <td>{{$to->spec}}</td>
                    </tr> 
                    <tr>
                    <td>Medical</td>
                    <td>{{$to->glom}}</td>
                    <td>{{$to->spem}}</td>
                    </tr> 
                    <tr>
                    <td>Hotel</td>
                    <td>{{$to->gloh}}</td>
                    <td>{{$to->speh}}</td>
                    </tr>  
                    <tr>
                    <td>Visa</td>
                    <td>{{$to->glov}}</td>
                    <td>{{$to->spev}}</td>
                    </tr>  
                    <tr>
                    <td>Genersl</td>
                    <td>{{$to->glog}}</td>
                    <td>{{$to->speg}}</td>
                    </tr> 
                                     
                    @endforeach 
                     <!--thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead-->                 
                    </tbody>
                  </table>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <div class="col-md-3 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Last Week Sales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th>type</th>                     
                    <th>total</th>                     
                    <th>my sales</th>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($week as $we)
                    <tr>
                    <td>Ticket</td>
                    <td>{{$we->glot}}</td>
                    <td>{{$we->spet}}</td>
                    </tr> 
                    <tr>
                    <td>Bus</td>
                    <td>{{$we->glob}}</td>
                    <td>{{$we->speb}}</td>
                    </tr> 
                    <tr>
                    <td>Car</td>
                    <td>{{$we->gloc}}</td>
                    <td>{{$we->spec}}</td>
                    </tr> 
                    <tr>
                    <td>Medical</td>
                    <td>{{$we->glom}}</td>
                    <td>{{$we->spem}}</td>
                    </tr> 
                    <tr>
                    <td>Hotel</td>
                    <td>{{$we->gloh}}</td>
                    <td>{{$we->speh}}</td>
                    </tr>  
                    <tr>
                    <td>Visa</td>
                    <td>{{$we->glov}}</td>
                    <td>{{$we->spev}}</td>
                    </tr>  
                    <tr>
                    <td>Genersl</td>
                    <td>{{$we->glog}}</td>
                    <td>{{$we->speg}}</td>
                    </tr> 
                                     
                    @endforeach 
                    <!--thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead-->                
                    </tbody>
                  </table>
                </div>

              </div>              </div>
              <!-- /.card-body -->
            </div>
            <div class="col-md-3 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">last Month Sales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th>type</th>                     
                    <th>total</th>                     
                    <th>my sales</th>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($month as $mo)
                    <tr>
                    <td>Ticket</td>
                    <td>{{$mo->glot}}</td>
                    <td>{{$mo->spet}}</td>
                    </tr> 
                    <tr>
                    <td>Bus</td>
                    <td>{{$mo->glob}}</td>
                    <td>{{$mo->speb}}</td>
                    </tr> 
                    <tr>
                    <td>Car</td>
                    <td>{{$mo->gloc}}</td>
                    <td>{{$mo->spec}}</td>
                    </tr> 
                    <tr>
                    <td>Medical</td>
                    <td>{{$mo->glom}}</td>
                    <td>{{$mo->spem}}</td>
                    </tr> 
                    <tr>
                    <td>Hotel</td>
                    <td>{{$mo->gloh}}</td>
                    <td>{{$mo->speh}}</td>
                    </tr>  
                    <tr>
                    <td>Visa</td>
                    <td>{{$mo->glov}}</td>
                    <td>{{$mo->spev}}</td>
                    </tr>  
                    <tr>
                    <td>Genersl</td>
                    <td>{{$mo->glog}}</td>
                    <td>{{$mo->speg}}</td>
                    </tr> 
                                     
                    @endforeach 
                     <!--thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead-->                  
                    </tbody>
                  </table>
                </div>

              </div>              </div>
              <!-- /.card-body -->
            </div>
            <div class="col-md-3 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">All Sales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th>type</th>                     
                    <th>total</th>                     
                    <th>my sales</th>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all as $a)
                    <tr>
                    <td>Ticket</td>
                    <td>{{$a->glot}}</td>
                    <td>{{$a->spet}}</td>
                    </tr> 
                    <tr>
                    <td>Bus</td>
                    <td>{{$a->glob}}</td>
                    <td>{{$a->speb}}</td>
                    </tr> 
                    <tr>
                    <td>Car</td>
                    <td>{{$a->gloc}}</td>
                    <td>{{$a->spec}}</td>
                    </tr> 
                    <tr>
                    <td>Medical</td>
                    <td>{{$a->glom}}</td>
                    <td>{{$a->spem}}</td>
                    </tr> 
                    <tr>
                    <td>Hotel</td>
                    <td>{{$a->gloh}}</td>
                    <td>{{$a->speh}}</td>
                    </tr>  
                    <tr>
                    <td>Visa</td>
                    <td>{{$a->glov}}</td>
                    <td>{{$a->spev}}</td>
                    </tr>  
                    <tr>
                    <td>Genersl</td>
                    <td>{{$a->glog}}</td>
                    <td>{{$a->speg}}</td>
                    </tr> 
                                     
                    @endforeach 
                    <!--thead>
                    <tr>
                    <th>Total</th>                     
                    <th>sum</th>                     
                    <th>sum</th>                     
                    </tr>
                    </thead-->                 
                    </tbody>
                  </table>
                </div>

              </div>               </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="col-md-12 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"> Sales By Currancy</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="table-responsive table-bordered">
                  <table class="table m-0 text-center">
                    <thead>
                    <tr>
                    <th colspan="1"></th>                     
                    <th colspan="4">USD</th>                     
                    <th colspan="4"> YER</th>                     
                    <th colspan="4"> SAR</th>                     
                    </tr>
                    <tr>
                    <th colspan="1">type</th>                     
                    <td colspan="">All</td>  
                    <td colspan=""> COST</td>                                       
                    <td colspan="">mySale</td>                    
                    <td colspan=""> COST</td>                     
                    <td colspan=""> All</td>
                    <td colspan=""> COST</td>                     
                    <td colspan=""> mySale</td>
                    <td colspan="">COST</td>                     
                    <td colspan=""> All</td> 
                    <td colspan=""> COST</td>                                         
                    <td colspan=""> mySale</td>                     
                    <td colspan=""> COST</td>                     
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($service_cur as $sc)
                    <tr>
                    <th>Ticket</th>
                    <td class=us>{{$sc->tt}}</td>
                    <td class=uc>{{$sc->ttc}}</td>
                    <td class=uus>{{$sc->tu}}</td>
                    <td class=uuc>{{$sc->tuc}}</td>
                    <td class=ys>{{$sc->tt2}}</td>
                    <td>{{$sc->ttc2}}</td>
                    <td>{{$sc->tu2}}</td>
                    <td>{{$sc->tuc2}}</td>
                    <td class=ys>{{$sc->tt3}}</td>
                    <td>{{$sc->ttc3}}</td>
                    <td>{{$sc->tu3}}</td>
                    <td>{{$sc->tuc3}}</td>
                    </tr> 
                    <tr>
                    <th>Bus</th>
                    <td class=us>{{$sc->bt}}</td>
                    <td class=uc>{{$sc->btc}}</td>
                    <td class=uus>{{$sc->bu}}</td>
                    <td class=uuc>{{$sc->buc}}</td>
                    <td class=us>{{$sc->bt2}}</td>
                    <td>{{$sc->btc2}}</td>
                    <td>{{$sc->bu2}}</td>
                    <td>{{$sc->buc2}}</td>
                    <td class=us>{{$sc->bt3}}</td>
                    <td>{{$sc->btc3}}</td>
                    <td>{{$sc->bu3}}</td>
                    <td>{{$sc->buc3}}</td>
                    </tr> 
                    <tr>
                    <th>Car</th>
                    <td class=us>{{$sc->ct}}</td>
                    <td class=uc>{{$sc->ctc}}</td>
                    <td class=uus>{{$sc->cu}}</td>
                    <td class=uuc>{{$sc->cuc}}</td>
                    <td class=us>{{$sc->ct2}}</td>
                    <td>{{$sc->ctc2}}</td>
                    <td>{{$sc->cu2}}</td>
                    <td>{{$sc->cuc2}}</td>
                    <td class=us>{{$sc->ct3}}</td>
                    <td>{{$sc->ctc3}}</td>
                    <td>{{$sc->cu3}}</td>
                    <td>{{$sc->cuc3}}</td>
                    </tr> 
                    <tr>
                    <th>Medical</th>
                    <td class=us>{{$sc->mt}}</td>
                    <td class=uc>{{$sc->mtc}}</td>
                    <td class=uus>{{$sc->mu}}</td>
                    <td class=uuc>{{$sc->muc}}</td>
                    <td class=us>{{$sc->mt2}}</td>
                    <td>{{$sc->mtc2}}</td>
                    <td>{{$sc->mu2}}</td>
                    <td>{{$sc->muc2}}</td>
                    <td class=us>{{$sc->mt3}}</td>
                    <td>{{$sc->mtc3}}</td>
                    <td>{{$sc->mu3}}</td>
                    <td>{{$sc->muc3}}</td>
                    </tr> 
                    <tr>
                    <th>Hotel</th>
                    <td class="ses_us">{{$sc->ht}}</td>
                    <td class=uc>{{$sc->htc}}</td>
                    <td class=uus>{{$sc->hu}}</td>
                    <td class=uuc>{{$sc->huc}}</td>
                    <td class=us>{{$sc->ht2}}</td>
                    <td>{{$sc->htc2}}</td>
                    <td>{{$sc->hu2}}</td>
                    <td>{{$sc->huc2}}</td>
                    <td class=us>{{$sc->ht3}}</td>
                    <td>{{$sc->htc3}}</td>
                    <td>{{$sc->hu3}}</td>
                    <td>{{$sc->huc3}}</td>
                    </tr> 
                    <tr>
                    <th>Visa</th>
                    <td class="ses_us">{{$sc->vt}}</td>
                    <td class=uc>{{$sc->vtc}}</td>
                    <td class=uus>{{$sc->vu}}</td>
                    <td class=uuc>{{$sc->vuc}}</td>
                    <td class=us>{{$sc->vt2}}</td>
                    <td>{{$sc->vtc2}}</td>
                    <td>{{$sc->vu2}}</td>
                    <td>{{$sc->vuc2}}</td>
                    <td class=us>{{$sc->vt3}}</td>
                    <td>{{$sc->vtc3}}</td>
                    <td>{{$sc->vu3}}</td>
                    <td>{{$sc->vuc3}}</td>
                    </tr>
                    <tr>
                    <th>General</th>
                    <td class="ses_us">{{$sc->gt}}</td>
                    <td class=uc>{{$sc->gtc}}</td>
                    <td class=uus>{{$sc->gu}}</td>
                    <td class=uuc>{{$sc->guc}}</td>
                    <td class=ys>{{$sc->gt2}}</td>
                    <td class=yc>{{$sc->gtc2}}</td>
                    <td>{{$sc->gu2}}</td>
                    <td class=sc>{{$sc->guc2}}</td>
                    <td class=ss>{{$sc->gt3}}</td>
                    <td>{{$sc->gtc3}}</td>
                    <td>{{$sc->gu3}}</td>
                    <td>{{$sc->guc3}}</td>
                    </tr>
                    @endforeach 
                    <!--thead>
                    <tr>
                    <th>Total</th>                     
                    <th id="uts">sum</th>                     
                    <th id=utsc>sum</th>                      
                    <th id=utu>sum</th>                     
                    <th id=utuc>sum</th>  
                    <th id=yts>sum</th>                     
                    <th id=ytsc>sum</th>                      
                    <th id=ytu>sum</th>                     
                    <th id=ytuc>sum</th>
                    <th id=sts>sum</th>                     
                    <th id=stsc>sum</th>                      
                    <th id=stu>sum</th>                     
                    <th id=stuc>sum</th>                    
                    </tr>
                    </thead-->                 
                    </tbody>
                  </table>
                </div>

              </div>               </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            </div>
            <!-- PIE CHART -->
         

            </div>
          <!-- /.col (LEFT) -->
          </div>
          </div>
          <!-- /.col (LEFT) -->
          </div>
     

<script>

          function chang_stat(){
            $('#ses_first_type').removeClass('disabled');
           // alert('ll');
          }
          function chang_stat2(){
            $('#ses_first_type2').removeClass('disabled');
           // alert('ll');
          }
          function open(){
             //alert('ll');
          }
          function su_report_1(){
            $('#su_report_1').css('display','-webkit-box');
            $('#su_report_2').css('display','none');
          }
          function su_report_2(){
            $('#su_report_1').css('display','none');
            $('#su_report_2').css('display','-webkit-box');  
                    }
          function filter_item(col,op){
                  var val=$('#'+col).val();
              //   alert(val);
                 if(col=="ses_status"){
              val='('+$('#'+col).val()+')';
                    }
                     $.ajax({
                          url:'/accountant/report_item/1/'+col+'/'+op+'/'+val,
                                    type:'get',
                          success:function(response){
                        //    alert('ooooooooookkkkkkkk');
                    }
                 });
               }  
               function filter_item2(col,op){
                  var val=$('#'+col+'2').val();
              alert(val);
                 if(col=="ses_status"){
              val='('+$('#'+col+2).val()+')';
              alert(val);
                    }
                    if(col=="issue_date" && val !=""){
                      $('#ISU_DATE').removeAttr('readonly');
                    }
                  
                     $.ajax({
                          url:'/accountant/report_item/2/'+col+'/'+op+'/'+val,
                                    type:'get',
                          success:function(response){
                    }
                 });
               }  
               function filter_item3(){
                  var val=$('#ISU_DATE').val();
               //  alert(val);
                 $.ajax({
                          url:'/accountant/report_item/2/ / /'+val,
                                    type:'get',
                          success:function(response){
                            $('#filter_m_ser2').removeAttr('disabled');
                            $('#ses_cur_id2').removeAttr('disabled');
                            $('#user_id2').removeAttr('disabled');
                            $('#ses_status2').removeAttr('disabled');
                             $('#due_to_supp2').removeAttr('disabled');
                         // alert('ooooooooookkkkkkkk');
                    }
                 });
               }  

function get_filter(){
var m=$('#filter_m_ser').val();
    $.ajax({
     url:'/accountant/repo_do/1/'+m,
       type:'get',
       dataType:'json',
  success:function(response){
  if(response.length==0){
    $('#filter_data_come_here').html('<tr><td class=text-center colspan="15">There is No data in table...<td></tr>');
  }else{
   // alert("found thing");
   $('#in_success_or_not').text('filter done successfuly');
    $('#filter_data_come_here').html('');
var user_f={{Auth::user()->id}};
var type_f="";
var status_f="";
var count_f=1;
var tr_f="";

              $.map(response ,function(k,v){
                 // console.log(k.st_id);
                  for(var i in k){
                 //   console.log(k[i].st_id);
                  }
                  if(k.s_st==1){
                    status_f='<span class="badge badge-success">ok</span>';
                  }if(k.s_st==2){
                    status_f=' <span class="badge badge-info">issue</span>';
                  }if(k.s_st==3){
                    status_f='<span class="badge badge-danger">void</span>';
                  }if(k.s_st==4){
                    status_f='<span class="badge badge-primary">refund</span>';
                  }

                  if(k.st_id==1){
                      type="Ticket";
                  }if(k.st_id==2){
                      type="Bus";
                  }if(k.st_id==3){
                      type="Car";
                  }if(k.st_id==4){
                      type="Medical";
                  }if(k.st_id==5){
                      type="Hotel";
                  }if(k.st_id==6){
                      type="Visa";
                  }if(k.st_id==7){
                      type="General";
                  }
  tr_f='<tr>';

        var content_of_f=tr_f+'<td>'+count_f+'</td>';
        content_of_f+='<td>'+type+'</td>';
        content_of_f+='<td>'+k.s_num+'</td>';
        content_of_f+='<td>'+k.h_a_b+'</td>';
        content_of_f+='<td>'+k.t_ref+'</td>';
        content_of_f+='<td>'+k.t_idate+'</td>';
        content_of_f+='<td>'+k.u_name+'</td>';
        content_of_f+='<td>'+k.t_pn+'</td>';
        content_of_f+='<td>'+k.s_name+'</td>';
        content_of_f+='<td>'+k.tp_c+'</td>';
        content_of_f+='<td>'+k.cur_n+'</td>';
        content_of_f+='<td>'+k.cost+'</td>';
        content_of_f+='<td>'+status_f+'</td>';
        content_of_f+='</tr>';
                  $('#filter_data_come_here').append(content_of_f);
                  ++count_f;
               });

  }
  } 
    });
  
  }

  function get_filter2(){
var m=$('#filter_m_ser2').val();
    $.ajax({
     url:'/accountant/repo_do/2/'+m,
       type:'get',
       dataType:'json',
  success:function(response){
 // $(".ses_repo_filter").reset();

  if(response.length==0){
    $('#filter_data_come_here').html('<tr><td class=text-center colspan="15">There is No data in table...<td></tr>');
  }else{
   // alert("found thing");
   $('#in_success_or_not').text('filter done successfuly');
    $('#filter_data_come_here').html('');
var user_f={{Auth::user()->id}};
var type_f="";
var status_f="";
var count_f=1;
var tr_f="";

              $.map(response ,function(k,v){
                 // console.log(k.st_id);
                  for(var i in k){
                 //   console.log(k[i].st_id);
                  }
                  if(k.s_st==1){
                    status_f='<span class="badge badge-success">ok</span>';
                  }if(k.s_st==2){
                    status_f=' <span class="badge badge-info">issue</span>';
                  }if(k.s_st==3){
                    status_f='<span class="badge badge-danger">void</span>';
                  }if(k.s_st==4){
                    status_f='<span class="badge badge-primary">refund</span>';
                  }

                  if(k.st_id==1){
                      type="Ticket";
                  }if(k.st_id==2){
                      type="Bus";
                  }if(k.st_id==3){
                      type="Car";
                  }if(k.st_id==4){
                      type="Medical";
                  }if(k.st_id==5){
                      type="Hotel";
                  }if(k.st_id==6){
                      type="Visa";
                  }if(k.st_id==7){
                      type="General";
                  }
  tr_f='<tr>';

        var content_of_f=tr_f+'<td>'+count_f+'</td>';
        content_of_f+='<td>'+type+'</td>';
        content_of_f+='<td>'+k.s_num+'</td>';
        content_of_f+='<td>'+k.h_a_b+'</td>';
        content_of_f+='<td>'+k.t_ref+'</td>';
        content_of_f+='<td>'+k.t_idate+'</td>';
        content_of_f+='<td>'+k.u_name+'</td>';
        content_of_f+='<td>'+k.t_pn+'</td>';
        content_of_f+='<td>'+k.s_name+'</td>';
        content_of_f+='<td>'+k.tp_c+'</td>';
        content_of_f+='<td>'+k.cur_n+'</td>';
        content_of_f+='<td>'+k.cost+'</td>';
        content_of_f+='<td>'+status_f+'</td>';
        content_of_f+='</tr>';
                  $('#filter_data_come_here').append(content_of_f);
                  ++count_f;
               });

  }
  } 
    });
  
  }

                       
function getTotalservic(){
  var ustotal = 0;
  var usctotal = 0;
  var uusstotal = 0;
  var uuscstotal = 0;
  
    $('.uc').each(function(){
      usctotal += parseInt(this.innerHTML)
    });
    $('.uus').each(function(){
      uusstotal += parseInt(this.innerHTML)
    });
    $('.uutc').each(function(){
      uuscstotal += parseInt(this.innerHTML)
    });
    //alert(ustotal);
   
    $('#utsc').text(usctotal);
    $('#utu').text(uusstotal);
    $('#utuc').text(uuscstotal);
}
function getTotalservic1(){
  var ustotal = 0;
$('.ses_us').each(function(){
  //alert(ustotal);

  ustotal += parseInt(this.innerHTML)
});
$('#uts').text(ustotal);
}
    </script>       
@endsection