<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketService extends Model
{
    protected $table="ticket_services";
    protected $fillable = [
        'Issue_date', 'refernce', 'passenger_name ','airline_id','ticket','ticket_number',
        'Dep_city','Dep_city2','arr_city','arr_city2','dep_date','due_to_supp','provider_cost',
        'cur_id','due_to_customer','cost','service_id','passnger_currency','remark','bursher_time',
        'dep_date2','service_status','ticket_status','deleted','attachment','user_id','user_status'
    ];}
