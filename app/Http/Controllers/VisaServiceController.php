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
use App\VisaService;
use App\HotelService;
use App\MedicalService;
use App\GeneralService;
use App\User;
use App\users;
use Auth;
use App\Events\MyEvent;
use App\Events\Notification;
use Illuminate\Support\Facades\DB;

class VisaServiceController extends Controller
{
//
/**********************delete servuices*/

public function hide_visa($id){
echo $id;
$affected1=VisaService::where('visa_id',$id)
->update(['deleted'=>1]);
return redirect('services')->with('seccess','Seccess Data Delete');       
}
/**********************generate number of visa *****************************/

public function generate( Request $req)
{
$id=DB::table('visa_services')->latest()->first();
return json_decode($id->voucher_number+1);
}
/**********************show sent services*/

public function send_visa($id){
echo $id;
$where=['visa_id'=>$id];

$where +=['attachment'=>'null'];
$affected1=VisaService::where($where)->count();
if($affected1 >0)
{ 

json_encode('noorder');
}
else{
$affected= VisaService::where(['visa_id'=>$id])
->update(['service_status'=>2]);
return back()->with('seccess','Seccess Data Send');

}
}
/**********************show service  that added page*/

public function show_visa($id)
{
$loged_Id=  Auth::user()->id ;

$data['visa']=VisaService::join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
->join('currency','currency.cur_id','=','visa_services.ses_ses_cur_id')
->where(['visa_services.service_status'=>$id,'visa_services.deleted'=>0,'visa_services.errorlog'=>0,'visa_services.due_to_customer'=> $loged_Id])->orderBy('visa_services.created_at','DESC')->paginate(10);
return view('show_visa',$data);
} 

/**********************send single service*/

public function sent_visa($id)
{
$loged_Id=  Auth::user()->id ;

$data['visa']=VisaService::join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
->join('currency','currency.cur_id','=','visa_services.ses_cur_id')
->where(['visa_services.service_status'=>$id,'visa_services.deleted'=>0,'visa_services.errorlog'=>0,'visa_services.due_to_customer'=> $loged_Id])->orderBy('visa_services.created_at','DESC')->paginate(10);
return view('sent_visa',$data);
} 
/**********************show update page*/

public function update_visa($id){
$data['airline']=Airline::where('is_active',1)->get();
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>6])->get();
$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      

$data['visas']=VisaService::join('currency','currency.cur_id','=','visa_services.ses_cur_id')
->join('suppliers','suppliers.s_no','=','visa_services.due_to_supp') ->where('visa_id',$id)->get();

return view('update_visa',$data);
} 
/**********************show add page*/

public function visa(){
$data['airline']=Airline::where('is_active',1)->get();
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>6])->get();
$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      


return view('add_visa',$data);
} 
/**********************update services */

public function updateVisa( Request $req)
{ 
$visa=new VisaService;

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

$visa::where('visa_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'visa_status'=>$req->visa_status,'visa_type'=>$req->visa_type,'country'=>$req->country,'visa_info'=>$req->visa_info,
'voucher_number'=>$req->voucher_number,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>6,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
'attachment'=>$img ,'errorlog'=>0

]); 

}
else{
$visa::where('visa_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'visa_status'=>$req->visa_status,'visa_type'=>$req->visa_type,'country'=>$req->country,'visa_info'=>$req->visa_info,
'voucher_number'=>$req->voucher_number,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>6,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,'errorlog'=>0

]); 
}
return redirect('/service/show_visa/1')->with('seccess','Seccess Data Update');
}
/**********************update service of  error */

public function updateVisa2( Request $req)
{ 
$visa=new VisaService;

$visa::where('visa_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'visa_status'=>$req->visa_status,'visa_type'=>$req->visa_type,'country'=>$req->country,'visa_info'=>$req->visa_info,
'voucher_number'=>$req->voucher_number,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>6,'passnger_currency'=>$req->passnger_currency,'service_status'=>1,'errorlog'=>0

]); 
return redirect('/service/show_visa/1')->with('seccess','Seccess Data Update');
}

/**********************add visa services  */

public function add_visa( Request $req)
{ 


$visa=new VisaService;
$data = random_bytes(16);
$data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
$data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
$visa_id= vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
$visa->visa_id=$visa_id; 
$loged_id=  Auth::user()->id ;
if( $loged_id==$req->due_to_customer )
{
$visa->user_id= $loged_id;
$visa->user_status=0;

}
else{
$visa->user_id= $loged_id;
$visa->user_status=1;
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
$visa->attachment=$img;
}
else{
$visa->attachment='null';
}
$visa->Issue_date =$req->Issue_date;
$visa->refernce=$req->refernce;
$visa->passenger_name=$req->passenger_name;
$visa->voucher_number=$req->visa_number;
$visa->visa_status =$req->visa_status;
$visa->visa_type =$req->visa_type;
$visa->visa_info =$req->visa_info;
$visa->country  =$req->country ;
$visa->due_to_supp =$req->due_to_supp;
$visa->provider_cost=$req->provider_cost;
$visa->ses_cur_id=$req->cur_id;
$visa->due_to_customer =$req->due_to_customer ;
$visa->cost =$req->cost ;
$visa->service_id=6;
$visa->passnger_currency=$req->passnger_currency;
$visa->remark=$req->remark;
$visa->service_status=1;
$visa->save();
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

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Add Visa Service",'.$loged_id.','.$customer_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Visa  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer_id,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_id, 
'resiver' => $customer_id,
'body'=>$message ,
'status'=>0 ,
'main_service'=>6,
'servic_id'=>$visa_id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));
return redirect('/service/show_visa/1')->with('seccess','Seccess Data Insert');

}    else{
$emp=Employee::all();
foreach($emp as $emps){
if($emps->emp_id==$loged_id)
{
$name=$emps->emp_first_name.'  ';
$name .=$emps->emp_last_name;

}
}

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Visa service",'.$loged_id.','.$req->due_to_customer.') href=/emp_visa  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add services Visa by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_id, 
'resiver' => $req->due_to_customer,
'body'=>$message ,
'status'=>0 ,
'main_service'=>6,
'servic_id'=>$visa_id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));
return redirect('/service/sent_bus/2')->with('seccess','Seccess Data Insert');

}
}

/**********************delete multi services  */

public function deleteAllvisa(Request $request){
$ids = $request->input('ids');
$dbs = VisaService::where('visa_id',$ids)
->update(['deleted'=>1]);
return back()->with('seccess','Seccess Data Delete');
}
/**********************send multi services  */

public function sendAllvisa(Request $request){
$ids = $request->input('ids');
$where=['visa_id'=>$ids];
$where +=['attachment'=>'null'];
$affected1=VisaService::where($where)->count();
if($affected1 >0)
{ 
return back()->with('failed','failed Data  send');

}
else{

$dbs = VisaService::where('visa_id',$ids)->update(['service_status'=>2]);

return back()->with('seccess','Seccess Data Send');

}
}
/****************************show Err of Service in Sales Excutive   */
public function errorVisa(){
$loged_Id=  Auth::user()->id ;
$data['data']=VisaService::join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
->join('currency','currency.cur_id','=','visa_services.ses_cur_id')
->join('employees','employees.emp_id','=','visa_services.due_to_customer')
->join('logs','logs.service_id','=','visa_services.visa_id')
->where(['visa_services.errorlog'=>1,'visa_services.user_status'=>0,'visa_services.user_id'=>$loged_Id,'logs.status'=>0])->orderBy('visa_services.created_at','DESC')->paginate(10);
//json_decode
return view('salesErrorVisa',$data);
}
/**********************************outstanding services */
public function emp_visa(){
$loged_Id= Auth::user()->id ;

$data['data']=VisaService::join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
->join('currency','currency.cur_id','=','visa_services.ses_cur_id')
->where(['visa_services.deleted'=>0,'visa_services.user_status'=>1,'visa_services.errorlog'=>0,'visa_services.due_to_customer'=>$loged_Id])->orderBy('visa_services.created_at','DESC')->paginate(10);
//json_decode
return view('emp_visa',$data);
}
/**********************show  services added to other that added by me  *******************/

public function show_add_emp()
{
$loged_Id=  Auth::user()->id ;

$data['data']=VisaService::join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
->join('currency','currency.cur_id','=','visa_services.ses_cur_id')
->join('employees','employees.emp_id','=','visa_services.due_to_customer')
->where(['visa_services.service_status'=>1,'visa_services.deleted'=>0,'visa_services.user_id'=> $loged_Id,'visa_services.user_status'=>1])
->orderBy('visa_services.created_at','DESC')->paginate(10);
return view('visaError',$data);
} 

/**********************Accept services add by other */
public function accept($id){
$loged_Id=  Auth::user()->id ;

$affected2= VisaService::where(['visa_id'=>$id])
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

$affected= VisaService::where(['bus_id'=>$id])
->update(['user_id'=>$loged_Id,'user_status'=>0]);

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Accept Visa Service",'.$loged_Id.','.$customer.') href=/#  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services Visa That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer,'from'=>$loged_Id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_Id, 
'resiver' => $customer,
'body'=>$message ,
'status'=>0 ,
'main_service'=>6,
'servic_id'=>$id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));
return back()->with('seccess','Seccess Data Accept');

}
/**********************update services that have error log */

public function update_Visa2($id){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>3])->get();


$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      
$data['data']=VisaService::join('currency','currency.cur_id','=','visa_services.ses_cur_id')
->join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
->join('employees','employees.emp_id','=','visa_services.due_to_customer')
->join('logs','logs.service_id','=','visa_services.visa_id')
->where('visa_id',$id)->get();
foreach( $data['data'] as $aff){     
$sup=$aff->due_to_supp;
}
$data['cur']=Supplier::join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
->join('currency','currency.cur_id','=','sup_currency.cur_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'suppliers.s_no'=>$sup])->get();

return view('up_err_visa',$data);
} 

/**********************Reject services add by other */

public function ignore($id){
$loged_id=  Auth::user()->id ;

$affected2= VisaService::where(['visa_id'=>$id])
->get();
foreach($affected2 as $aff){     
$customer=$aff->due_to_customer; 
} 
$affected= VisaService::where(['visa_id'=>$id])
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

}
}

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Reject Visa Service",'.$loged_id.','.$customer.') href=/reject_visa  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Reject services Visa That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_id, 
'resiver' => $customer,
'body'=>$message ,
'status'=>0 ,
'main_service'=>6,
'servic_id'=>$id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));
return back()->with('seccess','Seccess Data Reject');


}

/**********************show the reject services  *******************/

public function reject_visa()
{
$loged_Id=  Auth::user()->id ;

$data['data']=VisaService::join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
->join('currency','currency.cur_id','=','visa_services.ses_cur_id')
->where(['visa_services.deleted'=>0,'visa_services.errorlog'=>2,'visa_services.user_status'=>1,'visa_services.user_id'=> $loged_Id])->orderBy('visa_services.created_at','DESC')->paginate(10);
return view('reject_visa',$data);
} 

}