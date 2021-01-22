<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Users;
use App\TicketService;
use App\BusService;
use App\CarService;
use App\GeneralService;
use App\HotelService;
use App\MedicalService;
use App\VisaService;

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
      $ticket1= TicketService::where([['deleted',0],['service_status',1]])->get()->count();
      $ticket2= TicketService::where([['deleted',0],['service_status',2]])->get()->count();
      $ticket3= TicketService::where([['deleted',0],['service_status',3]])->get()->count();
      $ticket4= TicketService::where([['deleted',0],['service_status',4]])->get()->count();
      $bus1= BusService::where([['deleted',0],['service_status',1]])->get()->count();
      $bus2= BusService::where([['deleted',0],['service_status',2]])->get()->count();
      $bus3= BusService::where([['deleted',0],['service_status',3]])->get()->count();
      $bus4= BusService::where([['deleted',0],['service_status',4]])->get()->count();
      $hotel1= HotelService::where([['deleted',0],['service_status',1]])->get()->count();
      $hotel2= HotelService::where([['deleted',0],['service_status',2]])->get()->count();
      $hotel3= HotelService::where([['deleted',0],['service_status',3]])->get()->count();
      $hotel4= HotelService::where([['deleted',0],['service_status',4]])->get()->count();
      $visa1= VisaService::where([['deleted',0],['service_status',1]])->get()->count();
      $visa2= VisaService::where([['deleted',0],['service_status',2]])->get()->count();
      $visa3= VisaService::where([['deleted',0],['service_status',3]])->get()->count();
      $visa4= VisaService::where([['deleted',0],['service_status',4]])->get()->count();
      $car1= CarService::where([['deleted',0],['service_status',1]])->get()->count();
      $car2= CarService::where([['deleted',0],['service_status',2]])->get()->count();
      $car3= CarService::where([['deleted',0],['service_status',3]])->get()->count();
      $car4= CarService::where([['deleted',0],['service_status',4]])->get()->count();
      $med1= MedicalService::where([['deleted',0],['service_status',1]])->get()->count();
      $med2= MedicalService::where([['deleted',0],['service_status',2]])->get()->count();
      $med3= MedicalService::where([['deleted',0],['service_status',3]])->get()->count();
      $med4= MedicalService::where([['deleted',0],['service_status',4]])->get()->count();
      $gen1= GeneralService::where([['deleted',0],['service_status',1]])->get()->count();
      $gen2= GeneralService::where([['deleted',0],['service_status',2]])->get()->count();
      $gen3= GeneralService::where([['deleted',0],['service_status',3]])->get()->count();
      $gen4= GeneralService::where([['deleted',0],['service_status',4]])->get()->count();

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
    
}
//