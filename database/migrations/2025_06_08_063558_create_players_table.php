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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('restrict'); // team_id (int) - 外部キー
            $table->string('name', 255); // varchar
            $table->integer('jersey_number')->nullable(); // int
            $table->date('date_of_birth')->nullable(); // date
            $table->integer('height')->nullable(); // int
            $table->integer('weight')->nullable(); // int
            $table->string('status', 255)->nullable(); // varchar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
