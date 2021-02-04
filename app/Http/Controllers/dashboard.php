<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\users;
use App\TicketService;
use App\BusService;
use App\CarService;
use App\GeneralService;
use App\HotelService;
use App\MedicalService;
use App\VisaService;
use App\Logs;
use Illuminate\Support\Facades\DB;

class dashboard extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
      /*  $where=['employees.is_active'=>0];
        $where +=['services.deleted'=>0];
        $where2=['employees.is_active'=>1];
        $where2 +=['services.deleted'=>0];
     
        $data1=Service::where($where)->count();
        $data2=Service::where($where2)->count();
        return view('dashboard',$data1,$data2);*/

      $data1=Service::where([['deleted',0],['is_active',1]])->get()->count();
      $data2=Service::where([['deleted',0],['is_active',0]])->get()->count();
      $data3= users::where([['is_active',1],['is_delete',0]])->get()->count();
      $data4= users::select('name','email')->where([['is_active',1],['is_delete',0]])->get();
      $ticket1= TicketService::where([['deleted',0],['ses_status',1]])->get()->count();
      $ticket2= TicketService::where([['deleted',0],['ses_status',2]])->get()->count();
      $ticket3= TicketService::where([['deleted',0],['ses_status',3]])->get()->count();
      $ticket4= TicketService::where([['deleted',0],['ses_status',4]])->get()->count();
      $bus1= BusService::where([['deleted',0],['ses_status',1]])->get()->count();
      $bus2= BusService::where([['deleted',0],['ses_status',2]])->get()->count();
      $bus3= BusService::where([['deleted',0],['ses_status',3]])->get()->count();
      $bus4= BusService::where([['deleted',0],['ses_status',4]])->get()->count();
      $hotel1= HotelService::where([['deleted',0],['ses_status',1]])->get()->count();
      $hotel2= HotelService::where([['deleted',0],['ses_status',2]])->get()->count();
      $hotel3= HotelService::where([['deleted',0],['ses_status',3]])->get()->count();
      $hotel4= HotelService::where([['deleted',0],['ses_status',4]])->get()->count();
      $visa1= VisaService::where([['deleted',0],['ses_status',1]])->get()->count();
      $visa2= VisaService::where([['deleted',0],['ses_status',2]])->get()->count();
      $visa3= VisaService::where([['deleted',0],['ses_status',3]])->get()->count();
      $visa4= VisaService::where([['deleted',0],['ses_status',4]])->get()->count();
      $car1= CarService::where([['deleted',0],['ses_status',1]])->get()->count();
      $car2= CarService::where([['deleted',0],['ses_status',2]])->get()->count();
      $car3= CarService::where([['deleted',0],['ses_status',3]])->get()->count();
      $car4= CarService::where([['deleted',0],['ses_status',4]])->get()->count();
      $med1= MedicalService::where([['deleted',0],['ses_status',1]])->get()->count();
      $med2= MedicalService::where([['deleted',0],['ses_status',2]])->get()->count();
      $med3= MedicalService::where([['deleted',0],['ses_status',3]])->get()->count();
      $med4= MedicalService::where([['deleted',0],['ses_status',4]])->get()->count();
      $gen1= GeneralService::where([['deleted',0],['ses_status',1]])->get()->count();
      $gen2= GeneralService::where([['deleted',0],['ses_status',2]])->get()->count();
      $gen3= GeneralService::where([['deleted',0],['ses_status',3]])->get()->count();
      $gen4= GeneralService::where([['deleted',0],['ses_status',4]])->get()->count();

      return view('dashboard',['data'=>$data1,'data1'=>$data2, 'data2'=>$data3,
       'ticket1'=>$ticket1 , 'ticket2'=>$ticket2, 'ticket3'=>$ticket3, 'ticket4'=>$ticket4, 
       'bus1'=>$bus1, 'bus2'=>$bus2, 'bus3'=>$bus3, 'bus4'=>$bus4,
       'hotel1'=>$hotel1, 'hotel2'=>$hotel2, 'hotel3'=>$hotel3, 'hotel4'=>$hotel4,
       'visa1'=>$visa1, 'visa2'=>$visa2, 'visa3'=>$visa3, 'visa4'=>$visa4,
       'car1'=>$car1, 'car2'=>$car2, 'car3'=>$car3, 'car4'=>$car4,
       'med1'=>$med1, 'med2'=>$med2, 'med3'=>$med3, 'med4'=>$med4,
       'gen1'=>$gen1, 'gen2'=>$gen2, 'gen3'=>$gen3, 'gen4'=>$gen4,
       'data4'=>$data4]);
    }
    
    public function remark(){
      $data['data'] =BusService::join('suppliers','suppliers.s_no','=','bus_services.due_to_supp')
      ->join('currency','currency.cur_id','=','bus_services.ses_cur_id')
      ->join('employees','employees.emp_id','=','bus_services.due_to_customer')
      ->where(['bus_services.deleted'=>0,'bus_services.user_status'=>0])->paginate(10);
      
      $data['ticket'] =TicketService::join('suppliers','suppliers.s_no','=','ticket_services.due_to_supp')
      ->join('currency','currency.cur_id','=','ticket_services.ses_cur_id')
      ->join('employees','employees.emp_id','=','ticket_services.due_to_customer')
      ->where(['ticket_services.deleted'=>0,'ticket_services.user_status'=>0])->paginate(10);
      
      $data['car'] =CarService::join('suppliers','suppliers.s_no','=','car_services.due_to_supp')
      ->join('currency','currency.cur_id','=','car_services.ses_cur_id')
      ->join('employees','employees.emp_id','=','car_services.due_to_customer')
      ->where(['car_services.deleted'=>0,'car_services.user_status'=>0])->paginate(10);
      
       
      $data['hotel'] =HotelService::join('suppliers','suppliers.s_no','=','hotel_services.due_to_supp')
      ->join('currency','currency.cur_id','=','hotel_services.ses_cur_id')
      ->join('employees','employees.emp_id','=','hotel_services.due_to_customer')
      ->where(['hotel_services.deleted'=>0,'hotel_services.user_status'=>0])->paginate(10);
      

      $data['visa'] =VisaService::join('suppliers','suppliers.s_no','=','visa_services.due_to_supp')
      ->join('currency','currency.cur_id','=','visa_services.ses_cur_id')
      ->join('employees','employees.emp_id','=','visa_services.due_to_customer')
      ->where(['visa_services.deleted'=>0,'visa_services.user_status'=>0])->paginate(10);
      
      $data['med'] =MedicalService::join('suppliers','suppliers.s_no','=','medical_services.due_to_supp')
      ->join('currency','currency.cur_id','=','medical_services.ses_cur_id')
      ->join('employees','employees.emp_id','=','medical_services.due_to_customer')
      ->where(['medical_services.deleted'=>0,'medical_services.user_status'=>0])->paginate(10);
      
      $data['gen'] =GeneralService::join('suppliers','suppliers.s_no','=','general_services.due_to_supp')
      ->join('currency','currency.cur_id','=','general_services.ses_cur_id')
      ->join('employees','employees.emp_id','=','general_services.due_to_customer')
      ->where(['general_services.deleted'=>0,'general_services.user_status'=>0])->paginate(10);
      
      
      return view('Admin_remark',$data);
    }
    

    public function addBusRemark(Request $req){
      $log=new Logs;
print_r($req->remark_id);
      $log->remarker_id=$req->remark_id;
      $log->remark_body=$req->remark_body;
      $log->main_servic_id=$req->service_id;
      $log->service_id=$req->bus_id;
      $log->editor_id=$req->emp_id;
      $log->number=$req->bus_number;
      $log->status=3;
      $log->save();
    
    }

    public function addTicketRemark(Request $req){
      $log=new Logs;
      $log->remarker_id=$req->ticket_remark_id;
      $log->remark_body=$req->ticket_remark_body;
      $log->main_servic_id=$req->ticket_service_id;
      $log->service_id=$req->ticket_id;
      $log->editor_id=$req->ticket_emp_id;
      $log->number=$req->ticket_number;

      $log->status=3;
      $log->save();
    
    }

    public function addCarRemark(Request $req){
      $log=new Logs;
      $log->remarker_id=$req->car_remark_id;
      $log->remark_body=$req->car_remark_body;
      $log->main_servic_id=$req->car_service_id;
      $log->service_id=$req->car_id;
      $log->editor_id=$req->car_emp_id;
      $log->number=$req->car_voucher_number;

      $log->status=3;
      $log->save();
    
    }
    public function addHotelRemark(Request $req){
      $log=new Logs;
      $log->remarker_id=$req->hotel_remark_id;
      $log->remark_body=$req->hotel_remark_body;
      $log->main_servic_id=$req->hotel_service_id;
      $log->service_id=$req->hotel_id;
      $log->editor_id=$req->hotel_emp_id;
      $log->number=$req->hotel_voucher_number;

      $log->status=3;
      $log->save();
    
    }
     public function addVisaRemark(Request $req){
      $log=new Logs;
print_r($req->remark_id);
      $log->remarker_id=$req->visa_remark_id;
      $log->remark_body=$req->visa_remark_body;
      $log->main_servic_id=$req->visa_service_id;
      $log->service_id=$req->visa_id;
      $log->editor_id=$req->visa_emp_id;
      $log->status=3;
      $log->number=$req->visa_voucher_number;
      $log->save();
    
    }

    public function addMedRemark(Request $req){
      $log=new Logs;
      $log->remarker_id=$req->med_remark_id;
      $log->remark_body=$req->med_remark_body;
      $log->main_servic_id=$req->med_service_id;
      $log->service_id=$req->med_id;
      $log->editor_id=$req->med_emp_id;
      $log->status=3;
      $log->number=$req->document_number;

      $log->save();
    
    }
    public function addGenRemark(Request $req){
      $log=new Logs;
      $log->remarker_id=$req->gen_remark_id;
      $log->remark_body=$req->gen_remark_body;
      $log->main_servic_id=$req->gen_service_id;
      $log->service_id=$req->gen_id;
      $log->editor_id=$req->gen_emp_id;
      $log->number=$req->gen_voucher_number;

      $log->status=3;
      $log->save();
    
    }
    
}
