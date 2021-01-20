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

class MedicalServiceController extends Controller
{
//



public function generate( Request $req)
{
$id=DB::table('medical_services')->latest()->first();
return json_decode($id->document_number+1);
}

public function show_med($id)
{
$loged_Id=  Auth::user()->id ;

$data['med']=MedicalService::join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
->join('currency','currency.cur_id','=','medical_services.ses_ses_cur_id')
->where(['medical_services.service_status'=>$id,'medical_services.deleted'=>0,'medical_services.errorlog'=>0,'medical_services.due_to_customer'=> $loged_Id])->orderBy('medical_services.created_at','DESC')->paginate(10);
return view('show_med',$data);
} 

public function sent_med($id)
{
$loged_Id=  Auth::user()->id ;

$data['med']=MedicalService::join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
->join('currency','currency.cur_id','=','medical_services.ses_cur_id')
->where(['medical_services.service_status'=>$id,'medical_services.deleted'=>0,'medical_services.errorlog'=>0,'medical_services.due_to_customer'=> $loged_Id])->orderBy('medical_services.created_at','DESC')->paginate(10);
return view('sent_med',$data);
} 


public function update_med($id){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>4])->get();
$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      
$data['meds']=MedicalService::join('currency','currency.cur_id','=','medical_services.ses_cur_id')
->join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')->where('med_id',$id)->get();

return view('update_med',$data);
} 


/**********************show update bus error services  *******************/

public function update_Med2($id){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>2])->get();


$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      
$data['data']=MedicalService::join('currency','currency.cur_id','=','medical_services.ses_cur_id')
->join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
->join('employees','employees.emp_id','=','medical_services.due_to_customer')
->join('logs','logs.service_id','=','medical_services.med_id')
->where('medical_services.med_id',$id)->get();
foreach( $data['data'] as $aff){     
$sup=$aff->due_to_supp;
}
$data['cur']=Supplier::join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
->join('currency','currency.cur_id','=','sup_currency.cur_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'suppliers.s_no'=>$sup])->get();

return view('up_err_med',$data)->with('seccess','Seccess Data Update');
} 
public function hide_med($id){
echo $id;
$affected1=MedicalService::where('med_id',$id)
->update(['deleted'=>1]);
return back()->with('seccess','Seccess Data Delete');
}
public function medical(){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>4])->get();
$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      
  
return view('add_medical',$data);
} 
public function send_med($id){
echo $id;
$where=['med_id'=>$id];

$where +=['attachment'=>'null'];
$affected1=MedicalService::where($where)->count();
if($affected1 >0)
{ 
json_encode('noorder');
}
else{
$affected= MedicalService::where(['med_id'=>$id])
->update(['service_status'=>2]);
return back()->with('seccess','Seccess Data Send'); 
}
}

public function add_Medical( Request $req)
{ 
$message5="";
$date1=date("Y/m/d") ;
$date=now();
$medical=new MedicalService;
$data = random_bytes(16);
$data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
$data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
$med_id= vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
$medical->med_id=$med_id; 
$loged_id=  Auth::user()->id ;
if( $loged_id==$req->due_to_customer )
{
$medical->user_id= $loged_id;
$medical->user_status=0;

}
else{
$medical->user_id= $loged_id;
$medical->user_status=1;
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
$medical->attachment=$img;
}
else{
$medical->attachment='null';
}
$medical->Issue_date =$req->Issue_date;
$medical->refernce=$req->refernce;
$medical->passenger_name=$req->passenger_name;
$medical->document_number=$req->document_number;
$medical->med_info=$req->med_info;
$medical->ses_status=$req->report_status;
$medical->from_city=$req->from_city;
$medical->due_to_supp =$req->due_to_supp;
$medical->provider_cost=$req->provider_cost;
$medical->ses_cur_id=$req->cur_id;
$medical->due_to_customer =$req->due_to_customer ;
$medical->cost =$req->cost ;
$medical->service_id=4;
$medical->passnger_currency=$req->passnger_currency;
$medical->remark=$req->remark;
$medical->service_status=1;
$medical->save();
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

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Add Medical Service",'.$loged_id.','.$customer_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Medical  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer_id,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_id, 
'resiver' => $customer_id,
'body'=>$message ,
'status'=>0 ,
'main_service'=>4,
'servic_id'=>$med_id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav)); 
return redirect('/service/show_medical/1')->with('seccess','Seccess Data Insert');
}    else{
$emp=Employee::all();
foreach($emp as $emps){
if($emps->emp_id==$loged_id)
{
  $name=$emps->emp_first_name.'  ';
  $name .=$emps->emp_last_name;

}
}

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Medical service",'.$loged_id.','.$req->due_to_customer.') href=/emp_med  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add Medical General by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
  ['sender' => $loged_id, 
  'resiver' => $req->due_to_customer,
  'body'=>$message ,
  'status'=>0 ,
  'main_service'=>4,
  'servic_id'=>$med_id,
  'created_at'=>$date,
  'updated_at'=>$date1,
  ]
);
event(new MyEvent($datav));
return redirect('/service/sent_bus/2')->with('seccess','Seccess Data Insert');

}
}


public function updateMed2( Request $req)
{ 
$medical=new MedicalService;

$img='';

$medical::where('med_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'ses_status'=>$req->report_status,'med_info'=>$req->med_info,
'document_number'=>$req->document_number,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>4,'passnger_currency'=>$req->passnger_currency,'service_status'=>1,'errorlog'=>0

]); 

return redirect('/service/show_medical/1')->with('seccess','Seccess Data Update');
}
public function updateMed( Request $req)
{ 
$medical=new MedicalService;

$img='';

$medical::where('med_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'ses_status'=>$req->report_status,'med_info'=>$req->med_info,
'document_number'=>$req->document_number,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>4,'passnger_currency'=>$req->passnger_currency,'service_status'=>1,'errorlog'=>0

]); 

return redirect('/service/show_medical/1')->with('seccess','Seccess Data Update');
}

public function deleteAllmed(Request $request){
$ids = $request->input('ids');
$dbs = MedicalService::where('med_id',$ids)
->update(['deleted'=>1]);
return back()->with('seccess','Seccess Data Delete');
}
public function sendAllmed(Request $request){
$ids = $request->input('ids');
$where=['med_id'=>$ids];
$where +=['attachment'=>'null'];
$affected1=MedicalService::where($where)->count();
if($affected1 >0)
{ 
return back()->with('failed','failed Data  send');

}
else{

$dbs = MedicalService::where('med_id',$ids)->update(['service_status'=>2]);

return back()->with('seccess','Seccess Data Send');

}
}


public function errorMed(){
$loged_Id=  Auth::user()->id ;
$data['data']=MedicalService::join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
->join('employees','employees.emp_id','=','medical_services.due_to_customer')
->join('currency','currency.cur_id','=','medical_services.ses_cur_id')
->join('logs','logs.service_id','=','medical_services.med_id')
->where(['medical_services.errorlog'=>1,'medical_services.user_status'=>0,'medical_services.user_id'=>$loged_Id,'logs.status'=>0])->orderBy('medical_services.created_at','DESC')->paginate(10);
//json_decode
return view('salesErrorMed',$data);
}

public function emp_med(){
$loged_Id=  Auth::user()->id ;

$data['data']=MedicalService::join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
->join('currency','currency.cur_id','=','medical_services.ses_cur_id')
->where(['medical_services.deleted'=>0,'medical_services.user_status'=>1,'medical_services.errorlog'=>0,'medical_services.due_to_customer'=>$loged_Id])->orderBy('medical_services.created_at','DESC')->paginate(10);
//json_decode
return view('emp_med',$data);
}
public function show_add_emp()
{
$loged_Id=  Auth::user()->id ;

$data['data']=MedicalService::join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
->join('currency','currency.cur_id','=','medical_services.ses_cur_id')
->join('employees','employees.emp_id','=','medical_services.due_to_customer')
->where(['medical_services.service_status'=>1,'medical_services.deleted'=>0,'medical_services.user_id'=> $loged_Id,'medical_services.user_status'=>1])
->orderBy('medical_services.created_at','DESC')->paginate(10);
return view('mederror',$data);
} 

public function accept($id){
$loged_Id=  Auth::user()->id ;

$affected2= MedicalService::where(['med_id'=>$id])
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
$affected= MedicalService::where(['med_id'=>$id])
->update(['user_id'=>$loged_Id,'user_status'=>0]);


$message5='<div class=dropdown-divider></div><a onclick=status_notify("Accept Medical Service",'.$loged_Id.','.$customer.') href=/#  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services Medical That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer,'from'=>$loged_Id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
  ['sender' => $loged_Id, 
  'resiver' => $customer,
  'body'=>$message ,
  'status'=>0 ,
  'main_service'=>4,
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

$affected2= CarService::where(['car_id'=>$id])
->get();
foreach($affected2 as $aff){     
$customer=$aff->due_to_customer; 
} 
$affected= MedicalService::where(['med_id'=>$id])
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

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Reject Medical Service",'.$loged_id.','.$customer.') href=/reject_med  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Reject services Medical That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
  ['sender' => $loged_id, 
  'resiver' => $customer,
  'body'=>$message ,
  'status'=>0 ,
  'main_service'=>4,
  'servic_id'=>$id,
  'created_at'=>$date,
  'updated_at'=>$date1,
  ]
);
event(new MyEvent($datav));
return back()->with('seccess','Seccess Data Reject');
}


public function reject_med()
{
$loged_Id=  Auth::user()->id ;

$data['data']=MedicalService::join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
->join('currency','currency.cur_id','=','medical_services.ses_cur_id')
->where(['medical_services.deleted'=>0,'medical_services.errorlog'=>2,'medical_services.user_status'=>1,'medical_services.user_id'=> $loged_Id])->orderBy('medical_services.created_at','DESC')->paginate(10);
return view('reject_med',$data);
} 
}
