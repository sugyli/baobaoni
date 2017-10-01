<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreToJieqiArticleArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jieqi_article_article', function (Blueprint $table) {
          if (!Schema::hasColumn('jieqi_article_article', 'created_at','updated_at')) {
              $table->timestamps();
          }

          if (!Schema::hasColumn('jieqi_article_article', 'deleted_at')) {
              $table->softDeletes();
          }
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
          $table->dropColumn(['created_at','updated_at']);
          $table->dropColumn(['deleted_at']);
        });
    }
}
