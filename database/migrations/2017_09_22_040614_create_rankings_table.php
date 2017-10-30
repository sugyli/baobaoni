<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->engine='MyISAM';
            $table->increments('id');
            $table->unsignedInteger('articleid')->default(0);
            $table->unsignedInteger('uid')->default(0);
            $table->unsignedInteger('ranking_date')->default(0);
            $table->unsignedInteger('hits')->default(0);
            $table->timestamps();
            $table->unique(['uid', 'articleid','ranking_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
}
