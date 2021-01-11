<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    protected $table="hotel_services";
    protected $fillable = [
        'Issue_date', 'refernce', 'passenger_name ','voucher_number',
        'country','city','hotel_name','due_to_supp','provider_cost','check_in','check_out',
        'cur_id','due_to_customer','cost','service_id','passnger_currency','remark',
        'service_status','hotel_status','deleted','attachment','user_id','user_status'
    ];
}
