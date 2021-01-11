<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalService extends Model
{
    protected $table="medical_services";
    protected $fillable = [
        'Issue_date', 'refernce', 'passenger_name ','document_number',
        'Dep_city','arr_city','dep_date','due_to_supp','provider_cost',
        'cur_id','due_to_customer','cost','service_id','passnger_currency','remark',
        'med_info','report_status','service_status','deleted','from_city','attachment','user_id','user_status'
    ];
}
