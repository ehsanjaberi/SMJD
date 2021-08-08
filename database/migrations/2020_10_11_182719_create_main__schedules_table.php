<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main__schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->integer('SemesterLessonId');
            $table->integer('ClassId');
            $table->integer('TeacherId')->nullable();
            $table->string('StartTime',8);
            $table->string('EndTime',8);
            $table->char('HoldingData',10)->nullable();
            $table->char('Week',1);
            $table->char('Day',1);
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
        Schema::dropIfExists('main__schedules');
    }
}
