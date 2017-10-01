<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jieqi_system_users', function (Blueprint $table) {
            $table->text('sign')->nullable()->default('')->change();
            $table->text('intro')->nullable()->default('')->change();
            $table->text('setting')->nullable()->default('')->change();
            $table->text('badges')->nullable()->default('')->change();
            $table->string('pass')->change();
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
            //
        });
    }
}
