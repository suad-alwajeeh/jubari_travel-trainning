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
class reporterController extends Controller
{
   public function __constract(){
      $id=Auth::user()->id;
         $item2=array('col_name'=>'user_id','op'=>'=','v'=>$id);
         array_push($_SESSION['report'],$item2); 
         array_push($_SESSION['report2'],$item2); 
   }
   
/*******************************REPORTS ^_^ REPORT************************** */
/*******************************REPORTS accountent REPORT************************** */
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


/*******************************REPORTS ^_^ REPORT************************** */
/*******************************REPORTS SEL_EXECUTIVE REPORT************************** */
/*******************************REPORTS ^_^ REPORT************************** */
 function se_report_desplay(){
    $id=Auth::user()->id ;
    $today_sales=DB::select('
    select
    ( select COUNT(*)  from ticket_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glot,
     (select COUNT(*) as s_my  from ticket_services where service_status=4 and user_id='.$id.' and Issue_date=CURRENT_DATE()) as spet,
    ( select COUNT(*)  from bus_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glob,
     (select COUNT(*) as s_my  from bus_services where service_status=4 and user_id='.$id.' and Issue_date=CURRENT_DATE()) as speb ,
    ( select COUNT(*)  from car_services where  service_status=4 and Issue_date=CURRENT_DATE()) as gloc,
     (select COUNT(*) as s_my  from car_services where service_status=4 and user_id='.$id.' and Issue_date=CURRENT_DATE()) as spec,
    ( select COUNT(*)  from medical_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glom,
     (select COUNT(*) as s_my  from medical_services where service_status=4 and user_id='.$id.' and Issue_date=CURRENT_DATE()) as spem, 
    ( select COUNT(*)  from hotel_services where  service_status=4 and Issue_date=CURRENT_DATE()) as gloh,
     (select COUNT(*) as s_my  from hotel_services where service_status=4 and user_id='.$id.' and Issue_date=CURRENT_DATE()) as speh,
    ( select COUNT(*)  from visa_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glov,
     (select COUNT(*) as s_my  from visa_services where service_status=4 and user_id='.$id.' and Issue_date=CURRENT_DATE()) as spev ,
    ( select COUNT(*)  from general_services where  service_status=4 and Issue_date=CURRENT_DATE()) as glog,
     (select COUNT(*) as s_my  from general_services where service_status=4 and user_id='.$id.' and Issue_date=CURRENT_DATE()) as speg');
     $week_sales=DB::select('
     select
     (select COUNT(*) from ticket_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spet,
     (select COUNT(*) from ticket_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glot,
       (select COUNT(*) from bus_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speb,
     (select COUNT(*) from bus_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glob,
       (select COUNT(*) from car_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spec,
     (select COUNT(*) from car_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as gloc,
       (select COUNT(*) from medical_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spem,
     (select COUNT(*) from medical_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glom,
       (select COUNT(*) from hotel_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speh,
     (select COUNT(*) from hotel_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as gloh,
       (select COUNT(*) from visa_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as spev,
     (select COUNT(*) from visa_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glov,
       (select COUNT(*) from general_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as speg,
     (select COUNT(*) from general_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-6 AND CURRENT_DATE()) as glog
     ');
     $month_sales=DB::select('
     select
     (select COUNT(*) from ticket_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spet,
     (select COUNT(*) from ticket_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glot,
       (select COUNT(*) from bus_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speb,
     (select COUNT(*) from bus_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glob,
       (select COUNT(*) from car_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spec,
     (select COUNT(*) from car_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as gloc,
       (select COUNT(*) from medical_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spem,
     (select COUNT(*) from medical_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glom,
       (select COUNT(*) from hotel_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speh,
     (select COUNT(*) from hotel_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as gloh,
       (select COUNT(*) from visa_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as spev,
     (select COUNT(*) from visa_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glov,
       (select COUNT(*) from general_services where service_status=4 and user_id='.$id.' and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as speg,
     (select COUNT(*) from general_services where service_status=4 and Issue_date BETWEEN CURRENT_DATE()-30 AND CURRENT_DATE()) as glog
     ');
     $all_sales=DB::select('
     select
     (select COUNT(*) from ticket_services where service_status=4 and user_id='.$id.') as spet,
     (select COUNT(*) from ticket_services where service_status=4 ) as glot,
       (select COUNT(*) from bus_services where service_status=4 and user_id='.$id.' ) as speb,
     (select COUNT(*) from bus_services where service_status=4 ) as glob,
       (select COUNT(*) from car_services where service_status=4 and user_id='.$id.') as spec,
     (select COUNT(*) from car_services where service_status=4) as gloc,
       (select COUNT(*) from medical_services where service_status=4 and user_id='.$id.') as spem,
     (select COUNT(*) from medical_services where service_status=4 ) as glom,
       (select COUNT(*) from hotel_services where service_status=4 and user_id='.$id.') as speh,
     (select COUNT(*) from hotel_services where service_status=4 ) as gloh,
       (select COUNT(*) from visa_services where service_status=4 and user_id='.$id.') as spev,
     (select COUNT(*) from visa_services where service_status=4 ) as glov,
       (select COUNT(*) from general_services where service_status=4 and user_id='.$id.') as speg,
     (select COUNT(*) from general_services where service_status=4) as glog
     ');
    
     $saleByCurrpassnger=DB::select('
     SELECT
 (SELECT COUNT(tecket_id) AS counter FROM ticket_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as tu ,
 (SELECT SUM(cost) AS cost  FROM ticket_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as tuc  ,
 (SELECT COUNT(tecket_id) AS counter FROM ticket_services  where  `passnger_currency`="USD" and service_status=4 )as tt,
 (SELECT SUM(cost) AS cost  FROM ticket_services  where  `passnger_currency`="USD" and service_status=4 )as ttc,
 (SELECT COUNT(tecket_id) AS counter FROM ticket_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as tu2 ,
 (SELECT SUM(cost) AS cost  FROM ticket_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as tuc2  ,
 (SELECT COUNT(tecket_id) AS counter FROM ticket_services  where  `passnger_currency`="YER" and service_status=4 )as tt2,
 (SELECT SUM(cost) AS cost  FROM ticket_services  where  `passnger_currency`="YER" and service_status=4 )as ttc2,
 (SELECT COUNT(tecket_id) AS counter FROM ticket_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as tu3 ,
 (SELECT SUM(cost) AS cost  FROM ticket_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as tuc3  ,
 (SELECT COUNT(tecket_id) AS counter FROM ticket_services  where  `passnger_currency`="SAR" and service_status=4 )as tt3,
 (SELECT SUM(cost) AS cost  FROM ticket_services  where  `passnger_currency`="SAR" and service_status=4 )as ttc3,
 (SELECT COUNT(bus_id) AS counter FROM bus_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as bu ,
 (SELECT SUM(cost) AS cost  FROM bus_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as buc ,
 (SELECT COUNT(bus_id) AS counter FROM bus_services  where  `passnger_currency`="USD" and service_status=4 )as bt,
 (SELECT SUM(cost) AS cost  FROM bus_services  where  `passnger_currency`="USD" and service_status=4 )as btc, 
 (SELECT COUNT(bus_id) AS counter FROM bus_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as bu2 ,
 (SELECT SUM(cost) AS cost  FROM bus_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as buc2  ,
 (SELECT COUNT(bus_id) AS counter FROM bus_services  where  `passnger_currency`="YER" and service_status=4 )as bt2,
 (SELECT SUM(cost) AS cost  FROM bus_services  where  `passnger_currency`="YER" and service_status=4 )as btc2, 
 (SELECT COUNT(bus_id) AS counter FROM bus_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as bu3 ,
 (SELECT SUM(cost) AS cost  FROM bus_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as buc3  ,
 (SELECT COUNT(bus_id) AS counter FROM bus_services  where  `passnger_currency`="SAR" and service_status=4 )as bt3,
 (SELECT SUM(cost) AS cost  FROM bus_services  where  `passnger_currency`="SAR" and service_status=4 )as btc3, 
 (SELECT COUNT(*) AS counter FROM general_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as gu ,
 (SELECT SUM(cost) AS cost  FROM general_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as guc  ,
 (SELECT COUNT(*) AS counter FROM general_services  where  `passnger_currency`="USD" and service_status=4 )as gt,
 (SELECT SUM(cost) AS cost  FROM general_services  where  `passnger_currency`="USD" and service_status=4 )as gtc,
 (SELECT COUNT(*) AS counter FROM general_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as gu2 ,
 (SELECT SUM(cost) AS cost  FROM general_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as guc2  ,
 (SELECT COUNT(*) AS counter FROM general_services  where  `passnger_currency`="YER" and service_status=4 )as gt2,
 (SELECT SUM(cost) AS cost  FROM general_services  where  `passnger_currency`="YER" and service_status=4 )as gtc2,
 (SELECT COUNT(*) AS counter FROM general_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as gu3,
 (SELECT SUM(cost) AS cost  FROM general_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as guc3  ,
 (SELECT COUNT(*) AS counter FROM general_services  where  `passnger_currency`="SAR" and service_status=4 )as gt3,
 (SELECT SUM(cost) AS cost  FROM general_services  where  `passnger_currency`="SAR" and service_status=4 )as gtc3,
 (SELECT COUNT(*) AS counter FROM hotel_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as hu ,
 (SELECT SUM(cost) AS cost  FROM hotel_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as huc  ,
 (SELECT COUNT(*) AS counter FROM hotel_services  where  `passnger_currency`="USD" and service_status=4 )as ht,
 (SELECT SUM(cost) AS cost  FROM hotel_services  where  `passnger_currency`="USD" and service_status=4 )as htc,  
 (SELECT COUNT(*) AS counter FROM hotel_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as hu2 ,
 (SELECT SUM(cost) AS cost  FROM hotel_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as huc2  ,
 (SELECT COUNT(*) AS counter FROM hotel_services  where  `passnger_currency`="YER" and service_status=4 )as ht2,
 (SELECT SUM(cost) AS cost  FROM hotel_services  where  `passnger_currency`="YER" and service_status=4 )as htc2,  
 (SELECT COUNT(*) AS counter FROM hotel_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as hu3 ,
 (SELECT SUM(cost) AS cost  FROM hotel_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as huc3  ,
 (SELECT COUNT(*) AS counter FROM hotel_services  where  `passnger_currency`="SAR" and service_status=4 )as ht3,
 (SELECT SUM(cost) AS cost  FROM hotel_services  where  `passnger_currency`="SAR" and service_status=4 )as htc3,  
 (SELECT COUNT(*) AS counter FROM car_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as cu ,
 (SELECT SUM(cost) AS cost  FROM car_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as cuc  ,
 (SELECT COUNT(*) AS counter FROM car_services  where  `passnger_currency`="USD" and service_status=4 )as ct,
 (SELECT SUM(cost) AS cost  FROM car_services  where  `passnger_currency`="USD" and service_status=4 )as ctc,  
 (SELECT COUNT(*) AS counter FROM car_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as cu2 ,
 (SELECT SUM(cost) AS cost  FROM car_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as cuc2  ,
 (SELECT COUNT(*) AS counter FROM car_services  where  `passnger_currency`="YER" and service_status=4 )as ct2,
 (SELECT SUM(cost) AS cost  FROM car_services  where  `passnger_currency`="YER" and service_status=4 )as ctc2,   
 (SELECT COUNT(*) AS counter FROM car_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as cu3 ,
 (SELECT SUM(cost) AS cost  FROM car_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as cuc3  ,
 (SELECT COUNT(*) AS counter FROM car_services  where  `passnger_currency`="SAR" and service_status=4 )as ct3,
 (SELECT SUM(cost) AS cost  FROM car_services  where  `passnger_currency`="SAR" and service_status=4 )as ctc3, 
 (SELECT COUNT(*) AS counter FROM medical_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as mu ,
 (SELECT SUM(cost) AS cost  FROM medical_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as muc  ,
 (SELECT COUNT(*) AS counter FROM medical_services  where  `passnger_currency`="USD" and service_status=4 )as mt,
 (SELECT SUM(cost) AS cost  FROM medical_services  where  `passnger_currency`="USD" and service_status=4 )as mtc,
 (SELECT COUNT(*) AS counter FROM medical_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as mu2 ,
 (SELECT SUM(cost) AS cost  FROM medical_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as muc2  ,
 (SELECT COUNT(*) AS counter FROM medical_services  where  `passnger_currency`="YER" and service_status=4 )as mt2,
 (SELECT SUM(cost) AS cost  FROM medical_services  where  `passnger_currency`="YER" and service_status=4 )as mtc2,
 (SELECT COUNT(*) AS counter FROM medical_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as mu3 ,
 (SELECT SUM(cost) AS cost  FROM medical_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as muc3  ,
 (SELECT COUNT(*) AS counter FROM medical_services  where  `passnger_currency`="SAR" and service_status=4 )as mt3,
 (SELECT SUM(cost) AS cost  FROM medical_services  where  `passnger_currency`="SAR" and service_status=4 )as mtc3,
 (SELECT COUNT(*) AS counter FROM visa_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as vu ,
 (SELECT SUM(cost) AS cost  FROM visa_services where  `passnger_currency`="USD" and service_status=4 and user_id='.$id.') as vuc  ,
 (SELECT COUNT(*) AS counter FROM visa_services  where  `passnger_currency`="USD" and service_status=4 )as vt,
 (SELECT SUM(cost) AS cost  FROM visa_services  where  `passnger_currency`="USD" and service_status=4 )as vtc,
 (SELECT COUNT(*) AS counter FROM visa_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as vu2 ,
 (SELECT SUM(cost) AS cost  FROM visa_services where  `passnger_currency`="YER" and service_status=4 and user_id='.$id.') as vuc2  ,
 (SELECT COUNT(*) AS counter FROM visa_services  where  `passnger_currency`="YER" and service_status=4 )as vt2,
 (SELECT SUM(cost) AS cost  FROM visa_services  where  `passnger_currency`="YER" and service_status=4 )as vtc2,
 (SELECT COUNT(*) AS counter FROM visa_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as vu3 ,
 (SELECT SUM(cost) AS cost  FROM visa_services where  `passnger_currency`="SAR" and service_status=4 and user_id='.$id.') as vuc3  ,
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
  function se_clear_repo_session($s){
    $id=Auth::user()->id ;
    if($s==1){
      $opps=[];
      $_SESSION['report']=$opps;
      $item1=array('col_name'=>'service_status','op'=>'=','v'=>'4');
      $item2=array('col_name'=>'user_id','op'=>'=','v'=>$id);
      array_push($_SESSION['report'],$item1); 
      array_push($_SESSION['report'],$item2); 
              return  $_SESSION['report'];
   }elseif($s==2){
    $opps=[];
    $_SESSION['report2']=$opps;
    $item1=array('col_name'=>'service_status','op'=>'=','v'=>'4');
    $item2=array('col_name'=>'user_id','op'=>'=','v'=>$id);
    array_push($_SESSION['report2'],$item1); 
    array_push($_SESSION['report2'],$item2); 
            return  $_SESSION['report2'];
 }
 }
   
 
  function se_display_repo7(){
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
    function se_add_repo_item($stat,$col,$op,$v1){
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
       function se_clear_repo_session($s){
       $id=Auth::user()->id ;
       if($s==1){
         $opps=[];
         $_SESSION['report']=$opps;
         $item1=array('col_name'=>'service_status','op'=>'=','v'=>'4');
         $item2=array('col_name'=>'user_id','op'=>'=','v'=>$id);
         array_push($_SESSION['report'],$item1); 
         array_push($_SESSION['report'],$item2); 
                 return  $_SESSION['report'];
      }elseif($s==2){
       $opps=[];
       $_SESSION['report2']=$opps;
       $item1=array('col_name'=>'service_status','op'=>'=','v'=>'4');
       $item2=array('col_name'=>'user_id','op'=>'=','v'=>$id);
       array_push($_SESSION['report2'],$item1); 
       array_push($_SESSION['report2'],$item2); 
               return  $_SESSION['report2'];
    }
    }
      
       function se_display_repo($status,$m){ 
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
