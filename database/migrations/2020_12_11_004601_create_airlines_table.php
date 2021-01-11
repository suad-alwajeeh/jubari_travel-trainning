<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->integer('airline_code');
            $table->integer('how_add_it')->default();
            $table->integer('is_delete')->default(0);
            $table->integer('is_active')->default(1);
            $table->string('airline_name');
            $table->string('country');
            $table->string('carrier_code');
            $table->string('code');
            $table->string('IATA');            
            $table->string('remark');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airlines');
    }
}
