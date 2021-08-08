<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainSemesterLessonGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main__semester_lesson_grades', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->integer('SemesterLessonId',false);
            $table->integer('GradeTypeId',false);
            $table->integer('MaxGrade');
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
        Schema::dropIfExists('main__semester_lesson_grades');
    }
}
