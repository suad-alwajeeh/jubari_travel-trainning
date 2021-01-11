<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Service;
use App\airline;
use App\Suplier;
use App\Employee;
use App\TicketService;
use App\BusService;
use App\CarService;
use App\ServiceService;
use App\VisaService;
use App\HotelService;
use App\MedicalService;
use App\GeneralService;
use App\Events\MyEvent;
use App\Events\Notification;

@session_start();
if(isset($_SESSION['remark'])){
}else{
    $_SESSION['remark']=array();    
}
class accountantController extends Controller
{
    public function accountant_view()
    {  
        //ticket
        $affectedt = DB::select('SELECT COUNT(*) as accountant FROM ticket_services WHERE service_status = 3');
        $affectedt1 = DB::select('SELECT COUNT(*) as finish FROM ticket_services WHERE service_status = 4');

        //hotel
        $affectedh = DB::select('SELECT COUNT(*) as accountant FROM hotel_services WHERE service_status = 3');
        $affectedh1 = DB::select('SELECT COUNT(*) as finish FROM hotel_services WHERE service_status = 4');

         //bus
         $affectedb = DB::select('SELECT COUNT(*) as accountant FROM bus_services WHERE service_status = 3');
         $affectedb1 = DB::select('SELECT COUNT(*) as finish FROM bus_services WHERE service_status = 4');
  
         //car
         $affectedc = DB::select('SELECT COUNT(*) as accountant FROM car_services WHERE service_status = 3');
          $affectedc1 = DB::select('SELECT COUNT(*) as finish FROM car_services WHERE service_status = 4');

           //medical
        $affectedm = DB::select('SELECT COUNT(*) as accountant FROM medical_services WHERE service_status = 3');
        $affectedm1 = DB::select('SELECT COUNT(*) as finish FROM medical_services WHERE service_status = 4');

         //general
         $affectedg = DB::select('SELECT COUNT(*) as accountant FROM general_services WHERE service_status = 3');
         $affectedg1 = DB::select('SELECT COUNT(*) as finish FROM general_services WHERE service_status = 4');
 
         //visa
         $affectedv = DB::select('SELECT COUNT(*) as accountant FROM visa_services WHERE service_status = 3');
         $affectedv1 = DB::select('SELECT COUNT(*) as finish FROM visa_services WHERE service_status = 4');

         return view('accountant_view',['tic1'=>$affectedt,'tic2'=>$affectedt1,
                                         'bus1'=>$affectedb,'bus2'=>$affectedb1,
                                         'car1'=>$affectedc,'car2'=>$affectedc1,
                                         'hot1'=>$affectedh,'hot2'=>$affectedh1,
                                         'med1'=>$affectedm,'med2'=>$affectedm1,
                                         'gen1'=>$affectedg,'gen2'=>$affectedg1,
                                         'vis1'=>$affectedv,'vis2'=>$affectedv1,
                                         ]);

    }
    public function accountant_review($id)
    { 
        if($id=='ticket'){
 //ticket
 $affected =TicketService::where('service_status',3)
 ->join('currency','ticket_services.cur_id','currency.cur_id')
 ->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
 ->join('users','ticket_services.user_id','users.id')
 ->join('airlines','ticket_services.airline_id','airlines.id')
 ->select ('ticket_services.tecket_id as t_id' ,
 'ticket_services.ticket_number as s_num' ,
 'ticket_services.service_id as st_id' ,
 'airlines.airline_name as airline_name' ,
 'ticket_services.user_id as uuser_resiver' ,
 'ticket_services.passenger_name as t_pn',
 'ticket_services.refernce as t_ref',
 'ticket_services.provider_cost as t_pc' ,
 'suppliers.supplier_name as s_name',
 'users.name as u_name',
 'currency.cur_name as cur_n',
 'ticket_services.bookmark as bookmark',
 'ticket_services.how_add_bookmark as bookmark_how',
 'ticket_services.cost as cost',
 'ticket_services.Issue_date as t_idate') 
 ->paginate(10);
 $affected1=['id'=>'ticket'];
    }elseif($id=='bus'){
        //bus
        $affected1=['id'=>'bus'];
        $affected =BusService::where('service_status',3)
        ->join('currency','bus_services.cur_id','currency.cur_id')
        ->join('suppliers','bus_services.due_to_supp','suppliers.s_no')
        ->join('users','bus_services.user_id','users.id')
        ->select ('bus_services.bus_id as t_id' ,
        'bus_services.passenger_name as t_pn',
         'bus_services.service_id as st_id' ,
        'bus_services.refernce as t_ref',
        'bus_services.provider_cost as t_pc' ,
        'suppliers.supplier_name as s_name',
        'users.name as u_name',
        'bus_services.bus_number as s_num' ,
        'currency.cur_name as cur_n',
        'bus_services.cost as cost',
        'bus_services.bookmark as bookmark',
        'bus_services.how_add_bookmark as bookmark_how',
        'bus_services.user_id as uuser_resiver' ,
        'bus_services.Issue_date as t_idate') 
        ->paginate(10);
        
           }elseif($id=='car'){
    //car
    $affected1=['id'=>'car'];
    $affected =CarService::where('service_status',3)
    ->join('currency','car_services.cur_id','currency.cur_id')
    ->join('suppliers','car_services.due_to_supp','suppliers.s_no')
    ->join('users','car_services.user_id','users.id')
    ->select ('car_services.car_id as t_id' ,
    'car_services.passenger_name as t_pn',
     'car_services.service_id as st_id' ,
    'car_services.refernce as t_ref',
    'car_services.provider_cost as t_pc' ,
    'suppliers.supplier_name as s_name',
    'users.name as u_name',
    'currency.cur_name as cur_n',
    'car_services.user_id as uuser_resiver' ,
    'car_services.cost as cost',
    'car_services.bookmark as bookmark',
    'car_services.how_add_bookmark as bookmark_how',
    'car_services.voucher_number as s_num' ,
    'car_services.Issue_date as t_idate') 
    ->paginate(10);            
}elseif($id=='general'){
                  $affected1=['id'=>'general'];
                  $affected =GeneralService::where('service_status',3)
                  ->join('currency','general_services.cur_id','currency.cur_id')
                  ->join('suppliers','general_services.due_to_supp','suppliers.s_no')
                  ->join('users','general_services.user_id','users.id')
                  ->select ('general_services.gen_id as t_id' ,
                  'general_services.passenger_name as t_pn',
                  'general_services.service_id as st_id' ,
                  'general_services.refernce as t_ref',
                  'general_services.provider_cost as t_pc' ,
                  'suppliers.supplier_name as s_name',
                  'general_services.voucher_number as s_num' ,
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'general_services.bookmark as bookmark',
                  'general_services.how_add_bookmark as bookmark_how',
                  'general_services.user_id as uuser_resiver' ,
                  'general_services.cost as cost',
                  'general_services.Issue_date as t_idate') 
                  ->paginate(10);  
               }elseif($id=='hotel'){
                  $affected1=['id'=>'hotel'];
                  $affected =HotelService::where('service_status',3)
                  ->join('currency','hotel_services.cur_id','currency.cur_id')
                  ->join('suppliers','hotel_services.due_to_supp','suppliers.s_no')
                  ->join('users','hotel_services.user_id','users.id')
                  ->select ('hotel_services.hotel_id as t_id' ,
                  'hotel_services.passenger_name as t_pn',
                  'hotel_services.service_id as st_id' ,
                  'hotel_services.refernce as t_ref',
                  'hotel_services.provider_cost as t_pc' ,
                  'suppliers.supplier_name as s_name',
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'hotel_services.voucher_number as s_num' ,
                  'hotel_services.cost as cost',
                  'hotel_services.bookmark as bookmark',
                  'hotel_services.how_add_bookmark as bookmark_how',
                  'hotel_services.user_id as uuser_resiver' ,
                  'hotel_services.Issue_date as t_idate') 
                  ->paginate(10); 
               }elseif($id=='visa'){
                  $affected1=['id'=>'visa'];
                  $affected =VisaService::where('service_status',3)
                  ->join('currency','visa_services.cur_id','currency.cur_id')
                  ->join('suppliers','visa_services.due_to_supp','suppliers.s_no')
                  ->join('users','visa_services.user_id','users.id')
                  ->select ('visa_services.visa_id as t_id' ,
                  'visa_services.passenger_name as t_pn',
                  'visa_services.service_id as st_id' ,
                  'visa_services.refernce as t_ref',
                  'visa_services.provider_cost as t_pc' ,
                  'suppliers.supplier_name as s_name',
                  'visa_services.voucher_number as s_num' ,
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'visa_services.cost as cost',
                  'visa_services.bookmark as bookmark',
                  'visa_services.how_add_bookmark as bookmark_how',
                  'visa_services.user_id as uuser_resiver' ,
                  'visa_services.Issue_date as t_idate') 
                  ->paginate(10); 
               }elseif($id=='medical'){
                  $affected1=['namme'=>'medical'];
                  $affected =MedicalService::where('service_status',3)
                  ->join('currency','medical_services.cur_id','currency.cur_id')
                  ->join('suppliers','medical_services.due_to_supp','suppliers.s_no')
                  ->join('users','medical_services.user_id','users.id')
                  ->select ('medical_services.med_id as t_id' ,
                  'medical_services.passenger_name as t_pn',
                  'medical_services.service_id as st_id' ,
                  'medical_services.user_id as uuser_resiver' ,
                  'medical_services.refernce as t_ref',
                  'medical_services.provider_cost as t_pc' ,
                  'suppliers.supplier_name as s_name',
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'medical_services.cost as cost',
                  'medical_services.bookmark as bookmark',
                  'medical_services.how_add_bookmark as bookmark_how',
                  'medical_services.document_number as s_num' ,
                  'medical_services.Issue_date as t_idate') 
                  ->paginate(10);                 
               }
    return view('accountant_review',['data'=>$affected,'data1'=>$affected1]);      

    }
    /******************************get one item******************************* */
    public function ticket($id){
 //ticket
 $affected =DB::select('SELECT * FROM `ticket_services` join users on ticket_services.user_id=users.id join airlines on ticket_services.airline_id=airlines.id join suppliers on ticket_services.due_to_supp=suppliers.s_no JOIN currency on ticket_services.cur_id=currency.cur_id');

    echo json_encode($affected);
    }

    public function bus($id){
      //bus
      $affected =DB::select('SELECT * FROM `bus_services` join users on bus_services.user_id=users.id join suppliers on bus_services.due_to_supp=suppliers.s_no JOIN currency on bus_services.cur_id=currency.cur_id');
         echo json_encode($affected);
         }
         public function car($id){
            //car
            $affected =DB::select('SELECT * FROM `car_services` join users on car_services.user_id=users.id join suppliers on car_services.due_to_supp=suppliers.s_no JOIN currency on car_services.cur_id=currency.cur_id');
               echo json_encode($affected);
               }
    public function general($id){
                  //general
         $affected =DB::select('SELECT * FROM `general_services` join users on general_services.user_id=users.id join suppliers on general_services.due_to_supp=suppliers.s_no JOIN currency on general_services.cur_id=currency.cur_id');
                     echo json_encode($affected);
                } 
       public function medical($id){
                  //medical
         $affected =DB::select('SELECT * FROM `medical_services` join users on medical_services.user_id=users.id join suppliers on medical_services.due_to_supp=suppliers.s_no JOIN currency on medical_services.cur_id=currency.cur_id');
                     echo json_encode($affected);
                }  
       public function hotel($id){
                  //hotel
         $affected =DB::select('SELECT * FROM `hotel_services` join users on hotel_services.user_id=users.id join suppliers on hotel_services.due_to_supp=suppliers.s_no JOIN currency on hotel_services.cur_id=currency.cur_id');
                     echo json_encode($affected);
                }  
       public function visa($id){
                  //hotel
         $affected =DB::select('SELECT * FROM `visa_services` join users on visa_services.user_id=users.id join suppliers on visa_services.due_to_supp=suppliers.s_no JOIN currency on visa_services.cur_id=currency.cur_id');
                     echo json_encode($affected);
                }                                
/******************************add remark******************************* */

public function add_remark($col,$old,$new,$status){
  
   if($status==1){
      $item=array('col_name'=>$col,'oldval'=>$old,'newval'=>$new);
      IF(ARRAY_SEARCH($col,ARRAY_COLUMN($_SESSION['remark'],'col_name'))!==FALSE){
         foreach($_SESSION['remark'] as $index=>$column){
          foreach($column as $key=>$value){
              if($key=='col_name' && $value==$col){
         $_SESSION['remark'][$index]['newval']=$new;
              }
         }
         }
      }ELSE{
           array_push($_SESSION['remark'],$item);  	
      }
   
    return $_SESSION['remark'];
   }elseif($status==0){

      foreach($_SESSION['remark'] as $index=>$column){
         foreach($column as $key=>$value){
         if($key=='col_name' && $value==$col){
                     $sp=array();
                     $sp=$_SESSION['remark'];
                     unset($sp[$index]);
                     $_SESSION['remark']=$sp;
                  }
            }
         }
                      print_r($_SESSION['remark']);
   }
   }

   public function send_remark($main,$service,$to,$from,$number){
      $message5="";
      $date=now();
     $remark_body=$_SESSION['remark'];
     $remark_body = json_encode($_SESSION['remark']);
     DB::table('logs')->insert(
      ['remarker_id' => $from, 
      'editor_id' => $to,
      'main_servic_id'=>$main ,
      'service_id'=>$service ,
      'remark_body'=>$remark_body,
      'status'=>0,
      'number'=>$number,
      ]
  );
  //$sp=array();
  //$sp=$_SESSION['remark'];
  //unset($sp);
 // $_SESSION['remark']=$sp;

  if($main==2){
   $update= BusService::where('bus_id',$service)->update(['service_status'=>2,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==3){
   $update= CarService::where('car_id',$service)->update(['service_status'=>2,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about CAR servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==1){
   $update= TicketService::where('tecket_id',$service)->update(['service_status'=>2,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about TICKET servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==7){
   $update= GeneralService::where('car_id',$service)->update(['service_status'=>2,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about GENERAL servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==4){
   $update= MedicalService::where('med_id',$service)->update(['service_status'=>2,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about MEDICAL servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==5){
   $update= HotelService::where('hotel_id',$service)->update(['service_status'=>2,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about HOTEL servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==6){
   $update= VisaService::where('visa_id',$service)->update(['service_status'=>2,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about VISA servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}

$datav=['to'=>$to,'from'=>$from,'message'=> $message5,'date'=>$date];
$date1=date("Y/m/d") ;
$message=$datav['message'];
DB::table('notifications')->insert(
   ['sender' => $from, 
   'resiver' => $to,
   'body'=>$message ,
   'status'=>0 ,
   'main_service'=>$main,
   'servic_id'=>$service,
   'created_at'=>$date,
   'updated_at'=>$date1,
   ]
);
event(new MyEvent($datav));
return "Event has been sent!";
unset($_SESSION['remark']);

   }
/***************************bill number ********************** */

   public function bill_num($service,$main,$bill_num,$howaddit,$reciver,$number){
      $message5="";
      $date1=date("Y/m/d") ;
      $date=now();
      if($main==1){
         $update= TicketService::where('tecket_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==2){
         $update= BusService::where('bus_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  bus servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==3){
         $update= CarService::where('car_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  car servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      }elseif($main==7){
         $update= GeneralService::where('gen_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  general servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==4){
         $update= MedicalService::where('med_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  medical servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==5){
         $update= HotelService::where('hotel_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  medical servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==6){
         $update= VisaService::where('visa_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  visa servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }

      $datav=['to'=>$reciver,'from'=>$howaddit,'message'=> $message5,'date'=>$date];
      $message=$datav['message'];
      DB::table('notifications')->insert(
         ['sender' => $howaddit, 
         'resiver' => $reciver,
         'body'=>$message ,
         'status'=>0 ,
         'main_service'=>$main,
         'servic_id'=>$service,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($datav));
      return "Event has been sent!";
   }
   /***************************service finished********************** */
   public function accountant_finish($id,$user)
   { 
if($id=='ticket'){
//ticket
$affected =TicketService::where([['service_status',4],['how_add_bill',$user]])
->join('currency','ticket_services.cur_id','currency.cur_id')
->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
->join('users','ticket_services.user_id','users.id')
->select ('ticket_services.tecket_id as t_id' ,
'ticket_services.service_id as st_id' ,
'ticket_services.passenger_name as t_pn',
'ticket_services.refernce as t_ref',
'ticket_services.provider_cost as t_pc' ,
'suppliers.supplier_name as s_name',
'users.name as u_name',
'currency.cur_name as cur_n',
'ticket_services.ticket_number as s_num' , 
'ticket_services.bill_num as bill' ,
'ticket_services.cost as cost',
'ticket_services.Issue_date as t_idate') 
->paginate(10);
$affected1=['id'=>'ticket'];
   }elseif($id=='bus'){
       //bus
       $affected1=['id'=>'bus'];
       $affected =BusService::where([['service_status',4],['how_add_bill',$user]])
       ->join('currency','bus_services.cur_id','currency.cur_id')
       ->join('suppliers','bus_services.due_to_supp','suppliers.s_no')
       ->join('users','bus_services.user_id','users.id')
       ->select ('bus_services.bus_id as t_id' ,
       'bus_services.passenger_name as t_pn',
        'bus_services.service_id as st_id' ,
       'bus_services.refernce as t_ref',
       'bus_services.provider_cost as t_pc' ,
       'bus_services.bus_number as s_num' ,
       'bus_services.bill_num as bill' ,
       'suppliers.supplier_name as s_name',
       'users.name as u_name',
       'currency.cur_name as cur_n',
       'bus_services.cost as cost',
       'bus_services.Issue_date as t_idate') 
       ->paginate(10);
       
          }elseif($id=='car'){
            //bus
            $affected1=['id'=>'car'];
            $affected =CarService::where([['service_status',4],['how_add_bill',$user]])
            ->join('currency','car_services.cur_id','currency.cur_id')
            ->join('suppliers','car_services.due_to_supp','suppliers.s_no')
            ->join('users','car_services.user_id','users.id')
            ->select ('car_services.car_id as t_id' ,
            'car_services.passenger_name as t_pn',
             'car_services.service_id as st_id' ,
            'car_services.refernce as t_ref',
            'car_services.provider_cost as t_pc' ,
            'car_services.voucher_number as s_num' ,
            'car_services.bill_num as bill' ,
            'suppliers.supplier_name as s_name',
            'users.name as u_name',
            'currency.cur_name as cur_n',
            'car_services.cost as cost',
            'car_services.Issue_date as t_idate') 
            ->paginate(10);
            
               }elseif($id=='general'){
                  $affected1=['id'=>'general'];
                  $affected =GeneralService::where([['service_status',4],['how_add_bill',$user]])
                  ->join('currency','general_services.cur_id','currency.cur_id')
                  ->join('suppliers','general_services.due_to_supp','suppliers.s_no')
                  ->join('users','general_services.user_id','users.id')
                  ->select ('general_services.gen_id as t_id' ,
                  'general_services.passenger_name as t_pn',
                  'general_services.service_id as st_id' ,
                  'general_services.refernce as t_ref',
                  'general_services.provider_cost as t_pc' ,
                  'suppliers.supplier_name as s_name',
                  'general_services.voucher_number as s_num' ,
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'general_services.bill_num as bill' ,
                  'general_services.user_id as uuser_resiver' ,
                  'general_services.cost as cost',
                  'general_services.Issue_date as t_idate') 
                  ->paginate(10);  
              }elseif($id=='hotel'){
               $affected1=['id'=>'hotel'];
               $affected =HotelService::where([['service_status',4],['how_add_bill',$user]])
               ->join('currency','hotel_services.cur_id','currency.cur_id')
               ->join('suppliers','hotel_services.due_to_supp','suppliers.s_no')
               ->join('users','hotel_services.user_id','users.id')
               ->select ('hotel_services.hotel_id as t_id' ,
               'hotel_services.passenger_name as t_pn',
               'hotel_services.service_id as st_id' ,
               'hotel_services.refernce as t_ref',
               'hotel_services.provider_cost as t_pc' ,
               'suppliers.supplier_name as s_name',
               'users.name as u_name',
               'currency.cur_name as cur_n',
               'hotel_services.voucher_number as s_num' ,
               'hotel_services.voucher_number as s_num' ,
               'hotel_services.cost as cost',
               'hotel_services.bill_num as bill' ,
               'hotel_services.user_id as uuser_resiver' ,
               'hotel_services.Issue_date as t_idate') 
               ->paginate(10); 
              }elseif($id=='visa'){
               $affected1=['id'=>'visa'];
                  $affected =VisaService::where([['service_status',4],['how_add_bill',$user]])
                  ->join('currency','visa_services.cur_id','currency.cur_id')
                  ->join('suppliers','visa_services.due_to_supp','suppliers.s_no')
                  ->join('users','visa_services.user_id','users.id')
                  ->select ('visa_services.visa_id as t_id' ,
                  'visa_services.passenger_name as t_pn',
                  'visa_services.service_id as st_id' ,
                  'visa_services.refernce as t_ref',
                  'visa_services.provider_cost as t_pc' ,
                  'suppliers.supplier_name as s_name',
                  'visa_services.voucher_number as s_num' ,
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'visa_services.cost as cost',
                  'visa_services.user_id as uuser_resiver' ,
                  'visa_services.bill_num as bill' ,
                  'visa_services.Issue_date as t_idate') 
                  ->paginate(10); 
              }elseif($id=='medical'){
               $affected1=['namme'=>'medical'];
               $affected =MedicalService::where([['service_status',4],['how_add_bill',$user]])
               ->join('currency','medical_services.cur_id','currency.cur_id')
               ->join('suppliers','medical_services.due_to_supp','suppliers.s_no')
               ->join('users','medical_services.user_id','users.id')
               ->select ('medical_services.med_id as t_id' ,
               'medical_services.passenger_name as t_pn',
               'medical_services.service_id as st_id' ,
               'medical_services.user_id as uuser_resiver' ,
               'medical_services.refernce as t_ref',
               'medical_services.provider_cost as t_pc' ,
               'suppliers.supplier_name as s_name',
               'users.name as u_name',
               'currency.cur_name as cur_n',
               'medical_services.cost as cost',
               'medical_services.document_number as s_num' ,
               'medical_services.bill_num as bill' ,
               'medical_services.Issue_date as t_idate') 
               ->paginate(10);                 
            }
   return view('accountent_finish',['data'=>$affected,'data1'=>$affected1]);      

   }


   /***********************color to service i0ki0pjk[************************ */
function add_bookmark($main,$service,$c,$h){

   if($main==2){
      $update= BusService::where('bus_id',$service)->update(['bookmark'=>$c,'how_add_bookmark'=>$h]);
   }else  if($main==3){
      $update= CarService::where('car_id',$service)->update(['bookmark'=>$c,'how_add_bookmark'=>$h]);
   }else  if($main==1){
      $update= TicketService::where('tecket_id',$service)->update(['bookmark'=>$c,'how_add_bookmark'=>$h]);
   }else  if($main==7){
      $update= GeneralService::where('car_id',$service)->update(['bookmark'=>$c,'how_add_bookmark'=>$h]);
   }else  if($main==4){
      $update= MedicalService::where('med_id',$service)->update(['bookmark'=>$c,'how_add_bookmark'=>$h]);
   }else  if($main==5){
      $update= HotelService::where('hotel_id',$service)->update(['bookmark'=>$c,'how_add_bookmark'=>$h]);
   }else  if($main==6){
      $update= VisaService::where('visa_id',$service)->update(['bookmark'=>$c,'how_add_bookmark'=>$h]);
   }
   

}
function remove_bookmark($main,$service,$h){

   if($main==2){
      $update= BusService::where([['bus_id',$service],['how_add_bookmark',$h]])->update(['bookmark'=>'0']);
   }else  if($main==3){
      $update= CarService::where([['car_id',$service],['how_add_bookmark',$h]])->update(['bookmark'=>'0']);
   }else  if($main==1){
      $update= TicketService::where([['tecket_id',$service],['how_add_bookmark',$h]])->update(['bookmark'=>'0']);
   }else  if($main==7){
      $update= GeneralService::where([['gen_id',$service],['how_add_bookmark',$h]])->update(['bookmark'=>'0']);
   }else  if($main==4){
      $update= MedicalService::where([['med_id',$service],['how_add_bookmark',$h]])->update(['bookmark'=>'0']);
   }else  if($main==5){
      $update= HotelService::where([['hotel_id',$service],['how_add_bookmark',$h]])->update(['bookmark'=>'0']);
   }else  if($main==6){
      $update= VisaService::where([['visa_id',$service],['how_add_bookmark',$h]])->update(['bookmark'=>'0']);
   }
   

}

}
