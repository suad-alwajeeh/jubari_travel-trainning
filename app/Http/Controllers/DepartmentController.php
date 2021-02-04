<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
class DepartmentController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $del=0;
        $affected1=[];
            $data=Department::where('deleted',0)->orderBy('id', 'DESC')->paginate(30);
            return view('department',['dept'=>$data,'data1'=>$affected1]);
        
    }

    public function display_with_status($id)
    {  
        if($id==1){
            $affected1 =[];
            $affected = Department::where([['deleted',0],['is_active',1]])->paginate(25);
            return view('department',['dept'=>$affected,'data1'=>$affected1]);
        }elseif($id==0){
            $affected1 =[];
            $affected = Department::where([['deleted',0],['is_active',0]])->paginate(25);
            return view('department',['dept'=>$affected,'data1'=>$affected1]);
        }
                 
    }
    public function insert(){

        return view('add-department');

    }
    
    public function saved(Request $request)
    {
        $dept=new Department;
         $active='';
      if(isset($request->is_active))
      $active=1;
      else
      $active=0;
        $request->validate([
            "name"=>"required",
            ]); 
           
      $dept->name=$request->name;
      $dept->is_active=$active;
     
      echo $dept->save();
      return redirect('department')->with('seccess','Seccess Data Insert');
    
    }

    public function display_row($id)
    { 
        $affected1 =[];
        $data['dept'] = Department::where('id',$id)->get();
        return view('update-department',$data);
                    }
                    public function is_active($id){
                        $affected1= Department::where('id',$id)
                        ->update(['is_active'=>'1']);
                        $affected = Department::where('deleted',0)->paginate(25);
                        return redirect('department');
                        }
                        public function is_not_active($id){
                            $affected1= Department::where('id',$id)
                            ->update(['is_active'=>'0']);
                            $affected = Department::where('deleted',0)->paginate(25);
                            return redirect('department');
                            }
public function edit_row(Request $req){
                        $dept=new Department;
                        $active='';
                        if(isset($req->is_active))
                        $active=1;
                        else
                        $active=0;

                        $dept::where('id',$req->id)
                        ->update(['name'=>$req->name,
                        'is_active'=>$active,
                        ]); 
                        $data['dept'] = Department::where('deleted',0)->paginate(7);
                        return redirect('department')->with('seccess','Seccess Data update');
                        
                    }
    public function hide_row($id){
        $affected1= Department::where('id',$id)
        ->update(['deleted'=>'1']);
        $data['dept'] = Department::where('deleted',0)->paginate(7);
        return redirect('department')->with('seccess','Seccess Data Delete');

        }
    
    
}
