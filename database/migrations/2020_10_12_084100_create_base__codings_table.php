<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseCodingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__codings', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser',false);
            $table->boolean('IsDeleted');
            $table->string('Name',100);
            $table->string('ETitle',100);
            $table->integer('CodingId');
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
        Schema::dropIfExists('base__codings');
    }
}
