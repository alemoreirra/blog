<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('costumers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('nome');
            $table->string('last_name', 100)->comment('último nome');
            $table->string('email', 100);
            $table->tinyInteger('active')->default('0')->comment('0 = não | 1 = sim');
            $table->binary('photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('costumers');
    }

}
