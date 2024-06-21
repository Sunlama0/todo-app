<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTeamTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_tasks', function (Blueprint $table) {
            $table->string('status')->default('en cours'); // Ajout de la colonne status
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
            $table->dropColumn('status'); // Suppression de la colonne status
        });
    }
}
