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
        Schema::create('workspace_branding', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->unique()->constrained()->onDelete('cascade');
            $table->string('display_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('logo_link_url')->nullable();
            $table->string('logo_light_path')->nullable();
            $table->string('favicon_path')->nullable();
            $table->string('logo_square_path')->nullable();
            $table->string('logo_landscape_path')->nullable();
            $table->enum('default_logo_layout', ['square', 'landscape'])->default('square');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspace_branding');
    }
};
