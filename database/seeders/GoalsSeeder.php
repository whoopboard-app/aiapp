<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        $goals = [
            [
                'key' => 'feedback',
                'name' => 'Capture & Manage Feedback',
                'description' => 'Collect and organize customer feedback, feature requests, and bug reports in one place.',
                'icon' => '💬',
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'changelog',
                'name' => 'Publish Product Updates',
                'description' => 'Keep users informed with beautiful changelogs and release notes.',
                'icon' => '📝',
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'surveys',
                'name' => 'Run Surveys',
                'description' => 'Gather insights from customers with targeted surveys and questionnaires.',
                'icon' => '📊',
                'is_active' => true,
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'research',
                'name' => 'Research Workspace',
                'description' => 'Organize user research, interviews, and insights to inform product decisions.',
                'icon' => '🔬',
                'is_active' => true,
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'knowledge',
                'name' => 'Help & Knowledge Base',
                'description' => 'Build a comprehensive help center and knowledge base for your customers.',
                'icon' => '📚',
                'is_active' => true,
                'sort_order' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('goals')->insert($goals);
    }
}
