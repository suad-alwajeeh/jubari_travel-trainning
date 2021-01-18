@extends('app_layouts.master')

@section('main_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet'
    href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
<link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'>
<link rel="stylesheet" href="./style.css">
<div class="col-12">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item"><a href="/salesCarLog">Car Services</a></li>
              <li class="breadcrumb-item active"> /Update Car Services</li>
            </ol>
  </div>
  </br>
  </br>
<div class="content-wrapper">
    <div class="container p-4">


        <!-- /.card-header -->
        <!-- form start -->
        <div class="card card-outline card-info">
            <div class="card-header">
                <h2 class="card-title">
                    Update Car Services
                </h2>
            </div>
            <div class="card-body">

            <form method="POST" action="/service/updateCar2" enctype="multipart/form-data" id="signup-form">
          @csrf

          <div class="around">
            @foreach($data as $bus)

            <?php
                       // print_r($data);
                       // $bus->bus_id;
 $m= (explode("|",$bus->remark_body));
 $mv=[];
 foreach($m as $mm)
 {
   $ss= explode(",",$mm);
   array_push($mv,$ss); 
    
 } 
?>

            <?php
                         $issue_date=false;
                       $refernce=false;
                       $passenger_name=false;
                       $car_status=false;
                       $car_info=false;
                       $voucher_number=false;
                       $Dep_city=false;
                       $arr_city=false;
                       $dep_date=false;
                       $due_to_supp=false;
                       $provider_cost=false;
                       $provider_cost=false;
                       $cur_id=false;
                       $due_to_customer=false;
                       $passnger_currency=false;
                       $cost=false;
                          $x=0;      

                            for( $i=0;$i<sizeof($mv);$i++){
                        if ($mv[$i][$x]==='Issue_date') {
                         $issue_date=true;
                         break;
                        }
                        else{
                          $issue_date=false;
                        }
                      }
                      for( $i=0;$i<sizeof($mv);$i++){

                      if ($mv[$i][$x]==='refernce') {
                        $refernce=true;
                        break;
                       }
                       else{
                        $refernce=false;
                      }
                      }
                      for( $i=0;$i<sizeof($mv);$i++){

                     if ($mv[$i][$x]==='passenger_name') {
                      $passenger_name=true;
                      break;
                     }
                     else{
                      $passenger_name=false;
                    }
                      }
                      for( $i=0;$i<sizeof($mv);$i++){

                   if ($mv[$i][$x]==='car_status') {
                    $car_status=true;
                    break;
                   }
                   else{
                    $car_status=false;
                  }
                      }
                      for( $i=0;$i<sizeof($mv);$i++){

                 if ($mv[$i][$x]==='bus_name') {
                  $bus_name=true;
                  break;
                 }
                 else{
                  $bus_name=false;
                }}
                for( $i=0;$i<sizeof($mv);$i++){

              if ($mv[$i][$x]==='voucher_number') {
                $voucher_number=true;
                break;
               }
               else{
                $voucher_number=false;
              }}

              for( $i=0;$i<sizeof($mv);$i++){
              
              if ($mv[$i][$x]==='car_info') {
                $car_info=true;
                break;
               }
               else{
                $car_info=false;
              }}
              for( $i=0;$i<sizeof($mv);$i++){
             
             if ($mv[$i][$x]==='Dep_city') {
              $Dep_city=true;
              break;
             }}
             for( $i=0;$i<sizeof($mv);$i++){
          
           if ($mv[$i][$x]==='arr_city') {
            $arr_city=true;
            break;
           }}
           for( $i=0;$i<sizeof($mv);$i++){
        
         if ($mv[$i][$x]==='dep_date') {
          $dep_date=true;
          break;
         }}
         for( $i=0;$i<sizeof($mv);$i++){
      
       if ($mv[$i][$x]==='due_to_supp') {
        $due_to_supp=true;
        break;
       }}
    
       for( $i=0;$i<sizeof($mv);$i++){
    
     if ($mv[$i][$x]==='provider_cost') {
      $provider_cost=true;
      break;
     }}
     for( $i=0;$i<sizeof($mv);$i++){

     if ($mv[$i][$x]==='cur_id') {
      $cur_id=true;
      break;
     }}
     for( $i=0;$i<sizeof($mv);$i++){

     if ($mv[$i][$x]==='user_id') {
      $due_to_customer=true;
      break;
     }}
     for( $i=0;$i<sizeof($mv);$i++){

     if ($mv[$i][$x]==='cost') {
      $cost=true;
      break;
     }}
     for( $i=0;$i<sizeof($mv);$i++){

     if ($mv[$i][$x]==='passnger_currency') {
      $passnger_currency=true;
      break;
     }
         }
                      if($issue_date)
                     { echo'  <div class="form-row col-md-12 col-sm-12 col-xm-12">
                      <div class="form-group col-md-6 col-sm-12 col-xm-12">
                          <label class="col-md-12 col-sm-12 col-xm-12">Issued Date: </label>
                          <div class="form-group ">
                             ';
                            ?>
            <input type="hidden" value="{{$bus->car_id}}" name="id">
            <input required type="date" class="form-control " name="Issue_date"
              value="{{\Carbon\Carbon::createFromDate($bus->Issue_date)->format('Y-m-d')}}" />
            <?php  echo' </div>
                      </div>';
        }
                      else
                      { echo'  <div class="form-row col-md-12 col-sm-12 col-xm-12">
                        <div class="form-group col-md-6 col-sm-12 col-xm-12">
                            <label class="col-md-12 col-sm-12 col-xm-12">Issued Date: </label>
                            <div class="form-group ">';
                              ?>
            <input type="hidden" value="{{$bus->car_id}}" name="id">
            <input required type="date" class="form-control " disabled
              value="{{ \Carbon\Carbon::createFromDate($bus->Issue_date)->format('Y-m-d')}}" />

            <input required type="hidden" class="form-control " name="Issue_date" value="{{$bus->Issue_date}}" />

            <?php  echo' </div>
                        </div>';
          }                       
                    
                      if ($refernce) {
                        echo'  <div class="form-group col-md-6 col-sm-12 col-xm-12">
                        <label class="col-md-12 col-xm-12">Reference </label>
                        <div class="form-group">';
?>
            <input required type="text" class="form-control" value="{{$bus->refernce}}" name="refernce">
            <?php echo ' </div>
                    </div>
                </div>';
                       }
                     else
                     {
                       echo '  <div class="form-group col-md-6 col-sm-12 col-xm-12">
                       <label class="col-md-12 col-xm-12">Reference </label>
                       <div class="form-group">';
?>
            <input required type="text" disabled class="form-control" value="{{$bus->refernce}}">
            <input required type="hidden" class="form-control" value="{{$bus->refernce}}" name="refernce">

            <?php echo '  </div>
                   </div>
               </div>';
 
                     } 

                     if ($passenger_name) {
                        echo '  <div class="form-row col-md-12 col-sm-12 col-xm-12">
                        <div class="form-group col-md-6 col-sm-12 col-xm-12">
                            <label class="col-12">Passenger Name : </label>
                            <div class="form-group col-md-12 col-sm-12 col-xm-12">
  ';?>
  
              <input required type="text" class="form-control select2 select2-hidden-accessible" name="passenger_name"
                value="{{$bus->passenger_name}}" class="form-control select2 select2-hidden-accessible"
                style="width: 100%;" />
              <?php echo ' </div>
                    </div>';
                       }
                     else
                     {
                       echo '  <div class="form-row col-md-12 col-sm-12 col-xm-12">
                       <div class="form-group col-md-6 col-sm-12 col-xm-12">
                           <label class="col-12">Passenger Name : </label>
                           <div class="form-group col-md-12 col-sm-12 col-xm-12">
  ';
  ?>
              <input required disabled type="text" class="form-control select2 select2-hidden-accessible"
                value="{{$bus->passenger_name}}" class="form-control select2 select2-hidden-accessible"
                style="width: 100%;" />
              <input required type="hidden" name="passenger_name" value="{{$bus->passenger_name}}" />
  
  
              <?php echo '   </div>
                   </div>';
  
                     } 
                   
                    
                   if ($voucher_number) {
                    echo ' <div class="form-group col-md-3 col-sm-12 col-xm-12">
                    <label class="col-md-12 col-sm-12 col-xm-12">Voucher Number :</label>
                    <div class="form-group">
  ';
                      ?>
                      <input required type="number" class="form-control " style="width:100%;"
                                          name="voucher_number" value="{{$bus->voucher_number}}" id="number" />
                                     
              <?php echo ' <small id="helpId2" class="text-muted "></small>
                        <a id="generate" class="btn btn-outline-primary so_form_btn"> Generate</a>
  
                    </div>
                </div>';
                   }
                 else
                 {
                   echo ' <div class="form-group col-md-3 col-sm-12 col-xm-12">
                   <label class="col-md-12 col-sm-12 col-xm-12">Voucher Number :</label>
                   <div class="form-group">
  ';
  ?>
                <input required disabled  type="number" class="form-control " style="width:100%;"
                                         value="{{$car->voucher_number}}" id="number" />
                                     
              <input required type="hidden" class="form-control " style="width:100%;"   name="voucher_number"
                value="{{$bus->voucher_number}}" id="number" />
              <?php echo ' <small id="helpId2" class="text-muted "></small>
                       <a id="generate" class="btn btn-outline-primary so_form_btn"> Generate</a>
  
                   </div>
               </div>';
                 } 
                
                  
                 if ($car_status) {
                     echo'     <div class="form-group col-md-3 col-sm-12 col-xm-12">
                     <label class="col-md-12 col-sm-12 col-xm-12">Car Status :</label>
  
  
                     <div class="form-group" data-select2-id="44">
                         <select class="form-control select2 select2-hidden-accessible" name="car_status"
                             id="code" style="width: 100%;" data-select2-id="1" tabindex="0"
                             aria-hidden="true">';
                             if( $bus->car_status==1)
                             echo '  <option value="1" selected>OK</option>
                             <option value="2">Issue</option>
                             <option value="3">Void</option>
                             <option value="4">Refund</option>';
                             elseif ( $bus->car_status==2)
                             echo '  <option value="1" >OK</option>
                             <option value="2" selected>Issue</option>
                             <option value="3">Void</option>
                             <option value="4">Refund</option>';
                             elseif ( $bus->car_status==3)
                             echo '  <option value="1" >OK</option>
                             <option value="2">Issue</option>
                             <option value="3" selected>Void</option>
                             <option value="4">Refund</option>';
                             else
                             echo '<option value="1" >OK</option>
                             <option value="2">Issue</option>
                             <option value="3">Void</option>
                             <option value="4" selected>Refund</option>';
                
  echo' </select>
  </div>
  </div>
  </div>
  ';
                }
              else
              {
                  echo'      <div class="form-group col-md-3 col-sm-12 col-xm-12">
                  <label class="col-md-12 col-sm-12 col-xm-12">Car Status :</label>
  
  
                  <div class="form-group" data-select2-id="44">
                      <select class="form-control select2 select2-hidden-accessible"
                          id="code" style="width: 100%;" data-select2-id="1" tabindex="0"
                          aria-hidden="true">
  
  ';
  if( $bus->car_status==1)
  echo'<option value="2" selected disabled>OK</option>
  <input type="hidden"  name="car_status" value="1">';
  elseif ( $bus->car_status==2)
  echo '<option value="2" selected disbled>Issue</option>
  <input type="hidden" name="car_status" value="2">  ';
  elseif ( $bus->car_status==3)
  echo'<option value="3" disabled  selected>Void</option> 
  <input type="hidden" name="car_status" value="3">';
  else
  echo '  <option value="4"  disabled selected>Refund</option>
  <input type="hidden" name="car_status" value="4">
  ';
            
               echo' </select>
               </div>
           </div>
       </div>
  ';
              } 
  
                
  
                 if ($Dep_city) {
                  echo '  <div class="form-row col-md-12 col-sm-12 col-xm-12">
  
                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                      <label class="col-md-12 col-sm-12 col-xm-12">Dep City </label>
                      <div class="form-group" data-select2-id="44">';
  ?>
              <input required name="Dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum" type="text"
                value="{{$bus->Dep_city}}" class="form-control " list="cars" />
              <?php echo'   </div>
                  </div>';
                 }
               else
               {
                  echo '  <div class="form-row col-md-12 col-sm-12 col-xm-12">
  
                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                      <label class="col-md-12 col-sm-12 col-xm-12">Dep City </label>
                      <div class="form-group" data-select2-id="44">';
  ?>
              <input required disabled style="width:100%" onkeyup="addHyphen(this)" id="tbNum" type="text"
                value="{{$bus->Dep_city}}" class="form-control " list="cars" />
              <input required name="Dep_city1" style="width:100%" onkeyup="addHyphen(this)" id="tbNum" type="hidden"
                value="{{$bus->Dep_city}}" class="form-control " list="cars" />
              <?php echo'   </div>
                  </div>';
                 }
  
                 if ($dep_date) {
                  echo ' 
                      <div class="form-group col-md-4 col-sm-12 col-xm-12">
                          <label class="col-md-12 col-sm-12 col-xm-12">Dep Date </label>
                          <div class="form-group" data-select2-id="44">';
      ?>
              <input required name="dep_date" style="width:100%" onkeyup="addHyphen(this)" id="tbNum" type="text"
                value="{{ \Carbon\Carbon::createFromDate($bus->Dep_date)->format('Y-m-d')}}" class=" form-control " />
              <?php echo'   </div>
                      </div>';
                     }
               else
               {
                  echo '  
      
                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                      <label class="col-md-12 col-sm-12 col-xm-12">Dep Date </label>
                      <div class="form-group" data-select2-id="44">';
      ?>
              <input required disabled style="width:100%" onkeyup="addHyphen(this)" id="tbNum" type="text"
                value="{{ \Carbon\Carbon::createFromDate($bus->Dep_date)->format('Y-m-d')}}" class=" form-control " />
              <input required name="dep_date" style="width:100%" onkeyup="addHyphen(this)" id="tbNum" type="hidden"
                value="{{ \Carbon\Carbon::createFromDate($bus->Dep_date)->format('Y-m-d')}}" class=" form-control " />
              <?php echo'   </div>
                  </div>';
                 }
  
               if ($arr_city) {
                  echo '  
                  <div class="form-group col-md-4 col-sm-12 col-xm-12">
                      <label class="col-md-12 col-sm-12 col-xm-12">Arr City </label>
                      <div class="form-group" data-select2-id="44">';
  ?>
              <input required name="arr_city" onkeyup="addHyphen(this)" id="tbNum2" class="form-control "
                value="{{$bus->arr_city}}" list="cars" />
              <?php echo'   </div>
                  </div> </div>';
                 }
             else
             {
              echo '  
  
              <div class="form-group col-md-4 col-sm-12 col-xm-12">
                  <label class="col-md-12 col-sm-12 col-xm-12">Arr City </label>
                  <div class="form-group" data-select2-id="44">';
  ?>
              <input required disabled onkeyup="addHyphen(this)" id="tbNum2" class="form-control "
                value="{{$bus->arr_city}}" list="cars" />
  
              <input required name="arr_city" type="hidden" onkeyup="addHyphen(this)" id="tbNum2" class="form-control "
                value="{{$bus->arr_city}}" list="cars" />
              <?php echo'   </div>
              </div> </div></div>';
             }
             if($car_info)
             {
                 echo' <div class="form-group col-md-12 col-sm-12 col-xm-12">
                 <label>Additional Info </label>
                 <div class="form-group">';
                 ?>

                     <input type="text" class="form-control " value="{{$bus->car_info}}" required name="car_info" />
               <?php echo'  </div>
             </div>
         </div>
     </div>';
             }
             else{
                echo' <div class="form-group col-md-12 col-sm-12 col-xm-12">
                <label>Additional Info </label>
                <div class="form-group">';
                ?>

                    <input type="text" class="form-control " disabled value="{{$bus->car_info}}"required  />
                    <input type="hidden" class="form-control " name="car_info"  value="{{$bus->car_info}}"required  />
              <?php echo'  </div>
            </div>
        </div>
    </div>';
             }
            
           if ($due_to_supp) {
            echo '
            <div class="around col-md-12 col-sm-12 col-xm-12 m-3">
                <div class="col-md-5 col-sm-12 col-xm-12 d-inline-block">
                    <h2 class="form-title">Provider Info </h2>
                    <div class="form-group col-md-12 col-sm-12 col-xm-12">
                        <label class="col-md-12 col-sm-12 col-xm-12">Provider Name </label>
  
  
                        <div class="form-group" data-select2-id="44">
                            <select name="due_to_supp" required
                                class="form-control select2 select2-hidden-accessible provider"
                                style="width: 100%;" data-select2-id="6" tabindex="0" aria-hidden="true">
                              ';?>
              <option value="{{$bus->s_no}}" selected>{{$bus->supplier_name}}</option>
  
              @foreach($suplier as $sup)
  
              <option value="{{$sup->s_no}}">{{$sup->supplier_name}}</option>
  
  
              @endforeach
              <?php
            echo ' </select>
            </div>
        </div>';
           }
         else
         {
           echo '<div class="around col-md-12 col-sm-12 col-xm-12 m-3">
           <div class="col-md-5 col-sm-12 col-xm-12 d-inline-block">
               <h2 class="form-title">Provider Info </h2>
               <div class="form-group col-md-12 col-sm-12 col-xm-12">
                   <label class="col-md-12 col-sm-12 col-xm-12">Provider Name </label>
  
  
                   <div class="form-group" data-select2-id="44">
                       <select  required
                           class="form-control select2 select2-hidden-accessible provider"
                           style="width: 100%;" data-select2-id="6" tabindex="0" aria-hidden="true">
                          ';?>
              <option value="{{$bus->s_no}}" disabled selected>{{$bus->supplier_name}}</option>
              <input type="hidden" name="due_to_supp" value="{{$bus->s_no}}">
  
              <?php echo' </select>
                                      </div>
                                  </div>';
  
         } 
         if ($provider_cost) {
          echo ' <div class="form-group col-md-12 col-sm-12 col-xm-12">
          <label class="col-md-12 col-sm-12 col-xm-12">Cost </label>
          <div class="form-group" data-select2-id="44">';?>
  
              <input type="number" style="width:100%;" required name="provider_cost" class="form-control "
                value="{{ $bus->provider_cost}}" />
              <?php echo' </div>
      </div>';
         }
       else
       {
          echo ' <div class="form-group col-md-12 col-sm-12 col-xm-12">
          <label class="col-md-12 col-sm-12 col-xm-12">Cost </label>
          <div class="form-group" data-select2-id="44">';?>
  
              <input type="number" disabled style="width:100%;" required class="form-control "
                value="{{ $bus->provider_cost}}" />
  
              <input type="hidden" style="width:100%;" required name="provider_cost" class="form-control "
                value="{{ $bus->provider_cost}}" />
              <?php echo' </div>
      </div>';
         }
       if ($cur_id) {
        echo  ' <div class="form-group col-md-12 col-sm-12 col-xm-12">
        <label class="col-md-4 col-sm-12 col-xm-12">Currency </label>
        <div class="form-group">
  
            <select name="cur_id" required
                class="form-control select2 select2-hidden-accessible curency"
                style="width: 100%;" data-select2-id="8" tabindex="0" aria-hidden="true">';?>
              @foreach($cur as $c)
              @if($c->cur_id==$bus->cur_id)
              <option value="{{$bus->cur_id}}" selected> {{$bus->cur_name}}</option>
              @else
              <option value="{{$c->cur_id}}"> {{$c->cur_name}}</option>
              @endif
  
              @endforeach
              <?php echo'  </select>
        </div>
    </div>
  </div>';
       }
     else
     {
      echo  ' <div class="form-group col-md-12 col-sm-12 col-xm-12">
      <label class="col-md-4 col-sm-12 col-xm-12">Currency </label>
      <div class="form-group">
  
          <select  required
              class="form-control select2 select2-hidden-accessible curency"
              style="width: 100%;" data-select2-id="8" tabindex="0" aria-hidden="true">';?>
              <option value="{{$bus->cur_id}}" disabled selected> {{$bus->cur_name}}</option>
              <input type="hidden" name="cur_id" value="{{$bus->cur_id}}">
  
              <?php echo'  </select>
      </div>
  </div>
  </div>';
    
     } 
  
       if ($due_to_customer) {
        
        echo  '  <div class="col-md-5 col-sm-12 col-xm-12 d-inline-block">
        <h2 class="form-title"> Customer Info</h2>
        <div class="form-group col-md-12 col-sm-12 col-xm-12">
            <label class="col-md-12 col-sm-12 col-xm-12">Customer Name </label>
            <div class="form-group" data-select2-id="44">
  
                <select name="due_to_customer"
                    class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                    data-select2-id="9" tabindex="0" aria-hidden="true">';
  ?>
  
              @foreach($emp as $emps)
              @if($bus->due_to_customer==$emps->emp_id)
  
  
              <option selected value="{{$emps->emp_id}}">{{$emps->emp_first_name}}
                {{$emps->emp_middel_name}}
                {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
              @else
              <option value="{{$emps->emp_id}}">{{$emps->emp_first_name}}
                {{$emps->emp_middel_name}}
                {{$emps->emp_thired_name}} {{$emps->emp_last_name}}</option>
              @endif
  
              @endforeach
  
              <?php echo'</select>
  
            </div>
        </div>';
       }
     else
     {
        
      echo  '  <div class="col-md-5 col-sm-12 col-xm-12 d-inline-block">
      <h2 class="form-title"> Customer Info</h2>
      <div class="form-group col-md-12 col-sm-12 col-xm-12">
          <label class="col-md-12 col-sm-12 col-xm-12">Customer Name </label>
          <div class="form-group" data-select2-id="44">
  
              <select 
                  class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                  data-select2-id="9" tabindex="0" aria-hidden="true">';
  ?>
  
              <option selected disabled value="{{$bus->emp_id}}">{{$bus->emp_first_name}}
                {{$bus->emp_middel_name}}
                {{$bus->emp_thired_name}} {{$bus->emp_last_name}}</option>
              <input type="hidden" name="due_to_customer" value="{{$bus->emp_id}}">
  
  
              <?php echo'</select>
  
          </div>
      </div>';
  
     } 
  
   if ($cost) {
    echo '    <div class="form-group col-md-12 col-sm-12 col-xm-12">
    <label class="col-md-12 col-sm-12 col-xm-12">Cost </label>
    <div class="form-group" data-select2-id="44">';?>
  
              <input required type="number" name="cost" style="width: 100%;" class="form-control "
                value="{{ $bus->cost}}" />
              <?php echo '</div>
  </div>';
   }
  else
  {
      echo '    <div class="form-group col-md-12 col-sm-12 col-xm-12">
      <label class="col-md-12 col-sm-12 col-xm-12">Cost </label>
      <div class="form-group" data-select2-id="44">';?>
  
              <input required disabled type="number" style="width: 100%;" class="form-control " value="{{ $bus->cost}}" />
              <input required type="hidden" name="cost" style="width: 100%;" class="form-control "
                value="{{ $bus->cost}}" />
              <?php echo '</div>
    </div>';
  } 
  if ($passnger_currency) {
    echo ' <div class="form-group col-md-12 col-sm-12 col-xm-12">
    <label class="col-md-12 col-sm-12 col-xm-12">Currency </label>
    <div class="form-group" data-select2-id="44">
  
        <select name="passnger_currency" class="form-control " style="width: 100%;"
            data-select2-id="10" tabindex="0" aria-hidden="true">';
  ?>
  
              <option value="{{$bus->passnger_currency}}" selected>
                {{ $bus->passnger_currency}}</option>
              <option value="YER">YER</option>
              <option value="SAR">SAR</option>
              <option value="USD">USD</option>
              <?php echo '
        </select>
    </div>
  </div>
  </div>
  </div>
  ';
   }
  else
  {
   echo ' <div class="form-group col-md-12 col-sm-12 col-xm-12">
   <label class="col-md-12 col-sm-12 col-xm-12">Currency </label>
   <div class="form-group" data-select2-id="44">
  
       <select  class="form-control " style="width: 100%;"
           data-select2-id="10" tabindex="0" aria-hidden="true">';
  ?>
  
              <option value="{{$bus->passnger_currency}}" disabled selected> {{$bus->passnger_currency}}</option>
              <input type="hidden" name="passnger_currency" value="{{$bus->passnger_currency}}">
  
              <?php echo '
       </select>
   </div>
  </div>
  </div>
  </div>
  ';
  }
        ?>
  
  
              @endforeach
            <div class="form-group">
                <a href="{{url('salesCarLog')}}" class="btn btn-outline-danger so_form_btn">Cancel</a>
                <button type="submit" class="btn btn-outline-primary so_form_btn" id="submit">Save Change</button>
            </div>
            </form>

        </div>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
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

    function preventDefaults(e) {
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

        for (let i = numFiles; i > 0; i--) {
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
        reader.onloadend = function () {
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
        xhr.upload.addEventListener("progress", function (e) {
            updateProgress(i, (e.loaded * 100.0 / e.total) || 100)
        })

        xhr.addEventListener('readystatechange', function (e) {
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
        $('#generate').click(function (e) {
            console.log('bggehegw');
            $.ajax({
                url: "{{url('/service/generate_car')}}",
                success: function (data) {
                    console.log('sec');
                    console.log(data);
                    var x = data;
                    x = x++;
                    console.log(x);
                    $('#number').val(x)
                }
            });
        });
        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear() + "-" + (month) + "-" + (day);

        $('#date').val(today);
        $('#date2').val(today);
        $('#date3').val(today);
        $('#date4').val(today);
        $('#date8').val(today);
        console.log($('#date').val(today));
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
                                rm = value[i].supplier_remark;

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