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
        Schema::table('teams', function (Blueprint $table) {
            if(Schema::hasColumn('teams','home_stadium')){
                $table->dropColumn('home_stadium');
            }
            $table->foreignId('stadium_id')
            ->constrained('stadiums')
            ->onDelete('restrict')
            ->uniqid()
            ->after('league');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign(['stadium_id']); // 外部キー制約を削除
            $table->dropColumn('stadium_id'); // カラムを削除
        });
    }
};
