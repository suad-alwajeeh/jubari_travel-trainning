<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralService extends Model
{
    protected $table="general_services";
    protected $fillable = [
        'Issue_date', 'refernce', 'passenger_name ','bus_number',
       'due_to_supp','provider_cost','user_id','user_status',
        'cur_id','due_to_customer','cost','service_id','passnger_currency','remark',
        'bus_name','service_status','offered_status','deleted','general_status','busher_time','attachment'
    ];
}
