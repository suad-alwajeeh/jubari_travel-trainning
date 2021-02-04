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
use Auth;
use App\Events\MyEvent;
use App\Events\Notification;

@session_start();
if(isset($_SESSION['remark'])){
}else{
    $_SESSION['remark']=array();    
}
class SalesManagerController extends Controller
{

   public function sales_view()
   {      $loged_Id=  Auth::user()->id ;

      
        //ticket
        $affectedt = DB::select('SELECT COUNT(*) as accountant FROM ticket_services WHERE service_status = 2');
        $affectedt1 = DB::select('SELECT COUNT(*) as finish FROM ticket_services WHERE service_status = 4');
        $affectedt2 = DB::select('SELECT COUNT(*) as ok FROM ticket_services WHERE service_status = 2 and  ses_status=1');
        $affectedt3 = DB::select('SELECT COUNT(*) as issue FROM ticket_services WHERE  service_status = 2 and ses_status=2');
        $affectedt4 = DB::select('SELECT COUNT(*) as void FROM ticket_services WHERE service_status = 2 and ses_status=3');
        $affectedt5 = DB::select('SELECT COUNT(*) as refund FROM ticket_services WHERE service_status = 2 and ses_status=4');

        //hotel
        $affectedh = DB::select('SELECT COUNT(*) as accountant FROM hotel_services WHERE service_status = 2');
        $affectedh1 = DB::select('SELECT COUNT(*) as finish FROM hotel_services WHERE service_status = 4');
        $affectedth2 = DB::select('SELECT COUNT(*) as ok FROM hotel_services WHERE service_status = 2 and  ses_status=1');
        $affectedth3 = DB::select('SELECT COUNT(*) as issue FROM hotel_services WHERE service_status = 2 and  ses_status=2');
        $affectedth4 = DB::select('SELECT COUNT(*) as void FROM hotel_services WHERE service_status = 2 and ses_status=3');
        $affectedth5 = DB::select('SELECT COUNT(*) as refund FROM hotel_services WHERE service_status = 2 and ses_status=4');
         //bus
         $affectedb = DB::select('SELECT COUNT(*) as accountant FROM bus_services WHERE service_status = 2');
         $affectedb1 = DB::select('SELECT COUNT(*) as finish FROM bus_services WHERE service_status = 4');
         $affectedtb2 = DB::select('SELECT COUNT(*) as ok FROM bus_services WHERE  service_status = 2 and ses_status=1');
         $affectedtb3 = DB::select('SELECT COUNT(*) as issue FROM bus_services WHERE service_status = 2 and  ses_status=2');
         $affectedtb4 = DB::select('SELECT COUNT(*) as void FROM bus_services WHERE service_status = 2 and ses_status=3');
         $affectedtb5 = DB::select('SELECT COUNT(*) as refund FROM bus_services WHERE service_status = 2 and ses_status=4');
         //car
         $affectedc = DB::select('SELECT COUNT(*) as accountant FROM car_services WHERE service_status = 2');
          $affectedc1 = DB::select('SELECT COUNT(*) as finish FROM car_services WHERE service_status = 4');
          $affectedtc2 = DB::select('SELECT COUNT(*) as ok FROM car_services WHERE  service_status = 2 and ses_status=1');
          $affectedtc3 = DB::select('SELECT COUNT(*) as issue FROM car_services WHERE service_status = 2 and  ses_status=2');
          $affectedtc4 = DB::select('SELECT COUNT(*) as void FROM car_services WHERE service_status = 2 and ses_status=3');
          $affectedtc5 = DB::select('SELECT COUNT(*) as refund FROM car_services WHERE service_status = 2 and ses_status=4');
                    //medical
        $affectedm = DB::select('SELECT COUNT(*) as accountant FROM medical_services WHERE service_status = 2');
        $affectedm1 = DB::select('SELECT COUNT(*) as finish FROM medical_services WHERE service_status = 4');
        $affectedtm2 = DB::select('SELECT COUNT(*) as ok FROM medical_services WHERE service_status = 2 and  ses_status=1');
        $affectedtm3 = DB::select('SELECT COUNT(*) as issue FROM medical_services WHERE service_status = 2 and  ses_status=2');
        $affectedtm4 = DB::select('SELECT COUNT(*) as void FROM medical_services WHERE service_status = 2 and ses_status=3');
        $affectedtm5 = DB::select('SELECT COUNT(*) as refund FROM medical_services WHERE service_status = 2 and  ses_status=4');
      
         //general
         $affectedg = DB::select('SELECT COUNT(*) as accountant FROM general_services WHERE service_status = 2');
         $affectedg1 = DB::select('SELECT COUNT(*) as finish FROM general_services WHERE  service_status = 4');
         $affectedtg2 = DB::select('SELECT COUNT(*) as ok FROM general_services WHERE service_status = 2 and  ses_status=1');
         $affectedtg3 = DB::select('SELECT COUNT(*) as issue FROM general_services WHERE  service_status = 2 and ses_status=2');
         $affectedtg4 = DB::select('SELECT COUNT(*) as void FROM general_services WHERE service_status = 2 and  ses_status=3');
         $affectedtg5 = DB::select('SELECT COUNT(*) as refund FROM general_services WHERE  service_status = 2 and  ses_status=4');
         //visa
         $affectedv = DB::select('SELECT COUNT(*) as accountant FROM visa_services WHERE service_status = 2');
         $affectedv1 = DB::select('SELECT COUNT(*) as finish FROM visa_services WHERE service_status = 4');
         $affectedtv2 = DB::select('SELECT COUNT(*) as ok FROM visa_services WHERE  service_status = 2 and ses_status=1');
         $affectedtv3 = DB::select('SELECT COUNT(*) as issue FROM visa_services WHERE service_status = 2 and  ses_status=2');
         $affectedtv4 = DB::select('SELECT COUNT(*) as void FROM visa_services WHERE service_status = 2 and ses_status=3');
         $affectedtv5 = DB::select('SELECT COUNT(*) as refund FROM visa_services WHERE service_status = 2 and  ses_status=4');
         $onlyl=DB::SELECT('SELECT tecket_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
         ,service_status as s_st,ses_status as ses  FROM ticket_services 
         JOIN users on ticket_services.user_id=users.id
          JOIN currency on ticket_services.ses_cur_id=currency.cur_id
          JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
           WHERE service_status = 2 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
               SELECT gen_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,service_status as s_st,ses_status as ses  FROM general_services
          JOIN users on general_services.user_id=users.id
          JOIN currency on general_services.ses_cur_id=currency.cur_id
          JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
           WHERE service_status = 2 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT bus_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
         ,service_status as s_st,ses_status as ses  FROM bus_services
           JOIN users on bus_services.user_id=users.id
          JOIN currency on bus_services.ses_cur_id=currency.cur_id
          JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
           WHERE service_status = 2 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT hotel_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
         ,service_status as s_st,ses_status as ses  FROM hotel_services 
          
           JOIN users on hotel_services.user_id=users.id
          JOIN currency on hotel_services.ses_cur_id=currency.cur_id
          JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
           WHERE service_status = 2 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT visa_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,service_status as s_st,ses_status as ses  FROM visa_services
           JOIN users on visa_services.user_id=users.id
          JOIN currency on visa_services.ses_cur_id=currency.cur_id
          JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
           WHERE service_status = 2 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT med_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
         ,service_status as s_st , ses_status as ses  FROM medical_services 
           JOIN users on medical_services.user_id=users.id
          JOIN currency on medical_services.ses_cur_id=currency.cur_id
          JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
           WHERE service_status = 2 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT car_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
          ,service_status as s_st,ses_status as ses FROM car_services
          JOIN users on car_services.user_id=users.id
          JOIN currency on car_services.ses_cur_id=currency.cur_id
          JOIN suppliers on car_services.due_to_supp=suppliers.s_no
           WHERE service_status = 2 and DATE(Issue_date)=CURRENT_DATE() LIMIT 10');
       
         return view('displaySalesManager',['tic1'=>$affectedt,'tic2'=>$affectedt1,'tic3'=>$affectedt2,'tic4'=>$affectedt3,'tic5'=>$affectedt4,'tic6'=>$affectedt5,
                                         'bus1'=>$affectedb,'bus2'=>$affectedb1,'bus3'=>$affectedtb2,'bus4'=>$affectedtb3,'bus5'=>$affectedtb4,'bus6'=>$affectedtb5,
                                         'car1'=>$affectedc,'car2'=>$affectedc1,'car3'=>$affectedtc2,'car4'=>$affectedtc3,'car5'=>$affectedtc4,'car6'=>$affectedtc5,
                                         'hot1'=>$affectedh,'hot2'=>$affectedh1,'hot3'=>$affectedth2,'hot4'=>$affectedth3,'hot5'=>$affectedth4,'hot6'=>$affectedth5,
                                         'med1'=>$affectedm,'med2'=>$affectedm1,'med3'=>$affectedtm2,'med4'=>$affectedtm3,'med5'=>$affectedtm4,'med6'=>$affectedtm5,
                                         'gen1'=>$affectedg,'gen2'=>$affectedg1,'gen3'=>$affectedtg2,'gen4'=>$affectedtg3,'gen5'=>$affectedtg4,'gen6'=>$affectedtg5,
                                         'vis1'=>$affectedv,'vis2'=>$affectedv1,'vis3'=>$affectedtv2,'vis4'=>$affectedtv3,'vis5'=>$affectedtv4,'vis6'=>$affectedtv5,
                                         'latest'=>$onlyl ]);
      

   }

   public function sales_review($id)
   { 
       if($id=='ticket'){
//ticket
$affected =TicketService::where(['service_status'=>2,'errorlog'=>0])
->join('currency','ticket_services.ses_cur_id','currency.cur_id')
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
'ticket_services.cost as cost',
'ticket_services.Issue_date as t_idate') 
->paginate(10);
$affected1=['id'=>'ticket'];
   }elseif($id=='bus'){
       //bus
       $affected1=['id'=>'bus'];
       $affected =BusService::where(['service_status'=>2,'errorlog'=>0])
       ->join('currency','bus_services.ses_cur_id','currency.cur_id')
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
       'bus_services.user_id as uuser_resiver' ,
       'bus_services.Issue_date as t_idate') 
       ->paginate(10);
       
          }elseif($id=='car'){
   //car
   $affected1=['id'=>'car'];
   $affected =CarService::where(['service_status'=>2,'errorlog'=>0])
   ->join('currency','car_services.ses_cur_id','currency.cur_id')
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
   'car_services.voucher_number as s_num' ,
   'car_services.Issue_date as t_idate') 
   ->paginate(10);            
}elseif($id=='general'){
                 $affected1=['id'=>'general'];
                 $affected =GeneralService::where(['service_status'=>2,'errorlog'=>0])
                 ->join('currency','general_services.ses_cur_id','currency.cur_id')
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
                 'general_services.user_id as uuser_resiver' ,
                 'general_services.cost as cost',
                 'general_services.Issue_date as t_idate') 
                 ->paginate(10);  
              }elseif($id=='hotel'){
                 $affected1=['id'=>'hotel'];
             $affected =HotelService::where(['service_status'=>2,'errorlog'=>0])
                 ->join('currency','hotel_services.ses_cur_id','currency.cur_id')
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
                 'hotel_services.user_id as uuser_resiver' ,
                 'hotel_services.Issue_date as t_idate') 
                 ->paginate(10); 
              }elseif($id=='visa'){
                 $affected1=['id'=>'visa'];
                 $affected =VisaService::where(['service_status'=>2,'errorlog'=>0])
                 ->join('currency','visa_services.ses_cur_id','currency.cur_id')
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
                 'visa_services.Issue_date as t_idate') 
                 ->paginate(10); 
              }elseif($id=='medical'){
                 $affected1=['namme'=>'medical'];
                 $affected =MedicalService::where(['service_status'=>2,'errorlog'=>0])
                 ->join('currency','medical_services.ses_cur_id','currency.cur_id')
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
                 'medical_services.Issue_date as t_idate') 
                 ->paginate(10);                 
              }
   return view('salesManagerView',['data'=>$affected,'data1'=>$affected1]);      

   }
   public function sales_review_with_status($id,$type)
   { 
       if($id=='ticket'){
//ticket
$affected =TicketService::where([['service_status',2],['ses_status',$type]])
->join('currency','ticket_services.ses_cur_id','currency.cur_id')
->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
->join('users','ticket_services.user_id','users.id')
->join('airlines','ticket_services.airline_id','airlines.id')
->select ('ticket_services.tecket_id as t_id' ,
'service_status as s_st',
'ticket_services.ticket_number as s_num' ,
'ticket_services.service_id as st_id' ,
'airlines.airline_name as airline_name' ,
'ticket_services.user_id as uuser_resiver' ,
'ticket_services.passenger_name as t_pn',
'ticket_services.refernce as t_ref',
'ticket_services.provider_cost as tp_c', 
'suppliers.supplier_name as s_name',
'users.name as u_name',
'currency.cur_name as cur_n',
'ticket_services.bookmark as bookmark',
'ticket_services.how_add_bookmark as bookmark_how',
'ticket_services.cost as cost',
'ticket_services.Issue_date as t_idate') 
->paginate(25);
$affected1=['id'=>'ticket'];
   }elseif($id=='bus'){
       //bus
       $affected1=['id'=>'bus'];
       $affected =BusService::where([['service_status',2],['ses_status',$type]])
       ->join('currency','bus_services.ses_cur_id','currency.cur_id')
       ->join('suppliers','bus_services.due_to_supp','suppliers.s_no')
       ->join('users','bus_services.user_id','users.id')
       ->select ('bus_services.bus_id as t_id' ,
       'bus_services.passenger_name as t_pn',
        'bus_services.service_id as st_id' ,
        'service_status as s_st',
       'bus_services.refernce as t_ref',
       'bus_services.provider_cost as tp_c' ,
       'suppliers.supplier_name as s_name',
       'users.name as u_name',
       'bus_services.bus_number as s_num' ,
       'currency.cur_name as cur_n',
       'bus_services.cost as cost',
       'bus_services.bookmark as bookmark',
       'bus_services.how_add_bookmark as bookmark_how',
       'bus_services.user_id as uuser_resiver' ,
       'bus_services.Issue_date as t_idate') 
       ->paginate(25);
       
          }elseif($id=='car'){
   //car
   $affected1=['id'=>'car'];
   $affected =CarService::where([['service_status',2],['ses_status',$type]])
   ->join('currency','car_services.ses_cur_id','currency.cur_id')
   ->join('suppliers','car_services.due_to_supp','suppliers.s_no')
   ->join('users','car_services.user_id','users.id')
   ->select ('car_services.car_id as t_id' ,
   'car_services.passenger_name as t_pn',
   'service_status as s_st',
    'car_services.service_id as st_id' ,
   'car_services.refernce as t_ref',
   'car_services.provider_cost as tp_c' ,
   'suppliers.supplier_name as s_name',
   'users.name as u_name',
   'currency.cur_name as cur_n',
   'car_services.user_id as uuser_resiver' ,
   'car_services.cost as cost',
   'car_services.bookmark as bookmark',
   'car_services.how_add_bookmark as bookmark_how',
   'car_services.voucher_number as s_num' ,
   'car_services.Issue_date as t_idate') 
   ->paginate(25);            
}elseif($id=='general'){
                 $affected1=['id'=>'general'];
                 $affected =GeneralService::where([['service_status',2],['ses_status',$type]])
                 ->join('currency','general_services.ses_cur_id','currency.cur_id')
                 ->join('suppliers','general_services.due_to_supp','suppliers.s_no')
                 ->join('users','general_services.user_id','users.id')
                 ->select ('general_services.gen_id as t_id' ,
                 'general_services.passenger_name as t_pn',
                 'general_services.service_id as st_id' ,
                 'general_services.refernce as t_ref',
                 'general_services.provider_cost as tp_c' ,
                 'suppliers.supplier_name as s_name',
                 'general_services.voucher_number as s_num' ,
                 'users.name as u_name',
                 'service_status as s_st',
                 'currency.cur_name as cur_n',
                 'general_services.bookmark as bookmark',
                 'general_services.how_add_bookmark as bookmark_how',
                 'general_services.user_id as uuser_resiver' ,
                 'general_services.cost as cost',
                 'general_services.Issue_date as t_idate') 
                 ->paginate(25);  
              }elseif($id=='hotel'){
                 $affected1=['id'=>'hotel'];
                 $affected =HotelService::where([['service_status',2],['ses_status',$type]])
                 ->join('currency','hotel_services.ses_cur_id','currency.cur_id')
                 ->join('suppliers','hotel_services.due_to_supp','suppliers.s_no')
                 ->join('users','hotel_services.user_id','users.id')
                 ->select ('hotel_services.hotel_id as t_id' ,
                 'hotel_services.passenger_name as t_pn',
                 'hotel_services.service_id as st_id' ,
                 'hotel_services.refernce as t_ref',
                 'hotel_services.provider_cost as tp_c' ,
                 'suppliers.supplier_name as s_name',
                 'users.name as u_name',
                 'service_status as s_st',
                 'currency.cur_name as cur_n',
                 'hotel_services.voucher_number as s_num' ,
                 'hotel_services.cost as cost',
                 'hotel_services.bookmark as bookmark',
                 'hotel_services.how_add_bookmark as bookmark_how',
                 'hotel_services.user_id as uuser_resiver' ,
                 'hotel_services.Issue_date as t_idate') 
                 ->paginate(25); 
              }elseif($id=='visa'){
                 $affected1=['id'=>'visa'];
                 $affected =VisaService::wherewhere([['service_status',3],['ses_status',$type]])
                 ->join('currency','visa_services.ses_cur_id','currency.cur_id')
                 ->join('suppliers','visa_services.due_to_supp','suppliers.s_no')
                 ->join('users','visa_services.user_id','users.id')
                 ->select ('visa_services.visa_id as t_id' ,
                 'visa_services.passenger_name as t_pn',
                 'visa_services.service_id as st_id' ,
                 'visa_services.refernce as t_ref',
                 'visa_services.provider_cost as tp_c' ,
                 'suppliers.supplier_name as s_name',
                 'visa_services.voucher_number as s_num' ,
                 'users.name as u_name',
                 'service_status as s_st',
                 'currency.cur_name as cur_n',
                 'visa_services.cost as cost',
                 'visa_services.bookmark as bookmark',
                 'visa_services.how_add_bookmark as bookmark_how',
                 'visa_services.user_id as uuser_resiver' ,
                 'visa_services.Issue_date as t_idate') 
                 ->paginate(25); 
              }elseif($id=='medical'){
                 $affected1=['namme'=>'medical'];
                 $affected =MedicalService::where([['service_status',3],['ses_status',$type]])
                 ->join('currency','medical_services.ses_cur_id','currency.cur_id')
                 ->join('suppliers','medical_services.due_to_supp','suppliers.s_no')
                 ->join('users','medical_services.user_id','users.id')
                 ->select ('medical_services.med_id as t_id' ,
                 'medical_services.passenger_name as t_pn',
                 'medical_services.service_id as st_id' ,
                 'service_status as s_st',
                 'medical_services.user_id as uuser_resiver' ,
                 'medical_services.refernce as t_ref',
                 'medical_services.provider_cost as tp_c' ,
                 'suppliers.supplier_name as s_name',
                 'users.name as u_name',
                 'currency.cur_name as cur_n',
                 'medical_services.cost as cost',
                 'medical_services.bookmark as bookmark',
                 'medical_services.how_add_bookmark as bookmark_how',
                 'medical_services.document_number as s_num' ,
                 'medical_services.Issue_date as t_idate') 
                 ->paginate(25);                 
              }
              $affected3 =DB::select('select * from services WHERE services.is_active=1 and services.deleted=0');
              $affected4 =DB::select('SELECT * FROM suppliers WHERE suppliers.is_active=1 and suppliers.is_deleted=0');
              $affected5=DB::select('select ru.user_id as u_id ,GROUP_CONCAT(r.name) as roless,u.name as u_name 
              FROM role_user as ru 
              INNER JOIN roles as r on ru.role_id=r.id 
              INNER JOIN users as u on ru.user_id=u.id
              where ru.role_id in (2,3) and u.is_delete=0 and u.is_active=1 
              GROUP BY ru.user_id');
              $affected6 =DB::select('select * from currency where currency.is_active=1 ');
              return view('salesManagerView',['data'=>$affected,'data1'=>$affected1,'data3'=>$affected3,'data4'=>$affected4,'data5'=>$affected5,'data6'=>$affected6]);      

   }
   public function sales_review_all(){
      $affected1=['id'=>'All Service Need Review'];
      $affected=DB::SELECT('SELECT tecket_id as t_id,manager_id as manager_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
      ,ses_status as s_st FROM ticket_services 
      JOIN users on ticket_services.user_id=users.id
       JOIN currency on ticket_services.ses_cur_id=currency.cur_id
       JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
        WHERE service_status = 2 
        UNION 
            SELECT gen_id as t_id,manager_id as manager_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
      ,ses_status as s_st FROM general_services
       JOIN users on general_services.user_id=users.id
       JOIN currency on general_services.ses_cur_id=currency.cur_id
       JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
        WHERE service_status = 2
        UNION 
      SELECT bus_id as t_id,manager_id as manager_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
      ,ses_status as s_st FROM bus_services
        JOIN users on bus_services.user_id=users.id
       JOIN currency on bus_services.ses_cur_id=currency.cur_id
       JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
        WHERE service_status = 2 
        UNION 
      SELECT hotel_id as t_id,manager_id as manager_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
      ,ses_status as s_st FROM hotel_services 
       
        JOIN users on hotel_services.user_id=users.id
       JOIN currency on hotel_services.ses_cur_id=currency.cur_id
       JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
        WHERE service_status = 2
        UNION 
      SELECT visa_id as t_id,manager_id as manager_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
      ,ses_status as s_st FROM visa_services
        JOIN users on visa_services.user_id=users.id
       JOIN currency on visa_services.ses_cur_id=currency.cur_id
       JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
        WHERE service_status = 2 
        UNION 
      SELECT med_id as t_id,manager_id as manager_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
      ,ses_status as s_st FROM medical_services 
        JOIN users on medical_services.user_id=users.id
       JOIN currency on medical_services.ses_cur_id=currency.cur_id
       JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
        WHERE service_status = 2 
        UNION 
      SELECT car_id as t_id,manager_id as manager_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
       ,ses_status as s_st FROM car_services
       JOIN users on car_services.user_id=users.id
       JOIN currency on car_services.ses_cur_id=currency.cur_id
       JOIN suppliers on car_services.due_to_supp=suppliers.s_no
        WHERE service_status = 2 ');
                $affected3 =DB::select('select * from services WHERE services.is_active=1 and services.deleted=0');
                $affected4 =DB::select('SELECT * FROM suppliers WHERE suppliers.is_active=1 and suppliers.is_deleted=0');
                $affected5=DB::select('select ru.user_id as u_id ,GROUP_CONCAT(r.name) as roless,u.name as u_name 
                FROM role_user as ru 
                INNER JOIN roles as r on ru.role_id=r.id 
                INNER JOIN users as u on ru.user_id=u.id
                where ru.role_id in (2,3) and u.is_delete=0 and u.is_active=1 
                GROUP BY ru.user_id');
                $affected6 =DB::select('select * from currency where currency.is_active=1 ');
 
     return view('salesManagerView',['data'=>$affected,'data1'=>$affected1,'data3'=>$affected3,'data4'=>$affected4,'data5'=>$affected5,'data6'=>$affected6]);      
 
    
 }
 public function sales_finish_all($id){
   $affected1=['id'=>'all service status'];
   $affected=DB::SELECT('SELECT tecket_id as t_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
   ,ses_status as s_st,bill_num as bill FROM ticket_services 
   JOIN users on ticket_services.user_id=users.id
    JOIN currency on ticket_services.ses_cur_id=currency.cur_id
    JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
     WHERE service_status = 4 and manager_id='.$id.'
     UNION 
         SELECT gen_id as t_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
   ,ses_status as s_st,bill_num as bill FROM general_services
    JOIN users on general_services.user_id=users.id
    JOIN currency on general_services.ses_cur_id=currency.cur_id
    JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
     WHERE service_status = 4 and manager_id='.$id.'
     UNION 
   SELECT bus_id as t_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
   ,ses_status as s_st,bill_num as bill FROM bus_services
     JOIN users on bus_services.user_id=users.id
    JOIN currency on bus_services.ses_cur_id=currency.cur_id
    JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
     WHERE service_status = 4 and manager_id='.$id.'
     UNION 
   SELECT hotel_id as t_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
   ,ses_status as s_st,bill_num as bill FROM hotel_services 
     JOIN users on hotel_services.user_id=users.id
    JOIN currency on hotel_services.ses_cur_id=currency.cur_id
    JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
     WHERE service_status = 4 and manager_id='.$id.'
     UNION 
   SELECT visa_id as t_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
   ,ses_status as s_st,bill_num as bill FROM visa_services
     JOIN users on visa_services.user_id=users.id
    JOIN currency on visa_services.ses_cur_id=currency.cur_id
    JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
     WHERE service_status = 4 and manager_id='.$id.' 
     UNION 
   SELECT med_id as t_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
   ,ses_status as s_st ,bill_num as bill FROM medical_services 
     JOIN users on medical_services.user_id=users.id
    JOIN currency on medical_services.ses_cur_id=currency.cur_id
    JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
     WHERE service_status = 4 and manager_id='.$id.'
     UNION 
   SELECT car_id as t_id,passenger_name as t_pn,provider_cost as t_pc,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
    ,ses_status as s_st,bill_num as bill FROM car_services
    JOIN users on car_services.user_id=users.id
    JOIN currency on car_services.ses_cur_id=currency.cur_id
    JOIN suppliers on car_services.due_to_supp=suppliers.s_no
     WHERE service_status = 4 and manager_id='.$id.' ');
          
  return view('salesFinish',['data'=>$affected]);      

 
}
   public function ticket($id){      
      //ticket
      $affected =DB::select('SELECT * FROM `ticket_services` join users on ticket_services.user_id=users.id join airlines on ticket_services.airline_id=airlines.id join suppliers on ticket_services.due_to_supp=suppliers.s_no JOIN currency on ticket_services.ses_cur_id=currency.cur_id where tecket_id=:id',array($id));
     
         echo json_encode($affected);
         }
     
         public function bus($id){
           //bus
           $affected =DB::select('SELECT * FROM `bus_services` join users on bus_services.user_id=users.id join suppliers on bus_services.due_to_supp=suppliers.s_no JOIN currency on bus_services.ses_cur_id=currency.cur_id where bus_id=:id',array($id));
              echo json_encode($affected);
              }
              public function car($id){
                 //car
                 $affected =DB::select('SELECT * FROM `car_services` join users on car_services.user_id=users.id join suppliers on car_services.due_to_supp=suppliers.s_no JOIN currency on car_services.ses_cur_id=currency.cur_id where car_id=:id',array($id));
                    echo json_encode($affected);
                    }
         public function general($id){
                       //general
              $affected =DB::select('SELECT * FROM `general_services` join users on general_services.user_id=users.id join suppliers on general_services.due_to_supp=suppliers.s_no JOIN currency on general_services.ses_cur_id=currency.cur_id where gen_id=:id',array($id));
                          echo json_encode($affected);
                     } 
            public function medical($id){
                       //medical
              $affected =DB::select('SELECT * FROM `medical_services` join users on medical_services.user_id=users.id join suppliers on medical_services.due_to_supp=suppliers.s_no JOIN currency on medical_services.ses_cur_id=currency.cur_id where med_id=:id',array($id));
                          echo json_encode($affected);
                     }  
            public function hotel($id){
                       //hotel
              $affected =DB::select('SELECT * FROM `hotel_services` join users on hotel_services.user_id=users.id join suppliers on hotel_services.due_to_supp=suppliers.s_no JOIN currency on hotel_services.ses_cur_id=currency.cur_id where hotel_id=:id',array($id));
                          echo json_encode($affected);
                     }  
            public function visa($id){
                       //hotel
              $affected =DB::select('SELECT * FROM `visa_services` join users on visa_services.user_id=users.id join suppliers on visa_services.due_to_supp=suppliers.s_no JOIN currency on visa_services.ses_cur_id=currency.cur_id where visa_id=:id',array($id));
                          echo json_encode($affected);
                     }        
                     
                     public function sales_finish_by($id)
                     {  
                        $affected = DB::select('
                        SELECT
                        (SELECT COUNT(*) FROM ticket_services WHERE manager_id='.$id.' and service_status=4) as ticket, 
                        (SELECT COUNT(*) FROM bus_services WHERE manager_id='.$id.' and service_status=4) as bus,
                        (SELECT COUNT(*) FROM car_services WHERE manager_id='.$id.' and service_status=4) as car,
                         (SELECT COUNT(*) FROM hotel_services WHERE manager_id='.$id.' and service_status=4) as hotel, 
                        (SELECT COUNT(*) FROM visa_services WHERE manager_id='.$id.' and service_status=4) as visa,
                        (SELECT COUNT(*) FROM medical_services WHERE manager_id='.$id.' and service_status=4) as medical,
                        (SELECT COUNT(*) FROM general_services WHERE manager_id='.$id.' and service_status=4) as g');
                        echo json_encode($affected);
                     }                                    
/****************************display remark body *********************/  
public function display_remark_body($m,$s){
   $affected =DB::table('logs')->where([['service_id',$s],['main_servic_id',$m]])->select('remark_body')->get();

   $m= (explode("|",$affected));
   $mv=[];
   foreach($m as $mm)
   {
     $ss= explode(",",$mm);
     array_push($mv,$ss); 
      
   } 
   print_r($mv);  

}   
/****************************end display remark body **************************/  

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
     //$remark_body=$_SESSION['remark'];
     $out = implode("|",array_map(function($a) {
        return implode(",",$a);},$_SESSION['remark']));
     //print_r($out);
     $remark_body =$out;
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
   $update= BusService::where('bus_id',$service)->update(['service_status'=>1,'errorlog'=>1,'manager_id'=>$from]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesBusLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send error about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==3){
   $update= CarService::where('car_id',$service)->update(['service_status'=>1,'errorlog'=>1,'manager_id'=>$from]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesCarLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send error about CAR servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==1){
   $update= TicketService::where('tecket_id',$service)->update(['service_status'=>1,'errorlog'=>1,'manager_id'=>$from]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesTicketLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send error about TICKET servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==7){
   $update= GeneralService::where('gen_id',$service)->update(['service_status'=>1,'errorlog'=>1,'manager_id'=>$from]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesGenLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send error about GENERAL servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==4){
   $update= MedicalService::where('med_id',$service)->update(['service_status'=>1,'errorlog'=>1,'manager_id'=>$from]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesMedLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send error about MEDICAL servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==5){
   $update= HotelService::where('hotel_id',$service)->update(['service_status'=>1,'errorlog'=>1,'manager_id'=>$from]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesHotelLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send Error about HOTEL servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==6){
   $update= VisaService::where('visa_id',$service)->update(['service_status'=>1,'errorlog'=>1,'manager_id'=>$from]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesVisaLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send Error  about VISA servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
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
        /***************************service finished********************** */
        public function sales_finish($id,$user)
        { 
     if($id=='1'){
     //ticket
     $affected =TicketService::where([['service_status',4],['manager_id',$user]])
     ->join('currency','ticket_services.ses_cur_id','currency.cur_id')
     ->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
     ->join('users','ticket_services.user_id','users.id')
     ->select ('ticket_services.tecket_id as t_id' ,
     'ticket_services.service_id as st_id' ,
     'ticket_services.passenger_name as t_pn',
     'ticket_services.refernce as t_ref',
     'ticket_services.provider_cost as t_pc' ,
     'suppliers.supplier_name as s_name',
     'ticket_services.passnger_currency as u_name',
     'currency.cur_name as cur_n',
     'ticket_services.ticket_number as s_num' , 
     'ticket_services.bill_num as bill' ,
     'ticket_services.cost as cost',
     'ticket_services.Issue_date as t_idate') 
     ->paginate(10);
     $affected1=['id'=>'ticket'];
        }elseif($id=='2'){
            //bus
            $affected1=['id'=>'bus'];
            $affected =BusService::where([['service_status',4],['manager_id',$user]])
            ->join('currency','bus_services.ses_cur_id','currency.cur_id')
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
            'bus_services.passnger_currency as u_name',
            'currency.cur_name as cur_n',
            'bus_services.cost as cost',
            'bus_services.Issue_date as t_idate') 
            ->paginate(10);
            
               }elseif($id=='3'){
                 //bus
                 $affected1=['id'=>'car'];
                 $affected =CarService::where([['service_status',4],['manager_id',$user]])
                 ->join('currency','car_services.ses_cur_id','currency.cur_id')
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
                 'car_services.passnger_currency as u_name',
                 'currency.cur_name as cur_n',
                 'car_services.cost as cost',
                 'car_services.Issue_date as t_idate') 
                 ->paginate(10);
                 
                    }elseif($id=='7'){
                       $affected1=['id'=>'general'];
                       $affected =GeneralService::where([['service_status',4],['manager_id',$user]])
                       ->join('currency','general_services.ses_cur_id','currency.cur_id')
                       ->join('suppliers','general_services.due_to_supp','suppliers.s_no')
                       ->join('users','general_services.user_id','users.id')
                       ->select ('general_services.gen_id as t_id' ,
                       'general_services.passenger_name as t_pn',
                       'general_services.service_id as st_id' ,
                       'general_services.refernce as t_ref',
                       'general_services.provider_cost as t_pc' ,
                       'suppliers.supplier_name as s_name',
                       'general_services.voucher_number as s_num' ,
                       'general_services.passnger_currency as u_name',
                       'currency.cur_name as cur_n',
                       'general_services.bill_num as bill' ,
                       'general_services.user_id as uuser_resiver' ,
                       'general_services.cost as cost',
                       'general_services.Issue_date as t_idate') 
                       ->paginate(10);  
                   }elseif($id=='5'){
                    $affected1=['id'=>'hotel'];
                    $affected =HotelService::where([['service_status',4],['manager_id',$user]])
                    ->join('currency','hotel_services.ses_cur_id','currency.cur_id')
                    ->join('suppliers','hotel_services.due_to_supp','suppliers.s_no')
                    ->join('users','hotel_services.user_id','users.id')
                    ->select ('hotel_services.hotel_id as t_id' ,
                    'hotel_services.passenger_name as t_pn',
                    'hotel_services.service_id as st_id' ,
                    'hotel_services.refernce as t_ref',
                    'hotel_services.provider_cost as t_pc' ,
                    'suppliers.supplier_name as s_name',
                    'hotel_services.passnger_currency as u_name',
                    'currency.cur_name as cur_n',
                    'hotel_services.voucher_number as s_num' ,
                    'hotel_services.voucher_number as s_num' ,
                    'hotel_services.cost as cost',
                    'hotel_services.bill_num as bill' ,
                    'hotel_services.user_id as uuser_resiver' ,
                    'hotel_services.Issue_date as t_idate') 
                    ->paginate(10); 
                   }elseif($id=='6'){
                    $affected1=['id'=>'visa'];
                       $affected =VisaService::where([['service_status',4],['manager_id',$user]])
                       ->join('currency','visa_services.ses_cur_id','currency.cur_id')
                       ->join('suppliers','visa_services.due_to_supp','suppliers.s_no')
                       ->join('users','visa_services.user_id','users.id')
                       ->select ('visa_services.visa_id as t_id' ,
                       'visa_services.passenger_name as t_pn',
                       'visa_services.service_id as st_id' ,
                       'visa_services.refernce as t_ref',
                       'visa_services.provider_cost as t_pc' ,
                       'suppliers.supplier_name as s_name',
                       'visa_services.voucher_number as s_num' ,
                       'visa_services.passnger_currency as u_name',
                       'currency.cur_name as cur_n',
                       'visa_services.cost as cost',
                       'visa_services.user_id as uuser_resiver' ,
                       'visa_services.bill_num as bill' ,
                       'visa_services.Issue_date as t_idate') 
                       ->paginate(10); 
                   }elseif($id=='4'){
                    $affected1=['namme'=>'medical'];
                    $affected =MedicalService::where([['service_status',4],['manager_id',$user]])
                    ->join('currency','medical_services.ses_cur_id','currency.cur_id')
                    ->join('suppliers','medical_services.due_to_supp','suppliers.s_no')
                    ->join('users','medical_services.user_id','users.id')
                    ->select ('medical_services.med_id as t_id' ,
                    'medical_services.passenger_name as t_pn',
                    'medical_services.service_id as st_id' ,
                    'medical_services.user_id as uuser_resiver' ,
                    'medical_services.refernce as t_ref',
                    'medical_services.provider_cost as t_pc' ,
                    'suppliers.supplier_name as s_name',
                    'medical_services.passnger_currency as u_name',
                    'currency.cur_name as cur_n',
                    'medical_services.cost as cost',
                    'medical_services.document_number as s_num' ,
                    'medical_services.bill_num as bill' ,
                    'medical_services.Issue_date as t_idate') 
                    ->paginate(10);                 
                 }
        return view('salesFinish',['data'=>$affected,'data1'=>$affected1]);      
     
        }
/******************Sales Excutive finsh service************************************ */
public function excutive_finish($id,$user)
{ 
if($id=='1'){
//ticket
$affected =TicketService::where([['service_status',4],['user_id',$user]])
->join('currency','ticket_services.ses_cur_id','currency.cur_id')
->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
->join('users','ticket_services.user_id','users.id')
->select ('ticket_services.tecket_id as t_id' ,
'ticket_services.service_id as st_id' ,
'ticket_services.passenger_name as t_pn',
'ticket_services.refernce as t_ref',
'ticket_services.provider_cost as t_pc' ,
'suppliers.supplier_name as s_name',
'ticket_services.passnger_currency as u_name',
'currency.cur_name as cur_n',
'ticket_services.ticket_number as s_num' , 
'ticket_services.bill_num as bill' ,
'ticket_services.cost as cost',
'ticket_services.Issue_date as t_idate') 
->paginate(10);
$affected1=['id'=>'ticket'];
}elseif($id=='2'){
    //bus
    $affected1=['id'=>'bus'];
    $affected =BusService::where([['service_status',4],['user_id',$user]])
    ->join('currency','bus_services.ses_cur_id','currency.cur_id')
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
    'bus_services.passnger_currency as u_name',
    'currency.cur_name as cur_n',
    'bus_services.cost as cost',
    'bus_services.Issue_date as t_idate') 
    ->paginate(10);
    
       }elseif($id=='3'){
         //bus
         $affected1=['id'=>'car'];
         $affected =CarService::where([['service_status',4],['user_id',$user]])
         ->join('currency','car_services.ses_cur_id','currency.cur_id')
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
         'car_services.passnger_currency as u_name',
         'currency.cur_name as cur_n',
         'car_services.cost as cost',
         'car_services.Issue_date as t_idate') 
         ->paginate(10);
         
            }elseif($id=='7'){
               $affected1=['id'=>'general'];
               $affected =GeneralService::where([['service_status',4],['user_id',$user]])
               ->join('currency','general_services.ses_cur_id','currency.cur_id')
               ->join('suppliers','general_services.due_to_supp','suppliers.s_no')
               ->join('users','general_services.user_id','users.id')
               ->select ('general_services.gen_id as t_id' ,
               'general_services.passenger_name as t_pn',
               'general_services.service_id as st_id' ,
               'general_services.refernce as t_ref',
               'general_services.provider_cost as t_pc' ,
               'suppliers.supplier_name as s_name',
               'general_services.voucher_number as s_num' ,
               'general_services.passnger_currency as u_name',
               'currency.cur_name as cur_n',
               'general_services.bill_num as bill' ,
               'general_services.user_id as uuser_resiver' ,
               'general_services.cost as cost',
               'general_services.Issue_date as t_idate') 
               ->paginate(10);  
           }elseif($id=='5'){
            $affected1=['id'=>'hotel'];
            $affected =HotelService::where([['service_status',4],['user_id',$user]])
            ->join('currency','hotel_services.ses_cur_id','currency.cur_id')
            ->join('suppliers','hotel_services.due_to_supp','suppliers.s_no')
            ->join('users','hotel_services.user_id','users.id')
            ->select ('hotel_services.hotel_id as t_id' ,
            'hotel_services.passenger_name as t_pn',
            'hotel_services.service_id as st_id' ,
            'hotel_services.refernce as t_ref',
            'hotel_services.provider_cost as t_pc' ,
            'suppliers.supplier_name as s_name',
            'hotel_services.passnger_currency as u_name',
            'currency.cur_name as cur_n',
            'hotel_services.voucher_number as s_num' ,
            'hotel_services.voucher_number as s_num' ,
            'hotel_services.cost as cost',
            'hotel_services.bill_num as bill' ,
            'hotel_services.user_id as uuser_resiver' ,
            'hotel_services.Issue_date as t_idate') 
            ->paginate(10); 
           }elseif($id=='6'){
            $affected1=['id'=>'visa'];
               $affected =VisaService::where([['service_status',4],['user_id',$user]])
               ->join('currency','visa_services.ses_cur_id','currency.cur_id')
               ->join('suppliers','visa_services.due_to_supp','suppliers.s_no')
               ->join('users','visa_services.user_id','users.id')
               ->select ('visa_services.visa_id as t_id' ,
               'visa_services.passenger_name as t_pn',
               'visa_services.service_id as st_id' ,
               'visa_services.refernce as t_ref',
               'visa_services.provider_cost as t_pc' ,
               'suppliers.supplier_name as s_name',
               'visa_services.voucher_number as s_num' ,
               'visa_services.passnger_currency as u_name',
               'currency.cur_name as cur_n',
               'visa_services.cost as cost',
               'visa_services.user_id as uuser_resiver' ,
               'visa_services.bill_num as bill' ,
               'visa_services.Issue_date as t_idate') 
               ->paginate(10); 
           }elseif($id=='4'){
            $affected1=['namme'=>'medical'];
            $affected =MedicalService::where([['service_status',4],['user_id',$user]])
            ->join('currency','medical_services.ses_cur_id','currency.cur_id')
            ->join('suppliers','medical_services.due_to_supp','suppliers.s_no')
            ->join('users','medical_services.user_id','users.id')
            ->select ('medical_services.med_id as t_id' ,
            'medical_services.passenger_name as t_pn',
            'medical_services.service_id as st_id' ,
            'medical_services.user_id as uuser_resiver' ,
            'medical_services.refernce as t_ref',
            'medical_services.provider_cost as t_pc' ,
            'suppliers.supplier_name as s_name',
            'medical_services.passnger_currency as u_name',
            'currency.cur_name as cur_n',
            'medical_services.cost as cost',
            'medical_services.document_number as s_num' ,
            'medical_services.bill_num as bill' ,
            'medical_services.Issue_date as t_idate') 
            ->paginate(10);                 
         }
return view('salesFinish',['data'=>$affected,'data1'=>$affected1]);      

}
/*****************End ************************ */

        
   public function saved($service,$main,$number,$howaddit,$reciver){
      $message5="";
      $date1=date("Y/m/d") ;
      $date=now();
      if($main==1){
         $update= TicketService::where('tecket_id',$service)
         ->update([
         'service_status'=>3,
         'manager_id'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send  ticket servic number : '.$number.' to Accountent <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==2){
         $update= BusService::where('bus_id',$service)
         ->update([
         'service_status'=>3,
         'manager_id'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send  bus servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==3){
         $update= CarService::where('car_id',$service)
         ->update([
         'service_status'=>3,
        
         'manager_id'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send  car servic number : '.$number.' to Accountent <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      }elseif($main==7){
         $update= GeneralService::where('gen_id',$service)
         ->update([
         'service_status'=>3,
         'manager_id'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send  general servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==4){
         $update= MedicalService::where('med_id',$service)
         ->update([
         'service_status'=>3,
         'manager_id'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send  medical servic number : '.$number.' to Accountent <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==5){
         $update= HotelService::where('hotel_id',$service)
         ->update([
         'service_status'=>3,
         'manager_id'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send  medical servic number : '.$number.' to Accountent <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==6){
         $update= VisaService::where('visa_id',$service)
         ->update([
         'service_status'=>3,
         'manager_id'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/show_remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the Sales Manager send  visa servic number : '.$number.' to Accountent <span class=float-right text-muted text-sm>'.$date.'</span></a>';

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

   /*******************************report*********************** */
   public function report_desplay($id){
      $today_sales=DB::select('
      select
      ( select COUNT(*)  from ticket_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glot,
       (select COUNT(*) as s_my  from ticket_services where service_status=4 and manager_id='.$id.' and Issue_date=CURRENT_DATE()) as spet,
      ( select COUNT(*)  from bus_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glob,
       (select COUNT(*) as s_my  from bus_services where service_status=4 and manager_id='.$id.' and Issue_date=CURRENT_DATE()) as speb ,
      ( select COUNT(*)  from car_services where  service_status=4 and Issue_date=CURRENT_DATE()) as gloc,
       (select COUNT(*) as s_my  from car_services where service_status=4 and manager_id='.$id.' and Issue_date=CURRENT_DATE()) as spec,
      ( select COUNT(*)  from medical_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glom,
       (select COUNT(*) as s_my  from medical_services where service_status=4 and manager_id='.$id.' and Issue_date=CURRENT_DATE()) as spem, 
      ( select COUNT(*)  from hotel_services where  service_status=4 and Issue_date=CURRENT_DATE()) as gloh,
       (select COUNT(*) as s_my  from hotel_services where service_status=4 and manager_id='.$id.' and Issue_date=CURRENT_DATE()) as speh,
      ( select COUNT(*)  from visa_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glov,
       (select COUNT(*) as s_my  from visa_services where service_status=4 and manager_id='.$id.' and Issue_date=CURRENT_DATE()) as spev ,
      ( select COUNT(*)  from general_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glog,
       (select COUNT(*) as s_my  from general_services where service_status=4 and manager_id='.$id.' and Issue_date=CURRENT_DATE()) as speg');
       $week_sales=DB::select('
       select
       (select COUNT(*) from ticket_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spet,
       (select COUNT(*) from ticket_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glot,
         (select COUNT(*) from bus_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speb,
       (select COUNT(*) from bus_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glob,
         (select COUNT(*) from car_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spec,
       (select COUNT(*) from car_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as gloc,
         (select COUNT(*) from medical_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spem,
       (select COUNT(*) from medical_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glom,
         (select COUNT(*) from hotel_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speh,
       (select COUNT(*) from hotel_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as gloh,
         (select COUNT(*) from visa_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spev,
       (select COUNT(*) from visa_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glov,
         (select COUNT(*) from general_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speg,
       (select COUNT(*) from general_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glog
       ');
       $month_sales=DB::select('
       select
       (select COUNT(*) from ticket_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spet,
       (select COUNT(*) from ticket_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glot,
         (select COUNT(*) from bus_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speb,
       (select COUNT(*) from bus_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glob,
         (select COUNT(*) from car_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spec,
       (select COUNT(*) from car_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as gloc,
         (select COUNT(*) from medical_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spem,
       (select COUNT(*) from medical_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glom,
         (select COUNT(*) from hotel_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speh,
       (select COUNT(*) from hotel_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as gloh,
         (select COUNT(*) from visa_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spev,
       (select COUNT(*) from visa_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glov,
         (select COUNT(*) from general_services where service_status=4 and manager_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speg,
       (select COUNT(*) from general_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glog
       ');
       $all_sales=DB::select('
       select
       (select COUNT(*) from ticket_services where service_status=4 and manager_id='.$id.') as spet,
       (select COUNT(*) from ticket_services where service_status=4 ) as glot,
         (select COUNT(*) from bus_services where service_status=4 and manager_id='.$id.' ) as speb,
       (select COUNT(*) from bus_services where service_status=4 ) as glob,
         (select COUNT(*) from car_services where service_status=4 and manager_id='.$id.') as spec,
       (select COUNT(*) from car_services where service_status=4) as gloc,
         (select COUNT(*) from medical_services where service_status=4 and manager_id='.$id.') as spem,
       (select COUNT(*) from medical_services where service_status=4 ) as glom,
         (select COUNT(*) from hotel_services where service_status=4 and manager_id='.$id.') as speh,
       (select COUNT(*) from hotel_services where service_status=4 ) as gloh,
         (select COUNT(*) from visa_services where service_status=4 and manager_id='.$id.') as spev,
       (select COUNT(*) from visa_services where service_status=4 ) as glov,
         (select COUNT(*) from general_services where service_status=4 and manager_id='.$id.') as speg,
       (select COUNT(*) from general_services where service_status=4) as glog
       ');
   
    return view('sales_report',['today'=>$today_sales,
                                      'week'=>$week_sales,
                                      'month'=>$month_sales,
                                      'all'=>$all_sales,]);
   }
     }
     