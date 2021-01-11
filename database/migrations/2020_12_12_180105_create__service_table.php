<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('ser_id');
            $table->string('ser_name');
            $table->string('discrption');
            $table->date('create_at');
            $table->boolean('is_active')->default(1);
            $table->boolean('deleted')->default(0);
            $table->integer('emp_id_how_create');
            $table->string('created_at')->default(null);
            $table->string('updated_at')->default(null);
             

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
