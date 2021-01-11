<?php

namespace App\Http\Controllers;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
     public function counter_notify($user_id){
        $wordlist=Notification::select(DB::raw('count(*) as count'))->where([['status',0],['resiver',$user_id]])->get();
        //$wordlist = Notification::where([['status',0],['resiver',$user_id]])->get();
       echo json_encode($wordlist);
     }

     public function user_notify($user_id){
          $wordlist=Notification::where([['status',0],['resiver',$user_id]])->get();
         echo json_encode($wordlist);
       }
       public function status_notify($s,$f,$t,$status){
        $wordlist=Notification::where([['sender',$f],['resiver',$t],['servic_id',$s]])
        ->update(['status'=>1]);

       }
}
