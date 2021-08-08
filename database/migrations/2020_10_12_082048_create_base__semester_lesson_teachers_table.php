<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseSemesterLessonTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__semester_lesson_teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->integer('SemesterLessonId');
            $table->integer('TeacherId');
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
        Schema::dropIfExists('base__semester_lesson_teachers');
    }
}
