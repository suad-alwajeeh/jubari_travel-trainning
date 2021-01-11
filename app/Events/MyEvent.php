<?php

namespace App\Events;

//use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
     public $from;
     public $to;
     public $message;
     public $date;

    public function __construct($data =[])
    {
      $this->from=$data['from'];
     $this->to=$data['to'];
     $this->message=$data['message'];
     $this->date=$data['date'];

               }
               
               

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       // return new Channel('sss');
       return ['sss'];
    }
    public function broadcastAs() {

        return 'sss';
        
        }
       public function broadcastWith()
{
   return ['id' => $this->to,'mass'=>$this->message];
}

}
