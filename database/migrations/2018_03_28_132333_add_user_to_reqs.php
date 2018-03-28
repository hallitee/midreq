<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToReqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reqs', function (Blueprint $table) {
            //
			$table->integer('user_id')->unsigned()->index()->nullable()->after('subcat');
			$table->string('reqstatus')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reqs', function (Blueprint $table) {
            //
        });
    }
}
