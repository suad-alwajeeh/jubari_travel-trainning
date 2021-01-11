<?php

namespace App\Exports;

use App\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSupReport implements FromCollection,WithHeadings
{
    public function headings():array{
        return [
            's_no',
            'supplier_name',
            'supplier_mobile',
            'supplier_phone',
            'supplier_email',
            'supplier_address',
            'supplier_acc_no',
            'supplier_remark',
            'created_at'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Report::getSupplier());

        //return Report::all();
    }
}
