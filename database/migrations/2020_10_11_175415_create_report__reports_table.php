<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report__reports', function (Blueprint $table) {
            $table->id();
            $table->integer('ModifyUser')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->integer('ReportGroupId');
            $table->string('Title',200);
            $table->text('Query');
            $table->string('SumColumns')->nullable();
            $table->string('ViewColumns')->nullable();
            $table->boolean('HasPager');
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
        Schema::dropIfExists('report__reports');
    }
}
