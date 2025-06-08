<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id(); // id (int), NOT NULL
            $table->string('name', 255)->unique(); // varchar
            $table->timestamps(); // created_at, updated_at (timestamp)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};