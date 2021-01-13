<?php

namespace App\Http\Controllers;
use App\users;
use App\Department;
use App\Employee;
use App\role_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendingEmail;

//use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class uuserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    }
  /*  public function login()
    {
        return view('login');
    }
    public function login_data(Request $req)
    {
        $user_email=$req->email;
        $user_password=$req->password;
      $u= users::where([['email',$user_email],['is_active',1],['is_delete',0]])->get();
      $check=Hash::check($user_password, $u[0]->password);
        if($check==true){
            $emp_img = DB::table('employee')->where('emp_id',$u[0]->emp_id)->get();
            $req->session()->put('id',$u[0]->id);
            $req->session()->put('name',$u[0]->name);
            $req->session()->put('img',$emp_img[0]->emp_photo);
            return redirect('/');
        }else{    
              return redirect('sign_in');
        }
        }
*/

    public function display_row($id)
    { 
        $affected = users::where('id',$id)->get();
        $affected2= DB::table('roles')->where([['is_active',1],['is_delete',0]])->get();
        return view('user_edit',['data'=>$affected,'data3'=>$affected2]);
    }
    public function user_profile1_page($id){
        $affected = users::where('users.id',$id)
        ->join('employees','users.id','employees.emp_id')
        ->join('departments','employees.dept_id','departments.id')
        ->select('employees.emp_first_name as ef_name',
                          'employees.emp_middel_name as em_name',
                          'employees.emp_thired_name as et_name',
                          'employees.emp_last_name as l_name',
                          'employees.emp_hirdate as hirdate',
                          'employees.emp_ssn as ssn',
                          'employees.account_number as account',
                          'employees.emp_salary as salary',
                          'employees.emp_email as email',
                          'employees.emp_mobile as mobile',                          
                          'departments.name as dept',                          
                          'users.name as name',                          
                          'users.pass as pass',                          
                          'employees.emp_photo as photo')->get();
            return view('profile',['data'=>$affected]);
        
    }
     public function user_profile($id)
            { 
                $affected = users::where('id',$id)
                ->join('employees','users.id','employees.emp_id')
                ->select('employees.emp_first_name as ef_name',
                          'employees.emp_middel_name as em_name',
                          'employees.emp_thired_name as et_name',
                          'employees.emp_photo as e_photo')->get();
                          echo json_encode($affected);
           }
           public function employee_dept($id)
           {  

            $affected = DB::select('select * from employees where dept_id=? and emp_id not in(select id from users where is_delete=0 )',[$id]);
            echo json_encode($affected);
          }
          public function employee_data($id)
           {  $affected = DB::table('employees')->where('emp_id',$id)->get();            
            echo json_encode($affected);
          }
    public function display()
    {
        $affected = users::where('users.is_delete',0)
        ->join('employees','users.id','employees.emp_id')
        ->join('departments','employees.dept_id','departments.id')
        ->select('users.id as u_id', 'users.is_active as u_is_active',
        'users.is_delete as u_is_delete','users.name as u_name',
        'users.email as u_email','users.pass as pass', 'departments.name as d_name')->paginate(25);
        $affected1 = users::where('is_delete',0)->join('role_user','users.id','role_user.user_id')
        ->select('users.id as u_id');
        return view('user_display',['data'=>$affected,'data1'=>$affected1]);
        }
        public function display_with_status1($id){
            if($id=1) {
                $ststus=["data"=> ' add user data successfully..' ];
            }elseif($id=2) {
                    $ststus=["data"=> ' update user data successfully..' ];
                     }
        $affected = users::where('users.is_delete',0)
        ->join('employees','users.id','employees.emp_id')
        ->join('departments','employees.dept_id','departments.id')
        ->select('users.id as u_id', 'users.is_active as u_is_active',
        'users.is_delete as u_is_delete','users.name as u_name',
        'users.email as u_email','users.pass as pass', 'departments.name as d_name')->paginate(25);
        $affected1 = users::where('is_delete',0)->join('role_user','users.id','role_user.user_id')
        ->select('users.id as u_id');
        return view('user_display',['data'=>$affected,'data1'=>$ststus]);
        }
    public function add()
    {
        $affected1 = Department::where([['is_active',1],['deleted',0]])->get();
        $affected2= DB::table('roles')->where([['is_active',1],['is_delete',0]])->get();
        return view('user_add',['data1'=>$affected1,'data3'=>$affected2]);
    }
    public function save17(Request $req)
    {  
            $part='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass=array();
            $partLength=strlen($part)-1;
            for($i =0; $i < 8 ; $i++){
              $s=rand(0,$partLength);
              $pass[]=$part[$s];
            }
            $PASSWORD= implode($pass);
          
          
      $user=new users;
      $user->id=$req->u_id;
      $user->name=$req->name;
      $user->email=$req->email;
      $user->how_add_it=$req->how_add_it;
      $user->is_active=$req->is_active;
      $user->password=Hash::make($PASSWORD);
      $user->pass=$PASSWORD;
       $user->save();
       $role=$req->role;
       foreach($role as $r){
           $role= new role_user;
           $role->role_id=$r;
           $role->user_id=$req->u_id;
           $role->how_create_it=$req->how_create_it;
           $role->user_type='App\User';
            $role->save();
       }
       $name=$req->name;
       $email=$req->email;
       $password=$PASSWORD;
       $data = array(
        'EMAIL'=>$email,
        'PASSWORD' =>$password,
        'NAME' =>$name,
    );

 Mail::to($email)->send(new sendingEmail($data));
}
    public function edit_row(Request $req){
        $role=new users;
        $e=$req->email;
        $p=$req->password1;
         $n=$req->name;
        $role::where('id',$req->id)
        ->update(['name'=>$req->name,'email'=>$req->email,'password'=>Hash::make($req->password1),'is_active'=>$req->is_active,'pass'=>$req->password1 ]);
        $data = array(
            'EMAIL'=>$e,
            'PASSWORD' =>$p,
            'NAME' =>$n,
        );
    
     Mail::to($e)->send(new sendingEmail($data));
    }
    public function checkmail($email){
        $wordlist = users::where('email',$email)->get();
        $wordCount = $wordlist->count();
        echo json_encode($wordCount);
        }
    public function hide_row($id){
        $affected1= users::where('id',$id)
        ->delete();
        return redirect('user_display');

        }
        public function is_active($id){
            $affected1= users::where('id',$id)
            ->update(['is_active'=>'1']);
            $affected = users::where('is_delete',0)->paginate(25);
            return redirect('user_display');
            }
            public function is_not_active($id){
                $affected1= users::where('id',$id)
                ->update(['is_active'=>'0']);
                $affected = users::where('is_delete',0)->paginate(25);
                return redirect('user_display');
                }
                public function filter($id){
                    if($id==1){
                        $affected = users::where([['users.is_delete',0],['users.is_active',1]])
                        ->join('employees','users.id','employees.emp_id')
                        ->join('departments','employees.dept_id','departments.id')
                        ->select('users.id as u_id', 'users.is_active as u_is_active','users.is_delete as u_is_delete','users.name as u_name','users.email as u_email', 'departments.name as d_name')->paginate(25);
                        $affected1 = users::where('is_delete',0)->join('role_user','users.id','role_user.user_id')->select('users.id as u_id');
                        return view('user_display',['data'=>$affected,'data1'=>$affected1]);
                    }elseif($id==0){
                           $affected = users::where([['users.is_delete',0],['users.is_active',0]])
                            ->join('employees','users.id','employees.emp_id')
                            ->join('departments','employees.dept_id','departments.id')
                            ->select('users.id as u_id', 'users.is_active as u_is_active','users.is_delete as u_is_delete','users.name as u_name','users.email as u_email', 'departments.name as d_name')->paginate(25);
                            $affected1 = users::where('is_delete',0)->join('role_user','users.id','role_user.user_id')->select('users.id as u_id');
                              return view('user_display',['data'=>$affected,'data1'=>$affected1]);
                              }
                }
}