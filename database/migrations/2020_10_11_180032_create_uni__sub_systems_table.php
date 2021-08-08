<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniSubSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uni__sub_systems', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->string('Name',100);
            $table->string('Title',100);
            $table->string('Icon');
            $table->string('Order')->default(0);
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
        Schema::dropIfExists('uni__sub_systems');
    }
}
