<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('emp_id');
            $table->string('emp_first_name');
            $table->string('emp_middel_name');
            $table->string('emp_thired_name');
            $table->string('emp_last_name');
            $table->date('emp_hirdate');
            $table->decimal('emp_salary');
            $table->string('emp_ssn');
            $table->string('emp_mobile');
            $table->integer('dept_id');
            $table->string('emp_email');
            $table->string('emp_photo');
            $table->boolean('is_active')->default(1);
            $table->boolean('deleted')->default(0);
            $table->text('attchment');
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
        Schema::dropIfExists('employees');
    }
}
