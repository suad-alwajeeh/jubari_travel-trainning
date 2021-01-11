<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'ser_name', 'ser_id', 'discrption ','is_active','emp_id_how_create','deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'create_at','updated_at'
    ];

}
