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
use Illuminate\Support\Facades\DB;
class BusServiceController extends Controller
{
    //

    public function show_bus($id)
    {
      $loged_Id=  Auth::user()->id ;

     $data['bus']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
     ->join('currency','currency.cur_id','=','bus_services.cur_id')
     ->where(['bus_services.service_status'=>$id,'bus_services.deleted'=>0,'bus_services.errorlog'=>0,'bus_services.due_to_customer'=> $loged_Id])->paginate(10);
    return view('show_bus',$data);
    } 
 public function sent_bus($id)
    {
      $loged_Id=  Auth::user()->id ;

     $data['bus']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
     ->join('currency','currency.cur_id','=','bus_services.cur_id')
     ->where(['bus_services.service_status'=>$id,'bus_services.deleted'=>0,'bus_services.errorlog'=>0,'bus_services.due_to_customer'=> $loged_Id])->paginate(10);
    return view('sent_bus',$data);
    } 


public function generate( Request $req)
{
  $id=DB::table('bus_services')->latest()->first();
  return json_decode($id->bus_number+1);
}
    public function show_add_emp()
    {
      $loged_Id=  Auth::user()->id ;

     $data['bus']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
     ->join('currency','currency.cur_id','=','bus_services.cur_id')
     ->join('employees','employees.emp_id','=','bus_services.due_to_customer')
     ->where(['bus_services.service_status'=>1,'bus_services.deleted'=>0,'bus_services.user_id'=> $loged_Id,'bus_services.user_status'=>1])->paginate(10);
    return view('show_emp_bus',$data);
    } 
    public function bus(){
      $data['airline']=Airline::where('is_active',1)->get();
      $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
      ->join('services','services.ser_id','=','sup_services.service_id')
      ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>2])->get();
      $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
          return view('add_bus',$data);
      } 

      
public function add_bus( Request $req)
{ 

   $bus=new BusService;
   $data = random_bytes(16);
   $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
   $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
   $bus_id2= vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));

    $loged_id=  Auth::user()->id ;
    if( $loged_id==$req->due_to_customer )
    {
      $bus->user_id= $loged_id;
      $bus->user_status=0;

    }
    else{
      $bus->user_id= $loged_id;
      $bus->user_status=1;
    }
    if($req->hasfile('attachment'))
    {
       $attchmentFile =$req->file('attachment') ;
       $num=count($attchmentFile);
      for($i=0;$i<$num;$i++){
         $ext=$attchmentFile[$i]->getClientOriginalExtension();
       $attchmentName =rand(123456,999999).".".$ext;
       $attchment=$attchmentFile[$i]->move('img/user_attchment/',$attchmentName);
       $bus->attachment .=$attchmentName.',';
   
       }
   

    }
    else{
      $bus->attachment='null';
    }
    $bus->Issue_date =$req->Issue_date;
    $bus->refernce=$req->refernce;
    $bus->passenger_name=$req->passenger_name;
    $bus->bus_name =$req->bus_name;
    $bus->bus_number =$req->bus_number;
    $bus->bus_status =$req->bus_status;
    $bus->Dep_city =$req->Dep_city;
    $bus->arr_city =$req->arr_city;
    $bus->dep_date =$req->dep_date;
    $bus->due_to_supp =$req->due_to_supp;
    $bus->provider_cost=$req->provider_cost;
    $bus->cur_id=$req->cur_id;
    $bus->due_to_customer =$req->due_to_customer ;
    $bus->cost =$req->cost ;
    $bus->service_id=2;
    $bus->passnger_currency=$req->passnger_currency;
    $bus->remark=$req->remark;
    $bus->service_status=1;
    $bus->bus_id=$bus_id2;
    $bus->save();
    if( $loged_id==$req->due_to_customer )
{    
  return redirect('/service/show_bus/1')->with('seccess','Seccess Data Insert');
} 
else{
  return redirect('/service/show_bus/1')->with('seccess','Seccess Data Insert');

}
 }
public function updateBus( Request $req)
{ 
    $bus=new BusService;

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

       $bus::where('bus_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'bus_name'=>$req->bus_name,'bus_status'=>$req->bus_status,
       'bus_number'=>$req->bus_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>2,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
      'attachment'=>$img 

       ]); 

    }
    else{
      $bus::where('bus_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'bus_name'=>$req->bus_name,'bus_status'=>$req->bus_status,
       'bus_number'=>$req->bus_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>2,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1

       ]); 
    }
    return redirect('/service/show_bus/1')->with('seccess','Seccess Data Update');
  }


    public function update_Bus($id){
      $data['airline']=Airline::where('is_active',1)->get();
          $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
          ->join('services','services.ser_id','=','sup_services.service_id')
          ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>2])->get();
          $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
               
          $data['buss']=BusService::join('currency','currency.cur_id','=','bus_services.cur_id')
          ->join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')->where('bus_id',$id)->get();
       
          return view('update_bus',$data);
      } 

    public function send_bus($id){
        echo $id;
        $where=['bus_id'=>$id];

        $where +=['attachment'=>'null'];
        $affected1=BusService::where($where)->count();
        if($affected1 >0)
       { 
       
     //return redirect('service')->with('Erroe','Seccess Data Delete');
     json_encode('noorder');
    // print_r(json_encode($x));
     }
      else{
        $affected= BusService::where(['bus_id'=>$id])
        ->update(['service_status'=>2]);
        return redirect('/service/show_bus/1')->with('seccess','Seccess Data Send');
       
     }
        }

    public function hide_bus($id){
        echo $id;
        $affected1= BusService::where('bus_id',$id)
        ->update(['deleted'=>1]);
     
        return back()->with('seccess','Seccess Data Delete');
    
        }
        public function deleteAllbus(Request $request){
          $ids = $request->input('ids');
          $dbs = BusService::where('bus_id',$ids)
          ->update(['deleted'=>1]);
          return back()->with('seccess','Seccess Data Delete');
        }
      public function sendAllbus(Request $request){
        $ids = $request->input('ids');
        $where=['bus_id'=>$ids];
          $where +=['attachment'=>'null'];
          $affected1=BusService::where($where)->count();
          if($affected1 >0)
         { 
          return back()->with('failed','failed Data  send');
      
       }
        else{
         
          $dbs = BusService::where('bus_id',$ids)->update(['service_status'=>2]);
    
          return back()->with('seccess','Seccess Data Send');
         
       }
    }
    public function errorBus(){
      $loged_Id=  Auth::user()->id ;
                $data['data']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
                ->join('currency','currency.cur_id','=','bus_services.cur_id')
                ->join('logs','logs.service_id','=','bus_services.bus_id')
                ->where(['bus_services.errorlog'=>1,'bus_services.user_status'=>0])->paginate(10);
                return view('salesErrorBus',$data);
      }
      public function update_Bus2($id){
        $data['airline']=Airline::where('is_active',1)->get();
            $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
            ->join('services','services.ser_id','=','sup_services.service_id')
            ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>2])->get();
            $data['emp']=Employee::where('is_active',1)->where('deleted',0)->get();      
            $data['data']=BusService::join('currency','currency.cur_id','=','bus_services.cur_id')
            ->join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
            ->join('logs','logs.service_id','=','bus_services.bus_id')
            ->where('bus_services.bus_id',$id)->get();
         
            return view('salesUpdateBus',$data);
        } 
  
        public function emp_bus(){
          $loged_Id=  Auth::user()->id ;
  
          $data['data']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
          ->join('currency','currency.cur_id','=','bus_services.cur_id')
          ->where(['bus_services.deleted'=>0,'bus_services.user_status'=>1,'bus_services.errorlog'=>0,'due_to_customer'=>$loged_Id])->paginate(10);
  //json_decode
          return view('emp_bus',$data);
        }
        
        public function accept($id){
          $loged_Id=  Auth::user()->id ;
  
          $affected= BusService::where(['bus_id'=>$id])
          ->update(['user_id'=>$loged_Id,'user_status'=>0]);
          return back()->with('seccess','Seccess Data Accept');
        }
  
        public function ignore($id){
          $loged_Id=  Auth::user()->id ;
          $affected= BusService::where(['bus_id'=>$id])
          ->update(['errorlog'=>2]);
          return back()->with('seccess','Seccess Data Reject');
        }
        public function reject_bus()
        {
          $loged_Id=  Auth::user()->id ;
    
         $data['data']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
         ->join('currency','currency.cur_id','=','bus_services.cur_id')
         ->where(['bus_services.deleted'=>0,'bus_services.errorlog'=>2,'bus_services.user_status'=>1,'bus_services.user_id'=> $loged_Id])->paginate(10);
        return view('reject_bus',$data);
        } 
}
