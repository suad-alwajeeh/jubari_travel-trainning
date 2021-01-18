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
if(isset($_SESSION['filter'])){
}else{
    $_SESSION['filter']=array();    
}
class accountantController extends Controller
{
    public function accountant_view()
    {  
        //ticket
        $affectedt = DB::select('SELECT COUNT(*) as accountant FROM ticket_services WHERE service_status = 3');
        $affectedt1 = DB::select('SELECT COUNT(*) as finish FROM ticket_services WHERE service_status = 4');
        $affectedt2 = DB::select('SELECT COUNT(*) as ok FROM ticket_services WHERE service_status = 3 and  ticket_status=1');
        $affectedt3 = DB::select('SELECT COUNT(*) as issue FROM ticket_services WHERE  service_status = 3 and ticket_status=2');
        $affectedt4 = DB::select('SELECT COUNT(*) as void FROM ticket_services WHERE service_status = 3 and ticket_status=3');
        $affectedt5 = DB::select('SELECT COUNT(*) as refund FROM ticket_services WHERE service_status = 3 and ticket_status=4');

        //hotel
        $affectedh = DB::select('SELECT COUNT(*) as accountant FROM hotel_services WHERE service_status = 3');
        $affectedh1 = DB::select('SELECT COUNT(*) as finish FROM hotel_services WHERE service_status = 4');
        $affectedth2 = DB::select('SELECT COUNT(*) as ok FROM hotel_services WHERE service_status = 3 and  hotel_status=1');
        $affectedth3 = DB::select('SELECT COUNT(*) as issue FROM hotel_services WHERE service_status = 3 and  hotel_status=2');
        $affectedth4 = DB::select('SELECT COUNT(*) as void FROM hotel_services WHERE service_status = 3 and hotel_status=3');
        $affectedth5 = DB::select('SELECT COUNT(*) as refund FROM hotel_services WHERE service_status = 3 and hotel_status=4');
         //bus
         $affectedb = DB::select('SELECT COUNT(*) as accountant FROM bus_services WHERE service_status = 3');
         $affectedb1 = DB::select('SELECT COUNT(*) as finish FROM bus_services WHERE service_status = 4');
         $affectedtb2 = DB::select('SELECT COUNT(*) as ok FROM bus_services WHERE  service_status = 3 and bus_status=1');
         $affectedtb3 = DB::select('SELECT COUNT(*) as issue FROM bus_services WHERE service_status = 3 and  bus_status=2');
         $affectedtb4 = DB::select('SELECT COUNT(*) as void FROM bus_services WHERE service_status = 3 and bus_status=3');
         $affectedtb5 = DB::select('SELECT COUNT(*) as refund FROM bus_services WHERE service_status = 3 and bus_status=4');
         //car
         $affectedc = DB::select('SELECT COUNT(*) as accountant FROM car_services WHERE service_status = 3');
          $affectedc1 = DB::select('SELECT COUNT(*) as finish FROM car_services WHERE service_status = 4');
          $affectedtc2 = DB::select('SELECT COUNT(*) as ok FROM car_services WHERE  service_status = 3 and car_status=1');
          $affectedtc3 = DB::select('SELECT COUNT(*) as issue FROM car_services WHERE service_status = 3 and  car_status=2');
          $affectedtc4 = DB::select('SELECT COUNT(*) as void FROM car_services WHERE service_status = 3 and car_status=3');
          $affectedtc5 = DB::select('SELECT COUNT(*) as refund FROM car_services WHERE service_status = 3 and car_status=4');
                    //medical
        $affectedm = DB::select('SELECT COUNT(*) as accountant FROM medical_services WHERE service_status = 3');
        $affectedm1 = DB::select('SELECT COUNT(*) as finish FROM medical_services WHERE service_status = 4');
        $affectedtm2 = DB::select('SELECT COUNT(*) as ok FROM medical_services WHERE service_status = 3 and  report_status=1');
        $affectedtm3 = DB::select('SELECT COUNT(*) as issue FROM medical_services WHERE service_status = 3 and  report_status=2');
        $affectedtm4 = DB::select('SELECT COUNT(*) as void FROM medical_services WHERE service_status = 3 and report_status=3');
        $affectedtm5 = DB::select('SELECT COUNT(*) as refund FROM medical_services WHERE service_status = 3 and  report_status=4');
      
         //general
         $affectedg = DB::select('SELECT COUNT(*) as accountant FROM general_services WHERE service_status = 3');
         $affectedg1 = DB::select('SELECT COUNT(*) as finish FROM general_services WHERE  service_status = 4');
         $affectedtg2 = DB::select('SELECT COUNT(*) as ok FROM general_services WHERE service_status = 3 and  general_status=1');
         $affectedtg3 = DB::select('SELECT COUNT(*) as issue FROM general_services WHERE  service_status = 3 and general_status=2');
         $affectedtg4 = DB::select('SELECT COUNT(*) as void FROM general_services WHERE service_status = 3 and  general_status=3');
         $affectedtg5 = DB::select('SELECT COUNT(*) as refund FROM general_services WHERE  service_status = 3 and  general_status=4');
         //visa
         $affectedv = DB::select('SELECT COUNT(*) as accountant FROM visa_services WHERE service_status = 3');
         $affectedv1 = DB::select('SELECT COUNT(*) as finish FROM visa_services WHERE service_status = 4');
         $affectedtv2 = DB::select('SELECT COUNT(*) as ok FROM visa_services WHERE  service_status = 3 and visa_status=1');
         $affectedtv3 = DB::select('SELECT COUNT(*) as issue FROM visa_services WHERE service_status = 3 and  visa_status=2');
         $affectedtv4 = DB::select('SELECT COUNT(*) as void FROM visa_services WHERE service_status = 3 and visa_status=3');
         $affectedtv5 = DB::select('SELECT COUNT(*) as refund FROM visa_services WHERE service_status = 3 and  visa_status=4');
         $onlyl=DB::SELECT('SELECT tecket_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM ticket_services 
         JOIN users on ticket_services.user_id=users.id
          JOIN currency on ticket_services.cur_id=currency.cur_id
          JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
               SELECT gen_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM general_services
          JOIN users on general_services.user_id=users.id
          JOIN currency on general_services.cur_id=currency.cur_id
          JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT bus_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM bus_services
           JOIN users on bus_services.user_id=users.id
          JOIN currency on bus_services.cur_id=currency.cur_id
          JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT hotel_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
         ,service_status as s_st FROM hotel_services 
          
           JOIN users on hotel_services.user_id=users.id
          JOIN currency on hotel_services.cur_id=currency.cur_id
          JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT visa_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM visa_services
           JOIN users on visa_services.user_id=users.id
          JOIN currency on visa_services.cur_id=currency.cur_id
          JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT med_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM medical_services 
           JOIN users on medical_services.user_id=users.id
          JOIN currency on medical_services.cur_id=currency.cur_id
          JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT car_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
          ,service_status as s_st FROM car_services
          JOIN users on car_services.user_id=users.id
          JOIN currency on car_services.cur_id=currency.cur_id
          JOIN suppliers on car_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE() LIMIT 10');
       
         return view('accountant_view',['tic1'=>$affectedt,'tic2'=>$affectedt1,'tic3'=>$affectedt2,'tic4'=>$affectedt3,'tic5'=>$affectedt4,'tic6'=>$affectedt5,
                                         'bus1'=>$affectedb,'bus2'=>$affectedb1,'bus3'=>$affectedtb2,'bus4'=>$affectedtb3,'bus5'=>$affectedtb4,'bus6'=>$affectedtb5,
                                         'car1'=>$affectedc,'car2'=>$affectedc1,'car3'=>$affectedtc2,'car4'=>$affectedtc3,'car5'=>$affectedtc4,'car6'=>$affectedtc5,
                                         'hot1'=>$affectedh,'hot2'=>$affectedh1,'hot3'=>$affectedth2,'hot4'=>$affectedth3,'hot5'=>$affectedth4,'hot6'=>$affectedth5,
                                         'med1'=>$affectedm,'med2'=>$affectedm1,'med3'=>$affectedtm2,'med4'=>$affectedtm3,'med5'=>$affectedtm4,'med6'=>$affectedtm5,
                                         'gen1'=>$affectedg,'gen2'=>$affectedg1,'gen3'=>$affectedtg2,'gen4'=>$affectedtg3,'gen5'=>$affectedtg4,'gen6'=>$affectedtg5,
                                         'vis1'=>$affectedv,'vis2'=>$affectedv1,'vis3'=>$affectedtv2,'vis4'=>$affectedtv3,'vis5'=>$affectedtv4,'vis6'=>$affectedtv5,
                                         'latest'=>$onlyl ]);
    }
    public function accountant_review_all(){
         $affected1=['id'=>'all service status'];
         $affected=DB::SELECT('SELECT tecket_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM ticket_services 
         JOIN users on ticket_services.user_id=users.id
          JOIN currency on ticket_services.cur_id=currency.cur_id
          JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 
           UNION 
               SELECT gen_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM general_services
          JOIN users on general_services.user_id=users.id
          JOIN currency on general_services.cur_id=currency.cur_id
          JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
           WHERE service_status = 3
           UNION 
         SELECT bus_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM bus_services
           JOIN users on bus_services.user_id=users.id
          JOIN currency on bus_services.cur_id=currency.cur_id
          JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 
           UNION 
         SELECT hotel_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
         ,service_status as s_st FROM hotel_services 
          
           JOIN users on hotel_services.user_id=users.id
          JOIN currency on hotel_services.cur_id=currency.cur_id
          JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3
           UNION 
         SELECT visa_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM visa_services
           JOIN users on visa_services.user_id=users.id
          JOIN currency on visa_services.cur_id=currency.cur_id
          JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 
           UNION 
         SELECT med_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM medical_services 
           JOIN users on medical_services.user_id=users.id
          JOIN currency on medical_services.cur_id=currency.cur_id
          JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 
           UNION 
         SELECT car_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
          ,service_status as s_st FROM car_services
          JOIN users on car_services.user_id=users.id
          JOIN currency on car_services.cur_id=currency.cur_id
          JOIN suppliers on car_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 ');
                   $affected3 =DB::select('select * from services WHERE services.is_active=1 and services.deleted=0');
                   $affected4 =DB::select('SELECT * FROM suppliers WHERE suppliers.is_active=1 and suppliers.is_deleted=0');
                   $affected5=DB::select('select ru.user_id as u_id ,GROUP_CONCAT(r.name) as roless,u.name as u_name 
                   FROM role_user as ru 
                   INNER JOIN roles as r on ru.role_id=r.id 
                   INNER JOIN users as u on ru.user_id=u.id
                   where ru.role_id in (2,3) and u.is_delete=0 and u.is_active=1 
                   GROUP BY ru.user_id');
                   $affected6 =DB::select('select * from currency where currency.is_active=1 ');
    
        return view('accountant_review',['data'=>$affected,'data1'=>$affected1,'data3'=>$affected3,'data4'=>$affected4,'data5'=>$affected5,'data6'=>$affected6]);      
    
       
    }
    
    public function accountant_review($id)
    { if($id=='ticket'){
 //ticket
 $affected =TicketService::where('service_status',3)
 ->join('currency','ticket_services.cur_id','currency.cur_id')
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
 'ticket_services.provider_cost as tp_c' ,
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
        $affected =BusService::where('service_status',3)
        ->join('currency','bus_services.cur_id','currency.cur_id')
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
    $affected =CarService::where('service_status',3)
    ->join('currency','car_services.cur_id','currency.cur_id')
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
                  $affected =GeneralService::where('service_status',3)
                  ->join('currency','general_services.cur_id','currency.cur_id')
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
                  $affected =HotelService::where('service_status',3)
                  ->join('currency','hotel_services.cur_id','currency.cur_id')
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
                  $affected =VisaService::where('service_status',3)
                  ->join('currency','visa_services.cur_id','currency.cur_id')
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
                  $affected =MedicalService::where('service_status',3)
                  ->join('currency','medical_services.cur_id','currency.cur_id')
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

    return view('accountant_review',['data'=>$affected,'data1'=>$affected1,'data3'=>$affected3,'data4'=>$affected4,'data5'=>$affected5,'data6'=>$affected6]);      

    }

    /*************************************service need review with status************************************* */
    public function accountant_review_with_status($id,$type)
    { 
        if($id=='ticket'){
 //ticket
 $affected =TicketService::where([['service_status',3],['ticket_status',$type]])
 ->join('currency','ticket_services.cur_id','currency.cur_id')
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
 'ticket_services.provider_cost as tp_c' ,
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
        $affected =BusService::where([['service_status',3],['bus_status',$type]])
        ->join('currency','bus_services.cur_id','currency.cur_id')
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
    $affected =CarService::where([['service_status',3],['car_status',$type]])
    ->join('currency','car_services.cur_id','currency.cur_id')
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
                  $affected =GeneralService::where([['service_status',3],['offered_status',$type]])
                  ->join('currency','general_services.cur_id','currency.cur_id')
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
                  $affected =HotelService::where([['service_status',3],['hotel_status',$type]])
                  ->join('currency','hotel_services.cur_id','currency.cur_id')
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
                  $affected =VisaService::wherewhere([['service_status',3],['visa_status',$type]])
                  ->join('currency','visa_services.cur_id','currency.cur_id')
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
                  $affected =MedicalService::where([['service_status',3],['report_status',$type]])
                  ->join('currency','medical_services.cur_id','currency.cur_id')
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
               return view('accountant_review',['data'=>$affected,'data1'=>$affected1,'data3'=>$affected3,'data4'=>$affected4,'data5'=>$affected5,'data6'=>$affected6]);      

    }
    
    /******************************get one item******************************* */
    public function ticket($id){      
 //ticket
 $affected =DB::select('SELECT * FROM `ticket_services` join users on ticket_services.user_id=users.id join airlines on ticket_services.airline_id=airlines.id join suppliers on ticket_services.due_to_supp=suppliers.s_no JOIN currency on ticket_services.cur_id=currency.cur_id where tecket_id=:id',array($id));

    echo json_encode($affected);
    }

    public function bus($id){
      //bus
      $affected =DB::select('SELECT * FROM `bus_services` join users on bus_services.user_id=users.id join suppliers on bus_services.due_to_supp=suppliers.s_no JOIN currency on bus_services.cur_id=currency.cur_id where bus_id=:id',array($id));
         echo json_encode($affected);
         }
         public function car($id){
            //car
            $affected =DB::select('SELECT * FROM `car_services` join users on car_services.user_id=users.id join suppliers on car_services.due_to_supp=suppliers.s_no JOIN currency on car_services.cur_id=currency.cur_id where car_id=:id',array($id));
               echo json_encode($affected);
               }
    public function general($id){
                  //general
         $affected =DB::select('SELECT * FROM `general_services` join users on general_services.user_id=users.id join suppliers on general_services.due_to_supp=suppliers.s_no JOIN currency on general_services.cur_id=currency.cur_id where gen_id=:id',array($id));
                     echo json_encode($affected);
                } 
       public function medical($id){
                  //medical
         $affected =DB::select('SELECT * FROM `medical_services` join users on medical_services.user_id=users.id join suppliers on medical_services.due_to_supp=suppliers.s_no JOIN currency on medical_services.cur_id=currency.cur_id where med_id=:id',array($id));
                     echo json_encode($affected);
                }  
       public function hotel($id){
                  //hotel
         $affected =DB::select('SELECT * FROM `hotel_services` join users on hotel_services.user_id=users.id join suppliers on hotel_services.due_to_supp=suppliers.s_no JOIN currency on hotel_services.cur_id=currency.cur_id where hotel_id=:id',array($id));
                     echo json_encode($affected);
                }  
       public function visa($id){
                  //hotel
         $affected =DB::select('SELECT * FROM `visa_services` join users on visa_services.user_id=users.id join suppliers on visa_services.due_to_supp=suppliers.s_no JOIN currency on visa_services.cur_id=currency.cur_id where visa_id=:id',array($id));
                     echo json_encode($affected);
                }        
                
                
/******************************add remark******************************* */
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
   $update= GeneralService::where('gen_id',$service)->update(['service_status'=>2,'errorlog'=>1]);
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
   public function accountant_finish_by($id)
   {  
      $affected = DB::select('
      SELECT
      (SELECT COUNT(*) FROM ticket_services WHERE how_add_bill='.$id.' and service_status=4) as ticket, 
      (SELECT COUNT(*) FROM bus_services WHERE how_add_bill='.$id.' and service_status=4) as bus,
      (SELECT COUNT(*) FROM car_services WHERE how_add_bill='.$id.' and service_status=4) as car,
       (SELECT COUNT(*) FROM hotel_services WHERE how_add_bill='.$id.'11 and service_status=4) as hotel, 
      (SELECT COUNT(*) FROM visa_services WHERE how_add_bill='.$id.' and service_status=4) as visa,
      (SELECT COUNT(*) FROM medical_services WHERE how_add_bill='.$id.' and service_status=4) as medical,
      (SELECT COUNT(*) FROM general_services WHERE how_add_bill='.$id.' and service_status=4) as g');
      echo json_encode($affected);

   }
   public function accountant_finish_all($id){
      $affected1=['id'=>'all service status'];
      $affected=DB::SELECT('SELECT tecket_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
      ,service_status as s_st,bill_num as bill FROM ticket_services 
      JOIN users on ticket_services.user_id=users.id
       JOIN currency on ticket_services.cur_id=currency.cur_id
       JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
            SELECT gen_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
      ,service_status as s_st,bill_num as bill FROM general_services
       JOIN users on general_services.user_id=users.id
       JOIN currency on general_services.cur_id=currency.cur_id
       JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
      SELECT bus_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
      ,service_status as s_st,bill_num as bill FROM bus_services
        JOIN users on bus_services.user_id=users.id
       JOIN currency on bus_services.cur_id=currency.cur_id
       JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
      SELECT hotel_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
      ,service_status as s_st,bill_num as bill FROM hotel_services 
        JOIN users on hotel_services.user_id=users.id
       JOIN currency on hotel_services.cur_id=currency.cur_id
       JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
      SELECT visa_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
      ,service_status as s_st,bill_num as bill FROM visa_services
        JOIN users on visa_services.user_id=users.id
       JOIN currency on visa_services.cur_id=currency.cur_id
       JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.' 
        UNION 
      SELECT med_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
      ,service_status as s_st ,bill_num as bill FROM medical_services 
        JOIN users on medical_services.user_id=users.id
       JOIN currency on medical_services.cur_id=currency.cur_id
       JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
      SELECT car_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
       ,service_status as s_st,bill_num as bill FROM car_services
       JOIN users on car_services.user_id=users.id
       JOIN currency on car_services.cur_id=currency.cur_id
       JOIN suppliers on car_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.' ');
             
     return view('accountent_finish',['data'=>$affected]);      
 
    
 }
   public function accountant_finish($id,$user)
   { 
if($id=='1'){
//ticket
$affected =TicketService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
->join('currency','ticket_services.cur_id','currency.cur_id')
->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
->join('users','ticket_services.user_id','users.id')
->select ('ticket_services.tecket_id as t_id' ,
'ticket_services.service_id as st_id' ,
'ticket_services.ticket_status as s_st ',
'ticket_services.passenger_name as t_pn',
'ticket_services.refernce as t_ref',
'ticket_services.provider_cost as tp_c' ,
'suppliers.supplier_name as s_name',
'users.name as u_name',
'currency.cur_name as cur_n',
'ticket_services.ticket_number as s_num' , 
'ticket_services.bill_num as bill' ,
'ticket_services.cost as cost',
'ticket_services.Issue_date as t_idate') 
->paginate(25);
$affected1=['id'=>'ticket'];
   }elseif($id=='2'){
       //bus
       $affected1=['id'=>'bus'];
       $affected =BusService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
       ->join('currency','bus_services.cur_id','currency.cur_id')
       ->join('suppliers','bus_services.due_to_supp','suppliers.s_no')
       ->join('users','bus_services.user_id','users.id')
       ->select ('bus_services.bus_id as t_id' ,
       'bus_services.passenger_name as t_pn',
        'bus_services.service_id as st_id' ,
       'bus_services.refernce as t_ref',
       'bus_services.bus_status as s_st ',
       'bus_services.provider_cost as tp_c' ,
       'bus_services.bus_number as s_num' ,
       'bus_services.bill_num as bill' ,
       'suppliers.supplier_name as s_name',
       'users.name as u_name',
       'currency.cur_name as cur_n',
       'bus_services.cost as cost',
       'bus_services.Issue_date as t_idate') 
       ->paginate(25);
       
          }elseif($id=='3'){
            //bus
            $affected1=['id'=>'car'];
            $affected =CarService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
            ->join('currency','car_services.cur_id','currency.cur_id')
            ->join('suppliers','car_services.due_to_supp','suppliers.s_no')
            ->join('users','car_services.user_id','users.id')
            ->select ('car_services.car_id as t_id' ,
            'car_services.passenger_name as t_pn',
             'car_services.service_id as st_id' ,
            'car_services.refernce as t_ref',
            'car_services.provider_cost as tp_c' ,
            'car_services.voucher_number as s_num' ,
            'car_services.bill_num as bill' ,
            'car_services.car_status as s_st ',
            'suppliers.supplier_name as s_name',
            'users.name as u_name',
            'currency.cur_name as cur_n',
            'car_services.cost as cost',
            'car_services.Issue_date as t_idate') 
            ->paginate(25);
            
               }elseif($id=='7'){
                  $affected1=['id'=>'general'];
                  $affected =GeneralService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
                  ->join('currency','general_services.cur_id','currency.cur_id')
                  ->join('suppliers','general_services.due_to_supp','suppliers.s_no')
                  ->join('users','general_services.user_id','users.id')
                  ->select ('general_services.gen_id as t_id' ,
                  'general_services.passenger_name as t_pn',
                  'general_services.service_id as st_id' ,
                  'general_services.refernce as t_ref',
                  'general_services.provider_cost as tp_c' ,
                  'general_services.general_status as s_st ',
                  'suppliers.supplier_name as s_name',
                  'general_services.voucher_number as s_num' ,
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'general_services.bill_num as bill' ,
                  'general_services.user_id as uuser_resiver' ,
                  'general_services.cost as cost',
                  'general_services.Issue_date as t_idate') 
                  ->paginate(25);  
              }elseif($id=='5'){
               $affected1=['id'=>'hotel'];
               $affected =HotelService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
               ->join('currency','hotel_services.cur_id','currency.cur_id')
               ->join('suppliers','hotel_services.due_to_supp','suppliers.s_no')
               ->join('users','hotel_services.user_id','users.id')
               ->select ('hotel_services.hotel_id as t_id' ,
               'hotel_services.passenger_name as t_pn',
               'hotel_services.service_id as st_id' ,
               'hotel_services.refernce as t_ref',
               'hotel_services.provider_cost as tp_c' ,
               'suppliers.supplier_name as s_name',
               'users.name as u_name',
               'hotel_services.hotel_status as s_st ',
               'currency.cur_name as cur_n',
               'hotel_services.voucher_number as s_num' ,
               'hotel_services.voucher_number as s_num' ,
               'hotel_services.cost as cost',
               'hotel_services.bill_num as bill' ,
               'hotel_services.user_id as uuser_resiver' ,
               'hotel_services.Issue_date as t_idate') 
               ->paginate(25); 
              }elseif($id=='6'){
               $affected1=['id'=>'visa'];
                  $affected =VisaService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
                  ->join('currency','visa_services.cur_id','currency.cur_id')
                  ->join('suppliers','visa_services.due_to_supp','suppliers.s_no')
                  ->join('users','visa_services.user_id','users.id')
                  ->select ('visa_services.visa_id as t_id' ,
                  'visa_services.passenger_name as t_pn',
                  'visa_services.service_id as st_id' ,
                  'visa_services.refernce as t_ref',
                  'visa_services.provider_cost as tp_c' ,
                  'suppliers.supplier_name as s_name',
                  'visa_services.visa_status as s_st ',
                  'visa_services.voucher_number as s_num' ,
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'visa_services.cost as cost',
                  'visa_services.user_id as uuser_resiver' ,
                  'visa_services.bill_num as bill' ,
                  'visa_services.Issue_date as t_idate') 
                  ->paginate(25); 
              }elseif($id=='4'){
               $affected1=['namme'=>'medical'];
               $affected =MedicalService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
               ->join('currency','medical_services.cur_id','currency.cur_id')
               ->join('suppliers','medical_services.due_to_supp','suppliers.s_no')
               ->join('users','medical_services.user_id','users.id')
               ->select ('medical_services.med_id as t_id' ,
               'medical_services.passenger_name as t_pn',
               'medical_services.service_id as st_id' ,
               'medical_services.user_id as uuser_resiver' ,
               'medical_services.refernce as t_ref',
               'medical_services.provider_cost as tp_c' ,
               'suppliers.supplier_name as s_name',
               'users.name as u_name',
               'currency.cur_name as cur_n',
               'medical_services.cost as cost',
               'medical_services.report_status as s_st ',
               'medical_services.document_number as s_num' ,
               'medical_services.bill_num as bill' ,
               'medical_services.Issue_date as t_idate') 
               ->paginate(25);                 
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
/************************************do filter******************************** */
public function DISPLAY_FILTER1(){
  print_r($_SESSION['filter']);
 $ss="";
  IF(ARRAY_SEARCH('service_status',ARRAY_COLUMN($_SESSION['filter'],'col_name'))!==FALSE){
   foreach($_SESSION['filter'] as $index=>$column){
    foreach($column as $key=>$value){
        if($key=='col_name' && $value=="service_status"){
         $ss =" in ". $_SESSION['filter'][$index]['v'].' and';
        }
   }
   }
   foreach($_SESSION['filter'] as $index=>$column){
      foreach($column as $key=>$value){
          if($key=='col_name' && $value=="service_status"){
                $sp=array();
              $sp=$_SESSION['filter'];
              unset($sp[$index]);
              $_SESSION['filter']=$sp;
          }
     }
     }
}
echo $ss;
$a=implode(" and ",array_map(function($a) {
   return implode(" ",$a);},$_SESSION['filter']));
   echo $a;
   if($ss==""){
      $bus= 'where service_status=3 and '.$a;
      $ticket= 'where service_status=3 and '.$a;
      $hotel= 'where service_status=3 and '.$a;
      $car= 'where service_status=3 and '.$a;
      $visa= 'where service_status=3 and '.$a;
      $medical= 'where service_status=3 and '.$a;
      $general= 'where service_status=3 and '.$a;
   }else if($ss != ""){
      $bus= 'where bus_status=3 and bus_status '.$ss .' '.$a;
      $ticket= 'where  ticket_status=3 and bus_status '.$ss .' '.$a;
      $hotel= 'where service_status=3 and hotel_status  '.$ss .' '.$a;
      $car= 'where service_status=3 and car_status   '.$ss .' '.$a;
      $visa= 'where service_status=3 and visa_status  '.$ss .' '.$a;
      $medical= 'where service_status=3 and report_status  '.$ss .' '.$a;
      $general= 'where service_status=3 and offered_status  '.$ss .' '.$a;
   }
}
public function add_filer($col,$op,$v1){
   $v=$v1;
   if($col=='service_status'){
    $v='('.$v1.')';
    $item=array('col_name'=>$col,'op'=>$op,'v'=>$v);
      IF(ARRAY_SEARCH($col,ARRAY_COLUMN($_SESSION['filter'],'col_name'))!==FALSE){
         foreach($_SESSION['filter'] as $index=>$column){
          foreach($column as $key=>$value){
              if($key=='col_name' && $value==$col){
         $_SESSION['filter'][$index]['v']=$v;
              }
         }
         }
      }ELSE{
           array_push($_SESSION['filter'],$item);  	
      }
   }else{
      $item=array('col_name'=>$col,'op'=>$op,'v'=>$v);
      IF(ARRAY_SEARCH($col,ARRAY_COLUMN($_SESSION['filter'],'col_name'))!==FALSE){
         foreach($_SESSION['filter'] as $index=>$column){
          foreach($column as $key=>$value){
              if($key=='col_name' && $value==$col){
         $_SESSION['filter'][$index]['v']=$v;
              }
         }
         }
      }ELSE{
           array_push($_SESSION['filter'],$item);  	
      }
      }
    return $_SESSION['filter'];
   }
   
public function display_filter(){
   $ss="";
   IF(ARRAY_SEARCH('service_status',ARRAY_COLUMN($_SESSION['filter'],'col_name'))!==FALSE){
    foreach($_SESSION['filter'] as $index=>$column){
     foreach($column as $key=>$value){
         if($key=='col_name' && $value=="service_status"){
          $ss =" in ". $_SESSION['filter'][$index]['v'].' and';
         }
    }
    }
    foreach($_SESSION['filter'] as $index=>$column){
       foreach($column as $key=>$value){
           if($key=='col_name' && $value=="service_status"){
                 $sp=array();
               $sp=$_SESSION['filter'];
               unset($sp[$index]);
               $_SESSION['filter']=$sp;
           }
      }
      }
 }
 $a=implode(" and ",array_map(function($a) {
    return implode(" ",$a);},$_SESSION['filter']));
    if($ss==""){
       $bus= 'where service_status=3 and '.$a;
       $ticket= 'where service_status=3 and '.$a;
       $hotel= 'where service_status=3 and '.$a;
       $car= 'where service_status=3 and '.$a;
       $visa= 'where service_status=3 and '.$a;
       $medical= 'where service_status=3 and '.$a;
       $general= 'where service_status=3 and '.$a;
    }else if($ss != ""){
       $bus= 'where service_status=3 and bus_status '.$ss .' '.$a;
       $ticket= 'where  service_status=3 and bus_status '.$ss .' '.$a;
       $hotel= 'where service_status=3 and hotel_status  '.$ss .' '.$a;
       $car= 'where service_status=3 and car_status   '.$ss .' '.$a;
       $visa= 'where service_status=3 and visa_status  '.$ss .' '.$a;
       $medical= 'where service_status=3 and report_status  '.$ss .' '.$a;
       $general= 'where service_status=3 and offered_status  '.$ss .' '.$a;
    }
$onlyl=DB::SELECT('SELECT tecket_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM ticket_services 
         JOIN users on ticket_services.user_id=users.id
          JOIN currency on ticket_services.cur_id=currency.cur_id
          JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
          '.$ticket.'
           UNION 
               SELECT gen_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM general_services
          JOIN users on general_services.user_id=users.id
          JOIN currency on general_services.cur_id=currency.cur_id
          JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
           '.$general.'
           UNION 
         SELECT bus_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM bus_services
           JOIN users on bus_services.user_id=users.id
          JOIN currency on bus_services.cur_id=currency.cur_id
          JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
           '.$bus.'
           UNION 
         SELECT hotel_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
         ,service_status as s_st FROM hotel_services 
           JOIN users on hotel_services.user_id=users.id
          JOIN currency on hotel_services.cur_id=currency.cur_id
          JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
           '.$hotel.'
           UNION 
         SELECT visa_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM visa_services
           JOIN users on visa_services.user_id=users.id
          JOIN currency on visa_services.cur_id=currency.cur_id
          JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
           '.$visa.'
           UNION 
         SELECT med_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
         ,service_status as s_st FROM medical_services 
           JOIN users on medical_services.user_id=users.id
          JOIN currency on medical_services.cur_id=currency.cur_id
          JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
           '.$medical.'
           UNION 
         SELECT car_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
          ,service_status as s_st FROM car_services
          JOIN users on car_services.user_id=users.id
          JOIN currency on car_services.cur_id=currency.cur_id
          JOIN suppliers on car_services.due_to_supp=suppliers.s_no
           '.$car.'');
           echo json_encode($onlyl);
          /* $opps=[];
           $_SESSION['filter']=$opps;
           return  $_SESSION['filter'];*/
  }   
public function clear_session(){
   $opps=[];
   $_SESSION['filter']=$opps;
   return  $_SESSION['filter'];
}}
