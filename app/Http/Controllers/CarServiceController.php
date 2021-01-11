<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Service;
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
use Illuminate\Support\Facades\DB;
class CarServiceController extends Controller
{

    
public function show_car($id)
{
  $loged_Id=  Auth::user()->id ;

 $data['car']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
 ->join('currency','currency.cur_id','=','car_services.cur_id')
 ->where(['car_services.service_status'=>$id,'car_services.deleted'=>0,'car_services.errorlog'=>0,'car_services.user_id'=> $loged_Id,'car_services.user_status'=>0])->paginate(10);
return view('show_car',$data);
}  
public function sent_car($id)
{
  $loged_Id=  Auth::user()->id ;

 $data['car']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
 ->join('currency','currency.cur_id','=','car_services.cur_id')
 ->where(['car_services.service_status'=>$id,'car_services.deleted'=>0,'car_services.errorlog'=>0,'car_services.user_id'=> $loged_Id,'car_services.user_status'=>0])->paginate(10);
return view('sent_car',$data);
} 
public function hide_car($id){
    echo $id;
    $affected1=CarService::where('car_id',$id)
    ->update(['deleted'=>1]);
    return back()->with('seccess','Seccess Data Delete');
  }
  
  
public function generate( Request $req)
{
  $id=DB::table('car_services')->latest('voucher_number')->first();
  return json_decode($id->voucher_number+1);
} 

  public function update_Car($id){
    $data['airline']=Airline::where('is_active',1)->get();
          $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
          ->join('services','services.ser_id','=','sup_services.service_id')
          ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>3])->get();
          $data['emp']=Employee::where('is_active',1)->where('deleted',0)->get();      
        $data['cars']=CarService::join('currency','currency.cur_id','=','car_services.cur_id')
        ->join('suppliers','suppliers.s_no','=','car_services.due_to_supp')->where('car_id',$id)->get();
   
      return view('update_car',$data);
  }
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
    return back()->with('seccess','Seccess Data Delete');
   
 }
    }
    public function car(){
      $data['airline']=Airline::where('is_active',1)->get();
      $data['suplier']=Supplier::join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
      ->join('currency','currency.cur_id','=','sup_currency.cur_id')
      ->join('sup_services','sup_services.sup_id','=','suppliers.s_no')
      ->join('services','services.ser_id','=','sup_services.service_id')
      ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>3])->get();
      $data['emp']=Employee::where('is_active',1)->where('deleted',0)->get();      
     
          return view('add_car',$data);
      } 
     
public function add_car( Request $req)
{ 
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
    return redirect('/service/sales_repo')->with('seccess','Seccess Data Insert');
}

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
      'attachment'=>$img 

       ]); 

    }
    else{
      $car::where('car_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'car_status'=>$req->car_status,'car_info'=>$req->car_info,
       'voucher_number'=>$req->voucher_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>3,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1

       ]); 
    }
    return redirect('/service/sales_repo')->with('seccess','Seccess Data Insert');
  }
  public function deleteAllcar(Request $request){
    $ids = $request->input('ids');
    $dbs = CarService::where('car_id',$ids)
    ->update(['deleted'=>1]);
    return back();
}
public function sendAllcar(Request $request){
  $ids = $request->input('ids');
  $where=['car_id'=>$ids];
    $where +=['attachment'=>'null'];
    $affected1=CarService::where($where)->count();
    if($affected1 >0)
   { 
    return back()->with('error','Seccess Data Not send');

 }
  else{
   
    $dbs = CarService::where('car_id',$ids)->update(['service_status'=>2]);

    return back()->with('seccess','Seccess Data Delete');
   
 }
}
 
public function errorCar(){
  $loged_Id=  Auth::user()->id ;
  $data['data']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
  ->join('currency','currency.cur_id','=','car_services.cur_id')
  ->join('logs','logs.service_id','=','car_services.car_id')
  ->where(['car_services.errorlog'=>1,'car_services.user_status'=>0,'car_services.user_id'=>$loged_Id])->paginate(10);
  
            return view('salesErrorCar',$data);
  }


  public function reject_car()
  {
    $loged_Id=  Auth::user()->id ;

   $data['data']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
   ->join('currency','currency.cur_id','=','car_services.cur_id')
   ->where(['car_services.deleted'=>0,'car_services.errorlog'=>2,'car_services.user_status'=>1,'car_services.user_id'=> $loged_Id])->paginate(10);
  return view('reject_car',$data);
  } 

 
  public function emp_car(){
    $loged_Id=  Auth::user()->id ;

    $data['data']=CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
    ->join('currency','currency.cur_id','=','car_services.cur_id')
    ->where(['car_services.deleted'=>0,'car_services.user_status'=>1,'car_services.errorlog'=>0,'car_services.due_to_customer'=>$loged_Id])->paginate(10);
//json_decode
    return view('emp_car',$data);
  }

  public function accept($id){
    $loged_Id=  Auth::user()->id ;

    $affected= CarService::where(['car_id'=>$id])
    ->update(['user_id'=>$loged_Id,'user_status'=>0]);
    return back()->with('seccess','Seccess Data Delete');
  }

  public function ignore($id){
    $loged_Id=  Auth::user()->id ;
    $affected= CarService::where(['car_id'=>$id])
    ->update(['errorlog'=>2]);
    return back()->with('seccess','Seccess Data Delete');
  }

}

  
  
