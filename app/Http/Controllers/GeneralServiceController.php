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
->join('currency','currency.cur_id','=','general_services.cur_id')
->where(['general_services.service_status'=>$id,'general_services.deleted'=>0,'general_services.errorlog'=>0,'general_services.due_to_customer'=> $loged_Id])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('show_gen',$data);
}  

public function sent_gen($id)
{
$loged_Id=  Auth::user()->id ;

$data['gen']=GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.cur_id')
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

$data['gens']=GeneralService::join('currency','currency.cur_id','=','general_services.cur_id')
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
$general->offered_status =$req->offered_status;
$general->due_to_supp =$req->due_to_supp;
$general->provider_cost=$req->provider_cost;
$general->cur_id=$req->cur_id;
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
  
  
   
  $message5="";
  $date1=date("Y/m/d") ;
  $date=now();
  $manager=User::join('role_user','role_user.user_id','=','users.id')
  ->join('roles','roles.id','=','role_user.role_id')
  ->where('roles.id',2)->get();



  
  foreach($manager as $aff){     
      $customer_id=$aff->user_id; 
      $customer=$aff->user_name; 
} 
  
  $message5="";
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
       
        $message5='<div class=dropdown-divider></div><a onclick=status_notify("Add General Service",'.$loged_id.','.$customer_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services General  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
        $datav=['to'=>$customer_id,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
        $message=$datav['message'];
        DB::table('notifications')->insert(
           ['sender' => $loged_id, 
           'resiver' => $customer_id,
           'body'=>$message ,
           'status'=>0 ,
           'main_service'=>7,
           'servic_id'=>$gen_id,
           'created_at'=>$date,
           'updated_at'=>$date1,
           ]
        );
        event(new MyEvent($datav));
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

$message5='<div class=dropdown-divider></div><a onclick=status_notify("General service",'.$loged_id.','.$req->due_to_customer.') href=/emp_gen  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add services General by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
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
return redirect('/service/sent_bus/2')->with('seccess','Seccess Data Insert');

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
'offered_status'=>$req->offered_status,'gen_info'=>$req->gen_info,
'voucher_number'=>$req->voucher_number,'general_status'=>$req->general_status ,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>7,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
'attachment'=>$img ,'errorlog'=>0

]); 

}
else{
$general::where('gen_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'offered_status'=>$req->offered_status,'gen_info'=>$req->gen_info,
'voucher_number'=>$req->voucher_number,'general_status'=>$req->general_status ,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
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
'offered_status'=>$req->offered_status,'gen_info'=>$req->gen_info,
'voucher_number'=>$req->voucher_number,'general_status'=>$req->general_status ,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>7,'passnger_currency'=>$req->passnger_currency,'service_status'=>1,'errorlog'=>0

]); 
//return $req;
return redirect('/service/show_general/1')->with('seccess','Seccess Data Update');
}
public function deleteAllgen(Request $request){
$ids = $request->input('ids');
$dbs = GeneralService::where('gen_id',$ids)
->update(['deleted'=>1]);
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

$dbs = GeneralService::where('gen_id',$ids)->update(['service_status'=>2]);

return back()->with('seccess','Seccess Data Send');

}
}

public function show_add_emp()
{
$loged_Id=  Auth::user()->id ;

$data['data']=CarService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.cur_id')
->join('employees','employees.emp_id','=','general_services.due_to_customer')
->where(['general_services.service_status'=>1,'general_services.deleted'=>0,'general_services.user_id'=> $loged_Id,'general_services.user_status'=>1])
->orderBy('general_services.created_at','DESC')->paginate(10);
return view('genError',$data);
} 
public function errorGen(){
$loged_Id=  Auth::user()->id ;
$data['data']=GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.cur_id')
->join('employees','employees.emp_id','=','general_services.due_to_customer')
->join('logs','logs.service_id','=','general_services.gen_id')
->where(['general_services.errorlog'=>1,'general_services.user_status'=>0,'general_services.user_id'=>$loged_Id,'logs.status'=>0])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('salesErrorGen',$data);
}

public function emp_gen(){
$loged_Id=  Auth::user()->id ;

$data['data']=GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
->join('currency','currency.cur_id','=','general_services.cur_id')
->where(['general_services.deleted'=>0,'general_services.user_status'=>1,'general_services.errorlog'=>0,'general_services.due_to_customer'=>$loged_Id])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('emp_gen',$data);
}

public function accept($id){
$loged_Id=  Auth::user()->id ;
$affected2= GeneralService::where(['gen_id'=>$id])
->get();
foreach($affected2 as $aff){     
    $customer=$aff->due_to_customer; 
} 
$message5="";
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


      $message5='<div class=dropdown-divider></div><a onclick=status_notify("Accept General Service",'.$loged_Id.','.$customer.') href=/#  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services General That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      $datav=['to'=>$customer,'from'=>$loged_Id,'message'=> $message5,'date'=>$date];
      $message=$datav['message'];
      DB::table('notifications')->insert(
         ['sender' => $loged_Id, 
         'resiver' => $customer,
         'body'=>$message ,
         'status'=>0 ,
         'main_service'=>7,
         'servic_id'=>$id,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($datav));
return back()->with('seccess','Seccess Data Accept');
}
public function ignore($id){
$loged_id=  Auth::user()->id ;

$affected2= GeneralService::where(['gen_id'=>$id])
->get();
foreach($affected2 as $aff){     
$customer=$aff->due_to_customer; 
}
$affected= GeneralService::where(['gen_id'=>$id])
->update(['errorlog'=>2]);
$message5="";
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

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Reject General Service",'.$loged_id.','.$customer.') href=/reject_gen  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Reject services General That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_id, 
'resiver' => $customer,
'body'=>$message ,
'status'=>0 ,
'main_service'=>7,
'servic_id'=>$id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));
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
$data['data']=GeneralService::join('currency','currency.cur_id','=','general_services.cur_id')
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
->join('currency','currency.cur_id','=','general_services.cur_id')
->where(['general_services.deleted'=>0,'general_services.errorlog'=>2,'general_services.user_status'=>1,'general_services.user_id'=> $loged_Id])->orderBy('general_services.created_at','DESC')->paginate(10);
return view('reject_gen',$data);
} 
}
