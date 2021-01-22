<?php

namespace App\Http\Controllers;
use App\Supplier;
use App\Service;
use App\TicketService;
use App\BusService;
use App\CarService;
use App\GeneralService;
use App\HotelService;
use App\MedicalService;
use App\VisaService;
use App\airline;
use App\Employee;
use App\Exports\ExportSupReport;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show_row($id)
    { 
        $data['suplier']= Supplier::join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
        ->where('s_no','=',$id)->get();
        json_encode($data);
       return view('display_rowRepo',['data'=>$data]);
        
                    }
    public function __construct()
    {
        //$this->middleware(['role:admin ']); 
    }
    public function index()
    {
        //$filter = Supplier::where('is_active',1)->paginate(7);
    }
    

    

    /*public function display(){
      $affected2 = Supplier::where('is_deleted',0)->paginate(7);
           // $affected2 = DB::select('select  S.s_no as s_no');
        return view('supplierRepo',[ 'data'=>$affected2,]);
         
        
  
        $data=DB::select('select * from bus_services')
        ->crossJoin('car_services ')
        ->crossJoin('general_services')
        ->crossJoin('hotel_services')
        ->crossJoin('medical_services')
        ->crossJoin('ticket_services')
        ->crossJoin('visa_services')
        ->get(); 

        $data=DB::table('bus_services')
        ->crossJoin('car_services ')
        ->crossJoin('general_services')
        ->crossJoin('hotel_services')
        ->crossJoin('medical_services')
        ->crossJoin('ticket_services')
        ->crossJoin('visa_services')
        ->get();


    }*/


    public function display(){
        $data=array();
    
        //$data=[];
        $tick=DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 and tic.passnger_currency="USD" GROUP By Issue_date');
        $visa=DB::select('SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 and visa.passnger_currency="USD" GROUP By Issue_date');
        $bus=DB::select('SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 and bus.passnger_currency="USD" GROUP By Issue_date');
        $hot=DB::select('SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 and hot.passnger_currency="USD"  GROUP By Issue_date');
        $car=DB::select('SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 and car.passnger_currency="USD" GROUP By Issue_date');
        $med=DB::select('SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 and med.passnger_currency="USD" GROUP By Issue_date');
        $gen=DB::select('SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 and gen.passnger_currency="USD" GROUP By Issue_date');
        // $data=[
        //     'tic'=> $tick,
        //     'visa' => $visa,
        //     'bus'  => $bus,
        //     'hot' => $hot,
        //     'car' => $car,
        //     'med' => $med,
        //     'gen' =>$gen
        // ];
    //  dd($tick[0]->tt);
        //dd($tick);


        //$data =array_merge($tick,$visa,$bus,$hot,$car,$med,$gen);
        
        $data['tickets']=$tick;
        $data['visa']=$visa;
     
        /*$data=DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 UNION 
       SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 UNION 
       SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 UNION 
       SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 UNION 
       SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 UNION 
       SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 UNION 
       SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 GROUP By Issue_date');*/
      


      
     
      
      // echo json_encode($data);
       // dd($data);
    return view('supplierRepo',['tic'=>$tick,'visa'=>$visa,'bus'=>$bus,'car'=>$car,'hot'=>$hot,'med'=>$med,'gen'=>$gen]);

    }

    public function ticketRepo(){
        /*$repoData=DB::select('SELECT 
        ticket.issue_date as ticket_issue,ticket.refernce as ticket_refernce,ticket.passenger_name as ticket_passenger,ticket.due_to_supp as ticket_supp,ticket.provider_cost as ticket_supp_cost,ticket.due_to_customer as ticket_customer,ticket.cost as ticket_customer_cost,ticket.service_id as ticket_service_id,
        visa.issue_date as visa_issue,visa.refernce as visa_refernce,visa.passenger_name as visa_passenger,visa.due_to_supp as visa_supp,visa.provider_cost as visa_supp_cost,visa.due_to_customer as visa_customer,visa.cost as visa_customer_cost,visa.service_id as visa_service_id
        FROM bus_services as bus
        INNER JOIN car_services as car
        INNER JOIN general_services as gen
        INNER JOIN hotel_services as hotel
        INNER JOIN medical_services as med
        INNER JOIN ticket_services as ticket
        INNER JOIN visa_services as visa');*/

    
    $ticketRepo=DB::select('select * from ticket_services ');
    
    $supp=DB::select('select * from suppliers ');
    

    return view('ticketReport',['all'=>$ticketRepo,'supp'=>$supp]);
    

    

    }

    public function busRepo(){
      

    
    $busRepo=DB::select('select * from bus_services ');
    
    $supp=DB::select('select * from suppliers ');
    

    return view('busReport',['all'=>$busRepo,'supp'=>$supp]);
    

    

    }

    public function visaRepo(){
      

    
        $visaRepo=DB::select('select * from visa_services ');
        
        $supp=DB::select('select * from suppliers ');
        
    
        return view('visaReport',['all'=>$visaRepo,'supp'=>$supp]);
        
    
        
    
        }

        public function carRepo(){
      

    
            $carRepo=DB::select('select * from car_services ');
            
            $supp=DB::select('select * from suppliers ');
            
        
            return view('carReport',['all'=>$carRepo,'supp'=>$supp]);
            
        
            
        
            }


            public function hotelRepo(){
      

    
                $hotRepo=DB::select('select * from hotel_services ');
                
                $supp=DB::select('select * from suppliers ');
                
            
                return view('hotelReport',['all'=>$hotRepo,'supp'=>$supp]);
                
            
                
            
                }

                public function medicalRepo(){
      

    
                    $medRepo=DB::select('select * from medical_services ');
                    
                    $supp=DB::select('select * from suppliers ');
                    
                
                    return view('medicalReport',['all'=>$medRepo,'supp'=>$supp]);
                    
                
                    
                
                    }

                    public function generalRepo(){
      

    
                        $genRepo=DB::select('select * from general_services ');
                        
                        $supp=DB::select('select * from suppliers ');
                        
                    
                        return view('generalReport',['all'=>$genRepo,'supp'=>$supp]);
                        
                    
                        
                    
                        }
    
    /*public function display_role_user()
    {
        $affected = DB::select('select  ru.user_id as u_id ,GROUP_CONCAT(r.name SEPARATOR "||") as roless,u.name as u_name
        FROM role_user as ru
        INNER JOIN roles as r on ru.role_id=r.id
        INNER JOIN users as u on ru.user_id=u.id
        GROUP BY ru.user_id');
    return view('role_user_display',['data'=>$affected]);
    }*/

    

    public function display_row($id)
    { 
        /* @foreach($data as $item)


        <option  value="{{$item->cur_id}}">{{$item->cur_name}}</option>
@endforeach*/
/*join('sup_currency','sup_currency.sup_id','=','suppliers.s_no')
        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
        ->*/
        $affected = Supplier::where('s_no',$id)->get();
         $affected2 = Supplier::join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')->where('suppliers.s_no',$id)->paginate(7);
      //  $currencies=DB::select('select * from currency ');

      //$affected = DB::select('select  S.s_no as s_no , GROUP_CONCAT(C.cur_name SEPARATOR "||") as curencies , GROUP_CONCAT(Ss.ser_name SEPARATOR "||") as servicess , S.supplier_name as s_name
      //FROM suppliers as S
     // INNER JOIN currency as C on S.s_no=
    //  ');

        return view('display_rowRepo',['data'=>$affected,'sup_cur'=>$affected2]);
    }

   
      

        
public function filterSupp($sup_id){
    $genSupRepo=DB::select('select * from general_services where general_services.due_to_supp="'.$sup_id.'"');
                    
    dd($genSupRepo);
return view('generalReport',['all'=>$genSupRepo]);

}
       


        
            
                public function filter($id){
                    if($id==1){
                        $ticketRepo=DB::select('select * from ticket_services where ticket_services.passnger_currency="USD"');
                        return view('ticketReport',['all'=>$ticketRepo]);
                    }elseif($id==2){
                        $ticketRepo=DB::select('select * from ticket_services where ticket_services.passnger_currency="YER"');
                        return view('ticketReport',['all'=>$ticketRepo]);
                    }
                    elseif($id==3){
                        
                        $ticketRepo=DB::select('select * from ticket_services where ticket_services.passnger_currency="SAR"');
                        return view('ticketReport',['all'=>$ticketRepo]);
                    }
                    elseif($id==4){
                        $busRepo=DB::select('select * from bus_services where bus_services.passnger_currency="USD"');
                        return view('busReport',['all'=>$busRepo]);
                    }
                    elseif($id==5){
                        $busRepo=DB::select('select * from bus_services where bus_services.passnger_currency="YER"');
                        return view('busReport',['all'=>$busRepo]);
                    }
                    elseif($id==6){
                        $busRepo=DB::select('select * from bus_services where bus_services.passnger_currency="SAR"');
                        return view('busReport',['all'=>$busRepo]);
                    }
                    elseif($id==7){
                        $visaRepo=DB::select('select * from visa_services where visa_services.passnger_currency="USD"');
                        return view('visaReport',['all'=>$visaRepo]);
                    }
                    elseif($id==8){
                        $visaRepo=DB::select('select * from visa_services where visa_services.passnger_currency="YER"');
                        return view('visaReport',['all'=>$visaRepo]);
                    }
                    elseif($id==9){
                        $visaRepo=DB::select('select * from visa_services where visa_services.passnger_currency="SAR"');
                        return view('visaReport',['all'=>$visaRepo]);
                    }
                    elseif($id==10){
                        $carRepo=DB::select('select * from car_services where car_services.passnger_currency="USD"');
                        return view('carReport',['all'=>$carRepo]);
                    }
                    elseif($id==11){
                        $carRepo=DB::select('select * from car_services where car_services.passnger_currency="YER"');
                        return view('carReport',['all'=>$carRepo]);
                    }
                    elseif($id==12){
                        $carRepo=DB::select('select * from car_services where car_services.passnger_currency="SAR"');
                        return view('carReport',['all'=>$carRepo]);
                    }
                    elseif($id==13){
                        $carRepo=DB::select('select * from hotel_services where hotel_services.passnger_currency="USD"');
                        return view('hotelReport',['all'=>$carRepo]);
                    }
                    elseif($id==14){
                        $carRepo=DB::select('select * from hotel_services where hotel_services.passnger_currency="YER"');
                        return view('hotelReport',['all'=>$carRepo]);
                    }
                    elseif($id==15){
                        $carRepo=DB::select('select * from hotel_services where hotel_services.passnger_currency="SAR"');
                        return view('hotelReport',['all'=>$carRepo]);
                    }
                    elseif($id==16){
                        $medRepo=DB::select('select * from medical_services where medical_services.passnger_currency="USD"');
                        return view('medicalReport',['all'=>$medRepo]);
                    }
                    elseif($id==17){
                        $medRepo=DB::select('select * from medical_services where medical_services.passnger_currency="YER"');
                        return view('medicalReport',['all'=>$medRepo]);
                    }
                    elseif($id==18){
                        $medRepo=DB::select('select * from medical_services where medical_services.passnger_currency="SAR"');
                        return view('medicalReport',['all'=>$medRepo]);
                    }
                    elseif($id==19){
                        $genRepo=DB::select('select * from general_services where general_services.passnger_currency="USD"');
                        return view('generalReport',['all'=>$genRepo]);
                    }
                    elseif($id==20){
                        $genRepo=DB::select('select * from general_services where general_services.passnger_currency="YER"');
                        return view('generalReport',['all'=>$genRepo]);
                    }
                    elseif($id==21){
                        $genRepo=DB::select('select * from general_services where general_services.passnger_currency="SAR"');
                        return view('generalReport',['all'=>$genRepo]);
                    }

                    elseif($id==100){
                        $tick=DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 and tic.passnger_currency="YER" GROUP By Issue_date');
                         $visa=DB::select('SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 and visa.passnger_currency="YER" GROUP By Issue_date');
                         $bus=DB::select('SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 and bus.passnger_currency="YER" GROUP By Issue_date');
                        $hot=DB::select('SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 and hot.passnger_currency="YER"  GROUP By Issue_date');
                        $car=DB::select('SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 and car.passnger_currency="YER" GROUP By Issue_date');
                         $med=DB::select('SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 and med.passnger_currency="YER" GROUP By Issue_date');
                        $gen=DB::select('SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 and gen.passnger_currency="YER" GROUP By Issue_date');
        
                        return view('supplierRepo',['tic'=>$tick,'visa'=>$visa,'bus'=>$bus,'car'=>$car,'hot'=>$hot,'med'=>$med,'gen'=>$gen]);

   
                                    }
                    elseif($id==101){
                         $tick=DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 and tic.passnger_currency="SAR" GROUP By Issue_date');
                        $visa=DB::select('SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 and visa.passnger_currency="SAR" GROUP By Issue_date');
                        $bus=DB::select('SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 and bus.passnger_currency="SAR" GROUP By Issue_date');
                        $hot=DB::select('SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 and hot.passnger_currency="SAR"  GROUP By Issue_date');
                        $car=DB::select('SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 and car.passnger_currency="SAR" GROUP By Issue_date');
                        $med=DB::select('SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 and med.passnger_currency="SAR" GROUP By Issue_date');
                        $gen=DB::select('SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 and gen.passnger_currency="SAR" GROUP By Issue_date');
        
                        return view('supplierRepo',['tic'=>$tick,'visa'=>$visa,'bus'=>$bus,'car'=>$car,'hot'=>$hot,'med'=>$med,'gen'=>$gen]);

   
                                    }

                    elseif($id==200)  {
                        $tick = DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 and tic.passnger_currency="USD" and Date(Issue_date) = CURDATE() GROUP By Issue_date');
                        $visa=DB::select('SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 and visa.passnger_currency="USD" and Date(Issue_date) = CURDATE() GROUP By Issue_date');
                        $bus=DB::select('SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 and bus.passnger_currency="USD" and Date(Issue_date) = CURDATE() GROUP By Issue_date');
                        $hot=DB::select('SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 and hot.passnger_currency="USD" and Date(Issue_date) = CURDATE()  GROUP By Issue_date');
                        $car=DB::select('SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 and car.passnger_currency="USD" and Date(Issue_date) = CURDATE() GROUP By Issue_date');
                        $med=DB::select('SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 and med.passnger_currency="USD" and Date(Issue_date) = CURDATE() GROUP By Issue_date');
                        $gen=DB::select('SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 and gen.passnger_currency="USD" and Date(Issue_date) = CURDATE() GROUP By Issue_date');
        
                        return view('supplierRepo',['tic'=>$tick,'visa'=>$visa,'bus'=>$bus,'car'=>$car,'hot'=>$hot,'med'=>$med,'gen'=>$gen]);

   
         }

         elseif($id==201)  {
            $tick = DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 and tic.passnger_currency="USD" and Date(Issue_date) = SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY) GROUP By Issue_date');
            $visa=DB::select('SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 and visa.passnger_currency="USD" and Date(Issue_date) = SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY) GROUP By Issue_date');
            $bus=DB::select('SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 and bus.passnger_currency="USD" and Date(Issue_date) = SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY) GROUP By Issue_date');
            $hot=DB::select('SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 and hot.passnger_currency="USD" and Date(Issue_date) = SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY) GROUP By Issue_date');
            $car=DB::select('SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 and car.passnger_currency="USD" and Date(Issue_date) = SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY) GROUP By Issue_date');
            $med=DB::select('SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 and med.passnger_currency="USD" and Date(Issue_date) = SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY) GROUP By Issue_date');
            $gen=DB::select('SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 and gen.passnger_currency="USD" and Date(Issue_date) = SUBDATE(CURRENT_DATE(), INTERVAL 1 DAY) GROUP By Issue_date');
//dd($tick);
            return view('supplierRepo',['tic'=>$tick,'visa'=>$visa,'bus'=>$bus,'car'=>$car,'hot'=>$hot,'med'=>$med,'gen'=>$gen]);


}

elseif($id==202)  {
    $tick = DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 and tic.passnger_currency="USD" and Date(Issue_date) >= SUBDATE(CURRENT_DATE(), INTERVAL 7 DAY) GROUP By Issue_date');
    $visa=DB::select('SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 and visa.passnger_currency="USD" and Date(Issue_date) >= SUBDATE(CURRENT_DATE(), INTERVAL 7 DAY) GROUP By Issue_date');
    $bus=DB::select('SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 and bus.passnger_currency="USD" and Date(Issue_date) >= SUBDATE(CURRENT_DATE(), INTERVAL 7 DAY) GROUP By Issue_date');
    $hot=DB::select('SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 and hot.passnger_currency="USD" and Date(Issue_date) >= SUBDATE(CURRENT_DATE(), INTERVAL 7 DAY) GROUP By Issue_date');
    $car=DB::select('SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 and car.passnger_currency="USD" and Date(Issue_date) >= SUBDATE(CURRENT_DATE(), INTERVAL 7 DAY) GROUP By Issue_date');
    $med=DB::select('SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 and med.passnger_currency="USD" and Date(Issue_date) >= SUBDATE(CURRENT_DATE(), INTERVAL 7 DAY) GROUP By Issue_date');
    $gen=DB::select('SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 and gen.passnger_currency="USD" and Date(Issue_date) >= SUBDATE(CURRENT_DATE(), INTERVAL 7 DAY) GROUP By Issue_date');
//dd($tick);
    return view('supplierRepo',['tic'=>$tick,'visa'=>$visa,'bus'=>$bus,'car'=>$car,'hot'=>$hot,'med'=>$med,'gen'=>$gen]);


}

elseif($id==203)  {
    $tick = DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 and tic.passnger_currency="USD" and MONTH(Issue_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $visa=DB::select('SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 and visa.passnger_currency="USD" and MONTH(Issue_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $bus=DB::select('SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 and bus.passnger_currency="USD" and MONTH(Issue_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $hot=DB::select('SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 and hot.passnger_currency="USD" and MONTH(Issue_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $car=DB::select('SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 and car.passnger_currency="USD" and MONTH(Issue_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $med=DB::select('SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 and med.passnger_currency="USD" and MONTH(Issue_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $gen=DB::select('SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 and gen.passnger_currency="USD" and MONTH(Issue_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
//dd($tick);
    return view('supplierRepo',['tic'=>$tick,'visa'=>$visa,'bus'=>$bus,'car'=>$car,'hot'=>$hot,'med'=>$med,'gen'=>$gen]);


}

elseif($id==204)  {
    $tick = DB::select('SELECT count(*) as tc,sum(cost) as tt ,issue_date as ad ,service_id as st_id FROM ticket_services as tic WHERE tic.service_status=4 and tic.passnger_currency="USD" and YEAR(Issue_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $visa=DB::select('SELECT count(*) as vc,sum(cost) as vt ,issue_date as av ,service_id as sv_id FROM visa_services as visa WHERE visa.service_status=4 and visa.passnger_currency="USD" and YEAR(Issue_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $bus=DB::select('SELECT count(*) as bc,sum(cost) as bt,issue_date as ab ,service_id as sb_id FROM bus_services as bus WHERE bus.service_status=4 and bus.passnger_currency="USD" and YEAR(Issue_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $hot=DB::select('SELECT count(*) as hc,sum(cost) as ht , issue_date as ah ,service_id as sh_id FROM hotel_services as hot WHERE hot.service_status=4 and hot.passnger_currency="USD" and YEAR(Issue_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $car=DB::select('SELECT count(*) as cc,sum(cost) as ct ,issue_date as ac ,service_id as sc_id FROM car_services as car WHERE car.service_status=4 and car.passnger_currency="USD" and YEAR(Issue_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $med=DB::select('SELECT count(*) as mc,sum(cost) as mt ,issue_date as am ,service_id as sm_id FROM medical_services as med WHERE med.service_status=4 and med.passnger_currency="USD" and YEAR(Issue_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
    $gen=DB::select('SELECT count(*) as gc,sum(cost) as gt ,issue_date as ag ,service_id as sg_id FROM general_services as gen WHERE gen.service_status=4 and gen.passnger_currency="USD" and YEAR(Issue_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) GROUP By Issue_date');
//dd($tick);
    return view('supplierRepo',['tic'=>$tick,'visa'=>$visa,'bus'=>$bus,'car'=>$car,'hot'=>$hot,'med'=>$med,'gen'=>$gen]);


}


                }


               
                // public function expenses(Request $request)
                // {
                //     if (isset($request->date_filter)) {
                //         $parts = explode(' - ' , $request->date_filter);
                //         $date_from = $parts[0];
                //         $date_to = $parts[1];
                //     } else {
                //         $carbon_date_from = new Report('last Monday');
                //         $date_from = $carbon_date_from->toDateString();
                //         $carbon_date_to = new Report('this Sunday');
                //         $date_to = $carbon_date_to->toDateString();
                //     }
                // }
               

                public function ExportIntoExcel(){
                    return Excel::download(new ExportSupReport, 'Suppliers.xlsx');
                }




        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $services['services']=Service::where('is_active',1)->get();
       // return view('addSupplier')->with('services', $services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}
