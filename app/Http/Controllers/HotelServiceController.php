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
class HotelServiceController extends Controller
{
    //


public function generate( Request $req)
{
  $id=DB::table('hotel_services')->latest()->first();
  return json_decode($id->voucher_number+1);
}
    public function hide_hotel($id){
        echo $id;
        $affected1=HotelService::where('hotel_id',$id)
        ->update(['deleted'=>1]);
        return back()->with('seccess','Seccess Data Delete');

        }
        public function send_hotel($id){
            echo $id;
            $where=['hotel_id'=>$id];
    
            $where +=['attachment'=>'null'];
            $affected1=HotelService::where($where)->count();
            if($affected1 >0)
           { 
            json_encode('noorder');
         }
          else{
            $affected= HotelService::where(['hotel_id'=>$id])
            ->update(['service_status'=>2]);
            return back()->with('seccess','Seccess Data Delete');
          }
            }

            public function hotel(){
              $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
      ->join('services','services.ser_id','=','sup_services.service_id')
      ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'sup_services.service_id'=>5])->get();
              $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
            
             
                  return view('add_hotel',$data);
              } 
            public function hide_visa($id){
                echo $id;
                $affected1=VisaService::where('visa_id',$id)
                ->update(['deleted'=>1]);
                return back()->with('seccess','Seccess Data Delete');
              }
   
              
              public function updateHotel( Request $req)
{ 
    $hotel=new HotelService;

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

       $hotel::where('hotel_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'hotel_status'=>$req->hotel_status,
       'voucher_number'=>$req->voucher_number,'country'=>$req->country,'city'=>$req->city,'hotel_name'=>$req->hotel_name,
       'check_in'=>$req->check_in,'check_out'=>$req->check_out,
      'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>5,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,
      'attachment'=>$img ,'errorlog'=>0

       ]); 

    }
    else{
      $hotel::where('hotel_id',$req->id)
       ->update(['Issue_date'=>$req->Issue_date,
       'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
       'hotel_status'=>$req->hotel_status,
       'voucher_number'=>$req->voucher_number,'country'=>$req->country,'city'=>$req->city,'hotel_name'=>$req->hotel_name,
       'check_in'=>$req->check_in,'check_out'=>$req->check_out,'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
      'cost'=>$req->cost,'service_id'=>5,'passnger_currency'=>$req->passnger_currency,'remark'=>$req->remark,'service_status'=>1,'errorlog'=>0

       ]); 
    }
    return redirect('/service/show_hotel/1')->with('seccess','Seccess Data Update');
  }


  public function updateHotel2( Request $req)
  { 
      $hotel=new HotelService;
 
        $hotel::where('hotel_id',$req->id)
         ->update(['Issue_date'=>$req->Issue_date,
         'refernce'=>$req->refernce,'passenger_name'=>$req->passenger_name,
         'hotel_status'=>$req->hotel_status,
         'voucher_number'=>$req->voucher_number,'country'=>$req->country,'city'=>$req->city,'hotel_name'=>$req->hotel_name,
         'check_in'=>$req->check_in,'check_out'=>$req->check_out,'due_to_supp'=>$req->due_to_supp,'provider_cost'=>$req->provider_cost,'cur_id'=>$req->cur_id,'due_to_customer'=>$req->due_to_customer,
        'cost'=>$req->cost,'service_id'=>5,'passnger_currency'=>$req->passnger_currency,'service_status'=>1,'errorlog'=>0
  
         ]); 
      
      return redirect('/service/show_hotel/1')->with('seccess','Seccess Data Update');
    }

  
public function add_hotel( Request $req)
{ 
  $message5="";
  $date1=date("Y/m/d") ;
  $date=now();
    $hotel=new HotelService;
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
    $hotel_id= vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
 
    $loged_id=  Auth::user()->id ;
    if( $loged_id==$req->due_to_customer )
    {
      $hotel->user_id= $loged_id;
      $hotel->user_status=0;

    }
    else{
      $hotel->user_id= $loged_id;
      $hotel->user_status=1;
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
       $hotel->attachment .=$attchmentName.',';
   
       }} else{
        $hotel->attachment='null';
      }

    $hotel->Issue_date =$req->Issue_date;
    $hotel->hotel_id=$hotel_id;
    $hotel->refernce=$req->refernce;
    $hotel->passenger_name=$req->passenger_name;
    $hotel->voucher_number=$req->voucher_number;
    $hotel->hotel_status =$req->hotel_status;
    $hotel->country =$req->country;
    $hotel->city =$req->city;
    $hotel->hotel_name =$req->hotel_name;
    $hotel->check_in =$req->check_in;
    $hotel->check_out =$req->check_out;
    $hotel->due_to_supp =$req->due_to_supp;
    $hotel->provider_cost=$req->provider_cost;
    $hotel->cur_id=$req->cur_id;
    $hotel->due_to_customer =$req->due_to_customer ;
    $hotel->cost =$req->cost ;
    $hotel->service_id=5;
    $hotel->passnger_currency=$req->passnger_currency;
    $hotel->remark=$req->remark;
    $hotel->service_status=1;
    $hotel->save();
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
       
        $message5='<div class=dropdown-divider></div><a onclick=status_notify("Add Hotel Service",'.$loged_id.','.$customer_id.') href=/remark  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add New Services Hotel  <span class=float-right text-muted text-sm>'.$date.'</span></a>';
        $datav=['to'=>$customer_id,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
        $message=$datav['message'];
        DB::table('notifications')->insert(
           ['sender' => $loged_id, 
           'resiver' => $customer_id,
           'body'=>$message ,
           'status'=>0 ,
           'main_service'=>5,
           'servic_id'=>$hotel_id,
           'created_at'=>$date,
           'updated_at'=>$date1,
           ]
        );
        event(new MyEvent($datav));
      return redirect('/service/show_hotel/1')->with('seccess','Seccess Data Insert');
    }    else{
          $emp=Employee::all();
          foreach($emp as $emps){
            if($emps->emp_id==$loged_id)
           {
              $name=$emps->emp_first_name.'  ';
              $name .=$emps->emp_last_name;
           
          }
          }
         
          $message5='<div class=dropdown-divider></div><a onclick=status_notify("Hotel service",'.$loged_id.','.$req->due_to_customer.') href=/emp_car  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Add services Hotel by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
          $datav=['to'=>$req->due_to_customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
          $message=$datav['message'];
          DB::table('notifications')->insert(
             ['sender' => $loged_id, 
             'resiver' => $req->due_to_customer,
             'body'=>$message ,
             'status'=>0 ,
             'main_service'=>5,
             'servic_id'=>$hotel_id,
             'created_at'=>$date,
             'updated_at'=>$date1,
             ]
          );
          event(new MyEvent($datav));
          return redirect('/service/sent_bus/2')->with('seccess','Seccess Data Insert');
        
        }
}

public function update_Hotel($id){
  $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
  ->join('services','services.ser_id','=','sup_services.service_id')
  ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>5])->get();
  $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
            ->where('users.is_active',1)->where('users.is_delete',0)
            ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
           $data['hotels']=HotelService::join('currency','currency.cur_id','=','hotel_services.cur_id')
->join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')->where('hotel_id',$id)->get();
   
      return view('update_hotel',$data);
  } 
  /**********************show update bus error services  *******************/

  public function update_Hotel2($id){
    $data['suplier']=Supplier::join('sup_services','sup_services.sup_id','=','suppliers.s_no')
    ->join('services','services.ser_id','=','sup_services.service_id')
    ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'services.ser_id'=>2])->get();
   
   
    $data['emp']=Employee::join('users','users.id','=','employees.emp_id')
    ->where('users.is_active',1)->where('users.is_delete',0)
    ->where('employees.is_active',1)->where('employees.deleted',0)->get();      
     $data['data']=HotelService::join('currency','currency.cur_id','=','hotel_services.cur_id')
    ->join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
    ->join('employees','employees.emp_id','=','hotel_services.due_to_customer')
      ->join('logs','logs.service_id','=','hotel_services.hotel_id')
    ->where('hotel_services.hotel_id',$id)->get();
    foreach( $data['data'] as $aff){     
      $sup=$aff->due_to_supp;
    }
    $data['cur']=Supplier::join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
    ->join('currency','currency.cur_id','=','sup_currency.cur_id')
    ->where(['suppliers.is_active'=>1,'suppliers.is_deleted'=>0,'suppliers.s_no'=>$sup])->get();
  
    return view('up_err_hotel',$data)->with('seccess','Seccess Data Update');
} 
    public function show_hotel($id)
{
  $loged_Id=  Auth::user()->id ;

 $data['hotel']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
 ->join('currency','currency.cur_id','=','hotel_services.cur_id')
 ->where(['hotel_services.service_status'=>$id,'hotel_services.deleted'=>0,'hotel_services.errorlog'=>0,'hotel_services.due_to_customer'=> $loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
return view('show_hotel',$data);
}

    public function sent_hotel($id)
{
  $loged_Id=  Auth::user()->id ;

 $data['hotel']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
 ->join('currency','currency.cur_id','=','hotel_services.cur_id')
 ->where(['hotel_services.service_status'=>$id,'hotel_services.deleted'=>0,'hotel_services.errorlog'=>0,'hotel_services.due_to_customer'=> $loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
return view('sent_hotel',$data);
}
public function deleteAllhotel(Request $request){
  $ids = $request->input('ids');
  $dbs = HotelService::where('hotel_id',$ids)
  ->update(['deleted'=>1]);
  return back()->with('seccess','Seccess Data Delete');
}
public function sendAllhotel(Request $request){
$ids = $request->input('ids');
$where=['hotel_id'=>$ids];
  $where +=['attachment'=>'null'];
  $affected1=HotelService::where($where)->count();
  if($affected1 >0)
 { 
  return back()->with('failed','failed Data  send');

}
else{
 
  $dbs = HotelService::where('hotel_id',$ids)->update(['service_status'=>2]);

  return back()->with('seccess','Seccess Data Send');
 
}
}




public function emp_hotel(){
    $loged_Id=  Auth::user()->id ;

    $data['data']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
    ->join('currency','currency.cur_id','=','hotel_services.cur_id')
    ->where(['hotel_services.deleted'=>0,'hotel_services.user_status'=>1,'hotel_services.errorlog'=>0,'hotel_services.due_to_customer'=>$loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
//json_decode
    return view('emp_hotel',$data);
  }
  public function show_add_emp()
  {
    $loged_Id=  Auth::user()->id ;

   $data['data']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
   ->join('currency','currency.cur_id','=','hotel_services.cur_id')
   ->join('employees','employees.emp_id','=','hotel_services.due_to_customer')
   ->where(['hotel_services.service_status'=>1,'hotel_services.deleted'=>0,'hotel_services.user_id'=> $loged_Id,'hotel_services.user_status'=>1])
   ->orderBy('hotel_services.created_at','DESC')->paginate(10);
  return view('hotelError',$data);
  } 
  public function errorHotel(){
    $loged_Id=  Auth::user()->id ;
    $data['data']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
    ->join('currency','currency.cur_id','=','hotel_services.cur_id') 
    ->join('employees','employees.emp_id','=','hotel_services.due_to_customer')
    ->join('logs','logs.service_id','=','hotel_services.hotel_id')
    ->where(['hotel_services.errorlog'=>1,'hotel_services.user_status'=>0,'logs.status'=>0,'hotel_services.user_id'=>$loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
              return view('salesErrorHotel',$data);
    }
  
  public function accept($id){
    $loged_Id=  Auth::user()->id ;

    $affected2= HotelService::where(['hotel_id'=>$id])
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
    $affected= HotelService::where(['hotel_id'=>$id])
    ->update(['user_id'=>$loged_Id,'user_status'=>0]);
    
         
          $message5='<div class=dropdown-divider></div><a onclick=status_notify("Accept Hotel Service",'.$loged_Id.','.$customer.') href=/#  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Accept services Hotel That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
          $datav=['to'=>$customer,'from'=>$loged_Id,'message'=> $message5,'date'=>$date];
          $message=$datav['message'];
          DB::table('notifications')->insert(
             ['sender' => $loged_Id, 
             'resiver' => $customer,
             'body'=>$message ,
             'status'=>0 ,
             'main_service'=>5,
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
  
    $affected2= HotelService::where(['hotel_id'=>$id])
    ->get();
    foreach($affected2 as $aff){     
        $customer=$aff->due_to_customer; 
  }     $affected= HotelService::where(['hotel_id'=>$id])
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
         
          $message5='<div class=dropdown-divider></div><a onclick=status_notify("Reject Hotel Service",'.$loged_id.','.$customer.') href=/reject_hotel  class=dropdown-item><i class=text-danger fas fa-times mr-2></i>The employee'.$name.' Reject services Hotel That Added by you <span class=float-right text-muted text-sm>'.$date.'</span></a>';
          $datav=['to'=>$customer,'from'=>$loged_id,'message'=> $message5,'date'=>$date];
          $message=$datav['message'];
          DB::table('notifications')->insert(
             ['sender' => $loged_id, 
             'resiver' => $customer,
             'body'=>$message ,
             'status'=>0 ,
             'main_service'=>5,
             'servic_id'=>$id,
             'created_at'=>$date,
             'updated_at'=>$date1,
             ]
          );
          event(new MyEvent($datav));
          return back()->with('seccess','Seccess Data Reject');
          }

  public function reject_hotel()
  {
    $loged_Id=  Auth::user()->id ;

   $data['data']=HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
   ->join('currency','currency.cur_id','=','hotel_services.cur_id')
   ->where(['hotel_services.deleted'=>0,'hotel_services.errorlog'=>2,'hotel_services.user_status'=>1,'hotel_services.user_id'=> $loged_Id])->orderBy('hotel_services.created_at','DESC')->paginate(10);
  return view('reject_hotel',$data);
  } 
}
