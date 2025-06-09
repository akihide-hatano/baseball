<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string('specialty', 255)->nullable()->after('status');
            $table->string('hometown', 255)->nullable()->after('specialty');
            $table->json('career_stats')->nullable()->after('hometown');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn(['height', 'weight', 'status', 'specialty', 'hometown', 'career_stats']);
        });
    }
};
