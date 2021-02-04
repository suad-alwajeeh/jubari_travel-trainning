<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use App\Events\MessageEvent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get();

        // count how many message are unread from the selected user
        $users = DB::select("select users.id, users.name, employees.emp_photo, users.email, count(is_read) as unread 
        from employees, users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " and users.id=employees.emp_id
        group by users.id, users.name,employees.emp_photo, users.email");

        $group = DB::select("select users.id, users.name, employees.emp_photo, users.email, count(is_read) as unreadgroup 
        from employees, users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = 0
        where users.id != " . Auth::id() . " and users.id=employees.emp_id
        group by users.id, users.name,employees.emp_photo, users.email");

        return view('home', ['users' => $users,'group'=>$group]);
    }
    public function counter_notify($user_id){
        $wordlist=Message::select(DB::raw('count(*) as count'))->where([['is_read',0],['to',$user_id]])->orwhere([['is_read',0],['to',0]])->get();
       echo json_encode($wordlist);
     }
     public function message_update($m_id,$from,$to){
        $wordlist=Message::where([['id',$m_id],['to',$to],['from',$from]])->update(['is_read'=>1]);

     }
     public function user_notify($user_id){
       
        $use=DB::select('select users.id,users.name,messages.from,messages.to,messages.message,messages.created_at from users , messages where (messages.to="'.$user_id.'" or messages.to=0) and  messages.is_read=0  GROUP BY messages.id  ');
        $name='';
        foreach($use as $users)
        {
            $name=$users->name;
        }
       
       echo json_encode($use);
     }
     public function status_notify($s,$f,$t,$status){
      $wordlist=Message::where([['from',$f],['to',$t],['id',$s]])
      ->update(['is_read'=>1]);

     }
    public function group()
    {
       
        $users = DB::select("select users.id, users.name, employees.emp_photo, users.email, count(is_read) as unread 
        from employees, users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " and users.id=employees.emp_id
        group by users.id, users.name,employees.emp_photo, users.email");

        return view('includes.header', ['users' => $users]);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();
if($user_id)
       { // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();}
       else{
            Message::where(['from' => $my_id, 'to' => 0])->update(['is_read' => 1]);

            // Get all message from selected user
            $messages = Message::join('users','users.id','=','messages.from')->get();

        }

        return view('messages.index', ['messages' => $messages]);
    }


    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to='';
        $message='';

        if(isset($request->receiver_id))
       { 
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();
    }

        else{
            $to =0;
            $message = $request->message;
    
            $data = new Message();
            $data->from = $from;
            $data->to = $to;
            $data->message = $message;
            $data->is_read =0; // message will be unread when sending message
            $data->save(); 
        }

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to ,'message'=>$message]; 
        
        // sending from and to user id when pressed enter
        $use=DB::select('select * from users where id="'.$from.'"');
        $name='';
        foreach($use as $users)
        {
            $name=$users->name;
        }
        if($to==0)
    {  $data2='<a onclick=ee('.$from.','.$to.') class=dropdown-item user id='.$to.'><div class=media><div class=media-body> <h3 class=dropdown-item-title>'.$name.' Send Message  In Group <span class=float-right text-sm text-danger></span></h3><p class=text-sm>'.$message.'</p><p class=text-sm text-muted><i class=far fa-clock mr-1></i> </p></div></div></a>';
        
       }
      else{

         $data2='<a onclick=ee('.$from.','.$to.') class=dropdown-item user id='.$to.'><div class=media><div class=media-body> <h3 class=dropdown-item-title>'.$name.' Send Message  For You<span class=float-right text-sm text-danger></span></h3><p class=text-sm>'.$message.'</p><p class=text-sm text-muted><i class=far fa-clock mr-1></i> </p></div></div></a>';

      }
        $pusher->trigger('my-channel', 'my-event', $data);
        $pusher->trigger('my-channel2', 'my-event2', $data2);
        event(new MessageEvent($data2));

    }


    public function  chatRepo($my_id ,$user_id){
        //$messages=DB::select('SELECT * FROM `messages` WHERE   `to`='.$to.'');
        if($my_id=='all')
        {
            $messages = Message::join('users','users.id','=','messages.from')->get();
        }
        else
       { $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();}
        return view('messages.group', ['messages' => $messages]);
    }

    public function chatRepos()
    {
        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get();

        // count how many message are unread from the selected user
        $users = DB::select("select users.id, users.name, employees.emp_photo, users.email 
        from employees, users  
        where users.id=employees.emp_id
        group by users.id, users.name,employees.emp_photo, users.email");

        return view('chatRepo', ['users' => $users]);
    }
    public function touser( Request $req){
        $users = DB::select("select messages.`from`,messages.`to`,users.id,users.name from messages,users where messages.`from`=".$req->id." and messages.`to`=users.id group by messages.`to`
        ");

        return json_encode($users);
    }

}
