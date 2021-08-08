<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();//
            $table->boolean('IsDeleted')->default(false);
            $table->char('Code',20);//
            $table->string('Name',200);//
            $table->char('PracticalUnits',1);
            $table->char('TheoricalUnits',1);
            $table->integer('FieldId');
            $table->integer('DegreeId');
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
        Schema::dropIfExists('base__lessons');
    }
}
