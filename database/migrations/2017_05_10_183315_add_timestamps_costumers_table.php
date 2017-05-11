<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsCostumersTable extends Migration
{
    public function up()
    {
        Schema::table('costumers', function (Blueprint $table) {
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
        Schema::table('costumers', function (Blueprint $table) {
            $table->dropIfExists('created_at');
            $table->dropIfExists('updated_at');
        });
    }
}
