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

class TicketServiceController extends Controller
{
    public function show_ticket($id)
{
    $loged_Id=  Auth::user()->id ;

 $data['ticket']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
 ->join('currency','currency.cur_id','=','ticket_services.cur_id')
 ->where(['ticket_services.service_status'=>$id,'ticket_services.deleted'=>0,'ticket_services.errorlog'=>0,'ticket_services.due_to_customer'=> $loged_Id])->paginate(10);
return view('show_ticket',$data);


} 


 public function sent_ticket($id)
{
    $loged_Id=  Auth::user()->id ;

 $data['ticket']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
 ->join('currency','currency.cur_id','=','ticket_services.cur_id')
 ->where(['ticket_services.service_status'=>$id,'ticket_services.deleted'=>0,'ticket_services.errorlog'=>0,'ticket_services.due_to_customer'=> $loged_Id])->paginate(10);
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
        $where=['tecket_id'=>$id];

        $where +=['attachment'=>'null'];
        $affected1=TicketService::where($where)->count();
        if($affected1 >0)
       { 
       
     json_encode('noorder');
     }
      else{
        $affected= TicketService::where(['tecket_id'=>$id])
        ->update(['service_status'=>2]);
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
            $data['airline']=Airline::where('is_active',1)->where('deleted',0)->get();
            $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
            ->join('services','services.ser_id','=','sup_services.service_id')
            ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>1])->get();
            $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
               
           
            $data['tickets']=TicketService::join('currency','currency.cur_id','=','ticket_services.cur_id')
            ->join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
            ->where('tecket_id',$id)->get();
           
              return view('update_ticket',$data);
          } 
 
          
          
public function add_ticket( Request $req)
{ 
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
    $ticket->ticket_status =$req->ticket_status;
    $ticket->Dep_city =$req->Dep_city1;
    $ticket->arr_city =$req->arr_city;
    $ticket->dep_date =$req->dep_date;
    $ticket->due_to_supp =$req->due_to_supp;
    $ticket->provider_cost=$req->provider_cost;
    $ticket->cur_id=$req->cur_id;
    $ticket->due_to_customer =$req->due_to_customer ;
    $ticket->cost =$req->cost ;
    $ticket->service_id=1;
    $ticket->passnger_currency=$req->passnger_currency;
    $ticket->remark=$req->remark;
    $ticket->service_status=1;
    $ticket->save();
return redirect('/service/show_ticket/1')->with('seccess','Seccess Data Insert');
}

public function updateTicket( Request $req)
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
       'ticket'=>$req->ticket,'ticket_status'=>$req->ticket_status,
       'ticket_number'=>$req->ticket_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>1,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
      'attachment'=>$img ,'Dep_city2'=>$dep_city2,'arr_city2'=>$arr_city2,'dep_date2'=>$dp_date,'bursher_time'=>$busher

       ]); 

    }
    else{
      $ticket::where('tecket_id',$req->id)
      ->update(['Issue_date'=>$req->Issue_date,
      'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,'airline_id'=>$req->airline,
      'ticket'=>$req->ticket,'ticket_status'=>$req->ticket_status,
      'ticket_number'=>$req->ticket_number,'Dep_city'=>$req->Dep_city1,'arr_city'=>$req->arr_city,'dep_date'=>$req->dep_date,
     'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
     'cost'=>$req->cost,'service_id'=>1,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
     'Dep_city2'=>$dep_city2,'arr_city2'=>$arr_city2,'dep_date2'=>$dp_date,'bursher_time'=>$busher

      ]); 
    }
return redirect('/service/show_ticket/1')->with('seccess','Seccess Data Insert');
}


public function deleteAllticket(Request $request){
    $ids = $request->input('ids');
    $dbs = TicketService::where('tecket_id',$ids)
    ->update(['deleted'=>1]);
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
   
    $dbs = TicketService::where('tecket_id',$ids)->update(['service_status'=>2]);

    return back()->with('seccess','Seccess Data Send');
   
 }
}


public function errorTicket(){
  $loged_Id=  Auth::user()->id ;
            $data['data']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
            ->join('currency','currency.cur_id','=','ticket_services.cur_id')
            ->join('logs','logs.service_id','=','ticket_services.tecket_id')
            ->join('airlines','airlines.id','=','ticket_services.airline_id')
            ->where(['ticket_services.errorlog'=>1,'ticket_services.user_status'=>0,'ticket_services.user_id'=>$loged_Id])->paginate(10);
//json_decode
            return view('salesErrorTicket',$data);
  }
  
public function emp_ticket(){
    $loged_Id=  Auth::user()->id ;

    $data['data']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
    ->join('currency','currency.cur_id','=','ticket_services.cur_id')
    ->join('airlines','airlines.id','=','ticket_services.airline_id')
    ->where(['ticket_services.deleted'=>0,'ticket_services.user_status'=>1,'ticket_services.errorlog'=>0,'ticket_services.due_to_customer'=>$loged_Id])->paginate(10);
//json_decode
    return view('emp_ticket',$data);
  }

  public function accept($id){
    $loged_Id=  Auth::user()->id ;
    $affected= TicketService::where(['tecket_id'=>$id])
    ->update(['user_id'=>$loged_Id,'user_status'=>0]);
    return back()->with('seccess','Seccess Data Accept');
  }
  public function ignore($id){
    $loged_Id=  Auth::user()->id ;
    $affected= TicketService::where(['tecket_id'=>$id])
    ->update(['errorlog'=>2]);
    return back()->with('seccess','Seccess Data Reject');
  }

  public function reject_ticket()
  {
    $loged_Id=  Auth::user()->id ;

   $data['data']=TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
   ->join('currency','currency.cur_id','=','ticket_services.cur_id')
   ->where(['ticket_services.deleted'=>0,'ticket_services.errorlog'=>2,'ticket_services.user_status'=>1,'ticket_services.user_id'=> $loged_Id])->paginate(10);
  return view('reject_ticket',$data);
  } 
}
