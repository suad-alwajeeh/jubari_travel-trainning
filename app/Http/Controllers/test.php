<?php

namespace App\Http\Controllers;
use App\Events\MyEvent;
use Illuminate\Http\Request;

class test extends Controller
{
public function index(){
    $datav=['to'=>'11','from'=>'soso','message'=>'sd.al@w','date'=>'sd.al@w'];
    event(new MyEvent($datav));
    return "Event has been sent!";

}


}
