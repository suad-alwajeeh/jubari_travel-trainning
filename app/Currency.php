<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table="currencies";
    protected $fillable = [
        'cur_id', 'cur_name', 'is_active'];
}
