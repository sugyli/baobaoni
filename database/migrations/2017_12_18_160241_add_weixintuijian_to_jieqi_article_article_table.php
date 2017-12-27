<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeixintuijianToJieqiArticleArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jieqi_article_article', function (Blueprint $table) {
            $table->integer('is_weixin')->unsigned()->default(0)->index();
            $table->integer('is_weixin_recommend')->unsigned()->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jieqi_article_article', function (Blueprint $table) {
            $table->dropColumn('is_weixin');
            $table->dropColumn('is_weixin_recommend');
        });
    }
}
