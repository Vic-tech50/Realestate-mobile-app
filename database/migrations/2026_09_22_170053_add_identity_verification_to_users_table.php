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
        Schema::table('users', function (Blueprint $table) {
            $table->string('verification_document_type')->nullable();
            $table->string('verification_document_path')->nullable();

            $table->enum('verification_status', [
                'unverified',
                'pending',
                'verified',
                'rejected',
            ])->default('unverified');

            $table->text('verification_rejection_reason')->nullable();

            $table->timestamp('verification_submitted_at')->nullable();
            $table->timestamp('verification_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'verification_document_type',
                'verification_document_path',
                'verification_status',
                'verification_rejection_reason',
                'verification_submitted_at',
                'verification_verified_at',
            ]);
        });
    }
};
