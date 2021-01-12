<?php

namespace App\Http\Controllers;
use App\adds;
use App\adds_user;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AddsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
    }
    public function display_row($id)
             { 
        $affected = adds::where('id',$id)->get();
        return view('adds_edit',['data'=>$affected]);
                    }
                    public function display_scroll()
                    { 
                        $adds = adds::where([['is_active',1],['is_delete',0]])->get();
                        return view('includes.header',['data'=>$adds]);
                    }
    public function adds_user($id)
                    { 
                        $affected = adds::where('id',$id)->get();
                        $affected1 = DB::table('adds')->where('adds_id',$id)
                        ->join('adds_users','adds.id','adds_users.adds_id')->where('adds_users.is_delete',0)
                        ->join('users','adds_users.user_id','users.id')
                        ->select('users.name as u_name','adds_users.id as au_id','adds.id as a_id')->get();
                        $affected2 = DB::table('users')->where([['is_delete','0'],['is_active',1]])->get();
                            return view('adds_user',['data'=>$affected,'data1'=>$affected1,'data2'=>$affected2]);
}
public function adds_user_display()
{ 
    $affected = DB::table('adds')->where([['adds.is_active',1],['adds.is_delete',0]])
    ->join('adds_users','adds.id','adds_users.adds_id')->where('adds_users.is_delete',0)
    ->join('users','adds_users.user_id','users.id')->where([['users.is_delete',0],['users.is_active',1]])
    ->select('users.name as u_name','adds_users.id as au_id','adds.adds_text as a_text','adds.adds_name as a_name','adds_users.status as au_status')
    ->paginate(15);
        return view('adds_user_display',['data'=>$affected]);
}
public function adds_user_display_row($id)
{ 
    $affected = DB::table('adds')->where([['adds.is_active',1],['adds.is_delete',0]])
    ->join('adds_users','adds.id','adds_users.adds_id')->where([['adds_users.is_delete',0],['adds_users.id',$id]])
    ->join('users','adds_users.user_id','users.id')->where([['users.is_delete',0],['users.is_active',1]])
    ->select('users.name as u_name','adds_users.id as au_id','adds.adds_text as a_text','adds.adds_name as a_name','adds_users.status as au_status')
    ->get();
    echo json_encode($affected);

       // return view('adds_user_display',['data'=>$affected]);
}
public function adds_user_display_u($id)
{ 
    $affected = DB::table('adds')->where([['adds.is_active',1],['adds.is_delete',0]])
    ->join('adds_users','adds.id','adds_users.adds_id')->where([['adds_users.is_delete',0],['adds_users.status','!=',2]])
    ->join('users','adds_users.user_id','users.id')->where([['users.is_delete',0],['users.is_active',1],['users.id',$id]])
    ->select('users.name as u_name','adds_users.id as au_id','adds.adds_text as a_text','adds.adds_name as a_name','adds_users.status as au_status')
    ->get();
    echo json_encode($affected);
}
public function ok($id){
    $affected1= adds_user::where('id',$id)
    ->update(['status'=>'2']);
    }
    public function cansel($id){
        $affected1= adds_user::where('id',$id)
        ->update(['status'=>'3']);
        }
    public function display()
   {
 $affected1 =[];
   $affected = adds::where('is_delete',0)->orderBy('id', 'DESC')->paginate(30);
        return view('adds_display',['data'=>$affected,'data1'=>$affected1]);
        }
        public function display_with_status($id)
        {  
            if($id=1) {
                $ststus=["data"=> 'add advertisement successfully..' ];
                 }
                 if($id=2) {
                     $ststus=["data"=> 'edit advertisement successfully..' ];
                     }
                     
                    $affected = adds::where('is_delete',0)->orderBy('id', 'DESC')->paginate(30);
                    return view('adds_display',['data'=>$affected,'data1'=>$ststus]);
            }
    public function add()
    {
        return view('adds_add');
    }
    public function save1(Request $req)
    {  $active="";
        if(isset($req->is_active)){
           $active=1;
        }else{
           $active=0;
        }
     $role=new adds;
      $role->adds_name=$req->adds_name;
      $role->adds_text=$req->adds_text;
      $role->how_create_it=$req->how_create_it;
      $role->adds_type=$req->adds_type;
      $role->is_active=$req->is_active;
       $role->save();
      $affected = adds::where('is_delete',0)->paginate(7);
      return redirect('adds_display');
}
    public function edit_row(Request $req){
        $role=new adds;
        $role::where('id',$req->id)
        ->update(['adds_name'=>$req->adds_name,'adds_type'=>$req->adds_type,
        'is_active'=>$req->is_active,'adds_text'=>$req->adds_text,
        ]);
        
    }
    public function hide_row($id){
        $affected1= adds::where('id',$id)
        ->update(['is_delete'=>'1']);
        $affected = adds::where('is_delete',0)->paginate(7);
        return redirect('adds_display');

        }
        public function hide_user_row($id){
            $affected1= adds_user::where('id',$id)
            ->update(['is_delete'=>'1']);
               
            }
            public function add_user_row($id,$user){
                $role=new adds_user;
            
                $role->user_id=$user;
                $role->adds_id=$id;
                 $role->save();
                   
                }
                public function delete_user_row1($id,$user){
                    $affected1= adds_user::where([['adds_id',$id],['user_id',$user]])->update(['is_delete'=>'1']);;                       
                    }
        public function is_active($id){
            $affected1= adds::where('id',$id)
            ->update(['is_active'=>'1']);
            $affected = role::where('is_delete',0)->paginate(7);
            return redirect('adds_display');
            }
            public function is_not_active($id){
                $affected1= adds::where('id',$id)
                ->update(['is_active'=>'0']);
                $affected = adds::where('is_delete',0)->paginate(7);
                return redirect('adds_display');
                }
                public function filter($id){
                    if($id==1){
                        $affected1 =[];
                        $affected = adds::where([['is_delete',0],['is_active',1]])->paginate(7);
                        return view('adds_display',['data'=>$affected,'data1'=>$affected1]);
                    }elseif($id==0){
                        $affected1 =[];
                        $affected = adds::where([['is_delete',0],['is_active',0]])->paginate(7);
                        return view('adds_display',['data'=>$affected,'data1'=>$affected1]);
                    }
                }
}