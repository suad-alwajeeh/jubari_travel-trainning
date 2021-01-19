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
class CarServiceController extends Controller
{

/*************************************shoe car services***************** */    
public function show_car($id)
{
$loged_Id=  Auth::user()->id ;

$data['car']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
->join('currency','currency.cur_id','=','car_services.cur_id')
->where(['car_services.service_status'=>$id,'car_services.deleted'=>0,'car_services.errorlog'=>0,'car_services.user_id'=> $loged_Id,'car_services.user_status'=>0])->orderBy('car_services.created_at','DESC')->paginate(10);
return view('show_car',$data);
}  
/*************************************sent car services***************** */    

public function sent_car($id)
{
$loged_Id=  Auth::user()->id ;

$data['car']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
->join('currency','currency.cur_id','=','car_services.cur_id')
->where(['car_services.service_status'=>$id,'car_services.deleted'=>0,'car_services.errorlog'=>0,'car_services.user_id'=> $loged_Id,'car_services.user_status'=>0])->orderBy('car_services.created_at','DESC')->paginate(10);
return view('sent_car',$data);
} 
/*************************************delete car services***************** */    

public function hide_car($id){
echo $id;
$affected1=CarService::where('car_id',$id)
->update(['deleted'=>1]);
return back()->with('seccess','Seccess Data Delete');
}

/*************************************generate car number***************** */    

public function generate( Request $req)
{
$id=DB::table('car_services')->latest()->first();
return json_decode($id->voucher_number+1);
} 
/*************************************show update car services page***************** */    

public function update_Car($id){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>3])->get();
$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      

$data['cars']=CarService::join('currency','currency.cur_id','=','car_services.cur_id')
->join('suppliers','suppliers.s_no','=','car_services.due_to_supp')->where('car_id',$id)->get();

return view('update_car',$data);
}
/*************************************show update error  car services page***************** */    

public function update_Car2($id){
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>3])->get();


$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      
$data['data']=CarService::join('currency','currency.cur_id','=','car_services.cur_id')
->join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
->join('employees','employees.emp_id','=','car_services.due_to_customer')
->join('logs','logs.service_id','=','car_services.car_id')
->where('car_id',$id)->get();
foreach( $data['data'] as $aff){     
$sup=$aff->due_to_supp;
}
$data['cur']=Supplier::join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
->join('currency','currency.cur_id','=','sup_currency.cur_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'suppliers.s_no'=>$sup])->get();

return view('up_err_car',$data);
} 
/*************************************send single  car services ***************** */    

public function send_car($id){
echo $id;
$where=['car_id'=>$id];

$where +=['attachment'=>'null'];
$affected1=CarService::where($where)->count();
if($affected1 >0)
{ 
json_encode('noorder');
}
else{
$affected= CarService::where(['car_id'=>$id])
->update(['service_status'=>2]);
return redirect('/service/show_car/1')->with('seccess','Seccess Data Send');

}
}
/*************************************show add  car services page***************** */    

public function car(){
$data['airline']=Airline::where('is_active',1)->get();
$data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
->join('services','services.ser_id','=','sup_services.service_id')
->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>3])->get();
$data['emp']=Employee::join('users','users.id','=','employees.emp_id')
->where('users.is_active',1)->where('users.is_delete',0)
->where('employees.is_active',1)->where('employees.deleted',0)->get();      


return view('add_car',$data);
} 
/*************************************add car services page***************** */    

public function add_car( Request $req)
{ 
$message5="";
$date1=date("Y/m/d") ;
$date=now();
$car=new CarService;
$data = random_bytes(16);
$data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
$data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
$car_id= vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
$car->car_id=$car_id; 
$loged_id=  Auth::user()->id ;
if( $loged_id==$req->due_to_customer )
{
$car->user_id= $loged_id;
$car->user_status=0;

}
else{
$car->user_id= $loged_id;
$car->user_status=1;
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
$car->attachment=$img;
}
else{
$car->attachment='null';
}
$car->Issue_date =$req->Issue_date;
$car->refernce=$req->refernce;
$car->passenger_name=$req->passenger_name;
$car->voucher_number =$req->voucher_number;
$car->car_info =$req->car_info;
$car->car_status =$req->car_status;
$car->Dep_city =$req->Dep_city;
$car->arr_city =$req->arr_city;
$car->dep_date =$req->dep_date;
$car->due_to_supp =$req->due_to_supp;
$car->provider_cost=$req->provider_cost;
$car->cur_id=$req->cur_id;
$car->due_to_customer =$req->due_to_customer ;
$car->cost =$req->cost ;
$car->service_id=3;
$car->passnger_currency=$req->passnger_currency;
$car->remark=$req->remark;
$car->service_status=1;
$car->save();
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
'main_service'=>3,
'servic_id'=>$car_id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));

return redirect('/service/show_car/1')->with('seccess','Seccess Data Insert');
}    
else{
$emp=Employee::all();
foreach($emp as $emps){
if($emps->emp_id==$loged_id)
{
$name=$emps->emp_first_name.'  ';
$name .=$emps->emp_last_name;

}
}

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Car service",'.$loged_id.','.$req->due_to_customer.') href=/emp_car  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add services Car by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_id, 
'resiver' => $req->due_to_customer,
'body'=>$message ,
'status'=>0 ,
'main_service'=>3,
'servic_id'=>$car_id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));
return redirect('/service/sent_bus/2')->with('seccess','Seccess Data Insert');

}
}
/************************************* update car services page***************** */    

public function updateCar( Request $req)
{ 
$car=new CarService;

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

$car::where('car_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'car_status'=>$req->car_status,'car_info'=>$req->car_info,
'voucher_number'=>$req->voucher_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>3,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
'attachment'=>$img ,'errorlog'=>0

]); 

}
else{
$car::where('car_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'car_status'=>$req->car_status,'car_info'=>$req->car_info,
'voucher_number'=>$req->voucher_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>3,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,'errorlog'=>0

]); 
}
return redirect('/service/show_car/1')->with('seccess','Seccess Data Update');
}

/************************************* update error  car services page***************** */    

public function updateCar2( Request $req)
{ 
$car=new CarService;


$car::where('car_id',$req->id)
->update(['Issue_date'=>$req->Issue_date,
'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
'car_status'=>$req->car_status,'car_info'=>$req->car_info,
'voucher_number'=>$req->voucher_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
'cost'=>$req->cost,'service_id'=>3,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,'errorlog'=>0

]); 

return redirect('/service/show_car/1')->with('seccess','Seccess Data Update');
}
/*************************************delete multi car services page***************** */    

public function deleteAllcar(Request $request){
$ids = $request->input('ids');
$dbs = CarService::where('car_id',$ids)
->update(['deleted'=>1]);
return back()->with('seccess','Seccess Data Delete');
}
/*************************************send multi car services page***************** */    

public function sendAllcar(Request $request){
$ids = $request->input('ids');
$where=['car_id'=>$ids];
$where +=['attachment'=>'null'];
$affected1=CarService::where($where)->count();
if($affected1 >0)
{ 
return back()->with('failed','failed Data  send');

}
else{

$dbs = CarService::where('car_id',$ids)->update(['service_status'=>2]);

return back()->with('seccess','Seccess Data Send');

}
}
/**********************show  services add to other by me  *******************/

public function show_add_emp()
{
$loged_Id=  Auth::user()->id ;

$data['data']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
->join('currency','currency.cur_id','=','car_services.cur_id')
->join('employees','employees.emp_id','=','car_services.due_to_customer')
->where(['car_services.service_status'=>1,'car_services.deleted'=>0,'car_services.user_id'=> $loged_Id,'car_services.user_status'=>1])
->orderBy('car_services.created_at','DESC')->paginate(10);
return view('carError',$data);
} 
/**********************show error bus  services  page *******************/

public function errorCar(){
$loged_Id=  Auth::user()->id ;
$data['data']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
->join('currency','currency.cur_id','=','car_services.cur_id') 
->join('employees','employees.emp_id','=','car_services.due_to_customer')
->join('logs','logs.service_id','=','car_services.car_id')
->where(['car_services.errorlog'=>1,'car_services.user_status'=>0,'logs.status'=>0,'car_services.user_id'=>$loged_Id])->orderBy('car_services.created_at','DESC')->paginate(10);


return view('salesErrorCar',$data);
}

/**********************show reject car  services  page *******************/

public function reject_car()
{
$loged_Id=  Auth::user()->id ;

$data['data']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
->join('currency','currency.cur_id','=','car_services.cur_id')
->where(['car_services.deleted'=>0,'car_services.errorlog'=>2,'car_services.user_status'=>1,'car_services.user_id'=> $loged_Id])->orderBy('car_services.created_at','DESC')->paginate(10);
return view('reject_car',$data);
} 

/*******************Outstanding Service*********************************** */

public function emp_car(){
$loged_Id=  Auth::user()->id ;

$data['data']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
->join('currency','currency.cur_id','=','car_services.cur_id')
->where(['car_services.deleted'=>0,'car_services.user_status'=>1,'car_services.errorlog'=>0,'car_services.due_to_customer'=>$loged_Id])->orderBy('car_services.created_at','DESC')->paginate(10);
//json_decode
return view('emp_car',$data);
}
/*******************Accept Service*********************************** */

public function accept($id){
$loged_Id=  Auth::user()->id ;
$affected2= CarService::where(['car_id'=>$id])
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

$affected= CarService::where(['car_id'=>$id])
->update(['user_id'=>$loged_Id,'user_status'=>0]);


$message5='<div class=dropdown-divider></div><a onclick=status_notify("Accept Car Service",'.$loged_id.','.$customer.') href=/#  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services Car That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_id, 
'resiver' => $customer,
'body'=>$message ,
'status'=>0 ,
'main_service'=>3,
'servic_id'=>$id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));
return back()->with('seccess','Seccess Data Accept');
}
/*******************Reject Service*********************************** */

public function ignore($id){
$loged_id=  Auth::user()->id ;

$affected2= CarService::where(['car_id'=>$id])
->get();
foreach($affected2 as $aff){     
$customer=$aff->due_to_customer; 
} 
$affected= CarService::where(['car_id'=>$id])
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

$message5='<div class=dropdown-divider></div><a onclick=status_notify("Reject Car Service",'.$loged_id.','.$customer.') href=/reject_car  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Reject services Car That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
['sender' => $loged_id, 
'resiver' => $customer,
'body'=>$message ,
'status'=>0 ,
'main_service'=>3,
'servic_id'=>$id,
'created_at'=>$date,
'updated_at'=>$date1,
]
);
event(new MyEvent($datav));
return back()->with('seccess','Seccess Data Reject');
}

}


