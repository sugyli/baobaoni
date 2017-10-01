<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jieqi_system_users', function (Blueprint $table){

          if (!Schema::hasColumn('jieqi_system_users', 'remember_token')) {
              $table->rememberToken();
          }
          if (!Schema::hasColumn('jieqi_system_users', 'created_at','updated_at')) {
              $table->timestamps();
          }

          if (!Schema::hasColumn('jieqi_system_users', 'deleted_at')) {
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
        Schema::table('jieqi_system_users', function (Blueprint $table) {
          $table->dropColumn(['created_at','updated_at']);
          $table->dropColumn(['deleted_at']);
          $table->dropColumn(['remember_token']);
        });
    }
}
