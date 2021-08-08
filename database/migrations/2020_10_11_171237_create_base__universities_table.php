<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__universities', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->char('Code');
            $table->string('Name');
            $table->text('Address')->nullable();
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
        Schema::dropIfExists('base__universities');
    }
}
