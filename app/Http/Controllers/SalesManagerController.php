<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TicketService;
use App\BusService;
use App\CarService;
use App\GeneralService;
use App\HotelService;
use App\MedicalService;
use App\VisaService;
use App\Logs;
use App\service;
use App\airline;
use App\Supplier;
use App\Employee;

class SalesManagerController extends Controller
{


  public function ticketError(Request $req){
         $data['data'] =TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
         ->join('currency','currency.cur_id','=','ticket_services.cur_id')
         ->join('airlines','airlines.id','=','ticket_services.airline_id')
         ->join('employees','employees.emp_id','=','ticket_services.due_to_customer')
         ->where(['ticket_services.deleted'=>0,'ticket_services.user_status'=>0,'ticket_services.errorlog'=>0,'ticket_services.service_status'=>2])->paginate(10);
    
         $data['airline']=Airline::where('is_active',1)->get();
         $data['suplier']=Supplier::where('is_active',1)->get();
         $data['emp']=Employee::where('is_active',1)->get();
         $data['buss']=TicketService::join('airlines','airlines.id','=','ticket_services.airline_id')
         ->join('currency','currency.cur_id','=','ticket_services.cur_id')
         ->get();
        
   
            return view('ticketError',$data);
       }
   
       public function saved_ticket(Request $req){
          
       
            $data=[];  
            $users_str;
            $log=new Logs;
         $log->remarker_id=1;
       
         $users_str = json_encode($req->remark_body);
   
         $log->remark_body=$users_str;
         $log->remarker_id=$req->remark_id;
         $log->main_servic_id=$req->service_id;
         $log->service_id=$req->tecket_id;
         $log->editor_id=$req->emp_id;
         $log->number=$req->ticket_number10;
         $log->status=2;
         $log->save();
   
           // $id= BusService::find($req->bus_id);
         $affected= TicketService::where(['tecket_id'=>$req->tecket_id])
         ->update(['errorlog'=>1,'service_status'=>1]);
   
      }
   
     
   
   
      public function send_ticket($id){
      
       $affected= TicketService::where(['tecket_id'=>$id])
       ->update(['service_status'=>3]);
       return back()->with('seccess','Seccess Data Delete');
      
    
       }
       public function hotelError(Request $req){
       
             $data['data'] =HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
             ->join('currency','currency.cur_id','=','hotel_services.cur_id')
             ->join('employees','employees.emp_id','=','hotel_services.due_to_customer')
             ->where(['hotel_services.deleted'=>0,'hotel_services.errorlog'=>0,'hotel_services.service_status'=>2,'hotel_services.user_status'=>0])->paginate(10);
             
     
             $data['airline']=Airline::where('is_active',1)->get();
             $data['suplier']=Supplier::where('is_active',1)->get();
             $data['emp']=Employee::where('is_active',1)->get();
             $data['buss']=HotelService::join('currency','currency.cur_id','=','hotel_services.cur_id')->get();
            
       
                return view('hotelError',$data);
           }
       
           public function saved_hotel(Request $req){
              
           
                $data=[];  
                $users_str;
                $log=new Logs;
             $log->remarker_id=1;
           
             $users_str = json_encode($req->remark_body);
       
             $log->remark_body=$users_str;
             $log->remarker_id=$req->remark_id;
             $log->main_servic_id=$req->service_id;
             $log->service_id=$req->hotel_id;
             $log->editor_id=$req->emp_id;
             $log->number=$req->hotel_number10;
             $log->status=2;
             $log->save();
       
               // $id= BusService::find($req->bus_id);
             $affected= HotelService::where(['hotel_id'=>$req->hotel_id])
             ->update(['errorlog'=>1,'service_status'=>1]);
       
          }
       
         
       
       
          public function send_hotel($id){
          
           $affected= HotelService::where(['hotel_id'=>$id])
           ->update(['service_status'=>3]);
           return back()->with('seccess','Seccess Data Delete');
          
        
           }
       
   
    public function display(Request $req){
       
      

 $data['data'] =BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
      ->join('currency','currency.cur_id','=','bus_services.cur_id')
      ->join('employees','employees.emp_id','=','bus_services.due_to_customer')
      ->where(['bus_services.deleted'=>0,'bus_services.user_status'=>0,'bus_services.service_status'=>2])->paginate(10);
      
      $data['airline']=Airline::where('is_active',1)->get();
      $data['suplier']=Supplier::where('is_active',1)->get();
      $data['emp']=Employee::where('is_active',1)->get();
      $data['buss']=BusService::join('currency','currency.cur_id','=','bus_services.cur_id')->get();
     

         return view('displaySalesManager',$data);
    }

    public function saved_bus(Request $req){
       
    
         $data=[];  
         $users_str;
         $log=new Logs;
      $log->remarker_id=1;
    
      $users_str = json_encode($req->remark_body);

      $log->remark_body=$users_str;
      $log->remarker_id=$req->remark_id;
      $log->main_servic_id=$req->service_id ;
      $log->service_id=$req->bus_id;
      $log->editor_id=$req->emp_id;
      $log->number=$req->bus_number10;
      $log->status=2;
      $log->save();

        // $id= BusService::find($req->bus_id);
      $affected= BusService::where(['bus_id'=>$req->bus_id])
      ->update(['errorlog'=>1,'service_status'=>1]);

   }

  


   public function send_bus($id){
   
    $affected= BusService::where(['bus_id'=>$id])
    ->update(['service_status'=>3]);
    return back()->with('seccess','Seccess Data Delete');
   
 
    }


    //car
    public function carError(Request $req){
       
      
           $data['data'] =CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
           ->join('currency','currency.cur_id','=','car_services.cur_id')
           ->join('employees','employees.emp_id','=','car_services.due_to_customer')
           ->where(['car_services.deleted'=>0,'car_services.user_status'=>0,'car_services.service_status'=>2,'car_services.errorlog'=>0])->paginate(10);
           
            
        
          
           $data['airline']=Airline::where('is_active',1)->get();
           $data['suplier']=Supplier::where('is_active',1)->get();
           $data['emp']=Employee::where('is_active',1)->get();
           $data['buss']=CarService::join('currency','currency.cur_id','=','car_services.cur_id')->get();
          
     
              return view('carError',$data);
         }
     
         public function saved_car(Request $req){
            
         
              $data=[];  
              $users_str;
              $log=new Logs;
           $log->remarker_id=1;
         
           $users_str = json_encode($req->remark_body);
     
           $log->remark_body=$users_str;
           $log->remarker_id=$req->remark_id;
           $log->main_servic_id=$req->service_id;
           $log->service_id=$req->car_id;
           $log->editor_id=$req->emp_id;
           $log->number=$req->car_number10;
           $log->status=2;
           $log->save();
     
             // $id= BusService::find($req->bus_id);
           $affected= CarService::where(['car_id'=>$req->car_id])
           ->update(['errorlog'=>1,'service_status'=>1]);
     
        }
     
       
     
     
        public function send_car($id){
        
         $affected= CarService::where(['car_id'=>$id])
         ->update(['service_status'=>3]);
         return back()->with('seccess','Seccess Data Delete');
        
      
         }
         public function visaError(Request $req){
       
     
               $data['data'] =VisaService::join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
               ->join('currency','currency.cur_id','=','visa_services.cur_id')
               ->join('employees','employees.emp_id','=','visa_services.due_to_customer')
               ->where(['visa_services.deleted'=>0,'visa_services.user_status'=>0,'visa_services.errorlog'=>0,'visa_services.service_status'=>2])->paginate(10);
               
               
               $data['airline']=Airline::where('is_active',1)->get();
               $data['suplier']=Supplier::where('is_active',1)->get();
               $data['emp']=Employee::where('is_active',1)->get();
               $data['buss']=VisaService::join('currency','currency.cur_id','=','visa_services.cur_id')->get();
              
         
                  return view('visaError',$data);
             }
         
             public function saved_visa(Request $req){
                
             
                  $data=[];  
                  $users_str;
                  $log=new Logs;
             
               $users_str = json_encode($req->remark_body);
         
               $log->remark_body=$users_str;
               $log->remarker_id=$req->remark_id;
               $log->main_servic_id=$req->service_id;
               $log->service_id=$req->visa_id;
               $log->editor_id=$req->emp_id;
               $log->number=$req->visa_number10;
               $log->status=2;
               $log->save();
         
                 // $id= BusService::find($req->bus_id);
               $affected= VisaService::where(['visa_id'=>$req->visa_id])
               ->update(['errorlog'=>1,'service_status'=>1]);
         
            }
          public function send_visa($id){
            
             $affected= VisaService::where(['visa_id'=>$id])
             ->update(['service_status'=>3]);
             return back()->with('seccess','Seccess Data Delete');
         }

         public function medError(Request $req){
       
               $data['data'] =MedicalService::join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
               ->join('currency','currency.cur_id','=','medical_services.cur_id')
               ->join('employees','employees.emp_id','=','medical_services.due_to_customer')
               ->where(['medical_services.deleted'=>0,'medical_services.user_status'=>0,'medical_services.service_status'=>2,'medical_services.errorlog'=>0])->paginate(10);
               
              
               $data['airline']=Airline::where('is_active',1)->get();
               $data['suplier']=Supplier::where('is_active',1)->get();
               $data['emp']=Employee::where('is_active',1)->get();
               $data['buss']=MedicalService::join('currency','currency.cur_id','=','medical_services.cur_id')->get();
              
         
                  return view('medError',$data);
             }
         
             public function saved_med(Request $req){
                
             
                  $data=[];  
                  $users_str;
                  $log=new Logs;
               $log->remarker_id=1;
             
               $users_str = json_encode($req->remark_body);
         
               $log->remark_body=$users_str;
               $log->remarker_id=$req->remark_id;
               $log->main_servic_id=$req->service_id;
               $log->service_id=$req->med_id;
               $log->editor_id=$req->emp_id;
               $log->number=$req->med_number10;
               $log->status=2;
               $log->save();
         
                 // $id= BusService::find($req->bus_id);
               $affected= MedicalService::where(['med_id'=>$req->med_id])
               ->update(['errorlog'=>1,'service_status'=>1]);
         
            }
         
           
         
         
            public function send_med($id){
            
             $affected= MedicalService::where(['med_id'=>$id])
             ->update(['service_status'=>3]);
             return back()->with('seccess','Seccess Data Delete');
            
          
             }
             public function genError(Request $req){
       
       
                   $data['data'] =GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
                   ->join('currency','currency.cur_id','=','general_services.cur_id')
                   ->join('employees','employees.emp_id','=','general_services.due_to_customer')
                   ->where(['general_services.deleted'=>0,'general_services.user_status'=>0,'general_services.errorlog'=>0,'general_services.service_status'=>2])->paginate(10);
                   
                   $data['airline']=Airline::where('is_active',1)->get();
                   $data['suplier']=Supplier::where('is_active',1)->get();
                   $data['emp']=Employee::where('is_active',1)->get();
                   $data['buss']=GeneralService::join('currency','currency.cur_id','=','general_services.cur_id')->get();
                  
             
                      return view('genError',$data);
                 }
             
                 public function saved_gen(Request $req){
                    
                 
                      $data=[];  
                      $users_str;
                      $log=new Logs;
                   $log->remarker_id=1;
                 
                   $users_str = json_encode($req->remark_body);
             
                   $log->remark_body=$users_str;
                   $log->remarker_id=$req->remark_id;
                   $log->main_servic_id=$req->service_id;
                   $log->service_id=$req->gen_id;
                   $log->editor_id=$req->emp_id;
                   $log->number=$req->gen_number10;
                   $log->status=2;
                   $log->save();
             
                     // $id= BusService::find($req->bus_id);
                   $affected= GeneralService::where(['gen_id'=>$req->gen_id])
                   ->update(['errorlog'=>1,'service_status'=>1]);
             
                }
             public function send_gen($id){
                
                 $affected= GeneralService::where(['gen_id'=>$id])
                 ->update(['service_status'=>3]);
                 return back()->with('seccess','Seccess Data Delete');
                
              
                 }
                     
         

}


