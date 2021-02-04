<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\airline;
use App\Supplier;
use App\Employee;
use App\TicketService;
use App\BusService;
use App\CarService;
use App\ServiceService;
use App\visaService;
use App\HotelService;
use App\GeneralService;
use App\User;
use App\users;
use Auth;
use App\Events\MyEvent;
use App\Events\Notification;
use Illuminate\Support\Facades\DB;
class HotelServiceController extends Controller
{
    //


public function generate( Request $req)
{
  $id=DB::table('hotel_services')->latest()->first();
  return json_decode($id->voucher_number+1);
}
    public function hide_hotel($id){
        echo $id;
        $affected1=HotelService::where('hotel_id',$id)
        ->update(['deleted'=>1]);
        return back()->with('seccess','Seccess Data Delete');

        }
public function send_hotel($id){
            echo $id;
            $where=['hotel_id'=>$id];
    
            $where +=['attachment'=>'null'];
            $affected1=HotelService::where($where)->count();
            if($affected1 >0)
           { 
            json_encode('noorder');
         }
          else{
            $affected= HotelService::where(['hotel_id'=>$id])
            ->update(['service_status'=>2]);
           /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=HotelService::where('hotel_id',$id)
->join('employees','hotel_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','hotel_services.user_id as u_id','hotel_services.manager_id as manager_id','employees.emp_middel_name as n2')
->get();
foreach($affected11 as $un){
$user_name=$un->n1.' '.$un->n2;
$user_id=$un->u_id;
$manager_id=$un->manager_id;
//echo $user_id;
}
if($manager_id == null){
$admin =DB::select('select users.id from users 
join role_user on users.id=role_user.user_id
 where users.is_active=1 and role_user.role_id IN (2,5)'); 
foreach($admin as $ad){
   $message55555="";
   $date1=date("Y/m/d") ;
  $date=now(); 
   $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send Hotel Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>6,
      'servic_id'=>$id,
      'created_at'=>$date,
      'updated_at'=>$date1,
      ]
   );
   event(new MyEvent($dataa));
 } 
}else{
   $admin =DB::select('select users.id from users 
   join role_user on users.id=role_user.user_id
    where users.is_active=1 and role_user.role_id=5'); 
   foreach($admin as $ad){
      $message55555="";
      $date1=date("Y/m/d") ;
     $date=now(); 
      $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send Hotel Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>6,
         'servic_id'=>$id,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated Hotel Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>6,
       'servic_id'=>$id,
       'created_at'=>$date,
       'updated_at'=>$date1,
       ]
    );
    event(new MyEvent($dataa));
}
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

            return back()->with('seccess','Seccess Data Delete');
          }
            }

            public function hotel(){
              $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
      ->join('services','services.ser_id','=','sup_services.service_id')
      ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>5])->get();
              $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
            
             
                  return view('add_hotel',$data);
              } 
            public function hide_visa($id){
                echo $id;
                $affected1=VisaService::where('visa_id',$id)
                ->update(['deleted'=>1]);
                return back()->with('seccess','Seccess Data Delete');
              }
   
              
public function updateHotel( Request $req)
{ 
    $hotel=new HotelService;

   $img='';

    if($req->hasfile('attachment'))
    {
       $attchmentFile =$req->file('attachment') ;
       $num=count($attchmentFile);
      for($i=0;$i<$num;$i++){
         $ext=$attchmentFile[$i]->getClientOriginalExtension();
       $attchmentName =rand(123456,999999).".".$ext;
       $attchment=$attchmentFile[$i]->move('img/user_attchment/',$attchmentName);
       $img.=$attchmentName.',';
   
       }

       $hotel::where('hotel_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'ses_status'=>$req->hotel_status,
       'voucher_number'=>$req->voucher_number,'country'=>$req->country,'city'=>$req->city,'hotel_name'=>$req->hotel_name,
       'check_in'=>$req->check_in,'check_out'=>$req->check_out,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>5,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
      'attachment'=>$img ,'errorlog'=>0

       ]); 

    }
    else{
      $hotel::where('hotel_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'ses_status'=>$req->hotel_status,
       'voucher_number'=>$req->voucher_number,'country'=>$req->country,'city'=>$req->city,'hotel_name'=>$req->hotel_name,
       'check_in'=>$req->check_in,'check_out'=>$req->check_out,'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>5,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,'errorlog'=>0

       ]); 
    }
    return redirect('/service/show_hotel/1')->with('seccess','Seccess Data Update');
  }


  public function updateHotel2( Request $req)
  { 
      $hotel=new HotelService;
 
        $hotel::where('hotel_id',$req->id)
         ->update(['Issue_date'=>$req->Issue_date,
         'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
         'ses_status'=>$req->hotel_status,
         'voucher_number'=>$req->voucher_number,'country'=>$req->country,'city'=>$req->city,'hotel_name'=>$req->hotel_name,
         'check_in'=>$req->check_in,'check_out'=>$req->check_out,'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
        'cost'=>$req->cost,'service_id'=>5,'passnger_currency'=>$req->passnger_currency,'service_status'=>1,'errorlog'=>0
  
         ]); 
$db=DB::delete('delete from logs where service_id="'.$req->id.'"');
      /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
//مش متعرف على الايدي حق المانجر
$loged_id=  Auth::user()->id ;
$emp=Employee::all();
foreach($emp as $emps){
  if($emps->emp_id==$loged_id)
 {
    $name=$emps->emp_first_name.'  ';
    $name .=$emps->emp_last_name;
 
}
}
$date1=date("Y/m/d") ;
$date=now(); 
$affectedm= HotelService::where(['hotel_id'=>$req->id])
->get();
foreach($affectedm as $affm){     
  $manager=$affm->manager_id; 
echo $affm->hotel_id;
  $message55555="";
  $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$req->id.'",'.$loged_id.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' edit Hotel Services with remark <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $dataa=['to'=>$manager,'from'=>$loged_id,'message'=> $message55555,'date'=>$date];
  print_r($dataa);
  $messagea=$dataa['message'];
  $admin_notify=DB::table('notifications')->insert(
     ['sender' => $loged_id, 
     'resiver' => $manager,
     'body'=>$messagea ,
     'status'=>0 ,
  'main_service'=>5,
     'servic_id'=>$req->id,
     'created_at'=>$date,
     'updated_at'=>$date1,
     ]
  );
  event(new MyEvent($dataa));
}
    /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

      return redirect('/service/show_hotel/1')->with('seccess','Seccess Data Update');
    }

  
public function add_hotel( Request $req)
{ 
  $message5="";
  $date1=date("Y/m/d") ;
  $date=now();
    $hotel=new HotelService;
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
    $hotel_id= vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
 
    $loged_id=  Auth::user()->id ;
    if( $loged_id==$req->due_to_customer )
    {
      $hotel->user_id= $loged_id;
      $hotel->user_status=0;

    }
    else{
      $hotel->user_id= $loged_id;
      $hotel->user_status=1;
    }
    $img='';
    if($req->hasfile('attachment'))
    {
       $attchmentFile =$req->file('attachment') ;
       $num=count($attchmentFile);
      for($i=0;$i<$num;$i++){
         $ext=$attchmentFile[$i]->getClientOriginalExtension();
       $attchmentName =rand(123456,999999).".".$ext;
       $attchment=$attchmentFile[$i]->move('img/user_attchment/',$attchmentName);
       $hotel->attachment .=$attchmentName.',';
   
       }} else{
        $hotel->attachment='null';
      }

    $hotel->Issue_date =$req->Issue_date;
    $hotel->hotel_id=$hotel_id;
    $hotel->refernce=$req->refernce;
    $hotel->passenger_name=$req->passenger_name;
    $hotel->voucher_number=$req->voucher_number;
    $hotel->ses_status =$req->hotel_status;
    $hotel->country =$req->country;
    $hotel->city =$req->city;
    $hotel->hotel_name =$req->hotel_name;
    $hotel->check_in =$req->check_in;
    $hotel->check_out =$req->check_out;
    $hotel->due_to_supp =$req->due_to_supp;
    $hotel->provider_cost=$req->provider_cost;
    $hotel->ses_cur_id=$req->cur_id;
    $hotel->due_to_customer =$req->due_to_customer ;
    $hotel->cost =$req->cost ;
    $hotel->service_id=5;
    $hotel->passnger_currency=$req->passnger_currency;
    $hotel->remark=$req->remark;
    $hotel->service_status=1;
    $hotel->save();
    if( $loged_id==$req->due_to_customer )
    {    
      
   /***********************************NOTIFICATION CODE****************************** */
  /***********************************NOTIFICATION CODE****************************** */
  
  $message555="";
  $date1=date("Y/m/d") ;
  $date=now();
  $manager=User::join('role_user','role_user.user_id','=','users.id')
  ->join('roles','roles.id','=','role_user.role_id')
  ->where('roles.id',2)->get();


  foreach($manager as $aff){     
      $customer_id=$aff->user_id; 
      $customer=$aff->user_name; 
} 
  
  $message555="";
  $date1=date("Y/m/d") ;
  $date=now(); 
        $emp=Employee::all();
        foreach($emp as $emps){
          if($emps->emp_id==$loged_id)
         {
            $name=$emps->emp_first_name.'  ';
            $name .=$emps->emp_last_name;
         
        }
      }
      
      $admin =DB::select('select users.id from users 
      join role_user on users.id=role_user.user_id
       where users.is_active=1 and role_user.role_id IN (2,5)'); 
      foreach($admin as $ad){
         $message55555="";
         $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$hotel_id.'",'.$loged_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Hotel  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $dataa=['to'=>$ad->id,'from'=>$loged_id,'message'=> $message55555,'date'=>$date];
         $messagea=$dataa['message'];
         $admin_notify=DB::table('notifications')->insert(
            ['sender' => $loged_id, 
            'resiver' => $ad->id,
            'body'=>$messagea ,
            'status'=>0 ,
         'main_service'=>5,
            'servic_id'=>$hotel_id,
            'created_at'=>$date,
            'updated_at'=>$date1,
            ]
         );
         event(new MyEvent($dataa));
       } 
  /***********************************NOTIFICATION CODE****************************** */
  /***********************************NOTIFICATION CODE****************************** */
      return redirect('/service/show_hotel/1')->with('seccess','Seccess Data Insert');
    }    else{
      $emp=Employee::all();
      foreach($emp as $emps){
      if($emps->emp_id==$loged_id)
      {
        $name=$emps->emp_first_name.'  ';
        $name .=$emps->emp_last_name;
      
      }
      }
      $message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$hotel_id.'",'.$loged_id.','.$req->due_to_customer.') href=/emp_hotel  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add services Hotel by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      $datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message555,'date'=>$date];
      $message=$datav['message'];
      DB::table('notifications')->insert(
         ['sender' => $loged_id, 
         'resiver' => $req->due_to_customer,
         'body'=>$message ,
         'status'=>0 ,
      'main_service'=>5,
         'servic_id'=>$hotel_id,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($datav));
         return redirect('/service/sent_hotel/2')->with('seccess','Seccess Data Insert');
        }
}

public function update_Hotel($id){
  $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
  ->join('services','services.ser_id','=','sup_services.service_id')
  ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>5])->get();
  $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
           $data['hotels']=HotelService::join('currency','currency.cur_id','=','hotel_services.ses_cur_id')
->join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')->where('hotel_id',$id)->get();
   
      return view('update_hotel',$data);
  } 
  /**********************show update bus error services  *******************/

  public function update_Hotel2($id){
    $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
    ->join('services','services.ser_id','=','sup_services.service_id')
    ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>2])->get();
   
   
    $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
    ->where('users.is_active',1)->where('users.is_delete',0)
    ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
     $data['data']=HotelService::join('currency','currency.cur_id','=','hotel_services.ses_cur_id')
    ->join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
    ->join('employees','employees.emp_id','=','hotel_services.due_to_customer')
      ->join('logs','logs.service_id','=','hotel_services.hotel_id')
    ->where('hotel_services.hotel_id',$id)->get();
    foreach( $data['data'] as $aff){     
      $sup=$aff->due_to_supp;
    }
    $data['cur']=Supplier::join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
    ->join('currency','currency.cur_id','=','sup_currency.cur_id')
    ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'suppliers.s_no'=>$sup])->get();
  
    return view('up_err_hotel',$data)->with('seccess','Seccess Data Update');
} 
    public function show_hotel($id)
{
  $loged_Id=  Auth::user()->id ;

 $data['hotel']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
 ->join('currency','currency.cur_id','=','hotel_services.ses_cur_id')
 ->where(['hotel_services.service_status'=>$id,'hotel_services.deleted'=>0,'hotel_services.errorlog'=>0,'hotel_services.due_to_customer'=> $loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
return view('show_hotel',$data);
}

    public function sent_hotel($id)
{
  $loged_Id=  Auth::user()->id ;

 $data['hotel']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
 ->join('currency','currency.cur_id','=','hotel_services.ses_cur_id')
 ->where(['hotel_services.service_status'=>$id,'hotel_services.deleted'=>0,'hotel_services.errorlog'=>0,'hotel_services.due_to_customer'=> $loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
return view('sent_hotel',$data);
}
public function deleteAllhotel(Request $request){
  $ids = $request->input('ids');
  foreach($ids as $mm){
  $dbs = HotelService::where('hotel_id',$mm)
  ->update(['deleted'=>1]);
  }
  return back()->with('seccess','Seccess Data Delete');
}
public function sendAllhotel(Request $request){
$ids = $request->input('ids');
$where=['hotel_id'=>$ids];
  $where +=['attachment'=>'null'];
  $affected1=HotelService::where($where)->count();
  if($affected1 >0)
 { 
  return back()->with('failed','failed Data  send');

}
else{
  foreach($ids as $mm){

  $dbs = HotelService::where('hotel_id',$mm)->update(['service_status'=>2]);
  }
 /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=HotelService::where('hotel_id',$ids)
->join('employees','hotel_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','hotel_services.user_id as u_id','hotel_services.manager_id as manager_id','employees.emp_middel_name as n2')
->get();
foreach($affected11 as $un){
$user_name=$un->n1.' '.$un->n2;
$user_id=$un->u_id;
$manager_id=$un->manager_id;
//echo $user_id;
}
$idds= implode(',' , $ids);
$SIZE=sizeof($ids);
  echo $SIZE;
if($manager_id == null){
  
   $admin =DB::select('select users.id from users 
   join role_user on users.id=role_user.user_id
    where users.is_active=1 and role_user.role_id IN (2,5)'); 
foreach($admin as $ad){
   $message55555="";
   $date1=date("Y/m/d") ;
  $date=now(); 
  $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee' .$user_name. ' SEND <span class="text-success">'.$SIZE.'</span> Services Hotel   <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>5,
      'servic_id'=>$idds,
      'created_at'=>$date,
      'updated_at'=>$date1,
      ]
   );
   event(new MyEvent($dataa));
 } 
}else{
   $admin =DB::select('select users.id from users 
   join role_user on users.id=role_user.user_id
    where users.is_active=1 and role_user.role_id=5'); 
   foreach($admin as $ad){
      $message55555="";
      $date1=date("Y/m/d") ;
     $date=now(); 
     $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee' .$user_name. ' SEND <span class="text-success">'.$SIZE.'</span> Services Hotel   <span class=float-right text-muted text-sm>'.$date.'</span></a>';
     $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>5,
         'servic_id'=>$idds,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated Hotel Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>5,
       'servic_id'=>$idds,
       'created_at'=>$date,
       'updated_at'=>$date1,
       ]
    );
    event(new MyEvent($dataa));
}
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

  return back()->with('seccess','Seccess Data Send');
 
}
}




public function emp_hotel(){
    $loged_Id=  Auth::user()->id ;

    $data['data']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
    ->join('currency','currency.cur_id','=','hotel_services.ses_cur_id')
    ->where(['hotel_services.deleted'=>0,'hotel_services.user_status'=>1,'hotel_services.errorlog'=>0,'hotel_services.due_to_customer'=>$loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
//json_decode
    return view('emp_hotel',$data);
  }
  public function show_add_emp()
  {
    $loged_Id=  Auth::user()->id ;

   $data['data']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
   ->join('currency','currency.cur_id','=','hotel_services.ses_cur_id')
   ->join('employees','employees.emp_id','=','hotel_services.due_to_customer')
   ->where(['hotel_services.service_status'=>1,'hotel_services.deleted'=>0,'hotel_services.user_id'=> $loged_Id,'hotel_services.user_status'=>1])
   ->orderBy('hotel_services.created_at','DESC')->paginate(10);
  return view('hotelError',$data);
  } 
  public function errorHotel(){
    $loged_Id=  Auth::user()->id ;
    $data['data']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
    ->join('currency','currency.cur_id','=','hotel_services.ses_cur_id') 
    ->join('employees','employees.emp_id','=','hotel_services.due_to_customer')
    ->join('logs','logs.service_id','=','hotel_services.hotel_id')
    ->where(['hotel_services.errorlog'=>1,'hotel_services.user_status'=>0,'logs.status'=>0,'hotel_services.user_id'=>$loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
              return view('salesErrorHotel',$data);
    }
  
  public function accept($id){
    $loged_Id=  Auth::user()->id ;

    $affected2= HotelService::where(['hotel_id'=>$id])
    ->get();
    foreach($affected2 as $aff){     
      $customer=$aff->due_to_customer; 
      $how_add=$aff->user_id; 
    } 
    $message555="";
    $date1=date("Y/m/d") ;
    $date=now(); 
  $emp=Employee::all();
  foreach($emp as $emps){
  if($emps->emp_id==$loged_Id)
  {
  $name=$emps->emp_first_name.'  ';
  $name .=$emps->emp_last_name;
  
  }
  }
    $affected= HotelService::where(['hotel_id'=>$id])
    ->update(['user_id'=>$loged_Id,'user_status'=>0]);     
           /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

$message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$how_add.','.$loged_Id.') class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services Hotel That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$how_add,'from'=>$loged_Id ,'message'=> $message555,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
   ['sender' => $loged_Id, 
   'resiver' => $how_add,
   'body'=>$message ,
   'status'=>0 ,
   'main_service'=>5,
   'servic_id'=>$id,
   'created_at'=>$date,
   'updated_at'=>$date1,
   ]
);
$admin =DB::select('select users.id from users 
join role_user on users.id=role_user.user_id
 where users.is_active=1 and role_user.role_id IN (2,5)'); 
foreach($admin as $ad){
   $message55555="";
   $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$loged_Id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Hotel  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $dataa=['to'=>$ad->id,'from'=>$loged_Id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $loged_Id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>5,
      'servic_id'=>$id,
      'created_at'=>$date,
      'updated_at'=>$date1,
      ]
   );
   event(new MyEvent($dataa));
 } 
 event(new MyEvent($datav));
  /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

    return back()->with('seccess','Seccess Data Accept');
          }

  public function ignore($id){
    $loged_id=  Auth::user()->id ;
  
    $affected2= HotelService::where(['hotel_id'=>$id])
    ->get();
    foreach($affected2 as $aff){     
      $customer=$aff->due_to_customer; 
      $how_add=$aff->user_id; 
    } 
        $affected= HotelService::where(['hotel_id'=>$id])
    ->update(['errorlog'=>2]);
  
/***********************************NOTIFICATION CODE****************************** */
  /***********************************NOTIFICATION CODE****************************** */

  $message555="";
  $date1=date("Y/m/d") ;
  $date=now(); 
        $emp=Employee::all();
        foreach($emp as $emps){
          if($emps->emp_id==$loged_id)
         {
            $name=$emps->emp_first_name.'  ';
            $name .=$emps->emp_last_name;
            $customer=$emps->due_to_customer;
         
        }
      }
       
        $message555='<div class="dropdown-divider"></div><a onclick=status_notify("'.$id.'",'.$loged_id.','.$how_add.') href=/reject_hotel  class="dropdown-item"><i class="text-danger fas fa-times mr-2"></i>The employee '.$name.' Reject Medical service  That Added by you <span class="float-right text-muted text-sm">'.$date.'</span></a>';
        $datav=['to'=>$how_add,'from'=>$loged_id,'message'=> $message555,'date'=>$date];
        $message=$datav['message'];
        DB::table('notifications')->insert(
           ['sender' => $loged_id, 
           'resiver' => $how_add,
           'body'=>$message ,
           'status'=>0 ,
           'main_service'=>4,
           'servic_id'=>$id,
           'created_at'=>$date,
           'updated_at'=>$date1,
           ]
        );
        event(new MyEvent($datav));
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

          return back()->with('seccess','Seccess Data Reject');
          }

  public function reject_hotel()
  {
    $loged_Id=  Auth::user()->id ;

   $data['data']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
   ->join('currency','currency.cur_id','=','hotel_services.ses_cur_id')
   ->where(['hotel_services.deleted'=>0,'hotel_services.errorlog'=>2,'hotel_services.user_status'=>1,'hotel_services.user_id'=> $loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
  return view('reject_hotel',$data);
  } 
}
