<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class customerController extends Controller
{
public function display(){

    $affected = Customer::where('is_delete',0)
    ->join('currency','customers.def_currency','currency.cur_id')
    ->orderBy('customers.cus_id','DESC')->paginate(10);
    return view('customer_display',['data'=>$affected]);

}

public function display_row($id)
{ 
    $affected = Customer::where('customers.cus_id',$id)
    ->join('currency','customers.def_currency','currency.cur_id')
    ->join('users','customers.how_create_it','users.id')
    ->get();
    echo json_encode($affected);

}
public function display_row_edit($id)
{ 
    $affected = Customer::where('customers.cus_id',$id)->get();
    $affected1 = DB::table('currency')->get();
    return view('customer_edit',['data'=>$affected,'data1'=>$affected1]);

}
public function add()
{
    $affected1 = DB::table('currency')->get();
    return view('customer_add',['data1'=>$affected1]);
}
public function save1(Request $req)
    {
      $Customer=new Customer;
      $Customer->cus_name=$req->cus_name;
      $Customer->cus_account=$req->cus_account;
      $Customer->contact_person=$req->contact_person;
      $Customer->contact_title=$req->contact_title;
      $Customer->telephon1=$req->telephon1;
      $Customer->telephon2=$req->telephon2;
      $Customer->fax1=$req->fax1;
      $Customer->fax2=$req->fax2;
      $Customer->cus_email=$req->cus_email;
      $Customer->whatsapp=$req->whatsapp;
      $Customer->vip=$req->vip;
      $Customer->is_active=$req->is_active;
      $Customer->def_currency=$req->def_currency;
      $Customer->country=$req->country;
      $Customer->how_create_it=$req->how_create_it;
      $Customer->address=$req->address;
      $Customer->city=$req->city;
       $Customer->save();
      return redirect('customer_display');
    }
public function edit_row(Request $req){
    $req->validate([
        ]);
    $Customer=new Customer;
    $Customer::where('cus_id',$req->id)
    ->update(['contact_person'=>$req->contact_person,'cus_account'=>$req->cus_account,
    'cus_name'=>$req->cus_name,'contact_title'=>$req->contact_title,
    'telephon1'=>$req->telephon1,'telephon2'=>$req->telephon2,'fax1'=>$req->fax1,
    'fax2'=>$req->fax2,'cus_email'=>$req->cus_email,'whatsapp'=>$req->whatsapp,
    'is_active'=>$req->vip,'is_active'=>$req->vip,'country'=>$req->country,
    'city'=>$req->city,'address'=>$req->address,'def_currency'=>$req->def_currency,
    ]);
    return redirect('customer_display');
    
}
public function hide_row($id){
    $affected1= Customer::where('cus_id',$id)
    ->update(['is_delete'=>'1']);
    return redirect('customer_display')->with('success','delete successfully');
}
public function vip($id){
    $affected1= Customer::where('cus_id',$id)
    ->update(['vip'=>'1']);
    return redirect('customer_display')->with('success','update successfully');

}
public function no_vip($id){
    $affected1= Customer::where('cus_id',$id)
    ->update(['vip'=>'0']);
    return redirect('customer_display')->with('success','update successfully');

}
public function is_active($id){
    $affected1= Customer::where('cus_id',$id)
    ->update(['is_active'=>'1']);
    return redirect('customer_display')->with('success','update successfully');

}
public function no_active($id){
    $affected1= Customer::where('cus_id',$id)
    ->update(['is_active'=>'0']);
    return redirect('customer_display')->with('success','update successfully');

}
}
