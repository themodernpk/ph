<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_modules', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name')->nullable();
	        $table->string('slug')->unique()->nullable();
	        $table->string('details')->nullable();
	        $table->string('enable')->nullable(0);
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
        Schema::dropIfExists('core_modules');
    }
}
