<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table="logs";
    protected $fillable = [
        'remarker_id', 'remark_body', 'main_servic_id ','service_id',
        'editor_id','date','status'];
}
