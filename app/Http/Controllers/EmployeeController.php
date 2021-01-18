<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\User;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    }
/*********************start display all  new Employees Info ****************************************/
   
    public function index()
    {
        $where =['employees.deleted'=>0];
      $where +=['departments.deleted'=>0];
      $where +=['departments.is_active'=>1];
      $data['emps']=Employee::join('departments', 'departments.id', '=', 'employees.dept_id')
      ->where($where)->orderBy('emp_id','DESC')->get();
            return view('employees',$data);
       }
    public function Activate(){
        if(isset($_GET['id']) && $_GET['id']==0)
        { 
       
         $where=['employees.is_active'=>$_GET['id']];
         $where +=['employees.deleted'=>0];
         $where +=['departments.deleted'=>0];
         $where +=['departments.is_active'=>1];
         $data['emps']=Employee::join('departments', 'departments.id', '=', 'employees.dept_id')
         ->where($where)->orderBy('emp_id','DESC')->get();
         return json_encode($data);
     }
     
     elseif(isset($_GET['id']) &&  $_GET['id']==1 )
     { 
     
        $where=['employees.is_active'=>$_GET['id']];
        $where +=['employees.deleted'=>0];
        $where +=['departments.deleted'=>0];
        $where +=['departments.is_active'=>1];
        $data['emps']=Employee::join('departments', 'departments.id', '=', 'employees.dept_id')
        ->where($where)->orderBy('emp_id','DESC')->get();
        return json_encode($data);
  }
  
     else 
     { 
     
      //$where=['departments.is_active'=>1];
      $where =['employees.deleted'=>0];
      $where +=['departments.deleted'=>0];
      $where +=['departments.is_active'=>1];
      $data['emps']=Employee::join('departments', 'departments.id', '=', 'employees.dept_id')
      ->where($where,1)->paginate(6);
      return json_encode($data);}
    }
    public function insert(){
        $where=['is_active'=>1];
        $where +=['deleted'=>0];
        $data['emps']=Department::where($where)->get();
        return view('add-employee',$data);

    }
/*********************end display all  new Employees Info ****************************************/

/*********************start  check email  new Employees Info ****************************************/
public function checkEmail(Request $request){
    $emp=Employee::where('emp_email',$request->email)->count();

    if($emp>0)
    return $emp;
    else
    return $emp;

}
/*********************end checvk email Employees Info ****************************************/

/*********************start inser new Employees Info ****************************************/
   
    public function saved(Request $request)
    {
$emp=new Employee;
  
     $emp_photo='';
     $attchment='';
     $active='';
     if(isset($request->is_active))
     $active=1;
     else
     $active=0;
     if($request->hasfile('emp_photo'))
     {
        $imgFile =$request->file('emp_photo') ;
        $imgName =time().basename($_FILES["emp_photo"]["name"]);
        $emp_photo=$imgFile->move('img/users/',$imgName);
        $emp->emp_photo=$imgName;
     }
     if($request->hasfile('attchment'))
     {
        $attchmentFile =$request->file('attchment') ;
        $attchmentName =time().basename($_FILES["attchment"]["name"]);
        $attchment=$attchmentFile->move('img/attchment/',$attchmentName);
        $emp->attchment=$attchmentName;
     }
   

      $emp->emp_first_name=$request->emp_first_name;
      $emp->emp_middel_name=$request->emp_medil_name;
      $emp->emp_thired_name=$request->emp_thired_name;
      $emp->emp_last_name=$request->emp_last_name;
      $emp->emp_ssn=$request->emp_ssn;
      $emp->emp_email=$request->email;
      $emp->account_number=$request->account_number;
      $emp->emp_mobile=$request->emp_mobile;
      
      $emp->emp_salary=$request->emp_salary;
      $emp->emp_hirdate=$request->emp_hirdate;
      $emp->dept_id=$request->dept_id;
      $emp->is_active=$active;
    
      echo $emp->save();
     return redirect('employees')->with('seccess','Seccess Data Insert');

    }
   
/*********************end inser new Employees Info ****************************************/

/*********************Start Display roe for update Employees Info ****************************************/

    public function display_row($id)
    { 
        $data['emps'] = Employee::where('emp_id',$id)->get();
        $data['dept'] = Department::where('is_active',1)->where('deleted',0)->get();
        return view('update-employee',$data);
    }
/*********************end Display row for  Employees Info ****************************************/

/*********************Start show more Employees Info ****************************************/

                    public function show_row($id)
                    { 
                        $data['emps'] = Employee::where('emp_id',$id)->get();
                        $data['dept'] = Department::all();
                        return view('show_employee',$data);
                                    }
/*********************end show more Employees Info ****************************************/

/*********************Update Employees Info ****************************************/
public function edit_row(Request $req){
    $emp=new Employee;
  
    $emp_photo='';
    $attchment='';
    $active='';
    if(isset($req->is_active))
    $active=1;
    else
    $active=0;
    $emp_photo='';
    if(isset($_FILES["emp_photo"]["name"]))
    {
        if($req->hasfile('emp_photo'))
    {
       $imgFile =$req->file('emp_photo') ;
       $imgName =time().basename($_FILES["emp_photo"]["name"]);
       $emp_photo=$imgFile->move('img/users/',$imgName);
       $emp_photo=$imgName;
    }
    else
    $emp_photo=$req->emp_photo1;
}
   if(isset($_FILES["attchment"]["name"]))
{
    if($req->hasfile('attchment'))
    {
       $attchmentFile =$req->file('attchment') ;
       $attchmentName =time().basename($_FILES["attchment"]["name"]);
       $attchment=$attchmentFile->move('img/attchment/',$attchmentName);
       $attchment=$attchmentName;
    }
    else
    $attchment=$req->attchment1;
}
                         $emp::where('emp_id',$req->id)
                        ->update(['emp_first_name'=>$req->emp_first_name,'emp_middel_name'=>$req->emp_medil_name,
                        'is_active'=>$active,'emp_thired_name'=>$req->emp_thired_name,'emp_last_name'=>$req->emp_last_name,
                        'emp_ssn'=>$req->emp_ssn,'account_number'=>$req->account_number,'emp_mobile'=>$req->emp_mobile,
                        'emp_salary'=>$req->emp_salary,'emp_email'=>$req->email,'emp_hirdate'=>$req->emp_hirdate,'dept_id'=>$req->dept_id,
                        'emp_photo'=> $emp_photo,'attchment'=>$attchment,
                        ]);
                        $user=new User;
                        $user::where('id',$req->id)
                        ->update(['email'=>$req->email, ]);

                        $data['emps'] = Employee::where('deleted',0)->paginate(7);
                       return redirect('employees')->with('seccess','Seccess Data Updated');

                        
                    }

/*********************End Update Employees Info ****************************************/
/*********************Start Delete Employees Info ****************************************/

    public function hide_row($id){
        $affected1= Employee::where('emp_id',$id)
        ->update(['deleted'=>'1']);
        $data['dept'] = Employee::where('deleted',0)->paginate(7);
        return redirect('employees')->with('seccess','Seccess Data Delete');

        }
/*********************End Delete Employees Info ****************************************/

    
}