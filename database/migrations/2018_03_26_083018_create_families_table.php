<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
		$table->unsignedInteger('id');
		$table->primary('id');
		$table->string('name')->unique();
		$table->integer('group_id')->unsigned()->index()->nullable();
        $table->timestamps();
		$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
}
