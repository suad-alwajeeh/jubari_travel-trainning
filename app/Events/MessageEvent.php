<?php

namespace App\Events;

//use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent  implements ShouldBroadcast
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

    public function __construct($data =[])
    {
      $this->from=$data['from'];
     $this->to=$data['to'];
     $this->message=$data['message'];

               }
               
               

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       // return new Channel('sss');
       return ['my-channel'];
    }
    public function broadcastAs() {

        return 'my-channel';
        
        }
       public function broadcastWith()
{
   return ['id' => $this->to,'mass'=>$this->message];
}

}
