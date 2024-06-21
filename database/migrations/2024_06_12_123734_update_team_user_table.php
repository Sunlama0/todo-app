<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTeamUserTable extends Migration
{
    public function up()
    {
        Schema::table('team_user', function (Blueprint $table) {
            $table->unique(['user_id', 'team_id']);
        });
    }

    public function down()
    {
        Schema::table('team_user', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'team_id']);
        });
    }
}
