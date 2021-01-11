<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_services', function (Blueprint $table) {
            $table->id();
            $table->string('visa_id');
            $table->date('Issue_date');
            $table->string('refernce');
            $table->string('passenger_name');
            $table->string('visa_status')->default(1);
            $table->string('voucher_number');
            $table->string('country');
            $table->string('visa_type');
            $table->text('visa_info');
            $table->string('Dep_city');
            $table->string('arr_city');
            $table->date('dep_date');
            $table->string('due_to_supp');
            $table->decimal('provider_cost');
            $table->integer('cur_id');
            $table->string('due_to_customer');
            $table->decimal('cost');
            $table->integer('service_id');
            $table->string('passnger_currency');
            $table->text('remark')->default(null);
            $table->integer('service_status')->default(1);
            $table->text('attachment');
            $table->boolean('deleted')->default(0);
            $table->boolean('user_status')->default(0);
            $table->integer('user_id');
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visa_services');
    }
}
