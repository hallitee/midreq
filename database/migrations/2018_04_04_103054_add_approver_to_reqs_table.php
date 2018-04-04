<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApproverToReqsTable extends Migration
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
			$table->integer('approver')->nullable()->default(0);
			$table->string('appr_name')->nullabe();
			$table->boolean('approved')->nullable()->default(0);
			$table->dateTime('appr_date')->nullable();
			$table->timestamp('approvedate')->nullable();
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
