<?php

namespace App\Http\Controllers;
use App\Supplier;
use App\Service;
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
    

    

    public function display(){
            $affected2 = Supplier::where('is_deleted',0)->paginate(7);
        return view('supplierRepo',[ 'data'=>$affected2,]);
    }

    

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
                        ->join('services','services.ser_id','=','sup_services.service_id')->where('suppliers.s_no',$id)->paginate(7);;
      //  $currencies=DB::select('select * from currency ');
        return view('display_rowRepo',['data'=>$affected,'sup_cur'=>$affected2]);
    }

   
      

        

       


        public function is_active($id){
            $affected1= Supplier::where('s_no',$id)
            ->update(['is_active'=>'1']);
           
            return redirect('supplierRepo');
            }
            public function is_not_active($id){
                $affected1= Supplier::where('s_no',$id)
                ->update(['is_active'=>'0']);
                $affected = Supplier::where('is_deleted',0)->paginate(7);
                return redirect('supplierRepo');
                }
                public function filter($id){
                    if($id==1){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::where([['is_deleted',0],['is_active',1]])->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }elseif($id==0){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::where([['is_deleted',0],['is_active',0]])->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==3){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->where('currency.cur_id','=',2)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==4){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->where('currency.cur_id','=',1)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==5){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->where('currency.cur_id','=',3)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==6){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->where('services.ser_id','=',1)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==7){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->where('services.ser_id','=',2)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==8){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->where('services.ser_id','=',5)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==9){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->where('services.ser_id','=',3)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==10){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->where('services.ser_id','=',4)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==11){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->where('services.ser_id','=',6)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                    elseif($id==12){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::join('sup_services','sup_services.sup_id', '=','suppliers.s_no')
                        ->join('services','services.ser_id','=','sup_services.service_id')
                        ->join('sup_currency','sup_currency.sup_id', '=','suppliers.s_no')
                        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
                        ->where('services.ser_id','=',7)->paginate(7);
                        return view('supplierRepo',['data'=>$affected,'data1'=>$affected1]);
                    }
                }


               

               

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
