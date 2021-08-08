<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__semesters', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();//
            $table->boolean('IsDeleted')->default(false);;
            $table->string('Name',200);//
            $table->char('Code',20);//
            $table->integer('UniversityId');
            $table->boolean('SessionType')->default(false);//
            $table->integer('SessionDuration');//
            $table->string('StartDate',10);
//            $table->char('StartDayType',1);
            $table->string('EndDate',10);
            $table->boolean('IsDefault')->nullable();
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
        Schema::dropIfExists('base__semesters');
    }
}
