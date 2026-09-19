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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('type');
            $table->string('listing_type'); // rent or sale
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('price');
            $table->string('price_period');
            $table->string('property_id')->unique();
            $table->integer('size'); // in sqft
            $table->integer('garage')->default(0);
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->string('video')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable(); // Store multiple images as JSON array
            $table->string('status')->default('available'); // available, sold, rented
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
