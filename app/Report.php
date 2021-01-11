<?php

namespace App;
//namespace App\Http\Controllers;
//use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Facades\DB;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    protected $table = 'suppliers';
    public static function getSupplier(){
        $records = DB::table('suppliers')->select(
            's_no','supplier_name','supplier_mobile','supplier_phone',
        'supplier_email','supplier_address','supplier_acc_no','supplier_remark','created_at'
    )->orderBy('s_no','asc')->get()->toArray();

    return $records;
    }
}
