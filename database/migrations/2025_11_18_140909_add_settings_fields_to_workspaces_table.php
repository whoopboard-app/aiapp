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
        Schema::table('workspaces', function (Blueprint $table) {
            if (!Schema::hasColumn('workspaces', 'support_email')) {
                $table->string('support_email')->nullable()->after('website_url');
            }
            if (!Schema::hasColumn('workspaces', 'timezone')) {
                $table->string('timezone')->default('UTC')->after('is_active');
            }
            if (!Schema::hasColumn('workspaces', 'date_format')) {
                $table->string('date_format')->default('Y-m-d')->after('timezone');
            }
            if (!Schema::hasColumn('workspaces', 'time_format')) {
                $table->string('time_format')->default('H:i')->after('date_format');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workspaces', function (Blueprint $table) {
            $columns = ['support_email', 'timezone', 'date_format', 'time_format'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('workspaces', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
