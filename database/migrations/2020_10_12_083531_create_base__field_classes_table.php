<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseFieldClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__field_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser',false);
            $table->boolean('IsDeleted');
            $table->integer('FieldId');
            $table->integer('ClassId');
            $table->integer('TermId');
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
        Schema::dropIfExists('base__field_classes');
    }
}
