<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainPersonPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main__person_phones', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser',false);
            $table->tinyInteger('IsDeleted',false);
            $table->integer('PersonId',false);
            $table->integer('PhoneTypeId',false);
            $table->string('Number');
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
        Schema::dropIfExists('main__person_phones');
    }
}
