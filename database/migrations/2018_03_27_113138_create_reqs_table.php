<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reqs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('item_type');
			$table->string('descr');
			$table->string('mat_type')->nullable();
			$table->string('brand')->nullable();
			$table->string('part_no')->nullable();
			$table->string('catname')->nullable();
			$table->string('subcatname')->nullable();			
			$table->integer('cat')->nullable();
			$table->integer('subcat')->nullable();			
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
        Schema::dropIfExists('reqs');
    }
}
