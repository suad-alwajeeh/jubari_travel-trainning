<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusService extends Model
{
    protected $table="bus_services";
    protected $fillable = [
        'Issue_date', 'refernce', 'passenger_name ','bus_number','updated_at','created_at',
        'Dep_city','arr_city','dep_date','due_to_supp','provider_cost',
        'cur_id','due_to_customer','cost','service_id','passnger_currency','remark',
        'bus_name','service_status','bus_status','deleted','attachment','user_id','user_status'
    ];
}
