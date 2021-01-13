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
        if(isset($_GET['id']) && ($_GET['id']==0 || $_GET['id']==1) )
       { 
       
        $where=['is_active'=>$_GET['id']];
        $where +=['deleted'=>0];
        //$where +=['deleted'===0];

        $data['dept']=Department::where($where)->get();
        return json_encode($data);}
    
        else if(isset($_GET['id']) && $_GET['id']==2 )
       { 
        //$where +=['deleted'===$del];
        $data['dept']=Department::where('deleted',0)->get();
        return json_encode($data);}
    
        
        else{
          //  $where +=['deleted'=>0];
          
            $data['dept']=Department::where('deleted',0)->get();
            return view('department',$data);
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
        $data['dept'] = Department::where('id',$id)->get();
        return view('update-department',$data);
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
                        return redirect('department')->with($data);
                        
                    }
    public function hide_row($id){
        $affected1= Department::where('id',$id)
        ->update(['deleted'=>'1']);
        $data['dept'] = Department::where('deleted',0)->paginate(7);
        return redirect('department')->with('seccess','Seccess Data Delete');

        }
    
    
}
