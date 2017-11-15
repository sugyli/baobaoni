<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountMulusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_mulus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('articleid')->nullable()->default(0);
            $table->tinyInteger('is_use')->nullable()->default(0);//是否以删除  0否 1是

            $table->unique('articleid');
            $table->index(['articleid','is_use']);
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
        Schema::dropIfExists('count_mulus');
    }
}
