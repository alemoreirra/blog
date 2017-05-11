<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMartialStatusColumnOnCostumersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('costumers', function (Blueprint $table) {
            $table->integer('martial_status_id')->unsigned()->nullable()->after('id');
            $table->foreign('martial_status_id')->references('id')->on('martial_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('costumers', function (Blueprint $table) {
            $table->dropForeign('martial_status_id');
        });
    }

}
