<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\users;
use App\role_user;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    }
    public function index()
    {
echo 'ppppp';    }
    public function display_row($id)
    { 
        $affected = Role::where('id',$id)->get();
        return view('role_edit',['data'=>$affected]);
                    }
    public function display()
    {     $affected1 =[];
        $affected = Role::where('is_delete',0)->paginate(25);
        return view('role_display',['data'=>$affected,'data1'=>$affected1]);
        }
        public function display_with_status($id){
            if($id=1) {
                $ststus=["data"=> 'add role successfully..' ];
                 }
                 if($id=2) {
                     $ststus=["data"=> 'edit role successfully..' ];
                     }
            $affected = Role::where('is_delete',0)->paginate(25);
            return view('role_display',['data'=>$affected,'data1'=>$ststus]);
            }
        public function display_role_user()
        { $affected1 =[];
            $affected = DB::select('select  ru.user_id as u_id ,GROUP_CONCAT(r.name SEPARATOR "||") as roless,u.name as u_name
            FROM role_user as ru
            INNER JOIN roles as r on ru.role_id=r.id
            INNER JOIN users as u on ru.user_id=u.id
            GROUP BY ru.user_id');
        return view('role_user_display',['data'=>$affected,'data1'=>$affected1]);
        }
         public function display_with_status1($id){
            if($id=1) {
                $ststus=["data"=> ' user roles saved successfully..' ];
                 }
                
            $affected = DB::select('select  ru.user_id as u_id ,GROUP_CONCAT(r.name SEPARATOR "||") as roless,u.name as u_name
            FROM role_user as ru
            INNER JOIN roles as r on ru.role_id=r.id
            INNER JOIN users as u on ru.user_id=u.id
            GROUP BY ru.user_id');
        return view('role_user_display',['data'=>$affected,'data1'=>$ststus]);
        }
       
        public function display_role_user1($id)
        {
        $affected = users::where('users.id',$id)
        ->join('role_user','users.id','role_user.user_id')->where([['role_user.is_delete',0]])
        ->join('roles','role_user.role_id','roles.id')
        ->select('users.id as u_id','users.name as u_name','roles.id as r_id','roles.name as r_name')
        ->orderBy('users.id','desc')
        ->get();
        echo json_encode($affected);
                }
        public function role_user_hide_row($u_id){
            $affected1= DB::table('role_user')->where([['user_id',$u_id]])
            ->delete();
            }
            public function add_role_user(){
                $affected1= DB::table('users')->where([['is_active',1],['is_delete',0]])->get();
                $affected2= DB::table('roles')->where([['is_active',1],['is_delete',0]])->get();
                return view('add_role_user',['data'=>$affected2,'data1'=>$affected1]);

            }
            public function save_user_roleyy($r1,$u,$h)
             {
                        $wordlist = role_user::where([['user_id',$u],['role_id',$r1]])->get();
                         $wordCount = $wordlist->count();
                         if($wordCount == 1){
                            $wordlist = role_user::where([['user_id',$u],['role_id',$r1]])->delete();
                                $role= new role_user;
                                $role->role_id=$r1;
                                $role->user_id=$u;
                                $role->how_create_it=$h;
                                $role->user_type='App\User';
                                 $role->save();
                                 echo "iiiiiiiiiiiiii";
                            }elseif($wordCount == 0){
                                $role= new role_user;
                                $role->role_id=$r1;
                                $role->user_id=$u;
                                $role->how_create_it=$h;
                                $role->user_type='App\User';
                                 $role->save();
                            }
                        }
                        
                        public function save_user_roleyy2($r1,$u,$h)
             {
                        $wordlist = role_user::where([['user_id',$u],['role_id',$r1]])->delete();
                        
                        }
            public function save_user_role(Request $req)
             {
                            $u_id=$req->user_name;
                            $role=$req->role;
                            foreach($role as $r){
                        $wordlist = role_user::where([['user_id',$u_id],['role_id',$r]])->get();
                         $wordCount = $wordlist->count();
                         if($wordCount == 1){
                            $wordlist = role_user::where([['user_id',$u_id],['role_id',$r]])->delete();
                               /* $role= new role_user;
                                $role->role_id=$r;
                                $role->user_id=$req->user_id;
                                $role->how_create_it=$req->how_create_it;
                                $role->user_type='App\User';
                                 $role->save();*/
                            }elseif($wordCount == 0){
                                $role= new role_user;
                                $role->role_id=$r;
                                $role->user_id=$req->user_id;
                                $role->how_create_it=$req->how_create_it;
                                $role->user_type='App\User';
                                 $role->save();
                            }
                        }
                        }
    public function add()
    {
        return view('role_add');
    }
    public function save1(Request $req)
    {
    
      $role=new Role;
      $role->name=$req->role_name;
      $role->display_name=$req->role_name;
      $role->description=$req->role_descripe;
      $role->how_add_it=$req->how_create_it;
      $role->is_active=$req->is_active;
       $role->save();
    }
    public function edit_row(Request $req){
      
        $role=new Role;
        $role::where('id',$req->id)
        ->update(['display_name'=>$req->role_name,'description'=>$req->role_descripe,
        'is_active'=>$req->is_active,
        ]);       
     }
    public function hide_row($id){
        $affected1= Role::where('id',$id)
        ->update(['is_delete'=>'1']);
        $affected = Role::where('is_delete',0)->paginate(25);
        return redirect('role_display');

        }
        public function is_active($id){
            $affected1= Role::where('id',$id)
            ->update(['is_active'=>'1']);
            $affected = Role::where('is_delete',0)->paginate(25);
            return redirect('role_display');
    
            }
            public function is_not_active($id){
                $affected1= Role::where('id',$id)
                ->update(['is_active'=>'0']);
                $affected = Role::where('is_delete',0)->paginate(25);
                return redirect('role_display');
        
                }
                public function filter($id){
                    if($id==1){
                        $affected1 =[];
                        $affected = Role::where([['is_delete',0],['is_active',1]])->paginate(25);
                        return view('role_display',['data'=>$affected,'data1'=>$affected1]);
                        }elseif($id==0){
                        $affected1 =[];
                        $affected = Role::where([['is_delete',0],['is_active',0]])->paginate(25);
                        return view('role_display',['data'=>$affected,'data1'=>$affected1]);
                                                }
                }

   
}