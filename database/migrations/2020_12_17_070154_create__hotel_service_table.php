<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_service', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_id');
            $table->date('Issue_date');
            $table->string('refernce');
            $table->string('passenger_name');
            $table->integer('hotel_status')->default(1);
            $table->string('voucher_number');
            $table->string('city');
            $table->string('country');
            $table->string('hotel_name');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('due_to_supp');
            $table->decimal('provider_cost');
            $table->integer('cur_id');
            $table->string('due_to_customer');
            $table->decimal('cost');
            $table->integer('service_id');
            $table->string('passnger_currency');
            $table->text('remark')->default(null);
            $table->integer('service_status');
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
        Schema::dropIfExists('_hotel_service');
    }
}
