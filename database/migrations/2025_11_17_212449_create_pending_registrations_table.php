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
        Schema::create('pending_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('token')->unique(); // Verification token
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expires_at'); // Link expires after 24 hours
            $table->timestamps();
            
            $table->index('token');
            $table->index(['email', 'verified_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_registrations');
    }
};
