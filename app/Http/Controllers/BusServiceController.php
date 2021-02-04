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
class BusServiceController extends Controller
{
    //
/**********************show  services  *******************/

    public function show_bus($id)
    {
      $loged_Id=  Auth::user()->id ;

     $data['bus']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
     ->join('currency','currency.cur_id','=','bus_services.ses_cur_id')
     ->where(['bus_services.service_status'=>$id,'bus_services.deleted'=>0,'bus_services.errorlog'=>0,'bus_services.due_to_customer'=> $loged_Id])->orderBy('bus_services.created_at','DESC')->paginate(10);
    return view('show_bus',$data);
    } 
/**********************show sent services  *******************/

 public function sent_bus($id)
    {
      $loged_Id=  Auth::user()->id ;

     $data['bus']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
     ->join('currency','currency.cur_id','=','bus_services.ses_cur_id')
     ->where(['bus_services.service_status'=>$id,'bus_services.deleted'=>0,'bus_services.errorlog'=>0,'bus_services.due_to_customer'=> $loged_Id])->orderBy('bus_services.created_at','DESC')->paginate(10);
    return view('sent_bus',$data);
    } 

/**********************generate bus number *******************/

public function generate( Request $req)
{
  $id=DB::table('bus_services')->latest()->first();
  return json_decode($id->bus_number+1);
}
/**********************show  services add to other by me  *******************/

    public function show_add_emp()
    {
      $loged_Id=  Auth::user()->id ;

     $data['data']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
     ->join('currency','currency.cur_id','=','bus_services.ses_cur_id')
     ->join('employees','employees.emp_id','=','bus_services.due_to_customer')
     ->where(['bus_services.service_status'=>1,'bus_services.deleted'=>0,'bus_services.user_id'=> $loged_Id,'bus_services.user_status'=>1])
     ->orderBy('bus_services.created_at','DESC')->paginate(10);
    return view('Buserror',$data);
    } 
/**********************show add bus services  *******************/

    public function bus(){
      $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
      ->join('services','services.ser_id','=','sup_services.service_id')
      ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>2])->get();
      $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
          return view('add_bus',$data);
      } 

/**********************add bus services  *******************/
      
public function add_bus( Request $req)
{ 
  $message555="";
  $date1=date("Y/m/d") ;
  $date=now();
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
    $bus->ses_status =$req->bus_status;
    $bus->Dep_city =$req->Dep_city;
    $bus->arr_city =$req->arr_city;
    $bus->dep_date =$req->dep_date;
    $bus->due_to_supp =$req->due_to_supp;
    $bus->provider_cost=$req->provider_cost;
    $bus->ses_cur_id=$req->cur_id;
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
  
  /***********************************NOTIFICATION CODE****************************** */
  /***********************************NOTIFICATION CODE****************************** */
  
  $manager=User::join('role_user','role_user.user_id','=','users.id')
  ->join('roles','roles.id','=','role_user.role_id')
  ->where('roles.id',2)->get();


  foreach($manager as $aff){     
      $customer_id=$aff->user_id; 
      $customer=$aff->user_name; 
} 
  
  
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
         $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$bus_id2.'",'.$loged_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Bus  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $dataa=['to'=>$ad->id,'from'=>$loged_id,'message'=> $message55555,'date'=>$date];
         $messagea=$dataa['message'];
         $admin_notify=DB::table('notifications')->insert(
            ['sender' => $loged_id, 
            'resiver' => $ad->id,
            'body'=>$messagea ,
            'status'=>0 ,
         'main_service'=>2,
            'servic_id'=>$bus_id2,
            'created_at'=>$date,
            'updated_at'=>$date1,
            ]
         );
         event(new MyEvent($dataa));
       } 
  /***********************************NOTIFICATION CODE****************************** */
  /***********************************NOTIFICATION CODE****************************** */
  return redirect('/service/show_bus/1')->with('seccess','Seccess Data Insert');
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
  $message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$bus_id2.'",'.$loged_id.','.$req->due_to_customer.') href=/emp_bus  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add services Bus by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message555,'date'=>$date];
  $message=$datav['message'];
  DB::table('notifications')->insert(
     ['sender' => $loged_id, 
     'resiver' => $req->due_to_customer,
     'body'=>$message ,
     'status'=>0 ,
  'main_service'=>2,
     'servic_id'=>$bus_id2,
     'created_at'=>$date,
     'updated_at'=>$date1,
     ]
  );
  event(new MyEvent($datav));

 return redirect('/service/show_bus/1')->with('seccess','Seccess Data Insert');

}
 }
/**********************updste busservices  *******************/

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
       'bus_name'=>$req->bus_name,'ses_status'=>$req->bus_status,
       'bus_number'=>$req->bus_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>2,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
      'attachment'=>$img ,'errorlog'=>0

       ]); 

    }
    else{
      $bus::where('bus_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'bus_name'=>$req->bus_name,'ses_status'=>$req->bus_status,
       'bus_number'=>$req->bus_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>2,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,'errorlog'=>0

       ]); 
    }
    return redirect('/service/show_bus/1')->with('seccess','Seccess Data Update');
  }

/**********************update bus error services  *******************/

  public function updateBus2( Request $req)
{ 
    $bus=new BusService;
        $bus::where('bus_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'bus_name'=>$req->bus_name,'ses_status'=>$req->bus_status,
       'bus_number'=>$req->bus_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>2,'passnger_currency'=>$req->passnger_currency,'service_status'=>1,
     'errorlog'=>0

       ]); 
$db=DB::delete('delete from logs where service_id="'.$req->id.'"');
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=BusService::where('bus_id',$id)
->join('employees','bus_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','bus_services.user_id as u_id','bus_services.manager_id as manager_id','employees.emp_middel_name as n2')
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
   $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send Bus Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>2,
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
      $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send Bus Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>2,
         'servic_id'=>$id,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated Bus Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>2,
       'servic_id'=>$id,
       'created_at'=>$date,
       'updated_at'=>$date1,
       ]
    );
    event(new MyEvent($dataa));
}
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

    return redirect('/service/show_bus/1')->with('seccess','Seccess Data Update');
  }
/**********************show update bus  services  page *******************/

    public function update_Bus($id){
      $data['airline']=Airline::where('is_active',1)->get();
          $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
          ->join('services','services.ser_id','=','sup_services.service_id')
          ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>2])->get();
          $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
               
          $data['buss']=BusService::join('currency','currency.cur_id','=','bus_services.ses_cur_id')
          ->join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')->where('bus_id',$id)->get();
       
          return view('update_bus',$data);
      } 
/**********************send singel services  *******************/

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
        /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=BusService::where('bus_id',$id)
->join('employees','bus_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','bus_services.user_id as u_id','bus_services.manager_id as manager_id','employees.emp_middel_name as n2')
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
   $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send Bus Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>2,
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
      $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send Bus Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>2,
         'servic_id'=>$id,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated Bus Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>2,
       'servic_id'=>$id,
       'created_at'=>$date,
       'updated_at'=>$date1,
       ]
    );
    event(new MyEvent($dataa));
}
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

        return redirect('/service/show_bus/1')->with('seccess','Seccess Data Send');
       
     }
        }
/**********************delete services  *******************/

    public function hide_bus($id){
        echo $id;
        $affected1= BusService::where('bus_id',$id)
        ->update(['deleted'=>1]);
     
        return back()->with('seccess','Seccess Data Delete');
    
        }
/**********************delete multi service services  *******************/

        public function deleteAllbus(Request $request){
          $ids = $request->input('ids');
          foreach($ids as $mm){
          $dbs = BusService::where('bus_id',$mm)
          ->update(['deleted'=>1]);
          }
          return back()->with('seccess','Seccess Data Delete');
        }
/**********************send multi services  *******************/

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
          foreach($ids as $mm){
          $dbs = BusService::where('bus_id',$mm)->update(['service_status'=>2]);
          }
          /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=BusService::where('bus_id',$ids)
->join('employees','bus_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','bus_services.user_id as u_id','bus_services.manager_id as manager_id','employees.emp_middel_name as n2')
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
  $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee' .$user_name. ' SEND <span class="text-success">'.$SIZE.'</span> Services Bus   <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>2,
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
     $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee' .$user_name. ' SEND <span class="text-success">'.$SIZE.'</span> Services Bus   <span class=float-right text-muted text-sm>'.$date.'</span></a>';
     $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>2,
         'servic_id'=>$idds,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated Bus Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>2,
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
/**********************show error bus  services  page *******************/

    public function errorBus(){
      $loged_Id=  Auth::user()->id ;
                $data=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
                ->join('currency','currency.cur_id','=','bus_services.ses_cur_id')
                ->join('employees','employees.emp_id','=','bus_services.due_to_customer')
                ->join('logs','logs.service_id','=','bus_services.bus_id')
                ->where(['bus_services.errorlog'=>1,'bus_services.user_status'=>0,'logs.status'=>0,'bus_services.user_id'=>$loged_Id])->orderBy('bus_services.created_at','DESC')->paginate(10);
                $affected =DB::table('logs')->select('remark_body')->get();

                $m= (explode("|",$affected));
                $mv=[];
                foreach($m as $mm)
                {
                  $ss= explode(",",$mm);
                  array_push($mv,$ss); 
                   
                } 
               
                return view('salesErrorBus',['data'=>$data,'err'=>$mv]);
      }
/**********************show update bus error services  *******************/

      public function update_Bus2($id){
            $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
            ->join('services','services.ser_id','=','sup_services.service_id')
            ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>2])->get();
           
           
            $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
             $data['data']=BusService::join('currency','currency.cur_id','=','bus_services.ses_cur_id')
            ->join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
            ->join('employees','employees.emp_id','=','bus_services.due_to_customer')
              ->join('logs','logs.service_id','=','bus_services.bus_id')
            ->where('bus_services.bus_id',$id)->get();
            foreach( $data['data'] as $aff){     
              $sup=$aff->due_to_supp;
            }
            $data['cur']=Supplier::join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
            ->join('currency','currency.cur_id','=','sup_currency.cur_id')
            ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'suppliers.s_no'=>$sup])->get();
          
            return view('up_err_bus',$data)->with('seccess','Seccess Data Update');
        } 
  /*******************Outstanding Service*********************************** */
        public function emp_bus(){
          $loged_Id=  Auth::user()->id ;
  
          $data['data']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
          ->join('currency','currency.cur_id','=','bus_services.ses_cur_id')
          ->where(['bus_services.deleted'=>0,'bus_services.user_status'=>1,'bus_services.errorlog'=>0,'due_to_customer'=>$loged_Id])->orderBy('bus_services.created_at','DESC')->paginate(10);
  //json_decode
          return view('emp_bus',$data);
        }
/**********************accept bus   services   add by other *******************/
        
        public function accept($id){
          $loged_id=  Auth::user()->id ;
          $affected2= BusService::where(['bus_id'=>$id])
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
          if($emps->emp_id==$loged_id)
          {
          $name=$emps->emp_first_name.'  ';
          $name .=$emps->emp_last_name;
          
          }
          }
          $affected= BusService::where(['bus_id'=>$id])
          ->update(['user_id'=>$loged_id,'user_status'=>0,'errorlog'=>4]);
    /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

$message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$how_add.','.$loged_id.') class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services Bus That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
$datav=['to'=>$how_add,'from'=>$loged_id ,'message'=> $message555,'date'=>$date];
$message=$datav['message'];
DB::table('notifications')->insert(
   ['sender' => $loged_id, 
   'resiver' => $how_add,
   'body'=>$message ,
   'status'=>0 ,
   'main_service'=>2,
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
   $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$loged_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Bus  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $dataa=['to'=>$ad->id,'from'=>$loged_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $loged_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>2,
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
           $affected= BusService::where(['bus_id'=>$id])
          ->update(['errorlog'=>2]);
          $affected2= BusService::where(['bus_id'=>$id])
          ->get();
          foreach($affected2 as $aff){     
            $customer=$aff->due_to_customer; 
            $how_add=$aff->user_id; 
          } 
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
       
        $message555='<div class="dropdown-divider"></div><a onclick=status_notify("'.$id.'",'.$loged_id.','.$how_add.') href=/reject_bus  class="dropdown-item"><i class="text-danger fas fa-times mr-2"></i>The employee '.$name.' Reject Bus service  That Added by you <span class="float-right text-muted text-sm">'.$date.'</span></a>';
        $datav=['to'=>$how_add,'from'=>$loged_id,'message'=> $message555,'date'=>$date];
        $message=$datav['message'];
        DB::table('notifications')->insert(
           ['sender' => $loged_id, 
           'resiver' => $how_add,
           'body'=>$message ,
           'status'=>0 ,
           'main_service'=>2,
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
                      /****************show reject services****************** */
        public function reject_bus()
        {
          $loged_Id=  Auth::user()->id ;
    
         $data['data']=BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
         ->join('currency','currency.cur_id','=','bus_services.ses_cur_id')
         ->where(['bus_services.deleted'=>0,'bus_services.errorlog'=>2,'bus_services.user_status'=>1,'bus_services.user_id'=> $loged_Id])->orderBy('bus_services.created_at','DESC')->paginate(10);
        return view('reject_bus',$data);
        } 
}