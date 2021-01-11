<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('s_no');
            $table->string('supplier_name');
            $table->integer('supplier_mobile');
            $table->integer('supplier_phone');
            $table->string('supplier_email');
            $table->string('supplier_photo');            
            $table->string('supplier_address');   
            $table->integer('supplier_acc_no');
            $table->date('create_date');
            $table->string('supplier_remark'); 
            $table->integer('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
