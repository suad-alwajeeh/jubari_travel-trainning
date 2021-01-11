<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_services', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->string('id');
            $table->date('Issue_date');
            $table->string('refernce');
            $table->string('passenger_name');
            $table->integer('airline_id');
            $table->string('ticket');
            $table->integer('ticket_status')->default(1);
            $table->string('ticket_number');
            $table->string('Dep_city');
            $table->string('Dep_city2');
            $table->string('arr_city');
            $table->string('arr_city2');
            $table->date('dep_date');
            $table->date('dep_date2');
            $table->string('due_to_supp');
            $table->decimal('provider_cost');
            $table->integer('cur_id');
            $table->string('due_to_customer');
            $table->decimal('cost');
            $table->integer('service_id');
            $table->string('passnger_currency');
            $table->text('remark')->default(null);
            $table->text('bursher_time');
            $table->text('attachment');
            $table->integer('service_status')->default(1);
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
        Schema::dropIfExists('ticket_service');
    }
}
