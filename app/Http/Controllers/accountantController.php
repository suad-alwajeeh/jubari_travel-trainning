<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\role_user;
use App\User;
use App\users;
use Auth;
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
   $opps=[];
   $_SESSION['filter']=$opps;
   $item=array('col_name'=>'service_status','op'=>'=','v'=>'3');
   array_push($_SESSION['filter'],$item); 
}
if(isset($_SESSION['report'])){
}else{ 
   $opps=[];
   $_SESSION['report']=$opps;
   $item1=array('col_name'=>'service_status','op'=>'=','v'=>'4');
   array_push($_SESSION['report'],$item1); 
}
if(isset($_SESSION['report2'])){
}else{ 
   $opps=[];
   $_SESSION['report2']=$opps;
   $item1=array('col_name'=>'service_status','op'=>'=','v'=>'4');
   array_push($_SESSION['report2'],$item1); 
}
class accountantController extends Controller
{
   public function __constract(){
      $id=Auth::user()->id;
         $item2=array('col_name'=>'how_add_bill','op'=>'=','v'=>$id);
         array_push($_SESSION['report'],$item2); 
         array_push($_SESSION['report2'],$item2); 
   }
   
    public function accountant_view()
    {  
        //ticket
        $affectedt = DB::select('SELECT COUNT(*) as accountant FROM ticket_services WHERE service_status = 3');
        $affectedt1 = DB::select('SELECT COUNT(*) as finish FROM ticket_services WHERE service_status = 4');
        $affectedt2 = DB::select('SELECT COUNT(*) as ok FROM ticket_services WHERE service_status = 3 and  ses_status=1');
        $affectedt3 = DB::select('SELECT COUNT(*) as issue FROM ticket_services WHERE  service_status = 3 and ses_status=2');
        $affectedt4 = DB::select('SELECT COUNT(*) as void FROM ticket_services WHERE service_status = 3 and ses_status=3');
        $affectedt5 = DB::select('SELECT COUNT(*) as refund FROM ticket_services WHERE service_status = 3 and ses_status=4');

        //hotel
        $affectedh = DB::select('SELECT COUNT(*) as accountant FROM hotel_services WHERE service_status = 3');
        $affectedh1 = DB::select('SELECT COUNT(*) as finish FROM hotel_services WHERE service_status = 4');
        $affectedth2 = DB::select('SELECT COUNT(*) as ok FROM hotel_services WHERE service_status = 3 and  ses_status=1');
        $affectedth3 = DB::select('SELECT COUNT(*) as issue FROM hotel_services WHERE service_status = 3 and  ses_status=2');
        $affectedth4 = DB::select('SELECT COUNT(*) as void FROM hotel_services WHERE service_status = 3 and ses_status=3');
        $affectedth5 = DB::select('SELECT COUNT(*) as refund FROM hotel_services WHERE service_status = 3 and ses_status=4');
         //bus
         $affectedb = DB::select('SELECT COUNT(*) as accountant FROM bus_services WHERE service_status = 3');
         $affectedb1 = DB::select('SELECT COUNT(*) as finish FROM bus_services WHERE service_status = 4');
         $affectedtb2 = DB::select('SELECT COUNT(*) as ok FROM bus_services WHERE  service_status = 3 and ses_status=1');
         $affectedtb3 = DB::select('SELECT COUNT(*) as issue FROM bus_services WHERE service_status = 3 and  ses_status=2');
         $affectedtb4 = DB::select('SELECT COUNT(*) as void FROM bus_services WHERE service_status = 3 and ses_status=3');
         $affectedtb5 = DB::select('SELECT COUNT(*) as refund FROM bus_services WHERE service_status = 3 and ses_status=4');
         //car
         $affectedc = DB::select('SELECT COUNT(*) as accountant FROM car_services WHERE service_status = 3');
          $affectedc1 = DB::select('SELECT COUNT(*) as finish FROM car_services WHERE service_status = 4');
          $affectedtc2 = DB::select('SELECT COUNT(*) as ok FROM car_services WHERE  service_status = 3 and ses_status=1');
          $affectedtc3 = DB::select('SELECT COUNT(*) as issue FROM car_services WHERE service_status = 3 and  ses_status=2');
          $affectedtc4 = DB::select('SELECT COUNT(*) as void FROM car_services WHERE service_status = 3 and ses_status=3');
          $affectedtc5 = DB::select('SELECT COUNT(*) as refund FROM car_services WHERE service_status = 3 and ses_status=4');
                    //medical
        $affectedm = DB::select('SELECT COUNT(*) as accountant FROM medical_services WHERE service_status = 3');
        $affectedm1 = DB::select('SELECT COUNT(*) as finish FROM medical_services WHERE service_status = 4');
        $affectedtm2 = DB::select('SELECT COUNT(*) as ok FROM medical_services WHERE service_status = 3 and  ses_status=1');
        $affectedtm3 = DB::select('SELECT COUNT(*) as issue FROM medical_services WHERE service_status = 3 and  ses_status=2');
        $affectedtm4 = DB::select('SELECT COUNT(*) as void FROM medical_services WHERE service_status = 3 and ses_status=3');
        $affectedtm5 = DB::select('SELECT COUNT(*) as refund FROM medical_services WHERE service_status = 3 and  ses_status=4');
      
         //general
         $affectedg = DB::select('SELECT COUNT(*) as accountant FROM general_services WHERE service_status = 3');
         $affectedg1 = DB::select('SELECT COUNT(*) as finish FROM general_services WHERE  service_status = 4');
         $affectedtg2 = DB::select('SELECT COUNT(*) as ok FROM general_services WHERE service_status = 3 and  ses_status=1');
         $affectedtg3 = DB::select('SELECT COUNT(*) as issue FROM general_services WHERE  service_status = 3 and ses_status=2');
         $affectedtg4 = DB::select('SELECT COUNT(*) as void FROM general_services WHERE service_status = 3 and  ses_status=3');
         $affectedtg5 = DB::select('SELECT COUNT(*) as refund FROM general_services WHERE  service_status = 3 and  ses_status=4');
         //visa
         $affectedv = DB::select('SELECT COUNT(*) as accountant FROM visa_services WHERE service_status = 3');
         $affectedv1 = DB::select('SELECT COUNT(*) as finish FROM visa_services WHERE service_status = 4');
         $affectedtv2 = DB::select('SELECT COUNT(*) as ok FROM visa_services WHERE  service_status = 3 and ses_status=1');
         $affectedtv3 = DB::select('SELECT COUNT(*) as issue FROM visa_services WHERE service_status = 3 and  ses_status=2');
         $affectedtv4 = DB::select('SELECT COUNT(*) as void FROM visa_services WHERE service_status = 3 and ses_status=3');
         $affectedtv5 = DB::select('SELECT COUNT(*) as refund FROM visa_services WHERE service_status = 3 and  ses_status=4');
         $onlyl=DB::SELECT('SELECT tecket_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM ticket_services 
         JOIN users on ticket_services.user_id=users.id
          JOIN currency on ticket_services.ses_cur_id=currency.cur_id
          JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
               SELECT gen_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
               ,ses_status as s_st FROM general_services
          JOIN users on general_services.user_id=users.id
          JOIN currency on general_services.ses_cur_id=currency.cur_id
          JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT bus_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
         ,service_status as sst FROM bus_services
           JOIN users on bus_services.user_id=users.id
          JOIN currency on bus_services.ses_cur_id=currency.cur_id
          JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT hotel_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM hotel_services 
          
           JOIN users on hotel_services.user_id=users.id
          JOIN currency on hotel_services.ses_cur_id=currency.cur_id
          JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT visa_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM visa_services
           JOIN users on visa_services.user_id=users.id
          JOIN currency on visa_services.ses_cur_id=currency.cur_id
          JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT med_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM medical_services 
           JOIN users on medical_services.user_id=users.id
          JOIN currency on medical_services.ses_cur_id=currency.cur_id
          JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 and DATE(Issue_date)=CURRENT_DATE()
           UNION 
         SELECT car_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
          ,ses_status as s_st FROM car_services
          JOIN users on car_services.user_id=users.id
          JOIN currency on car_services.ses_cur_id=currency.cur_id
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
         $affected1=['id'=>'All Service Need Review'];
         $affected=DB::SELECT('SELECT tecket_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM ticket_services 
         JOIN users on ticket_services.user_id=users.id
          JOIN currency on ticket_services.ses_cur_id=currency.cur_id
          JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 
           UNION 
               SELECT gen_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM general_services
          JOIN users on general_services.user_id=users.id
          JOIN currency on general_services.ses_cur_id=currency.cur_id
          JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
           WHERE service_status = 3
           UNION 
         SELECT bus_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM bus_services
           JOIN users on bus_services.user_id=users.id
          JOIN currency on bus_services.ses_cur_id=currency.cur_id
          JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 
           UNION 
         SELECT hotel_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM hotel_services 
          
           JOIN users on hotel_services.user_id=users.id
          JOIN currency on hotel_services.ses_cur_id=currency.cur_id
          JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3
           UNION 
         SELECT visa_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM visa_services
           JOIN users on visa_services.user_id=users.id
          JOIN currency on visa_services.ses_cur_id=currency.cur_id
          JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 
           UNION 
         SELECT med_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM medical_services 
           JOIN users on medical_services.user_id=users.id
          JOIN currency on medical_services.ses_cur_id=currency.cur_id
          JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
           WHERE service_status = 3 
           UNION 
         SELECT car_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
          ,ses_status as s_st FROM car_services
          JOIN users on car_services.user_id=users.id
          JOIN currency on car_services.ses_cur_id=currency.cur_id
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
 ->join('currency','ticket_services.ses_cur_id','currency.cur_id')
 ->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
 ->join('users','ticket_services.user_id','users.id')
 ->join('airlines','ticket_services.airline_id','airlines.id')
 ->select ('ticket_services.tecket_id as t_id' ,
 'ticket_services.ses_status as s_st',
 'ticket_services.ticket_number as s_num' ,
 'ticket_services.manager_id as manager_id' ,
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
        ->join('currency','bus_services.ses_cur_id','currency.cur_id')
        ->join('suppliers','bus_services.due_to_supp','suppliers.s_no')
        ->join('users','bus_services.user_id','users.id')
        ->select ('bus_services.bus_id as t_id' ,
        'bus_services.passenger_name as t_pn',
         'bus_services.service_id as st_id' ,
         'bus_services.ses_status as s_st',
        'bus_services.refernce as t_ref',
        'bus_services.provider_cost as tp_c' ,
        'bus_services.manager_id as manager_id' ,
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
    ->join('currency','car_services.ses_cur_id','currency.cur_id')
    ->join('suppliers','car_services.due_to_supp','suppliers.s_no')
    ->join('users','car_services.user_id','users.id')
    ->select ('car_services.car_id as t_id' ,
    'car_services.passenger_name as t_pn',
    'car_services.ses_status as s_st',
     'car_services.service_id as st_id' ,
    'car_services.refernce as t_ref',
    'car_services.provider_cost as tp_c' ,
    'car_services.manager_id as manager_id' ,
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
                  ->join('currency','general_services.ses_cur_id','currency.cur_id')
                  ->join('suppliers','general_services.due_to_supp','suppliers.s_no')
                  ->join('users','general_services.user_id','users.id')
                  ->select ('general_services.gen_id as t_id' ,
                  'general_services.passenger_name as t_pn',
                  'general_services.service_id as st_id' ,
                  'general_services.refernce as t_ref',
                  'general_services.provider_cost as tp_c' ,
                  'general_services.manager_id as manager_id' ,
                  'suppliers.supplier_name as s_name',
                  'general_services.voucher_number as s_num' ,
                  'users.name as u_name',
                  'general_services.ses_status as s_st',
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
                  ->join('currency','hotel_services.ses_cur_id','currency.cur_id')
                  ->join('suppliers','hotel_services.due_to_supp','suppliers.s_no')
                  ->join('users','hotel_services.user_id','users.id')
                  ->select ('hotel_services.hotel_id as t_id' ,
                  'hotel_services.passenger_name as t_pn',
                  'hotel_services.service_id as st_id' ,
                  'hotel_services.refernce as t_ref',
                  'hotel_services.manager_id as manager_id' ,
                  'hotel_services.provider_cost as tp_c' ,
                  'suppliers.supplier_name as s_name',
                  'users.name as u_name',
                  'hotel_services.ses_status as s_st',
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
                  'visa_services.manager_id as manager_id' ,
                  'users.name as u_name',
                  'visa_services.ses_status as s_st',
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
                  ->join('currency','medical_services.ses_cur_id','currency.cur_id')
                  ->join('suppliers','medical_services.due_to_supp','suppliers.s_no')
                  ->join('users','medical_services.user_id','users.id')
                  ->select ('medical_services.med_id as t_id' ,
                  'medical_services.passenger_name as t_pn',
                  'medical_services.service_id as st_id' ,
                  'medical_services.ses_status as s_st',
                  'medical_services.user_id as uuser_resiver' ,
                  'medical_services.refernce as t_ref',
                  'medical_services.provider_cost as tp_c' ,
                  'suppliers.supplier_name as s_name',
                  'users.name as u_name',
                  'currency.cur_name as cur_n',
                  'medical_services.manager_id as manager_id' ,
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
 $affected =TicketService::where([['service_status',3],['ses_status',$type]])
 ->join('currency','ticket_services.ses_cur_id','currency.cur_id')
 ->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
 ->join('users','ticket_services.user_id','users.id')
 ->join('airlines','ticket_services.airline_id','airlines.id')
 ->select ('ticket_services.tecket_id as t_id' ,
 'ses_status as s_st',
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
 'ticket_services.manager_id as manager_id' ,
 'ticket_services.how_add_bookmark as bookmark_how',
 'ticket_services.cost as cost',
 'ticket_services.Issue_date as t_idate') 
 ->paginate(25);
 $affected1=['id'=>'ticket'];
    }elseif($id=='bus'){
        //bus
        $affected1=['id'=>'bus'];
        $affected =BusService::where([['service_status',3],['ses_status',$type]])
        ->join('currency','bus_services.ses_cur_id','currency.cur_id')
        ->join('suppliers','bus_services.due_to_supp','suppliers.s_no')
        ->join('users','bus_services.user_id','users.id')
        ->select ('bus_services.bus_id as t_id' ,
        'bus_services.passenger_name as t_pn',
         'bus_services.service_id as st_id' ,
         'ses_status as s_st',
         'bus_services.manager_id as manager_id' ,
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
    $affected =CarService::where([['service_status',3],['ses_status',$type]])
    ->join('currency','car_services.ses_cur_id','currency.cur_id')
    ->join('suppliers','car_services.due_to_supp','suppliers.s_no')
    ->join('users','car_services.user_id','users.id')
    ->select ('car_services.car_id as t_id' ,
    'car_services.passenger_name as t_pn',
    'ses_status as s_st',
     'car_services.service_id as st_id' ,
     'car_services.manager_id as manager_id' ,
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
                  $affected =GeneralService::where([['service_status',3],['ses_status',$type]])
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
                  'general_services.manager_id as manager_id' ,
                  'users.name as u_name',
                  'ses_status as s_st',
                  'currency.cur_name as cur_n',
                  'general_services.bookmark as bookmark',
                  'general_services.how_add_bookmark as bookmark_how',
                  'general_services.user_id as uuser_resiver' ,
                  'general_services.cost as cost',
                  'general_services.Issue_date as t_idate') 
                  ->paginate(25);  
               }elseif($id=='hotel'){
                  $affected1=['id'=>'hotel'];
                  $affected =HotelService::where([['service_status',3],['ses_status',$type]])
                  ->join('currency','hotel_services.ses_cur_id','currency.cur_id')
                  ->join('suppliers','hotel_services.due_to_supp','suppliers.s_no')
                  ->join('users','hotel_services.user_id','users.id')
                  ->select ('hotel_services.hotel_id as t_id' ,
                  'hotel_services.passenger_name as t_pn',
                  'hotel_services.service_id as st_id' ,
                  'hotel_services.refernce as t_ref',
                  'hotel_services.provider_cost as tp_c' ,
                  'hotel_services.manager_id as manager_id' ,
                  'suppliers.supplier_name as s_name',
                  'users.name as u_name',
                  'ses_status as s_st',
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
                  $affected =VisaService::where([['service_status',9],['ses_status',$type]])
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
                  'visa_services.ses_status as s_st',
                  'currency.cur_name as cur_n',
                  'visa_services.manager_id as manager_id' ,
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
                  'ses_status as s_st',
                  'medical_services.user_id as uuser_resiver' ,
                  'medical_services.refernce as t_ref',
                  'medical_services.provider_cost as tp_c' ,
                  'medical_services.manager_id as manager_id' ,
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

   public function send_remark($main,$service,$to,$from,$number,$manager){
      $message5="";
      $message55="";
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
   $update= BusService::where('bus_id',$service)->update(['service_status'=>1,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesBusLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==3){
   $update= CarService::where('car_id',$service)->update(['service_status'=>1,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesCarLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about CAR servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about CAR servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==1){
   $update= TicketService::where('tecket_id',$service)->update(['service_status'=>1,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesTicketLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about TICKET servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about TICKET servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==7){
   $update= GeneralService::where('gen_id',$service)->update(['service_status'=>1,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesGenLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==4){
   $update= MedicalService::where('med_id',$service)->update(['service_status'=>1,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesMedLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
}else  if($main==5){
   $update= HotelService::where('hotel_id',$service)->update(['service_status'=>1,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesHotelLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}else  if($main==6){
   $update= VisaService::where('visa_id',$service)->update(['service_status'=>1,'errorlog'=>1]);
   $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$to.') href=/salesVisaLog  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   unset($_SESSION['remark']);
}

$datav=['to'=>$to,'from'=>$from,'message'=> $message5,'date'=>$date];
$datam=['to'=>$manager,'from'=>$from,'message'=> $message55,'date'=>$date];
$date1=date("Y/m/d") ;
$message=$datav['message'];
$messagem=$datam['message'];
$executive=DB::table('notifications')->insert(
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
$manager=DB::table('notifications')->insert(
   ['sender' => $from, 
   'resiver' => $manager,
   'body'=>$messagem ,
   'status'=>0 ,
   'main_service'=>$main,
   'servic_id'=>$service,
   'created_at'=>$date,
   'updated_at'=>$date1,
   ]
);
$admin =DB::select('select users.id from users 
join role_user on users.id=role_user.user_id
 where users.is_active=1 and role_user.role_id=5'); 
 foreach($admin as $ad){
   $message555="";
   $message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$from.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send remark about bus servic number : '.$number.' <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $dataa=['to'=>$ad->id,'from'=>$howaddit,'message'=> $message555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $howaddit, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>$main,
      'servic_id'=>$service,
      'created_at'=>$date,
      'updated_at'=>$date1,
      ]
   );
   event(new MyEvent($dataa));

 }
event(new MyEvent($datav));
event(new MyEvent($datam));
return "Event has been sent!";
unset($_SESSION['remark']);

   }
/***************************bill number ********************** */
public function admin(){
   $admin =DB::select('select users.id from users 
   join role_user on users.id=role_user.user_id
    where users.is_active=1 and role_user.role_id=5');
    foreach($admin as $ad){
        echo $ad->id;
    }
}
   public function bill_num($service,$main,$bill_num,$howaddit,$reciver,$number,$manager){
        
       $message5="";
       $message55="";
       $date1=date("Y/m/d") ;
      $date=now();
      if($main==1){
         $update= TicketService::where('tecket_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/service/show_ticket/4 class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$manager.') href=/manager_finish/1/'.$manager.' class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==2){
         $update= BusService::where('bus_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/service/show_bus/4  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  bus servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$manager.') href=/manager_finish/2/'.$manager.' class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==3){
         $update= CarService::where('car_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/service/show_car/4 class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  car servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$manager.') href=/manager_finish/3/'.$manager.' class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      }elseif($main==7){
         $update= GeneralService::where('gen_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/service/show_general/4  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  general servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$manager.') href=/manager_finish/7/'.$manager.' class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      }elseif($main==4){
         $update= MedicalService::where('med_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/service/show_medical/4  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  medical servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$manager.') href=/manager_finish/4/'.$manager.' class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==5){
         $update= HotelService::where('hotel_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/service/show_hotel/4 class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  medical servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$manager.') href=/manager_finish/5/'.$manager.' class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }elseif($main==6){
         $update= VisaService::where('visa_id',$service)
         ->update([
         'service_status'=>4,
         'bill_num'=>$bill_num,
         'how_add_bill'=>$howaddit,
         ]);
         $message5='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$reciver.') href=/service/show_visa/4  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  visa servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $message55='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$manager.') href=/manager_finish/6/'.$manager.' class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';

      }

      $datav=['to'=>$reciver,'from'=>$howaddit,'message'=> $message5,'date'=>$date];
      $datam=['to'=>$manager,'from'=>$howaddit,'message'=> $message55,'date'=>$date];
      $message=$datav['message'];
      $messagem=$datam['message'];
      $executive=DB::table('notifications')->insert(
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
      $manager=DB::table('notifications')->insert(
         ['sender' => $howaddit, 
         'resiver' => $manager,
         'body'=>$messagem ,
         'status'=>0 ,
         'main_service'=>$main,
         'servic_id'=>$service,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      $admin =DB::select('select users.id from users 
      join role_user on users.id=role_user.user_id
       where users.is_active=1 and role_user.role_id=5'); 
       foreach($admin as $ad){
         $message555="";
         $message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$service.'",'.$howaddit.','.$ad->id.') href=/remark class=dropdown-item><i class=text-danger fas fa-times mr-2></i>the accountent send  ticket servic number : '.$number.' to archive <span class=float-right text-muted text-sm>'.$date.'</span></a>';
          $dataa=['to'=>$ad->id,'from'=>$howaddit,'message'=> $message555,'date'=>$date];
         $messagea=$dataa['message'];
         $admin_notify=DB::table('notifications')->insert(
            ['sender' => $howaddit, 
            'resiver' => $ad->id,
            'body'=>$messagea ,
            'status'=>0 ,
            'main_service'=>$main,
            'servic_id'=>$service,
            'created_at'=>$date,
            'updated_at'=>$date1,
            ]
         );
         event(new MyEvent($dataa));

       }
      event(new MyEvent($datav));
      event(new MyEvent($datam));
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
       (SELECT COUNT(*) FROM hotel_services WHERE how_add_bill='.$id.' and service_status=4) as hotel, 
      (SELECT COUNT(*) FROM visa_services WHERE how_add_bill='.$id.' and service_status=4) as visa,
      (SELECT COUNT(*) FROM medical_services WHERE how_add_bill='.$id.' and service_status=4) as medical,
      (SELECT COUNT(*) FROM general_services WHERE how_add_bill='.$id.' and service_status=4) as g');
      echo json_encode($affected);

   }
   public function accountant_finish_all($id){
      $affected1=['id'=>'all service status'];
      $affected=DB::SELECT('SELECT tecket_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
      ,ses_status as s_st,bill_num as bill FROM ticket_services 
      JOIN users on ticket_services.user_id=users.id
       JOIN currency on ticket_services.ses_cur_id=currency.cur_id
       JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
            SELECT gen_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
      ,ses_status as s_st,bill_num as bill FROM general_services
       JOIN users on general_services.user_id=users.id
       JOIN currency on general_services.ses_cur_id=currency.cur_id
       JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
      SELECT bus_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
      ,ses_status as s_st,bill_num as bill FROM bus_services
        JOIN users on bus_services.user_id=users.id
       JOIN currency on bus_services.ses_cur_id=currency.cur_id
       JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
      SELECT hotel_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
      ,ses_status as s_st,bill_num as bill FROM hotel_services 
        JOIN users on hotel_services.user_id=users.id
       JOIN currency on hotel_services.ses_cur_id=currency.cur_id
       JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
      SELECT visa_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
      ,ses_status as s_st,bill_num as bill FROM visa_services
        JOIN users on visa_services.user_id=users.id
       JOIN currency on visa_services.ses_cur_id=currency.cur_id
       JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.' 
        UNION 
      SELECT med_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
      ,ses_status as s_st ,bill_num as bill FROM medical_services 
        JOIN users on medical_services.user_id=users.id
       JOIN currency on medical_services.ses_cur_id=currency.cur_id
       JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.'
        UNION 
      SELECT car_id as t_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
       ,ses_status as s_st,bill_num as bill FROM car_services
       JOIN users on car_services.user_id=users.id
       JOIN currency on car_services.ses_cur_id=currency.cur_id
       JOIN suppliers on car_services.due_to_supp=suppliers.s_no
        WHERE service_status = 4 and how_add_bill='.$id.' ');
             
     return view('accountent_finish',['data'=>$affected]);      
 
    
 }
   public function accountant_finish($id,$user)
   { 
if($id=='1'){
//ticket
$affected =TicketService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
->join('currency','ticket_services.ses_cur_id','currency.cur_id')
->join('suppliers','ticket_services.due_to_supp','suppliers.s_no')
->join('users','ticket_services.user_id','users.id')
->select ('ticket_services.tecket_id as t_id' ,
'ticket_services.service_id as st_id' ,
'ticket_services.ses_status as s_st',
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
       ->join('currency','bus_services.ses_cur_id','currency.cur_id')
       ->join('suppliers','bus_services.due_to_supp','suppliers.s_no')
       ->join('users','bus_services.user_id','users.id')
       ->select ('bus_services.bus_id as t_id' ,
       'bus_services.passenger_name as t_pn',
        'bus_services.service_id as st_id' ,
       'bus_services.refernce as t_ref',
       'bus_services.ses_status as s_st',
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
            ->join('currency','car_services.ses_cur_id','currency.cur_id')
            ->join('suppliers','car_services.due_to_supp','suppliers.s_no')
            ->join('users','car_services.user_id','users.id')
            ->select ('car_services.car_id as t_id' ,
            'car_services.passenger_name as t_pn',
             'car_services.service_id as st_id' ,
            'car_services.refernce as t_ref',
            'car_services.provider_cost as tp_c' ,
            'car_services.voucher_number as s_num' ,
            'car_services.bill_num as bill' ,
            'car_services.ses_status as s_st',
            'suppliers.supplier_name as s_name',
            'users.name as u_name',
            'currency.cur_name as cur_n',
            'car_services.cost as cost',
            'car_services.Issue_date as t_idate') 
            ->paginate(25);
            
               }elseif($id=='7'){
                  $affected1=['id'=>'general'];
                  $affected =GeneralService::where([['service_status',4],['how_add_bill',$user],['errorlog',0]])
                  ->join('currency','general_services.ses_cur_id','currency.cur_id')
                  ->join('suppliers','general_services.due_to_supp','suppliers.s_no')
                  ->join('users','general_services.user_id','users.id')
                  ->select ('general_services.gen_id as t_id' ,
                  'general_services.passenger_name as t_pn',
                  'general_services.service_id as st_id' ,
                  'general_services.refernce as t_ref',
                  'general_services.provider_cost as tp_c' ,
                  'general_services.ses_status as s_st',
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
               'hotel_services.ses_status as s_st',
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
                  ->join('currency','visa_services.ses_cur_id','currency.cur_id')
                  ->join('suppliers','visa_services.due_to_supp','suppliers.s_no')
                  ->join('users','visa_services.user_id','users.id')
                  ->select ('visa_services.visa_id as t_id' ,
                  'visa_services.passenger_name as t_pn',
                  'visa_services.service_id as st_id' ,
                  'visa_services.refernce as t_ref',
                  'visa_services.provider_cost as tp_c' ,
                  'suppliers.supplier_name as s_name',
                  'visa_services.ses_status as s_st',
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
               ->join('currency','medical_services.ses_cur_id','currency.cur_id')
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
               'medical_services.ses_status as s_st',
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
 // print_r($_SESSION['filter']);
 $ss="";
  IF(ARRAY_SEARCH('filter_m_ser',ARRAY_COLUMN($_SESSION['filter'],'col_name'))!==FALSE){
   foreach($_SESSION['filter'] as $index=>$column){
    foreach($column as $key=>$value){
        if($key=='col_name' && $value=="filter_m_ser"){
         $ss= $_SESSION['filter'][$index]['v'];
        }
   }
   }
   foreach($_SESSION['filter'] as $index=>$column){
      foreach($column as $key=>$value){
          if($key=='col_name' && $value=="filter_m_ser"){
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
  
}
public function add_filer($col,$op,$v1){
   $v=$v1;
  
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
    return $_SESSION['filter'];
   }
   
public function display_filter($m){ 
 /*  IF(ARRAY_SEARCH('filter_m_ser',ARRAY_COLUMN($_SESSION['filter'],'col_name'))!==FALSE){
    foreach($_SESSION['filter'] as $index=>$column){
     foreach($column as $key=>$value){
         if($key=='col_name' && $value=="filter_m_ser"){
          $ss= $_SESSION['filter'][$index]['v'];
         }
    }
    }
    foreach($_SESSION['filter'] as $index=>$column){
       foreach($column as $key=>$value){
           if($key=='col_name' && $value=="filter_m_ser"){
                 $sp=array();
               $sp=$_SESSION['filter'];
               unset($sp[$index]);
               $_SESSION['filter']=$sp;
           }
      }
      }
 }
 echo $ss;*/
 $a=implode(" and ",array_map(function($a) {
    return implode(" ",$a);},$_SESSION['filter']));
   if($m==0){
$onlyl=DB::SELECT('SELECT tecket_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM ticket_services 
         JOIN users on ticket_services.user_id=users.id
          JOIN currency on ticket_services.ses_cur_id=currency.cur_id
          JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
          where  '.$a.'
           UNION 
               SELECT gen_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM general_services
          JOIN users on general_services.user_id=users.id
          JOIN currency on general_services.ses_cur_id=currency.cur_id
          JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
          where  '.$a.'
           UNION 
         SELECT bus_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM bus_services
           JOIN users on bus_services.user_id=users.id
          JOIN currency on bus_services.ses_cur_id=currency.cur_id
          JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
          where  '.$a.'
           UNION 
         SELECT hotel_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM hotel_services 
           JOIN users on hotel_services.user_id=users.id
          JOIN currency on hotel_services.ses_cur_id=currency.cur_id
          JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
          where  '.$a.'
           UNION 
         SELECT visa_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM visa_services
           JOIN users on visa_services.user_id=users.id
          JOIN currency on visa_services.ses_cur_id=currency.cur_id
          JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
          where  '.$a.'
           UNION 
         SELECT med_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM medical_services 
           JOIN users on medical_services.user_id=users.id
          JOIN currency on medical_services.ses_cur_id=currency.cur_id
          JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
          where  '.$a.'
           UNION 
         SELECT car_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
          ,ses_status as s_st FROM car_services
          JOIN users on car_services.user_id=users.id
          JOIN currency on car_services.ses_cur_id=currency.cur_id
          JOIN suppliers on car_services.due_to_supp=suppliers.s_no
          where  '.$a.'
          ');
   }else if($m==1){
      $onlyl=DB::SELECT('SELECT tecket_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
               ,ses_status as s_st FROM ticket_services 
               JOIN users on ticket_services.user_id=users.id
                JOIN currency on ticket_services.ses_cur_id=currency.cur_id
                JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
                where  '.$a.'');
                }else if($m==2){
      $onlyl=DB::SELECT('SELECT bus_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
      ,ses_status as s_st FROM bus_services
        JOIN users on bus_services.user_id=users.id
       JOIN currency on bus_services.ses_cur_id=currency.cur_id
       JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
       where  '.$a.'');
       }else if($m==3){
         $onlyl=DB::SELECT(' SELECT car_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
         ,ses_status as s_st FROM car_services
         JOIN users on car_services.user_id=users.id
         JOIN currency on car_services.ses_cur_id=currency.cur_id
         JOIN suppliers on car_services.due_to_supp=suppliers.s_no
         where  '.$a.'');
          }else if($m==4){
            $onlyl=DB::SELECT('SELECT med_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
            ,ses_status as s_st FROM medical_services 
              JOIN users on medical_services.user_id=users.id
             JOIN currency on medical_services.ses_cur_id=currency.cur_id
             JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
             where  '.$a.'');
             }else if($m==5){
               $onlyl=DB::SELECT('SELECT hotel_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
               ,ses_status as s_st FROM hotel_services 
                 JOIN users on hotel_services.user_id=users.id
                JOIN currency on hotel_services.ses_cur_id=currency.cur_id
                JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
                where  '.$a.'');
                }else if($m==6){
                  $onlyl=DB::SELECT('SELECT visa_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
                  ,ses_status as s_st FROM visa_services
                    JOIN users on visa_services.user_id=users.id
                   JOIN currency on visa_services.ses_cur_id=currency.cur_id
                   JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
                   where  '.$a.'');
                   }else if($m==7){
                     $onlyl=DB::SELECT(' SELECT gen_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
                     ,ses_status as s_st FROM general_services
                      JOIN users on general_services.user_id=users.id
                      JOIN currency on general_services.ses_cur_id=currency.cur_id
                      JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
                      where  '.$a.'');
                      }else{
      echo "kkkk";
   }
           echo json_encode($onlyl);
          $this->clear_session();
  }   
public function clear_session(){
   $opps=[];
   $_SESSION['filter']=$opps;
   $item=array('col_name'=>'service_status','op'=>'=','v'=>'3');
   array_push($_SESSION['filter'],$item);  
   return  $_SESSION['filter'];
}
/*******************************REPORTS ^_^ REPORT************************** */
public function report_desplay(){
   $id=Auth::user()->id ;
   $today_sales=DB::select('
   select
   ( select COUNT(*)  from ticket_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glot,
    (select COUNT(*) as s_my  from ticket_services where service_status=4 and how_add_bill='.$id.' and Issue_date=CURRENT_DATE()) as spet,
   ( select COUNT(*)  from bus_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glob,
    (select COUNT(*) as s_my  from bus_services where service_status=4 and how_add_bill='.$id.' and Issue_date=CURRENT_DATE()) as speb ,
   ( select COUNT(*)  from car_services where  service_status=4 and Issue_date=CURRENT_DATE()) as gloc,
    (select COUNT(*) as s_my  from car_services where service_status=4 and how_add_bill='.$id.' and Issue_date=CURRENT_DATE()) as spec,
   ( select COUNT(*)  from medical_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glom,
    (select COUNT(*) as s_my  from medical_services where service_status=4 and how_add_bill='.$id.' and Issue_date=CURRENT_DATE()) as spem, 
   ( select COUNT(*)  from hotel_services where  service_status=4 and Issue_date=CURRENT_DATE()) as gloh,
    (select COUNT(*) as s_my  from hotel_services where service_status=4 and how_add_bill='.$id.' and Issue_date=CURRENT_DATE()) as speh,
   ( select COUNT(*)  from visa_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glov,
    (select COUNT(*) as s_my  from visa_services where service_status=4 and how_add_bill='.$id.' and Issue_date=CURRENT_DATE()) as spev ,
   ( select COUNT(*)  from general_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glog,
    (select COUNT(*) as s_my  from general_services where service_status=4 and how_add_bill='.$id.' and Issue_date=CURRENT_DATE()) as speg');
    $week_sales=DB::select('
    select
    (select COUNT(*) from ticket_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spet,
    (select COUNT(*) from ticket_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glot,
      (select COUNT(*) from bus_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speb,
    (select COUNT(*) from bus_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glob,
      (select COUNT(*) from car_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spec,
    (select COUNT(*) from car_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as gloc,
      (select COUNT(*) from medical_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spem,
    (select COUNT(*) from medical_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glom,
      (select COUNT(*) from hotel_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speh,
    (select COUNT(*) from hotel_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as gloh,
      (select COUNT(*) from visa_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spev,
    (select COUNT(*) from visa_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glov,
      (select COUNT(*) from general_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speg,
    (select COUNT(*) from general_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glog
    ');
    $month_sales=DB::select('
    select
    (select COUNT(*) from ticket_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spet,
    (select COUNT(*) from ticket_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glot,
      (select COUNT(*) from bus_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speb,
    (select COUNT(*) from bus_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glob,
      (select COUNT(*) from car_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spec,
    (select COUNT(*) from car_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as gloc,
      (select COUNT(*) from medical_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spem,
    (select COUNT(*) from medical_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glom,
      (select COUNT(*) from hotel_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speh,
    (select COUNT(*) from hotel_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as gloh,
      (select COUNT(*) from visa_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spev,
    (select COUNT(*) from visa_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glov,
      (select COUNT(*) from general_services where service_status=4 and how_add_bill='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speg,
    (select COUNT(*) from general_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glog
    ');
    $all_sales=DB::select('
    select
    (select COUNT(*) from ticket_services where service_status=4 and how_add_bill='.$id.') as spet,
    (select COUNT(*) from ticket_services where service_status=4 ) as glot,
      (select COUNT(*) from bus_services where service_status=4 and how_add_bill='.$id.' ) as speb,
    (select COUNT(*) from bus_services where service_status=4 ) as glob,
      (select COUNT(*) from car_services where service_status=4 and how_add_bill='.$id.') as spec,
    (select COUNT(*) from car_services where service_status=4) as gloc,
      (select COUNT(*) from medical_services where service_status=4 and how_add_bill='.$id.') as spem,
    (select COUNT(*) from medical_services where service_status=4 ) as glom,
      (select COUNT(*) from hotel_services where service_status=4 and how_add_bill='.$id.') as speh,
    (select COUNT(*) from hotel_services where service_status=4 ) as gloh,
      (select COUNT(*) from visa_services where service_status=4 and how_add_bill='.$id.') as spev,
    (select COUNT(*) from visa_services where service_status=4 ) as glov,
      (select COUNT(*) from general_services where service_status=4 and how_add_bill='.$id.') as speg,
    (select COUNT(*) from general_services where service_status=4) as glog
    ');
   
    $saleByCurrpassnger=DB::select('
    SELECT
(SELECT COUNT(tecket_id) AS counter FROM ticket_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as tu ,
(SELECT SUM(cost) AS cost  FROM ticket_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as tuc  ,
(SELECT COUNT(tecket_id) AS counter FROM ticket_services  where  `passnger_currency`="USD" and service_status=4 )as tt,
(SELECT SUM(cost) AS cost  FROM ticket_services  where  `passnger_currency`="USD" and service_status=4 )as ttc,
(SELECT COUNT(tecket_id) AS counter FROM ticket_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as tu2 ,
(SELECT SUM(cost) AS cost  FROM ticket_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as tuc2  ,
(SELECT COUNT(tecket_id) AS counter FROM ticket_services  where  `passnger_currency`="YER" and service_status=4 )as tt2,
(SELECT SUM(cost) AS cost  FROM ticket_services  where  `passnger_currency`="YER" and service_status=4 )as ttc2,
(SELECT COUNT(tecket_id) AS counter FROM ticket_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as tu3 ,
(SELECT SUM(cost) AS cost  FROM ticket_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as tuc3  ,
(SELECT COUNT(tecket_id) AS counter FROM ticket_services  where  `passnger_currency`="SAR" and service_status=4 )as tt3,
(SELECT SUM(cost) AS cost  FROM ticket_services  where  `passnger_currency`="SAR" and service_status=4 )as ttc3,
(SELECT COUNT(bus_id) AS counter FROM bus_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as bu ,
(SELECT SUM(cost) AS cost  FROM bus_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as buc ,
(SELECT COUNT(bus_id) AS counter FROM bus_services  where  `passnger_currency`="USD" and service_status=4 )as bt,
(SELECT SUM(cost) AS cost  FROM bus_services  where  `passnger_currency`="USD" and service_status=4 )as btc, 
(SELECT COUNT(bus_id) AS counter FROM bus_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as bu2 ,
(SELECT SUM(cost) AS cost  FROM bus_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as buc2  ,
(SELECT COUNT(bus_id) AS counter FROM bus_services  where  `passnger_currency`="YER" and service_status=4 )as bt2,
(SELECT SUM(cost) AS cost  FROM bus_services  where  `passnger_currency`="YER" and service_status=4 )as btc2, 
(SELECT COUNT(bus_id) AS counter FROM bus_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as bu3 ,
(SELECT SUM(cost) AS cost  FROM bus_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as buc3  ,
(SELECT COUNT(bus_id) AS counter FROM bus_services  where  `passnger_currency`="SAR" and service_status=4 )as bt3,
(SELECT SUM(cost) AS cost  FROM bus_services  where  `passnger_currency`="SAR" and service_status=4 )as btc3, 
(SELECT COUNT(*) AS counter FROM general_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as gu ,
(SELECT SUM(cost) AS cost  FROM general_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as guc  ,
(SELECT COUNT(*) AS counter FROM general_services  where  `passnger_currency`="USD" and service_status=4 )as gt,
(SELECT SUM(cost) AS cost  FROM general_services  where  `passnger_currency`="USD" and service_status=4 )as gtc,
(SELECT COUNT(*) AS counter FROM general_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as gu2 ,
(SELECT SUM(cost) AS cost  FROM general_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as guc2  ,
(SELECT COUNT(*) AS counter FROM general_services  where  `passnger_currency`="YER" and service_status=4 )as gt2,
(SELECT SUM(cost) AS cost  FROM general_services  where  `passnger_currency`="YER" and service_status=4 )as gtc2,
(SELECT COUNT(*) AS counter FROM general_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as gu3,
(SELECT SUM(cost) AS cost  FROM general_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as guc3  ,
(SELECT COUNT(*) AS counter FROM general_services  where  `passnger_currency`="SAR" and service_status=4 )as gt3,
(SELECT SUM(cost) AS cost  FROM general_services  where  `passnger_currency`="SAR" and service_status=4 )as gtc3,
(SELECT COUNT(*) AS counter FROM hotel_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as hu ,
(SELECT SUM(cost) AS cost  FROM hotel_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as huc  ,
(SELECT COUNT(*) AS counter FROM hotel_services  where  `passnger_currency`="USD" and service_status=4 )as ht,
(SELECT SUM(cost) AS cost  FROM hotel_services  where  `passnger_currency`="USD" and service_status=4 )as htc,  
(SELECT COUNT(*) AS counter FROM hotel_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as hu2 ,
(SELECT SUM(cost) AS cost  FROM hotel_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as huc2  ,
(SELECT COUNT(*) AS counter FROM hotel_services  where  `passnger_currency`="YER" and service_status=4 )as ht2,
(SELECT SUM(cost) AS cost  FROM hotel_services  where  `passnger_currency`="YER" and service_status=4 )as htc2,  
(SELECT COUNT(*) AS counter FROM hotel_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as hu3 ,
(SELECT SUM(cost) AS cost  FROM hotel_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as huc3  ,
(SELECT COUNT(*) AS counter FROM hotel_services  where  `passnger_currency`="SAR" and service_status=4 )as ht3,
(SELECT SUM(cost) AS cost  FROM hotel_services  where  `passnger_currency`="SAR" and service_status=4 )as htc3,  
(SELECT COUNT(*) AS counter FROM car_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as cu ,
(SELECT SUM(cost) AS cost  FROM car_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as cuc  ,
(SELECT COUNT(*) AS counter FROM car_services  where  `passnger_currency`="USD" and service_status=4 )as ct,
(SELECT SUM(cost) AS cost  FROM car_services  where  `passnger_currency`="USD" and service_status=4 )as ctc,  
(SELECT COUNT(*) AS counter FROM car_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as cu2 ,
(SELECT SUM(cost) AS cost  FROM car_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as cuc2  ,
(SELECT COUNT(*) AS counter FROM car_services  where  `passnger_currency`="YER" and service_status=4 )as ct2,
(SELECT SUM(cost) AS cost  FROM car_services  where  `passnger_currency`="YER" and service_status=4 )as ctc2,   
(SELECT COUNT(*) AS counter FROM car_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as cu3 ,
(SELECT SUM(cost) AS cost  FROM car_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as cuc3  ,
(SELECT COUNT(*) AS counter FROM car_services  where  `passnger_currency`="SAR" and service_status=4 )as ct3,
(SELECT SUM(cost) AS cost  FROM car_services  where  `passnger_currency`="SAR" and service_status=4 )as ctc3, 
(SELECT COUNT(*) AS counter FROM medical_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as mu ,
(SELECT SUM(cost) AS cost  FROM medical_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as muc  ,
(SELECT COUNT(*) AS counter FROM medical_services  where  `passnger_currency`="USD" and service_status=4 )as mt,
(SELECT SUM(cost) AS cost  FROM medical_services  where  `passnger_currency`="USD" and service_status=4 )as mtc,
(SELECT COUNT(*) AS counter FROM medical_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as mu2 ,
(SELECT SUM(cost) AS cost  FROM medical_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as muc2  ,
(SELECT COUNT(*) AS counter FROM medical_services  where  `passnger_currency`="YER" and service_status=4 )as mt2,
(SELECT SUM(cost) AS cost  FROM medical_services  where  `passnger_currency`="YER" and service_status=4 )as mtc2,
(SELECT COUNT(*) AS counter FROM medical_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as mu3 ,
(SELECT SUM(cost) AS cost  FROM medical_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as muc3  ,
(SELECT COUNT(*) AS counter FROM medical_services  where  `passnger_currency`="SAR" and service_status=4 )as mt3,
(SELECT SUM(cost) AS cost  FROM medical_services  where  `passnger_currency`="SAR" and service_status=4 )as mtc3,
(SELECT COUNT(*) AS counter FROM visa_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as vu ,
(SELECT SUM(cost) AS cost  FROM visa_services where  `passnger_currency`="USD" and service_status=4 and how_add_bill='.$id.') as vuc  ,
(SELECT COUNT(*) AS counter FROM visa_services  where  `passnger_currency`="USD" and service_status=4 )as vt,
(SELECT SUM(cost) AS cost  FROM visa_services  where  `passnger_currency`="USD" and service_status=4 )as vtc,
(SELECT COUNT(*) AS counter FROM visa_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as vu2 ,
(SELECT SUM(cost) AS cost  FROM visa_services where  `passnger_currency`="YER" and service_status=4 and how_add_bill='.$id.') as vuc2  ,
(SELECT COUNT(*) AS counter FROM visa_services  where  `passnger_currency`="YER" and service_status=4 )as vt2,
(SELECT SUM(cost) AS cost  FROM visa_services  where  `passnger_currency`="YER" and service_status=4 )as vtc2,
(SELECT COUNT(*) AS counter FROM visa_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as vu3 ,
(SELECT SUM(cost) AS cost  FROM visa_services where  `passnger_currency`="SAR" and service_status=4 and how_add_bill='.$id.') as vuc3  ,
(SELECT COUNT(*) AS counter FROM visa_services  where  `passnger_currency`="SAR" and service_status=4 )as vt3,
(SELECT SUM(cost) AS cost  FROM visa_services  where  `passnger_currency`="SAR" and service_status=4 )as vtc3
   ');
   $affected3 =DB::select('select * from services WHERE services.is_active=1 and services.deleted=0');
   $affected4 =DB::select('SELECT * FROM suppliers WHERE suppliers.is_active=1 and suppliers.is_deleted=0');
   $affected5=DB::select('select ru.user_id as u_id ,GROUP_CONCAT(r.name) as roless,u.name as u_name 
   FROM role_user as ru 
   INNER JOIN roles as r on ru.role_id=r.id 
   INNER JOIN users as u on ru.user_id=u.id
   where ru.role_id in (2,3) and u.is_delete=0 and u.is_active=1 
   GROUP BY ru.user_id');
   $affected6 =DB::select('select * from currency where currency.is_active=1 ');

 return view('accountent_report',['today'=>$today_sales,
                                   'week'=>$week_sales,
                                   'month'=>$month_sales,
                                   'all'=>$all_sales,
                                   'service_cur'=>$saleByCurrpassnger,
                                   'data3'=>$affected3,
                                   'data4'=>$affected4,
                                   'data5'=>$affected5,
                                   'data6'=>$affected6]);
}

public function display_repo7(){
   $ss="";
    IF(ARRAY_SEARCH('filter_m_ser',ARRAY_COLUMN($_SESSION['report'],'col_name'))!==FALSE){
     foreach($_SESSION['report'] as $index=>$column){
      foreach($column as $key=>$value){
          if($key=='col_name' && $value=="filter_m_ser"){
           $ss= $_SESSION['report'][$index]['v'];
          }
     }
     }
     foreach($_SESSION['report'] as $index=>$column){
        foreach($column as $key=>$value){
            if($key=='col_name' && $value=="filter_m_ser"){
                  $sp=array();
                $sp=$_SESSION['report'];
                unset($sp[$index]);
                $_SESSION['report']=$sp;
            }
       }
       }
  }
  echo $ss;
  $a=implode(" and ",array_map(function($a) {
     return implode(" ",$a);},$_SESSION['report']));
     echo $a;
    
  }
  public function add_repo_item($stat,$col,$op,$v1){
     $v=$v1;
    if($stat==1){
        $item=array('col_name'=>$col,'op'=>$op,'v'=>$v);
        IF(ARRAY_SEARCH($col,ARRAY_COLUMN($_SESSION['report'],'col_name'))!==FALSE){
           foreach($_SESSION['report'] as $index=>$column){
            foreach($column as $key=>$value){
                if($key=='col_name' && $value==$col){
           $_SESSION['report'][$index]['v']=$v;
                }
           }
           }
        }ELSE{
             array_push($_SESSION['report'],$item);  	
        }
      return $_SESSION['report'];
    }elseif($stat==2){
      $item=array('col_name'=>$col,'op'=>$op,'v'=>$v);
      IF(ARRAY_SEARCH($col,ARRAY_COLUMN($_SESSION['report2'],'col_name'))!==FALSE){
         foreach($_SESSION['report2'] as $index=>$column){
          foreach($column as $key=>$value){
              if($key=='col_name' && $value==$col){
         $_SESSION['report2'][$index]['v']=$v;
              }
         }
         }
      }ELSE{
           array_push($_SESSION['report2'],$item);  	
      }
    return $_SESSION['report2'];
  }
     }
     public function clear_repo_session($s){
      $id=Auth::user()->id ;
      if($s==1){
        $opps=[];
        $_SESSION['report']=$opps;
        $item1=array('col_name'=>'service_status','op'=>'=','v'=>'4');
        $item2=array('col_name'=>'how_add_bill','op'=>'=','v'=>$id);
        array_push($_SESSION['report'],$item1); 
        array_push($_SESSION['report'],$item2); 
                return  $_SESSION['report'];
     }elseif($s==2){
      $opps=[];
      $_SESSION['report2']=$opps;
      $item1=array('col_name'=>'service_status','op'=>'=','v'=>'4');
      $item2=array('col_name'=>'how_add_bill','op'=>'=','v'=>$id);
      array_push($_SESSION['report2'],$item1); 
      array_push($_SESSION['report2'],$item2); 
              return  $_SESSION['report2'];
   }
   }
     
     public function display_repo($status,$m){ 
   $a="";
   if($status==1){
      $a=implode(" and ",array_map(function($a) {
         return implode(" ",$a);},$_SESSION['report']));
      }elseif($status==2){
         $a=implode(" and ",array_map(function($a) {
            return implode(" ",$a);},$_SESSION['report2']));
         }
        if($m==0){
     $onlyl=DB::SELECT('SELECT tecket_id as t_id,bill_num as h_a_b,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
              ,ses_status as s_st FROM ticket_services 
              JOIN users on ticket_services.user_id=users.id
               JOIN currency on ticket_services.ses_cur_id=currency.cur_id
               JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
               where  '.$a.'
                UNION 
                    SELECT gen_id as t_id,bill_num as h_a_b,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
              ,ses_status as s_st FROM general_services
               JOIN users on general_services.user_id=users.id
               JOIN currency on general_services.ses_cur_id=currency.cur_id
               JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
               where  '.$a.'
                UNION 
              SELECT bus_id as t_id,bill_num as h_a_b,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
              ,ses_status as s_st FROM bus_services
                JOIN users on bus_services.user_id=users.id
               JOIN currency on bus_services.ses_cur_id=currency.cur_id
               JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
               where  '.$a.'
                UNION 
              SELECT hotel_id as t_id,bill_num as h_a_b,
              manager_id as manager_id,
              passenger_name as t_pn,
              service_id as st_id,
              user_id as uuser_resiver, 
              refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
              ,ses_status as s_st FROM hotel_services 
                JOIN users on hotel_services.user_id=users.id
               JOIN currency on hotel_services.ses_cur_id=currency.cur_id
               JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
               where  '.$a.'
                UNION 
              SELECT visa_id as t_id,bill_num as h_a_b,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
              ,ses_status as s_st FROM visa_services
                JOIN users on visa_services.user_id=users.id
               JOIN currency on visa_services.ses_cur_id=currency.cur_id
               JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
               where  '.$a.'
                UNION 
              SELECT med_id as t_id,bill_num as h_a_b,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
              ,ses_status as s_st FROM medical_services 
                JOIN users on medical_services.user_id=users.id
               JOIN currency on medical_services.ses_cur_id=currency.cur_id
               JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
               where  '.$a.'
                UNION 
              SELECT car_id as t_id,bill_num as h_a_b,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
               ,ses_status as s_st FROM car_services
               JOIN users on car_services.user_id=users.id
               JOIN currency on car_services.ses_cur_id=currency.cur_id
               JOIN suppliers on car_services.due_to_supp=suppliers.s_no
               where  '.$a.'
               ');
        }else if($m==1){
           $onlyl=DB::SELECT('SELECT tecket_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,ticket_number as s_num, Issue_date as t_idate
                    ,ses_status as s_st,bill_num as h_a_b FROM ticket_services 
                    JOIN users on ticket_services.user_id=users.id
                     JOIN currency on ticket_services.ses_cur_id=currency.cur_id
                     JOIN suppliers on ticket_services.due_to_supp=suppliers.s_no
                     where  '.$a.'');
                     }else if($m==2){
           $onlyl=DB::SELECT('SELECT bus_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,bus_number as s_num, Issue_date as t_idate
           ,ses_status as s_st,bill_num as h_a_b FROM bus_services
             JOIN users on bus_services.user_id=users.id
            JOIN currency on bus_services.ses_cur_id=currency.cur_id
            JOIN suppliers on bus_services.due_to_supp=suppliers.s_no
            where  '.$a.'');
            }else if($m==3){
              $onlyl=DB::SELECT(' SELECT car_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
              ,ses_status as s_st,bill_num as h_a_b FROM car_services
              JOIN users on car_services.user_id=users.id
              JOIN currency on car_services.ses_cur_id=currency.cur_id
              JOIN suppliers on car_services.due_to_supp=suppliers.s_no
              where  '.$a.'');
               }else if($m==4){
                 $onlyl=DB::SELECT('SELECT med_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,document_number as s_num, Issue_date as t_idate
                 ,ses_status as s_st,bill_num as h_a_b FROM medical_services 
                   JOIN users on medical_services.user_id=users.id
                  JOIN currency on medical_services.ses_cur_id=currency.cur_id
                  JOIN suppliers on medical_services.due_to_supp=suppliers.s_no
                  where  '.$a.'');
                  }else if($m==5){
                    $onlyl=DB::SELECT('SELECT hotel_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number	 as s_num, Issue_date as t_idate
                    ,ses_status as s_st,bill_num as h_a_b FROM hotel_services 
                      JOIN users on hotel_services.user_id=users.id
                     JOIN currency on hotel_services.ses_cur_id=currency.cur_id
                     JOIN suppliers on hotel_services.due_to_supp=suppliers.s_no
                     where  '.$a.'');
                     }else if($m==6){
                       $onlyl=DB::SELECT('SELECT visa_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
                       ,ses_status as s_st,bill_num as h_a_b FROM visa_services
                         JOIN users on visa_services.user_id=users.id
                        JOIN currency on visa_services.ses_cur_id=currency.cur_id
                        JOIN suppliers on visa_services.due_to_supp=suppliers.s_no
                        where  '.$a.'');
                        }else if($m==7){
                          $onlyl=DB::SELECT(' SELECT gen_id as t_id,manager_id as manager_id,passenger_name as t_pn,service_id as st_id,user_id as uuser_resiver, refernce as t_ref,provider_cost as tp_c,suppliers.supplier_name as s_name,users.name as u_name,currency.cur_name as cur_n,cost as cost,bookmark as bookmark,how_add_bookmark as bookmark_how ,voucher_number as s_num, Issue_date as t_idate
                          ,ses_status as s_st,bill_num as h_a_b FROM general_services
                           JOIN users on general_services.user_id=users.id
                           JOIN currency on general_services.ses_cur_id=currency.cur_id
                           JOIN suppliers on general_services.due_to_supp=suppliers.s_no 
                           where  '.$a.'');
                           }else{
           echo "kkkk";
        }
                echo json_encode($onlyl);
               $this->clear_repo_session($status);
       } 
}
