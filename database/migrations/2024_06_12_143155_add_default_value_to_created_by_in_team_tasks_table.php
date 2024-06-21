<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToCreatedByInTeamTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default(1)->change(); // 1 est un exemple, ajustez selon vos besoins
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default(null)->change();
        });
    }
}
