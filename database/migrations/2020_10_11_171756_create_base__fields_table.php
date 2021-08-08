<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__fields', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();//
            $table->boolean('IsDeleted')->default(false);
            $table->char('Code',20);//
            $table->string('Name',200);//
            $table->integer('CollegeId');//
            $table->boolean('IsDaily')->nullable();//
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
        Schema::dropIfExists('base__fields');
    }
}
