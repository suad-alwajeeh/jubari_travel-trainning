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
use App\MedicalService;
use App\GeneralService;
use App\User;
use App\users;
use Auth;
use App\Events\MyEvent;
use App\Events\Notification;
use Illuminate\Support\Facades\DB;
class GeneralServiceController extends Controller
{


public function generate( Request $req)
{
$id=DB::table('general_services')->latest()->first();
return json_decode($id->voucher_number+1);
}

public function show_gen($id)
{
$loged_Id=  Auth::user()->id ;

$data['gen']=GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.ses_cur_id')
->where(['general_services.service_status'=>$id,'general_services.deleted'=>0,'general_services.errorlog'=>0,'general_services.due_to_customer'=> $loged_Id])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('show_gen',$data);
}  

public function sent_gen($id)
{
$loged_Id=  Auth::user()->id ;

$data['gen']=GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.ses_cur_id')
->where(['general_services.service_status'=>$id,'general_services.deleted'=>0,'general_services.errorlog'=>0,'general_services.due_to_customer'=> $loged_Id])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('sent_gen',$data);
} 
public function hide_gen($id){
echo $id;
$affected1=GeneralService::where('gen_id',$id)
->update(['deleted'=>1]);
return back()->with('seccess','Seccess Data Delete');

}
public function send_gen($id){
echo $id;
$where=['gen_id'=>$id];

$where +=['attachment'=>'null'];
$affected1=GeneralService::where($where)->count();
if($affected1 >0)
{ 

json_encode('noorder');
}
else{
$affected= GeneralService::where(['gen_id'=>$id])
->update(['service_status'=>2]);
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=GeneralService::where('gen_id',$id)
->join('employees','general_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','general_services.user_id as u_id','general_services.manager_id as manager_id','employees.emp_middel_name as n2')
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
   $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send General Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>7,
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
      $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send General Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>7,
         'servic_id'=>$id,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated General Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>7,
       'servic_id'=>$id,
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

public function update_gen($id){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>7])->get();
$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      

$data['gens']=GeneralService::join('currency','currency.cur_id','=','general_services.ses_cur_id')
->join('suppliers','suppliers.s_no','=','general_services.due_to_supp')->where('gen_id',$id)->get();

return view('update_gen',$data);
} 


public function general(){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>7])->get();
$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      

return view('add_general',$data);
} 


public function add_service( Request $req)
{ 
$message5="";
$date1=date("Y/m/d") ;
$date=now();
$general=new GeneralService;
$data = random_bytes(16);
$data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
$data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
$gen_id= vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
$general->gen_id=$gen_id; 
$loged_id=  Auth::user()->id ;
if( $loged_id==$req->due_to_customer )
{
$general->user_id= $loged_id;
$general->user_status=0;

}
else{
$general->user_id= $loged_id;
$general->user_status=1;
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
$img.=$attchmentName.',';

}
$general->attachment=$img;
}
else{
$general->attachment='null';
}
$general->Issue_date =$req->Issue_date;
$general->refernce=$req->refernce;
$general->passenger_name=$req->passenger_name;
$general->voucher_number=$req->voucher_number;
$general->gen_info =$req->med_info;
$general->general_status =$req->general_status;
$general->ses_status =$req->offered_status;
$general->due_to_supp =$req->due_to_supp;
$general->provider_cost=$req->provider_cost;
$general->ses_cur_id=$req->cur_id;
$general->due_to_customer =$req->due_to_customer ;
$general->cost =$req->cost ;
$general->service_id=7;
$general->passnger_currency=$req->passnger_currency;
$general->remark=$req->remark;
$general->busher_time=$req->busher_time;
$general->service_status=1;
$general->save();
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
         $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$gen_id.'",'.$loged_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services General  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $dataa=['to'=>$ad->id,'from'=>$loged_id,'message'=> $message55555,'date'=>$date];
         $messagea=$dataa['message'];
         $admin_notify=DB::table('notifications')->insert(
            ['sender' => $loged_id, 
            'resiver' => $ad->id,
            'body'=>$messagea ,
            'status'=>0 ,
         'main_service'=>7,
            'servic_id'=>$gen_id,
            'created_at'=>$date,
            'updated_at'=>$date1,
            ]
         );
         event(new MyEvent($dataa));
       } 
  /***********************************NOTIFICATION CODE****************************** */
  /***********************************NOTIFICATION CODE****************************** */
 
  return redirect('/service/show_general/1')->with('seccess','Seccess Data Insert');
}    else{
  $emp=Employee::all();
  foreach($emp as $emps){
  if($emps->emp_id==$loged_id)
  {
    $name=$emps->emp_first_name.'  ';
    $name .=$emps->emp_last_name;
  
  }
  }
  $message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$gen_id.'",'.$loged_id.','.$req->due_to_customer.') href=/emp_gen  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add services General by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message555,'date'=>$date];
  $message=$datav['message'];
  DB::table('notifications')->insert(
     ['sender' => $loged_id, 
     'resiver' => $req->due_to_customer,
     'body'=>$message ,
     'status'=>0 ,
  'main_service'=>7,
     'servic_id'=>$gen_id,
     'created_at'=>$date,
     'updated_at'=>$date1,
     ]
  );
  event(new MyEvent($datav));

return redirect('/service/sent_general/2')->with('seccess','Seccess Data Insert');

}
}


public function updateGen( Request $req)
{ 
$general=new GeneralService;

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

$general::where('gen_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'ses_status'=>$req->offered_status,'gen_info'=>$req->gen_info,
'voucher_number'=>$req->voucher_number,'general_status'=>$req->general_status ,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>7,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
'attachment'=>$img ,'errorlog'=>0

]); 

}
else{
$general::where('gen_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'ses_status'=>$req->offered_status,'gen_info'=>$req->gen_info,
'voucher_number'=>$req->voucher_number,'general_status'=>$req->general_status ,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>7,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,'errorlog'=>0

]); 
}
return redirect('/service/show_general/1')->with('seccess','Seccess Data Update');
}


public function updateGen2( Request $req)
{ 
$general=new GeneralService;

$img='';

$general::where('gen_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'ses_status'=>$req->offered_status,'gen_info'=>$req->gen_info,
'voucher_number'=>$req->voucher_number,'general_status'=>$req->general_status ,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>7,'passnger_currency'=>$req->passnger_currency,'service_status'=>1,'errorlog'=>0

]); 
//return $req;
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
$affectedm= GeneralService::where(['gen_id'=>$req->id])
->get();
foreach($affectedm as $affm){     
  $manager=$affm->manager_id; 
echo $affm->gen_id;
  $message55555="";
  $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$req->id.'",'.$loged_id.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' edit General Services with remark <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $dataa=['to'=>$manager,'from'=>$loged_id,'message'=> $message55555,'date'=>$date];
  print_r($dataa);
  $messagea=$dataa['message'];
  $admin_notify=DB::table('notifications')->insert(
     ['sender' => $loged_id, 
     'resiver' => $manager,
     'body'=>$messagea ,
     'status'=>0 ,
  'main_service'=>7,
     'servic_id'=>$req->id,
     'created_at'=>$date,
     'updated_at'=>$date1,
     ]
  );
  event(new MyEvent($dataa));
}
    /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

return redirect('/service/show_general/1')->with('seccess','Seccess Data Update');
}
public function deleteAllgen(Request $request){
$ids = $request->input('ids');
foreach($ids as $mm){
$dbs = GeneralService::where('gen_id',$mm)
->update(['deleted'=>1]);
}
return back()->with('seccess','Seccess Data Delete');
}
public function sendAllgen(Request $request){
$ids = $request->input('ids');
$where=['gen_id'=>$ids];
$where +=['attachment'=>'null'];
$affected1=GeneralService::where($where)->count();
if($affected1 >0)
{ 
return back()->with('failed','failed Data  send');

}
else{
  foreach($ids as $mm){
$dbs = GeneralService::where('gen_id',$mm)->update(['service_status'=>2]);
  }
  /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=GeneralService::where('gen_id',$ids)
->join('employees','general_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','general_services.user_id as u_id','general_services.manager_id as manager_id','employees.emp_middel_name as n2')
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
  $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee' .$user_name. ' SEND <span class="text-success">'.$SIZE.'</span> Services General   <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>7,
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
     $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee' .$user_name. ' SEND <span class="text-success">'.$SIZE.'</span> Services General   <span class=float-right text-muted text-sm>'.$date.'</span></a>';
     $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>7,
         'servic_id'=>$idds,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated General Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>7,
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

public function show_add_emp()
{
$loged_Id=  Auth::user()->id ;

$data['data']=CarService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.ses_cur_id')
->join('employees','employees.emp_id','=','general_services.due_to_customer')
->where(['general_services.service_status'=>1,'general_services.deleted'=>0,'general_services.user_id'=> $loged_Id,'general_services.user_status'=>1])
->orderBy('general_services.created_at','DESC')->paginate(10);
return view('genError',$data);
} 
public function errorGen(){
$loged_Id=  Auth::user()->id ;
$data['data']=GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.ses_cur_id')
->join('employees','employees.emp_id','=','general_services.due_to_customer')
->join('logs','logs.service_id','=','general_services.gen_id')
->where(['general_services.errorlog'=>1,'general_services.user_status'=>0,'general_services.user_id'=>$loged_Id,'logs.status'=>0])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('salesErrorGen',$data);
}

public function emp_gen(){
$loged_Id=  Auth::user()->id ;

$data['data']=GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.ses_cur_id')
->where(['general_services.deleted'=>0,'general_services.user_status'=>1,'general_services.errorlog'=>0,'general_services.due_to_customer'=>$loged_Id])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('emp_gen',$data);
}

public function accept($id){
$loged_Id=  Auth::user()->id ;
$affected2= GeneralService::where(['gen_id'=>$id])
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
$affected= GeneralService::where(['gen_id'=>$id])
->update(['user_id'=>$loged_Id,'user_status'=>0]);
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

$message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$how_add.','.$loged_Id.') class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services General That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$how_add,'from'=>$loged_Id ,'message'=> $message555,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
   ['sender' => $loged_Id, 
   'resiver' => $how_add,
   'body'=>$message ,
   'status'=>0 ,
   'main_service'=>7,
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
   $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$loged_Id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services General  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $dataa=['to'=>$ad->id,'from'=>$loged_Id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $loged_Id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>7,
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

$affected2= GeneralService::where(['gen_id'=>$id])
->get();
foreach($affected2 as $aff){     
  $customer=$aff->due_to_customer; 
  $how_add=$aff->user_id; 
} 
$affected= GeneralService::where(['gen_id'=>$id])
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
       
        $message555='<div class="dropdown-divider"></div><a onclick=status_notify("'.$id.'",'.$loged_id.','.$how_add.') href=/reject_gen  class="dropdown-item"><i class="text-danger fas fa-times mr-2"></i>The employee '.$name.' Reject General service  That Added by you <span class="float-right text-muted text-sm">'.$date.'</span></a>';
        $datav=['to'=>$how_add,'from'=>$loged_id,'message'=> $message555,'date'=>$date];
        $message=$datav['message'];
        DB::table('notifications')->insert(
           ['sender' => $loged_id, 
           'resiver' => $how_add,
           'body'=>$message ,
           'status'=>0 ,
           'main_service'=>7,
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

/**********************update services that have error log */

public function update_Gen2($id){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>3])->get();


$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      
$data['data']=GeneralService::join('currency','currency.cur_id','=','general_services.ses_cur_id')
->join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('employees','employees.emp_id','=','general_services.due_to_customer')
->join('logs','logs.service_id','=','general_services.gen_id')
->where('gen_id',$id)->get();
foreach( $data['data'] as $aff){     
$sup=$aff->due_to_supp;
}
$data['cur']=Supplier::join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
->join('currency','currency.cur_id','=','sup_currency.cur_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'suppliers.s_no'=>$sup])->get();

return view('up_err_gen',$data);
} 
public function reject_gen()
{
$loged_Id=  Auth::user()->id ;

$data['data']=GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.ses_cur_id')
->where(['general_services.deleted'=>0,'general_services.errorlog'=>2,'general_services.user_status'=>1,'general_services.user_id'=> $loged_Id])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('reject_gen',$data);
} 
}
