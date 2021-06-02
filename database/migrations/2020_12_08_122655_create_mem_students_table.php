<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mem_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('assign_student_id');
            $table->integer('department_id');
            $table->integer('session_id');
            $table->integer('shift_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->integer('library_id')->nullable();
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
        Schema::dropIfExists('mem_students');
    }
}
