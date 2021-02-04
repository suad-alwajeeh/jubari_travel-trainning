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

class TicketServiceController extends Controller
{
    public function show_ticket($id)
{
    $loged_Id=  Auth::user()->id ;

 $data['ticket']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
 ->join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
 ->where(['ticket_services.service_status'=>$id,'ticket_services.deleted'=>0,'ticket_services.errorlog'=>0,'ticket_services.due_to_customer'=> $loged_Id])->orderBy('ticket_services.created_at','DESC')->paginate(10);
return view('show_ticket',$data);


} 


 public function sent_ticket($id)
{
    $loged_Id=  Auth::user()->id ;

 $data['ticket']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
 ->join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
 ->where(['ticket_services.service_status'=>$id,'ticket_services.deleted'=>0,'ticket_services.errorlog'=>0,'ticket_services.due_to_customer'=> $loged_Id])->orderBy('ticket_services.created_at','DESC')->paginate(10);
return view('sent_ticket',$data);


} 


public function generate( Request $req)
{
  $id=DB::table('ticket_services')->latest()->first();
  return json_decode($id->ticket_number+1);
}
public function hide_ticket($id){
    echo $id;
    $affected1= TicketService::where('tecket_id',$id)
    ->update(['deleted'=>1]);
  
 return back()->with('seccess','Seccess Data Delete');

    }

    public function send_ticket($id){
        echo $id;
        $message555="";
        $user_name="";
        $user_id="";
        $date1=date("Y/m/d") ;
        $date=now();
        
        $where=['tecket_id'=>$id];

        $where +=['attachment'=>'null'];
        $affected1=TicketService::where($where)->count();
        if($affected1 >0)
       { 
       
     json_encode('noorder');
     }
      else{
       
        $affected11=TicketService::where('tecket_id',$id)
                     ->join('employees','ticket_services.user_id','employees.emp_id')
                     ->select('employees.emp_first_name as n1','ticket_services.user_id as u_id','employees.emp_middel_name as n2')
                     ->get();
         foreach($affected11 as $un){
          $user_name=$un->n1.' '.$un->n2;
          $user_id=$un->u_id;
         }
        $affected= TicketService::where(['tecket_id'=>$id])
        ->update(['service_status'=>2]);

/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=TicketService::where('tecket_id',$id)
->join('employees','ticket_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','ticket_services.user_id as u_id','ticket_services.manager_id as manager_id','employees.emp_middel_name as n2')
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
   $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send Ticket Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
   $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>1,
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
      $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$user_name.' send Ticket Services to SaleManager  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>1,
         'servic_id'=>$id,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated Ticket Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>1,
       'servic_id'=>$id,
       'created_at'=>$date,
       'updated_at'=>$date1,
       ]
    );
    event(new MyEvent($dataa));
}
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

     return back()->with('Status','Seccess Data Send');
       
     }
        }

        public function ticket(){
            $data['airline']=Airline::where('is_active',1)->where('is_delete',0)->get();
            $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
            ->join('services','services.ser_id','=','sup_services.service_id')
            ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>1])->get();
            $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
           
              return view('add_ticket',$data);
          } 
          public function update_ticket($id){
            $data['airline']=Airline::where('is_active',1)->where('is_delete',0)->get();
            $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
            ->join('services','services.ser_id','=','sup_services.service_id')
            ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>1])->get();
            $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
               
           
            $data['tickets']=TicketService::join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
            ->join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
            ->where('tecket_id',$id)->get();
           
              return view('update_ticket',$data);
          } 
 
       /**********************show update bus error services  *******************/

      public function update_Ticket2($id){
        $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
        ->join('services','services.ser_id','=','sup_services.service_id')
        ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>2])->get();
       
        $data['airline']=Airline::where('is_active',1)->where('is_delete',0)->get();
       
        $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
        ->where('users.is_active',1)->where('users.is_delete',0)
        ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
         $data['data']=TicketService::join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
        ->join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
        ->join('employees','employees.emp_id','=','ticket_services.due_to_customer')
          ->join('logs','logs.service_id','=','ticket_services.tecket_id')
        ->where('ticket_services.tecket_id',$id)->get();
        foreach( $data['data'] as $aff){     
          $sup=$aff->due_to_supp;
        }
        $data['cur']=Supplier::join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
        ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'suppliers.s_no'=>$sup])->get();
      
        return view('up_err_ticket',$data)->with('seccess','Seccess Data Update');

      }    
          
public function add_ticket( Request $req)
{ 
  print_r($req->cur_id);
  $message555="";
  $date1=date("Y/m/d") ;
  $date=now();
    $ticket=new TicketService;
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
    $tick_id= vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    $ticket->tecket_id=$tick_id; 
    $loged_id=  Auth::user()->id ;
    
    if( $loged_id==$req->due_to_customer )
    {
      $ticket->user_id= $loged_id;
      $ticket->user_status=0;

    }
    else{
      $ticket->user_id= $loged_id;
      $ticket->user_status=1;
    }
    if(isset($req->Dep_city2))
    {
        $ticket->Dep_city2 =$req->Dep_city1;

    }
    else{
        $ticket->Dep_city2='';
    }
    if(isset($req->arr_city2))
    {
        $ticket->arr_city2 =$req->arr_city2;

    }
    else{
        $ticket->arr_city2='';
    }

    

    if(isset($req->dep_date2))
    {
        $ticket->dep_date2 =$req->dep_date2;

    }
    else{
        $ticket->dep_date2='';
    }
   
    if(isset($req->bursher_time))
    {
        $ticket->bursher_time =$req->bursher_time;

    }
    else{
        $ticket->bursher_time='';
    }
    if($req->hasfile('attachment'))
    {
       $attchmentFile =$req->file('attachment') ;
       $num=count($attchmentFile);
      for($i=0;$i<$num;$i++){
         $ext=$attchmentFile[$i]->getClientOriginalExtension();
       $attchmentName =rand(123456,999999).".".$ext;
       $attchment=$attchmentFile[$i]->move('img/user_attchment/',$attchmentName);
       //$ticket->attachment=$attchmentName;
       $ticket->attachment .=$attchmentName.',';
   
       }
    //$ticket->attachment =$attachment;

    }
    else{
      $ticket->attachment='null';
    }

    $ticket->Issue_date =$req->Issue_date;
    $ticket->refernce=$req->refernce;
    $ticket->passenger_name=$req->passenger_name;
    $ticket->airline_id =$req->airline;
    $ticket->ticket=$req->ticket;
    $ticket->ticket_number =$req->ticket_number;
    $ticket->ses_status =$req->ticket_status;
    $ticket->Dep_city =$req->Dep_city1;
    $ticket->arr_city =$req->arr_city;
    $ticket->dep_date =$req->dep_date;
    $ticket->due_to_supp =$req->due_to_supp;
    $ticket->provider_cost=$req->provider_cost;
    $ticket->ses_cur_id=$req->cur_id;
    $ticket->due_to_customer =$req->due_to_customer ;
    $ticket->cost =$req->cost ;
    $ticket->service_id=1;
    $ticket->passnger_currency=$req->passnger_currency;
    $ticket->remark=$req->remark;
    $ticket->service_status=1;
    $ticket->save();
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
         $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$tick_id.'",'.$loged_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Ticket  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
         $dataa=['to'=>$ad->id,'from'=>$loged_id,'message'=> $message55555,'date'=>$date];
         $messagea=$dataa['message'];
         $admin_notify=DB::table('notifications')->insert(
            ['sender' => $loged_id, 
            'resiver' => $ad->id,
            'body'=>$messagea ,
            'status'=>0 ,
            'main_service'=>1,
            'servic_id'=>$tick_id,
            'created_at'=>$date,
            'updated_at'=>$date1,
            ]
         );
         event(new MyEvent($dataa));
       } 
  /***********************************NOTIFICATION CODE****************************** */
  /***********************************NOTIFICATION CODE****************************** */
       

         return redirect('/service/show_ticket/1')->with('seccess','Seccess Data Insert');
}    else{
      $emp=Employee::all();
      foreach($emp as $emps){
        if($emps->emp_id==$loged_id)
       {
          $name=$emps->emp_first_name.'  ';
          $name .=$emps->emp_last_name;
       
      }
      }
     
      $message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$tick_id.'",'.$loged_id.','.$req->due_to_customer.') href=/emp_ticket  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add services Ticket by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
      $datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message555,'date'=>$date];
      $message=$datav['message'];
      DB::table('notifications')->insert(
         ['sender' => $loged_id, 
         'resiver' => $req->due_to_customer,
         'body'=>$message ,
         'status'=>0 ,
         'main_service'=>1,
         'servic_id'=>$tick_id,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($datav));
      return redirect('/service/sent_ticket/2')->with('seccess','Seccess Data Insert');
    
    }
}

public function updateTicket( Request $req)
{ 
    $ticket=new TicketService;
$dep_city2='';
$arr_city2='';
$img='';
$dp_date='';
$busher='';
    if(isset($req->dep_city1))
    {
        $dep_city2 =$req->Dep_city1;

    }
    else{
        $dep_city2='';
    }
    if(isset($req->arr_city1))
    {
        $arr_city2 =$req->arr_city1;

    }
    else{
        $arr_city2='';
    }

    

    if(isset($req->dep_date2))
    {
        $dp_date =$req->dep_date2;
        //$ticket->bursher_time =$req->bursher_time;

    }
    else{
        $dp_date='';
    }
    if(isset($req->bursher_time))
    {
        $busher =$req->bursher_time;

    }
    else{
        $busher='';
    }
   

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

       $ticket::where('tecket_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,'airline_id'=>$req->airline,
       'ticket'=>$req->ticket,'ses_status'=>$req->ticket_status,
       'ticket_number'=>$req->ticket_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>1,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
      'attachment'=>$img ,'Dep_city2'=>$dep_city2,'arr_city2'=>$arr_city2,'dep_date2'=>$dp_date,'bursher_time'=>$busher,'errorlog'=>0

       ]); 

    }
    else{
      $ticket::where('tecket_id',$req->id)
      ->update(['Issue_date'=>$req->Issue_date,
      'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,'airline_id'=>$req->airline,
      'ticket'=>$req->ticket,'ses_status'=>$req->ticket_status,
      'ticket_number'=>$req->ticket_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
     'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
     'cost'=>$req->cost,'service_id'=>1,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
     'Dep_city2'=>$dep_city2,'arr_city2'=>$arr_city2,'dep_date2'=>$dp_date,'bursher_time'=>$busher,'errorlog'=>0

      ]); 
    }

 
return redirect('/service/show_ticket/1')->with('seccess','Seccess Data Update');
}


public function updateTicket2( Request $req)
{ 
    $ticket=new TicketService;
$dep_city2='';
$arr_city2='';
$img='';
$dp_date='';
$busher='';
    if(isset($req->Dep_city2))
    {
        $dep_city2 =$req->Dep_city1;

    }
    else{
        $dep_city2='';
    }
    if(isset($req->arr_city2))
    {
        $arr_city2 =$req->arr_city1;

    }
    else{
        $arr_city2='';
    }

    

    if(isset($req->dep_date2))
    {
        $dp_date =$req->dep_date2;
        $ticket->bursher_time =$req->bursher_time;

    }
    else{
        $dp_date='';
    }
    if(isset($req->bursher_time))
    {
        $busher =$req->dep_date2;

    }
    else{
        $busher='';
    }
   
      $ticket::where('tecket_id',$req->id)
      ->update(['Issue_date'=>$req->Issue_date,
      'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,'airline_id'=>$req->airline,
      'ticket'=>$req->ticket,'ses_status'=>$req->ticket_status,
      'ticket_number'=>$req->ticket_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
     'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'ses_cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
     'cost'=>$req->cost,'service_id'=>1,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
     'Dep_city2'=>$dep_city2,'arr_city2'=>$arr_city2,'dep_date2'=>$dp_date,'bursher_time'=>$busher,'errorlog'=>0

      ]); 
    

$db=DB::delete('delete from logs where service_id="'.$req->id.'"');
$loged_id=  Auth::user()->id ;
$emp=Employee::all();
foreach($emp as $emps){
  if($emps->emp_id==$loged_id)
 {
    $name=$emps->emp_first_name.'  ';
    $name .=$emps->emp_last_name;
 
}
}
/***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
//مش متعرف على الايدي حق المانجر
$date1=date("Y/m/d") ;
$date=now(); 
$affectedm= TicketService::where(['tecket_id'=>$req->id])
->get();
foreach($affectedm as $affm){     
  $manager=$affm->manager_id; 
echo $affm->tecket_id;
  $message55555="";
  $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$req->id.'",'.$loged_id.','.$manager.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' edit Ticket Services with remark <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $dataa=['to'=>$manager,'from'=>$loged_id,'message'=> $message55555,'date'=>$date];
  print_r($dataa);
  $messagea=$dataa['message'];
  $admin_notify=DB::table('notifications')->insert(
     ['sender' => $loged_id, 
     'resiver' => $manager,
     'body'=>$messagea ,
     'status'=>0 ,
     'main_service'=>1,
     'servic_id'=>$req->id,
     'created_at'=>$date,
     'updated_at'=>$date1,
     ]
  );
  event(new MyEvent($dataa));
}
    /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */

return redirect('/service/show_ticket/1')->with('seccess','Seccess Data Insert');
}


public function deleteAllticket(Request $request){
    $ids = $request->input('ids');
    foreach($ids as $mm){  
    $dbs = TicketService::where('tecket_id',$mm)
    ->update(['deleted'=>1]);
    }
    return back()->with('seccess','Seccess Data Delete');
}
public function sendAllticket(Request $request){
  
  $ids = $request->input('ids');
  $where=['tecket_id'=>$ids];
    $where +=['attachment'=>'null'];
    $affected1=TicketService::where($where)->count();
    if($affected1 >0)
   { 
    return back()->with('failed','failed Data  send');

 }
  else{
    foreach($ids as $mm){
    $dbs = TicketService::where('tecket_id',$mm)->update(['service_status'=>2]);
     }
 /***********************************NOTIFICATION CODE****************************** */
/***********************************NOTIFICATION CODE****************************** */
$affected11=TicketService::where('tecket_id',$ids)
->join('employees','ticket_services.user_id','employees.emp_id')
->select('employees.emp_first_name as n1','ticket_services.user_id as u_id','ticket_services.manager_id as manager_id','employees.emp_middel_name as n2')
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
  $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee' .$user_name. ' SEND <span class="text-success">'.$SIZE.'</span> Services Ticket   <span class=float-right text-muted text-sm>'.$date.'</span></a>';
  $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
   $messagea=$dataa['message'];
   $admin_notify=DB::table('notifications')->insert(
      ['sender' => $user_id, 
      'resiver' => $ad->id,
      'body'=>$messagea ,
      'status'=>0 ,
      'main_service'=>1,
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
     $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee' .$user_name. ' SEND <span class="text-success">'.$SIZE.'</span> Services Ticket   <span class=float-right text-muted text-sm>'.$date.'</span></a>';
     $dataa=['to'=>$ad->id,'from'=>$user_id,'message'=> $message55555,'date'=>$date];
      $messagea=$dataa['message'];
      $admin_notify=DB::table('notifications')->insert(
         ['sender' => $user_id, 
         'resiver' => $ad->id,
         'body'=>$messagea ,
         'status'=>0 ,
         'main_service'=>1,
         'servic_id'=>$idds,
         'created_at'=>$date,
         'updated_at'=>$date1,
         ]
      );
      event(new MyEvent($dataa));
    }
    $message555557='<div class=dropdown-divider></div><a onclick=status_notify("'.$idds.'",'.$user_id.','.$manager_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee '.$user_name.' send updated Ticket Services to you  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
    $datam=['to'=>$manager_id,'from'=>$user_id,'message'=> $message555557,'date'=>$date];
    $messagem=$datam['message'];
    $admin_notify=DB::table('notifications')->insert(
       ['sender' => $user_id, 
       'resiver' => $manager_id,
       'body'=>$messagem ,
       'status'=>0 ,
       'main_service'=>1,
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


public function errorTicket(){
  $loged_Id=  Auth::user()->id ;
            $data['data']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
            ->join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
  ->join('employees','employees.emp_id','=','ticket_services.due_to_customer')
  ->join('logs','logs.service_id','=','ticket_services.tecket_id')
            ->join('airlines','airlines.id','=','ticket_services.airline_id')
            ->where(['ticket_services.errorlog'=>1,'ticket_services.user_status'=>0,'ticket_services.user_id'=>$loged_Id,'logs.status'=>0])->orderBy('ticket_services.created_at','DESC')->paginate(10);
//json_decode
            return view('salesErrorTicket',$data);
  }
  
public function emp_ticket(){
    $loged_Id=  Auth::user()->id ;

    $data['data']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
    ->join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
    ->join('airlines','airlines.id','=','ticket_services.airline_id')
    ->where(['ticket_services.deleted'=>0,'ticket_services.user_status'=>1,'ticket_services.errorlog'=>0,'ticket_services.due_to_customer'=>$loged_Id])->orderBy('ticket_services.created_at','DESC')->paginate(10);
//json_decode
    return view('emp_ticket',$data);
  }
  public function show_add_emp()
  {
    $loged_Id=  Auth::user()->id ;

   $data['data']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
   ->join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
   ->join('employees','employees.emp_id','=','ticket_services.due_to_customer')
   ->where(['ticket_services.service_status'=>1,'ticket_services.deleted'=>0,'ticket_services.user_id'=> $loged_Id,'ticket_services.user_status'=>1])
   ->orderBy('ticket_services.created_at','DESC')->paginate(10);
  return view('ticketError',$data);
  } 
  public function accept($id){
    $loged_Id=  Auth::user()->id ;
      /***********************************NOTIFICATION CODE****************************** */
  /***********************************NOTIFICATION CODE****************************** */

$affected2= TicketService::where(['tecket_id'=>$id])
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
    $affected= TicketService::where(['tecket_id'=>$id])
    ->update(['user_id'=>$loged_Id,'user_status'=>0]);   
          $message555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$how_add.','.$loged_Id.') class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services Ticket That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
          $datav=['to'=>$how_add,'from'=>$loged_Id ,'message'=> $message555,'date'=>$date];
          $message=$datav['message'];
          DB::table('notifications')->insert(
             ['sender' => $loged_Id, 
             'resiver' => $how_add,
             'body'=>$message ,
             'status'=>0 ,
             'main_service'=>1,
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
             $message55555='<div class=dropdown-divider></div><a onclick=status_notify("'.$id.'",'.$loged_Id.','.$ad->id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Ticket  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
             $dataa=['to'=>$ad->id,'from'=>$loged_Id,'message'=> $message55555,'date'=>$date];
             $messagea=$dataa['message'];
             $admin_notify=DB::table('notifications')->insert(
                ['sender' => $loged_Id, 
                'resiver' => $ad->id,
                'body'=>$messagea ,
                'status'=>0 ,
                'main_service'=>1,
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
  
    $affected2= TicketService::where(['tecket_id'=>$id])
    ->get();
    foreach($affected2 as $aff){     
        $customer=$aff->due_to_customer; 
        $how_add=$aff->user_id; 
  } 
      $affected= TicketService::where(['tecket_id'=>$id])
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
         
          $message555='<div class="dropdown-divider"></div><a onclick=status_notify("'.$id.'",'.$loged_id.','.$how_add.') href=/reject_ticket  class="dropdown-item"><i class="text-danger fas fa-times mr-2"></i>The employee'.$name.' Reject services Ticket That Added by you <span class="float-right text-muted text-sm">'.$date.'</span></a>';
          $datav=['to'=>$how_add,'from'=>$loged_id,'message'=> $message555,'date'=>$date];
          $message=$datav['message'];
          DB::table('notifications')->insert(
             ['sender' => $loged_id, 
             'resiver' => $how_add,
             'body'=>$message ,
             'status'=>0 ,
             'main_service'=>1,
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

  public function reject_ticket()
  {
    $loged_Id=  Auth::user()->id ;

   $data['data']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
   ->join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
   ->where(['ticket_services.deleted'=>0,'ticket_services.errorlog'=>2,'ticket_services.user_status'=>1,'ticket_services.user_id'=> $loged_Id])->orderBy('ticket_services.created_at','DESC')->paginate(10);
  return view('reject_ticket',$data);
  } 
}
