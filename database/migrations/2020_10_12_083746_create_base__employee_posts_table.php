<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseEmployeePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base__employee_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser');
            $table->boolean('IsDeleted')->default(false);
            $table->integer('UniversityPostId');
            $table->integer('UniversityEmployeeId');
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
        Schema::dropIfExists('base__employee_posts');
    }
}
