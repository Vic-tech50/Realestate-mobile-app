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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('country')->default('Nigeria');
            $table->string('landmark')->nullable();
            $table->unsignedInteger('toilets')->default(0);
            $table->string('size_unit')->default('sqm');
            $table->json('amenities')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['country', 'landmark', 'toilets', 'size_unit', 'amenities']);
        });
    }
};
