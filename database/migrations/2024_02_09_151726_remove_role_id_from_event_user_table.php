<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveRoleIdFromEventUserTable extends Migration
{
    public function up(): void
    {
        Schema::table('event_user', function (Blueprint $table) {
            $table->dropColumn('role_id');
        });
    }

    public function down(): void
    {
        Schema::table('event_user', function (Blueprint $table) {
            $table->integer('role_id'); // Ajoutez les contraintes appropriées si nécessaire
        });
    }
}
