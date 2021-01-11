<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use App\Supplier;
use App\Service;
use App\Currency;
use App\Sup_Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       // $this->middleware(['role:admin ']); 
    }
    public function index()
    {
        //$filter = Supplier::where('is_active',1)->paginate(7);
    }
    

    public function add(){
        $services=Service::where('is_active',1)->get();
        //$currency='';
        $currencies=Currency::where('is_active',1)->get();
        return view('addSupplier',['data1'=>$services,'data2'=>$currencies]);
     //  return view('addSupplier');
    }

    public function display(){
       // $affected = Supplier::where('is_active',1)->paginate(7);
        $affected = Supplier::where('is_deleted',0)->paginate(7);
       // $affected1 = Currency::where('is_active',1)->paginate(7);
        return view('displaySupplier',['data'=>$affected/*, 'data2'=>$affected1*/]);
    }


    public function display_row($id)
    { 
        $affected = Supplier::where('s_no',$id)->get();
        return view('editSupplier',['data'=>$affected]);
    }

    public function hide_row($id){
        $affected1= Supplier::where('s_no',$id)->update(['is_deleted'=>'1']);

        $affected = Supplier::where('is_deleted',1)->paginate(7);
        
        return redirect('displaySupplier')->with('success',$affected);

        }

        public function save1(Request $req)
        {

          $supplier=new Supplier;
          $cur=new Sup_Currency;

            /* $req->validate([
                'supplier_name'=>'required|max:100',
                'supplier_mobile'=>'required|numeric',
                'supplier_phone'=>'required|numeric',
                'supplier_email'=>'required',
               'supplier_photo'=>'required',
                'supplier_address'=>'required',
                'supplier_acc_no'=>'required|numeric',
                'create_date'=>'required',
                'supplier_service[]'=>'required',
                'supplier_currency'=>'required',
                'is_active'=>'required',
             ] );
            

             $validate=validator::make($req->all(),[
                'supplier_name'=>'required|max:100|unique:suppliers:supplier_name',
                'supplier_mobile'=>'required|max:11|numeric',
                'supplier_phone'=>'required|max:11|numeric',
                'supplier_email'=>'required',
               'supplier_photo'=>'mimes:jpg,jpeg,png',
                'supplier_address'=>'required',
                'supplier_acc_no'=>'required|numeric',
                'create_date'=>'required',
                'is_active'=>'required',
             ] );*/

/* /*  if($req->hasFile('supplier_photo')){
                 $photo=$req->file('supplier_photo');
                 $photo_name=time().basename($_FILES["supplier_photo"]["name"]);
                $suplier_photo=$photo->move('img/suplier/',$photo_name);
                $suplier_photo=$photo_name;

             }*/
            if($req->hasFile('supplier_photo')){
                 $photo=$req->file('supplier_photo');
                 $photo_name=time().basename($_FILES["supplier_photo"]["name"]);
                 $supplier_photo=$photo->move('img/suppliers/',$photo_name);
                 $supplier->supplier_photo= $photo_name;

             }
             $supplier->s_no=$req->s_no;
          $supplier->supplier_name=$req->supplier_name;
          $supplier->supplier_mobile=$req->supplier_mobile;
          $supplier->supplier_phone=$req->supplier_phone;
          $supplier->supplier_email=$req->supplier_email;
          $supplier->supplier_address=$req->supplier_address;
          $supplier->supplier_acc_no=$req->supplier_acc_no;
          $supplier->create_date=$req->create_date;
          $supplier->supplier_service=$req->supplier_service;
          $supplier->supplier_currency=$req->supplier_currency;
          $supplier->supplier_remark=$req->supplier_remark;
          $supplier->is_active=$req->is_active;
          echo $supplier->save();
          /*$cur->sup_id=$req->s_no;
          $cur->cur_id=$req->supplier_currency;
          echo $cur->save();*/
          $affected = Supplier::where('is_deleted',0)->paginate(7);
         // $services['services']=Service::where('is_active',1)->get();
          return redirect('displaySupplier')->with('Success','New Supplier has been added successfully');
         


          
        }

        public function edit_row(Request $req){
           /*/ $supplier::where('s_no',$req->id)->update(['supplier_name'=>$req->supplier_name,'supplier_mobile'=>$req->supplier_mobile,
            'supplier_phone'=>$req->supplier_phone,'supplier_email'=>$req->supplier_email,'supplier_photo'=>$req->supplier_photo,
            'supplier_address'=>$req->supplier_address, 'supplier_acc_no'=>$req->supplier_acc_no, 'create_date'=>$req->create_date,
            'supplier_remark'=>$req->supplier_remark,
            'is_active'=>$req->is_active,
            ]);*/
            
        $affected1= Supplier::where('s_no',$req->s_no)->update(['supplier_name'=>$req->supplier_name,'supplier_mobile'=>$req->supplier_mobile,
        'supplier_phone'=>$req->supplier_phone,'supplier_email'=>$req->supplier_email,'supplier_photo'=>$req->supplier_photo,
        'supplier_address'=>$req->supplier_address, 'supplier_acc_no'=>$req->supplier_acc_no, 'create_date'=>$req->create_date,
        'supplier_remark'=>$req->supplier_remark,
        'is_active'=>$req->is_active,
        ]);

            $affected = Supplier::where('is_deleted',0)->paginate(7);
            
            //return "in edit function ";
            return redirect('displaySupplier')->with('Success','Supplier has been updateded successfully');
            
        }




        public function is_active($id){
            $affected1= Supplier::where('s_no',$id)
            ->update(['is_active'=>'1']);
           
            return redirect('displaySupplier');
            }
            public function is_not_active($id){
                $affected1= Supplier::where('s_no',$id)
                ->update(['is_active'=>'0']);
                $affected = Supplier::where('is_deleted',0)->paginate(7);
                return redirect('displaySupplier');
                }
                public function filter($id){
                    if($id==1){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::where([['is_deleted',0],['is_active',1]])->paginate(7);
                        return view('displaySupplier',['data'=>$affected,'data1'=>$affected1]);
                    }elseif($id==0){
                        $affected1 = Supplier::where('is_active',1)->get();
                        $affected = Supplier::where([['is_deleted',0],['is_active',0]])->paginate(7);
                        return view('displaySupplier',['data'=>$affected,'data1'=>$affected1]);
                    }
                }



                //public function serviceFun()




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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function show_row()
    { 
        $data['suplier']= Suplier::join('sup_currency','sup_currency.sup_id', '=','supliers.sup_id')
        ->join('currency','currency.cur_id','=','sup_currency.cur_id')
        ->where('supliers.sup_id',$_GET['id'])->get();
        return json_encode($data);
                    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
