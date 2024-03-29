<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_students', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('student_id')->comment('user_id=student_id');
            $table->integer('roll')->nullable();
            $table->integer('department_id');
            $table->integer('session_id');
            $table->integer('shift_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->string('gurdname')->nullable();
            $table->string('gurdphone')->nullable(); 
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
        Schema::dropIfExists('assign_students');
    }
}
