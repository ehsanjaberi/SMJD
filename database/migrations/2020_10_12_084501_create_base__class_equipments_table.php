<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseClassEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__class_equipments', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser',false);
            $table->boolean('IsDeleted');
            $table->text('Description');
            $table->integer('EquipmentCount',false);
            $table->integer('ClassId',false);
            $table->integer('EquipmentId',false);
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
        Schema::dropIfExists('base__class_equipments');
    }
}
