<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_tvshow', function (Blueprint $table) {
            $table->unsignedBigInteger('tvshow_id');
            $table->unsignedBigInteger('staff_id');
            $table->primary(['tvshow_id', 'staff_id']);
            $table->foreign('staff_id')->references('id')->on('staffs');
            $table->foreign('tvshow_id')->references('id')->on('tvshows');
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
        Schema::dropIfExists('movies_staffs');
    }
};
