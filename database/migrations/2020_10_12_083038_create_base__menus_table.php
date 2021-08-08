<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__menus', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->string('Name');
            $table->string('Title');
            $table->integer('SubSystemId');
            $table->string('Url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('ParentMenuId')->nullable();
            $table->integer('Order')->nullable();
            $table->integer('PermissionId')->nullable();
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
        Schema::dropIfExists('base__menus');
    }
}
