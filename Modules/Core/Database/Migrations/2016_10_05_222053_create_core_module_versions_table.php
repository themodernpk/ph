<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreModuleVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_module_versions', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('core_module_id');
	        $table->string('version')->nullable();
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
        Schema::dropIfExists('core_module_versions');
    }
}
